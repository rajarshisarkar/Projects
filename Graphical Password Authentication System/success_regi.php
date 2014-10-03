<?php
session_start();
ob_start();
?>
<html>
<head>
<title>
Successful!!
</title>
</head>
<?php
echo '<body bgcolor="#333333" text="#FFFFFF" marginwidth="45"> <br><center><b><font face="calibri" color="red" size=8>Graph</font><font face="calibri" size ="8">ical Password Authentication System</font></b></center>
<hr color="#CC0000"><center><b><br>You have succesfully registered !<br><a href="login.php"><font color="white">Click here to login</font></b></a>';
?>

<?php
include('connect.php');		
	$var=$_GET['var'];
    $_SESSION['a'][10]=$_GET['var'];
	
$name=$_SESSION['a'][0];
$password=$_SESSION['a'][1];
$realname=$_SESSION['a'][2];
$collname=$_SESSION['a'][3];
$email=$_SESSION['a'][4];
$phone=$_SESSION['a'][5];
$image1=$_SESSION['a'][6];
$image2=$_SESSION['a'][7];
$image3=$_SESSION['a'][8];
$image4=$_SESSION['a'][9];
$image5=$_SESSION['a'][10];

$query="INSERT into user(username,password,name,clg,email,phone,image1,image2,image3,image4,image5,userimage) 
values('$name','$password','$realname','$collname','$email',$phone,'$image1','$image2','$image3','$image4','$image5','images/default.jpg')";
$result=mysqli_query($con, $query);
?>
<?php
echo '<footer><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><i><p align="right">Designed by <a href="https://www.facebook.com/RaJarshiSarkar"><font color="white">Rajarshi Sarkar</font></a> and <a href="https://www.facebook.com/saurabh290493"><font color="white">Saurabh Garg</font></a></i></footer>';			
?>
</body>
</html>