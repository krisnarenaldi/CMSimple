<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class SuperadminLoginController extends Controller
{
    //
    use AuthenticatesUsers;

    protected $guard = 'superadmin';
    protected $redirectTo = '/superadmin';


    public function __construct(){
        $this->middleware('guest:superadmin,superadmin')->except('logout');
    }

    protected function showLoginForm(){
        return view('superadmin.login');
    }

    protected function guard(){
        return Auth::guard($this->guard);
    }

    public function login(Request $request){
        
            $this->validate($request,['login' => 'required',
                        'password'=>'required']);
        
            $login_type = filter_var($request->get("login"),FILTER_VALIDATE_EMAIL) ? "email" : "username";
            $request->merge([$login_type => $request->get("login")]);

            if($this->guard()->attempt($request->only($login_type,'password'),$request->get('remember'))){
                return redirect()->intended($this->redirectTo);
            }
            return back()->withInput($request->only($login_type,'remember'));
                
    }
}
