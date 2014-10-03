<?php
session_start();
ob_start();
?>
<html>
<head><link rel="shortcut icon" href="photos/favicon.ico">
<link rel="stylesheet" href="css.css" type="text/css"/>
<title>Signup</title>

<script>
			function validate()
			{
			var name=document.forms["signup"]["name"].value;
			var password=document.forms["signup"]["password"].value;
			var repassword=document.forms["signup"]["repassword"].value;
			var collname=document.forms["signup"]["collname"].value;
			var email=document.forms["signup"]["email"].value;
			var phone=document.forms["signup"]["phone"].value;
			var realname=document.forms["signup"]["realname"].value;
			
			
			if ((realname==null || realname=="") ||(password==null || password=="") || (name==null || name=="") || (repassword==null || repassword=="") || (collname==null || collname=="") || (email==null || email=="") || (phone==null || phone==""))
			{
				alert("All fields are compulsory ! \nPlease fill in the empty fields !");return false;
			}
			if(password!=repassword)
			{
				alert("Passwords do not match !\nPlease provide the same password !");return false;
			}
			if(name.length>10)
				{
				alert('Please enter name of of less than 10 characters only !');return false;
				}
			if(phone.length!=10)
				{
				alert("Phone number must be exactly of 10 digits !\nPlease enter again !");return false;
				}
			
			else
			return true;
			}
			
			function test()
				{
				var name=document.forms["signup"]["name"].value;
				if(name.length>10)
				{
				alert('Please enter name of less than 10 characters only !');
				}
				}
				
				function test2()
				{
				var password=document.forms["signup"]["password"].value;
				var repassword=document.forms["signup"]["repassword"].value;
				if(password!=repassword)
				{
				alert("Passwords do not match !\nPlease provide the same password !");return false;
				}
				}
				
				function test3()
				{
				var phone=document.forms["signup"]["phone"].value;
				if(phone.length!=10)
				{
				alert("Phone number must be exactly of 10 digits !\nPlease enter again !");return false;
				}
				}
		</script>
		<noscript>Your Javascript is off !! </noscript>

</head>

<body bgcolor="#333333" text="#FFFFFF" marginwidth="45">

<?php
include("connect.php");
	if(!isset($_POST['submit']))
	{
		echo'<br><center><b><font face="calibri" color="red" size=8>Graph</font><font face="calibri" size ="8">ical Password Authentication System</font></b></center>
<hr color="#CC0000">
						<strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<font size="5">Signup</strong><br></font>
			</h2>
	<form name="signup" action="signup.php" method="post" onSubmit="return validate();">
	<p align="right">
	Username (Less than 10 characters) : <input type ="text" name="name" onBlur="test();"><br>
	Password : <input type="password" name="password"><br>
	Re-Enter Password : <input type="password" name="repassword" onBlur="test2();"><br>
	Enter Full Name : <input type ="text" name="realname"><br>
	College Name : <input type ="text" name="collname"><br>
	Email Address : <input type ="text" name="email"><br>
	Phone : <input type ="number" name="phone" onBlur="test3();"><br>
	All Fields are compulsory
	<input type="submit" value="Signup" name="submit">
	</p>
	</form>
	<br><br><br><br><br><br><br><br><br>
<footer><br><i><p align="right">Designed by Rajarshi Sarkar and Saurabh Garg</i></footer>';
	}

	else 
			{
			$name=$_POST['name'];
			$password=$_POST['password'];
			$collname=$_POST['collname'];
			$email=$_POST['email'];
			$phone=$_POST['phone'];
			$realname=$_POST['realname'];
			
					$result=mysqli_query($con,"select * from user where name='$name'");
					if (mysqli_num_rows($result)>0)
					{
					echo'<br><center><b><font face="calibri" color="red" size=8>Graph</font><font face="calibri" size ="8">ical Password Authentication System</font></b></center>
					<hr color="#CC0000"><br><br><center>The username is already registered ! <br>Please use a different username !<br><a href="signup.php"><font color="white">Click here to signup</a>';
					exit;return;
					}
					$result=mysqli_query($con,"select * from user where email='$email'");
					if (mysqli_num_rows($result)>0)
					{
					echo'<br><center><b><font face="calibri" color="red" size=8>Graph</font><font face="calibri" size ="8">ical Password Authentication System</font></b></center>
					<hr color="#CC0000"><br><br><center>The email is already registered ! <br>Please use a different email !<br><a href="signup.php"><font color="white">Click here to signup</a>';
					exit;return;
					}
					$result=mysqli_query($con,"select * from user where phone=$phone");
					if (mysqli_num_rows($result)>0)
					{
					echo'<br><center><b><font face="calibri" color="red" size=8>Graph</font><font face="calibri" size ="8">ical Password Authentication System</font></b></center>
					<hr color="#CC0000"><br><br><center>The phone number is already registered ! <br>Please use a different phone number !<br><a href="signup.php"><font color="white">Click here to signup</a>';
					exit;return;
					}
					
					$_SESSION['a'][0]=$name;
					$_SESSION['a'][1]=$password;
					$_SESSION['a'][2]=$realname;
					$_SESSION['a'][3]=$collname;
					$_SESSION['a'][4]=$email;
					$_SESSION['a'][5]=$phone;
					header('Location:layer1_regi.php');


						/*$query="INSERT into user(username,password,name,clg,email,phone) values ('$name','$password','$realname','$collname','$email',$phone)";
						$result = mysqli_query($con,$query); 
						if($result) 
						{
						echo'<br><center><b><font face="calibri" color="red" size=8>Graph</font><font face="calibri" size ="8">ical Password Authentication System</font></b></center>
						<hr color="#CC0000"><br><br><br><center>Participant successfully registered !<br><a href="login.php"><font color="white">Click here to Login</font></a>!';
						}
						else
						echo'<br><center><b><font face="calibri" color="red" size=8>Graph</font><font face="calibri" size ="8">ical Password Authentication System</font></b></center>
						<hr color="#CC0000"><br><br><br><center>Problem with registration !<br><a href="signup.php"><font color="white">Click here to signup</a>';
			*/
			}
								



?>
</body>
</html>