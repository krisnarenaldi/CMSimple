<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuperadminController extends Controller
{
    //
    
    public function index(){
        echo "I am here";
    }
    
    public function hello($name = "you"){
        echo "hello, ".$name;
    }
}
