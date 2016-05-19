@extends('layouts.master')
@section('content')
	@if($matches != null)
	<table class="table">
		<thead>
			<tr>
				<th>Image</th>
				<th>Username</th>
				<th>Gender</th>
				<th>Status</th>
				<th>Percent Match</th>
			</tr>
		</thead>
		<tbody>
			@foreach($matches as $match)
			<tr>
				<td><img src="{{{$match->image_url}}}"></td>
				<td><a href="{{{action('UsersController@profile', $match->id)}}}">{{{$match->username}}}</a></td>
				<td>{{{$match->gender}}}</td>
				<td>{{{$match->online}}}</td>
				<td>{{{User::percent_match($match->id)}}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@else
		Looks like there aren't any matches at the moment! Check back again later!
	@endif
@stop