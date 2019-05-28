@extends('superadmin.layouts.applogin')

@section('page_title','Regiter Superadmin')

@section('content')
<div class="row">
    <div class="col col-login mx-auto">
        <div class="text-center mb-6">
            <img src="" class="h-6" alt="">
        </div>

        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <form class="card" action="{{ route('superadmin.register') }}" method="post">
            @csrf
            <div class="card-body p-6">
                <div class="card-title">Create new account</div>
                    <div class="form-group">
                        <label class="form-label" for="name">Name</label>
                        <input type="text" class="form-control" placeholder="Enter name" name="name">                        
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="username">Username</label>
                        <input type="text" class="form-control" placeholder="Enter username" name="username">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email address</label>
                        <input type="email" class="form-control" placeholder="Enter email" name="email">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password_confirmation">
                    </div>                    
                
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block">Create new account</button>
                </div>
            </div>
        </form>
        <div class="text-center text-muted">
            Already have account? <a href="./login.html">Sign in</a>
        </div>
    </div>
</div>
@endsection