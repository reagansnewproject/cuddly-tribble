<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<link rel="stylesheet" type="text/css" href="/css/newproject.css">
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
</head>
<body>
	<div class="navbar row text-center">
		<div class="col-lg-12">
			<div class="col-lg-3">
				@if(Auth::check())
					<a href="{{{action('UsersController@profile', Auth::id())}}}">Welcome, {{{Auth::user()->username}}}</a>
				@else
					<a href="{{{action('HomeController@homepage')}}}">Home</a>
				@endif
			</div>
			<a href="{{{action('MessageController@inbox')}}}"><div class="col-lg-3">
				Inbox @if(Auth::check()) ({{{Auth::user()->messagecount()}}}) @endif
			</div></a>
			@if(Auth::check()) 
				<a href="{{{action('BrowseController@index')}}}"><div class="col-lg-3">
					Browse
				</div></a>
			@else
				<a href="{{{action('UsersController@showcreate')}}}"><div class="col-lg-3">
					Sign Up
				</div></a>
			@endif
			@if(Auth::check())
			<a href="{{{action('UsersController@logout')}}}"><div class="col-lg-3">
				Log Out
			</div></a>
			@else
			<a href="{{{action('UsersController@showlogin')}}}"><div class="col-lg-3">
				Log In
			</div></a>
			@endif
		</div>
	</div>
	@if (Session::has('successMessage'))
    <div class="alert alert-success">{{{ Session::get('successMessage') }}}</div>
@endif
@if (Session::has('errorMessage'))
    <div class="alert alert-danger">{{{ Session::get('errorMessage') }}}</div>
@endif
<div class="container">
	@yield('content')
</div>

<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/jqueryrotate.js"></script>
@yield('bottom-script')

</body>
</html>