@extends('superadmin.layouts.app')

@section('page_title','Dashboard - Profile ')

@section('content')
@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <ul>
  @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
  @endforeach
  </ul>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">   
  </button>
 </div>
@endif

@foreach(['danger','warning','success','info'] as $msg)
  @if(Session::has('alert-'.$msg))
    <div class="alert alert-{{ $msg }} alert-dismissible fade show" role="alert">
      {{ Session::get('alert-'.$msg) }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">      
    </button>
  </div>
  @endif
@endforeach

<div class="row">
 <div class="col-lg-5 mx-auto">
  <div class="card">
    <div class="card-header">
     <h3 class="card-title">Profile {{Auth::guard('superadmin')->user()->name }}</h3>
    </div>
    <div class="card-body">
        <form method="post" action="{{ route('superadmin.updateprofile') }}" role="form" class="form-with-validation">
        @csrf
         <div class="row">
            <div class="col-auto">
                <span class="avatar avatar-xl" style="background-image: url(demo/faces/female/9.jpg)"></span>
            </div>   
        </div>         
            
            <div class="form-group">
                <label class="form-label" for="name">Name</label>
                <input class="form-control" placeholder="Name" name="name" value="{{ old('name') ? old('name') : isset($data['superadmin']['name']) ? $data['superadmin']['name'] : '' }}" required="required"/>
            </div>
            <div class="form-group">
                <label class="form-label" for="username">Username</label>
                <input type="text" class="form-control"  placeholder="Username" name="username" value="{{ old('username') ? old('username') : isset($data['superadmin']['username']) ? $data['superadmin']['username'] : '' }}" required="required"/>
            </div>
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input type="email" class="form-control" placeholder="Email.." name="email" value="{{ old('email') ? old('email') : isset($data['superadmin']['email']) ? $data['superadmin']['email'] : '' }}" required="required"/>
            </div>
            <h5 class="text-muted">Change Password</h5>
            <div class="form-group">
                <label class="form-label" for="current_password">Current Password</label>
                <input type="password" class="form-control" name="current_password"/>
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input type="password" class="form-control" name="password"/>
            </div>
            <div class="form-group">
                <label class="form-label" for="password_confirmation">Password Confirmation</label>
                <input type="password" class="form-control" name="password_confirmation"/>
            </div>
            <p class="help-block"><small>Leave this field empty if You don't want to change the password.</small></p>
            <div class="form-footer">
                <button class="btn btn-primary btn-block">Save</button>
            </div>
         

        </form>
    </div>
  </div><!-- //card -->
 </div>
</div>
@endsection