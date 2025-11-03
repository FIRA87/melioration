<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Requests\VideoRequest;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function allVideo()
    {
        $videos = Video::all();
        return view('backend.videos.index', compact('videos'));
    }

    public function show(){
        $videos = Video::orderBy('id', 'asc')->get();
        return view('backend.videos.show', compact('videos'));
    }

    public function addVideo(){
        return view('backend.videos.create');
    }

    public function storeVideo(VideoRequest $request)
    {
        $data = $request->validated();

        $save_url = null;

        if ($request->hasFile('caption')) {
            $image = $request->file('caption');
            $name_gen = date('Y-m-d') . $image->getClientOriginalName();
            Image::make($image)->resize(701, 701)->save('upload/video/' . $name_gen);
            $save_url = 'upload/video/' . $name_gen;
        }

        Video::create([
            'title_ru' => $data['title_ru'],
            'title_tj' => $data['title_tj'] ?? null,
            'title_en' => $data['title_en'],
            'video_url' => $data['video_url'],
            'caption' => $save_url,
            'status' => $data['status'] ?? 1,
            'position' => $data['position'] ?? 0,
        ]);

        return redirect()->route('all.video')->with([
            'message' => 'Видео успешно добавлено',
            'alert-type' => 'success'
        ]);
    }


    public function editVideo($id){
        $video = Video::where('id',$id)->first();
        return view('backend.videos.edit', compact('video'));
    }

    public function updateVideo(VideoRequest $request, Video $video)
    {
        $data = $request->validated();

        $updateData = [
            'title_ru' => $data['title_ru'],
            'title_tj' => $data['title_tj'] ?? null,
            'title_en' => $data['title_en'],
            'video_url' => $data['video_url'],
            'status' => $data['status'],
            'position' => $data['position'] ?? 0,
        ];

        if ($request->hasFile('caption')) {
            if ($video->caption && file_exists(public_path($video->caption))) {
                unlink(public_path($video->caption));
            }

            $image = $request->file('caption');
            $name_gen = date('Y-m-d') . '_video_' . $image->getClientOriginalName();
            Image::make($image)->resize(701, 701)->save('upload/video/' . $name_gen);
            $updateData['caption'] = 'upload/video/' . $name_gen;
        }

        $video->update($updateData);

        return redirect()->route('all.video')->with([
            'message' => 'Видео успешно обновлено',
            'alert-type' => 'success'
        ]);
    }




    public function deleteVideo($id)
    {
        $video = Video::findOrFail($id);

        if ($video->caption && file_exists(public_path($video->caption))) {
            unlink(public_path($video->caption));        }

        $video->delete();

        return redirect()->route('all.video')->with([
            'message' => 'Видео успешно удалено',
            'alert-type' => 'success'
        ]);
    }



}
