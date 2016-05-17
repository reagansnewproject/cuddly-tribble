@extends('layouts.master')
@section('content')
	<h3>Please enter the code you received in your email!</h3>
	<form method="POST" action="{{{action('UsersController@doverify')}}}">
		<label for="code">Code</label>
		<input type="text" name="code" id="code">
		<button class="btn btn-primary">Submit</button>
	</form>
@stop