<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\President;
use App\Http\Requests\PresidentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PresidentController extends Controller
{
    public function index()
    {
        $presidents = President::orderBy('sort', 'asc')->orderBy('id', 'desc')->get();
        return view('backend.presidents.index', compact('presidents'));
    }

    public function create()
    {
        return view('backend.presidents.create');
    }

    public function store(PresidentRequest $request)
    {
        $data = $request->validated();

        // Обработка изображения
        $save_url = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_gen = now()->format('Ymd_His') . '_' . $image->getClientOriginalName();
            $imagePath = public_path('upload/presidents');
            if (!File::exists($imagePath)) {
                File::makeDirectory($imagePath, 0777, true, true);
            }
            Image::make($image)->resize(400, 400)->save($imagePath . '/' . $name_gen);
            $save_url = 'upload/presidents/' . $name_gen;
        }

        // Генерация slug
        $titleForSlug = $data['title_en'] ?? $data['title_tj'] ?? $data['title_ru'] ?? 'president';
        $slug = Str::slug($titleForSlug, '-');

        President::create([
            'title_ru' => $data['title_ru'] ?? null,
            'title_tj' => $data['title_tj'],
            'title_en' => $data['title_en'] ?? null,
            'slug' => $slug,
            'image' => $save_url,
            'text_ru' => $data['text_ru'] ?? null,
            'text_tj' => $data['text_tj'],
            'text_en' => $data['text_en'] ?? null,
            'status' => $data['status'] ?? 1,
            'sort' => $data['sort'] ?? 0,
        ]);

        return redirect()->route('all.presidents')->with([
            'message' => 'Президент успешно добавлен',
            'alert-type' => 'success'
        ]);
    }

    public function edit($id)
    {
        $president = President::findOrFail($id);
        return view('backend.presidents.edit', compact('president'));
    }

    public function update(PresidentRequest $request)
    {
        $data = $request->validated();
        $president = President::findOrFail($request->id);

        // Обработка статуса
        $status = $request->has('status') ? 1 : 0;

        // Обработка нового изображения
        $save_url = $president->image;
        if ($request->hasFile('image')) {
            if ($president->image && File::exists(public_path($president->image))) {
                File::delete(public_path($president->image));
            }

            $image = $request->file('image');
            $name_gen = now()->format('Ymd_His') . '_' . $image->getClientOriginalName();
            $imagePath = public_path('upload/presidents');
            if (!File::exists($imagePath)) {
                File::makeDirectory($imagePath, 0777, true, true);
            }
            Image::make($image)->resize(400, 400)->save($imagePath . '/' . $name_gen);
            $save_url = 'upload/presidents/' . $name_gen;
        }

        // Генерация slug
        $titleForSlug = $data['title_en'] ?? $data['title_tj'] ?? $data['title_ru'] ?? 'president';
        $slug = $data['slug'] ?? Str::slug($titleForSlug, '-');

        $president->update([
            'title_ru' => $data['title_ru'] ?? null,
            'title_tj' => $data['title_tj'],
            'title_en' => $data['title_en'] ?? null,
            'slug' => $slug,
            'image' => $save_url,
            'text_ru' => $data['text_ru'] ?? null,
            'text_tj' => $data['text_tj'],
            'text_en' => $data['text_en'] ?? null,
            'sort' => $data['sort'] ?? 0,
            'status' => $status, // <- Используем переменную $status
        ]);

        return redirect()->route('all.presidents')->with([
            'message' => 'Президент успешно обновлен',
            'alert-type' => 'success'
        ]);
    }

    public function delete($id)
    {
        $president = President::findOrFail($id);

        if ($president->image && File::exists(public_path($president->image))) {
            File::delete(public_path($president->image));
        }

        $president->delete();

        return redirect()->back()->with([
            'message' => 'Президент успешно удален',
            'alert-type' => 'success'
        ]);
    }
}
