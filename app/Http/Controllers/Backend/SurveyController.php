<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SurveyController extends Controller
{
    public function index()
    {
        // Подгружаем количество вопросов и базовые поля
        $surveys = Survey::withCount('questions')->orderByDesc('id')->get();
        return view('backend.surveys.index', compact('surveys'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title_ru' => 'required|string|max:255',
            'title_tj' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_ru' => 'nullable|string',
            'description_tj' => 'nullable|string',
            'description_en' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $payload = $validator->validated();
        $payload['is_active'] = isset($payload['is_active']) ? (bool)$payload['is_active'] : true;

        $survey = Survey::create($payload);

        return response()->json(['message' => 'Опрос создан', 'survey' => $survey], 201);
    }

    public function show(Survey $survey)
    {
        $survey->load('questions.options');
        return view('backend.surveys.show', compact('survey'));
    }

    public function edit(Survey $survey)
    {
        // возвращаем JSON (можно использовать AJAX для загрузки)
        return response()->json(['survey' => $survey]);
    }

    public function update(Request $request, Survey $survey)
    {
        $validator = Validator::make($request->all(), [
            'title_ru' => 'required|string|max:255',
            'title_tj' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_ru' => 'nullable|string',
            'description_tj' => 'nullable|string',
            'description_en' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $payload = $validator->validated();
        $payload['is_active'] = isset($payload['is_active']) ? (bool)$payload['is_active'] : false;

        $survey->update($payload);

        return response()->json(['message' => 'Опрос обновлён', 'survey' => $survey]);
    }

    public function destroy(Survey $survey)
    {
        $survey->delete();
        return response()->json(['message' => 'Опрос удалён']);
    }
}
