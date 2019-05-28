<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use App\Models\Superadmin;
use Auth;

class SuperadminController extends Controller
{
    //
    protected $rules = ['name' => 'required|string|max:100',
                        'username' => 'required',
                        'email' => 'required|email'
                       ];
    
    protected $messages = [
        'name.required' => 'Mohon isi nama.',            
        'name.max' => 'Jumlah maksimal karakter adalah 100.',
        'username.required' => 'Mohon isi username.',            
        'username.unique' => 'Username sudah ada.',
        'email.required' => 'Mohon isi Email.',
        'email.email' => 'Mohon isi email yang valid.',
        'email.unique' => 'Email sudah ada.',
        'password.required' => 'Mohon isi password.',
        'password.confirmed' => 'Password tidak sama.'
    ];


    public function __construct(){
        $this->middleware("auth:superadmin");
    }

    public function index(){
        return view("superadmin.dashboard");
    }
    
    public function mytable(){
        return view("superadmin.tables");
    }


    /**
     * 
     * Profile Superadmin
     * Activity: update bio data and password
     */
    public function profile(){
        $superadmin = Superadmin::findorFail(Auth::guard('superadmin')->user()->id);
        $data = ["data" => compact('superadmin')];

        return view("superadmin.profile",$data);
    }

    public function updateprofile(Request $request){
        $superadmin = Superadmin::findorFail(Auth::guard('superadmin')->user()->id);

        $credentials = [];

        $name = $request->get("name");
        $username = $request->get("username");
        $email = $request->get("email");
        $current_password = $request->get("current_password");
        $password = $request->get("password");
        
        if($username != $superadmin->username){
            $this->rules['username'] = 'required|unique:superadmins';
        }

        if($email != $superadmin->email){
            $this->rules['email'] = 'required|email|unique:superadmins';
        }

        if($current_password !=""){    
            $credentials = [
                'username' => $username,
                'password' => $current_password
            ];
            if(Auth::guard('superadmin')->attempt($credentials)==false){
                return back()->withErrors(["Password lama tidak ditemukan"])->withInput();
                die();
            }            
            $this->rules['password'] = 'required|confirmed';                                    
        }        
        $this->validate($request,$this->rules,$this->messages);

        $superadmin->name = $name;
        $superadmin->username = $username;
        $superadmin->email = $email;
        if($current_password !=""){
            $superadmin->password = Hash::make($password);
        }
        $superadmin->save();
        
        $request->session()->flash("alert-success","Data Profile  berhasil di-update!");

        return redirect()->route('superadmin.profile');
        
    }
    
}
