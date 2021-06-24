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
            <div class="text-right">
              <a href="{{ route('staff-add-patient') }}" class="btn btn-dark mb-2">Add Patient</a>
            </div>
            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>S/N</th>
                  <th>Name</th>
                  <th>Phone Number</th>
                  <th>Date of Birth</th>
                  <th>Created at</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($patients as $patient)
                <tr>
                  <td>{{$sn++}}</td>
                  <td>{{$patient->name}}</td>
                  <td>{{$patient->phone_number}}</td>
                  <td>{{ Carbon\Carbon::parse($patient->date_of_birth)->diffInYears() }} years</td>
                  <td>{{ date('D, M j, Y \a\t g:ia', strtotime($patient->created_at))}}</td>
                  <td>
                    <a href="{{ route('staff-view-patient-details', $patient->id) }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> View</a>
                    <a href="{{ route('staff-edit-patient', $patient->id) }}" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i> Edit</a>
                    <a href="{{ route('staff-delete-patient', $patient->id) }}" onclick="return confirm('Are you sure you want to delete this record?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
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