<?php

namespace App\Models;

#use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
//class Admin implements Authenticatable
{
    //
    use Notifiable;

    protected $guard = 'admin';

    protected $fillable = ['fullname','username','email','password'];
    protected $hidden = ['remember_token','password'];
    
}
