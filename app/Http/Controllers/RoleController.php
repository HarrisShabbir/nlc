<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageData = [
            'pageTitle' => 'Roles',
        ];
        $roles = Role::all();
        return view('role.manage',compact('pageData','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255'
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->errors()->first());
        }

        $role = new Role();
        $role->name = $request->name;
        $role->guard_name = 'web';
        $role->save();
        if($role){
            return redirect()->route('roles')->with("success","Role is created.");
        }else{
            return redirect()->route('roles')->with("error","Role is not created.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        return $role;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_name' => 'required|min:3|max:255',
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->errors()->first());
        }

        $role = Role::find($request->role_id);
        $role->name = $request->role_name;
        $role->guard_name = 'web';
        $role->save();
        if($role){
            return redirect()->route('roles')->with("success","Role is updated Successfully.");
        }else{
            return redirect()->route('roles')->with("error","Having problem while updating role.");
        }
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
        return back()->with('success','User role has been deleted');
    }

    public function haspermission($id){

        $role = Role::find($id);

        if($role){

            $pageData = [
                'pageTitle' => '[ '.$role->name.'] Has Permissions',
            ];
            $permissions = Permission::all();
            $rolePermissions = $role->getAllPermissions();
            return view("role.haspermissions",compact('pageData','role','permissions','rolePermissions'));
        }else{
            return back()->with("error","Role not available with this id.");
        }
    }

    public function haspermissionupdate(Request $request, $id){

        $role = Role::find($id);
        $role->syncPermissions();
        if(is_array($request->RolePermissionIds)){
            foreach ($request->RolePermissionIds as $RolePermissionID) {
                $role->givePermissionTo($RolePermissionID);
            }
        }else{
            return back()->with("error","Please select atleast 1 permission before saving.");
        }
        return redirect()->route('roles')->with("success","Role Permission updated successfully");
    }
}
