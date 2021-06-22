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
          <li class="active">Home Page</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<div class="content mt-3">

  <div class="col-sm-12 mb-3">
    <h1>Welcome {{Auth::user()->username}}</h1>
  </div>

  <div class="col-sm-12">
    <div class="alert  alert-success alert-dismissible fade show" role="alert">
      <span class="badge badge-pill badge-success">Success</span> You successfully Logged in.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>


  <div class="col-xl-4 col-lg-6">
    <div class="card">
      <div class="card-body">
        <div class="stat-widget-one">
          <div class="stat-icon dib"><i class="ti-user text-success border-success"></i></div>
          <div class="stat-content dib">
            <div class="stat-text">Doctors</div>
            <div class="stat-digit">1,012</div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="col-xl-4 col-lg-6">
    <div class="card">
      <div class="card-body">
        <div class="stat-widget-one">
          <div class="stat-icon dib"><i class="ti-user text-primary border-primary"></i></div>
          <div class="stat-content dib">
            <div class="stat-text">Staffs</div>
            <div class="stat-digit">961</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-4 col-lg-6">
    <div class="card">
      <div class="card-body">
        <div class="stat-widget-one">
          <div class="stat-icon dib"><i class="ti-layout-grid2 text-warning border-warning"></i></div>
          <div class="stat-content dib">
            <div class="stat-text">Branch</div>
            <div class="stat-digit">770</div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div> <!-- .content -->
@endsection