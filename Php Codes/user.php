<?php
session_start();

$conn_string = "host=localhost port=5432 dbname=project user=postgres password=hr";
$db = pg_connect($conn_string);

$userName = $_SESSION['username'];
$result = pg_query($db, "select user_id from users where user_name = '$userName'");
$uid = pg_fetch_assoc($result);


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
<p> <h3 style="text-align:right;"> <align = "left"><a href = "logout.php"><font color = "red"> LOG OUT? </font> </a>  </h3></p>
<br/>

<p><center><h1> <font color = "Red"> <u> Youtube </u> </font> </h1> </center> </p>
<br/>



<form method = "post" action = "search.php">
	&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
		<input type = "text" id = "search_box" name = "search_box" style="width: 800px; height: 50px;"/>
		<button class = "button" type= "submit" name = "Search" style="height: 50px;"> Search </button> </form>
		<br/>
		<?php
		if(isset($_POST['Search']))
{
			if(empty($_POST['search_box']))
			{
				echo '<script language="javascript">';
				echo 'alert("Nothing to search!")';
				echo '</script>';
			}
}
		?>
<br/>
<br/>
 &nbsp &nbsp &nbsp &nbsp 
<button class = "button"  name = "hist"> <a href = "history.php"><font color = "#FFFFFF"> History </font> </a> </button>
&nbsp &nbsp &nbsp
<button class = "button"  name = "subscribed_channels"> <a href = "subscribed_channels.php"> <font color = "#FFFFFF">Subscribed Channels </font></a> </button>
&nbsp &nbsp &nbsp
<button class = "button"  name = "liked"> <a href = "liked.php"><font color = "#FFFFFF"> Liked Videos </font> </a> </button>
&nbsp &nbsp &nbsp
<button class = "button"  name = "recommendation"> <a href = "recommendation.php"><font color = "#FFFFFF"> Recommended </font></a> </button>
&nbsp &nbsp &nbsp
<button class = "button"  name = "my_videos"> <a href = "channels.php"> <font color = "#FFFFFF"> My Videos </font> </a> </button>
&nbsp &nbsp &nbsp
<button class = "button"  name = "watch_later"> <a href = "watch_later.php"> <font color = "#FFFFFF"> Watch Later </font> </a> </button>
&nbsp &nbsp &nbsp
<button class = "button"  name = "trending"> <a href = "trending.php"><font color = "#FFFFFF"> Trending </font> </a> </button>
&nbsp &nbsp &nbsp
<br/> <br/> <br/> <br/> <br/>

<?php
 $func = pg_query($db,"select * from callrand({$uid['user_id']})");
 //$func = pg_fetch_assoc($res);
 
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