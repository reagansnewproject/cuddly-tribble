@extends('layouts.master')
@section('content')
<div class="col-lg-12">
	<div class="col-lg-6 col-lg-offset-3">
		<h3>{{{User::find($message->sender_id)->username}}} says...</h3>
		{{{$message->message}}}
	</div>
	@if($replies != null)
		@foreach($replies as $reply)
		<div class="col-lg-6 col-lg-offset-3">
			<h3>{{{User::find($reply->responder_id)->username}}} responded...</h3>
			{{{$reply->body}}}
		</div>
		@endforeach
	@endif
</div>
<div class="col-lg-12">
	<div class="col-lg-6 col-ls-offset-3">
		<h3>Reply to this message</h3>
		<form class="form-horizontal" method="POST" action="{{{action('MessageController@reply', array($message->id, $otherperson->id))}}}">
			<div class="form-group">
				<label for="body">Body</label>
				<textarea name="body"></textarea>
			</div>
			<button class="btn btn-primary">Reply</button>
		</form>
	</div>
</div>
<a href="{{{action('MessageController@inbox')}}}">Back to Inbox</a>
@stop