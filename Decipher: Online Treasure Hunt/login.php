<?php
session_start();
ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><link rel="stylesheet" href="css.css" type="text/css"/>
<link rel="shortcut icon" href="photos/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>

<script>
			function validate()
			{
			var name=document.forms["login"]["name"].value;
			var password=document.forms["login"]["password"].value;
			
			
			if ((password==null || password=="") && !(name==null || name==""))
			{
			alert("Please enter your password !!");return false;
			}
			
			if (!(password==null || password=="") && (name==null || name=="")  )
			{
			alert("Please enter your name !!");return false;
			}
			
			if ((name==null || name=="") && (password==null || password==""))
			{
			alert("Please enter your name !! \nPlease enter your password !!");return false;
			}
			else
			return true;
			}
			
		</script>
		<noscript>Your Javascript is off !! </noscript>

</head>

<body bgcolor="#333333" text="#FFFFFF" marginwidth="45">
<?php
include("connect.php");
if(!isset($_POST['submit']))
{
echo'<br><center><b><font face="calibri" color="red" size=8>de</font><font face="calibri" size ="8">cipher</font></b></center>
<hr color="#CC0000">';
  include ("connect.php");
  $result=mysqli_query($con,"select notice1 from notice where sno=0");
  $rows=mysqli_fetch_array($result);
echo'<marquee><b>'.$rows[0].'</b></marquee><br><br><br>';
           		echo'<strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                
<font size="5">Login</strong><br></font>
        </h2>
<form name="login" action="login.php" method="post" onSubmit="return validate();" >
<p align="right">
Username : <input type ="text" name="name"><br>
Password : <input type="password" name="password"><br>
<input type="submit" value="Login" name="submit">
</p>
</form>
<p align="right">
You will begin from where you were struck !<br>
If you are not registered then register <i><a href="signup.php"><font color="white">here</font></a></i><br></p><p align="right"><i>Designed by Rajarshi Sarkar</i></p><br><br><br><br><br><br><br><br><br><br><br>
<footer><center><u><b><a href="leaderboard.php"><font color="white">Leaderboard</a> &nbsp;&nbsp;&nbsp;&nbsp;<a href="https://www.facebook.com/pages/Decipher/173912556090728" target="_blank"><font color="white">Discussion</a> &nbsp;&nbsp;&nbsp;&nbsp;    <a href="rules.php"><font color="white">Rules & Regulations</a>   &nbsp;&nbsp;&nbsp;  <a href="prizes.php"><font color="white">Prizes</a>  &nbsp;&nbsp;&nbsp;   <a href="contact.php"><font color="white">Contact</a></center></footer>';
}
		else
		{
			session_start();
			$name=$_POST['name'];
			//$name=mysql_real_escape_string($name);
			$password=$_POST['password'];
			//$password=mysql_real_escape_string($password);
				if($name=='admin' && $password==666)
				{
				$_SESSION['username']=$name;header("Location: admindash.php");return;exit;
				}
			$query="select * from users where name='$name' and password='$password' and level>0 and huntstatus=1" ;
			//echo $query;
			$result=mysqli_query($con,$query);
			if($result)
			{
				$rows=mysqli_num_rows($result);
				if($rows>0)
				{ 
					//$_SESSION['name']='normaluser';
					//$_SESSION['animal']=''.$name.'';
					//$_SESSION['password']=$pass;// session ka variable set kar rahe hai
					 //if(SESSION level == 2)
					 $row=mysqli_fetch_array($result);
					//if($row[5]==1)
					$_SESSION['username']=$name;
					$_SESSION['normaluser']='normaluser';
					$_SESSION['level']=$row[5];
					if($_SESSION['level']==1)
					header("Location: easy.php");
					else if($_SESSION['level']==2)
					header("Location: q2.php");
					else if($_SESSION['level']==3)
					header("Location: nonsense.php");
					else if($_SESSION['level']==4)
					header("Location: brofist.php");
					else if($_SESSION['level']==5)
					header("Location: candle.php");
					else if($_SESSION['level']==6)
					header("Location: sweet.php");
					else if($_SESSION['level']==7)
					header("Location: dabangg.php");
					else if($_SESSION['level']==8)
					header("Location: hot.php");
					else if($_SESSION['level']==9)
					header("Location: aussie.php");
					else if($_SESSION['level']==10)
					header("Location: tall.php");
					else if($_SESSION['level']==11)
					header("Location: 1947.php");
					else if($_SESSION['level']==12)
					header("Location: dhoom.php");
					else if($_SESSION['level']==13)
					header("Location: hide.php");
					else if($_SESSION['level']==14)
					header("Location: superhero.php");
					else if($_SESSION['level']==15)
					header("Location: share.php");
					else if($_SESSION['level']==16)
					header("Location: god.php");
					else if($_SESSION['level']==17)
					header("Location: degree.php");
					else if($_SESSION['level']==18)
					header("Location: inceptionofgames.php");
					else if($_SESSION['level']==19)
					header("Location: hospital.php");
					else if($_SESSION['level']==20)
					header("Location: final_level.php");
					else if($_SESSION['level']==21)
					header("Location: congrats.php");
				}
				else
				{	
				$query="select name,password,level,huntstatus from users where name='$name' and password='$password'" ;
				$result=mysqli_query($con,$query);
				$row=mysqli_fetch_array($result);
				$rows=mysqli_num_rows($result);
				if($rows==0)
				echo '<br><center><b><font face="calibri" color="red" size=8>de</font><font face="calibri" size ="8">cipher</font></b></center>
				<hr color="#CC0000"><center>No such user exists in our database !<br>Maybe you entered something wrong !<br><a href="login.php"><font color="white">Click here to go back</a><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				<br><footer><center><u><b><a href="leaderboard.php"><font color="white">Leaderboard</a> &nbsp;&nbsp;&nbsp;&nbsp;<a href="https://www.facebook.com/pages/Decipher/173912556090728" target="_blank"><font color="white">Discussion</a> &nbsp;&nbsp;&nbsp;&nbsp;    <a href="rules.php"><font color="white">Rules & Regulations</a>   &nbsp;&nbsp;&nbsp;  <a href="prizes.php"><font color="white">Prizes</a>  &nbsp;&nbsp;&nbsp;   <a href="contact.php"><font color="white">Contact</a></center></footer>';

				else if($row[2]<0)				
				echo '<br><center><b><font face="calibri" color="red" size=8>de</font><font face="calibri" size ="8">cipher</font></b></center>
				<hr color="#CC0000"><center>You are registered but banned by the admin !<br><a href="login.php"><font color="white">Click here to go back</a><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				<br><br><footer><center><u><b><a href="leaderboard.php"><font color="white">Leaderboard</a> &nbsp;&nbsp;&nbsp;&nbsp;<a href="https://www.facebook.com/pages/Decipher/173912556090728" target="_blank"><font color="white">Discussion</a> &nbsp;&nbsp;&nbsp;&nbsp;    <a href="rules.php"><font color="white">Rules & Regulations</a>   &nbsp;&nbsp;&nbsp;  <a href="prizes.php"><font color="white">Prizes</a>  &nbsp;&nbsp;&nbsp;   <a href="contact.php"><font color="white">Contact</a></center></footer>';

				else if ($row[3]!=1)
				echo '<br><center><b><font face="calibri" color="red" size=8>de</font><font face="calibri" size ="8">cipher</font></b></center>
				<hr color="#CC0000"><center>You are registered but the hunt has not started yet !<br>Return back when the hunt has started !<br><a href="login.php"><font color="white">Click here to go back</a><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				<br><footer><center><u><b><a href="leaderboard.php"><font color="white">Leaderboard</a> &nbsp;&nbsp;&nbsp;&nbsp;<a href="https://www.facebook.com/pages/Decipher/173912556090728" target="_blank"><font color="white">Discussion</a> &nbsp;&nbsp;&nbsp;&nbsp;    <a href="rules.php"><font color="white">Rules & Regulations</a>   &nbsp;&nbsp;&nbsp;  <a href="prizes.php"><font color="white">Prizes</a>  &nbsp;&nbsp;&nbsp;   <a href="contact.php"><font color="white">Contact</a></center></footer>';

				}
			}
			//else echo '<center>Either you are not registered OR you are not confirmed by admin OR the hunt has not started yet!<br><a href="login.php"><font color="white">Click here to go back</a>';
		}
?>
</body>
</html>