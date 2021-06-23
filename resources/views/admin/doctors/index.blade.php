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
            <strong class="card-title">All Doctors</strong>
          </div>
          <div class="card-body">
            <div class="text-right">
              <a href="{{ route('admin-add-doctor') }}" class="btn btn-dark">Add Doctor</a>
            </div>
            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>S/N</th>
                  <th>Username</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone Number</th>
                  <th>Gender</th>
                  <th>Speciality</th>
                  <th>Added On</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($doctors as $doctor)
                <tr>
                  <td>{{$sn++}}</td>
                  <td>{{$doctor->username}}</td>
                  <td>{{$doctor->name}}</td>
                  <td>{{$doctor->email}}</td>
                  <td>{{$doctor->phone_number}}</td>
                  <td>{{$doctor->gender}}</td>
                  <td>{{$doctor->speciality->name}}</td>
                  <td>{{ date('D, M j, Y \a\t g:ia', strtotime($doctor->created_at))}}</td>
                  <td>
                    <button class="btn btn-sm btn-success">Edit</button>
                    <button class="btn btn-sm btn-danger">Delete</button>
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