<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class SuperadminController extends Controller
{
    //
    
    use AuthenticatesUsers;

    protected $guard = 'admin';
    protected $redirectTo = '/admin';


    public function __construct(){
        $this->middleware('guest:admin,admin')->except('logout');
    }
    
    public function index(){
        return view("admin.login");
    }
    
    public function hello($name = "you"){
        echo "hello, ".$name;
    }
}
