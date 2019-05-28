<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

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
                        'password'=>'required'],[
                            'login.required' => 'Mohon isi username',
                            'password.required' => 'Mohon isi password'
                        ]);
        
            $login_type = filter_var($request->get("login"),FILTER_VALIDATE_EMAIL) ? "email" : "username";
            $request->merge([$login_type => $request->get("login")]);

            if($this->guard()->attempt($request->only($login_type,'password'),$request->get('remember'))){
                return redirect()->intended($this->redirectTo);
            }
            return back()->withErrors(["Password/Login tidak ditemukan"])->withInput($request->only($login_type,'remember'));
                
    }

    public function logout(){
        if($this->guard()->check()){
            $this->guard()->logout();
        }
        
        return redirect()->route("superadmin.login")->with("success","Anda berhasil logout dari halaman superadmin.");
    }
}
