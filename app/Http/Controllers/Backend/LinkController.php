<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class LinkController extends Controller
{

    public function index()
    {
        $links = Link::all();
        return view('backend.links.index', compact('links'));
    }

    public function create()
    {
        return view('backend.links.create');
    }

    public function store(Request $request)
    {
        $image = $request->file('img');
        $name_gen = date('Y-m-d') . 'Backend' .$image->getClientOriginalName();
        Image::make($image)->resize(700,700)->save('upload/links/'.$name_gen);
        $save_url = 'upload/links/'.$name_gen;

        Link::insert([
            'title_ru' => $request->title_ru,
            'title_tj' => $request->title_tj,
            'title_en' => $request->title_en,
            'url' => $request->url,
            'img' =>$save_url,
            'status' => $request->status,
            'position' => $request->position,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' =>'Ссылка успешно добавлена',
            'alert-type'=> 'success'
        );
        return redirect()->route('all.links')->with($notification);
    }

    public function show(Link $link)
    {
        $links = Link::orderBy('id', 'asc')->get();
        return view('backend.links.show', compact('links'));
    }

    public function edit(Link $link, $id)
    {
        $links = Link::where('id',$id)->first();
        return view('backend.links.edit', compact('links'));
    }

  public function update(Request $request, Link $link)
{
    $links_id = $request->id;
    $oldLink = Link::findOrFail($links_id);

    if ($request->file('img')) {
        // Удаление старого изображения
        $oldImagePath = public_path($oldLink->img);
        if (file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }

        // Загрузка нового изображения
        $image = $request->file('img');
        $name_gen = date('Y-m-d') . 'Backend' . $image->getClientOriginalName();
        Image::make($image)->resize(700, 700)->save('upload/links/' . $name_gen);
        $save_url = 'upload/links/' . $name_gen;

        // Обновление записи
        $oldLink->update([
            'title_ru' => $request->title_ru,
            'title_tj' => $request->title_tj,
            'title_en' => $request->title_en,
            'url' => $request->url,
            'img' => $save_url,
            'status' => $request->status,
            'position' => $request->position,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Ссылка успешно обновлена с новым изображением',
            'alert-type' => 'success'
        );
        return redirect()->route('all.links')->with($notification);
    } else {
        // Обновление без нового изображения
        $oldLink->update([
            'title_ru' => $request->title_ru,
            'title_tj' => $request->title_tj,
            'title_en' => $request->title_en,
            'url' => $request->url,
            'status' => $request->status,
            'position' => $request->position,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Ссылка успешно обновлена',
            'alert-type' => 'success'
        );
        return redirect()->route('all.links')->with($notification);
    }
}


  public function delete($id)
{
    $link = Link::findOrFail($id);
    $imagePath = public_path($link->img);// Получаем абсолютный путь к изображению
    if (file_exists($imagePath)) {    // Проверяем, существует ли файл перед удалением
        unlink($imagePath);
    }

    $link->delete();
    $notification = array(
        'message' => 'Ссылка успешно удалена',
        'alert-type' => 'success'
    );
    return redirect()->route('all.links')->with($notification);
}


}
