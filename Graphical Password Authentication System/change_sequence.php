<?php
session_start();
?>
<?php

include("connect.php");



$username=$_SESSION['uname'];
$image1=$_SESSION['a1'][1];
$image2=$_SESSION['a1'][2];
$image3=$_SESSION['a1'][3];
$image4=$_SESSION['a1'][4];
$image5=$_SESSION['a1'][5];



$query1="update user set image1='$image1' where username='$username'";
$query2="update user set image2='$image2' where username='$username'";
$query3="update user set image3='$image3' where username='$username'";
$query4="update user set image4='$image4' where username='$username'";
$query5="update user set image5='$image5' where username='$username'";


$result=mysqli_query($con,$query1);
$result=mysqli_query($con,$query2);
$result=mysqli_query($con,$query3);
$result=mysqli_query($con,$query4);
$result=mysqli_query($con,$query5);

$_SESSION['a'][1]=$image1;
$_SESSION['a'][2]=$image2;
$_SESSION['a'][3]=$image3;
$_SESSION['a'][4]=$image4;
$_SESSION['a'][5]=$image5;
				



echo '<center><font size="4" color="blue">Sequence Changed!!!</font></center><br>';

	
echo '<center><font size="4" color="blue"><a href="account.php">Go back!</a></font></center><br>';
		?>