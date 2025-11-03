<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ServiceRequestMail;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ServiceRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'fio' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'service_id' => 'required|integer|exists:services,id',
            'comment' => 'nullable|string|max:1000',
        ]);

        $newRequest = ServiceRequest::create($request->all());

        // 📧 Отправляем письмо админу
        $adminEmail = config('mail.admin_address', 'admin@example.com');
        Mail::to($adminEmail)->send(new ServiceRequestMail($newRequest));

        return response()->json(['success' => true]);
    }
}
