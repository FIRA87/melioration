<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Requests\LinkRequest;

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

    public function store(LinkRequest $request)
    {
        $data = $request->validated();
        
        $image = $request->file('img');
        $name_gen = date('Y-m-d') . 'Backend' .$image->getClientOriginalName();
        Image::make($image)->resize(700,700)->save('upload/links/'.$name_gen);
        $save_url = 'upload/links/'.$name_gen;

        Link::insert([
            'title_ru' => $data['title_ru'],
            'title_tj' => $data['title_tj'] ?? null,
            'title_en' => $data['title_en'],
            'url' => $data['url'],
            'img' => $save_url,
            'status' => $data['status'],
            'position' => $data['position'] ?? null,
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

  public function update(LinkRequest $request, Link $link)
{
    $data = $request->validated();
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
            'title_ru' => $data['title_ru'],
            'title_tj' => $data['title_tj'] ?? null,
            'title_en' => $data['title_en'],
            'url' => $data['url'],
            'img' => $save_url,
            'status' => $data['status'],
            'position' => $data['position'] ?? null,
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
            'title_ru' => $data['title_ru'],
            'title_tj' => $data['title_tj'] ?? null,
            'title_en' => $data['title_en'],
            'url' => $data['url'],
            'status' => $data['status'],
            'position' => $data['position'] ?? null,
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
