<?php

$conn_string = "host=localhost port=5432 dbname=project user=postgres password=hr";
$db = pg_connect($conn_string);



if(isset($_POST['username'], $_POST['password']))
{
	if(empty($_POST['username']))
	{
		$errors[] = "Please enter a username";
	}
	if(empty($_POST['password']))
	{
		$errors[] = "Please enter a password";
	}
	
	if(empty($errors))
	{
		$result = pg_query($db, "select * from users where user_name = '{$_POST['username']}' and user_password = '{$_POST['password']}' ");
		if(pg_num_rows($result) === 1)
		{
			session_start();
			$_SESSION['username'] = $_POST['username'];
			//$userName = $_SESSION['username'];
			//$result = pg_query($db, "select user_id from users where user_name = '$userName'");
			//$uid = pg_fetch_assoc($result);
			header("location:user.php");
			exit();
		}
		else
		{
			?>
			<center> <h2> <font color = "#FF0000"> <?php echo "Your username and password was invalid."; ?> </font> </h2></center>
			<?php
		}
	}
}
?>

<html>
<head> </head>
<body>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<p> <center> <h1> <font color = "#FF0000"> Youtube </font> </h1> </center> </p>
<p> <center> <h2> Need an account? <a href = "register.php"> Register </a> today! </h2> </center> </p>
<form method="post">
		<center> <h3><label for = "username"> Username:</label>
			<input type = "text" id = "username" value = "" name = "username" style = "height: 30px;"/> <br/> <br/>
		<label for = "password"> Password:</label>
			<input type = "password" id = "password"  name = "password" style = "height: 30px;"/> <br/><br/>
		<input type = "submit" value = "Login!" style = "height: 30px;"/> <br/></h3> </center>
		
</form>
</body>
</html>