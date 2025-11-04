<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class MediaController extends Controller
{
    protected $basePath = 'upload/media';


    public function index(Request $request)
    {


        $path = $request->get('path', '');
        $sort = $request->get('sort', 'name'); // name|date|type
        $fullPath = public_path($this->basePath . '/' . $path);

        if (!File::exists($fullPath)) {
            File::makeDirectory($fullPath, 0755, true);
        }

        $folders = [];
        $files = [];

        foreach (File::directories($fullPath) as $dir) {
            $folders[] = [
                'name' => basename($dir),
                'path' => trim($path . '/' . basename($dir), '/'),
                'date' => File::lastModified($dir)
            ];
        }

        foreach (File::files($fullPath) as $file) {
            $files[] = [
                'name' => $file->getFilename(),
                'path' => asset($this->basePath . '/' . trim($path . '/' . $file->getFilename(), '/')),
                'date' => $file->getMTime(),
                'ext'  => strtolower($file->getExtension())
            ];
        }

        // сортировка
        $sortMap = [
            'name' => fn($a, $b) => strcmp($a['name'], $b['name']),
            'date' => fn($a, $b) => $b['date'] <=> $a['date'],
            'type' => fn($a, $b) => strcmp($a['ext'] ?? '', $b['ext'] ?? ''),
        ];
        usort($folders, $sortMap[$sort]);
        usort($files, $sortMap[$sort]);

        if ($request->ajax()) {
            return view('backend.media.index', compact('folders', 'files', 'path', 'sort'))->render();
        }



    }


    public function upload(Request $request)
    {
        $path = $request->get('path', '');
        $uploadPath = public_path($this->basePath . '/' . $path);

        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $file->move($uploadPath, $filename);

            return response()->json([
                'success' => true,
                'file' => asset($this->basePath . '/' . trim($path, '/') . '/' . $filename),
                'name' => $filename
            ]);
        }

        return response()->json(['success' => false]);
    }


    public function createFolder(Request $request)
    {
        $path = $request->get('path', '');
        $folderName = $request->get('folder_name');
        $fullPath = public_path($this->basePath . '/' . $path . '/' . $folderName);

        if (!File::exists($fullPath)) {
            File::makeDirectory($fullPath, 0755, true);
            return back()->with('message', 'Папка создана!');
        }

        return back()->with('error', 'Папка уже существует!');
    }

    public function delete(Request $request)
    {
        $target = $request->get('target');
        $fullPath = public_path($this->basePath . '/' . $target);

        if (File::isDirectory($fullPath)) {
            File::deleteDirectory($fullPath);
        } elseif (File::exists($fullPath)) {
            File::delete($fullPath);
        }

        return back()->with('message', 'Удалено!');
    }


    public function rename(Request $request)
    {
        $request->validate([
            'old_path' => 'required|string',
            'new_name' => 'required|string',
        ]);

        $old = public_path($this->basePath . '/' . $request->old_path);
        $dir = dirname($old);
        $new = $dir . '/' . $request->new_name;

        if (!File::exists($old)) {
            return back()->with('error', 'Файл не найден');
        }

        File::move($old, $new);
        return back()->with('message', 'Переименование успешно');
    }


}
