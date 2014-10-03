
<?php
session_start();
?>
<?php

include("connect.php");

	
$old=$_POST['old'];
$new=$_POST['new'];

$username=$_SESSION['uname'];

$query="select * from user where username='$username' and password='$old' ";
$query2="update user set password='$new' where username='$username'";
$result=mysqli_query($con,$query);
$row=mysqli_fetch_array($result);
$rows=mysqli_num_rows($result);
				
if($rows==0) {echo '<center><font size="4" color="blue">Wrong old password!!!</font></center><br>';}

else{$result2=mysqli_query($con,$query2);
echo '<center><font size="4" color="blue">Password Updated!!!</font></center><br>';
}
	
echo '<center><font size="4" color="blue"><a href="account.php">Go back!</a></font></center><br>'
		?>