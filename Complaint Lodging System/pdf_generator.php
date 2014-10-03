<?php
ob_start();
ob_clean();
session_start();
if($_SESSION['normaluser']=='normaluser' && $_SESSION['uname'])
{
	// Include the main TCPDF library (search for installation path).
	ob_start();
	ob_clean();
	require_once('tcpdf/config/tcpdf_config.php');
	require_once('tcpdf/tcpdf.php');

	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$pdf->setPrintHeader(false);
	header('Content-Disposition: attachment; filename=complaint_reciept.pdf');

	// set some language-dependent strings (optional)
	if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		require_once(dirname(__FILE__).'/lang/eng.php');
		$pdf->setLanguageArray($l);
	}
	// set font
	$pdf->SetFont('times', '', 12);

	// add a page
	$pdf->AddPage();

	/*
	echo $_SESSION['id'];
	echo $_SESSION['date'];
	echo $_SESSION['loc_no'];
	echo $_SESSION['maybeattended'];
	echo $_SESSION['nameofuser'];
	echo $_SESSION['status'];
	echo $_SESSION['complaintdescription'];
	*/
	//<td><img src="images/favicon.gif"></img></td><td>Service Requisition Form - Electrical</td>
	// create some HTML content
	if(strcmp($_SESSION['civil_elec'],'E')==0)
		$civil_elec='Electrical';
	else if(strcmp($_SESSION['civil_elec'],'C')==0)
		$civil_elec='Civil';
	$html = '
	<html>
	<head>
	<title>Online Complant Online Lodging</title>
	</head>
	<body text="white">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/sail.gif" width="100" height="100"></img>
	<div style="text-align:center"><b><u>Service Requisition Form - '.$civil_elec.'</b></u></div><br><br>
	<table border=".5" width="540">
	<thead><tr><td align="center" width="200">Construction and Maintenance (Township), <br>RDCIS, SAIL, Ranchi</td><td align="center" width="200">&nbsp;<br>Service Requisition Form - '.$civil_elec.'</td><td align="center" width="140">&nbsp;<br>Complaint ID: '. $_SESSION['id'].'</td></tr></thead>
	<tbody>
	<tr><td width="95" align="center" height="45">&nbsp;<br>Date: '.$_SESSION['date'].'</td><td width="105" align="center">&nbsp;<br>Location: '.$_SESSION['loc_no'].'</td><td width="340" align="center">&nbsp;<br>Description of Service Required</td></tr>
	<tr><td width="200" align="center" height="190">&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>May be Attended: '.$_SESSION['maybeattended'].'</td><td width="340"><br><br>&nbsp;&nbsp;'.$_SESSION['complaintdescription'].'<br><br><br><br><br><br><br><br><br>&nbsp;&nbsp;Signature of Customer<br>&nbsp;&nbsp;Name:&nbsp;'.$_SESSION['nameofuser'].'</td></tr>
	<tr><td width="200" height="45"><br><br>&nbsp;&nbsp;Job SL. No.: </td><td align="center" rowspan="2" >&nbsp;<br><br><br><br><br>Signature with remarks of Customer after completion of Job </td></tr>
	<tr><td width="200" height="45"><br><br>&nbsp;&nbsp;Alloted to: <br>&nbsp;&nbsp;On:<br></td></tr>
	

	</tbody>				
	</table>
	</body>
	</html>';

	// output the HTML content
	$pdf->writeHTML($html, true, false, true, false, '');

	// reset pointer to the last page
	$pdf->lastPage(); 
	//Close and output PDF document
	$pdf->Output('complaint_reciept.pdf', 'I');
}
else
	header('Location:login.php');