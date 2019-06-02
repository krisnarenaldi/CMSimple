@extends('superadmin.layouts.app')

@section('page_title','User Groups')

@section('content')
<div class="col-12">
 <div class="card">
    <div class="card-header">
      <h3 class="card-title">User Groups</h3>      
      <div class="card-options">
      <button class="btn btn-square btn-success" data-toggle="modal" data-target="#ugModalForm"><i class="fe fe-plus"></i>
      &nbsp;Add New</button>
      </div>
    </div>
    
    <div class="table-responsive">    
      <table class="table card-table table-vcenter text-nowrap datatable">
        <thead>
          <tr>
            <th class="w-1">No.</th>
            <th>User Group</th>
            <th>Created By</th>
            <th>Modified By</th>
            <th>Created At</th>
            <th>Modified At</th>                        
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($data as $ug)
            <tr>
              <td>{{ $sg->user_group }}</td>
              <td>{{ $sg->created_by }}</td>
              <td>{{ $sg->modified_by }}</td>
              <td>{{ $sg->created_at }}</td>
              <td>{{ $sg->modified_at }}</td>
            </tr>
          @endforeach                                 
        </tbody>
        </table>     
        {{ $data->links() }}   
      </div>
    </div>
</div>

<!-- Modal New-->
<div class="modal fade" id="ugModalForm" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <!-- header -->
   <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
        <h4 class="modal-title" id="ugModalLabel">Add User Group</h4>
      </button>
   </div>
   
   <!-- body -->
   <div class="modal-body">
    <p class="statusMsg"></p>
    <form role="form" class="form-with-validation" method="post" action="">
      <div class="form-group">
        <label for="user_group">User Group</label>
        <input type="text" name="user_group" id="user_group" class="form-control" placeholder="User group..."/>
      </div>
    </form>
   </div>

   <!-- footer -->
   <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary submitBtn" onclick="submitContactForm()">Save</button>
   </div>
  </div><!-- //modal-content -->
 </div>
</div>
@endsection