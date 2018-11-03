

<html>
<head><title>Welcome</title>
	</head>
	<body bgcolor="yellow" text="black">
<?php
echo'<font face="verdana"><b>';

echo'<center><h2>Welcome Page</h2><hr><br>';


session_start();
if($_SESSION['name']=='admin')
{ 



	
	echo'<center>&nbsp;&nbsp;&nbsp;&nbsp;1. <a href="showstudents.php"><font color="white">Students List</font></a><br>
	&nbsp;&nbsp;&nbsp;&nbsp;2. <a href="regi.php"><font color="white">Add Student </font></a><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3. <a href="deletestudents.php"><font color="white">Delete Student </font></a><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4. <a href="confirmstudents.php"><font color="white">Confirm Student </font></a><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5. <a href="quiz.php"><font color="white">Add Question</font></a><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6. <a href="quiz.php"><font color="white">Delete Question </font></a><br>
	7. <a href="Result.php"><font color="white">See Result</font></a><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8. <a href="startquiz.php"><font color="white">Start / Stop Quiz</font></a>';
	echo'</b></font><br><br><hr><p align="right"><a href="logout.php"><font color="white">Logout</font></a></p>';
	
}
else if($_SESSION['name']=='normaluser')
{ 
echo '<center>&nbsp;&nbsp;1. <a href="startfresh.php"><font color="white">Take Quiz</font></a><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. <a href="Result.php"><font color="white">View Result </font></a><br>';
		echo'</b></font><br><br><hr><p align="right"><a href="logout.php"><font color="white">Logout</font></a></p>';
}
else header('Location: Login.php');
?>

</body>
</html>
