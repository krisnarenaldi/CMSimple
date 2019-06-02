@extends('superadmin.layouts.app')

@section('page_title','Table')

@section('content')
<div class="col-12">
 <div class="card">
    <div class="card-header">
      <h3 class="card-title">Modul</h3>
    </div>
    <div class="table-responsive">
      <table class="table card-table table-vcenter text-nowrap datatable">
        <thead>
          <tr>
            <th class="w-1">No.</th>
            <th>Modul</th>
            <th>Created By</th>
            <th>Created At</th>
            <th>Modified By</th>
            <th>Modified At</th>                        
            <th></th>
          </tr>
        </thead>
        <tbody>
            <tr>
              <td><span class="text-muted">1</span></td>
              <td>Article</td>
              <td>
               
              </td>
              <td>
               <div class="w-4 h-4 bg-green rounded mr-4"></div>
              </td>
              <td>
               <div class="w-4 h-4 bg-green rounded mr-4"></div>
              </td>
              <td>
               <div class="w-4 h-4 bg-red rounded mr-4"></div>
              </td>                            
              <td>
                <a class="icon" href="javascript:void(0)">
                  <i class="fe fe-edit"></i>
                </a>
                &nbsp;|&nbsp;
                <a class="icon" href="javascript:void(0)">
                  <i class="fe fe-trash"></i>
                </a>
              </td>
            </tr>    
            <tr>
              <td><span class="text-muted">2</span></td>
              <td>Admin</td>
              <td>
               <div class="w-4 h-4 bg-green rounded mr-4"></div>
              </td>
              <td>
               <div class="w-4 h-4 bg-green rounded mr-4"></div>
              </td>
              <td>
               <div class="w-4 h-4 bg-green rounded mr-4"></div>
              </td>
              <td>
               <div class="w-4 h-4 bg-green rounded mr-4"></div>
              </td>                            
              <td>
                <a class="icon" href="javascript:void(0)">
                  <i class="fe fe-edit"></i>
                </a>
                &nbsp;|&nbsp;
                <a class="icon" href="javascript:void(0)">
                  <i class="fe fe-trash"></i>
                </a>
              </td>
            </tr>                        
          </tbody>
        </table>        
      </div>
    </div>
</div>
@endsection