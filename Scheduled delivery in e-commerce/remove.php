<?php
	session_start();
	ob_start();
		if($_SESSION['username']!=''){
				include ("connect.php");
				$iddel = $_GET['del'];
				$query="select cart from users where username='".$_SESSION['username']."'";
				$result=mysqli_query($con,$query);
				$row=mysqli_fetch_array($result);
				//echo $row[0];
				$row[0] = str_replace($iddel.';', "", $row[0]);
				$row[0] = str_replace(';'.$iddel, "", $row[0]);
				$row[0] = str_replace($iddel, "", $row[0]);
				//echo '<br>'.$row[0];
				
				$query="update users set cart = '".$row[0]."' where username='".$_SESSION['username']."'";
				//echo '<br>'.$query;
				$result=mysqli_query($con,$query);
				header("Location: cart.php");
			}
		else{
			header("Location: index.php");
		}
?>