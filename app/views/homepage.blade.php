@extends('layouts.master')
@section('content')
<body>
	<div id="landingtop">
			<div id="landingtext">
				<h1 class="text-center">Welcome to Screenlight</h1>
				<h1 class="text-center">Why should you use Screenlight?</h1>
				<ul class="text-center">
					<li>More customization than other services</li>
					<li>More ways to interact with people</li>
					<li>Completely different results depending on your preferences</li>
					<li>Best of all: It's free!</li>
				</ul>
				<h1 class="text-center">Sign up today to meet new people!</h1>
			</div>
	</div>
</body>
@stop
@section('bottom-script')
<script type="text/javascript">
function jqUpdateSize(){
    // Get the dimensions of the viewport
    var width = $(window).width();
    var height = $(window).height();

    $("#landingtop").css("width", width + "px ").css("height",height + "px");
    // $("#landingmiddle").css("width", width + "px").css("height", (height/3.5) + "px");
    // $("#landingbottom").css("width", width + "px").css("height", (height/3.5) + "px");
};
$(document).ready(jqUpdateSize);
    // When the page first loads
$(window).resize(jqUpdateSize); 

</script>
@stop