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
<body> You successfully selected the image sequence ! <br>

<?php
include('connect.php');		
$_SESSION['layer5']=$_GET['var'];
$name=$_SESSION['uname'];
$layer1=$_SESSION['layer1'];
$layer2=$_SESSION['layer2'];
$layer3=$_SESSION['layer3'];
$layer4=$_SESSION['layer4'];
$layer5=$_SESSION['layer5'];

	$result=mysqli_query($con,"select image1,image2,image3,image4,image5 from user where username='$name'");
		if (mysqli_num_rows($result)>0)
		{
		$row=mysqli_fetch_array($result);
		/*echo 'In database : <br>'.$row[0].'<br>';
		echo ''.$row[1].'<br>';
		echo ''.$row[2].'<br>';
		echo ''.$row[3].'<br>';
		echo ''.$row[4].'<br><br>My selection :<br>';
		
		echo ''.$layer1.'<br>';
		echo ''.$layer2.'<br>';
		echo ''.$layer3.'<br>';
		echo ''.$layer4.'<br>';
		echo ''.$layer5.'<br>';*/
		if($row[0]==$layer1 && $row[1]==$layer2 && $row[2]==$layer3 && $row[3]==$layer4 && $row[4]==$layer5)
		header('Location:account.php');
		else 
		{
		header('Location:layer1_login.php');
		$_SESSION['selectagain']=1;
		}
		}
		



/*$query="INSERT into user(username,password,name,clg,email,phone,image1,image2,image3,image4,image5) 
values('$name','$password','$realname','$collname','$email',$phone,'$image1','$image2','$image3','$image4','$image5')";
$result=mysqli_query($con, $query);*/
?>
</body>
</html>