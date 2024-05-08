<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(){

        $data = [
            'pageTitle' => 'Login',
            'heading1' => 'Welcome Back !',
            'heading2' => 'Sign in to continue.'
        ];

        return view('auth.login', $data);
    }

    public function auth(Request $request){

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return back()->with('message','Invalid Email Password.');
        }
        return redirect('dashboard')->with(['success' => 'You have successfully logged in', 'title' => 'Welcome '.auth()->user()->name.'!']);
    }

    public function forget(){

        $data = [
            'pageTitle' => 'Reset Password',
            'heading1' => 'Reset Password',
            'heading2' => 'Reset Password with BGD INT.'
        ];

        return view('auth.forget-password', $data);

    }

    public function reset(Request $request){

        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $user = User::where('email',$request->email)->first();

        if(!$user){
            return back()->with("message","Please Register First.");
        }

        $token = Str::random(64);
        DB::table('password_resets')->where('email',$request->email)->delete();
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $data = [
            'from' => env('MAIL_FROM_ADDRESS'),
            'subject' => "Forget Password Request",
            'token' => $token,
            'Username' => $user->name,
        ];

        //Mail::to($request->email)->send(new ForgetPassword($data));

        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    public function change(){

        return view('auth.change-password');

    }

    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);
        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }
        $updatePassword = DB::table('password_resets')->where('token', $request->token)->first();

        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $newPassword = Hash::make($request->password);

        $user = User::where('email', $updatePassword->email)
            ->update(['password' => $newPassword]);

        DB::table('password_resets')->where(['email'=> $updatePassword->email])->delete();

        return redirect('admin/login')->with('message', 'Your password has been changed!');
    }

    public function logout() {
        Auth::logout();
        return Redirect('login');
    }

}
