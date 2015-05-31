<?php
session_start();
ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><link rel="shortcut icon" href="photos/favicon.ico"><link rel="stylesheet" href="css.css" type="text/css"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Un-Ban a Participant</title>
</head>
<?php
if($_SESSION['username']=='admin')
{
include ("connect.php");
if(!isset($_GET['submit']))
{
echo '
<body bgcolor="#333333" text="#FFFFFF" marginwidth="45">
 <form name="form23" action="unban_get.php" method="get">
 Phone : <input type="number" name="phone"><br>
 <input type="submit" name="submit" value="Un-Ban">
 
 </form>


';
}

		else
		{
			//echo 'aloo';// yahan kaam chal raha tha
			$phone=$_GET['phone'];
			//$password=$_POST['password'];
			$query="select * from users where phone=$phone" ;
			//echo $query;
			$result=mysqli_query($con,$query);
			if($result)
			{
				if(mysqli_num_rows($result)>0)
				{ 
								$rowdata=mysqli_fetch_array($result);

								$result1=mysqli_query($con,"update users set level=1 where phone=$phone");
								header('Location: banparticipant.php');
								
				}
				
			}
		}
		//http://localhost/finalproject/unban_get.php?phone=9465652315&submit=Un-Ban
				}

		else header('Location: logout.php');
?>
</body>
</html>
