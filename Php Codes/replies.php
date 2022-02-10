<html>
<head>
<title> Replies </title>
<style>
.button {
	  background-color: cyan;
	  border: none;
	  color: white;
	  //padding: 15px 15px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 12px;
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
$uid = pg_fetch_assoc($result);//$uid['user_id'] is the current user id

if(isset($_GET['comm_id']))
{
	$commid = $_GET['comm_id'];//comment_id
	//echo "This reply is for the comment: ";
	//echo $commid;
}

$qres = pg_query($db, "select video_id from comment_table where comment_id = '$commid'");
$vid = pg_fetch_assoc($qres);//$vid['video_id'] is the current video id


echo "<p> <h3 style=\"text-align:left;\"><a href = \"logout.php\"><font color = \"red\"> LOG OUT? </font> </a>  </h3></p>";
echo "<br/>";

echo "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ";
echo " <button type = \"submit\" name = \"submit\" style = \"background:red; height:50px; width:80px;\"> <a href = 'comments.php?id={$vid['video_id']}'> <font color = \"white\">Back</font> </a> </button>";


echo "<h1> <font color = \"blue\" ><center> <u> Replies </u> </center> </font> </h1> ";
$func = pg_query($db,"select * from showreplys({$commid})");

//echo "<h1> <font color = \"blue\" >Replies </font> </h1> ";

$res = "select * from \"totalreplys2\"($commid)";
$answ = pg_query($db,$res);
$trep = pg_fetch_row($answ);

echo "<font face=\"verdana\" color=\"green\"> Total Replies:  </font>";
echo $trep['0'];
echo "<br/>";

while($row = pg_fetch_row($func)){
	//foreach($row as $key => $value)
	//{
		$rep_id = $row['0'];
		$res2 = pg_query($db, "select reply,user_id from reply where reply_id = '{$rep_id}' ");
		$ans2 = pg_fetch_assoc($res2);//jar reply tar name r user_id, not amar
		//echo $ans2['user_id'];
		
		$res3 = pg_query($db, "select user_name from users where user_id = '{$ans2['user_id']}'");
		$ans3 = pg_fetch_assoc($res3);
		
		$commenter = $ans3['user_name'];
		$name = $ans2['reply'];
		echo "<b><p style = \"font-family:georgia,garamond,serif;font-size:20px;\"> {$commenter} </p> </b>";
		//echo $commenter;
		echo $name;
		echo "<br/>";
		
		//echo "<button class = \"button\"  name = \"reply\" style=\"width: 80px; height: 50px;\"> <a href = 'replies.php?id=$comm_id]'>View Replies</a> </button>";  

	//}
	
  
}

?>

</body>
</html>
