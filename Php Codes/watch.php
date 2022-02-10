<html>
<head> 
	<style>
	.button {
	  background-color: orange;
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
	.button1 {
	  background-color: Red;
	  border: none;
	  color: white;
	  padding: 15px 15px;
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
$uid = pg_fetch_assoc($result);

//echo "<p> <h3 style=\"text-align:left;\"><a href = \"logout.php\"><font color = \"red\"> LOG OUT? </font> </a>  </h3></p>";


if(isset($_GET['id']))
{
	$id = $_GET['id'];//video id
	$result = pg_query($db,"select * from video where video_id = $id");
	
	pg_query($db,"select * from update_view_table({$id},{$uid['user_id']})");
	
	while($video= pg_fetch_assoc($result))
	{
		$video_name = $video['title'];
		$path = $video['content_path'];
	}
	
	echo "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ";
    echo " <button type = \"submit\" name = \"submit\" style = \"background:red; height:50px; width:80px;\"> <a href = \"user.php\"> <font color = \"white\">Back</font> </a> </button>";

	//echo $path;
	 echo '<video width="640" height="315" controls>';
	 echo '<source src= "'.$path.'" type="video/mp4">';
     echo '</video>' ;
	 echo '<br/>';
	 echo '<br/>';
	 //echo "<embed src = \"$path\" height = \"315\" width = \"640\"> </embed>";
	 echo "<form method = \"post\">";
	 echo "<button class = \"button1\" type = \"submit\" name = \"like\"  style=\"width:70px;\"> Like </button>";  
	 echo "&nbsp &nbsp &nbsp";
	 echo "<button class = \"button1\" type = \"submit\" name = \"dislike\" style=\"width:70px;\">Dislike</button>";
	 echo "&nbsp &nbsp &nbsp";
	 echo "<button class = \"button1\" type = \"submit\" name = \"watch_later\" style=\"width:100px;\">Watch Later</button>";
	 echo "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
	 &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp";
	 echo "<button class = \"button1\" type = \"submit\" name = \"subscribe\" style=\"width:80px;\">Subscribe</button>";
	 echo "&nbsp &nbsp &nbsp";
	 echo "<br/> <br/>";
	 echo "</form>";
	 
	 
	 
	 
	 $chan_id = "select channel_id from video where video_id = $id";
	 $channel_id = pg_query($db,$chan_id);
	 $answer = pg_fetch_row($channel_id);//{$answer['0']} should be the channel_id of this video
	 
	 if(isset($_POST['like']))
	 {
		pg_query($db,"select * from update_like_table({$id},{$uid['user_id']})");
				
	 }
	 if(isset($_POST['dislike']))
	 {
		pg_query($db,"select * from update_dislike_table({$id},{$uid['user_id']})");
		//exit();
	 }
	 if(isset($_POST['subscribe']))
	 {
		pg_query($db,"select * from update_subscription_table({$uid['user_id']},{$answer['0']} )");
		//exit();
	 }
	 if(isset($_POST['watch_later']))
	 {
		pg_query($db,"select * from update_watchlater_table({$id},{$uid['user_id']} )");
		//exit();
	 }
	 
	 
	 $title = "select title from video where video_id = $id";
	 $a = pg_query($db,$title);
	 $b = pg_fetch_row($a);
	 echo " <b><h1> {$b['0']}</h1> </b>";//{$b['0']} is the video title
	 
	 $res5 = "select * from \"totalviews\"($id)";
	 $ans5 = pg_query($db,$res5);
	 $ans6 = pg_fetch_row($ans5);
	 
	  echo "<font face=\"verdana\" color=\"red\"><b> Total Views: </b> </font>";
	  echo "<b> {$ans6['0']} </b>";
	  echo "<br/> <br/>";
	 
	 $res = "select * from \"totalLikes\"($id)";
	 $ans = pg_query($db,$res);
	 $ans2 = pg_fetch_row($ans);
	 
	  echo "<font face=\"verdana\" color=\"green\"> Total Likes:  </font>";
	  echo $ans2['0'];//total likes
	  echo "<br/>";
	  
	  $res10 = "select * from totaldislikes($id)";
	  $ans3 = pg_query($db,$res10);
	  $ans4 = pg_fetch_row($ans3);
	 
	  echo "<font face=\"verdana\" color=\"green\"> Total Dislikes:  </font>";
	  echo $ans4['0'];//total dislikes
	  echo "<br/>";
	   
	 /*$chan_id = "select channel_id from video where video_id = $id";
	 $channel_id = pg_query($db,$chan_id);
	 $answer = pg_fetch_row($channel_id);*/
	 
	 
	 $chan_name = "select channel_name from channel where channel_id = {$answer['0']}";
	 $channel_name = pg_query($db,$chan_name);
	 $answer2 = pg_fetch_row($channel_name);
	 echo "<b><font face=\"verdana\" color=\"red\"> Channel Name:  </font></b>";
	 echo "<b> {$answer2['0']} </b>";
	 echo "<br/>";
	 
	  $subs = "select * from \"totalsubscribers\"({$answer['0']})";
	  $ansQuery = pg_query($db,$subs);
	  $subsresult = pg_fetch_row($ansQuery);
	 
	  echo "<font face=\"verdana\" color=\"blue\"> Total Subscribers:  </font>";
	  echo $subsresult['0'];
	  echo "<br/>";
	  
	  $com = "select * from \"totalcomments\"($id)";
	  $com_ans = pg_query($db,$com);
	  $comresult = pg_fetch_row($com_ans);
	 
	echo "<font face=\"verdana\" color=\"orange\"> Total Comments:  </font>";
	echo $comresult['0'];//total comment
	echo "<br/>";
	echo "<br/>";
	echo "<br/>";
		
	
	 
	  
	echo "<button class = \"button\"  name = \"comments\"> <a href = 'comments.php?id=$id'>View Comments </a> </button>";  
	echo "&nbsp &nbsp &nbsp";
	echo "<button class = \"button\"  name = \"more_videos\"> <a href = 'more_videos.php?id=$id'> Up Next </a> </button>";
	  
	echo "<br/> <br/>";
	
	echo "<form method = \"post\" >";
	echo"<input type = \"text\" id = \"comment_text\" name = \"comment_text\" style=\"width: 600px; height: 50px;\"/>";
	echo "<button class = \"button1\" type= \"submit\" name = \"comment\" style = \"height: 50px;\"> Comment </button>";
	echo "</form>";
	echo "<br/> <br/>";
	if(isset($_POST['comment']))
	{
		if(empty($_POST['comment_text']))
		{
		}
		else
		{
			pg_query($db,"select * from update_comment_table({$uid['user_id']},{$id},'{$_POST['comment_text']}')");
			//exit();
		}
	}
	
	  
	 
}

?>

</body>
</html>
