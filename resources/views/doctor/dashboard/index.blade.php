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
          <li class="active">Doctor Dashboard</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<div class="content mt-3">

  <div class="col-sm-12 mb-3">
    <h1>Welcome {{Auth::user()->username}}</h1>
  </div>

  <div class="col-xl-12 col-lg-12">
    <div class="card">
      <div class="card-body">
        <div class="stat-widget-one">
          <div class="stat-icon dib"><i class="ti-user text-success border-success"></i></div>
          <div class="stat-content dib">
            <div class="stat-text">Total Number of All Patients</div>
            <div class="stat-digit">{{$patients}}</div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div> <!-- .content -->
@endsection