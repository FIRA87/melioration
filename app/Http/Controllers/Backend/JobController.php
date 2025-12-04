<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobRequest;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Http\JsonResponse;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::orderBy('sort')->orderByDesc('id')->get();
        return view('backend.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('backend.jobs.create');
    }

    public function store(JobRequest $request)
    {
        $data = $request->validated();

        // Slug
        $titleForSlug = $data['title_en'] ?? $data['title_tj'] ?? $data['title_ru'] ?? 'job';
        $slug = $data['slug'] ?? Str::slug($titleForSlug, '-');

        // Upload image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $name = now()->format('Ymd_His') . '_' . preg_replace('/\s+/', '_', $img->getClientOriginalName());
            $dest = public_path('upload/jobs');
            if (!File::exists($dest)) File::makeDirectory($dest, 0777, true, true);
            Image::make($img)->resize(1200, 800)->save($dest . '/' . $name);
            $imagePath = 'upload/jobs/' . $name;
        }

        // Upload attachments
        $attachments = [];
        if ($request->hasFile('attachments')) {
            $attachDir = public_path('upload/jobs/attachments');
            if (!File::exists($attachDir)) File::makeDirectory($attachDir, 0777, true, true);
            foreach ($request->file('attachments') as $file) {
                $name = now()->format('Ymd_His') . '_' . uniqid() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $file->move($attachDir, $name);
                $attachments[] = 'upload/jobs/attachments/' . $name;
            }
        }

        $job = Job::create([
            'title_ru' => $data['title_ru'] ?? null,
            'title_tj' => $data['title_tj'],
            'title_en' => $data['title_en'] ?? null,
            'slug' => $slug,
            'image' => $imagePath,
            'description_ru' => $data['description_ru'] ?? null,
            'description_tj' => $data['description_tj'] ?? null,
            'description_en' => $data['description_en'] ?? null,
            'requirements_ru' => $data['requirements_ru'] ?? null,
            'requirements_tj' => $data['requirements_tj'] ?? null,
            'requirements_en' => $data['requirements_en'] ?? null,
            'location' => $data['location'] ?? null,
            'salary' => $data['salary'] ?? null,
            'start_date' => $data['start_date'] ?? null,
            'end_date' => $data['end_date'] ?? null,
            'attachments' => $attachments ?: null,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'sort' => $data['sort'] ?? 0,
        ]);

        return redirect()->route('admin.jobs.index')->with('success', 'Вакансия добавлена');
    }

    public function edit(Job $job)
    {
        return view('backend.jobs.edit', compact('job'));
    }

    public function update(JobRequest $request, Job $job)
    {
        $data = $request->validated();

        // Slug
        $titleForSlug = $data['title_en'] ?? $data['title_tj'] ?? $data['title_ru'] ?? 'job';
        $slug = $data['slug'] ?? Str::slug($titleForSlug, '-');

        // Update image
        $imagePath = $job->image;
        if ($request->hasFile('image')) {
            if ($job->image && File::exists(public_path($job->image))) File::delete(public_path($job->image));
            $img = $request->file('image');
            $name = now()->format('Ymd_His') . '_' . preg_replace('/\s+/', '_', $img->getClientOriginalName());
            $dest = public_path('upload/jobs');
            if (!File::exists($dest)) File::makeDirectory($dest, 0777, true, true);
            Image::make($img)->resize(1200, 800)->save($dest . '/' . $name);
            $imagePath = 'upload/jobs/' . $name;
        }

        // Update attachments
        $attachments = $job->attachments ?? [];

        if ($request->filled('replace_attachments') && $request->boolean('replace_attachments')) {
            foreach ($attachments as $filePath) {
                $full = public_path($filePath);
                if (File::exists($full)) File::delete($full);
            }
            $attachments = [];
        }

        if ($request->hasFile('attachments')) {
            $attachDir = public_path('upload/jobs/attachments');
            if (!File::exists($attachDir)) File::makeDirectory($attachDir, 0777, true, true);
            foreach ($request->file('attachments') as $file) {
                $name = now()->format('Ymd_His') . '_' . uniqid() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $file->move($attachDir, $name);
                $attachments[] = 'upload/jobs/attachments/' . $name;
            }
        }

        $job->update([
            'title_ru' => $data['title_ru'] ?? null,
            'title_tj' => $data['title_tj'],
            'title_en' => $data['title_en'] ?? null,
            'slug' => $slug,
            'image' => $imagePath,
            'description_ru' => $data['description_ru'] ?? null,
            'description_tj' => $data['description_tj'] ?? null,
            'description_en' => $data['description_en'] ?? null,
            'requirements_ru' => $data['requirements_ru'] ?? null,
            'requirements_tj' => $data['requirements_tj'] ?? null,
            'requirements_en' => $data['requirements_en'] ?? null,
            'location' => $data['location'] ?? null,
            'salary' => $data['salary'] ?? null,
            'start_date' => $data['start_date'] ?? null,
            'end_date' => $data['end_date'] ?? null,
            'attachments' => $attachments,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'sort' => $data['sort'] ?? 0,
        ]);

        return redirect()->route('admin.jobs.index')->with('success', 'Вакансия обновлена');
    }

    public function destroy(Job $job)
    {
        if ($job->image && File::exists(public_path($job->image))) File::delete(public_path($job->image));
        if ($job->attachments && is_array($job->attachments)) {
            foreach ($job->attachments as $file) {
                if ($file && File::exists(public_path($file))) File::delete(public_path($file));
            }
        }

        $job->delete();

        return redirect()->route('admin.jobs.index')->with('success', 'Вакансия удалена');
    }

    public function downloadAttachment(Job $job, $index)
    {
        $attachments = $job->attachments ?? [];

        if (!isset($attachments[$index])) {
            abort(404, 'Файл не найден');
        }

        $filePath = public_path($attachments[$index]);

        if (!file_exists($filePath)) {
            abort(404, 'Файл отсутствует на сервере');
        }

        return response()->download($filePath);
    }


    public function deleteAttachment(Request $request, Job $job)
    {
        $index = $request->input('index');
        $attachments = $job->attachments ?? [];

        if (!isset($attachments[$index])) {
            return response()->json(['success' => false, 'message' => 'Вложение не найдено']);
        }

        $file = public_path($attachments[$index]);
        if (\Illuminate\Support\Facades\File::exists($file)) {
            \Illuminate\Support\Facades\File::delete($file);
        }

        unset($attachments[$index]);
        $job->attachments = array_values($attachments);
        $job->save();

        return response()->json(['success' => true, 'message' => 'Файл удалён', 'newCount' => count($attachments)]);
    }








}
