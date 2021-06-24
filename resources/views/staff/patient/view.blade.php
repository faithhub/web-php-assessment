@extends('staff.layouts.app')
@section('staff')
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
          <li class="active">Patient</li>
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
            <strong class="card-title">{{$patient->name}} Details</strong>
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
                        <th>Name:</th>
                        <th>{{$patient->name}}</th>
                      </tr>
                      <tr>
                        <th>Phone Number:</th>
                        <th>{{$patient->phone_number}}</th>
                      </tr>
                      <tr>
                        <th>Gender:</th>
                        <th>{{$patient->gender}}</th>
                      </tr>
                      <tr>
                        <th>Age:</th>
                        <th>{{Carbon\Carbon::parse($patient->date_of_birth)->diffInYears()}} years</th>
                      </tr>
                      <tr>
                        <th>Address:</th>
                        <th>{{$patient->address}}</th>
                      </tr>
                      <tr>
                        <th>Created On:</th>
                        <th>{{ date('D, M j, Y \a\t g:ia', strtotime($patient->created_at))}}</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>

              <div class="text-right m-2">
                <a href="{{ route('staff-edit-patient', $patient->id) }}" class="btn btn-success"><i class="fa fa-pencil"></i> Edit</a>
                <a href="{{ route('staff-delete-patient', $patient->id) }}" onclick="return confirm('Are you sure you want to delete this record?')" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
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