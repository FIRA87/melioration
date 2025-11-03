<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\ProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ProjectController extends Controller
{
    /**
     * Отображает список всех проектов.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $projects = Project::orderBy('sort', 'asc')->orderBy('id', 'desc')->get();
        return view('backend.projects.index', compact('projects'));
    }

    /**
     * Показывает форму для создания нового проекта.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.projects.create');
    }

    /**
     * Сохраняет новый проект в базе данных.
     *
     * @param ProjectRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProjectRequest $request)
    {
        $data = $request->validated();

        // Обработка статуса
        $status = $request->has('status') ? 1 : 0;

        // Обработка изображения
        $save_url = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_gen = now()->format('Ymd_His') . '_' . $image->getClientOriginalName();
            $imagePath = public_path('upload/projects');
            if (!File::exists($imagePath)) {
                File::makeDirectory($imagePath, 0777, true, true);
            }
            Image::make($image)->resize(800, 600)->save($imagePath . '/' . $name_gen);
            $save_url = 'upload/projects/' . $name_gen;
        }

        // Генерация slug
        $titleForSlug = $data['title_en'] ?? $data['title_tj'] ?? $data['title_ru'] ?? 'project';
        $slug = $data['slug'] ?? \Illuminate\Support\Str::slug($titleForSlug, '-');

        Project::create([
            'title_ru' => $data['title_ru'] ?? null,
            'title_tj' => $data['title_tj'],
            'title_en' => $data['title_en'] ?? null,
            'slug' => $slug,
            'image' => $save_url,
            'text_ru' => $data['text_ru'] ?? null,
            'text_tj' => $data['text_tj'],
            'text_en' => $data['text_en'] ?? null,
            'status' => $status,
            'sort' => $data['sort'] ?? 0,
        ]);

        return redirect()->route('all.projects')->with([
            'message' => 'Проект успешно добавлен',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Показывает форму для редактирования проекта.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('backend.projects.edit', compact('project'));
    }

    /**
     * Обновляет информацию о проекте в базе данных.
     *
     * @param ProjectRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProjectRequest $request)
    {
        $data = $request->validated();
        $project = Project::findOrFail($request->id);

        // Обработка статуса
        $status = $request->has('status') ? 1 : 0;

        // Обработка нового изображения
        $save_url = $project->image;
        if ($request->hasFile('image')) {
            if ($project->image && File::exists(public_path($project->image))) {
                File::delete(public_path($project->image));
            }

            $image = $request->file('image');
            $name_gen = now()->format('Ymd_His') . '_' . $image->getClientOriginalName();
            $imagePath = public_path('upload/projects');
            if (!File::exists($imagePath)) {
                File::makeDirectory($imagePath, 0777, true, true);
            }
            Image::make($image)->resize(800, 600)->save($imagePath . '/' . $name_gen);
            $save_url = 'upload/projects/' . $name_gen;
        }

        // Генерация slug
        $titleForSlug = $data['title_en'] ?? $data['title_tj'] ?? $data['title_ru'] ?? 'project';
        $slug = $data['slug'] ?? \Illuminate\Support\Str::slug($titleForSlug, '-');

        $project->update([
            'title_ru' => $data['title_ru'] ?? null,
            'title_tj' => $data['title_tj'],
            'title_en' => $data['title_en'] ?? null,
            'slug' => $slug,
            'image' => $save_url,
            'text_ru' => $data['text_ru'] ?? null,
            'text_tj' => $data['text_tj'],
            'text_en' => $data['text_en'] ?? null,
            'status' => $status,
            'sort' => $data['sort'] ?? 0,
        ]);

        return redirect()->route('all.projects')->with([
            'message' => 'Проект успешно обновлен',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Удаляет проект из базы данных.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $project = Project::findOrFail($id);

        // Удаление изображения
        if (File::exists(public_path($project->image))) {
            File::delete(public_path($project->image));
        }

        $project->delete();

        $notification = array(
            'message' => 'Проект успешно удален',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}

