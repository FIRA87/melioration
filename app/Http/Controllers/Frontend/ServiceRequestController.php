<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ServiceRequestMail;

class ServiceRequestController extends Controller
{
    /**
     * Показать страницу услуг
     */
    public function index()
    {
        $services = Service::where('status', 1)->orderBy('id', 'asc')->get();
        return view('frontend.services', compact('services'));
    }

    /**
     * Сохранить запрос на услугу
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'fio' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'service_id' => 'required|integer|exists:services,id',
            'comment' => 'nullable|string|max:1000',
        ], [
            'fio.required' => 'ФИО обязательно для заполнения',
            'phone.required' => 'Телефон обязателен для заполнения',
            'service_id.required' => 'Выберите услугу',
            'service_id.exists' => 'Выбранная услуга не существует',
        ]);
        
        if ($validator->fails()) {
            $notification = [
                'message' => 'Пожалуйста, исправьте ошибки в форме',
                'alert-type' => 'error'
            ];
            
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with($notification);
        }
        
        try {
            // Создаём запрос
            $serviceRequest = ServiceRequest::create([
                'fio' => $request->fio,
                'phone' => $request->phone,
                'service_id' => $request->service_id,
                'comment' => $request->comment,
            ]);
            
            // Отправляем письмо админу
            $adminEmail = config('mail.admin_address', env('ADMIN_EMAIL', 'admin@example.com'));
            
            try {
                Mail::to($adminEmail)->send(new ServiceRequestMail($serviceRequest));
            } catch (\Exception $e) {
                \Log::error('Ошибка отправки email: ' . $e->getMessage());
            }
            
            $lang = session()->get('lang', 'tj');
            $messages = [
                'ru' => 'Ваш запрос успешно отправлен! Мы свяжемся с вами в ближайшее время.',
                'en' => 'Your request has been sent successfully! We will contact you soon.',
                'tj' => 'Дархости шумо бомуваффақият ирсол шуд! Мо ба зудӣ бо шумо тамос мегирем.'
            ];
            
            $notification = [
                'message' => $messages[$lang] ?? $messages['tj'],
                'alert-type' => 'success'
            ];
            
            return redirect()->back()->with($notification);
            
        } catch (\Exception $e) {
            \Log::error('Service Request Error: ' . $e->getMessage());
            
            $notification = [
                'message' => 'Произошла ошибка при отправке запроса',
                'alert-type' => 'error'
            ];
            
            return redirect()->back()->with($notification);
        }
    }


}