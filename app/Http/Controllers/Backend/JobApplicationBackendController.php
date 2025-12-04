<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class JobApplicationBackendController extends Controller
{
    public function index()
    {
        $applications = JobApplication::with('job')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('backend.job_applications.index', compact('applications'));
    }

    public function show(JobApplication $application)
    {
        $application->load('job');
        return view('backend.job_applications.show', compact('application'));
    }

    public function updateStatus(Request $request, JobApplication $application)
    {
        $request->validate([
            'status' => 'required|in:new,reviewed,accepted,rejected',
            'admin_notes' => 'nullable|string|max:5000'
        ]);

        $application->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes
        ]);

        return redirect()->back()->with('success', 'Статус заявки обновлен');
    }

    public function destroy(JobApplication $application)
    {
        // Удаление файлов
        if ($application->resume && File::exists(public_path($application->resume))) {
            File::delete(public_path($application->resume));
        }

        if ($application->additional_files && is_array($application->additional_files)) {
            foreach ($application->additional_files as $file) {
                if ($file && File::exists(public_path($file))) {
                    File::delete(public_path($file));
                }
            }
        }

        $application->delete();

        return redirect()->route('backend.applications.index')->with('success', 'Заявка удалена');
    }

    public function downloadResume(JobApplication $application)
    {
        if (!$application->resume || !file_exists(public_path($application->resume))) {
            abort(404, 'Файл не найден');
        }

        return response()->download(public_path($application->resume));
    }

    public function downloadAttachment(JobApplication $application, $index)
    {
        $files = $application->additional_files ?? [];

        if (!isset($files[$index]) || !file_exists(public_path($files[$index]))) {
            abort(404, 'Файл не найден');
        }

        return response()->download(public_path($files[$index]));
    }
}