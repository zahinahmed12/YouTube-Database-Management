<html>
<head>
<title>Videos of this channel</title>
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

if(isset($_GET['id']))
{
	$cid = $_GET['id'];
}

echo "<p> <h3 style=\"text-align:left;\"><a href = \"logout.php\"><font color = \"red\"> LOG OUT? </font> </a>  </h3></p>";
echo "<br/>";

echo "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ";
echo " <button type = \"submit\" name = \"submit\" style = \"background:red; height:50px; width:80px;\"> <a href = \"user.php\"> <font color = \"white\">Back</font> </a> </button>";



$func = pg_query($db,"select * from myvideos({$cid})");
echo "<h1><font color = \"orange\"> <center> <u> Video(s) of this channel </u> </center> </font> </h1>";


echo "<table align = \"center\" bgcolor = \"#F9EFB6\" border = \"1\">";
while($row = pg_fetch_row($func)){
	//foreach($row as $key => $value)
	//{
		$res2 = pg_query($db, "select video_id,title from video where content_path = '{$row['0']}' ");
		$ans2 = pg_fetch_assoc($res2);
		
		$id = $ans2['video_id'];
		$name = $ans2['title'];
		echo "<tr><td><p style = \"font-family:georgia,garamond,serif;font-size:28px;\"><a href = 'watch.php?id=$id'>$name</a></p></td>";
		//echo "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp";
		echo "<td><p style = \"font-family:georgia,garamond,serif;font-size:16px;\"><a href ='delete_video.php?vid=$id'><font color = \"red\">Delete? </font> </a></p></td></tr>";
		echo "<br/>";

	//}
	
  
}

echo "</table>";


echo "<center>";
echo "<br/> <br/> <br/> <br/>";
//echo "channel id is $cid";

//echo "<form method = \"POST\">";
echo "<button name= \"upload\" style = \"background:red;height:50px;width:200px;\"> <a href ='category_page.php?cid=$cid'> <font color = \"white\"> Upload a new video? </font> </a> </button>";
echo "</center>";
//echo "</form>";

?>

</body>
</html>
