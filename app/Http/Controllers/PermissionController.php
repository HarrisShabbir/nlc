<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageData = [
            'pageTitle' => 'Permissions',
        ];
        $permissions = Permission::all();
        return view('permission.manage',compact('pageData', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required|string|max:255'
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->errors()->first());
        }

        $permission = new Permission();
        $permission->name = $request->name;
        $permission->guard_name = 'web';
        $permission->save();
        if($permission){
            return redirect()->route('permissions')->with("success","Permission is created Successfully.");
        }
        else{
            return redirect()->route('permissions')->with("error","Sorry, Permission is not created due to a reason.");
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
        $permission = Permission::find($id);
        return $permission;
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
            'permission_name' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->errors()->first());
        }
        $permission = Permission::find($request->permission_id);
        $permission->name = $request->permission_name;
        $permission->guard_name = 'web';
        $permission->save();
        if($permission){
            return redirect()->route('permissions')->with("success","Permission is updated Successfully.");
        }else{
            return redirect()->route('permissions')->with("success","Permission is not updated due to some reason.");
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
        $role = Permission::find($id);
        $role->delete();
        return back()->with('success','Permission deleted successfully.');
    }
}
