<?php
session_start();
ob_start();
?>
<head><link rel="shortcut icon" href="photos/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><link rel="stylesheet" href="css.css" type="text/css"/>
<title>Q2</title>
<script>
					function open_win()
					{
					window.open("q2.php")
					}
					</script>
					
</head>
<?php
if($_SESSION['normaluser']=='normaluser' && $_SESSION['level']==2)
{
if(!isset($_POST['submit']))
{
echo '<body bgcolor="#333333" text="#FFFFFF" marginwidth="45">';
include ("connect.php");
$name=$_SESSION['username'];

$result=mysqli_query($con,"select * from users order by score desc");
$i=1;
while ($row=mysqli_fetch_array($result))
{ 
if($row[0]=='admin')
continue;
if($row[0]==$name)
break;
else $i++;
}
$result=mysqli_query($con,"select score from users where name='$name'");
$row=mysqli_fetch_array($result);
echo'
<body bgcolor="#333333" text="#FFFFFF" marginwidth="45">
<br><center><b><font face="calibri" color="red" size=8>de</font><font face="calibri" size ="8">cipher</font></b></center>Hi '.$name.' !&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <br>Rank : '.$i.' | Points : '.$row[0].' | <a href="logout.php"><font color="white">Logout</a>

<hr color="#CC0000">
<p><strong> <center>
  <font size="5">Question 2</strong><br></font>
  </h2><center>';
	include ("connect.php");
	$result=mysqli_query($con,"select qdesc,lifeline1,lifeline2,imagename,answer from questions where qno=2");
	$rows=mysqli_fetch_array($result);					
	echo ''.$rows[0].'';

echo'<form name="q2" action="q2.php" method="post">
<br>Answer : <input type="text" name="q2" size="50"><br>
<input type="submit" value="Submit" name="submit">
<br><input type="submit" value="Lifeline 1 ( -1 point )" name="life2_1" onclick="open_win()">&nbsp;&nbsp;&nbsp; <input type="submit" value="Lifeline 2 ( -1 point )" name="life2_2" onclick="open_win()"><br>

</form>';
echo '<br><img src="photos/'.$rows[3].'.jpg"></img>'; 
		if(isset($_POST['life2_1']))
		{
		include ("connect.php");
		$username=$_SESSION['username'];
		$result=mysqli_query($con,"select life2_1 from users where name='$username'");
		$rows=mysqli_fetch_array($result);
					if($rows[0]==0)
					{
					$username=$_SESSION['username'];
					$result=mysqli_query($con,"update users set life2_1=1 where name='$username'");
					$result=mysqli_query($con,"update users set score=(score-1) where name='$username'");
					}
					
					$result=mysqli_query($con,"select lifeline1 from questions where qno=2");
					$rows=mysqli_fetch_array($result);
					header('Location: '.$rows[0].'');
		}
		
		if(isset($_POST['life2_2']))
		{
		include ("connect.php");
		$username=$_SESSION['username'];
		$result=mysqli_query($con,"select life2_2 from users where name='$username'");
		$rows=mysqli_fetch_array($result);
					if($rows[0]==0)
					{
					$username=$_SESSION['username'];
					$result=mysqli_query($con,"update users set life2_2=1 where name='$username'");
					$result=mysqli_query($con,"update users set score=(score-1) where name='$username'");
					}
					
					$result=mysqli_query($con,"select lifeline2 from questions where qno=2");
					$rows=mysqli_fetch_array($result);
					header('Location: '.$rows[0].'');
		}

echo'<br><br><br>
<footer><center><u><b><a href="leaderboard.php"><font color="white">Leaderboard</a> &nbsp;&nbsp;&nbsp;&nbsp;<a href="https://www.facebook.com/pages/Decipher/173912556090728" target="_blank"><font color="white">Discussion</a> &nbsp;&nbsp;&nbsp;&nbsp;    <a href="rules.php"><font color="white">Rules & Regulations</a>   &nbsp;&nbsp;&nbsp;  <a href="prizes.php"><font color="white">Prizes</a>  &nbsp;&nbsp;&nbsp;   <a href="contact.php"><font color="white">Contact</a></center></footer></body>
';
}
		else
		{
		include ("connect.php");
		$result=mysqli_query($con,"select qdesc,lifeline1,lifeline2,imagename,answer from questions where qno=2");
		$rows=mysqli_fetch_array($result);
		if($_POST['q2']==$rows[4])		
			{
			$username=$_SESSION['username'];
			$result=mysqli_query($con,"update users set score=(score+10) where name='$username'");
			// session['level'] aur level ko bhi barhana hoga
			$_SESSION['level']=3;
			$result=mysqli_query($con,"update users set level=(level+1) where name='$username'");
			header('Location: nonsense.php');
			}
			else header('Location: q2.php');
		}
}
else header('Location: rules.php');
?>
</html>