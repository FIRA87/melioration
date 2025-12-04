<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;

class SurveyVoteController extends Controller
{
   

     public function vote(Request $request, $surveyId)
    {
        try {
            $data = $request->validate([
                'question_id' => 'required|exists:questions,id',
                'option_id' => 'nullable|exists:options,id',
                'text_answer' => 'nullable|string|max:2000'
            ]);

            $question = Question::findOrFail($data['question_id']);
            $ip = $request->ip();

            // Проверка на дубликаты по IP
            $exists = Answer::where('question_id', $question->id)
                ->where('user_ip', $ip)
                ->exists();

            if ($exists) {
                return response()->json([
                    'success' => false,
                    'status' => 'error',
                    'message' => 'Вы уже голосовали по этому вопросу'
                ], 422);
            }

            // Создаем ответ
            Answer::create([
                'question_id' => $question->id,
                'option_id' => $data['option_id'] ?? null,
                'text_answer' => $data['text_answer'] ?? null,
                'user_ip' => $ip
            ]);

            // Возвращаем обновленную статистику
            $total = $question->answers()->count();
            
            $counts = $question->options()->withCount('answers')->get()->map(function($o) {
                return [
                    'option_id' => $o->id,
                    'option_text' => $o->text_ru,
                    'votes' => $o->answers_count
                ];
            });

            return response()->json([
                'success' => true,
                'status' => 'ok',
                'message' => 'Спасибо за участие!',
                'total' => $total,
                'counts' => $counts->toArray()
            ]);

        } catch (\Exception $e) {
            \Log::error('Survey vote error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'status' => 'error',
                'message' => 'Произошла ошибка при обработке голоса'
            ], 500);
        }
    }
   
}