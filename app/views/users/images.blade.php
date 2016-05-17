@extends('layouts.master')
@section('content')
	@if($user->image_url != "/img/noimage.png")
		<img src="../../{{{$user->image_url}}}">
	@endif
	@if($images != null)
		@foreach($images as $image)
			<img src="../../{{{$image->url}}}">
		@endforeach
	@endif

	{{Form::open(array('class' => "form-horizontal", 'method' => 'POST', 'action' => array('UsersController@storeimage', $user->id), 'files' => 'true'))}}
		<label for="image">Select an Image</label>
		<input type="file" name="image" id="image">
		<button class="btn btn-primary">Upload</button>
	{{Form::close()}}

	<a href="{{{action('UsersController@profile', $user->id)}}}">Back</a>
@stop