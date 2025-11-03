<?php

namespace App\Mail;

use App\Models\ServiceRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ServiceRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $request;

    public function __construct(ServiceRequest $request)
    {
        $this->request = $request;
    }

    public function build()
    {
        return $this->subject('Новая заявка на услугу')
            ->view('emails.service_request');
    }
}
