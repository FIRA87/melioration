<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\Websitemail;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Requests\SettingRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\Contact;

class SettingController extends Controller
{

    public function siteIndex()
    {
        $settings = Setting::first();

        if (!$settings) {
            // Если таблица пустая — создаём запись по умолчанию
            $settings =Setting::create([
                'street_ru' => '',
                'street_tj' => '',
                'street_en' => '',
                'title_ru' => '',
                'title_tj' => '',
                'title_en' => '',
                'phone' => '',
                'email' => '',
                'facebook' => '',
                'twitter' => '',
                'telegram' => '',
                'instagram' => '',
                'youtube' => '',
                'contact_title' => '',
                'contact_detail' => '',
                'contact_map' => '',
                'logo' => '',
            ]);
        }
        return view('backend.settings.data', compact('settings'));
    }

    public function siteUpdate(Request $request)
    {
        $setting = Setting::firstOrFail();

        $data = $request->validate([
            'street_ru' => 'nullable|string|max:255',
            'street_tj' => 'nullable|string|max:255',
            'street_en' => 'nullable|string|max:255',
            'title_tj' => 'nullable|string|max:255',
            'title_ru' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'telegram' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'contact_title' => 'nullable|string|max:255',
            'contact_detail' => 'nullable|string|max:255',
            'contact_map' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:5120',
        ]);

        // обработка логотипа
        if ($request->hasFile('logo')) {
            // удалить старый логотип если он есть
            if ($setting->logo && File::exists(public_path($setting->logo))) {
                File::delete(public_path($setting->logo));
            }

            $file = $request->file('logo');
            $filename = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $path = 'upload/logo/';
            $file->move(public_path($path), $filename);

            $data['logo'] = $path . $filename;
        }

        $setting->update($data);

        return redirect()->back()->with([
            'message' => 'Настройки успешно обновлены',
            'alert-type' => 'success',
        ]);
    }


    // Например, в контроллере админки
    public function contacts()
    {
        $contacts = Contact::latest()->paginate(20);
        return view('backend.contacts.index', compact('contacts'));
    }


  //=============ADMIN CONTROLLER CONTACT======================//
    public function contact() {
        $siteSetting = Setting::with('Language')->get();
        return view('backend.settings.data', compact('siteSetting'));
    }

    public function contact_update(SettingRequest $request){
        $data = $request->validated();

        $page = Setting::where('id',$request->id)->first();
        $page->contact_title = $data['contact_title'];
        $page->contact_map = $data['contact_map'] ?? null;
        $page->contact_detail = $data['contact_detail'] ?? null;
        $page->update();

        return redirect()->route('contact_page')->with('success', 'Данные успешно обновлены.');
    }

 //=============END ADMIN CONTROLLER CONTACT======================//

//==================FRONT CONTROLLER CONTACT======================//
    public function contactIndex() {
        return view('frontend.news.contact');
    }

  public function send_email(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:50',
            'email'   => 'required|email',
            'message' => 'required|string',
        ], [
            'name.required'    => 'Укажите Ф.И.О.',
            'phone.required'   => 'Укажите телефон',
            'email.required'   => 'Укажите email',
            'email.email'      => 'Неверный формат email',
            'message.required' => 'Напишите сообщение',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', 'Пожалуйста, исправьте ошибки в форме')
                ->with('alert-type', 'warning');
        }

        // Определяем язык
        $locale = session('locale', 'ru');

        // Сохраняем в базу
        Contact::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'message_ru'    => $locale == 'ru' ? $request->message : null,
            'message_tj'    => $locale == 'tj' ? $request->message : null,
            'message_en'    => $locale == 'en' ? $request->message : null,
            'title_ru'      => 'Обращение от ' . $request->name,
            'title_tj'      => 'Муроҷиат аз ' . $request->name,
            'title_en'      => 'Message from ' . $request->name,
            'status'        => true,
        ]);

        // Отправка письма админу (оставляем как есть)
        $admin = Setting::first();
        $subject = 'Новое обращение с сайта';
        $mailMessage = '<p>Новое обращение:</p>
            <table border="1" cellpadding="10" style="border-collapse: collapse;">
                <tr><th>Имя</th><td>'.$request->name.'</td></tr>
                <tr><th>Телефон</th><td>'.$request->phone.'</td></tr>
                <tr><th>Email</th><td>'.$request->email.'</td></tr>
                <tr><th>Сообщение</th><td>'.nl2br(e($request->message)).'</td></tr>
                <tr><th>Дата</th><td>'.now()->format('d.m.Y H:i').'</td></tr>
            </table>';

        Mail::to($admin->email)->send(new Websitemail($subject, $mailMessage));

 
        $notification = [
            'message' => 'Ваше сообщение успешно отправлено! Спасибо за обращение.',
            'alert-type' => 'success'
        ];

        // логируем, чтобы убедиться, что flash сохранился
        \Log::info('Contact form: flash message set', $notification);

        // редирект на именованный роут главной (если есть)
        // либо redirect('/') — оба работают, но именованный надёжнее
        return redirect()->route('index')->with($notification);



        // return redirect()->back()
        //     ->with('message', 'Ваше сообщение успешно отправлено! Спасибо за обращение.')
        //     ->with('alert-type', 'success');
    }
//==================END FRONT CONTROLLER======================//


}
