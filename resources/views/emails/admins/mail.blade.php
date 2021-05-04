 <!DOCTYPE html>
<html>
	<head>
		<title>Registration Information!</title>
	</head>
	<body>
		<p>Your User Name is: {{ $content['user_name'] }}</p>
		<p>Your Password is: {{ $content['password'] }}</p>
		<p>Your Role is: {{ $content['role'] }}</p>
		<p>{{ $content['message'] }}</p>
		<a href="{{ $content['url'] }}" class="btn btn-success p">Click here to login</a>
	</body>
</html>
