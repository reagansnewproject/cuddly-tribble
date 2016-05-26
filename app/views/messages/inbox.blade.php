@extends('layouts.master')
@section('content')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3 class="text-center">Received Messages</h3>
		<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>
						From
					</th>
					<th>
						Message
					</th>
					<th>
						Status
					</th>
				</tr>
			</thead>
			<tbody>
				@foreach($receivedmessages as $message)
				<tr>
					<td>{{{User::find($message->sender_id)->username}}}</td>
					<td>
						<a href="{{{action('MessageController@showmessage', array($message->id, $message->sender_id))}}}">{{{$message->message}}}</a>
					</td>
					<td>
						@if($message->is_read == "No") Unread @else Read @endif
					</td>
				</tr>
				@endforeach
				@if($receivedreplies != null)
					@foreach($receivedreplies as $reply)
						<tr>
							<td>{{{User::find($reply->responder_id)->username}}}</td>
							<td>
								<a href="{{{action('MessageController@showmessage', array($reply->message_id, $reply->responder_id))}}}">{{{$reply->body}}}</a>
							</td>
							<td>
								@if($reply->is_read == "No") Unread @else Read @endif
							</td>
						</tr>
					@endforeach
				@endif
				@foreach($receivedicebreakers as $ice)
					<tr>
						<td>{{{User::find($ice->sender_id)->username}}}</td>
						<td>
							<a href="{{{action('MessageController@showicebreaker', $ice->id)}}}">New Icebreaker</a>
						</td>
						<td>Received</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<h3 class="text-center">Sent Messages</h3>
		<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>
							To
						</th>
						<th>
							Message
						</th>
						<th>
							Status
						</th>
					</tr>
				</thead>
				<tbody>
					@foreach($sentmessages as $message) 
					<tr>
						<td>{{{User::find($message->receiver_id)->username}}}</td>
						<td>
							<a href="{{{action('MessageController@showmessage', array($message->id, $message->receiver_id))}}}">{{{$message->message}}}</a>
						</td>
						<td>
							@if($message->is_read == "No") Unread @else Read @endif
						</td>
					</tr>
					@endforeach
					@if($sentreplies != null)
					@foreach($sentreplies as $reply)
						<tr>
							<td>{{{User::find($reply->receiver_id)->username}}}</td>
							<td>
								<a href="{{{action('MessageController@showmessage', array($reply->message_id, $reply->receiver_id))}}}">{{{$reply->body}}}</a>
							</td>
							<td>
								@if($reply->is_read == "No") Unread @else Read @endif
							</td>
						</tr>
					@endforeach
				@endif
				@foreach($senticebreakers as $ice)
					<tr>
						<td>{{{User::find($ice->receiver_id)->username}}}</td>
						<td>New Icebreaker</td>
						<td>Sent</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop