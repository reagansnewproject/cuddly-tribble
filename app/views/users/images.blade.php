@extends('layouts.master')
@section('content')
<div class="container">
	<div class="col-lg-8 col-lg-offset-1 col-md-8 col-md-offset-1 col-sm-8 col-sm-offset-1 col-xs-8 col-xs-offset-1">
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
	</div>
</div>
@stop