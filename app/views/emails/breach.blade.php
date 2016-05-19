<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h3>{{{$data['username']}}} ({{{$data['email']}}}) caused a security breach.</h3>
<p>Their offense is: {{{$data['offense']}}}</p>
<p>Their IP address at the time of the offense was: {{{$data['ip']}}} from {{{$data['browser']}}}</p> 
</body>
</html>