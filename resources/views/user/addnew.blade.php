<?php 

?>

<!DOCTYPE html>
<html>
<head>
	<title>Add</title>
</head>
<body>
<h1>Add New User</h1>
	
	<?php
		// echo Form::open(['action' => 'UserController@addnew1']);
		echo Form::open(['url' => 'addnew']);

		echo Form::label('name', 'Username', ['class' => 'awesome']);
		echo Form::text('username');
		echo "<br/>";
		echo "<br/>";

		echo Form::label('email', 'Email Id', ['class' => 'email']);
		echo Form::text('email');
		echo "<br/>";
		echo "<br/>";

		echo Form::label('address', 'Address');
		echo Form::textarea('Address', null, ['cols'=> '30','rows' => '3']);
		echo "<br/>";
		echo "<br/>";

		echo Form::label('phone', 'Phone', ['class' => 'awesome']);
		echo Form::text('phone');
		echo "<br/>";
		echo "<br/>";

		echo Form::submit('Submit');

		echo Form::close();
	?>


</body>
</html>