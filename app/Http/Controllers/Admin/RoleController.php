<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::with('permissions')->latest()->get();
        return view('admin.pages.role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        $groupNames = User::getPermissionGroupName();
        return view('admin.pages.role.group_role', compact('permissions','groupNames'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|unique:roles'
        ]);
        $role = Role::create([
            'name' => strtolower($request->name)
        ]);
        if(!empty($request->permissions)){
            $role->syncPermissions($request->permissions);
        }
        return redirect()->route('admin.roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        return view('admin.pages.role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     $role = Role::with('permissions')->find($id);
    //     $roleBasePermission = $role->permissions()->pluck('id')->toArray();
    //     $permissions = Permission::all();
    //     return view('admin.pages.role.edit', compact('role', 'permissions', 'roleBasePermission'));

    // }
    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        $groupNames = User::getPermissionGroupName();
        return view('admin.pages.role.group_role_edit', compact('role', 'permissions', 'groupNames'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|string|unique:roles,name,'.$id
        ]);
        $role = Role::findOrFail($id);
        $role->update([
            'name' => strtolower($request->name)
        ]);

            $role->syncPermissions($request->permissions);

        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        return back();
    }
}
