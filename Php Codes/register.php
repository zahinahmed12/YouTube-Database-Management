<?php

include("register.inc.php");


$conn_string = "host=localhost port=5432 dbname=project user=postgres password=hr";
$db = pg_connect($conn_string);

echo "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ";
echo " <button type = \"submit\" name = \"submit\" style = \"background:red; height:50px; width:80px;\"> <a href = \"index.php\"> <font color = \"white\">Back</font> </a> </button>";


if(isset($_POST['username'],$_POST['email'],$_POST['password'],$_POST['repeat-password'])){
	if(empty($_POST['username']))
	{
		$errors[] = "Please enter a username";
	}else if(username_free($_POST['email']) === false){
		$errors[] = "That gmail_id is already taken, please choose another one.";
	}
}

if(empty($_POST['password'])){
	$errors[] = "Please enter a password.";
}
else if($_POST['password'] !== $_POST['repeat-password'])
{
	$errors[] = "Your passwords do not match."; 
}

if(empty($errors))
{
	add_user($_POST['username'], $_POST['email'], $_POST['password']);
	header("location:index.php");
	exit();
}


?>

<html xmlns = "http://www.w3.org/1999/xhtml">
<head> <title> Register Page </title> </head>
<body>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<center>
<form method = "post" action = "register.php" >
	<label for  = "username"> Username: </label>
		<input type = "text" name = "username" id = "username" style = "height: 30px;"/> <br/> <br/>
	<label for  = "email"> Gmail ID: </label>
		<input type = "text" name = "email" style = "height: 30px;"/> <br/> <br/>
	<label for  = "password"> Password: </label>
		<input type = "password" name = "password" style = "height: 30px;"/> <br/> <br/>
	<label for  = "repeat-password"> Repeat Password: </label>
		<input type = "password" id = "repeat-password" name = "repeat-password" style = "height: 30px;"/> <br/>
		<br/>
	<input type = "submit" value = "Register" style = "height: 30px; background: red; color:white;"/>
</form>
</center>


</body>
</html>
