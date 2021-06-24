<aside id="left-panel" class="left-panel">
	<nav class="navbar navbar-expand-sm navbar-default">

		<div class="navbar-header">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
				<i class="fa fa-bars"></i>
			</button>
			<a class="navbar-brand" href="{{ route('admin') }}"><img src="{{ asset('dashboard/images/logo.png') }}	" alt="Logo"></a>
			<a class="navbar-brand hidden" href="{{ route('admin') }}"><img src="{{ asset('dashboard/images/logo2.png') }}	" alt="Logo"></a>
		</div>

		<div id="main-menu" class="main-menu collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="{{ request()->is('admin')  ? 'active' : '' }}">
					<a href="{{ route('admin') }}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
				</li>

				<h3 class="menu-title">Admin</h3>
				<li class="menu-item {{ request()->is('admin/admins') ||  request()->is('admin/view-admin-details/*') || request()->is('admin/view-admin/*') ? 'active' : '' }}">
					<a href="{{ route('admin-admins') }}" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>All Admins</a>
				</li>
				<li class="menu-item {{ request()->is('admin/add-admin')  ? 'active' : '' }}">
					<a href="{{ route('admin-add-admin') }}" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Add New Admin</a>
				</li>

				<h3 class="menu-title">Doctor</h3>
				<li class="menu-item {{ request()->is('admin/doctors') ||  request()->is('admin/view-doctor-details/*') || request()->is('admin/view-doctor/*') ? 'active' : '' }}">
					<a href="{{ route('admin-doctors') }}" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>All Doctors</a>
				</li>
				<li class="menu-item {{ request()->is('admin/add-doctor')  ? 'active' : '' }}">
					<a href="{{ route('admin-add-doctor') }}" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Add New Doctor</a>
				</li>

				<h3 class="menu-title">Branch</h3>
				<li class="menu-item {{ request()->is('admin/branches') ||  request()->is('admin/edit-branch/*') ? 'active' : '' }}">
					<a href="{{ route('admin-branches') }}" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>All Branches</a>
				</li>
				<li class="menu-item {{ request()->is('admin/add-doctor')  ? 'active' : '' }}">
					<a href="{{ route('admin-add-doctor') }}" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Add New Branch</a>
				</li>

				<h3 class="menu-title">Staff</h3>
				<li class="menu-item {{ request()->is('admin/staffs') ||  request()->is('admin/view-staff-details/*') || request()->is('admin/view-staff/*') ? 'active' : '' }}">
					<a href="{{ route('admin-staffs') }}" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>All Staffs</a>
				</li>
				<li class="menu-item {{ request()->is('admin/add-staff') ? 'active' : '' }}">
					<a href="{{ route('admin-add-staff') }}" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Add New Staff</a>
				</li>


				<h3 class="menu-title">Extras</h3><!-- /.menu-title -->
				<li class="menu-item {{ request()->is('admin/profile')  ? 'active' : '' }}">
					<a href="{{ route('admin-profile') }}" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>My Profile</a>
				</li>
				<li class="menu-item {{ request()->is('admin/change-password')  ? 'active' : '' }}">
					<a href="{{ route('admin-change-password') }}" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-lock"></i>Change Password</a>
				</li>
				<li class="menu-item">
					<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-power-off"></i>Logout</a>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</nav>
</aside><!-- /#left-panel -->