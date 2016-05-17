@extends('layouts.master')
@section('content')
<form method="POST" action="{{{action('UsersController@dologin')}}}">
	<label for="email">Email</label>
	<input type="text" name="email" id="email">
	<label for="password">Password</label>
	<input type="password" name="password" id="password">
	<button class="btn btn-primary">Submit</button>
</form>
@stop