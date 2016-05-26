@extends('layouts.master')
@section('content')
{{-- <h1 class="text-center">{{{$user->username}}}'s profile</h1> --}}
<div class="row text-center">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
			<img class="mainpic" src="../{{{$user->image_url}}}">
			@if($images != null)
				@foreach($images as $image)
					<img src="../{{{$image->url}}}">
				@endforeach
			@endif
		</div>
		<div class="row">
			<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
				<table class="text-center table table-checkered">
					<thead>
						<tr>
							<th>Gender</th>
							<th>Ethnicity</th>
							<th>Preference</th>
							<th>Birthday</th>
						</tr>
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
						</tr>
						<tr>
							<th>Location</th>
							<th>Personality</th>
							<th>Marital Status</th>
							<th>Percent Match</th>
						</tr>
					</thead>
					<tbody>
					@foreach($details as $detail)
						<tr>
							<td>
								{{{$user->city}}}, {{{$user->state}}} {{{$user->zipcode}}}
							</td>
							<td>{{{$detail->personality}}}</td>
							<td>{{{$detail->marital_status}}}</td>
							<td>{{{$percent}}}</td>
						</tr>
						<tr>
							<th>Children</th>
							<th>Want Children</th>
							<th>Religion</th>
							<th>Politics</th>
						</tr>
						<tr>
							<td>{{{$detail->children}}}</td>
							<td>{{{$detail->want_children}}}</td>
							<td>{{{$detail->religion}}}</td>
							<td>{{{$detail->politics}}}</td>
						</tr>
						<tr>
							<th>Job</th>
							<th>Income</th>
							<th>Hair Color</th>
							<th>Hair Length</th>
						</tr>
						<tr>
							<th>Eye Color</th>
							<th>Body Type</th>
							<th>Height</th>
							<th>Weight</th>
						</tr>
						<tr>
							<th>Availability (Day)</th>
							<th>Availability (Time)</th>
							<th>Other Features</th>
							<th>Ideal Match</th>
						</tr>
					</tbody>
				</table>
			</div>
					@endforeach
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