<?php
session_start();
ob_start();
?>
<html>
<head><link rel="shortcut icon" href="photos/favicon.ico"><link rel="stylesheet" href="css.css" type="text/css"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Delete Questions</title>
</head>

<body bgcolor="#333333" text="#FFFFFF" marginwidth="45">
<?php
if($_SESSION['username']=='admin')
{
include("connect.php");
echo'<br><center><b><font face="calibri" color="red" size=8>de</font><font face="calibri" size ="8">cipher</font></b></center>Hi admin !&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="admindash.php"><font color="white">Admin’s Dashboard</a> | <a href="logout.php"><font color="white">Logout</a>

<hr color="#CC0000">
<p>
  <strong> <center>
  <font size="5">Delete Questions</strong><br></font><br>
  </h2><center>
  <table border=1 width="1200"><tr><th>Q No.</th><th>Q Description</th><th width="300">Lifeline 1</th><th width="300">Lifeline 2</th><th>Image name</th><th>Answer</th><th>Delete ?</th></tr>';
$query="select * from questions";
			//echo $query;
			$result=mysqli_query($con,$query);
				if($result)
				{	
					while ($row=mysqli_fetch_array($result))
				{ 
					echo'<tr><td><center>'.$row[0].'<td><center>'.$row[1].'</td><td><center>'.$row[2].'</td><td><center>'.$row[3].'</td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><a href="deleteq_get.php?qno='.$row[0].'&submit=Delete"><center><font color="white">Delete</a></td></tr>';
					
				}
				}
				echo '</table>
<br><br><br>
<footer><center><u><b><a href="leaderboard.php"><font color="white">Leaderboard</a> &nbsp;&nbsp;&nbsp;&nbsp;<a href="https://www.facebook.com/pages/Decipher/173912556090728" target="_blank"><font color="white">Discussion</a> &nbsp;&nbsp;&nbsp;&nbsp;    <a href="rules.php"><font color="white">Rules & Regulations</a>   &nbsp;&nbsp;&nbsp;  <a href="prizes.php"><font color="white">Prizes</a>  &nbsp;&nbsp;&nbsp;   <a href="contact.php"><font color="white">Contact</a></center></footer></body>';

}

		else header('Location: logout.php');
?>
</html>