<?php
ob_start();
session_start();
?>
<head>
	<link rel="stylesheet" href="css.css" type="text/css"/>
	<link rel="shortcut icon" href="images/favicon.gif">
	
	<title>
		Login
	</title>
	
	<script>
		function validate()
		{
			var name=document.forms["login"]["name"].value;
			var password=document.forms["login"]["password"].value;
			if ((password==null || password=="") && !(name==null || name==""))
			{
				alert("Please enter your password !!");return false;
			}
			if (!(password==null || password=="") && (name==null || name==""))
			{
				alert("Please enter your PL No. !!");return false;
			}
			if ((name==null || name=="") && (password==null || password==""))
			{
				alert("Please enter your PL No. !! \nPlease enter your password !!");return false;
			}
			else
				return true;
		}

		function DeleteText() 
		{
		   document.getElementById('name').value = '';
		   document.getElementById('password').value = '';
		}
	</script>
	
	<noscript>
		Your Javascript is off !! 
	</noscript>
</head>

<body background="images/background.bmp">
	<?php
	include("connect.php");

	if(!isset($_POST['submit']))
	{
		echo'<center><br><img src="images/sail_logo.gif"></center>';
		echo'<center><h3><hr>';
		echo'<u><br><br>Login</u></h3>
		<form name="login" action="login.php" method="post" onSubmit="return validate();">
		<table border="0" width="800">
		<tr><th width="150"></th><th width="650"></th></tr>
		<tr><td rowspan="3"><img src="images/login_logo.gif"></td><td>RDCIS PL No. : <input type ="text" name="name" size="30">&nbsp;&nbsp;(Eg. ER0001)<br></td></tr>
		<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password : <input type="password" name="password" size="30"><br></td></tr>
		<br><tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Login" name="submit" class="buttonwrapper">&nbsp;&nbsp;&nbsp; <input type="submit" value="Reset" name="reset" class="buttonwrapper" onclick="DeleteText();">
		</td></tr></table></form>
		<footer><font color="red"><br><br>This website is compatible with Internet Explorer 7.</font>
		<font color="black"><br><br>Best viewed in 1024 x 768 screen resolution.</font>
		<font color="black"><br>Designed & Developed by : C&IT, R&D Centre for Iron & Steel, Steel Authority of India Ltd., Ranchi.</font></footer>
		</center>';
	}
	else
	{
		$plno=$_POST['name'];
		$password=$_POST['password'];
		$query = "select * from online_users where plno_owner='$plno' and password='$password'";
		$result = oci_parse($con, $query);
		oci_execute($result);

		$num_rows=0;
		while (($row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_LOBS))) 
		{
			$num_rows=$num_rows+1;
		}
		
		if($num_rows>0)
		{ 
			$_SESSION['uname']=$plno;
			$_SESSION['normaluser']='normaluser';
			header('Location:homepage.php');
		}
		else
		{	
			?>			
			<script type='text/javascript'>
				alert('User with such PL No. and Password doesn\'t exits in our database! Please enter the right credentials.');
			</script>
			<?php
			echo'<center><br><img src="images/sail_logo.gif"></center>';
			echo'<center><h3><hr>';
			echo'<u><br><br>Login</u></h3>
			<form name="login" action="login.php" method="post" onSubmit="return validate();">
			<table border="0" width="800">
			<tr><th width="150"></th><th width="650"></th></tr>
			<tr><td rowspan="3"><img src="images/login_logo.gif"></td><td>RDCIS PL No. : <input type ="text" name="name" size="30">&nbsp;&nbsp;(Eg. ER0001)<br></td></tr>
			<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password : <input type="password" name="password" size="30"><br></td></tr>
			<br><tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Login" name="submit" class="buttonwrapper">&nbsp;&nbsp;&nbsp; <input type="submit" value="Reset" name="reset" class="buttonwrapper" onclick="DeleteText();">
			</td></tr></table></form>
			<footer><font color="red"><br><br>This website is compatible with Internet Explorer 7.</font>
			<font color="black"><br><br>Best viewed in 1024 x 768 screen resolution.</font>
			<font color="black"><br>Designed & Developed by : C&IT, R&D Centre for Iron & Steel, Steel Authority of India Ltd., Ranchi.</font></footer>
			</center>';
		}
	}
	?>
	</body>