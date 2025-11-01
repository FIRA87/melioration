<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function userDashboard(){
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.users.dashboard', compact('userData'));
    }

    public function userProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/images/users/'.$data->photo));
            $filename = date('Y-m-d').$file->getClientOriginalName();
            $file->move(public_path('upload/images/users/'),$filename);
            $data['photo'] = $filename;
        }
        $data->save();
        return redirect()->back()->with("status", 'Профиль успешно обновлен');
    }

    public function userLogout(Request $request) {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with("status", 'Пользователь успешно вышел из системы');
    }

    public function changePassword() {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.users.change_password', compact('userData'));
    }

    public function userChangePassword(Request $request)
    {
        $request->validate([
            'old_password'  => 'required',
            'new_password'  => 'required|confirmed',
        ]);

        // Match The Old Password
        if(!Hash::check($request->old_password, auth::user()->password)) {
            return redirect()->back()->with('error', "Старый пароль не подходит! ");
        }

        // Update New Password
        User::whereId(auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        return back()->with('status', "Пароль успешно изменен");
    }


}
