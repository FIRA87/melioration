<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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

    public function storeVideo(Request $request){

        $image = $request->file('caption');
        $name_gen = date('Y-m-d') . 'Backend' .$image->getClientOriginalName();
        Image::make($image)->resize(701,701)->save('upload/video/'.$name_gen);
        $save_url = 'upload/video/'.$name_gen;

        Video::insert([
            'title_ru' => $request->title_ru,
            'title_tj' => $request->title_tj,
            'title_en' => $request->title_en,
            'video_url' => $request->video_url,
            'caption' =>$save_url,
            'status' => $request->status,
            'position' => $request->position,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' =>'Видео успешно добавлено',
            'alert-type'=> 'success'
        );
        return redirect()->route('all.video')->with($notification);
    }

    public function editVideo($id){
        $video = Video::where('id',$id)->first();
        return view('backend.videos.edit', compact('video'));
    }

    public function updateVideo(Request $request){

        $video_id = $request->id;
        if($request->file('caption')) {
            $image = $request->file('caption');
            $name_gen = date('Y-m-d') . 'Backend' .$image->getClientOriginalName();
            Image::make($image)->resize(701,701)->save('upload/video/'.$name_gen);
            $save_url = 'upload/video/'.$name_gen;

            Video::findOrFail($video_id)->update([
                'title_ru' => $request->title_ru,
                'title_tj' => $request->title_tj,
                'title_en' => $request->title_en,
                'video_url' => $request->video_url,
                'caption' =>$save_url,
                'status' => $request->status,
                'position' => $request->position,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' =>'Видео успешно обновлено с изображением',
                'alert-type'=> 'success'
            );
            return redirect()->route('all.video')->with($notification);
        } else {
            Video::findOrFail($video_id)->update([
                'title_ru' => $request->title_ru,
                'title_tj' => $request->title_tj,
                'title_en' => $request->title_en,
                'video_url' => $request->video_url,
                'status' => $request->status,
                'position' => $request->position,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' =>'Видео успешно обновлено',
                'alert-type'=> 'success'
            );
            return redirect()->route('all.video')->with($notification);
        }
    }

    public function deleteVideo($id){
        $videoData = Video::where('id', $id)->first();
        $img = $videoData->caption;
        unlink($img);

        Video::findOrFail($id)->delete();

        $notification = array(
            'message' =>'Видео успешно удалено',
            'alert-type'=> 'success'
        );
        return redirect()->route('all.video')->with($notification);
    }


}
