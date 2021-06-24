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
          <li class="active">Admin</li>
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
            <strong class="card-title">{{$admin->name}} Details</strong>
          </div>
          <div class="card-body">
            <div class="text-right">
              <a href="{{ route('admin-admins') }}" class="btn btn-dark mb-2">Back</a>
            </div>

            <div class="col-md-12">
              <div class="card">
                <div class="card-body p-0">
                  <table class="table table-hover table-striped table-align-middle mb-0">
                    <thead>
                      <tr>
                        <th>Role:</th>
                        <th>{{$admin->role}}</th>
                      </tr>
                      <tr>
                        <th>Username:</th>
                        <th>{{$admin->username}}</th>
                      </tr>
                      <tr>
                        <th>Name:</th>
                        <th>{{$admin->name}}</th>
                      </tr>
                      <tr>
                        <th>Email:</th>
                        <th>{{$admin->email}}</th>
                      </tr>
                      <tr>
                        <th>Phone Number:</th>
                        <th>{{$admin->phone_number}}</th>
                      </tr>
                      <tr>
                        <th>Gender:</th>
                        <th>{{$admin->gender}}</th>
                      </tr>
                      <tr>
                        <th>Acoount Status:</th>
                        <th>
                          @if($admin->status == 'Active')
                          <span class="badge badge-success">{{ $admin->status}}</span>
                          @else
                          <span class="badge badge-danger">{{ $admin->status}}</span>
                          @endif
                        </th>
                      </tr>
                      <tr>
                        <th>Created On:</th>
                        <th>{{ date('D, M j, Y \a\t g:ia', strtotime($admin->created_at))}}</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>

              <div class="text-right m-2">
                <a href="{{ route('admin-view-admin', $admin->id) }}" class="btn btn-success"><i class="fa fa-pencil"></i> Edit</a>
                <a href="{{ route('admin-delete-admin', $admin->id) }}" onclick="return confirm('Are you sure you want to delete this record?')" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- .animated -->
</div>
@endsection