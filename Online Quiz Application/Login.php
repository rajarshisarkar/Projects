	<?php
	session_start();
	include("connect.php");
	?>
<html>
<head><title>Online Quiz</title>
	</head>
	<body bgcolor="yellow" text="black">
<?php
		if(!isset($_POST['login']))
	{
	?>
<?php		
echo'<font face="verdana">';
echo'
	<center><h2>Online Quiz</h2><hr>
	<form name="form247" action="Login.php" method="post"><br><br><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name : <input type="text" name="name"><br>
	Password : <input type="password" name="pass"><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<center><input type="submit" name="login" value="Submit"></center><br><br><br>
	<hr><center><a href="regi.php"><font face="verdana" color="black">New Users Register here</font></a></center>
	</form>
	
';
echo '</font>';
?>
<?php
	}
	else
	{
		$name=$_POST['name'];
		$pass=$_POST['pass'];
		if($name=='admin' and $pass==666) {$_SESSION['name']=''.$name.''; header("Location: welcome.php");}
		$query="select * from users where name='$name' and password=$pass and status=4" ;
		//echo $query;
		$result=mysqli_query($con,$query);
		if($result)
		{
			$rows=mysqli_num_rows($result);
			if($rows>0)
			{
				$_SESSION['name']='normaluser';
				$_SESSION['animal']=''.$name.'';
				$_SESSION['password']=$pass;// session ka variable set kar rahe hai
				 
				header("Location: welcome.php");
			}
			else
			echo 'Either you are not registered or you are not confirmed by admin !';
		}
		else echo 'Either you are not registered or you are not confirmed by admin !';
	}
	
	
	?>
</body>
</html>
