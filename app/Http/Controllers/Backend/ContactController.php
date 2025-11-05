<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // Показ всех сообщений в админке
    public function index()
    {
        $contacts = Contact::latest()->paginate(10);
        return view('backend.contacts.index', compact('contacts'));
    }

    // Хранение нового сообщения
    public function store(ContactRequest $request)
    {
        $contact = Contact::create($request->validated());

        // Отправка уведомления на email агентства
        $agencyEmail = config('mail.from.address') ?? 'agency@example.com';
        Mail::to($agencyEmail)->send(new ContactMail($contact));

        return back()->with('success', 'Ваше сообщение успешно отправлено!');
    }

    // Просмотр одного сообщения
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('backend.contacts.show', compact('contact'));
    }

    // Удаление
    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->route('contacts.index')->with('success', 'Сообщение удалено.');
    }
}
