<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class MediaController extends Controller
{
    protected string $basePath = 'upload/media'; // public/upload/media

    public function index(Request $request)
    {
        $path = trim($request->get('path', ''), '/');
        $sort = $request->get('sort', 'name');

        $fullPath = public_path($this->basePath . ($path ? '/' . $path : ''));

        if (! File::exists($fullPath)) {
            File::makeDirectory($fullPath, 0755, true);
        }

        // folders
        $folders = [];
        foreach (File::directories($fullPath) as $dir) {
            $folders[] = [
                'name' => basename($dir),
                'path' => trim(($path ? $path . '/' : '') . basename($dir), '/'),
                'date' => File::lastModified($dir),
            ];
        }

        // files
        $files = [];
        foreach (File::files($fullPath) as $file) {
            $files[] = [
                'name' => $file->getFilename(),
                'path' => asset($this->basePath . ($path ? '/' . $path : '') . '/' . $file->getFilename()),
                'date' => $file->getMTime(),
                'ext'  => strtolower($file->getExtension()),
            ];
        }

        // сортировка
        $cmpName = fn($a,$b) => strcmp(strtolower($a['name']), strtolower($b['name']));
        $cmpDate = fn($a,$b) => $b['date'] <=> $a['date'];
        $cmpType = fn($a,$b) => strcmp($a['ext'] ?? '', $b['ext'] ?? '');

        if ($sort === 'name') {
            usort($folders, $cmpName); usort($files, $cmpName);
        } elseif ($sort === 'date') {
            usort($folders, $cmpDate); usort($files, $cmpDate);
        } else {
            usort($folders, $cmpType); usort($files, $cmpType);
        }

        if ($request->ajax() || $request->get('ajax') == 1) {
            return view('backend.media._content', compact('folders','files','path','sort'))->render();
        }

        return view('backend.media.index', compact('folders','files','path','sort'));
    }

    public function upload(Request $request)
    {
        $path = trim($request->get('path', ''), '/');
        $uploadPath = public_path($this->basePath . ($path ? '/' . $path : ''));

        if (! File::exists($uploadPath)) File::makeDirectory($uploadPath, 0755, true);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $name = $file->getClientOriginalName();
            $target = $uploadPath . '/' . $name;
            if (File::exists($target)) {
                $name = pathinfo($name, PATHINFO_FILENAME) . '_' . time() . '.' . $file->getClientOriginalExtension();
            }
            $file->move($uploadPath, $name);

            return response()->json([
                'success' => true,
                'file' => asset($this->basePath . ($path ? '/' . $path : '') . '/' . $name),
                'name' => $name
            ]);
        }

        return response()->json(['success'=>false], 400);
    }

    public function createFolder(Request $request)
    {
        $path = trim($request->input('path', ''), '/');
        $folderName = trim($request->input('folder_name', ''));

        if ($folderName === '') {
            return response()->json(['success'=>false,'message'=>'Имя папки пустое'], 422);
        }

        $folderName = Str::slug($folderName, '-');
        $fullPath = public_path($this->basePath . ($path ? '/' . $path : '') . '/' . $folderName);

        if (! File::exists($fullPath)) {
            File::makeDirectory($fullPath, 0755, true);
            return response()->json(['success'=>true,'message'=>'Папка создана']);
        }

        return response()->json(['success'=>false,'message'=>'Папка уже существует'], 409);
    }

    public function delete(Request $request)
    {
        $target = trim($request->input('target', ''), '/');
        if ($target === '') {
            return response()->json(['success'=>false,'message'=>'Путь не указан'], 422);
        }

        $fullPath = public_path($this->basePath . '/' . $target);

        Log::info('Media delete requested: ' . $fullPath);

        if (! File::exists($fullPath) && ! File::isDirectory($fullPath)) {
            return response()->json(['success'=>false,'message'=>'Файл/папка не найдены'], 404);
        }

        try {
            if (File::isDirectory($fullPath)) {
                File::deleteDirectory($fullPath);
            } else {
                File::delete($fullPath);
            }
            return response()->json(['success'=>true,'message'=>'Удалено']);
        } catch (\Exception $e) {
            Log::error('Media delete error: '.$e->getMessage());
            return response()->json(['success'=>false,'message'=>$e->getMessage()], 500);
        }
    }

    public function rename(Request $request)
    {
        $old = trim($request->input('old_path', ''), '/');
        $newName = trim($request->input('new_name', ''));

        if ($old === '' || $newName === '') {
            return response()->json(['success'=>false,'message'=>'Параметры не указаны'], 422);
        }

        $oldFull = public_path($this->basePath . '/' . $old);
        $dir = dirname($oldFull);
        $newFull = $dir . '/' . $newName;

        if (! File::exists($oldFull)) {
            return response()->json(['success'=>false,'message'=>'Не найдено'], 404);
        }

        if (File::exists($newFull)) {
            return response()->json(['success'=>false,'message'=>'Имя уже занято'], 409);
        }

        try {
            File::move($oldFull, $newFull);
            return response()->json(['success'=>true,'message'=>'Переименовано']);
        } catch (\Exception $e) {
            Log::error('Media rename error: '.$e->getMessage());
            return response()->json(['success'=>false,'message'=>$e->getMessage()], 500);
        }
    }
}
