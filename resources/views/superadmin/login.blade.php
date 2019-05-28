@extends('superadmin.layouts.applogin')

@section('page_title','Login Superadmin')

@section('content')
<div class="row">
    <div class="col col-login mx-auto">
        <div class="text-center mb-6">
            <img src="" class="h-6" alt="">
        </div>

        <!-- logout -->
        @if(Session::has('success'))
         <div class="alert alert-success alert-dismissable">
           <button type="button" class="close" data-dismiss="alert"></button>
           {{ Session::get('success') }}
         </div>
        @endif

        <!-- fail login -->
        @if($errors->any())
            <div class="alert alert-icon alert-danger">
            <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i>Error Login
            <br/>
              <ul>
                
                @foreach($errors->all() as $error)
                 <li> {{ $error}} </li>
                @endforeach
              </ul>
            </div>
        @endif
        
        <form class="card" action="{{ route('superadmin.login') }}" method="post">
            @csrf
            <div class="card-body p-6">
                <div class="card-title">Login</div>                    
                    <div class="form-group">
                        <label class="form-label" for="email">Email/Username</label>
                        <input type="text" class="form-control" placeholder="Enter email/username" name="login" value="{{ old('login') ? old('login') :  '' }}" required="required">
                    </div>
                    <div class="form-group">                    
                        <label class="form-label" for="password">Password
                        <!--a href="./forgot-password.html" class="float-right small">I forgot password</a -->
                        </label>

                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                    <div class="form-group">
                     <label class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" name="remember"/>
                      <span class="custom-control-label">Remember me</span>
                     </label>
                  </div>
                
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                </div>
            </div>
        </form>        
    </div>
</div>
@endsection