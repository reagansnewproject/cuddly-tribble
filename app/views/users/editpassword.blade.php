@extends('layouts.master')
@section('content')
	<h4>Edit your password</h4>
	<form class="form-horizontal">
		<div class="form-group">
			<label for="current_password">Current Password:</label>
			<input type="password" name="current_password" id="current_password">
		</div>
		<div class="form-group">
			<label for="new_password">New Password</label>
			<input type="password" name="new_password" id="new_password">
		</div>
		<div class="form-group">
			<label for="new_password_confirmation">Confirm New Password</label>
			<input type="password" name="new_password_confirmation" id="new_password_confirmation">
		</div>
	</form>
@stop