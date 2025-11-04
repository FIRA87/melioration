<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\Websitemail;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Requests\SettingRequest;
use Illuminate\Support\Facades\File;

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
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
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

    public function send_email(Request $request){
        $validator = \Validator::make($request->all(),[
            'name'=>'required',
            'email' => 'required|email',
            'message' => 'required'
        ],[
            'name.required' => 'ERROR_NAME_REQUIRED',
            'email.required' => 'ERROR_EMAIL_REQUIRED',
            'email.email' => 'ERROR_EMAIL_VALID',
            'message.required' => 'ERROR_MESSAGE_REQUIRED'
        ]);
        if(!$validator->passes())
        {
            $notification = array(
                'message' =>'Ошибка!!! Не удалось отправить письмо',
                'alert-type'=> 'warning'
            );
            return redirect()->back()->with($notification);
           // return response()->json(['code'=>0,'error_message'=>$validator->errors()->toArray()]);
        }
        else
        {
            // Send email
            $admin_data = Setting::where('id',1)->first();
            $subject = 'Contact Form Email';
            $message = '<p style="text-align: center; ">Новое Письмо:</p>';
            $message .='<table cellpadding="0" cellspacing="0" border="1" width="500">';
            $message .= '<tr><th>Имя посетителя: </th>'.'<td>'.$request->name.'</td></tr>';
            $message .= '<tr><th>Email: </th>'.'<td>'.$request->email.'</td></tr>';
            $message .= '<tr><th>Сообщение посетителя: </th>'.'<td>'.$request->message.'</td></tr>';
            $message .= '</table>';
            \Mail::to($admin_data->email)->send(new Websitemail($subject,$message));

            $notification = array(
                'message' =>'Письмо отправлено',
                'alert-type'=> 'success'
            );

            return redirect()->back()->with($notification);
           // return response()->json(['code'=>1,'success_message'=>'SUCCESS_CONTACT']);

        }
    }
//==================END FRONT CONTROLLER======================//


}
