<html>
<head>
<title>Category</title>
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

if(isset($_GET['cid']))
{
	$cid = $_GET['cid'];
	//echo "matha";
}

echo "<p> <h3 style=\"text-align:left;\"><a href = \"logout.php\"><font color = \"red\"> LOG OUT? </font> </a>  </h3></p>";
echo "<br/>";

echo "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ";
echo " <button type = \"submit\" name = \"submit\" style = \"background:red; height:50px; width:80px;\"> <a href = \"user.php\"> <font color = \"white\">Back</font> </a> </button>";


//$func = pg_query($db,"select * from mychannels({$ans['user_id']})");
echo "<h1><font color = \"green\"> <center> <u> Select a category </u> </center> </font> </h1>";


echo "<center>";
echo "<br/> <br/>";

echo "<button name = \"animation\" style = \"background:red; height:70px; width:200px;\"> <a href = 'upload_video.php?id=1&cid=$cid'><font color = \"#FFFFFF\"> Animation </font> </a> </button> <br/> <br/>";
echo "<button name = \"food\" style = \"background:red; height:70px; width:200px;\"> <a href = 'upload_video.php?id=2&cid=$cid'><font color = \"#FFFFFF\"> Food </font> </a> </button> <br/> <br/>";
echo "<button name = \"music\" style = \"background:red; height:70px; width:200px;\"> <a href = 'upload_video.php?id=3&cid=$cid'><font color = \"#FFFFFF\"> Music </font> </a> </button> <br/> <br/>";
echo "<button name = \"education\" style = \"background:red; height:70px; width:200px;\"> <a href = 'upload_video.php?id=4&cid=$cid'><font color = \"#FFFFFF\"> Education </font> </a> </button> <br/> <br/>";
echo "<button name = \"travel\" style = \"background:red; height:70px; width:200px;\"> <a href = 'upload_video.php?id=5&cid=$cid'><font color = \"#FFFFFF\"> Travel </font> </a> </button> <br/> <br/>";
echo "<button name = \"general\" style = \"background:red; height:70px; width:200px;\"> <a href = 'upload_video.php?id=6&cid=$cid'><font color = \"#FFFFFF\"> General </font> </a> </button> <br/> <br/>";

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
		echo "<h1><font color = \"green\"> New Channel Created! </font> </h1>";
	}
}


?>

</body>
</html>
