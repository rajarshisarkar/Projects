		<?php
	session_start();
if($_SESSION['name']=='admin')
{ 
	if(!isset($_GET['sub']))// if not submitted - please check
	{
	?>
	
	<html>
	<head>
		<title> Delete Students by Roll
		</title>
	</head>
	<body bgcolor="blue" text="white">
	<center><font face="verdana">
	<h2>Delete Students Page </h2><hr>
	<form name="form5" action="deletestudents_get.php" method="get">	
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
						$roll=$_GET['roll'];
						if($roll <=0) {echo'<br><center>Please enter a valid roll number !<br><a href="deletestudents.php.php">Click here to delete another student</a>';exit;}
						echo '<center>';
						$result1 = mysqli_query($con,"SELECT roll FROM users WHERE roll = $roll");
							if($result1)
							{
								if (mysqli_num_rows($result1)>0) 
								{
									// some data matched
									$result=mysqli_query($con,"delete from users where roll=$roll");
									if($result)
									{
									echo '<center>Successfully deleted<br><a href="deletestudents.php">Click here to delete another student</a>';
									header('Location: showstudents.php');
									}
									else echo 'Please enter a roll number !!<br><a href="deletestudents.php">Click here to delete another student</a>';
								}
								else echo 'No such roll number in database !!<br><a href="deletestudents.php">Click here to delete another student</a>';
								
							}
							else echo 'Please enter a roll number !!<br><a href="deletestudents.php">Click here to delete another student</a>';
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