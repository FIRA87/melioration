<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('sort', 'asc')->orderBy('id', 'desc')->get();
        return view('backend.tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('backend.tasks.create');
    }

    public function store(TaskRequest $request)
    {
        $data = $request->validated();

        // Обработка статуса
        $status = $request->has('status') ? 1 : 0;

        // Генерация slug
        $titleForSlug = $data['title_en'] ?? $data['title_tj'] ?? $data['title_ru'] ?? 'task';
        $slug = $data['slug'] ?? Str::slug($titleForSlug, '-');

        Task::create([
            'title_ru' => $data['title_ru'] ?? null,
            'title_tj' => $data['title_tj'],
            'title_en' => $data['title_en'] ?? null,
            'slug' => $slug,
            'text_ru' => $data['text_ru'] ?? null,
            'text_tj' => $data['text_tj'] ?? null,
            'text_en' => $data['text_en'] ?? null,
            'status' => $status,
            'sort' => $data['sort'] ?? 0,
        ]);

        return redirect()->route('all.tasks')->with([
            'message' => 'Задача успешно добавлена',
            'alert-type' => 'success'
        ]);
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('backend.tasks.edit', compact('task'));
    }

    public function update(TaskRequest $request)
    {
        $data = $request->validated();
        $task = Task::findOrFail($request->id);

        // Обработка статуса
        $status = $request->has('status') ? 1 : 0;

        // Генерация slug
        $titleForSlug = $data['title_en'] ?? $data['title_tj'] ?? $data['title_ru'] ?? 'task';
        $slug = $data['slug'] ?? Str::slug($titleForSlug, '-');

        $task->update([
            'title_ru' => $data['title_ru'] ?? null,
            'title_tj' => $data['title_tj'],
            'title_en' => $data['title_en'] ?? null,
            'slug' => $slug,
            'text_ru' => $data['text_ru'] ?? null,
            'text_tj' => $data['text_tj'] ?? null,
            'text_en' => $data['text_en'] ?? null,
            'status' => $status,
            'sort' => $data['sort'] ?? 0,
        ]);

        return redirect()->route('all.tasks')->with([
            'message' => 'Задача успешно обновлена',
            'alert-type' => 'success'
        ]);
    }

    public function delete($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->back()->with([
            'message' => 'Задача успешно удалена',
            'alert-type' => 'success'
        ]);
    }
}
