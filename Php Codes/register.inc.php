<?php

//add a a new usser to the table
function add_user($username, $email , $password){
	// connect to the database
	$conn_string = "host=localhost port=5432 dbname=project user=postgres password=hr";
	$db = pg_connect($conn_string);

	$username = pg_escape_string($username);
	$password = pg_escape_string($password);
	$email = pg_escape_string($email);
	
	pg_query($db,"insert into users(user_name,gmail_id,user_password) values('$username','$email','$password')");
}


//check to see if user name is in use
function username_free($email)
{
	
	// connect to the database
	$conn_string = "host=localhost port=5432 dbname=project user=postgres password=hr";
	$db = pg_connect($conn_string);
	
	$email = pg_escape_string($email);
	$result = pg_query($db, "select * from users where gmail_id = '$email'");
	
	if(pg_num_rows($result) == 1)
	{
		return false;
	}
	else
	{
		return true;
	}
}


?>