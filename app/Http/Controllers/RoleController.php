<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    function role_manage()
    {
        $permissions = Permission::all();
        $roles = Role::all();
        $users = User::all();
        return view('admin.role.index', compact('permissions', 'roles','users'));
    }

    function permission_store(Request $request)
    {
        Permission::create(['name' => $request->permission_name]);
        return back()->with('permission_success', 'New Permission Added!');
    }

    function role_store(Request $request)
    {
        $role = Role::create(['name' => $request->role_name]);
        $role->givePermissionTo($request->permission);

        return back()->with('role_success', 'New Role Added!');
    }

    function edit_role($role_id)
    {
        $role = Role::find($role_id);
        $permissions = Permission::all();
        return view('admin.role.edit', [
            'role' => $role,
            'permissions' => $permissions,
        ]);
    }

    function update_role(Request $request, $role_id)
    {
        $role = Role::find($role_id);
        $role->syncPermissions($request->permission);

        return back()->with('role_success','Role Updated!');
    }

    function delete_role($role_id)
    {
        $role = Role::find($role_id);
        DB::table('role_has_permissions')->where('role_id', $role_id)->delete();
        $role->delete();

        return back()->with('delete_role', 'Role Deleted!');
    }

    function assign_role(Request $request)
    {
        $user = User::find($request->user_id);
        $user->assignRole($request->role);

        return back()->with('assign_role','Role Assigned!');
    }

    function remove_role($id)
    {
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        return back();
    }
}
