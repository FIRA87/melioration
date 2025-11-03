<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\User;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\NewsRequest;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function allNews(){
        $allNews = News::orderBy('publish_date', 'desc')->get();
        return view('backend.news.index', compact('allNews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addNews(){
        $categories = Category::all();
        $adminUser = User::where('role', 'admin')->latest()->get();
        return view('backend.news.create', compact('categories',  'adminUser'));
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Сохранение новости
     */
    public function storeNews(NewsRequest $request)
    {
        $data = $request->validated();
        $imagePath = $this->handleImageUpload($request);
         News::create([
            'category_id' => $data['category_id'],
            'user_id' => Auth::id(),
            'title_ru' => $data['title_ru'],
            'title_tj' => $data['title_tj'] ?? null,
            'title_en' => $data['title_en'],
            'slug' => $this->generateUniqueSlug($data['title_en']),
            'news_details_ru' => $data['news_details_ru'] ?? null,
            'news_details_tj' => $data['news_details_tj'] ?? null,
            'news_details_en' => $data['news_details_en'] ?? null,
            'top_slider' => $data['top_slider'] ?? 0,
            'publish_date' => $data['publish_date'],
            'image' => $imagePath,
            'views' => 0,
            'status' => $data['status'] ?? 1,
            'created_at' => now(),
        ]);

        return redirect()
            ->route('all.news')
            ->with('message', 'Новость успешно добавлена')
            ->with('alert-type', 'success');
    }


     /**
     * Show the form for editing the specified resource.
     */
    public function editNews(string $id){
        $categories = Category::latest()->get();
        $adminUser = User::where('role', 'admin')->latest()->get();
        $news = News::findOrFail($id);
        return view('backend.news.edit', compact('categories',  'adminUser', 'news'));
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Обновление новости — используем $news из route-model binding
     */
    public function updateNews(NewsRequest $request, News $news)
    {
        // Защита: если binding не сработал
        if (!$news->exists) {
            abort(404);
        }

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
            'top_slider' => $data['top_slider'] ?? 0,
            'publish_date' => $data['publish_date'],
            'status' => $data['status'] ?? 1,
        ];

        if ($request->hasFile('image')) {
            if ($news->image && $news->image !== 'upload/no-image.jpg') {
                $oldPath = public_path($news->image);
                if (file_exists($oldPath)) unlink($oldPath);
            }
            $updateData['image'] = $this->handleImageUpload($request);
        }

        $news->update($updateData);

        return redirect()->route('all.news')->with([
            'message' => 'Новость обновлена',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteNews(News $news)
    {
        if ($news->image && $news->image !== 'upload/no-image.jpg') {
            $imagePath = public_path($news->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $news->delete();

        return back()->with([
            'message' => 'Новость удалена',
            'alert-type' => 'success'
        ]);
    }


    public function inactiveNews($id){
        News::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' =>'Неактивные новости',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }// END METHOD

    public function activeNews($id){
        News::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' =>'Ативные новости',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }// END METHOD



    // В NewsController

    private function handleImageUpload($request): string
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = date('Y-m-d') . '.' . $image->getClientOriginalName();
            Image::make($image)->resize(800, 600)->save(public_path('upload/news/' . $name));
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
