<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\GalleryRequest;


class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::all();
        return view('backend.gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $galleries = Gallery::all();
        return view('backend.gallery.create', compact('galleries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GalleryRequest $request)
    {
        $data = $request->validated();

        if($request->hasFile('cover')) {
            $file = $request->file('cover');
            $imageName = time().'_'.$file->getClientOriginalName();
            $file->move(\public_path('/upload/cover/'), $imageName);

            $gallery = new Gallery([
                'title_ru' => $data['title_ru'],
                'title_tj' => $data['title_tj'] ?? null,
                'title_en' => $data['title_en'],
                'text_ru' => $data['text_ru'] ?? null,
                'text_tj' => $data['text_tj'] ?? null,
                'text_en' => $data['text_en'] ?? null,
                'cover' => $imageName,
            ]);
            $gallery->save();
        }

        if($request->hasFile('images')) {
            $files = $request->file('images');

            foreach($files as $file) {
                $imageName = time().'_'.$file->getClientOriginalName();
                $file->move(\public_path('/upload/gallery'), $imageName);
                Image::create([
                    'gallery_id' => $gallery->id,
                    'image' => $imageName,
                ]);
            }
        }

        $notification = array(
            'message' =>'Галерея успешно добавлена',
            'alert-type'=> 'success'
        );
        return redirect('gallery')->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('backend.gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GalleryRequest $request, $id)
    {
        $data = $request->validated();
        $gallery = Gallery::findOrFail($id);

        // Удаляем старый cover при загрузке нового
        if ($request->hasFile('cover')) {
            $oldCoverPath = public_path('upload/cover/' . $gallery->cover);
            if (File::exists($oldCoverPath)) {
                File::delete($oldCoverPath);
            }

            $file = $request->file("cover");
            $newName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path("upload/cover"), $newName);
            $gallery->cover = $newName;
        }

        $gallery->update([
            'title_ru' => $data['title_ru'],
            'title_tj' => $data['title_tj'] ?? null,
            'title_en' => $data['title_en'],
            'text_ru' => $data['text_ru'] ?? null,
            'text_tj' => $data['text_tj'] ?? null,
            'text_en' => $data['text_en'] ?? null,
            'cover' => $gallery->cover,
        ]);

        if ($request->hasFile("images")) {
            foreach ($request->file("images") as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('upload/gallery'), $imageName);
                Image::create([
                    'gallery_id' => $id,
                    'image' => $imageName,
                ]);
            }
        }

        return redirect('/gallery')->with([
            'message' => 'Изображение успешно обновлено',
            'alert-type' => 'success'
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        if(File::exists("upload/cover/".$gallery->cover)) {
           File::delete("upload/cover/".$gallery->cover);
        }

        $images = Image::where("gallery_id", $gallery->id)->get();
        foreach($images as $image) {
            if(File::exists("upload/gallery/".$image->image)) {
                File::delete("upload/gallery/".$image->image);
            }
        }
        $gallery->delete();
        $notification = array(
            'message' =>'Галерея успешно удалена',
            'alert-type'=> 'success'
        );
        return back()->with($notification);
    }

    public function deleteImage($id){
        $images = Image::findOrFail($id);
        if(File::exists("upload/gallery/".$images->image)) {
            File::delete("upload/gallery/".$images->image);
        }
        $notification = array(
            'message' =>'Изображение успешно удалено',
            'alert-type'=> 'success'
        );
        Image::find($id)->delete();
        return back()->with($notification);
    }

    public function deletecover($id){
        $coverImg = Gallery::findOrFail($id);
        if(File::exists("upload/cover/".$coverImg->cover)) {
            File::delete("upload/cover/".$coverImg->cover);
        }
        $notification = array(
            'message' =>'Обложка успешно удалена',
            'alert-type'=> 'success'
        );
        Gallery::find($id)->delete();
        return back()->with($notification);
    }


    // FRONTEND
    public function galleryDetails($id) {
        $gallery = Gallery::with('images')->where('id',$id)->findOrFail($id);
        return view('frontend.news.gallery_detail',compact('gallery'));
    }// END METHOD

}
