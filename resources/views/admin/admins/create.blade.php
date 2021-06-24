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
          <li class="active"> @isset($admin) Edit Admin @else Add New Admin @endisset</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong> @isset($admin) Edit {{$admin->name}} Details @else Add New Admin @endisset</strong>
        </div>
        <div class="card-body card-block">
              <form method="post" action="@isset($admin) {{ route('admin-edit-admin') }}  @else {{ route('admin-add-admin') }} @endisset">
                @csrf
                @isset($admin->username) <input type="hidden" name="id" value="{{ $admin->id }}"> @endisset
                <div class="form-group">
                  <label class=" form-control-label">Username</label>
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                    <input class="form-control" name="username" @isset($admin->username) value="{{ $admin->username }}" disabled @else value="{{ old('username') }}" @endisset >
                  </div>
                  @error('username')
                  <small class="form-text text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label class=" form-control-label">Name</label>
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                    <input class="form-control" name="name" @isset($admin->name) value="{{ $admin->name }}" @else value="{{ old('name') }}" @endisset>
                  </div>
                  @error('name')
                  <small class="form-text text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label class=" form-control-label">Email</label>
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                    <input class="form-control" type="email" name="email" @isset($admin->email) value="{{ $admin->email }}" @else value="{{ old('email') }}" @endisset>
                  </div>
                  @error('email')
                  <small class="form-text text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label class=" form-control-label">Phone Number</label>
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                    <input class="form-control" @isset($admin->phone_number) value="{{ $admin->phone_number }}" @else value="{{ old('phone_number') }}" @endisset name="phone_number" type="number">
                  </div>
                  @error('phone_number')
                  <small class="form-text text-danger">{{ $message }}</small>
                  @enderror
                </div>
                @isset($admin->password)
                @else
                <div class="form-group">
                  <label class=" form-control-label">Password</label>
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                    <input class="form-control" name="password" type="password">
                  </div>
                  @error('password')
                  <small class="form-text text-danger">{{ $message }}</small>
                  @enderror
                </div>
                @endisset
                <div class="form-group">
                  <label class=" form-control-label">Gender</label>
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-male"></i></div>
                    <select class="form-control" name="gender">
                      <option value="">Select Gender</option>
                      <option value="Male" @isset($admin) {{ $admin->gender == "Male" ? "selected" : "" }} @else {{ old("gender") == "Male" ? "selected" : "" }} @endisset>Male</option>
                      <option value="Female" @isset($admin) {{ $admin->gender == "Female" ? "selected" : "" }} @else {{ old("gender") == "Female" ? "selected" : "" }} @endisset>Female</option>
                    </select>
                  </div>
                  @error('gender')
                  <small class="form-text text-danger">{{ $message }}</small>
                  @enderror
                </div>
                @isset($admin->status)   
                <div class="form-group">
                  <label class=" form-control-label">Account Status</label>
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                    <select class="form-control" name="status">
                      <option value="">Select Status</option>
                      <option value="Active" @isset($admin) {{ $admin->status == "Active" ? "selected" : "" }} @else {{ old("status") == "Active" ? "selected" : "" }} @endisset>Active</option>
                      <option value="Inactive" @isset($admin) {{ $admin->status == "Inactive" ? "selected" : "" }} @else {{ old("status") == "Inactive" ? "selected" : "" }} @endisset>Inactive</option>
                    </select>
                  </div>
                  @error('status')
                  <small class="form-text text-danger">{{ $message }}</small>
                  @enderror
                </div>
                @endisset
                <div class="text-right">
                  <button class="btn btn-success">@isset($admin) Update @else Create @endisset</button>
                </div>
              </form>
        </div>
      </div>
    </div>
  </div>
</div>

</div> <!-- .content -->
@endsection