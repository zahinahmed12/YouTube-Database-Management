
<html>
<head>
<title> Comments </title>
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



if(isset($_GET['id']))
{
	$id = $_GET['id'];//video_id is $id
}

echo "<p> <h3 style=\"text-align:left;\"><a href = \"logout.php\"><font color = \"red\"> LOG OUT? </font> </a>  </h3></p>";
echo "<br/>";

echo "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ";
echo " <button type = \"submit\" name = \"submit\" style = \"background:red; height:50px; width:80px;\"> <a href = 'watch.php?id=$id'> <font color = \"white\">Back</font> </a> </button>";


$func = pg_query($db,"select * from showcomments({$id})");

echo "<h1> <font color = \"red\" ><center>  <u> Comments </u> </center> </font> </h1> ";

$res = "select * from \"totalcomments\"($id)";
$ans = pg_query($db,$res);
$tcomm = pg_fetch_row($ans);

echo "<font face=\"verdana\" color=\"green\"> Total Comments:  </font>";
echo $tcomm['0'];//total comments
echo "<br/>";

$counter = 1;
while($row = pg_fetch_row($func)){
	//find comment id
	$comm_id = $row['0'];
	//echo "This is the comment id: ";
	//echo $comm_id;
	echo "<br/>";
	$res2 = pg_query($db, "select comment_text,user_id from comment_table where comment_id = '{$comm_id}' ");
	$ans2 = pg_fetch_assoc($res2);//ekta comment k likhse tar user id r text
	
	//find commenter
	$res3 = pg_query($db, "select user_name from users where user_id = '{$ans2['user_id']}'");
	$ans3 = pg_fetch_assoc($res3);
	$commenter = $ans3['user_name'];
	
	$name = $ans2['comment_text'];
	echo "<b><p style = \"font-family:georgia,garamond,serif;font-size:20px;\"> {$commenter} </p> </b>";
	echo "<b> {$name} </b> <br/>";//comment_text
	echo "<br/>";
	
	
	
	
	echo "<form method = \"post\" >";
	echo "<br/><font color = \"blue\"><i>Write a reply: </i></font><br/>";
	echo "<input type = \"text\" id = \"reply_text{$counter}\" name = \"reply_text{$counter}\" style=\"width: 500px; height: 30px;\"/>";
	//echo "reply_text$counter";
	echo "<button class = \"button1\" type= \"submit\" id = \"reply{$counter}\" name = \"reply{$counter}\" value = \"Reply\" style = \"height: 30px; width: 70px; background: red; color:white;\"> Reply </button>";
	echo "</form>";
	//echo "<br/>";
	if(isset($_POST["reply{$counter}"]))
	{
     //echo "matha";
		if(empty($_POST["reply_text{$counter}"]))
		{
		}
		else
		{
			$reply_text_final = $_POST["reply_text{$counter}"];
			//echo $reply_text_final;
			pg_query($db,"select * from update_reply_table({$id},{$uid['user_id']},{$comm_id},'{$reply_text_final}')");
			//exit(); //dile first comment er reply te post hoi,
		}
	}
	
	echo "<button class = \"button\"  name = \"replybutton\" style=\"width: 100px; height: 35px;\"> <a href = 'replies.php?comm_id=$comm_id'><font color = \"white\">View Replies</font></a> </button>"; 

	echo "<br/>";
	
	$counter = $counter + 1;

}


?>


</body>
</html>
