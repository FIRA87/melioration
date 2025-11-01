<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\SurveyRequest;

class SurveyController extends Controller
{
    public function index()
    {
        // Подгружаем количество вопросов и базовые поля
        $surveys = Survey::withCount('questions')->orderByDesc('id')->get();
        return view('backend.surveys.index', compact('surveys'));
    }

    public function store(SurveyRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = isset($data['is_active']) ? (bool)$data['is_active'] : true;

        $survey = Survey::create($data);

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

    public function update(SurveyRequest $request, Survey $survey)
    {
        $data = $request->validated();
        $data['is_active'] = isset($data['is_active']) ? (bool)$data['is_active'] : false;

        $survey->update($data);

        return response()->json(['message' => 'Опрос обновлён', 'survey' => $survey]);
    }

    public function destroy(Survey $survey)
    {
        $survey->delete();
        return response()->json(['message' => 'Опрос удалён']);
    }
}
