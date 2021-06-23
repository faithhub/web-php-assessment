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
    <div class="col-xl-6 col-lg-6 offset-xl-3 offset-lg-3">
      <div class="card">
        <div class="card-header">
          <strong>Add New Doctor</strong>
        </div>
        <div class="card-body card-block">
          <form method="post" action="@isset($doctor) {{ route('admin-edit-doctor') }}  @else {{ route('admin-add-doctor') }} @endisset">
            @csrf
            @isset($doctor->username) <input type="hidden"  name="id" value="{{ $doctor->id }}"> @endisset
            <div class="form-group">
              <label class=" form-control-label">Username</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <input class="form-control" name="username" @isset($doctor->username) value="{{ $doctor->username }}" disabled   @else value="{{ old('username') }}" @endisset >
              </div>
              @error('username')
              <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label class=" form-control-label">Name</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <input class="form-control" name="name" @isset($doctor->name) value="{{ $doctor->name }}"  @else value="{{ old('name') }}" @endisset>
              </div>
              @error('name')
              <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label class=" form-control-label">Email</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                <input class="form-control" type="email" name="email" @isset($doctor->email) value="{{ $doctor->email }}" @else value="{{ old('email') }}" @endisset>
              </div>
              @error('email')
              <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label class=" form-control-label">Phone Number</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                <input class="form-control" @isset($doctor->phone_number) value="{{ $doctor->phone_number }}" @else value="{{ old('phone_number') }}" @endisset name="phone_number" type="number">
              </div>
              @error('phone_number')
              <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
            @isset($doctor->password)
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
                  <option value="Male" @isset($doctor) {{ $doctor->gender == "Male" ? "selected" : "" }} @else  {{ old("gender") == "Male" ? "selected" : "" }} @endisset >Male</option>
                  <option value="Female" @isset($doctor) {{ $doctor->gender == "Female" ? "selected" : "" }} @else  {{ old("gender") == "Female" ? "selected" : "" }} @endisset >Female</option>
                </select>
              </div>
              @error('gender')
              <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label class=" form-control-label">Speciality</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-male"></i></div>
                <select class="form-control" name="speciality_id">
                  <option value="">Select Speciality</option>
                  @foreach ($specialities as $speciality)
                  <option value="{{$speciality->id}}" @isset($doctor) {{ $doctor->speciality_id == $speciality->id ? "selected" : "" }} @else {{ old('speciality') == $speciality->id ? "selected" : "" }} @endisset >{{$speciality->name}}</option>
                  @endforeach
                </select>
              </div>
              @error('speciality_id')
              <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="text-right">
              <button class="btn btn-success">@isset($doctor) Update @else Create @endisset</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

</div> <!-- .content -->
@endsection