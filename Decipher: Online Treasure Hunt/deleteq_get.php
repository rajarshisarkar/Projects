<?php
session_start();
ob_start();
?>
<head><link rel="shortcut icon" href="photos/favicon.ico"><link rel="stylesheet" href="css.css" type="text/css"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Delete Questions</title>
</head>

<body bgcolor="#333333" text="#FFFFFF" marginwidth="45">
<?php
if($_SESSION['username']=='admin')
{
include("connect.php");
if(!isset($_GET['submit']))
{
echo'<form name="form3" action="deleteq_get.php" method="get">
Q No. <input type="number" name="qno"><br>
<input type="submit" value="Delete" name="submit">
</form>';			
}
		else
		{
			$qno=$_GET['qno'];
			$query="delete from questions where qno=$qno";
			$result=mysqli_query($con,$query);
			echo 'Question Successfully deleted !<a href="deleteq_get.php"><font color="white"><br>Click here to delete another Question</a>';
			header('Location: deleteq.php');
			//deleteq_get.php?qno=1&submit=Delete
				
		}
		
		}

		else header('Location: logout.php');
?>
</html>
