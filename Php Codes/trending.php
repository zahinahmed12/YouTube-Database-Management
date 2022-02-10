<?php
session_start();

$conn_string = "host=localhost port=5432 dbname=project user=postgres password=hr";
$db = pg_connect($conn_string);

$userName = $_SESSION['username'];
$result = pg_query($db, "select user_id from users where user_name = '$userName'");
$uid = pg_fetch_assoc($result);//$uid['user_id'] = user id


?>
<html>
<head> 
	<style>
	.button {
	  background-color: FD0413;
	  border: none;
	  color: white;
	  padding: 15px 32px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;
	  margin: 4px 2px;
	  cursor: pointer;
	}
</style>
</head>
<body>

<?php
 $func = pg_query($db,"select * from trendingf()");
 //$func = pg_fetch_assoc($res);
 
 echo "<p> <h3 style=\"text-align:left;\"><a href = \"logout.php\"><font color = \"red\"> LOG OUT? </font> </a>  </h3></p>";
echo "<br/>";
 
echo "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ";
echo " <button type = \"submit\" name = \"submit\" style = \"background:red; height:50px; width:80px;\"> <a href = \"user.php\"> <font color = \"white\">Back</font> </a> </button>";

 echo "<h1><font color = \"#FC0000\"> <center> <u> Trending Videos </u> </center> </font> </h1>";
 echo "<br/>";
 
 echo "<center>";
 while($row = pg_fetch_row($func) )
 {
	$path = $row['0'];
	$res2 = pg_query($db, "select title,video_id from video where content_path = '{$row['0']}' ");
	$ans2 = pg_fetch_assoc($res2);
	
	$id = $ans2['video_id'];
	$name = $ans2['title'];
	echo '<video width="360" height="150" controls>';
	echo '<source src= "'.$path.'" type="video/mp4">';
    echo '</video>' ;
	echo "<br/><br/>";
	//echo "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ";
	echo "<p style = \"font-family:georgia,garamond,serif;font-size:20px;\"><a href = 'watch.php?id=$id'>$name</a></p>"; 
	
	$res5 = "select * from \"totalviews\"($id)";
	$ans5 = pg_query($db,$res5);
	$ans6 = pg_fetch_row($ans5);
	//echo "<br/>";
	//echo "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ";

	echo "<font face=\"verdana\" color=\"green\">Total Views: </font>";
	echo "<b> {$ans6['0']} </b>";
	echo " views";
	echo "<br/>";
	
	$chan_id = "select channel_id from video where video_id = $id";
	$channel_id = pg_query($db,$chan_id);
	$answer = pg_fetch_row($channel_id);//{$answer['0']} should be the channel_id of this video
	
	$chan_name = "select channel_name from channel where channel_id = {$answer['0']}";
	$channel_name = pg_query($db,$chan_name);
	$answer2 = pg_fetch_row($channel_name);
	//echo "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ";
	echo "<b><font face=\"verdana\" color=\"red\"> Channel Name:  </font></b>";
	echo "<b> {$answer2['0']} </b>";
	//echo "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ";
	echo "<br/><br/><br/><br/>";
 }
 
 echo "</center>"

?>
</body>
</html>