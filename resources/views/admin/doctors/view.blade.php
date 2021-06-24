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
          <li class="active">Doctors</li>
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
            <strong class="card-title">{{$doctor->name}} Details</strong>
          </div>
          <div class="card-body">
            <div class="text-right">
              <a href="{{ route('admin-doctors') }}" class="btn btn-dark mb-2">Back</a>
            </div>

            <div class="col-md-12">
              <div class="card">
                <div class="card-body p-0">
                  <table class="table table-hover table-striped table-align-middle mb-0">
                    <thead>
                      <tr>
                        <th>Role:</th>
                        <th>{{$doctor->role}}</th>
                      </tr>
                      <tr>
                        <th>Username:</th>
                        <th>{{$doctor->username}}</th>
                      </tr>
                      <tr>
                        <th>Name:</th>
                        <th>{{$doctor->name}}</th>
                      </tr>
                      <tr>
                        <th>Email:</th>
                        <th>{{$doctor->email}}</th>
                      </tr>
                      <tr>
                        <th>Phone Number:</th>
                        <th>{{$doctor->phone_number}}</th>
                      </tr>
                      <tr>
                        <th>Gender:</th>
                        <th>{{$doctor->gender}}</th>
                      </tr>
                      <tr>
                        <th>Speciality:</th>
                        <th>{{$doctor->speciality->name}}</th>
                      </tr>
                      <tr>
                        <th>Account Status:</th>
                        <th>
                          @if($doctor->status == 'Active')
                          <span class="badge badge-success">{{ $doctor->status}}</span>
                          @else
                          <span class="badge badge-danger">{{ $doctor->status}}</span>
                          @endif
                        </th>
                      </tr>
                      <tr>
                        <th>Created On:</th>
                        <th>{{ date('D, M j, Y \a\t g:ia', strtotime($doctor->created_at))}}</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
                           
              <div class="text-right m-2">
                    <a href="{{ route('admin-view-doctor', $doctor->id) }}" class="btn btn-success"><i class="fa fa-pencil"></i> Edit</a>
                    <a href="{{ route('admin-delete-doctor', $doctor->id) }}" onclick="return confirm('Are you sure you want to delete this record?')" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
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