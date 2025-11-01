<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\NewsRequest;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function allNewsPost(){
        $allNews = News::orderBy('post_date', 'desc')->get();
        return view('backend.news.index', compact('allNews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addNewsPost(){
        $categories = Category::all();
        $adminUser = User::where('role', 'admin')->latest()->get();
        return view('backend.news.create', compact('categories',  'adminUser'));
    }

    /**
     * Store a newly created resource in storage.
     */
  public function storeNewsPost(NewsRequest $request){
    $data = $request->validated();
    $q = DB::select("SHOW TABLE STATUS LIKE 'news_posts'");
    $ai_id = $q[0]->Auto_increment;

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $name_gen = date('Y-m-d') . '.' . $image->getClientOriginalName();
        Image::make($image)->save('upload/news/' . $name_gen);
        $save_url = 'upload/news/' . $name_gen;
    } else {
        $save_url = 'upload/no-image.jpg'; // Используем изображение-заглушку
    }

    News::insert([
        'category_id' => $data['category_id'],
        'user_id' => Auth::id(),
        'title_ru' => $data['title_ru'],
        'title_tj' => $data['title_tj'] ?? null,
        'title_en' => $data['title_en'],
        'slug' => strtolower(str_replace(' ', '-', $data['title_en'])),
        'news_details_ru' => $data['news_details_ru'] ?? null,
        'news_details_tj' => $data['news_details_tj'] ?? null,
        'news_details_en' => $data['news_details_en'] ?? null,
        'top_slider' => $data['top_slider'] ?? null,
        'publish_date' => $data['publish_date'] ?? date('Y-m-d'),
        'image' => $save_url,
        'views' => 1,
        'created_at' => Carbon::now(),
    ]);

    $newSlug = DB::table('news_posts')->where('id', $ai_id)->pluck('slug')->first();
    $slug = implode(" ", array($newSlug));


    $notification = array(
        'message' => 'Новости успешно добавлены',
        'alert-type' => 'success'
    );
    return redirect()->route('all.news.post')->with($notification);
}


     /**
     * Show the form for editing the specified resource.
     */
    public function editNewsPost(string $id){
        $categories = Category::latest()->get();
        $adminUser = User::where('role', 'admin')->latest()->get();
        $news_post = News::findOrFail($id);
        return view('backend.news.edit', compact('categories',  'adminUser', 'news_post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateNewsPost(NewsRequest $request)
    {
        $data = $request->validated();
        $news_post_id = $request->id;

        if($request->file('image')) {
            $image = $request->file('image');
            $name_gen = date('Y-m-d').'.'.$image->getClientOriginalName();
            Image::make($image)->save('upload/news/'.$name_gen);
            $save_url = 'upload/news/'.$name_gen;

            News::findOrFail($news_post_id)->update([
                'category_id' => $data['category_id'],
                'subcategory_id' => $data['subcategory_id'] ?? null,
                'user_id' => Auth::id(),
                'title_ru' => $data['title_ru'],
                'title_tj' => $data['title_tj'] ?? null,
                'title_en' => $data['title_en'],
                'slug' => strtolower(str_replace(' ', '-', $data['title_en'])),
                'news_details_ru' => $data['news_details_ru'] ?? null,
                'news_details_tj' => $data['news_details_tj'] ?? null,
                'news_details_en' => $data['news_details_en'] ?? null,
                'top_slider' => $data['top_slider'] ?? null,
                'publish_date' => $data['publish_date'] ?? date('Y-m-d'),
                'image' => $save_url,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' =>'Новости успешно обновлены с изображением',
                'alert-type'=> 'success'
            );
            return redirect()->route('all.news.post')->with($notification);
        } else {
            News::findOrFail($news_post_id)->update([
                'category_id' => $data['category_id'],
                'user_id' => Auth::id(),
                'title_ru' => $data['title_ru'],
                'title_tj' => $data['title_tj'] ?? null,
                'title_en' => $data['title_en'],
                'slug' => strtolower(str_replace(' ', '-', $data['title_en'])),
                'news_details_ru' => $data['news_details_ru'] ?? null,
                'news_details_tj' => $data['news_details_tj'] ?? null,
                'news_details_en' => $data['news_details_en'] ?? null,
                'top_slider' => $data['top_slider'] ?? null,
                'publish_date' => $data['publish_date'] ?? date('Y-m-d'),
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' =>'Новости успешно обновлены без изображения',
                'alert-type'=> 'success'
            );
            return redirect()->route('all.news.post')->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteNewsPost(string $id)
    {
        $post_image = News::findOrFail($id);
        $img = $post_image->image;
        unlink($img);

        News::findOrFail($id)->delete();

        $notification = array(
            'message' =>'Новости успешно удалены',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    } // END METHOD


    public function inactiveNewsPost($id){
        News::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' =>'Неактивные новости',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }// END METHOD

    public function activeNewsPost($id){
        News::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' =>'Ативные новости',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }// END METHOD


}
