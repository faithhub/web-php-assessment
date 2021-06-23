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
          <li class="active">Change Password</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<div class="content mt-3">
  <div class="col-xl-6 col-lg-6 offset-xl-3 offset-lg-3">
      <div class="card">
        <div class="card-header">
          <strong>Change Password</strong>
        </div>
        <div class="card-body card-block">
          <form method="post" action="{{ route('admin-change-password') }}">
          @csrf
            <div class="form-group">
              <label class=" form-control-label">Old Password</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                <input class="form-control" name="old_password" type="password">
              </div>
              @error('old_password')
              <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label class=" form-control-label">New Password</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                <input class="form-control" type="password" name="new_password">
              </div>
              @error('new_password')
              <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label class=" form-control-label">Confirm New Password</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                <input class="form-control" name="confirm_new_password" type="password">
              </div>
              @error('confirm_new_password')
              <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="text-right">
              <button class="btn btn-success">Update</button>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>

</div> <!-- .content -->
@endsection