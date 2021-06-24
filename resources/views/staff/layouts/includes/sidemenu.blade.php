<aside id="left-panel" class="left-panel">
	<nav class="navbar navbar-expand-sm navbar-default">

		<div class="navbar-header">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
				<i class="fa fa-bars"></i>
			</button>
			<a class="navbar-brand" href="./"><img src="{{ asset('dashboard/images/logo.png') }}	" alt="Logo"></a>
			<a class="navbar-brand hidden" href="./"><img src="{{ asset('dashboard/images/logo2.png') }}	" alt="Logo"></a>
		</div>

		<div id="main-menu" class="main-menu collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="{{ request()->is('staff')  ? 'active' : '' }}">
					<a href="{{ route('staff') }}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
				</li>

				<h3 class="menu-title">Patient</h3>
				<li class="menu-item {{ request()->is('staff/patients') || request()->is('staff/edit-patient/*') || request()->is('staff/patient/*')  ? 'active' : '' }}">
					<a href="{{ route('patients') }}" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>All Patient</a>
				</li>
				<li class="menu-item {{ request()->is('staff/add-patient')  ? 'active' : '' }}">
					<a href="{{ route('staff-add-patient') }}" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Add New Patient</a>
				</li>

				<h3 class="menu-title">Extras</h3><!-- /.menu-title -->
				<li class="menu-item {{ request()->is('staff/profile')  ? 'active' : '' }}">
					<a href="{{ route('staff-profile') }}" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>My Profile</a>
				</li>
				<li class="menu-item {{ request()->is('staff/change-password')  ? 'active' : '' }}">
					<a href="{{ route('staff-change-password') }}" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-lock"></i>Change Password</a>
				</li>
				<li class="menu-item">
					<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-power-off"></i>Logout</a>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</nav>
</aside><!-- /#left-panel -->