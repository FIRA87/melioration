<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeaderRequest;
use App\Models\Leader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class LeaderController extends Controller
{
    public function index()
    {
        $leaders = Leader::latest()->get();
        return view('backend.leader.index', compact('leaders'));
    }

    public function create()
    {
        return view('backend.leader.create');
    }

    public function store(LeaderRequest $request)
    {
        $data = $request->validated();

        // Картинка
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_gen = now()->format('d-m-Y-H-i-s') . '_' . $image->getClientOriginalName();
            $path = public_path('upload/leaders');
            if (!File::exists($path)) File::makeDirectory($path, 0777, true);
            Image::make($image)->resize(400, 400)->save($path . '/' . $name_gen);
            $imagePath = 'upload/leaders/' . $name_gen;
        }

        $slug = Str::slug($data['title_en'] ?? $data['title_tj'] ?? $data['title_ru'] ?? 'leader', '-');

        Leader::create([
            'title_ru' => $data['title_ru'] ?? null,
            'title_tj' => $data['title_tj'] ?? null,
            'title_en' => $data['title_en'] ?? null,
            'slug' => $slug,
            'image' => $imagePath,
            'text_ru' => $data['text_ru'] ?? null,
            'text_tj' => $data['text_tj'] ?? null,
            'text_en' => $data['text_en'] ?? null,
            'status' => $data['status'] ?? 1,
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'working_days' => $data['working_days'] ?? null,
            'position_ru' => $data['position_ru'] ?? null,
            'position_tj' => $data['position_tj'] ?? null,
            'position_en' => $data['position_en'] ?? null,
            'sort' => $data['sort'] ?? 0,
        ]);

        return redirect()->route('leader.index')->with([
            'message' => 'Руководитель добавлен!',
            'alert-type' => 'success'
        ]);
    }

    public function edit($id)
    {
        $leader = Leader::findOrFail($id);
        return view('backend.leader.edit', compact('leader'));
    }

    public function update(LeaderRequest $request, $id)
    {
        $data = $request->validated();
        $leader = Leader::findOrFail($id);

        $status = $request->has('status') ? 1 : 0;

        $imagePath = $leader->image;
        if ($request->hasFile('image')) {
            if ($leader->image && File::exists(public_path($leader->image))) {
                File::delete(public_path($leader->image));
            }
            $image = $request->file('image');
            $name_gen = now()->format('d-m-Y-H-i-s') . '_' . $image->getClientOriginalName();
            $path = public_path('upload/leaders');
            if (!File::exists($path)) File::makeDirectory($path, 0777, true);
            Image::make($image)->resize(400, 400)->save($path . '/' . $name_gen);
            $imagePath = 'upload/leaders/' . $name_gen;
        }

        $slug = $data['slug'] ?? Str::slug($data['title_en'] ?? $data['title_tj'] ?? $data['title_ru'] ?? 'leader', '-');

        $leader->update([
            'title_ru' => $data['title_ru'] ?? null,
            'title_tj' => $data['title_tj'] ?? null,
            'title_en' => $data['title_en'] ?? null,
            'text_ru' => $data['text_ru'] ?? null,
            'text_tj' => $data['text_tj'] ?? null,
            'text_en' => $data['text_en'] ?? null,
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'working_days' => $data['working_days'] ?? null,
            'position_ru' => $data['position_ru'] ?? null,
            'position_tj' => $data['position_tj'] ?? null,
            'position_en' => $data['position_en'] ?? null,
            'status' => $data['status'] ?? 0,
            'slug' => $slug,
            'image' => $imagePath,
            'sort' => $data['sort'] ?? 0,
        ]);

        return redirect()->route('leader.index')->with([
            'message' => 'Данные обновлены',
            'alert-type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        $leader = Leader::findOrFail($id);
        if ($leader->image && File::exists(public_path($leader->image))) {
            File::delete(public_path($leader->image));
        }
        $leader->delete();

        return redirect()->back()->with('success', 'Удалено!');
    }
}
