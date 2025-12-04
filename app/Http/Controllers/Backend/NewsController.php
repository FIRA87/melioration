<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\NewsImage;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\NewsRequest;

class NewsController extends Controller
{
    public function allNews()
    {
        $allNews = News::orderBy('publish_date', 'desc')->get();
        return view('backend.news.index', compact('allNews'));
    }

    public function addNews()
    {
        $categories = Category::all();
        $tasks = Task::where('status', 1)->orderBy('sort', 'asc')->get();
        $adminUser = User::where('role', 'admin')->latest()->get();
        return view('backend.news.create', compact('categories', 'tasks', 'adminUser'));
    }

    public function storeNews(NewsRequest $request)
    {        
        $data = $request->validated();
        $imagePath = $this->handleImageUpload($request);

        $news = News::create([
            'category_id' => $data['category_id'],
            'user_id' => Auth::id(),
            'title_ru' => $data['title_ru'],
            'title_tj' => $data['title_tj'] ?? null,
            'title_en' => $data['title_en'],
            'slug' => $this->generateUniqueSlug($data['title_en']),
            'news_details_ru' => $data['news_details_ru'] ?? null,
            'news_details_tj' => $data['news_details_tj'] ?? null,
            'news_details_en' => $data['news_details_en'] ?? null,
            'top_slider' => $request->has('top_slider') ? 1 : 0,
            'home_page' => $request->has('home_page') ? 1 : 0,
            'publish_date' => $data['publish_date'],
            'image' => $imagePath,
            'views' => 0,
            'status' => $data['status'] ?? 1,
            'created_at' => now(),
        ]);

        // Привязка задач (если выбраны)
        if ($request->has('tasks') && is_array($request->tasks)) {
            $news->tasks()->attach($request->tasks);
        }

        // Загрузка дополнительных изображений (если есть)
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $index => $image) {
                $name = now()->format('Ymd_His') . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('upload/news/gallery');

                if (!File::exists($imagePath)) {
                    File::makeDirectory($imagePath, 0777, true, true);
                }

                Image::make($image)->resize(800, 600)->save($imagePath . '/' . $name);

                NewsImage::create([
                    'news_id' => $news->id,
                    'image' => 'upload/news/gallery/' . $name,
                    'sort' => $index,
                ]);
            }
        }

        return redirect()
            ->route('all.news')
            ->with('message', 'Новость успешно добавлена')
            ->with('alert-type', 'success');
    }

    public function editNews($id)
    {
        $categories = Category::latest()->get();
        $tasks = Task::where('status', 1)->orderBy('sort', 'asc')->get();
        $adminUser = User::where('role', 'admin')->latest()->get();
        $news = News::with(['tasks', 'images'])->findOrFail($id);
        return view('backend.news.edit', compact('categories', 'tasks', 'adminUser', 'news'));
    }

    public function updateNews(NewsRequest $request, $id)
    {
        $news = News::findOrFail($id);
        $data = $request->validated();

        $updateData = [
            'category_id' => $data['category_id'],
            'title_ru' => $data['title_ru'],
            'title_tj' => $data['title_tj'] ?? null,
            'title_en' => $data['title_en'],
            'slug' => $this->generateUniqueSlug($data['title_en'], $news->id),
            'news_details_ru' => $data['news_details_ru'] ?? null,
            'news_details_tj' => $data['news_details_tj'] ?? null,
            'news_details_en' => $data['news_details_en'] ?? null,
            'top_slider' => $request->has('top_slider') ? 1 : 0,
            'home_page' => $request->has('home_page') ? 1 : 0,
            'publish_date' => $data['publish_date'],
            'status' => $data['status'] ?? 1,
        ];

        // Обновление главного изображения
        if ($request->hasFile('image')) {
            if ($news->image && $news->image !== 'upload/no-image.jpg') {
                $oldPath = public_path($news->image);
                if (file_exists($oldPath)) unlink($oldPath);
            }
            $updateData['image'] = $this->handleImageUpload($request);
        }

        $news->update($updateData);

        // Обновление задач
        if ($request->has('tasks') && is_array($request->tasks)) {
            $news->tasks()->sync($request->tasks);
        } else {
            $news->tasks()->detach();
        }

        // Загрузка новых изображений галереи
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $index => $image) {
                $name = now()->format('Ymd_His') . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('upload/news/gallery');

                if (!File::exists($imagePath)) {
                    File::makeDirectory($imagePath, 0777, true, true);
                }

                Image::make($image)->resize(800, 600)->save($imagePath . '/' . $name);

                NewsImage::create([
                    'news_id' => $news->id,
                    'image' => 'upload/news/gallery/' . $name,
                    'sort' => $news->images()->count() + $index,
                ]);
            }
        }

        return redirect()->route('all.news')->with([
            'message' => 'Новость обновлена',
            'alert-type' => 'success'
        ]);
    }

    public function deleteNews($id)
    {
        $news = News::findOrFail($id);

        // Удаление главного изображения
        if ($news->image && $news->image !== 'upload/no-image.jpg' && $news->image !== '404.jpg') {
            $imagePath = public_path($news->image);

            if (file_exists($imagePath)) {
                try {
                    unlink($imagePath);
                    \Log::info("Главное изображение удалено: " . $imagePath);
                } catch (\Exception $e) {
                    \Log::error("Ошибка при удалении главного изображения: " . $e->getMessage());
                }
            } else {
                \Log::warning("Файл не найден: " . $imagePath);
            }
        }

        // Удаление изображений галереи
        if ($news->images && $news->images->count() > 0) {
            foreach ($news->images as $image) {
                $galleryPath = public_path($image->image);

                if (file_exists($galleryPath)) {
                    try {
                        unlink($galleryPath);
                      //  \Log::info("Изображение галереи удалено: " . $galleryPath);
                    } catch (\Exception $e) {
                        \Log::error("Ошибка при удалении изображения галереи: " . $e->getMessage());
                    }
                } else {
                    \Log::warning("Файл галереи не найден: " . $galleryPath);
                }
            }
        }

        // Удаление записи из БД (каскадное удаление удалит связи с tasks и images)
        $news->delete();

        return back()->with([
            'message' => 'Новость удалена',
            'alert-type' => 'success'
        ]);
    }

    public function deleteGalleryImage($id)
    {
        try {
            $image = NewsImage::findOrFail($id);
            $imagePath = public_path($image->image);

            if (file_exists($imagePath)) {
                unlink($imagePath);
              //  \Log::info("Изображение удалено: " . $imagePath);
            } else {
                // \Log::warning("Файл не найден: " . $imagePath);
            }

            $image->delete();

            return response()->json([
                'success' => true,
                'message' => 'Изображение удалено'
            ]);
        } catch (\Exception $e) {
           // \Log::error("Ошибка при удалении изображения: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при удалении изображения'
            ], 500);
        }
    }

    public function inactiveNews($id)
    {
        News::findOrFail($id)->update(['status' => 0]);
        return redirect()->back()->with([
            'message' => 'Неактивные новости',
            'alert-type' => 'success'
        ]);
    }

    public function activeNews($id)
    {
        News::findOrFail($id)->update(['status' => 1]);
        return redirect()->back()->with([
            'message' => 'Активные новости',
            'alert-type' => 'success'
        ]);
    }

    private function handleImageUpload($request): string
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = date('Y-m-d') . '_' . time() . '_' . $image->getClientOriginalName();
            $imagePath = public_path('upload/news');

            if (!File::exists($imagePath)) {
                File::makeDirectory($imagePath, 0777, true, true);
            }

            Image::make($image)->resize(800, 600)->save($imagePath . '/' . $name);
            return 'upload/news/' . $name;
        }

        return 'upload/no-image.jpg';
    }

    private function generateUniqueSlug(string $title, ?int $excludeId = null): string
    {
        $slug = Str::slug($title, '-');
        $originalSlug = $slug;
        $count = 1;

        while (News::where('slug', $slug)
            ->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))
            ->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }
}
