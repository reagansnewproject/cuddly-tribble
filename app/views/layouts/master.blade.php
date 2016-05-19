<!DOCTYPE html>
<html>
<head>
	<title>Screenlight</title>
	<link rel="stylesheet" type="text/css" href="/css/newproject.css">
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
</head>
<body>
	{{-- <div class="container"> --}}
		<div class="navbar text-center">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 navlink">
					@if(Auth::check())
						<a href="{{{action('UsersController@profile', Auth::id())}}}"><div class="navlink">Welcome, {{{Auth::user()->username}}}</div></a>
					@else
						<a href="{{{action('HomeController@homepage')}}}"><div class="navlink">Home</div></a>
					@endif
				</div>
				<a href="{{{action('MessageController@inbox')}}}"><div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 navlink">
					Inbox @if(Auth::check()) ({{{Auth::user()->messagecount()}}}) @endif
				</div></a>
				@if(Auth::check()) 
					<a href="{{{action('BrowseController@index')}}}"><div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 navlink">
						Browse
					</div></a>
				@else
					<a href="{{{action('UsersController@showcreate')}}}"><div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 navlink">
						Sign Up
					</div></a>
				@endif
				@if(Auth::check())
				<a href="{{{action('UsersController@logout')}}}"><div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 navlink">
					Log Out
				</div></a>
				@else
				<a href="{{{action('UsersController@showlogin')}}}"><div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 navlink">
					Log In
				</div></a>
				@endif
			</div>
		</div>
	{{-- </div> --}}
	@if (Session::has('successMessage'))
    <div class="alert alert-success">{{{ Session::get('successMessage') }}}</div>
@endif
@if (Session::has('errorMessage'))
    <div class="alert alert-danger">{{{ Session::get('errorMessage') }}}</div>
@endif
{{-- <div class="container"> --}}
	@yield('content')
{{-- </div> --}}

<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/jqueryrotate.js"></script>
@yield('bottom-script')

</body>
</html>