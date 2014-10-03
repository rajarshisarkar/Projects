<html>
<head><title>Registration</title>
	</head>
	<body bgcolor="blue" text="white">
<?php
	echo'<font face="verdana">';
	if(!isset($_POST['register']))
	{
	echo'
		<center><h2>Student Registration Page</h2><hr>
		<form name="form1" action="regi.php" method="post">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name : <input type="text" name="name"><br>
		&nbsp;&nbsp;&nbsp;&nbsp;Password : <input type="password" name="password"><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Roll : <input type="number" name="roll"><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Phone : <input type="number" name="phone"><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email : <input type="text" name="email"><br>
		&nbsp;Department : <input type="text" name="department"><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" name="register" value="Register">
		<hr>
		</form>
		
	';
	}
		else
		{ 
		$server="localhost";
		$user="root";
		$password="";
		$database="quiz";
		$con=mysqli_connect($server,$user,$password,$database);
			if(!$con)
			echo 'Connection failed !';
				else
				{
				$name=$_POST['name'];
				$password=$_POST['password'];
				$roll=$_POST['roll'];
				$phone=$_POST['phone'];
				$email=$_POST['email'];
				$department=$_POST['department'];
				$query="INSERT into users(name,password,roll,phone,email,department,status) values ('$name','$password',$roll,$phone,'$email','$department',2)";
				$result = mysqli_query($con,$query); 
						if($result) 
						{
						echo '<center>Student successfully registered <br><a href="Login.php"><font face ="verdana" color="white">Click here to Login</font></a>!';
						}
						else echo 'Problem with registration !';
				
				}
		}
		echo '</font>';

?>
</body>
</html>