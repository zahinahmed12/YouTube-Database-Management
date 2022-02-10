<html>
<head>
<title> Create Channels</title>
<style>
table{
  border: 1px solid black;
}
</style>
</head>
<body>

<?php
session_start();

$conn_string = "host=localhost port=5432 dbname=project user=postgres password=hr";
$db = pg_connect($conn_string);

$userName = $_SESSION['username'];

$result = pg_query($db, "select user_id from users where user_name = '$userName'");
$ans = pg_fetch_assoc($result);

echo "<p> <h3 style=\"text-align:left;\"><a href = \"logout.php\"><font color = \"red\"> LOG OUT? </font> </a>  </h3></p>";
echo "<br/>";

echo "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ";
echo " <button type = \"submit\" name = \"submit\" style = \"background:red; height:50px; width:80px;\"> <a href = \"user.php\"> <font color = \"white\">Back</font> </a> </button>";


//$func = pg_query($db,"select * from mychannels({$ans['user_id']})");
echo "<h1><font color = \"#570044\"> <center> <u> Name of new channel: </u> </center> </font> </h1>";


echo "<center>";
echo "<br/> <br/>";
echo "<form method = \"POST\">";
echo "<input type = \"text\" name = \"channel_name\" style = \" height: 50px; width: 200px;\" />";
echo "<input type = \"submit\" value = \"Submit\" name = \"submit\" style = \" height: 50px; width: 200px;\" />";
echo "</form>";
echo "</center>";

if(isset($_POST['submit']))
{
	if(empty($_POST['channel_name']))
	{
	}
	else
	{
		$create_chan = pg_query($db, "insert into channel(creator_id,channel_name) values({$ans['user_id']}, '{$_POST['channel_name']}') ");
		echo "<br/> <br/>";
		echo "<h1><font color = \"green\"><center> New Channel Created! </center> </font> </h1>";
	}
}


?>

</body>
</html>
