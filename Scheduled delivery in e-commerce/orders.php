<?php
	session_start();
	ob_start();
?>
<html>
	<head>
		<script src="jquery-1.9.1.js">
		</script>
		<style>
		body{
			background-image: url("images/background.bmp");
			background-repeat: repeat;
		}
		</style>
		<title>
			My Orders
		</title>
		<link rel="icon" href="images/favicon.png" type="image/png" sizes="20x20">
	</head>

<?php
	if($_SESSION['username']!=''){
		echo '<body><center><p><u><b>My Orders</b></u></p>Hello '.$_SESSION['username'].'!<br><br><a href="home.php">Home</a>&nbsp;&nbsp;<a href="cart.php">My cart</a>&nbsp;&nbsp;<a href="changepassword.php">Change password</a>&nbsp;&nbsp;<a href="logout.php">Logout</a><br><br></center>';
		
		if (function_exists('date_default_timezone_set')){
				date_default_timezone_set('Asia/Kolkata');
		}
			
		include ("connect.php");
		$query="select * from shipment where username='".$_SESSION['username']."' order by shipment_date,shipment_timeslot asc";
		$result=mysqli_query($con,$query);
		echo '<center><table border=1 width=1300>';
		echo '<tr><td><center><b>Order ID</td><td><b><center>Cost</td><td><b><center>View order</td><td><b><center>Address</td><td><b><center>Pincode</td><td><b><center>Phone number</td><td><b><center>Payment option</td><td><b><center>Date of shipment</td><td><b><center>Time of shipment</td><td><b><center>Status</td></tr>';
		
		
				
		while ($row=mysqli_fetch_array($result)){			
			if(date("Y-m-d", time())<=$row[8]){
				$today = date('Y-m-d');
				if($row[9]=="09:00-09:30"){
					$from = 0900;
					$to = 0930;
					$currentTime = (int) date('Gi');
					if ($currentTime > $from && $currentTime < $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>09:00 AM - 09:30 AM</td><td><center>To be delivered</td></tr>';
					}
					else if ($currentTime > $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>09:00 AM - 09:30 AM</td><td><center>Delivered</td></tr>';
					}
					else{
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>09:00 AM - 09:30 AM</td><td><center>To be delivered</td></tr>';
					}
				}
				if($row[9]=="09:30-10:00"){
					$from = 0930;
					$to = 1000;
					$currentTime = (int) date('Gi');
					if ($currentTime > $from && $currentTime < $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>09:30 AM - 10:00 AM</td><td><center>To be delivered</td></tr>';
					}
					else if ($currentTime > $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>09:30 AM - 10:00 AM</td><td><center>Delivered</td></tr>';
					}
					else{
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>09:30 AM - 10:00 AM</td><td><center>To be delivered</td></tr>';
					}
				}
				if($row[9]=="10:00-10:30"){
					$from = 1000;
					$to = 1030;
					$currentTime = (int) date('Gi');
					if ($currentTime > $from && $currentTime < $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>10:00 AM - 10:30 AM</td><td><center>To be delivered</td></tr>';
					}
					else if ($currentTime > $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>10:00 AM - 10:30 AM</td><td><center>Delivered</td></tr>';
					}
					else{
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>10:00 AM - 10:30 AM</td><td><center>To be delivered</td></tr>';
					}
				}
				if($row[9]=="10:30-11:00"){
					$from = 1030;
					$to = 1100;
					$currentTime = (int) date('Gi');
					if ($currentTime > $from && $currentTime < $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>10:30 AM - 11:00 AM</td><td><center>To be delivered</td></tr>';
					}
					else if ($currentTime > $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>10:30 AM - 11:00 AM</td><td><center>Delivered</td></tr>';
					}
					else{
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>10:30 AM - 11:00 AM</td><td><center>To be delivered</td></tr>';
					}
				}
				if($row[9]=="11:00-11:30"){
					$from = 1100;
					$to = 1130;
					$currentTime = (int) date('Gi');
					if ($currentTime > $from && $currentTime < $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>11:00 AM - 11:30 AM</td><td><center>To be delivered</td></tr>';
					}
					else if ($currentTime > $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>11:00 AM - 11:30 AM</td><td><center>Delivered</td></tr>';
					}
					else{
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>11:00 AM - 11:30 AM</td><td><center>To be delivered</td></tr>';
					}
				}
				if($row[9]=="11:30-12:00"){
					$from = 1130;
					$to = 1200;
					$currentTime = (int) date('Gi');
					if ($currentTime > $from && $currentTime < $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>11:30 AM - 12:00 PM</td><td><center>To be delivered</td></tr>';
					}
					else if ($currentTime > $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>11:30 AM - 12:00 PM</td><td><center>Delivered</td></tr>';
					}
					else{
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>11:30 AM - 12:00 PM</td><td><center>To be delivered</td></tr>';
					}
				}
				if($row[9]=="12:00-12:30"){
					$from = 1200;
					$to = 1230;
					$currentTime = (int) date('Gi');
					if ($currentTime > $from && $currentTime < $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>12:00 PM - 12:30 PM</td><td><center>To be delivered</td></tr>';
					}
					else if ($currentTime > $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>12:00 PM - 12:30 PM</td><td><center>Delivered</td></tr>';
					}
					else{
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>12:00 PM - 12:30 PM</td><td><center>To be delivered</td></tr>';
					}
				}
				if($row[9]=="12:30-13:00"){
					$from = 1230;
					$to = 1300;
					$currentTime = (int) date('Gi');
					if ($currentTime > $from && $currentTime < $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>12:30 PM - 01:00 PM</td><td><center>To be delivered</td></tr>';
					}
					else if ($currentTime > $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>12:30 PM - 01:00 PM</td><td><center>Delivered</td></tr>';
					}
					else{
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>12:30 PM - 01:00 PM</td><td><center>To be delivered</td></tr>';
					}
				}
				if($row[9]=="13:00-13:30"){
					$from = 1300;
					$to = 1330;
					$currentTime = (int) date('Gi');
					if ($currentTime > $from && $currentTime < $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>01:00 PM - 01:30 PM</td><td><center>To be delivered</td></tr>';
					}
					else if ($currentTime > $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>01:00 PM - 01:30 PM</td><td><center>Delivered</td></tr>';
					}
					else{
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>01:00 PM - 01:30 PM</td><td><center>To be delivered</td></tr>';
					}
				}
				if($row[9]=="13:30-14:00"){
					$from = 1330;
					$to = 1400;
					$currentTime = (int) date('Gi');
					if ($currentTime > $from && $currentTime < $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>01:30 PM - 02:00 PM</td><td><center>To be delivered</td></tr>';
					}
					else if ($currentTime > $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>01:30 PM - 02:00 PM</td><td><center>Delivered</td></tr>';
					}
					else{
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>01:30 PM - 02:00 PM</td><td><center>To be delivered</td></tr>';
					}
				}
				if($row[9]=="14:00-14:30"){
					$from = 1400;
					$to = 1430;
					$currentTime = (int) date('Gi');
					if ($currentTime > $from && $currentTime < $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>02:00 PM - 02:30 PM</td><td><center>To be delivered</td></tr>';
					}
					else if ($currentTime > $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>02:00 PM - 02:30 PM</td><td><center>Delivered</td></tr>';
					}
					else{
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>02:00 PM - 02:30 PM</td><td><center>To be delivered</td></tr>';
					}
				}
				if($row[9]=="14:30-15:00"){
					$from = 1430;
					$to = 1500;
					$currentTime = (int) date('Gi');
					if ($currentTime > $from && $currentTime < $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>02:30 PM - 03:00 PM</td><td><center>To be delivered</td></tr>';
					}
					else if ($currentTime > $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>02:30 PM - 03:00 PM</td><td><center>Delivered</td></tr>';
					}
					else{
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>02:30 PM - 03:00 PM</td><td><center>To be delivered</td></tr>';
					}
				}
				if($row[9]=="15:00-15:30"){
					$from = 1500;
					$to = 1530;
					$currentTime = (int) date('Gi');
					if ($currentTime > $from && $currentTime < $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>03:00 PM - 03:30 PM</td><td><center>To be delivered</td></tr>';
					}
					else if ($currentTime > $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>03:00 PM - 03:30 PM</td><td><center>Delivered</td></tr>';
					}
					else{
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>03:00 PM - 03:30 PM</td><td><center>To be delivered</td></tr>';
					}
				}
				if($row[9]=="15:30-16:00"){
					$from = 1530;
					$to = 1600;
					$currentTime = (int) date('Gi');
					if ($currentTime > $from && $currentTime < $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>03:30 PM - 04:00 PM</td><td><center>To be delivered</td></tr>';
					}
					else if ($currentTime > $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>03:30 PM - 04:00 PM</td><td><center>Delivered</td></tr>';
					}
					else{
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>03:30 PM - 04:00 PM</td><td><center>To be delivered</td></tr>';
					}
				}
				if($row[9]=="16:00-16:30"){
					$from = 1600;
					$to = 1630;
					$currentTime = (int) date('Gi');
					if ($currentTime > $from && $currentTime < $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>04:00 PM - 04:30 PM</td><td><center>To be delivered</td></tr>';
					}
					else if($currentTime > $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>04:00 PM - 04:30 PM</td><td><center>Delivered</td></tr>';
					}
					else{
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>04:00 PM - 04:30 PM</td><td><center>To be delivered</td></tr>';
					}
				}
				if($row[9]=="16:30-17:00"){
					$from = 1630;
					$to = 1700;
					$currentTime = (int) date('Gi');
					if ($currentTime > $from && $currentTime < $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>04:30 PM - 05:00 PM</td><td><center>To be delivered</td></tr>';
					}
					else if($currentTime > $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>04:30 PM - 05:00 PM</td><td><center>Delivered</td></tr>';
					}
					else{
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>04:30 PM - 05:00 PM</td><td><center>To be delivered</td></tr>';
					}
				}
				if($row[9]=="17:00-17:30"){
					$from = 1700;
					$to = 1730;
					$currentTime = (int) date('Gi');
					if ($currentTime > $from && $currentTime < $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>05:00 PM - 05:30 PM</td><td><center>To be delivered</td></tr>';
					}
					else if($currentTime > $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>05:00 PM - 05:30 PM</td><td><center>Delivered</td></tr>';
					}
					else{
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>05:00 PM - 05:30 PM</td><td><center>To be delivered</td></tr>';
					}
				}
				if($row[9]=="17:30-18:00"){
					$from = 1730;
					$to = 1800;
					$currentTime = (int) date('Gi');
					if ($currentTime > $from && $currentTime < $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>05:30 PM - 06:00 PM</td><td><center>To be delivered</td></tr>';
					}
					else if($currentTime > $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>05:30 PM - 06:00 PM</td><td><center>Delivered</td></tr>';
					}
					else{
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>05:30 PM - 06:00 PM</td><td><center>To be delivered</td></tr>';
					}
				}
				if($row[9]=="18:00-18:30"){
					$from = 1800;
					$to = 1830;
					$currentTime = (int) date('Gi');
					if ($currentTime > $from && $currentTime < $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>06:00 PM - 06:30 PM</td><td><center>To be delivered</td></tr>';
					}
					else if($currentTime > $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>06:00 PM - 06:30 PM</td><td><center>Delivered</td></tr>';
					}
					else{
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>06:00 PM - 06:30 PM</td><td><center>To be delivered</td></tr>';
					}
				}
				if($row[9]=="18:30-19:00"){
					$from = 1830;
					$to = 1900;
					$currentTime = (int) date('Gi');
					if ($currentTime > $from && $currentTime < $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>06:30 PM - 07:00 PM</td><td><center>To be delivered</td></tr>';
					}
					else if($currentTime > $to && $today==$row[8]){
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>06:30 PM - 07:00 PM</td><td><center>Delivered</td></tr>';
					}
					else{
						$exp = explode('-', $row[8]);
						$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
						echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>06:30 PM - 07:00 PM</td><td><center>To be delivered</td></tr>';
					}
				}
			}
			else{
				$exp = explode('-', $row[8]);
				$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
				if($row[9]=="09:00-09:30")
					echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>09:00 AM - 09:30 AM</td><td><center>Delivered</td></tr>';
				if($row[9]=="09:30-10:00")
					echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>09:30 AM - 10:00 AM</td><td><center>Delivered</td></tr>';
				if($row[9]=="10:00-10:30")
					echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>10:00 AM - 10:30 AM</td><td><center>Delivered</td></tr>';
				if($row[9]=="10:30-11:00")
					echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>10:30 AM - 11:00 AM</td><td><center>Delivered</td></tr>';
				if($row[9]=="11:00-11:30")
					echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>11:00 AM - 11:30 AM</td><td><center>Delivered</td></tr>';
				if($row[9]=="11:30-12:00")
					echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>11:30 AM - 12:00 PM</td><td><center>Delivered</td></tr>';
				if($row[9]=="12:00-12:30")
					echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>12:00 PM - 12:30 PM</td><td><center>Delivered</td></tr>';
				if($row[9]=="12:30-13:00")
					echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>12:30 PM - 01:00 PM</td><td><center>Delivered</td></tr>';
				if($row[9]=="13:00-13:30")
					echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>01:00 PM - 01:30 PM</td><td><center>Delivered</td></tr>';
				if($row[9]=="13:30-14:00")
					echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>01:30 PM - 02:00 PM</td><td><center>Delivered</td></tr>';
				if($row[9]=="14:00-14:30")
					echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>02:00 PM - 02:30 PM</td><td><center>Delivered</td></tr>';
				if($row[9]=="14:30-15:00")
					echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>02:30 PM - 03:00 PM</td><td><center>Delivered</td></tr>';
				if($row[9]=="15:00-15:30")
					echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>03:00 PM - 03:30 PM</td><td><center>Delivered</td></tr>';
				if($row[9]=="15:30-16:00")
					echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>03:30 PM - 04:00 PM</td><td><center>Delivered</td></tr>';
				if($row[9]=="16:00-16:30")
					echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>04:00 PM - 04:30 PM</td><td><center>Delivered</td></tr>';
				if($row[9]=="16:30-17:00")
					echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>04:30 PM - 05:00 PM</td><td><center>Delivered</td></tr>';
				if($row[9]=="17:00-17:30")
					echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>05:00 PM - 05:30 PM</td><td><center>Delivered</td></tr>';
				if($row[9]=="17:30-18:00")
					echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>05:30 PM - 06:00 PM</td><td><center>Delivered</td></tr>';
				if($row[9]=="18:00-18:30")
					echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>06:00 PM - 06:30 PM</td><td><center>Delivered</td></tr>';
				if($row[9]=="18:30-19:00")
					echo '<tr><td><center>'.$row[0].'</td><td><center>'.$row[3].' $</td><td><center><a href="vieworder.php?cartvalue='.$row[2].'&order_id='.$row[0].'" target="_blank">View order</a></td><td><center>'.$row[4].'</td><td><center>'.$row[5].'</td><td><center>'.$row[6].'</td><td><center>'.$row[7].'</td><td><center>'.$row[8].'</td><td><center>06:30 PM - 07:00 PM</td><td><center>Delivered</td></tr>';
			}
		}
		echo '</table></center>';
	}
	else{
		header("Location: index.php");
	}
?>
</body>
</html>