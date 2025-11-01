<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    public function allPermission() {
        $permission = Permission::all();
        return view('backend.permission.index', compact('permission'));
    } // END METHOD

    public function addPermission(){
        return view('backend.permission.create');
    }// END METHOD

    public function storePermission(Request $request){

  /*   $role = Permission::create( [
         'name' => $request->name,
        'group_name' => $request->group_name,
    ]);*/

        $role = DB::table('permissions')->insert([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);


        $notification = array(
            'message' =>'Разрешение добавлено успешно',
            'alert-type'=> 'success'
        );
        return redirect()->route('all.permission')->with($notification);
    }// END METHOD

    public function editPermission($id){
        $permission = Permission::findOrFail($id);
        return view('backend.permission.edit', compact('permission'));
    }// END METHOD

    public function updatePermission(Request $request){
        $per_id = $request->id;
         Permission::findOrFail($per_id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);
        $notification = array(
            'message' =>'Разрешение успешно обновлено',
            'alert-type'=> 'success'
        );
        return redirect()->route('all.permission')->with($notification);
    } // END METHOD

    public function deletePermission($id){
       // Permission::findOrFail($id)->delete();
        DB::table('permissions')->where('id', $id)->delete();
        $notification = array(
            'message' =>'Разрешение успешно удалено',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);

    } // END METHOD

//*============================================= ROLE ===============================================================**/
    public function allRole() {
       $roles = Role::all();
        return view('backend.roles.index', compact('roles'));
    } // END METHOD

    public function addRole(){
        return view('backend.roles.create');
    }// END METHOD

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function storeRole(Request $request){
        $role = Role::create([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' =>'Роль добавлена успешно',
            'alert-type'=> 'success'
        );
        return redirect()->route('all.roles')->with($notification);
    }// END METHOD

    public function editRole($id){
        $roles = Role::findOrFail($id);
        return view('backend.roles.edit', compact('roles'));
    }// END METHOD

    public function updateRole(Request $request){
        $role_id = $request->id;
        Role::findOrFail($role_id)->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' =>'Роль успешно обновлена',
            'alert-type'=> 'success'
        );
        return redirect()->route('all.roles')->with($notification);
    } // END METHOD

    public function deleteRole($id){
        DB::table('roles')->where('id', $id)->delete();

        //Role::findOrFail($id)->delete();
        $notification = array(
            'message' =>'Роль успешно удалена',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    } // END METHOD

///==================================ADD ROLE FOR PERMISSION===============================///

    public function addRolePermission(){
        $roles = Role::all();
        $permission = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.roles.add_roles_permission', compact('roles', 'permission', 'permission_groups'));
    } // END METHOD

    public function rolePermissionStore(Request $request){
        $data = array();
        $permissions = $request->permission;

        foreach($permissions as $key => $item) {
                $data['role_id'] = $request->role_id;
                $data['permission_id'] = $item;
                DB::table('role_has_permissions')->insert($data);
        }
        $notification = array(
            'message' =>'Разрешение роли успешно добавлено',
            'alert-type'=> 'success'
        );
        return redirect()->route('all.roles.permission')->with($notification);
    }// END METHOD

    public function allRolePermission(){
        $roles = Role::all();
        return view('backend.roles.all_roles_permissions', compact('roles'));
    }// END METHOD


    public function adminEditRoles($id){
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.roles.role_permission_edit', compact('role', 'permissions', 'permission_groups'));

    }// END METHOD


    public function rolePermissionUpdate(Request $request, $id){
        $role = Role::findOrFail($id);
        $permissions = $request->permission;

        if(!empty($permissions)) {
            $role->syncPermissions($permissions);
        }
        $notification = array(
            'message' =>'Разрешение роли успешно обновлено',
            'alert-type'=> 'success'
        );
        return redirect()->route('all.roles.permission')->with($notification);

    } // END METHOD


    public function adminDeleteRoles($id){
        $role =  DB::table('roles')->where('id', $id)->first();
        //Role::findOrFail($id);
        if(!is_null($role)) {
            DB::table('roles')->where('id', $id)->delete();
        }

        $notification = array(
            'message' =>'Роль успешно удалена',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    } // END METHOD

}
