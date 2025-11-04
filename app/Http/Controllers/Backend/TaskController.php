<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskItem;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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
        $status = $request->has('status') ? 1 : 0;

        $titleForSlug = $data['title_en'] ?? $data['title_tj'] ?? $data['title_ru'] ?? 'task';
        $slug = $data['slug'] ?? Str::slug($titleForSlug, '-');

        $task = Task::create([
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

        // Сохранение элементов списка
        if ($request->has('items')) {
            foreach ($request->items as $index => $item) {
                if (!empty($item['text_ru']) || !empty($item['text_tj']) || !empty($item['text_en'])) {
                    TaskItem::create([
                        'task_id' => $task->id,
                        'text_ru' => $item['text_ru'] ?? null,
                        'text_tj' => $item['text_tj'] ?? null,
                        'text_en' => $item['text_en'] ?? null,
                        'sort' => $index,
                    ]);
                }
            }
        }

        return redirect()->route('all.tasks')->with([
            'message' => 'Задача успешно добавлена',
            'alert-type' => 'success'
        ]);
    }

    public function edit($id)
    {
        $task = Task::with('items')->findOrFail($id);
        return view('backend.tasks.edit', compact('task'));
    }

    public function update(TaskRequest $request)
    {
        $data = $request->validated();
        $task = Task::findOrFail($request->id);
        $status = $request->has('status') ? 1 : 0;

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

        // Удаляем старые элементы
        $task->items()->delete();

        // Создаем новые элементы
        if ($request->has('items')) {
            foreach ($request->items as $index => $item) {
                if (!empty($item['text_ru']) || !empty($item['text_tj']) || !empty($item['text_en'])) {
                    TaskItem::create([
                        'task_id' => $task->id,
                        'text_ru' => $item['text_ru'] ?? null,
                        'text_tj' => $item['text_tj'] ?? null,
                        'text_en' => $item['text_en'] ?? null,
                        'sort' => $index,
                    ]);
                }
            }
        }

        return redirect()->route('all.tasks')->with([
            'message' => 'Задача успешно обновлена',
            'alert-type' => 'success'
        ]);
    }

    public function delete($id)
    {
        $task = Task::findOrFail($id);
        $task->delete(); // Элементы удалятся автоматически благодаря onDelete('cascade')

        return redirect()->back()->with([
            'message' => 'Задача успешно удалена',
            'alert-type' => 'success'
        ]);
    }



}
