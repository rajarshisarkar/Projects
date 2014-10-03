	<html>
	<head>
		<title> Show all Questions
		</title>
	</head>
	<body bgcolor="blue" text="white">
	<center><font face="verdana">
		<h2>Show all Questions </h2><hr>
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
			echo '<center><table border="1" width="1300"><th>Q No.</th><th>Question</th><th>Option1</th><th>Option2</th><th>Option3</th><th>Option4</th><th>Answer</th><th>Delete ?</th>';
			$query="select * from questions";
			$result=mysqli_query($con,$query);
				if($result)
				{
					while ($row=mysqli_fetch_array($result)) // jab tak usko data milte rahe //  jab tak usko row mein value milte rahega
					{
					//if($row[6]==2)
					echo'<tr><td><center>'.$row[0].'</td><td><center>'.$row[1].'</td><td><center>'.$row[2].'</td><td><center>'.$row[3].'</td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center><a href="deleteq_get.php?number='.$row[0].'&sub=Submit"><font color="white">Delete</font></a></td></tr>';
					
					}
				echo '</table>';
				}
				echo'	<br><a href="addquiz.php"><font color="white">Click here to add another question</font></a>';
			}

						echo'	</center></center><br><br><br><br><br><br><hr><a href="welcome.php"><i><font color="white">Home</font></i></a>
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