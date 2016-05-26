@extends('layouts.master')
@section('content')
<div class="row">
	<div class="col-lg-8 col-lg-offset-1 col-md-8 col-md-offset-1 col-sm-8 col-sm-offset-1 col-xs-8 col-xs-offset-1">
		<form method="POST" action="{{{action('UsersController@dologin')}}}">
			<div class="form-group">
				<label for="email">Email</label>
				<input type="text" name="email" id="email">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" id="password">
			</div>
			<div class="form-group">
				<button class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
</div>
@stop