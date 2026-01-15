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

        $status = $request->has('status') ? 1 : 0;

        // основной путь
        $imagePathBase = public_path('upload/projects');
        if (!File::exists($imagePathBase)) {
            File::makeDirectory($imagePathBase, 0777, true, true);
        }

        // Сохранение основного изображения
        $save_url = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_gen = now()->format('Ymd_His') . '_' . preg_replace('/\s+/', '_', $image->getClientOriginalName());
            Image::make($image)->resize(1296, 700)->save($imagePathBase . '/' . $name_gen);
            $save_url = 'upload/projects/' . $name_gen;
        }

        // Сохранение галереи
        $galleryPaths = null;
        if ($request->hasFile('gallery')) {
            $galleryPathBase = $imagePathBase . '/gallery';
            if (!File::exists($galleryPathBase)) {
                File::makeDirectory($galleryPathBase, 0777, true, true);
            }
            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $name = now()->format('Ymd_His') . '_' . uniqid() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                Image::make($file)->resize(1200, 800)->save($galleryPathBase . '/' . $name);
                $galleryPaths[] = 'upload/projects/gallery/' . $name;
            }
        }

        // slug
        $titleForSlug = $data['title_en'] ?? $data['title_tj'] ?? $data['title_ru'] ?? 'project';
        $slug = $data['slug'] ?? \Illuminate\Support\Str::slug($titleForSlug, '-');

        $project = Project::create([
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
            'start_date' => $data['start_date'] ?? null,
            'end_date' => $data['end_date'] ?? null,
            'gallery' => $galleryPaths,
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

        $status = $request->has('status') ? 1 : 0;

        $imagePathBase = public_path('upload/projects');
        if (!File::exists($imagePathBase)) {
            File::makeDirectory($imagePathBase, 0777, true, true);
        }

        // Обновление основного изображения
        $save_url = $project->image;
        if ($request->hasFile('image')) {
            if ($project->image && File::exists(public_path($project->image))) {
                File::delete(public_path($project->image));
            }
            $image = $request->file('image');
            $name_gen = now()->format('Ymd_His') . '_' . preg_replace('/\s+/', '_', $image->getClientOriginalName());
            Image::make($image)->resize(1296, 700)->save($imagePathBase . '/' . $name_gen);
            $save_url = 'upload/projects/' . $name_gen;
        }

        // Обработка добавления в галерею (сохранение уже существующих + новых)
        $galleryPaths = $project->gallery ?? [];
        if ($request->hasFile('gallery')) {
            $galleryPathBase = $imagePathBase . '/gallery';
            if (!File::exists($galleryPathBase)) {
                File::makeDirectory($galleryPathBase, 0777, true, true);
            }
            foreach ($request->file('gallery') as $file) {
                $name = now()->format('Ymd_His') . '_' . uniqid() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                Image::make($file)->resize(1200, 800)->save($galleryPathBase . '/' . $name);
                $galleryPaths[] = 'upload/projects/gallery/' . $name;
            }
        }

        // slug
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
            'start_date' => $data['start_date'] ?? null,
            'end_date' => $data['end_date'] ?? null,
            'gallery' => $galleryPaths,
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

        // Удаляем основное изображение
        if ($project->image && File::exists(public_path($project->image))) {
            File::delete(public_path($project->image));
        }

        // Удаляем файлы галереи
        if ($project->gallery && is_array($project->gallery)) {
            foreach ($project->gallery as $img) {
                if ($img && File::exists(public_path($img))) {
                    File::delete(public_path($img));
                }
            }
        }

        $project->delete();

        $notification = array(
            'message' => 'Проект успешно удален',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }




 /**
     * Удаляет одно изображение из галереи проекта по AJAX.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteGalleryImage(Request $request)
    {
        // 1. Валидация входных данных
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'image_path' => 'required|string',
        ]);

        $projectId = $request->project_id;
        $imagePath = $request->image_path;

        try {
            $project = Project::findOrFail($projectId);

            // 2. Получение галереи. Поскольку настроен кастинг, $project->gallery уже массив.
            $gallery = $project->gallery ?? [];

            // Запасной вариант на случай, если кастинг не сработал (хотя это маловероятно)
            if (is_string($gallery)) {
                 $gallery = json_decode($gallery, true) ?? [];
            }

            // 3. Удаление пути из массива галереи
            // array_filter сохраняет только те элементы, для которых функция возвращает true
            $gallery = array_filter($gallery, function ($path) use ($imagePath) {
                return $path !== $imagePath;
            });

            // 4. Обновление записи в базе данных
            // array_values() сбрасывает ключи, чтобы JSON-список был корректным.
            // Laravel автоматически преобразует массив обратно в JSON-строку при сохранении.
            $project->gallery = empty($gallery) ? null : array_values($gallery);
            $project->save();

            // 5. Удаление файла с диска
            // File::exists импортирован в начале файла, поэтому используем его напрямую.
            if (File::exists(public_path($imagePath))) {
                File::delete(public_path($imagePath));
            }

            // 6. Возврат успешного JSON-ответа
            return response()->json([
                'success' => true,
                'message' => 'Изображение галереи успешно удалено.'
            ]);

        } catch (\Exception $e) {
            // 7. Возврат JSON-ответа с ошибкой
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при удалении: ' . $e->getMessage()
            ], 500);
        }
    }



}

