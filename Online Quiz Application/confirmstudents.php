	<?php 
		session_start();
if($_SESSION['name']=='admin')
{ 
	if(!isset($_POST['sub']))// if not submitted - please check
	{
	?>
	<html>
	<head>
		<title> Confirm Students by Roll
		</title>
	</head>
	<body bgcolor="blue" text="white">
	<center><font face="verdana">
	<h2>Confirm Students Page </h2><hr>
	<form name="form8" action="confirmstudents.php" method="post">	
	Student Roll : <input  type="number" name="roll"><br>
	<input  type="submit" name="sub" value="Submit"><br>
	</form>
	<?php
	}
			else //if into submitted do the following code
			{
			//connection code starts
			$server="localhost";
			$user="root";
			$password="";
			$database="quiz";
			$con=mysqli_connect($server,$user,$password,$database);
			
			if(!$con)
			{
			echo 'Database error !';
			}
					else
					{
					//connection code ends
					$roll=$_POST['roll'];
						if($roll <=0) {echo'<br><center>Please enter a valid roll number !<br><a href="confirmstudents.php">Click here to confirm another student</a>';exit;}
						echo '<center>';
						$result1 = mysqli_query($con,"SELECT roll FROM users WHERE roll = $roll");
							if($result1)
							{
								if (mysqli_num_rows($result1)>0) 
								{
									// some data matched
									$result=mysqli_query($con,"update users set status=3 where roll=$roll");
									if($result)
									{
									echo '<center>Successfully confirmed !!<br><a href="confirmstudents.php">Click here to confirm another student</a>';
									}
									else echo 'Please enter a roll number !!<br><a href="confirmstudents.php">Click here to confirm another student</a>';
								}
								else echo 'No such roll number in database !!<br><a href="confirmstudents.php">Click here to confirm another student</a>';
							}
							else echo 'Please enter a roll number !!<br><a href="confirmstudents.php">Click here to confirm another student</a>';
					
					}
			}
			
			
				echo'	</center></center><br><br><br><br><br><br><br><br><br><br><br><hr><a href="welcome.php"><i><font color="white">Home</font></i></a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;</font><a href="logout.php"><font color="white">Logout</font></a>';
			echo '</b>';echo '';
			
	
	}
	else header('Location: Login.php');
	?>
	</body>
</html>