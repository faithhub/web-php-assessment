@extends('admin.layouts.app')
@section('admin')

<div class="breadcrumbs">
  <div class="col-sm-4">
    <div class="page-header float-left">
      <div class="page-title">
        <h1>Dashboard</h1>
      </div>
    </div>
  </div>
  <div class="col-sm-8">
    <div class="page-header float-right">
      <div class="page-title">
        <ol class="breadcrumb text-right">
          <li class="active">All Doctors</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <strong class="card-title">All Admins</strong>
          </div>
          <div class="card-body">
            <div class="text-right">
              <a href="{{ route('admin-add-admin') }}" class="btn btn-dark mb-2">Add Admin</a>
            </div>
            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>S/N</th>
                  <th>Username</th>
                  <th>Name</th>
                  <th>Account status</th>
                  <th>Added On</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($admins as $admin)
                <tr>
                  <td>{{$sn++}}</td>
                  <td>{{$admin->username}}</td>
                  <td>{{$admin->name}}</td>
                  <td>
                    @if($admin->status == 'Active')
                    <span class="badge badge-success">{{ $admin->status}}</span>
                    @else
                    <span class="badge badge-danger">{{ $admin->status}}</span>
                    @endif
                  </td>
                  <td>{{ date('D, M j, Y \a\t g:ia', strtotime($admin->created_at))}}</td>
                  <td>
                    <a href="{{ route('admin-view-admin-details', $admin->id) }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> View</a>
                    <a href="{{ route('admin-view-admin', $admin->id) }}" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i> Edit</a>
                    <a href="{{ route('admin-delete-admin', $admin->id) }}" onclick="return confirm('Are you sure you want to delete this record?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- .animated -->
</div>
@endsection