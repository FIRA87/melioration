<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentRequest;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::orderByDesc('id')->get();
        return view('backend.documents.index', compact('documents'));
    }

    public function create()
    {
        return view('backend.documents.create');
    }

    public function store(DocumentRequest $request)
    {
        $data = $request->validated();

        // Загрузка файла
        $filePath = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $name = now()->format('Ymd_His') . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $dest = public_path('upload/documents');
            if (!File::exists($dest)) File::makeDirectory($dest, 0777, true, true);
            $file->move($dest, $name);
            $filePath = 'upload/documents/' . $name;
        }

        Document::create([
            'title_tj' => $data['title_tj'],
            'title_ru' => $data['title_ru'] ?? null,
            'title_en' => $data['title_en'] ?? null,
            'description_tj' => $data['description_tj'] ?? null,
            'description_ru' => $data['description_ru'] ?? null,
            'description_en' => $data['description_en'] ?? null,
            'file_path' => $filePath,
            'published_at' => $data['published_at'] ?? null,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('documents.index')->with('success', 'Документ добавлен');
    }

    public function edit(Document $document)
    {
        return view('backend.documents.edit', compact('document'));
    }

    public function update(DocumentRequest $request, Document $document)
    {
        $data = $request->validated();

        // Загрузка нового файла
        if ($request->hasFile('file')) {
            if ($document->file_path && File::exists(public_path($document->file_path))) {
                File::delete(public_path($document->file_path));
            }
            $file = $request->file('file');
            $name = now()->format('Ymd_His') . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $dest = public_path('upload/documents');
            if (!File::exists($dest)) File::makeDirectory($dest, 0777, true, true);
            $file->move($dest, $name);
            $document->file_path = 'upload/documents/' . $name;
        }

        $document->update([
            'title_tj' => $data['title_tj'],
            'title_ru' => $data['title_ru'] ?? null,
            'title_en' => $data['title_en'] ?? null,
            'description_tj' => $data['description_tj'] ?? null,
            'description_ru' => $data['description_ru'] ?? null,
            'description_en' => $data['description_en'] ?? null,
            'published_at' => $data['published_at'] ?? null,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        $document->save();

        return redirect()->route('documents.index')->with('success', 'Документ обновлен');
    }

    public function destroy(Document $document)
    {
        if ($document->file_path && File::exists(public_path($document->file_path))) {
            File::delete(public_path($document->file_path));
        }

        $document->delete();

        return redirect()->route('documents.index')->with('success', 'Документ удален');
    }

    public function download(Document $document)
    {
        if (!$document->file_path || !File::exists(public_path($document->file_path))) {
            abort(404);
        }
        return response()->download(public_path($document->file_path));
    }
}
