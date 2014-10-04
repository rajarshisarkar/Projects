<?php
ob_start();
session_start();
?>
<head>
	<link rel="stylesheet" href="css.css" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="print.css" media="print"/>
	<link rel="shortcut icon" href="images/favicon.gif">
	
	<title>
		Lodge Civil Complaint
	</title>
	
	<style type="text/css">
	@media print {
		#printbutton {
			display :  none;
		}
		#exit {
			display :  none;
		}
		#generate {
			display :  none;
		}
	}
	</style>
	
	<SCRIPT LANGUAGE="JavaScript"> 
		if (window.print) 
		{
			var printButton = document.getElementById("printpagebutton");
			printButton.style.visibility = 'hidden';
			document.write('<form><input type=button name=print value="Print" onClick="window.print()" style="display: none;"></form>');
		}
		function generatepdf()
		{
			//window.location.assign("print_example.php");
			window.open("pdf_generator.php");
			//window.parent.location = "home.php";
			return false;
		}
	</script>

	<noscript>
		Your Javascript is off !! 
	</noscript>
</head>

<body background="images/background.bmp">
	<?php
	include("connect.php");
	if($_SESSION['normaluser']=='normaluser' && $_SESSION['uname'])
	{
		$plno=$_SESSION['uname'];
		include("connect.php");
		if(!isset($_POST['save']) and !isset($_POST['exit']))
		{
			echo'<center><br><img src="images/sail_logo.gif"></img>';
			include("connect.php");
			
			$query="select username from online_users where plno_owner='$plno'" ;
			$result = oci_parse($con, $query);
			oci_execute($result);
			$row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_LOBS);
			
			$query="select loc_no from room_occupants where occupant_id='$plno'" ;
			$result = oci_parse($con, $query);
			oci_execute($result);
			$rowa = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_LOBS);
			
			date_default_timezone_set('Asia/Calcutta');
			$date = date('d/m/Y');
			echo '<table border="0" width="975"><tr><th width="730"></th><th></th></tr>
			<tr><td>&nbsp;&nbsp;PL No. : '.$plno.' ('.$row['USERNAME'].')</td><td> <a href="changepassword.php">Change Password</a> &nbsp;| &nbsp;<a href="home.php">Back</a> &nbsp;| &nbsp;<a href="logout.php">Logout</a></td>
			</table>';
			echo "
			<hr style='margin:0;'>
			";
			echo'<center><center><br><b>
			<form name="lodgecivilcomplaint" action="lodgecivilcomplaint.php" method="post">
			<table border="1" width="650">
			<tr><td width="3" style="border-right:1px"><div align="right"><img src="images/favicon.gif"></img></div></td><td width="380" style="border-left:1px"><center><b>Construction and Maintenance<br>(Township)<br>RDCIS, SAIL, Ranchi</td><td width="210"><center><b>Service Requisition Form Civil</td><td width="210"><center><b>Complaint ID: <input type="text" name="pageno" style="width: 80px" readonly></td></tr>
			<tr><td width="175"><center><b>Date</td><td width="175"><center><b>Location</td><td width="1000" colspan="2"><center><b>Description of Service Required</td></tr>
			<tr><td width="200"><center><b><input type="text" name="date" style="width: 80px" value="'.$date.'" readonly></td><td width="175"><center><b><input type="text" name="location" style="width: 80px" value="'.$rowa['LOC_NO'].'"></td><td width="1000" colspan="2" rowspan="2"><center><b><div align="right" class="linebreak"><br><TEXTAREA Name="complaintdescription" ROWS=8 COLS=40 value="as"></TEXTAREA>&nbsp;&nbsp;<br>Name: <input type="text" name="plno_owner" style="width: 100px" value="'.$_SESSION['uname'].'"readonly> <input type="text" name="name" style="width: 200px" value="'.$row['USERNAME'].'" readonly>&nbsp;&nbsp;<br>Contact No.: <input type="text" name="contactno" style="width: 120px" readonly>&nbsp;&nbsp;</div></td></tr>
			<tr><td width="175" colspan="2"><font align="left"><b>&nbsp;&nbsp;May be Attended <br>&nbsp;&nbsp;(Please Select):<br><input type="radio" name="maybeattended" value="A" CHECKED>Anytime<br>
			<input type="radio" name="maybeattended" value="F">Forenoon<br><input type="radio" name="maybeattended" value="N">Afternoon</td></tr>
			<tr><td width="175" colspan="2"><font align="left"><b>&nbsp;&nbsp;Job Sl. No.: <input type="text" name="jobslno" style="width: 70px" readonly><br></td><td rowspan="2" colspan="2"><div align="right" class="linebreak"><b><br><br>Status: <select name="status" style="width: 100px" readonly><option value="N">New</option></select>&nbsp;&nbsp;</div></b></td></tr>
			<tr><td width="175" colspan="2"><font align="left"><b>&nbsp;&nbsp;Alloted to:<br>&nbsp;&nbsp;No:</b></td></tr>
			</table>
			<br><center><input type="submit" value="Exit" name="exit" class="buttonwrapper"> &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Save" name="save" class="buttonwrapper"><br><br>
			</form>';
			echo '<footer><font color="blue" style="font-weight: normal;">Developed by C&IT, RDCIS, SAIL, Ranchi</font></footer>';
			//echo "<script type='text/javascript'>alert('Note: Lodge Seperate Complaints for Plumbing/Mason/Sanitary/Carpentry/Water Supply work.')</script>";
		}
		else if(isset($_POST['save']))
		{
			date_default_timezone_set('Asia/Calcutta');
			$date = date('m/Y');
			$pieces = explode("/", $date);
			if($pieces[0]>=4)
				$finyear=''.$pieces[1].''.($pieces[1]+1).'';
			else
				$finyear=''.($pieces[1]-1).''.($pieces[1]).'';
			//echo $finyear.'<br>';
			
			$loc_no=$_POST['location'];
			$query="select loc_id from room_occupants where loc_no='$loc_no'";
			$result = oci_parse($con, $query);
			oci_execute($result);
			$row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_LOBS);
			$loc_id=$row['LOC_ID'];
			if(strcmp($loc_id,'')==0)
			{
				echo "<script type='text/javascript'>alert('Location $loc_no does not exists. Please enter an existing location.');</script>";
				echo '<script language="javascript">window.location = "lodgecivilcomplaint.php"</script>';
			}
				
			//echo $loc_id.'<br>';
			
			$type_of_complaint='C';
			//echo $type_of_complaint.'<br>';
			
			$complaintdescription=$_POST['complaintdescription'];
			//echo $complaintdescription.'<br>';
			if(strcmp($complaintdescription,'')==0)
			{
				echo "<script type='text/javascript'>alert('Complaint Description cannot be blank. Please enter something as description.');</script>";
				echo '<script language="javascript">window.location = "lodgecivilcomplaint.php"</script>';
			}
			
			$maybeattended=$_POST['maybeattended'];
			//echo $maybeattended.'<br>';
			
			$status='N';
			//echo $status.'<br>';
			
			$pl_no=$_SESSION['uname'];
			//echo $pl_no.'<br>';
			
			date_default_timezone_set('Asia/Calcutta');
			$date = date('Y-m-d');
			//echo $date;
			
			$query="select max(comp_id) from rdcis_online_req_form where fin_year='$finyear' and CIVIL_ELEC = 'C' ";
			$result = oci_parse($con, $query);
			oci_execute($result);
			$row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_LOBS);
			$comp_id=$row['MAX(COMP_ID)']+1;
			if(strcmp($comp_id,'')==0)
				$comp_id=1;
			//echo $comp_id.'<br>';
			$query="INSERT INTO rdcis_online_req_form(FIN_YEAR, COMP_ID, COMP_ID_DATE, CIVIL_ELEC, PLNO_OWNER, MAY_BE_ATTENDED, STATUS, COMP_DESC, LOC_ID, LOC_NO) VALUES ($finyear,$comp_id,TO_DATE('$date', 'YYYY-MM-DD'),'$type_of_complaint','$plno','$maybeattended','$status','$complaintdescription',$loc_id,'$loc_no')";
			//echo $query;
			$result = oci_parse($con, $query);
			//echo $result;
			oci_execute($result);
			//echo oci_execute;
			$query="commit";
			$result = oci_parse($con, $query);
			oci_execute($result);
			//echo $query;
			//$result=mysqli_query($con,$query);
			
			$query="select comp_id,civil_elec,comp_id_date,comp_desc,may_be_attended,status,reason_cancel from rdcis_online_req_form where (comp_id=$comp_id)";
			//echo $query;
			$result = oci_parse($con, $query);
			oci_execute($result);
			$row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_LOBS);
			//echo $row['COMP_ID'];
			if(strcmp($row['COMP_ID'],'')==0)
			{
				echo "<script type='text/javascript'>alert('Error occured! Complaint not lodged.');</script>";
			}
			else
			{
				$id=$comp_id;
				//echo $id;
				//echo '<script language="javascript">window.location = "home.php"</script>';
				echo'<center><br><img src="images/sail_logo.gif" class="hidewhileprinting"></img>';
				include("connect.php");
				
				$query="select username from online_users where plno_owner='$plno'" ;
				$result = oci_parse($con, $query);
				oci_execute($result);
				$row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_LOBS);
				
				$query="select loc_no from room_occupants where occupant_id='$plno'" ;
				$result = oci_parse($con, $query);
				oci_execute($result);
				$rowa = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_LOBS);
				
				date_default_timezone_set('Asia/Calcutta');
				$date = date('d/m/Y');
				echo '<table border="0" width="975"><tr><th width="730"></th><th></th></tr>
				<tr><td>&nbsp;&nbsp;PL No. : '.$plno.' ('.$row['USERNAME'].')</td><td> <a href="changepassword.php">Change Password</a> &nbsp;| &nbsp;<a href="home.php">Back</a> &nbsp;| &nbsp;<a href="logout.php">Logout</a></td>
				</table>';
				echo "
				<hr style='margin:0;'>
				";
				
				
				echo'<center><center><br><b>
				<form name="lodgecivilcomplaint" action="lodgecivilcomplaint.php" method="post">
				<table border="1" width="650">
				<tr><td width="3" style="border-right:1px"><div align="right"><img src="images/favicon.gif"></img></div></td><td width="380" style="border-left:1px"><center><b>Construction and Maintenance<br>(Township)<br>RDCIS, SAIL, Ranchi</td><td width="210"><center><b>Service Requisition Form Civil</td><td width="210"><center><b>Complaint ID: <input type="text" value="'.$id.'" name="pageno" style="width: 80px" readonly></td></tr>
				<tr><td width="175"><center><b>Date</td><td width="175"><center><b>Location</td><td width="1000" colspan="2"><center><b>Description of Service Required</td></tr>
				<tr><td width="200"><center><b><input type="text" name="date" style="width: 80px" value="'.$date.'" readonly></td><td width="175"><center><b><input type="text" name="location" style="width: 80px" value="'.$loc_no.'"></td><td width="1000" colspan="2" rowspan="2"><center><b><div align="right" class="linebreak"><br><TEXTAREA Name="complaintdescription" ROWS=8 COLS=40 value="as">'.$complaintdescription.'</TEXTAREA>&nbsp;&nbsp;<br>Name: <input type="text" name="plno_owner" style="width: 100px" value="'.$_SESSION['uname'].'"readonly> <input type="text" name="name" style="width: 200px" value="'.$row['USERNAME'].'" readonly>&nbsp;&nbsp;<br>Contact No.: <input type="text" name="contactno" style="width: 120px" readonly>&nbsp;&nbsp;</div></td></tr>
				<tr><td width="175" colspan="2"><font align="left"><b>&nbsp;&nbsp;May be Attended <br>&nbsp;&nbsp;(Please Select):<br>
				';
				if(strcmp($maybeattended,'A')==0)
				{
					echo '<input type="radio" name="maybeattended" value="A" CHECKED>Anytime<br>
					<input type="radio" name="maybeattended" value="F">Forenoon<br><input type="radio" name="maybeattended" value="N">Afternoon</td></tr>';
				}
				if(strcmp($maybeattended,'F')==0)
				{
					echo '<input type="radio" name="maybeattended" value="A">Anytime<br>
					<input type="radio" name="maybeattended" value="F" CHECKED>Forenoon<br><input type="radio" name="maybeattended" value="N">Afternoon</td></tr>';
				}
				if(strcmp($maybeattended,'N')==0)
				{
					echo '<input type="radio" name="maybeattended" value="A">Anytime<br>
					<input type="radio" name="maybeattended" value="F">Forenoon<br><input type="radio" name="maybeattended" value="N" CHECKED>Afternoon</td></tr>';
				}
				echo '<tr><td width="175" colspan="2"><font align="left"><b>&nbsp;&nbsp;Job Sl. No.: <input type="text" name="jobslno" style="width: 70px" readonly><br></td><td rowspan="2" colspan="2"><div align="right" class="linebreak"><b><br><br>Status: <select name="status" style="width: 100px" readonly><option value="N">New</option></select>&nbsp;&nbsp;</div></td></tr>
				<tr><td width="175" colspan="2"><font align="left"><b>&nbsp;&nbsp;Alloted to:<br>&nbsp;&nbsp;No:</td></tr>
				</table>
				<br><center><input type="submit" value="Exit" id="exit" name="exit" class="buttonwrapper" class="hidewhileprinting">&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE="button" id="printbutton" value="Print" class="buttonwrapper" onClick="window.print()" class="hidewhileprinting">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" style="background: silver;height: 24px;width: 100px;" name="generate" id="generate" value="Generate PDF" onClick="generatepdf();"></FORM><br>';
				
				$_SESSION['id']=$id;
				$_SESSION['date']=$date;
				$_SESSION['loc_no']=$loc_no;
				if(strcmp($maybeattended,'A')==0)
					$_SESSION['maybeattended']='Anytime';
				if(strcmp($maybeattended,'F')==0)
					$_SESSION['maybeattended']='Forenoon';
				if(strcmp($maybeattended,'N')==0)
					$_SESSION['maybeattended']='Afternoon';
				$_SESSION['nameofuser']=$row['USERNAME'];
				$_SESSION['status']='New';
				$_SESSION['civil_elec']='C';
				$_SESSION['complaintdescription']=$complaintdescription;
				
				echo '<footer class="hidewhileprinting"><font color="blue" style="font-weight: normal;">Developed by C&IT, RDCIS, SAIL, Ranchi</font></footer>';
				echo "<script type='text/javascript'>alert('Civil Complaint Lodged Successfully. Your Complain ID is $comp_id. Please note down your Complaint ID for future reference.');</script>";	
			}
			//header('Location:home.php');
		}
		else if(isset($_POST['exit']))
		{
			header('Location:home.php');
		}
	}
	else
		header('Location:login.php');
	?>
	</body>