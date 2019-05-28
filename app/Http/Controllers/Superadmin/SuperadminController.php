<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuperadminController extends Controller
{
    //
    
    public function index(){
        return view("superadmin.dashboard");
    }
    
    public function mytable(){
        return view("superadmin.tables");
    }
}
