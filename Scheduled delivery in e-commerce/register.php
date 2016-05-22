<?php
	session_start();
	ob_start();
?>

<html>
	<head>
		<style>
			body{
				background-image: url("images/background.bmp");
				background-repeat: repeat;
			}
		</style>
		<script>
			function validate(){
				var name=document.forms["register"]["nameu"].value;
				var password=document.forms["register"]["namepass"].value;
				var repassword=document.forms["register"]["renamepass"].value;
				
				if ((repassword==null || repassword=="")){
					alert("All fields are compulsory. Please fill in the empty fields.");
					return false;
				}

				if ((password==null || password=="")){
					alert("All fields are compulsory. Please fill in the empty fields.");
					return false;
				}
			
				if ((name==null || name=="")){
					alert("All fields are compulsory. Please fill in the empty fields.");
					return false;
				}
				
				if(password!=repassword){
					alert("Passwords do not match. Please provide the same password.");
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
			Registration Page
		</title>
	</head>

	<body>
		<?php 
			if(!isset($_POST['submit'])){
				echo '<center><p><u><b>Registration Page</b></u></p>
				<table>
				<form name="register" method="post" onSubmit="return validate();" >
				<tr><td align="right">Username : </td><td><input type ="text" name="nameu"></td></tr>
				<tr><td align="right">Password : </td><td><input type ="password" name="namepass"></td></tr>
				<tr><td align="right">Re-enter Password : </td><td><input type ="password" name="renamepass"></td></tr>
				<tr><td></td><td align="center"><input type="submit" value="Register" name="submit"></td></tr>
				<tr><td></td><td align="center"><a href="index.php">Login</a></center></td></tr>
				</form>
				</table>';
				
			}
			else if(isset($_POST['submit'])){
				$name=$_POST['nameu'];
				$pass=$_POST['namepass'];
				include ("connect.php");
				$query="select * from users where username='$name'";
				$result=mysqli_query($con,$query);
				$rows=mysqli_num_rows($result);

				if($rows>0){
					echo '<center><font color="red">User already exists!</font><br><br><a href="index.php">Login</a></center><br><center><a href="register.php">Register</a></center>';
					//echo $password;
				}
				else{
					$query="INSERT into users(username,password) values ('$name','$pass')";
					$result = mysqli_query($con,$query);
					echo '<center><font color="green">User added!</font><br><br><a href="index.php">Login</a></center><br><center><a href="register.php">Register</a></center>';
				}
			}
		?>
	</body>
</html>