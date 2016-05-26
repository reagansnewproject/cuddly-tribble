@extends('layouts.master')
@section('content')
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
			<h3 class="text-center">What do you think of {{{$match->username}}}?</h3>
			<img src="../../{{{$user->image_url}}}">
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
			<div class="yes col-lg-3 col-lg-offset-3 col-md-3 col-md-offset-3 col-sm-3 col-sm-offset-3 col-xs-4 col-xs-offset-2" data-name="yes">
				<img class="yespic" src="/img/yes.png">
			</div>
			<div class="no col-lg-3 col-md-3 col-sm-3 col-xs-4" data-name="no">
				<img class="nopic" src="/img/no.png">
			</div>
		</div>
	</div>
	<form id="voteform" method="POST" action="{{{action('BrowseController@storevote', $match->id)}}}">
		<input type="hidden" name="vote" id="vote-id">
	</form>
@stop
@section('bottom-script')
	<script type="text/javascript">
	"Use Strict";
	$(".yes").click(function() {
		var vote = $(this).data("name");
		var count = 0;
		console.log(vote);
		var go = setInterval(function() {
			if(count == 1) {
				clearInterval(go);
			} else {
				$(".yespic").rotate({
					angle: 0,
					animateTo: 720
				}, 1000);
				count++;
			}
			$("#vote-id").val(vote);
			$("#voteform").submit();

		});
	});
	$(".no").click(function() {
		var vote = $(this).data("name");
		$("#vote-id").val(vote);
		$("#voteform").submit();
	});
	</script>
@stop