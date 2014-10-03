<?php
session_start();
session_destroy();
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
echo'<br><center><b><font face="calibri" color="red" size=8>Graph</font><font face="calibri" size ="8">ical Password Authentication System</font></b></center>
<hr color="#CC0000">';
  
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
If you are not registered then register <i><a href="signup.php"><font color="white">here</font></a></i><br></p><br><br><br><br><br><br><br><br><br><br><br><br>
<footer><br><br><br><i><p align="right">Designed by <a href="https://www.facebook.com/RaJarshiSarkar"><font color="white">Rajarshi Sarkar</font></a> and <a href="https://www.facebook.com/saurabh290493"><font color="white">Saurabh Garg</font></a></i></footer>';			

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
				$_SESSION['uname']=$name;header("Location: admindash.php");return;exit;
				}
			$query="select * from user where username='$name' and password='$password'" ;
			//echo $query;
			$result=mysqli_query($con,$query);
			if($result)
			{
				$rows=mysqli_num_rows($result);
				if($rows>0)
				{ 
					
					$row=mysqli_fetch_array($result);
					//if($row[5]==1)
					$_SESSION['uname']=$name;
					//header('Location:account.php');
					header('Location:layer1_login.php');
					
				}
				else
				{	
				$query="select * from user where username='$name' and password='$password'" ;
				$result=mysqli_query($con,$query);
				$row=mysqli_fetch_array($result);
				$rows=mysqli_num_rows($result);
				if($rows==0)
				echo'<br><center><b><font face="calibri" color="red" size=8>Graph</font><font face="calibri" size ="8">ical Password Authentication System</font></b></center>
				<hr color="#CC0000"><center>No such user exists in our database !<br>Maybe you entered something wrong !<br><a href="login.php"><font color="white">Click here to go back</a><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				<footer><i><p align="right">Designed by <a href="https://www.facebook.com/RaJarshiSarkar"><font color="white">Rajarshi Sarkar</font></a> and <a href="https://www.facebook.com/saurabh290493"><font color="white">Saurabh Garg</font></a></i></footer>';			

				}
			}
			//else echo '<center>Either you are not registered OR you are not confirmed by admin OR the hunt has not started yet!<br><a href="login.php"><font color="white">Click here to go back</a>';
		}
?>
</body>
</html>