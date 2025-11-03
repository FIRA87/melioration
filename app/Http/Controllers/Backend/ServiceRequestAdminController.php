<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;

class ServiceRequestAdminController extends Controller
{
    public function index()
    {
        $requests = ServiceRequest::with('service')->latest()->get();
        return view('backend.service_requests.index', compact('requests'));
    }

    public function delete($id)
    {
        ServiceRequest::findOrFail($id)->delete();
        return redirect()->back()->with(['message' => 'Заявка удалена', 'alert-type' => 'success']);
    }
}
