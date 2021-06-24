<aside id="left-panel" class="left-panel">
	<nav class="navbar navbar-expand-sm navbar-default">

		<div class="navbar-header">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
				<i class="fa fa-bars"></i>
			</button>
			<a class="navbar-brand" href="{{ route('doctor') }}"><img src="{{ asset('dashboard/images/logo.png') }}	" alt="Logo"></a>
			<a class="navbar-brand hidden" href="{{ route('doctor') }}"><img src="{{ asset('dashboard/images/logo2.png') }}	" alt="Logo"></a>
		</div>

		<div id="main-menu" class="main-menu collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="{{ request()->is('doctor')  ? 'active' : '' }}">
					<a href="{{ route('doctor') }}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
				</li>

				<h3 class="menu-title">Patient</h3>
				<li class="menu-item {{ request()->is('doctor/patients')  ? 'active' : '' }}">
					<a href="{{ route('doctor-patients') }}" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>All Patient</a>
				</li>
				<li class="menu-item {{ request()->is('doctor/patient-graph')  ? 'active' : '' }}">
					<a href="{{ route('doctor-patient-graph') }}" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-line-chart"></i>Patient Graph</a>
				</li>


				<h3 class="menu-title">Extras</h3><!-- /.menu-title -->
				<li class="menu-item {{ request()->is('doctor/profile')  ? 'active' : '' }}">
					<a href="{{ route('doctor-profile') }}" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>My Profile</a>
				</li>
				<li class="menu-item {{ request()->is('doctor/change-password')  ? 'active' : '' }}">
					<a href="{{ route('doctor-change-password') }}" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-lock"></i>Change Password</a>
				</li>
				<li class="menu-item">
					<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-power-off"></i>Logout</a>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</nav>
</aside><!-- /#left-panel -->