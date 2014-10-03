	<html>
	<head>
		<title> Show all Students
		</title>
	</head>
	<body bgcolor="blue" text="white">
	<center><font face="verdana">
		<h2>Show all Students </h2><hr>
	<?php
	session_start();
if($_SESSION['name']=='admin')
{ 
		//connection code starts
		$server="localhost";
		$user="root";
		$password="";
		$database="quiz";
		$con=mysqli_connect($server,$user,$password,$database);
		if(!$con)
		{
		echo 'database error';
		}
			else
			{
			echo '<center><table border="1" width="1300"><th>Name</th><th>Roll</th><th>Phone</th><th>Email</th><th>Department</th><th>Delete ?</th><th>Change Status</th>';
			$query="select * from users";
			$result=mysqli_query($con,$query);
				if($result)
				{
					while ($row=mysqli_fetch_array($result)) // jab tak usko data milte rahe //  jab tak usko row mein value milte rahega
					{
					if($row[6]==2)
					echo'<tr><td><center>'.$row[0].'</td><td><center>'.$row[2].'</td><td><center>'.$row[3].'</td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center><a href="deletestudents_get.php?roll='.$row[2].'&sub=Submit"><font color="white">Delete</font></a></td><td><center><a href="confirmstudents_get.php?roll='.$row[2].'&sub=Submit"><font color="white">Confirm</font></a></td></tr>';
					else if($row[6]==3)
					echo'<tr><td><center>'.$row[0].'</td><td><center>'.$row[2].'</td><td><center>'.$row[3].'</td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center><a href="deletestudents_get.php?roll='.$row[2].'&sub=Submit"><font color="white">Delete</font></a></td><td><center><a href="unconfirmstudents_get.php?roll='.$row[2].'&sub=Submit"><font color="white">Un-confirm</font></a></td></tr>';
					else
					echo'<tr><td><center>'.$row[0].'</td><td><center>'.$row[2].'</td><td><center>'.$row[3].'</td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center><a href="deletestudents_get.php?roll='.$row[2].'&sub=Submit"><font color="white">Delete</font></a></td><td><center>Appeared for test</td></tr>';
					
					}
				echo '</table>';
				}
			}
			echo'	</center></center><br><br><hr><a href="welcome.php"><i><font color="white">Home</font></i></a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;</font><a href="logout.php"><font color="white">Logout</font></a>';
			echo '</b>';echo '';
			
	
	}
	else header('Location: Login.php');
	?>
	
	</body>
</html>