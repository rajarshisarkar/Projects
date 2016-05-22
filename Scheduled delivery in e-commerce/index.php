<?php
	session_start();
	ob_start();
	//session_save_path("/var/www/html/hackathon");
?>

<!DOCTYPE html>
<html>
<link href="http://www.w3schools.com/lib/w3.css">
	<head>
		<script>
			function validate(){
				var name=document.forms["login"]["nameu"].value;
				var password=document.forms["login"]["namepass"].value;
						
				if ((password==null || password=="") && !(name==null || name=="")){
					alert("Please enter your password !!");
					return false;
				}
			
				if (!(password==null || password=="") && (name==null || name=="")){
					alert("Please enter your username !!");
					return false;
				}
			
				if ((name==null || name=="") && (password==null || password=="")){
					alert("Please enter your username !! \nPlease enter your password !!");
					return false;
				}
				else
					return true;
			}
		</script>
	
		<noscript>
			Your Javascript is off !! 
		</noscript>
		
		<link rel="icon" href="images/favicon.png" type="image/png" sizes="20x20">
		
		<title>
			Login Page
		</title>
		
		<style>
		body{
			background-image: url("images/background.bmp");
			background-repeat: repeat;
		}
		</style>
	</head>

	<body>
		<?php 
			if(!isset($_POST['submit'])){
				echo '<center><p><u><b>Login Page</b></u></p>
				<table>
				<form name="login" method="post" onSubmit="return validate();" >
				<tr><td align="right">Username:</td><td><input type ="text" name="nameu"></td></tr>
				<tr><td align="right">Password:</td><td><input type ="password" name="namepass"></td></tr>
				<tr><td align="right"></td><td align="center"><input type="submit" value="Login" name="submit"></td></tr>
				<tr><td align="right"></td><td align="center"><a href="register.php">Register</a></td></tr></center>
				</form>
				</table> 
				<br><br>
				';
			}
			else if(isset($_POST['submit'])){
				$name=$_POST['nameu'];
				$pass=$_POST['namepass'];
				$_SESSION['username']=$name;
				include ("connect.php");
				$query="select * from users where username='$name' and password='$pass'";
				$result=mysqli_query($con,$query);
				$rows=mysqli_num_rows($result);

				if($rows>0){
					header("Location: home.php");
				}
				else{
					echo '<center>User doesn\'t exists!<br><br><a href="index.php">Login</a></center>';
				}
			}
		?>
	</body>
</html>
