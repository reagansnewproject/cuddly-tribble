@extends('layouts.master')
@section('content')
{{-- <h1 class="text-center">{{{$user->username}}}'s profile</h1> --}}
<div class="row text-center">
	<div class="col-lg-12">
		<div class="col-lg-6">
			<img class="mainpic" src="../{{{$user->image_url}}}">
			@if($images != null)
				@foreach($images as $image)
					<img src="../{{{$image->url}}}">
				@endforeach
			@endif
		</div>
		<div class="col-lg-6">
			<table class="text-center table table-checkered">
				<thead>
					<tr>
						<th>Gender</th>
						<th>Ethnicity</th>
						<th>Preference</th>
						<th>Birthday</th>
						<th>Location</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							{{{$user->gender}}}
						</td>
						<td>
							{{{$user->ethnicity}}}
						</td>
						<td>
							{{{$user->preference}}}
						</td>
						<td>
							{{{$user->birthday}}}
						</td>
						<td>
							{{{$user->city}}}, {{{$user->state}}} {{{$user->zipcode}}}
						</td>
						<td>
							{{{$user->online}}}
						</td>
					</tr>
				</tbody>
				
			</table>
		</div>
	</div>
</div>
@if($user->id == Auth::id())
	<div class="row text-center">
		<div class="col-lg-12">
			<div class="col-lg-6">
				<a href="{{{action('UsersController@showedit', $user->id)}}}">Edit Profile</a>
			</div>
			<div class="col-lg-6">
				<a href="{{{action('UsersController@logout')}}}">Logout</a>
			</div>
		</div>
	</div>
@endif
@stop