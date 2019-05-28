<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Models\Superadmin;

class SuperadminRegisterController extends Controller
{
    //
    use RegistersUsers;

    protected $redirectTo = "/superadmin/login";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showRegisterForm(){
        return view('superadmin.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = [
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
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:100'],
            'username' => ['required', 'string', 'max:50','unique:superadmins'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:superadmins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],$messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Superadmin
     */
    protected function create(array $data)
    {
        return Superadmin::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function postRegister(Request $request){
        $validation = $this->validator($request->all());
        //$request->validate()
        if( $validation->fails() ){
            return redirect("superadmin/register")
                   ->withErrors($validation->errors())
                   ->withInput();
                   
                  print($validation->errors());
                  //die();
        }

        $superadmin = $this->create($request->all());
        
        return redirect()->intended($this->redirectTo);
    }
}
