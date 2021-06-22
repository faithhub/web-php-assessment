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
				<li class="active">
					<a href="index.html"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
				</li>

				<h3 class="menu-title">Patient</h3>
				<li class="menu-item">
					<a href="#" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>All Patient</a>
				</li>
				<li class="menu-item">
					<a href="#" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Add New Patient</a>
				</li>

				<h3 class="menu-title">Extras</h3><!-- /.menu-title -->				
				<li class="menu-item">
					<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-power-off"></i>Logout</a>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</nav>
</aside><!-- /#left-panel -->