<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageData = [
            'pageTitle' => 'Users',
        ];
        $users = User::all();

        return view('user.manage', compact('pageData','users'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageData = [
            'pageTitle' => 'Add User',
        ];
        $roles = Role::all();
        return view('user.add', compact('pageData','roles'));
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
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users',
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->errors()->first());
        }

        $newPassword = Str::random(8);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->cnic = $request->cnic;
        $user->password = Hash::make($newPassword);
        $user->created_by = auth()->user()->id;
        $user->save();

        if($user){
            $user->assignRole($request->role);
            return redirect()->route('users')->with("success","User is created successfully");
        } else {
            return redirect()->route('users')->with("error","User is not created due to a reason");
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
        $pageData = [
            'pageTitle' => 'Edit User',
        ];
        $user = User::find($id);
        $userRoleName = $user->getRoleNames()[0];
        $roles = Role::all();
        return view('user.edit',compact('pageData','user','userRoleName', 'roles'));
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
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email,'.$request->id,
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->errors()->first());
        }

        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->cnic = $request->cnic;
        $user->updated_by = auth()->user()->id;
        $user->save();

        if($user){
            $user->syncRoles($request->role);
            return redirect()->route('users')->with("success","User is updated successfully");
        }
        else{
            return redirect()->route('users')->with("error","User is updated due to some reason");
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
        $user = User::find($id);
        $user->delete();
        return back()->with('warning','User record has been deleted');
    }

    function haspermission($id){
        $user = User::find($id);
        if($user){

            $pageData = [
                'pageTitle' => '[ '.$user->name.' ] has Permissions',
            ];

            $userPermissions = $user->getAllPermissions();
            $permissions = Permission::all();
            return view('user.haspermissions',compact('pageData','user','permissions','userPermissions'));
        }else{
            return back()->with('error','Sorry, Something went Wrong');
        }
    }

    public function haspermissionupdate(Request $request){

        $user = User::find($request->user_id);
        $user->syncPermissions();
        if(is_array($request->UserPermissionIDs)){
            foreach ($request->UserPermissionIDs as $UserPermissionID) {
                $user->givePermissionTo($UserPermissionID);
            }
        }else{
            return back()->with("error","Please select atleast 1 permission before saving.");
        }
        return redirect()->route('users')->with("success","User Permission updated successfully");
    }

// Profile Functions

public function profile(){

    $pageData = [
        'pageTitle' => 'Profile',
    ];
    return view('user.profile', compact('pageData'));

}
public function profileupdate(Request $request){

    $user_id = Auth::user()->id;

    $validator = Validator::make($request->all(), [
        'name' => 'required|min:3|max:255',
        'email' => 'required|email|unique:admins,email,'.$user_id,
    ]);

    if($validator->fails()){
        return back()->with('error',$validator->errors()->first());
    }

    $user = User::find($user_id);
    $user->name = $request->name;
    $user->email = $request->email;
    $user->save();

    if($user){
    return redirect()->route('profile')->with('success','User profile is updated successfully');
        // $user->syncRoles($request->role);
        //Send Credentials email
        //$newPassword
        //$request->email
    }
    else{
        return redirect()->route('profile')->with('error','User profile is not updated due to a reason');
    }
}

    public function updatepassword(Request $request){

        $user_id = Auth()->user()->id;

        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8|max:255',
            'new_password' => 'required|min:8|required_with:confirm_new_password|same:confirm_new_password',
            'confirm_new_password' => 'required',
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->errors()->first());
        }

        $user = User::find($user_id);

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error','Your current Password is invalid');
        }

        $updated = $user->update([
            'password'=> Hash::make($request->new_password)
        ]);

        if($updated){
            return redirect()->route('profile')->with('success','User Password has been updated');
        }else{
            return back()->with('error','Password not updated due to some error. Please try again');
        }
    }
}
