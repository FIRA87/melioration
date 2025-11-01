<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{

    public function ruLang(){
        session()->get('lang');
        session()->forget('lang');
        Session::put('lang', 'ru');
        return redirect()->back();
    }

    public function enLang(){
        session()->get('lang');
        session()->forget('lang');
        Session::put('lang', 'en');
        return redirect()->back();
    }


    public function tjLang(){
        session()->get('lang');
        session()->forget('lang');
        Session::put('lang', 'tj');
        return redirect()->back();
    }

}
