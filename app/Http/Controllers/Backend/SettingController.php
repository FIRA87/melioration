<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\Websitemail;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function siteIndex()
    {
        $settings = Setting::find(1);
        return view('backend.settings.data', compact('settings'));
    }

    public function siteUpdate(Request $request)
    {
        $setting_id = $request->id;
       Setting::findOrFail($setting_id)->update([
            'street_ru' => $request->street_ru,
            'street_tj' => $request->street_tj,
            'street_en' => $request->street_en,
            'phone' => $request->phone,
            'email' => $request->email,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'telegram' => $request->telegram,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
            'contact_title' => $request->contact_title,
            'contact_detail' => $request->contact_detail,
            'contact_map' => $request->contact_map,
        ]);
        $notification = array(
            'message' =>'Настройка успешно обновлена',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }

  //=============ADMIN CONTROLLER CONTACT======================//
    public function contact() {
        $siteSetting = Setting::with('Language')->get();
        return view('backend.settings.data', compact('siteSetting'));
    }

    public function contact_update(Request $request){
        $request->validate([
            'contact_title' =>'required',
        ]);

        $page = Setting::where('id',$request->id)->first();
        $page->contact_title = $request->contact_title;
        $page->contact_map = $request->contact_map;
        $page->contact_detail = $request->contact_detail;
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
