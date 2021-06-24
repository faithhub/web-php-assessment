<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from educhamp.themetrades.com/demo/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 13:08:15 GMT -->

<head>

	<!-- META ============================================= -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />

	<!-- MOBILE SPECIFIC ============================================= -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- PAGE TITLE HERE ============================================= -->
	<title>Staff Dashboard - {{$title ?? ''}} </title>

	<!-- MOBILE SPECIFIC ============================================= -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- FAVICONS ICON ============================================= -->
	<link rel="apple-touch-icon" href="apple-icon.png">
	<link rel="shortcut icon" href="favicon.ico">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

	@include('staff.layouts.includes.style')

	@include('staff.layouts.includes.alert')

</head>

<body>

	<!-- Left Panel -->

	@include('staff.layouts.includes.sidemenu')

	<!-- Left Panel -->

	<!-- Right Panel -->

	<div id="right-panel" class="right-panel">

		<!-- Header-->
		@include('staff.layouts.includes.header')
		<!-- /header -->
		<!-- Header-->

		@yield('staff')
	</div>
	<!-- /#right-panel -->

	<!-- Right Panel -->


</body>

<!-- External JavaScripts -->
@include('staff.layouts.includes.script')

</html>