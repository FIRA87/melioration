<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index()
    {
        // загрузим опросы с количеством вопросов и суммой голосов
        $surveys = Survey::with(['questions.options','questions.answers'])->latest()->get();
        return view('backend.surveys.index', compact('surveys'));
    }

    public function create()
    {
        return view('backend.surveys.create');
    }

    // Сохраняем опрос и вложенные вопросы/опции (формат: questions[][...], options as nested)
    public function store(Request $request)
    {
        $data = $request->validate([
            'title_ru'=>'required|string|max:255',
            'title_tj'=>'nullable|string|max:255',
            'title_en'=>'required|string|max:255',
            'description_ru'=>'nullable|string',
            'is_active'=>'nullable|boolean',
            'questions'=>'nullable|array',
            'questions.*.text_ru'=>'required_with:questions|string',
            'questions.*.type'=>'nullable|in:radio,checkbox,text',
            'questions.*.options'=>'nullable|array',
            'questions.*.options.*.text_ru'=>'required_with:questions.*.options|string'
        ]);

        $survey = Survey::create([
            'title_ru'=>$data['title_ru'],
            'title_tj'=>$data['title_tj'] ?? null,
            'title_en'=>$data['title_en'],
            'description_ru'=>$data['description_ru'] ?? null,
            'description_tj'=>$request->description_tj ?? null,
            'description_en'=>$request->description_en ?? null,
            'is_active' => isset($data['is_active']) ? (bool)$data['is_active'] : true,
            'start_date' => $data['start_date'] ?? null,
            'end_date' => $data['end_date'] ?? null,
        ]);

        if (!empty($data['questions'])) {
            foreach ($data['questions'] as $q) {
                $question = Question::create([
                    'survey_id' => $survey->id,
                    'text_ru' => $q['text_ru'] ?? '',
                    'text_tj' => $q['text_tj'] ?? '',
                    'text_en' => $q['text_en'] ?? '',
                    'type' => $q['type'] ?? 'radio'
                ]);
                if (!empty($q['options']) && is_array($q['options'])) {
                    foreach ($q['options'] as $opt) {
                        Option::create([
                            'question_id' => $question->id,
                            'text_ru' => $opt['text_ru'] ?? '',
                            'text_tj' => $opt['text_tj'] ?? '',
                            'text_en' => $opt['text_en'] ?? ''
                        ]);
                    }
                }
            }
        }

        return redirect()->route('surveys.index')->with('success','Опрос создан');
    }

    public function edit(Survey $survey)
    {
        $survey->load('questions.options');
        return view('backend.surveys.edit', compact('survey'));
    }

    // Обновление опроса вместе с вопросами/опциями — синхронизируем: обновить/создать/удалить
    public function update(Request $request, Survey $survey)
    {
        $data = $request->validate([
            'title_ru'=>'required|string|max:255',
            'title_tj'=>'nullable|string|max:255',
            'title_en'=>'required|string|max:255',
            'description_ru'=>'nullable|string',
            'is_active'=>'nullable|boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'questions'=>'nullable|array',
            'questions.*.id'=>'nullable|exists:questions,id',
            'questions.*.text_ru'=>'required_with:questions|string',
            'questions.*.type'=>'nullable|in:radio,checkbox,text',
            'questions.*.options'=>'nullable|array',
            'questions.*.options.*.id'=>'nullable|exists:options,id',
            'questions.*.options.*.text_ru'=>'required_with:questions.*.options|string'
        ]);

        $survey->update([
            'title_ru'=>$data['title_ru'],
            'title_tj'=>$data['title_tj'] ?? null,
            'title_en'=>$data['title_en'],
            'description_ru'=>$data['description_ru'] ?? null,
            'description_tj'=>$request->description_tj ?? null,
            'description_en'=>$request->description_en ?? null,
            'is_active' => isset($data['is_active']) ? (bool)$data['is_active'] : false,
            'start_date' => $data['start_date'] ?? null,
            'end_date' => $data['end_date'] ?? null,
        ]);

        // Sync questions
        $existingQuestionIds = $survey->questions()->pluck('id')->toArray();
        $sentQuestionIds = [];

        if (!empty($data['questions'])) {
            foreach ($data['questions'] as $q) {
                if (!empty($q['id'])) {
                    // update existing
                    $question = Question::find($q['id']);
                    if ($question) {
                        $question->update([
                            'text_ru'=>$q['text_ru'] ?? $question->text_ru,
                            'text_tj'=>$q['text_tj'] ?? $question->text_tj,
                            'text_en'=>$q['text_en'] ?? $question->text_en,
                            'type'=>$q['type'] ?? $question->type
                        ]);
                        $qid = $question->id;
                    } else {
                        continue;
                    }
                } else {
                    // create new question
                    $question = Question::create([
                        'survey_id'=>$survey->id,
                        'text_ru'=>$q['text_ru'] ?? '',
                        'text_tj'=>$q['text_tj'] ?? '',
                        'text_en'=>$q['text_en'] ?? '',
                        'type'=>$q['type'] ?? 'radio'
                    ]);
                    $qid = $question->id;
                }
                $sentQuestionIds[] = $qid;

                // sync options for this question
                $existingOptionIds = Option::where('question_id',$qid)->pluck('id')->toArray();
                $sentOptionIds = [];
                if (!empty($q['options']) && is_array($q['options'])) {
                    foreach ($q['options'] as $opt) {
                        if (!empty($opt['id'])) {
                            $option = Option::find($opt['id']);
                            if ($option) {
                                $option->update([
                                    'text_ru'=>$opt['text_ru'] ?? $option->text_ru,
                                    'text_tj'=>$opt['text_tj'] ?? $option->text_tj,
                                    'text_en'=>$opt['text_en'] ?? $option->text_en,
                                ]);
                                $oid = $option->id;
                            } else {
                                continue;
                            }
                        } else {
                            $option = Option::create([
                                'question_id'=>$qid,
                                'text_ru'=>$opt['text_ru'] ?? '',
                                'text_tj'=>$opt['text_tj'] ?? '',
                                'text_en'=>$opt['text_en'] ?? ''
                            ]);
                            $oid = $option->id;
                        }
                        $sentOptionIds[] = $oid;
                    }
                }
                // delete removed options
                $toDeleteOptions = array_diff($existingOptionIds, $sentOptionIds);
                if (!empty($toDeleteOptions)) {
                    Option::whereIn('id',$toDeleteOptions)->delete();
                }
            }
        }

        // delete removed questions
        $toDeleteQuestions = array_diff($existingQuestionIds, $sentQuestionIds);
        if (!empty($toDeleteQuestions)) {
            Question::whereIn('id',$toDeleteQuestions)->delete();
        }

        return redirect()->route('surveys.edit',$survey)->with('success','Опрос обновлён');
    }

    public function destroy(Survey $survey)
    {
        $survey->delete();
        return redirect()->route('surveys.index')->with('success','Опрос удалён');
    }

    // show statistics view
    public function show(Survey $survey)
    {
        $survey->load('questions.options.answers');
        return view('backend.surveys.show', compact('survey'));
    }
}
