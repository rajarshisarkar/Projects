<?php
ob_start();
session_start();
?>
<html>
<head>
	<link rel="stylesheet" href="css.css" type="text/css"/>
	<link rel="shortcut icon" href="images/favicon.gif">
	
	<title>
		Get Status Page
	</title>
	<script src="jquery-1.9.1.js"></script>  
	<script>
	$(document).ready(function() {
	   $("img.print").click(function (event) {
			//Prevent the image to perform default behavior
			event.preventDefault();
			var $td = $(this).parent().closest('tr').children('td');
			var string1 = $td.eq(0).text();
			var string2 = $td.eq(1).text();
			var string3 = $td.eq(2).text();
			var string4 = $td.eq(3).text();
			var string5 = $td.eq(4).text();
			var comp_id= "comp_id=";
			document.cookie = comp_id+string1;
			var type_of_complaint= "type_of_complaint=";
			document.cookie = type_of_complaint+string2;
			var date= "date=";
			document.cookie= date+string3;
			var complaint_description= "complaint_description=";
			document.cookie= complaint_description+string4;
			var may_be_attended= "may_be_attended=";
			document.cookie= may_be_attended+string5;
			window.open('pdf_generator2.php');
			//alert(string1+' '+string2+' '+string3);
		});
	});
	</script>
	<script>
	function DeleteText() 
	{
	   document.getElementById('name').value = '';
	   document.getElementById('password').value = '';
	}
	
	// Path to arrow images
	var arrowImage = 'images/arrow_normal.png';	// Regular arrow
	var arrowImageOver = 'images/arrow_mouse_rollover.png';	// Mouse over
	var arrowImageDown = 'images/arrow_normal.png';	// Mouse down

	var selectBoxIds = 0;
	var currentlyOpenedOptionBox = false;
	var editableSelect_activeArrow = false;
	
	function selectBox_switchImageUrl()
	{
		if(this.src.indexOf(arrowImage)>=0){
			this.src = this.src.replace(arrowImage,arrowImageOver);	
		}else{
			this.src = this.src.replace(arrowImageOver,arrowImage);
		}
	}
	
	function selectBox_showOptions()
	{
		if(editableSelect_activeArrow && editableSelect_activeArrow!=this){
			editableSelect_activeArrow.src = arrowImage;
		}
		editableSelect_activeArrow = this;
		
		var numId = this.id.replace(/[^\d]/g,'');
		var optionDiv = document.getElementById('selectBoxOptions' + numId);
		if(optionDiv.style.display=='block'){
			optionDiv.style.display='none';
			if(navigator.userAgent.indexOf('MSIE')>=0)document.getElementById('selectBoxIframe' + numId).style.display='none';
			this.src = arrowImageOver;	
		}else{			
			optionDiv.style.display='block';
			if(navigator.userAgent.indexOf('MSIE')>=0)document.getElementById('selectBoxIframe' + numId).style.display='block';
			this.src = arrowImageDown;	
			if(currentlyOpenedOptionBox && currentlyOpenedOptionBox!=optionDiv)currentlyOpenedOptionBox.style.display='none';	
			currentlyOpenedOptionBox= optionDiv;			
		}
	}
	
	function selectOptionValue()
	{
		var parentNode = this.parentNode.parentNode;
		var textInput = parentNode.getElementsByTagName('INPUT')[0];
		textInput.value = this.innerHTML;	
		this.parentNode.style.display='none';	
		document.getElementById('arrowSelectBox' + parentNode.id.replace(/[^\d]/g,'')).src = arrowImageOver;
		
		if(navigator.userAgent.indexOf('MSIE')>=0)document.getElementById('selectBoxIframe' + parentNode.id.replace(/[^\d]/g,'')).style.display='none';
	}
	
	var activeOption;
	function highlightSelectBoxOption()
	{
		if(this.style.backgroundColor=='#316AC5'){
			this.style.backgroundColor='';
			this.style.color='';
		}else{
			this.style.backgroundColor='#316AC5';
			this.style.color='#FFF';			
		}	
		
		if(activeOption){
			activeOption.style.backgroundColor='';
			activeOption.style.color='';			
		}
		activeOption = this;	
	}
	
	function createEditableSelect(dest)
	{
		dest.className='selectBoxInput';		
		var div = document.createElement('DIV');
		div.style.styleFloat = 'left';
		div.style.width = dest.offsetWidth + 21 + 'px';
		div.style.position = 'relative';
		div.id = 'selectBox' + selectBoxIds;
		var parent = dest.parentNode;
		parent.insertBefore(div,dest);
		div.appendChild(dest);	
		div.className='selectBox';
		div.style.zIndex = 10000 - selectBoxIds;

		var img = document.createElement('IMG');
		img.src = arrowImage;
		img.className = 'selectBoxArrow';
		
		img.onmouseover = selectBox_switchImageUrl;
		img.onmouseout = selectBox_switchImageUrl;
		img.onclick = selectBox_showOptions;
		img.id = 'arrowSelectBox' + selectBoxIds;

		div.appendChild(img);
		
		var optionDiv = document.createElement('DIV');
		optionDiv.id = 'selectBoxOptions' + selectBoxIds;
		optionDiv.className='selectBoxOptionContainer';
		optionDiv.style.width = div.offsetWidth-2 + 'px';
		div.appendChild(optionDiv);
		
		if(navigator.userAgent.indexOf('MSIE')>=0){
			var iframe = document.createElement('<IFRAME src="about:blank" frameborder=0>');
			iframe.style.width = optionDiv.style.width;
			iframe.style.height = optionDiv.offsetHeight + 'px';
			iframe.style.display='none';
			iframe.id = 'selectBoxIframe' + selectBoxIds;
			div.appendChild(iframe);
		}
		
		if(dest.getAttribute('selectBoxOptions')){
			var options = dest.getAttribute('selectBoxOptions').split(';');
			var optionsTotalHeight = 0;
			var optionArray = new Array();
			for(var no=0;no<options.length;no++){
				var anOption = document.createElement('DIV');
				anOption.innerHTML = options[no];
				anOption.className='selectBoxAnOption';
				anOption.onclick = selectOptionValue;
				anOption.style.width = optionDiv.style.width.replace('px','') - 2 + 'px'; 
				anOption.onmouseover = highlightSelectBoxOption;
				optionDiv.appendChild(anOption);	
				optionsTotalHeight = optionsTotalHeight + anOption.offsetHeight;
				optionArray.push(anOption);
			}
			if(optionsTotalHeight > optionDiv.offsetHeight){				
				for(var no=0;no<optionArray.length;no++){
					optionArray[no].style.width = optionDiv.style.width.replace('px','') - 22 + 'px'; 	
				}	
			}		
			optionDiv.style.display='none';
			optionDiv.style.visibility='visible';
		}
		
		selectBoxIds = selectBoxIds + 1;
	}	
	
	</script>
	
	<noscript>
		Your Javascript is off !! 
	</noscript>
</head>

<?php
	if($_SESSION['normaluser']=='normaluser' && $_SESSION['uname'])
	{
		echo '<body background="images/background.bmp">';	
		$plno=$_SESSION['uname'];
		include("connect.php");
		if(!isset($_POST['submit']))
		{
			if(!isset($_POST['exit']))
			{
				echo'<center><br><img src="images/sail_logo.gif"></img>';
				include("connect.php");
				$query="select username from online_users where plno_owner='$plno'" ;
				$result = oci_parse($con, $query);
				oci_execute($result);
				$row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_LOBS);
				echo '<table border="0" width="975"><tr><th width="730"></th><th></th></tr>
				<tr><td>PL No. : '.$plno.' ('.$row['USERNAME'].')</td><td><a href="changepassword.php">Change Password</a> &nbsp;|&nbsp; <a href="home.php">Back</a> &nbsp;|&nbsp; <a href="logout.php">Logout</a></td>
				</table>';
				echo "
				<hr style='margin:0;'>
				";
				echo'<center><center><u><b><font size="4"><br>Get Status<br><br></font></b></u>
				<form name="getstatus" action="getstatus.php" method="post">
				<table border="0" width="1000"><tr><th width="250"></th><th width="750"></th></tr><tr><td><p class="reducelinebreak" align="right">Enter Complaint ID : </td><td><font align="left"> <input type="text" size="30" name="complaintidanddate" value="" selectBoxOptions=" Complaint ID (Date);"></td></tr>';
				?>
				
				<?php
				echo '<tr><td width="490"><p align="right">Financial Year : </td><td><font align="left"><input type ="text" name="finyear" size="30">&nbsp;&nbsp;(Eg. 2012-2013)</tr></td>
				<tr><td><p align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Type of Complaint : </td><td><font align="left"><select width="214" style="width: 214px" name="typeofcomplaint"><option value="blank">-Select Any-</option><option value="C">Civil</option><option value="E">Electrical</option></select></td></tr>
				<tr><td><p align="right">Complaint Date : </td><td>From <input type ="text" name="from" size="7"> to <input type ="text" name="to" size="7">&nbsp;&nbsp;(Eg. From 21-09-2012 to 24-11-2013)</td></tr>
				<tr><td><div align="right">Status :</td><td><font align="left"><select width="214" style="width: 214px" name="status"><option value="blank">-Select Any-</option><option value="new">New</option><option value="tobeattended">To be Attended</option><option value="attended">Attended</option><option value="nottobeattended">Not To be Attended</option><option value="return">Return</option></select></td></tr>
				<tr><td></td><td><font align="left"><input type="submit" value="Submit" name="submit" class="buttonwrapper" style="width: 4.5em">&nbsp;&nbsp;&nbsp;<input type="submit" value="Reset" name="reset" class="buttonwrapper" onclick="DeleteText();" style="width: 4.5em">&nbsp;&nbsp;&nbsp;<input type="submit" value="Back" name="exit" class="buttonwrapper" style="width: 4.5em"></td></tr>
				</table>
				</form>
				</center>';
				echo '<br><br><br><br><br><br><br><br><footer><font color="blue" style="font-weight: normal;">Developed by C&IT, RDCIS, SAIL, Ranchi</font></footer>';
			}
			else
				header('Location:home.php');
		}
		else
		{
			if(!isset($_POST['exit']))
			{
				$finyear='';
				$from='';
				$to='';
				$complaintidanddate=$_POST['complaintidanddate'];
				$finyear=$_POST['finyear'];
				if(strcmp($_POST['finyear'],'')!=0)
				{
					$pieces = explode("-", $finyear);
					$finyear = ''.$pieces[0].''.$pieces[1];	
				}		
				$typeofcomplaint=$_POST['typeofcomplaint'];
				//$to=$_POST['to'];
				if(strcmp($_POST['from'],'')!=0)
				{
					$pieces = explode("-", $_POST['from']);
					if($pieces[1]=='01')
						$month='JAN';
					if($pieces[1]=='02')
						$month='FEB';
					if($pieces[1]=='03')
						$month='MAR';
					if($pieces[1]=='04')
						$month='APR';
					if($pieces[1]=='05')
						$month='MAY';
					if($pieces[1]=='06')
						$month='JUN';
					if($pieces[1]=='07')
						$month='JUL';
					if($pieces[1]=='08')
						$month='AUG';
					if($pieces[1]=='09')
						$month='SEP';
					if($pieces[1]=='10')
						$month='OCT';
					if($pieces[1]=='11')
						$month='NOV';
					if($pieces[1]=='12')
						$month='DEC';
					$from = ''.$pieces[0].'-'.$month.'-'.$pieces[2];
				}
				if(strcmp($_POST['to'],'')!=0)
				{
					$pieces = explode("-", $_POST['to']);
					if($pieces[1]=='01')
						$month='JAN';
					if($pieces[1]=='02')
						$month='FEB';
					if($pieces[1]=='03')
						$month='MAR';
					if($pieces[1]=='04')
						$month='APR';
					if($pieces[1]=='05')
						$month='MAY';
					if($pieces[1]=='06')
						$month='JUN';
					if($pieces[1]=='07')
						$month='JUL';
					if($pieces[1]=='08')
						$month='AUG';
					if($pieces[1]=='09')
						$month='SEP';
					if($pieces[1]=='10')
						$month='OCT';
					if($pieces[1]=='11')
						$month='NOV';
					if($pieces[1]=='12')
						$month='DEC';
					$to = ''.$pieces[0].'-'.$month.'-'.$pieces[2];
				}
			
				//echo $complaintidanddate.'<br>';
				//echo $finyear.'<br>';
				//echo $typeofcomplaint.'<br>';
				//echo $from.' ';
				//echo $to.'<br>';
				
				if(strcmp($complaintidanddate,'')==0)
					$temp= '>=0 and comp_id<=99999';
				else if(strcmp($complaintidanddate,' Complaint ID (Date)')==0)
					$temp='>=0 and comp_id<=99999';
				else
					$temp= '='.$complaintidanddate;
				$complaintidanddate=$temp;
				
				if(strcmp($finyear,'')==0)
					$temp= '>=0 and fin_year<=99999999';
				else
					$temp= '='.$finyear;
				$finyear=$temp;
				
				if(strcmp($typeofcomplaint,'blank')==0)
					$temp= "='C' or civil_elec='E'";
				else
					$temp= "="."'$typeofcomplaint'";
				$typeofcomplaint=$temp;
				
				if(strcmp($from,'')==0)
					$temp= ">='01-JAN-1990'";
				else
					$temp= ">='$from'";
				$from=$temp;
				
				if(strcmp($to,'')==0)
					$temp= "<='31-DEC-2050'";
				else
					$temp= "<='$to'";
				$to=$temp;
				
				//$status='';
				$status=$_POST['status'];
				if($status=='blank')
					$status="='N' or status='T' or status='A' or status='X' or status='R'";
				else if($status=='new')
					$status="='N'";
				else if($status=='tobeattended')
					$status="='T'";
				else if($status=='attended')
					$status="='A'";
				else if($status=='nottobeattended')
					$status="='X'";
				else if($status=='return')
					$status="='R'";
				//$status=$status;
				//echo $status;
				//echo $complaintidanddate.'<br>';
				//echo $finyear.'<br>';
				//echo $typeofcomplaint.'<br>';
				//echo $from.' ';
				//echo $to.'<br>';
				include("connect.php");
				echo'<center><br><img src="images/sail_logo.gif"></img>';
				include("connect.php");
				$query="select username from online_users where plno_owner='$plno'" ;
				$result = oci_parse($con, $query);
				oci_execute($result);
				$row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_LOBS);
				echo '<table border="0" width="975"><tr><th width="730"></th><th></th></tr>
				<tr><td>PL No. : '.$plno.' ('.$row['USERNAME'].')</td><td><a href="changepassword.php">Change Password</a> &nbsp;|&nbsp; <a href="home.php">Back</a> &nbsp;|&nbsp; <a href="logout.php">Logout</a></td>
				</table>';
				echo "
				<hr style='margin:0;'>
				";
				echo'<center><center><u><b><font size="4"><br>Get Status<br><br></font></b></u>
				<form name="getstatus" action="getstatus.php" method="post">
				<table border="0" width="1000"><tr><th width="250"></th><th width="750"></th></tr><tr><td><p class="reducelinebreak" align="right">Enter Complaint ID : </td><td><font align="left"> <input type="text" size="30" name="complaintidanddate" value="" selectBoxOptions=" Complaint ID (Date);"></td></tr>';
				?>
				
				<?php
				echo '<tr><td width="490"><p align="right">Financial Year : </td><td><font align="left"><input type ="text" name="finyear" size="30">&nbsp;&nbsp;(Eg. 2012-2013)</tr></td>
				<tr><td><p align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Type of Complaint : </td><td><font align="left"><select width="214" style="width: 214px" name="typeofcomplaint"><option value="blank">-Select Any-</option><option value="C">Civil</option><option value="E">Electrical</option></select></td></tr>
				<tr><td><p align="right">Complaint Date : </td><td>From <input type ="text" name="from" size="7"> to <input type ="text" name="to" size="7">&nbsp;&nbsp;(Eg. From 21-09-2012 to 24-11-2013)</td></tr>
				<tr><td><div align="right">Status :</td><td><font align="left"><select width="214" style="width: 214px" name="status"><option value="blank">-Select Any-</option><option value="new">New</option><option value="tobeattended">To be Attended</option><option value="attended">Attended</option><option value="nottobeattended">Not To be Attended</option><option value="return">Return</option></select></td></tr>
				<tr><td></td><td><font align="left"><input type="submit" value="Submit" name="submit" class="buttonwrapper" style="width: 4.5em">&nbsp;&nbsp;&nbsp;<input type="submit" value="Reset" name="reset" class="buttonwrapper" onclick="DeleteText();" style="width: 4.5em">&nbsp;&nbsp;&nbsp;<input type="submit" value="Back" name="exit" class="buttonwrapper" style="width: 4.5em"></td></tr>
				</table>
				</form>
				</center>';
				
				$uname=$_SESSION['uname'];
				//echo "select comp_id,civil_elec,comp_id_date,status from rdcis_online_req_form where (plno_owner='$uname') "."and (comp_id$complaintidanddate) and (fin_year$finyear) and (civil_elec"."$typeofcomplaint)"." and (comp_id_date$from and comp_id_date$to)";
				
				include("connect.php");
				$query="select comp_id,civil_elec,comp_id_date,comp_desc,may_be_attended,status,reason_cancel from rdcis_online_req_form where (plno_owner='$uname') "."and (comp_id$complaintidanddate) and (fin_year$finyear) and (civil_elec"."$typeofcomplaint)"." and (comp_id_date$from and comp_id_date$to) and(status$status) order by comp_id_date desc,comp_id desc" ;
				//echo $query;
				$result = oci_parse($con, $query);
				oci_execute($result);
				echo "<center><table border='1' width='1000' style='table-layout: fixed;'>
				<tr>
				<th width='70'>Complaint ID</th>
				<th width='70'>Type of Complaint</th>
				<th width='100'>Complaint ID Date</th>
				<th width='420'>Complaint Description</th>
				<th width='70'>May be Attended </th>
				<th width='50'>Status </th>
				<th width='110'>Reason of Cancel</th>
				<th width='60'>PDF</th>
				</tr>";
                 
				  while($row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_LOBS))
				  {
						//$row['REASON_CANCEL']='';
						echo "<tr>";
						echo "<td><center>" . $row['COMP_ID'] . "</td>";
						if ($row['CIVIL_ELEC']=="C")
							echo "<td><center>Civil</td>";
						else
							echo "<td><center>Electrical</td>";
						$pieces = explode("-", $row['COMP_ID_DATE']);
						if($pieces[1]=='JAN')
							$month='01';
						if($pieces[1]=='FEB')
							$month='02';
						if($pieces[1]=='MAR')
							$month='03';
						if($pieces[1]=='APR')
							$month='04';
						if($pieces[1]=='MAY')
							$month='05';
						if($pieces[1]=='JUN')
							$month='06';
						if($pieces[1]=='JUL')
							$month='07';
						if($pieces[1]=='AUG')
							$month='08';
						if($pieces[1]=='SEP')
							$month='09';
						if($pieces[1]=='OCT')
							$month='10';
						if($pieces[1]=='NOV')
							$month='11';
						if($pieces[1]=='DEC')
							$month='12';
						$row['COMP_ID_DATE'] = ''.$pieces[0].'-'.$month.'-'.$pieces[2];
						echo "<td><center>" . $row['COMP_ID_DATE'] . "</td>";
						echo "<td style='word-wrap: break-word;'>" . $row['COMP_DESC'] . "</td>";
						if ($row['MAY_BE_ATTENDED']=="A")
							echo "<td><center>Anytime</td>";
						if ($row['MAY_BE_ATTENDED']=="F")
							echo "<td><center>Forenoon</td>";
						if ($row['MAY_BE_ATTENDED']=="N")
							echo "<td><center>Afternoon</td>";					
						if ($row['STATUS']=="N")
							echo "<td><center>New</td>";
						if ($row['STATUS']=="T")
							echo "<td><center>To be Attended</td>";
						if ($row['STATUS']=="A")
							echo "<td><center>Attended</td>";
						if ($row['STATUS']=="X")
							echo "<td><center>Not to be Attended</td>";
						if ($row['STATUS']=="R")
							echo "<td><center>Return</td>";
						if(strcmp($row['REASON_CANCEL'],'')==0)
							echo "<td><center>&nbsp;&nbsp;</td>";
						else
							echo "<td><center>" . $row['REASON_CANCEL'] . "</td>";
						echo "<td><center><img src='images/printicon.gif' width='30' height='25' class='print'></img></center></td></tr>";
				  }
				echo "</table><br>"; 
 
				echo "<footer><font color='blue' style='font-weight: normal;'>Developed by C&IT, RDCIS, SAIL, Ranchi</font></footer>";		
			}
			else
				header('Location:home.php');
		}	
	}
	else
		header('Location:login.php');
	?>
	</body>