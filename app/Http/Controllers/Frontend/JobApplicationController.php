<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobApplicationRequest;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class JobApplicationController extends Controller
{
    // Показать все активные вакансии
    public function index()
    {
        $jobs = Job::where('is_active', true)
            ->where(function($query) {
                $query->whereNull('end_date')
                      ->orWhere('end_date', '>=', now());
            })
            ->orderBy('sort')
            ->orderByDesc('id')
            ->get();

        return view('frontend.jobs.index', compact('jobs'));
    }

    // Показать детали вакансии
    public function show($slug)
    {
        $job = Job::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('frontend.jobs.show', compact('job'));
    }

    // Форма подачи заявки
    public function apply($slug)
    {
        $job = Job::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('frontend.jobs.apply', compact('job'));
    }

    // Сохранение заявки
    public function submitApplication(JobApplicationRequest $request)
    {
        $data = $request->validated();

        // Загрузка резюме
        $resumePath = null;
        if ($request->hasFile('resume')) {
            $file = $request->file('resume');
            $name = now()->format('Ymd_His') . '_' . uniqid() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $dest = public_path('upload/applications/resumes');
            if (!File::exists($dest)) File::makeDirectory($dest, 0777, true, true);
            $file->move($dest, $name);
            $resumePath = 'upload/applications/resumes/' . $name;
        }

        // Загрузка дополнительных файлов
        $additionalFiles = [];
        if ($request->hasFile('additional_files')) {
            $attachDir = public_path('upload/applications/attachments');
            if (!File::exists($attachDir)) File::makeDirectory($attachDir, 0777, true, true);
            foreach ($request->file('additional_files') as $file) {
                $name = now()->format('Ymd_His') . '_' . uniqid() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $file->move($attachDir, $name);
                $additionalFiles[] = 'upload/applications/attachments/' . $name;
            }
        }

        // Создание заявки
        $application = JobApplication::create([
            'job_id' => $data['job_id'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'cover_letter' => $data['cover_letter'] ?? null,
            'resume' => $resumePath,
            'additional_files' => $additionalFiles ?: null,
            'status' => 'new',
        ]);

        // Отправка email уведомления (опционально)
        // $this->sendNotification($application);

        return redirect()->route('frontend.jobs.index')->with('success', 'Ваша заявка успешно отправлена! Мы свяжемся с вами в ближайшее время.');
    }

    // Опциональный метод для отправки email
    private function sendNotification($application)
    {
        // Здесь можно настроить отправку email
        // Mail::to('hr@example.com')->send(new NewJobApplication($application));
    }
}