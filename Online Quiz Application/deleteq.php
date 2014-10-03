	<?php 
		session_start();
if($_SESSION['name']=='admin')
{ 
	if(!isset($_POST['sub']))// if not submitted - please check
	{
	?>
	
	<html>
	<head>
		<title> Delete Questions by Q No.
		</title>
	</head>
	<body bgcolor="blue" text="white">
	<center><font face="verdana">
	<h2>Delete Questions Page </h2><hr>
	<form name="form10" action="deleteq.php" method="post">	
	Q No. : <input  type="number" name="number"><br>
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
						$number=$_POST['number'];
						if($number <=0) {echo'<br><center>Please enter a valid Q No.!<br><a href="deleteq.php">Click here to delete another Question</a>';exit;}
						echo '<center>';
						$result1 = mysqli_query($con,"SELECT number FROM questions WHERE number = $number");
							if($result1)
							{
								if (mysqli_num_rows($result1)>0) 
								{
									// some data matched
									$result=mysqli_query($con,"delete from questions where number = $number");
									if($result)
									{
									echo '<center>Successfully deleted<br><a href="deleteq.php">Click here to delete another Question</a>';
									}
									else echo 'Please enter a Q No. !!<br><a href="deleteq.php">Click here to delete another Question</a>';
								}
								else echo 'No such Q No. in database !!<br><a href="deleteq.php">Click here to delete another Question</a>';
								
							}
							else echo 'Please enter a Q No. !!<br><a href="deletestudents.php">Click here to delete another student</a>';
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