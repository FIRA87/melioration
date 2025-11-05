<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;

class SurveyVoteController extends Controller
{
    public function vote(Request $request, $surveyId)
    {
        $data = $request->validate([
            'question_id'=>'required|exists:questions,id',
            'option_id'=>'nullable|exists:options,id',
            'text_answer'=>'nullable|string|max:2000'
        ]);

        $question = Question::findOrFail($data['question_id']);
        $ip = $request->ip();

        // simple duplicate prevention by IP per question
        $exists = Answer::where('question_id',$question->id)->where('user_ip',$ip)->exists();
        if ($exists) {
            return response()->json(['status'=>'error','message'=>'Вы уже голосовали по этому вопросу'],422);
        }

        $answer = Answer::create([
            'question_id'=>$question->id,
            'option_id'=>$data['option_id'] ?? null,
            'user_ip'=>$ip
        ]);

        // return updated counts
        $total = $question->answers()->count();
        $counts = $question->options()->withCount('answers')->get()->map(fn($o)=>[
            'option_id'=>$o->id,'text_ru'=>$o->text_ru,'votes'=>$o->answers_count
        ]);

        return response()->json(['status'=>'ok','total'=>$total,'counts'=>$counts]);
    }
}
