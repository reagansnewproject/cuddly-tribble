@extends('layouts.master')
@section('content')
<div class="container">
	<div class="col-lg-12 col-lg-offset-1 col-md-12 col-md-offset-1 col-sm-12 col-sm-offset-1 col-xs-10">
		<form class="form-horizontal" method="POST" action="{{{action('MessageController@replyicebreaker', $icebreaker->id)}}}">
			<div class="form-group">
				<label for="question1_answer">{{{$question1->question}}}</label><br>
				<textarea name="question1_answer"></textarea>
			</div>
			<div class="form-group">
				<label for="question2_answer">{{{$question2->question}}}</label><br>
				<textarea name="question2_answer"></textarea>
			</div>
			<div class="form-group">
				<label for="question3_answer">{{{$question3->question}}}</label><br>
				<textarea name="question3_answer"></textarea>
			</div>
			<div class="form-group">
				<button class="btn btn-primary">Respond</button>
			</div>
		</form>
	</div>
</div>
@stop