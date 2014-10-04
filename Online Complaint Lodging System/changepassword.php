<?php
ob_start();
session_start();
?>
<head>
	<link rel="stylesheet" href="css.css" type="text/css"/>
	<link rel="shortcut icon" href="images/favicon.gif">
	
	<title>
		Change Password
	</title>
	
	<script>
		function validate()
		{
			var presentpassword=document.forms["changepassword"]["presentpassword"].value;
			var newpassword1=document.forms["changepassword"]["newpassword1"].value;
			var newpassword2=document.forms["changepassword"]["newpassword2"].value;
			if ((presentpassword==null || presentpassword=="") || (newpassword1==null || newpassword1=="") || (newpassword2==null || newpassword2==""))
			{
				alert("All fields are compulsory! Please enter the required passwords.");return false;
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

<body >
	<?php
	include("connect.php");
	if($_SESSION['normaluser']=='normaluser' && $_SESSION['uname'])
	{
		echo '<body background="images/background.bmp">';	
		$plno=$_SESSION['uname'];
		include("connect.php");
		if(!isset($_POST['submit']))
		{
			echo'<center><br><img src="images/sail_logo.gif"></img>';
			$query="select username from online_users where plno_owner='$plno'" ;
			$result = oci_parse($con, $query);
			oci_execute($result);
			$row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_LOBS);
			
			echo '<table border="0" width="975"><tr><th width="860"></th><th></th></tr>
			<tr><td>PL No. : '.$plno.' ('.$row['USERNAME'].')</td><td><a href="home.php">Back</a> &nbsp;|&nbsp; <a href="logout.php">Logout</a></td>
			</table>';			
			echo "
			<hr style='margin:0;'>
			";
			echo'<u><br><b><font size="4">Change Password</font></u>
			<form name="changepassword" action="changepassword.php" method="post" onSubmit="return validate();">
			<table border="0" width="800">
			<tr><th width="150"></th><th width="650"></th></tr>
			<tr><td rowspan="4"><img src="images/login_logo.gif"></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbspPresent Password : <input type ="password" name="presentpassword" size="30"><br></td></tr>
			<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;New Password : <input type="password" name="newpassword1" size="30"><br></td></tr>
			<tr><td>Confirm New Password : <input type="password" name="newpassword2" size="30"><br></td></tr>
			<br><tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Change" name="submit" class="buttonwrapper">&nbsp;&nbsp;&nbsp; <input type="submit" value="Reset" name="reset" class="buttonwrapper" onclick="DeleteText();">
			</td></tr></table></form>';
			echo "<br><br><br><br><br><br><br><footer><font color='blue' style='font-weight: normal;'>Developed by C&IT, RDCIS, SAIL, Ranchi</font></footer>";	
			
		}
		else
		{
			$plno=$_SESSION['uname'];
			$presentpassword=$_POST['presentpassword'];
			$newpassword1=$_POST['newpassword1'];
			$newpassword2=$_POST['newpassword2'];
			$query = "select * from online_users where plno_owner='$plno' and password='$presentpassword'";
			$result = oci_parse($con, $query);
			oci_execute($result);

			$num_rows=0;
			while (($row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_LOBS))) 
			{
				$num_rows=$num_rows+1;
			}
	
			if($num_rows>0)
			{ 
				if($newpassword1!=$newpassword2)
				{
					echo "<script type='text/javascript'>alert('The two new passwords do not match. Please Re-enter.');</script>";
					echo '<script language="javascript">window.location = "changepassword.php"</script>';
				}	
				else
				{
					$query = "update online_users set password='$newpassword1' where plno_owner='$plno'";
					$result = oci_parse($con, $query);
					oci_execute($result);
					$query = "commit";
					$result = oci_parse($con, $query);
					oci_execute($result);
					echo "<script type='text/javascript'>alert('Password Changed Successfully.');</script>";
					echo '<script language="javascript">window.location = "changepassword.php"</script>';
				}
			}
			else
			{	
				echo "<script type='text/javascript'>alert('The Present Password entered is not correct. Please Re-enter.');</script>";
				$plno=$_SESSION['uname'];
				$query="select username from online_users where plno_owner='$plno'" ;
				$result = oci_parse($con, $query);
				oci_execute($result);
				$row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_LOBS);
				echo'<center><br><img src="images/sail_logo.gif"></center>';
				echo '<table border="0" width="975"><tr><th width="860"></th><th></th></tr>
				<tr><td>PL No. : '.$plno.' ('.$row['USERNAME'].')</td><td><a href="home.php">Back</a> &nbsp;|&nbsp; <a href="logout.php">Logout</a></td>
				</table>';
				echo'<center><hr style="margin:0;">';
				echo'<u><br><b><font size="4">Change Password</font></b></u>
				<form name="changepassword" action="changepassword.php" method="post" onSubmit="return validate();">
				<table border="0" width="800">
				<tr><th width="150"></th><th width="650"></th></tr>
				<tr><td rowspan="4"><img src="images/login_logo.gif"></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbspPresent Password : <input type ="password" name="presentpassword" size="30"><br></td></tr>
				<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;New Password : <input type="password" name="newpassword1" size="30"><br></td></tr>
				<tr><td>Confirm New Password : <input type="password" name="newpassword2" size="30"><br></td></tr>
				<br><tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Change" name="submit" class="buttonwrapper">&nbsp;&nbsp;&nbsp; <input type="submit" value="Reset" name="reset" class="buttonwrapper" onclick="DeleteText();">
				</td></tr></table></form>';
				echo "<br><br><br><br><br><br><br><footer><font color='blue' style='font-weight: normal;'>Developed by C&IT, RDCIS, SAIL, Ranchi</font></footer>";
			}
		}
	}
	else
		header('Location:login.php');
	?>
	</body>