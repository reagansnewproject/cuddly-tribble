@extends('layouts.master')
@section('content')
	<h1>Contact {{{$user->username}}}!</h1>
	<form class="form-horizontal" method="POST" action="{{{action('MessageController@sendmessage', $user->id)}}}">
		<label for="message">Message</label>
		<textarea name="message" id="message"></textarea>
		<button class="btn btn-primary">Contact {{{$user->username}}}</button>
	</form>
@stop