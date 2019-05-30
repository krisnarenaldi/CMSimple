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
        <form method="post" action="{{ route('superadmin.updateprofile') }}" role="form" class="form-with-validation" enctype="multipart/form-data">
        @csrf

        @if(isset($avatar_color))
          <div class="row">                            
            <div class="col-auto mx-auto">              
              <span class="avatar avatar-xl avatar-{{ $avatar_color }}" id="noavatar">{{ $initial }}</span>
              <span class="avatar avatar-xl" id="preview" style="background-image: url('/images/avatar/128/'); display:none;" ></span>
            </div>              
          </div>                                                                     
          <div class="row">
           <div class="mx-auto">
              <a href="javascript:changeAvatar()">Add Avatar</a>                             
              <input type="file" name="image" id="imageupload" style="display:none;"/>                
           </div>
          </div>
        @else
         <div class="row">                            
            <div class="col-auto mx-auto">              
              <span class="avatar avatar-xl" id="preview" style="background-image: url('/images/avatar/128/{{ Auth::guard('superadmin')->user()->avatar }}')"></span>               
            </div>              
          </div>                                                                     
          <div class="row">
           <div class="mx-auto">
              <a href="javascript:changeAvatar()">Change Avatar</a>                             
              <input type="file" name="image" id="imageupload" style="display:none;"/>                
           </div>
          </div>
        @endif
            <br/>
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
            <hr/>
            <h5 class="text-muted">Change Password</h5>
            <div class="form-group">
                <label class="form-label" for="current_password">Current Password</label>
                <input type="password" class="form-control" name="current_password" placeholder="Current Password.."/>
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input type="password" class="form-control" name="password" placeholder="New Password..."/>
            </div>
            <div class="form-group">
                <label class="form-label" for="password_confirmation">Password Confirmation</label>
                <input type="password" class="form-control" name="password_confirmation" placeholder="New Password Confirmation..."/>
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

@push('custom-scripts')
 <script type="text/javascript">
  function changeAvatar(){
    $('#imageupload').click();
  }

  require(['jquery'],function($){
    $('#imageupload').change(function(){
      var imgPath = this.value;
      var ext = imgPath.substring(imgPath.lastIndexOf('.')+1).toLowerCase();
      if(ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg"){
        readURL(this);
      }else{
        alert("Mohon upload file gambar (jpg,jpeg,png)");
      }
    });

    function readURL(input){
      if(input.files && input.files[0]){
        var reader = new FileReader();
        reader.readAsDataURL(input.files[0]);
        reader.onload = function(e){
        //$('#preview').attr('src',e.target.result);
        $('#noavatar').hide();
        $('#preview').show();
        $('#preview').css('background-image', 'url("'+e.target.result+'")');
      }
    }
  }

  });
  

  
 </script>
@endpush