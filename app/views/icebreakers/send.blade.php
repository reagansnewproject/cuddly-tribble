@extends('layouts.master')
@section('content')
<div class="row">
	<div class="col-lg-12 col-lg-offset-1 col-md-12 col-md-offset-1 col-sm-12 col-sm-offset-1 col-xs-10 col-xs-offset-1">
		<h1 class="text-center">Select one icebreaker from each category</h1>
		<h4 class="text-center">Note: If viewing on mobile, landscape view is recommended</h4>
		<form class="form-horizontal" method="POST" action="{{{action('MessageController@sendicebreaker', $user->id)}}}">
			<label for="question1">Fun Question</label><br>
			<select name="question1">
				@foreach($icebreakers as $ice)
					@if($ice->id <= 10)
						<option value="{{{$ice->id}}}">{{{$ice->question}}}</option>
					@endif
				@endforeach
			</select>
			<br>
			<label for="question2">Slightly deeper question</label><br>
			<select name="question2">
				@foreach($icebreakers as $ice)
					@if($ice->id > 10 && $ice->id <= 20)
						<option value="{{{$ice->id}}}">{{{$ice->question}}}</option>
					@endif
				@endforeach
			</select>
			<br>
			<label for="question3">Deep questions</label><br>
			<select name="question3">
				@foreach($icebreakers as $ice)
					@if($ice->id > 20 && $ice->id <= 30)
						<option value="{{{$ice->id}}}">{{{$ice->question}}}</option>
					@endif
				@endforeach
			</select>
			<br>
			<button class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>
@stop