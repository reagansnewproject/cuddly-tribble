@extends('layouts.master')
@section('content')
<div class="container">
	<div class="col-lg-12 col-lg-offset-1 col-md-12 col-md-offset-1 col-sm-12 col-xs-12">
		@if($matches != null)
		<table class="table">
			<thead>
				<tr>
					<th>Image</th>
					<th>Username</th>
					<th>Gender</th>
					<th>Status</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($matches as $match)
				<tr>
					<td><img src="{{{$match->image_url}}}"></td>
					<td><a href="{{{action('UsersController@profile', $match->id)}}}">{{{$match->username}}}</a></td>
					<td>{{{$match->gender}}}</td>
					<td>{{{$match->online}}}</td>
					<td>{{{User::percent_match($match->id)}}}%</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@else
			Looks like there aren't any matches at the moment! Check back again later!
		@endif
	</div>
</div>
@stop