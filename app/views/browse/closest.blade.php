@extends('layouts.master')
@section('content')
	@if($matches != null)
		@foreach($matches as $match)
			<a href="{{{action('UsersController@profile', $match->id)}}}"><h3 class="text-center">{{{$match->username}}}</h3></a>
		@endforeach
	@else
		Looks like there aren't any matches at the moment! Check back again later!
	@endif
@stop