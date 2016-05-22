<?php
session_start();
ob_start();
?>
<html>
	<head>
		<script>
			function validate(){
				var currpass=document.forms["register"]["currentpassword"].value;
				var password=document.forms["register"]["newpassword1"].value;
				var repassword=document.forms["register"]["newpassword2"].value;
				
				if ((repassword==null || repassword=="")){
					alert("All fields are compulsory. Please fill in the empty fields.");
					return false;
				}

				if ((password==null || password=="")){
					alert("All fields are compulsory. Please fill in the empty fields.");
					return false;
				}
			
				if ((currpass==null || currpass=="")){
					alert("All fields are compulsory. Please fill in the empty fields.");
					return false;
				}
				
				if(password!=repassword){
					alert("New passwords do not match. Please provide the same password.");
					return false;
				}
				else
					return true;
			}
		</script>
	
		<noscript>
			Your Javascript is off !! 
		</noscript>
		<style>
		body{
			background-image: url("images/background.bmp");
			background-repeat: repeat;
		}
		</style>
		<title>
			Change Password
		</title>
		<link rel="icon" href="images/favicon.png" type="image/png" sizes="20x20">
	</head>

<?php
	if($_SESSION['username']!=''){
		
		if(!isset($_POST['submit'])){
			if($_SESSION['username']!='admin')
				echo '<body><center><p><u><b>Change Password</b></u></p>Hello '.$_SESSION['username'].'!<br><br><a href="home.php">Home</a>&nbsp;&nbsp;<a href="cart.php">My cart</a>&nbsp;&nbsp;<a href="orders.php">My orders</a>&nbsp;&nbsp;<a href="logout.php">Logout</a><br><br></center>';
			else
				echo '<body><center><p><u><b>Change Password</b></u></p>Hello '.$_SESSION['username'].'!<br><br><a href="adminhome.php">Home</a>&nbsp;&nbsp;<a href="logout.php">Logout</a><br><br></center>';
			
			echo '<center><table>
				<form name="register" method="post" onSubmit="return validate();" >
				<tr><td align="right">Current password : </td><td><input type ="password" name="currentpassword"></td></tr>
				<tr><td align="right">New password : </td><td><input type ="password" name="newpassword1"></td></tr>
				<tr><td align="right">Re-enter new password : </td><td><input type ="password" name="newpassword2"></td></tr>
				<tr><td></td><td align="center"><input type="submit" value="Change password" name="submit"></td></tr>
				</form></center>
				</table>';
		}
		else{
			if($_SESSION['username']!='admin')
				echo '<body><center><p><u><b>Change Password</b></u></p>Hello '.$_SESSION['username'].'!<br><br><a href="home.php">Home</a>&nbsp;&nbsp;<a href="cart.php">My cart</a>&nbsp;&nbsp;<a href="orders.php">My orders</a>&nbsp;&nbsp;<a href="logout.php">Logout</a><br><br></center>';
			else
				echo '<body><center><p><u><b>Change Password</b></u></p>Hello '.$_SESSION['username'].'!<br><br><a href="adminhome.php">Home</a>&nbsp;&nbsp;<a href="logout.php">Logout</a><br><br></center>';
			
			include ("connect.php");
			$query="select password from users where username='".$_SESSION['username']."'";
			$result=mysqli_query($con,$query);
			$rows=mysqli_fetch_array($result);
			if($rows[0]==$_POST['currentpassword']){
				//echo $rows[0];
				//echo $_POST['currentpassword'];
				$query = "update users set password='".$_POST['newpassword1']."' where username='".$_SESSION['username']."'";
				$result = mysqli_query($con,$query);
				echo '<br><center>Password has been changed successfully.</center>';
			}
			else{
				//echo $query;
				//echo $rows[0];
				//echo $_POST['currentpassword'];
				echo '<br><center>Wrong current password entered.</center>';
			}
		}
		//$query=
	}
	else{
		header("Location: index.php");
	}
?>
</body>
</html>