<html>
<head>
<title> Video upload </title>
<style>
.button {
	  background-color: red;
	  border: none;
	  color: white;
	  //padding: 15px 15px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 14px;
	  margin: 4px 2px;
	  cursor: pointer;
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
$uid = pg_fetch_assoc($result);



if(isset($_GET['id']) && isset($_GET['cid']))
{
	$cat_id = $_GET['id'];//category_id is $cat_id
	//echo "$cat_id";
	//echo "<br/>";
	$cid = $_GET['cid'];//channel_id is $cid
	//echo "$cid";
	
}

echo "<p> <h3 style=\"text-align:left;\"><a href = \"logout.php\"><font color = \"red\"> LOG OUT? </font> </a>  </h3></p>";
echo "<br/>";

echo "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ";
echo " <button type = \"submit\" name = \"submit\" style = \"background:red; height:50px; width:80px;\"> <a href = \"user.php\"> <font color = \"white\">Back</font> </a> </button>";

echo "<center> <h3>";
echo "<form method = \"POST\"  enctype = \"multipart/form-data\"> ";

echo "<label for = \"video_name\"> Video Title:</label>";
echo "<input type = \"text\" id = \"video_name\"  name = \"video_name\" style = \"height: 30px;\"/> <br/> <br/>";
echo "<label for = \"description\"> Description:</label>";
echo "<input type = \"text\" id = \"description\"  name = \"description\" style = \"height: 30px;\"/> <br/><br/> ";
echo "<label for = \"date\"> Date(YYYY-MM-DD):</label>";
echo "<input type = \"text\" id = \"date\"  name = \"date\" style = \"height: 30px;\"/> <br/><br/>";
echo "<label for = \"File\"> Content Path:</label>";
echo "<input type = \"file\" name = \"file\" id = \"file\"/>  <br/> <br/> ";
echo "<input type = \"submit\" value = \"Upload!\" name = \"upload\" style = \"height: 30px;\"/> <br/> <br/> ";
echo "</h3> </center>";
echo "</form>";

if(isset($_POST['upload']))
{
	if(empty($_POST['video_name']))
	{
		echo "<h1> <center> <font color = \"red\"> Title cannot be empty! </font> </center> </h1>";
	}
	else if(empty($_POST['date']))
	{
		echo "<h1> <center> <font color = \"red\"> Enter today's date! </font> </center> </h1>";
	}
	else
	{
		$name = $_FILES['file']['name'];
		if($name != "")
		{
			$temp = $_FILES['file']['tmp_name'];
			$url = "http://127.0.0.1/Upload/$name";
			//echo "{$url}";
			
			$Allah_jane_kan_error_khai = pg_query($db,"insert into video(title, channel_id, description, content_path, publish_date) values('{$_POST['video_name']}',{$cid}, '{$_POST['description']}', '{$url}','{$_POST['date']}')");
			
			$f_result = pg_query($db, "select video_id from video where title = '{$_POST['video_name']}'");
			$vid = pg_fetch_assoc($f_result);
			pg_query($db,"insert into categorized_video (video_id, category_id) values ({$vid['video_id']},{$cat_id})");
			echo "<br/> <br/>";
			echo "<center> <h1> <font color = \"blue\">Uploaded Video! </font> </h1> </center>";
		}
		else
		{
			echo "<h1> <center> <font color = \"red\"> Content path can't be empty!</font> </center> </h1>";
		}
		
	}
	
}
?>


</body>
</html>