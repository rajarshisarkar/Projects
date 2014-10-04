<?php
ob_start();
session_start();
?>
<head>
	<link rel="stylesheet" href="css.css" type="text/css"/>
	<link rel="shortcut icon" href="images/favicon.gif">
	
	<title>
		Home Page
	</title>
	
	<script>
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
		if(!isset($_POST['lodgecivilcomplaint']) and !isset($_POST['lodgeelectricalcomplaint']) and !isset($_POST['getstatus']))
		{
			echo'<center><br><img src="images/sail_logo.gif"></img>';
			$query="select username from online_users where plno_owner='$plno'" ;
			$result = oci_parse($con, $query);
			oci_execute($result);
			$row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_LOBS);
			
			echo '<table border="0" width="975"><tr><th width="780"></th><th></th></tr>
			<tr><td>PL No. : '.$plno.' ('.$row['USERNAME'].')</td><td><a href="changepassword.php">Change Password</a> &nbsp;|&nbsp; <a href="logout.php">Logout</a></td>
			</table>';			
			echo "
			<hr style='margin:0;'>
			";
			echo'<center><u><b><font size="4"><br>Home Page<br></font></b></u>
			</center>
			<form name="home" action="home.php" method="post">
			<table width="900" border="0">
			<tr><td><center><img src="images/civilcomplaints.jpg" width="225" height="180"></img><br><input type="submit" style="width: 200px" value="Lodge Civil Complaint" name="lodgecivilcomplaint" class="buttonwrapper"></td><td><center><img src="images/electricalcomplaints.jpg" width="225" height="180"></img><br><input type="submit" style="width: 200px" value="Lodge Electrical Complaint" name="lodgeelectricalcomplaint" class="buttonwrapper"></td></tr>
			</table><center><img src="images/getstatus.jpg" width="140" height="130"></img><br><input type="submit" style="width: 200px" value="Get Status" name="getstatus" class="buttonwrapper"><br><br>
			<center>
			</form>';
			date_default_timezone_set('Asia/Calcutta');
			$date = date('d/m/Y, h:i:s A');
			echo '<footer><font color="blue">Developed by C&IT, RDCIS, SAIL, Ranchi</font><div align="right" class="linebreak">Current Date and Time: '.$date.'&nbsp;&nbsp;</div></footer>
			</center>';
			
			//echo $date;
		}
		else if(isset($_POST['lodgecivilcomplaint']))
		{
			header('Location:lodgecivilcomplaint.php');
		}
		else if(isset($_POST['lodgeelectricalcomplaint']))
		{
			header('Location:lodgeelectricalcomplaint.php');
		}
		else if(isset($_POST['getstatus']))
		{
			header('Location:getstatus.php');
		}
	}
	else
		header('Location:login.php');
	?>
	</body>