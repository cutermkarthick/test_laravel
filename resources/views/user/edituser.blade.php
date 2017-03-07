<!DOCTYPE html>
<html>
<head>
	<title>Edit user</title>
</head>
<body>

<h1>Edit User</h1>
	
	<?php 
		// echo "<pre>";
		// print_r($user_dt[0]); 
		$user_dt = $user_dt[0];
	?>

		{!!  Form::open(['route'=>'updateuser' , 'class'=>'form']) !!}

		<label>Username</label>
		<input type="text" name="username" id="username" value="{{ $user_dt->username }}">
		<br>
		<br>

		<label>Email</label>
		<input type="text" name="email" id="email" value="{{ $user_dt->email }}">
		<br>
		<br>

		<label>Address</label>
		<textarea  name="Address" id="Address" rows="3" cols="30">{{ $user_dt->address }}</textarea>
		<br>
		<br>

		<label>Phone</label>
		<input type="text" name="phone" id="phone" value="{{ $user_dt->phone }}">
		<br>
		<br>

		<input type="hidden" name="recnum" id="recnum" value="{{ $user_dt->recnum }}">
		<input type="submit" name="submit" value="submit">


	{!! Form::close() !!}

</body>
</html>