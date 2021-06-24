@extends('doctor.layouts.app')
@section('doctor')

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
          <li class="active">All Patients</li>
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
            <strong class="card-title">All Patients</strong>
          </div>
          <div class="card-body">
            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>S/N</th>
                  <th>Name</th>
                  <th>Phone Number</th>
                  <th>Gender</th>
                  <th>Date of Birth</th>
                  <th>Address</th>
                  <th>Added On</th>
                </tr>
              </thead>
              <tbody>
                @isset($patients)
                @foreach($patients as $patient)
                <tr>
                  <td>{{$sn++}}</td>
                  <td>{{$patient->name}}</td>
                  <td>{{$patient->phone_number}}</td>
                  <td>{{$patient->gender}}</td>
                  <td>{{ Carbon\Carbon::parse($patient->date_of_birth)->diffInYears() }} years</td>
                  <td>{{$patient->address}}</td>
                  <td>{{ date('D, M j, Y \a\t g:ia', strtotime($patient->created_at))}}</td>
                </tr>
                @endforeach
                @endisset
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