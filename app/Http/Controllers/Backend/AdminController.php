<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\News;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->get(); // коллекция
        $activeNews = $news->where('status', 1)->count();       
        $activeSliderNews = $news->where('status', 1)->where('top_slider', 1)->count(); 
        $sliderNews = $news->where('top_slider', 1)->count();   
        $users = User::all(); // коллекция
    
        $user = Auth::user();
        $status = $user->status ?? 'inactive';
    
        return view('admin.index', compact('news', 'status', 'user', 'activeNews', 'activeSliderNews', 'sliderNews', 'users'));
    }


    public function adminLogout(Request $request) {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $notification = array(
            'message' =>'Вы вышли из системы',
            'alert-type'=> 'info'
        );
        return redirect('/')->with($notification);
    }

    public function adminLogin(){
        return view('admin.admin_login');
    }

    public function adminLogoutPage(Request $request) {
        return view('admin.admin_logout');
    }

    public function adminProfile(){
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view', compact('adminData'));
    }

    public function adminProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/images/admin/'.$data->photo));
            $filename = date('Y-m-d') . $file->getClientOriginalName();
            $file->move(public_path('upload/images/admin/'),$filename);
            $data['photo'] = $filename;
        }


        $data->save();
        $notification = array(
            'message' =>'Профиль администратора успешно обновлен',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function adminChangePassword() {

        return view('admin.admin_change_password');
    }

    public function adminUpdatePassword(Request $request)
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

        return back()->with('status', "Password Change Successfully");

    }

    public function allAdmin(){
        $allAdminUsers = User::where('role', 'admin')->latest()->get();
        return view('backend.admin.index', compact('allAdminUsers'));
    }

    public function addAdmin(){
        $roles = Role::all();
        return view('backend.admin.create', compact('roles'));
    }

    public function storeAdmin(Request $request){

     $user = new User();
     $user->username = $request->username;
     $user->name = $request->name;
     $user->phone = $request->phone;
     $user->email = $request->email;
     $user->role = 'admin';
     $user->status = 'inactive';
     $user->password = Hash::make($request->password);
     $user->save();

     if($request->roles){
         $user->assignRole($request->roles);
     }

    $notification = array(
        'message' =>'Новый пользователь успешно создан',
        'alert-type'=> 'success'
    );
        return redirect()->route('all.admin')->with($notification);

    }

    public function editAdmin($id){
        $adminuser = User::findOrFail($id);
         $roles = Role::all();
        return view('backend.admin.edit', compact('adminuser', 'roles'));
    }

    public function updateAdmin(Request $request){
        $admin_id = $request->id;

        $user = User::findOrFail($admin_id);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->role = 'admin';
        $user->status = 'inactive';
        $user->save();
        
        $user->roles()->detach();
        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        $notification = array(
            'message' =>'Пользователь успешно обновлен',
            'alert-type'=> 'success'
        );
        return redirect()->route('all.admin')->with($notification);
    }

    public function deleteAdmin($id)
    {
        User::findOrFail($id)->delete();
        $notification = array(
            'message' =>'Пользователь успешно удален',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function inactiveAdminUser($id){
       User::findorFail($id)->update(['status' => 'inactive']);
        $notification = array(
            'message' =>'Администратор неактивен',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function activeAdminUser($id){
        User::findorFail($id)->update(['status' => 'active']);
        $notification = array(
            'message' =>'Пользователь активен',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }


}
