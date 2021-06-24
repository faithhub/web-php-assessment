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
          <li class="active">My Profile</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<div class="content mt-3">

  <div class="col-xl-12 col-lg-12">
    <div class="col-xs-6 col-sm-6">
      <div class="card">
        <div class="card-header">
          <strong>Update My Profile</strong>
        </div>
        <div class="card-body card-block">
          <form method="post" enctype="multipart/form-data" action="{{ route('admin-profile') }}">
            @csrf
            <div class="form-group">
              <label class=" form-control-label">Username</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <input class="form-control" value="{{ Auth::user()->username }}" disabled>
              </div>
            </div>
            <div class="form-group">
              <label class=" form-control-label">Name</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <input class="form-control" name="name" value="{{ Auth::user()->name }}" required>
              </div>
              @error('name')
              <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label class=" form-control-label">Email</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                <input class="form-control" type="email" name="email" value="{{ Auth::user()->email }}" required>
              </div>
              @error('email')
              <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label class=" form-control-label">Phone Number</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                <input class="form-control" value="{{ Auth::user()->phone_number }}" name="phone_number" type="number" required>
              </div>
              @error('phone_number')
              <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label class=" form-control-label">Profile Picture</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-image"></i></div>
                <input class="form-control" type="file">
              </div>
              @error('avatar')
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
    <div class="col-lg-6 col-md-6">
      <div class="card">
        <div class="card-header">
          <strong class="card-title mb-3">My Profile</strong>
        </div>
        <div class="card-body">
          <aside class="profile-nav alt">
            <section class="card">


              <div class="mx-auto d-block">
                <img class="rounded-circle mx-auto d-block mt-2" src="{{Auth::user()->avatar != null ? asset('uploads/profile_pictures/'.Auth::user()->avatar) : asset('dashboard/images/avatar.png')}}" alt="{{ Auth::user()->username }}" class="img-fluid radius-round border">
                <h5 class="text-sm-center mt-2 mb-1">{{ Auth::user()->name }}</h5>
                <!-- <div class="location text-sm-center"><i class="fa fa-map-marker"></i> California, United States</div> -->
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <a href="#"> <i class="fa fa-user"></i>
                    @if(Auth::user()->status == 'Active')
                    <span class="badge badge-success">{{ Auth::user()->status}}</span>
                    @else
                    <span class="badge badge-danger">{{ Auth::user()->status}}</span>
                    @endif</a>
                </li>
                <li class="list-group-item">
                  <a href="#"> <i class="fa fa-male"></i> {{ Auth::user()->role }}</a>
                </li>
                <li class="list-group-item">
                  <a href="#"> <i class="fa fa-user"></i> {{ Auth::user()->username }}</a>
                </li>
                <li class="list-group-item">
                  <a href="#"> <i class="fa fa-envelope-o"></i> {{ Auth::user()->email }}</a>
                </li>
                <li class="list-group-item">
                  <a href="#"> <i class="fa fa-phone"></i> {{ Auth::user()->phone_number }}</a>
                </li>
                <li class="list-group-item">
                  <a href="#"> <i class="fa fa-calendar"></i> {{ date('D, M j, Y \a\t g:ia', strtotime(Auth::user()->created_at)) }}</a>
                </li>
              </ul>
            </section>
          </aside>
        </div>
      </div>
    </div>
  </div>
</div>

</div> <!-- .content -->
@endsection