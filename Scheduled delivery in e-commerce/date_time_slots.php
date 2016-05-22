<?php
session_start();
ob_start();
?>
<html>
	<head>
		<script>
			function validate(){
				var date=document.forms["date_time_slots"]["date"].value;
				var timeslot=document.forms["date_time_slots"]["timeslot"].value;
						
				if(date=="default" && timeslot=="default"){
					alert("Please select your date and timeslot for delivery.");
					return false;
				}
				if(date=="default"){
					alert("Please select your date of delivery.");
					return false;
				}
				if(timeslot=="default"){
					alert("Please select your time slot of delivery.");
					return false;
				}
				else
					return true;
			}
		</script>
		<style>
		body{
			background-image: url("images/background.bmp");
			background-repeat: repeat;
		}
		</style>
		<link rel="icon" href="images/favicon.png" type="image/png" sizes="20x20">
	</head>

<?php
	if($_SESSION['username']!=''){
		if(!isset($_POST['submit'])){
			echo '<body><center><p><u><b>Schedule my shipment</b></u></p>Hello '.$_SESSION['username'].'!<br><br><a href="home.php">Home</a>&nbsp;&nbsp;<a href="cart.php">My cart</a>&nbsp;&nbsp;<a href="orders.php">My orders</a>&nbsp;&nbsp;<a href="changepassword.php">Change password</a>&nbsp;&nbsp;<a href="logout.php">Logout</a><br><br></center>';
			
			//echo $_SESSION['address'].'<br>'.$_SESSION['pincode'].'<br>'.$_SESSION['phone'];
			
			if (function_exists('date_default_timezone_set')){
				date_default_timezone_set('Asia/Kolkata');
			}
			//echo '<br>'.date('Y-m-d h-i-s');
			//$reqdate = date("Y-m-d", time()+86400*2);
			//echo '<br>'.$reqdate;
			
			echo '<center><table width=1000 border=1>
					<form name="date_time_slots" method="post" onSubmit="return validate();">
					<tr><td><center>Cart value: <b>'.$_SESSION['totprice'].'</b></center></td></tr>
					<tr><td><center>Address: '.$_SESSION['address'].'</center></td></tr>
					<tr><td><center>Pincode: '.$_SESSION['pincode'].'<br></center></td></tr>
					<tr><td><center>&nbsp;&nbsp;Phone: '.$_SESSION['phone'].'</center></td></tr>
					<tr><td><center>Payment: <b>Cash On Delivery (COD).</b></center></td></tr>
					<tr><td><center>
					Based on your pincode you can schedule your shipment as follows:<br><br>
					
					<select name="date">
						<option value="default" selected>Select date</option>
						<option value="'.date("Y-m-d", time()+86400*2).'">'.date("d-m-Y", time()+86400*2).'</option>
						<option value="'.date("Y-m-d", time()+86400*3).'">'.date("d-m-Y", time()+86400*3).'</option>
						<option value="'.date("Y-m-d", time()+86400*4).'">'.date("d-m-Y", time()+86400*4).'</option>
					</select>
					
					&nbsp;&nbsp;
					
					<select name="timeslot">
						<option value="default" selected>Select time slot</option>
						<option value="09:00-09:30">09:00 AM - 09:30 AM</option>
						<option value="09:30-10:00">09:30 AM - 10:00 AM</option>
						<option value="10:00-10:30">10:00 AM - 10:30 AM</option>
						<option value="10:30-11:00">10:30 AM - 11:00 AM</option>
						<option value="11:00-11:30">11:00 AM - 11:30 AM</option>
						<option value="11:30-12:00">11:30 AM - 12:00 PM</option>
						<option value="12:00-12:30">12:00 PM - 12:30 PM</option>
						<option value="12:30-13:00">12:30 PM - 01:00 PM</option>
						<option value="13:00-13:30">01:00 PM - 01:30 PM</option>
						<option value="13:30-14:00">01:30 PM - 02:00 PM</option>
						<option value="14:00-14:30">02:00 PM - 02:30 PM</option>
						<option value="14:30-15:00">02:30 PM - 03:00 PM</option>
						<option value="15:00-15:30">03:00 PM - 03:30 PM</option>
						<option value="15:30-16:00">03:30 PM - 04:00 PM</option>
						<option value="16:00-16:30">04:00 PM - 04:30 PM</option>
						<option value="16:30-17:00">04:30 PM - 05:00 PM</option>
						<option value="17:00-17:30">05:00 PM - 05:30 PM</option>
						<option value="17:30-18:00">05:30 PM - 06:00 PM</option>
						<option value="18:00-18:30">06:00 PM - 06:30 PM</option>
						<option value="18:30-19:00">06:30 PM - 07:00 PM</option>
					</select>
					
					<br><br><input type="submit" value="Schedule your shipment" name="submit"><br><br></center></td></tr>
					<br>
					</form>
					</table>
					
					</center>';
		}
		else{
			include ("connect.php");
			$query="select cart from users where username='".$_SESSION['username']."'";
			$result=mysqli_query($con,$query);
			$cart=mysqli_fetch_array($result);
			
			if($cart[0]!=''){
				$query="select cart from users where username='".$_SESSION['username']."'";
				$result=mysqli_query($con,$query);
				$cart=mysqli_fetch_array($result);
				
				$query="INSERT into shipment(username, cart, cost, address, pincode, phone, payment_option, shipment_date, shipment_timeslot) values ('".$_SESSION['username']."', '$cart[0]', ".substr($_SESSION['totprice'], 0, strlen($_SESSION['totprice'])-2).", '".$_SESSION['address']."', '".$_SESSION['pincode']."', '".$_SESSION['phone']."', 'COD', '".$_POST['date']."', '".$_POST['timeslot']."')";
				$result=mysqli_query($con,$query);
				
				$query="update users set cart='' where username='".$_SESSION['username']."'";
				$result=mysqli_query($con,$query);
				
				$query="select no_of_parcels from date_and_time_slots where pincode=".$_SESSION['pincode']." and shipment_timeslot='".$_POST['timeslot']."' and date='".$_POST['date']."'";
				$result=mysqli_query($con,$query);
				$parcels=mysqli_fetch_array($result);
				$parcels[0] = (int)$parcels[0];
				$parcels[0] = ($parcels[0]+1);

				$query="update date_and_time_slots set no_of_parcels=".$parcels[0]." where pincode=".$_SESSION['pincode']." and shipment_timeslot='".$_POST['timeslot']."' and date='".$_POST['date']."'";
				$result=mysqli_query($con,$query);
				
				echo '<body><center><p><u><b>Confirmation</b></u></p>Hello '.$_SESSION['username'].'!<br><br><a href="home.php">Home</a>&nbsp;&nbsp;<a href="cart.php">My cart</a>&nbsp;&nbsp;<a href="orders.php">My orders</a>&nbsp;&nbsp;<a href="changepassword.php">Change password</a>&nbsp;&nbsp;<a href="logout.php">Logout</a><br><br></center>';
				
				$exp = explode('-', $_POST['date']);
				$_POST['date']=$exp[2].'-'.$exp[1].'-'.$exp[0];
				
				if($_POST['timeslot']=='09:00-09:30')
					echo '<center>Your shipment will be delivered on '.$_POST['date'].' between 09:00 AM - 09:30 AM. <br>Thank you for shopping with us.<br>Click <a href="home.php">here</a> to continue shopping with us.<br>Click <a href="orders.php">here</a> to view your orders.</center>';
				if($_POST['timeslot']=='09:30-10:00')
					echo '<center>Your shipment will be delivered on '.$_POST['date'].' between 09:30 AM - 10:00 AM. <br>Thank you for shopping with us.<br>Click <a href="home.php">here</a> to continue shopping with us.<br>Click <a href="orders.php">here</a> to view your orders.</center>';
				if($_POST['timeslot']=='10:00-10:30')
					echo '<center>Your shipment will be delivered on '.$_POST['date'].' between 10:00 AM - 10:30 AM. <br>Thank you for shopping with us.<br>Click <a href="home.php">here</a> to continue shopping with us.<br>Click <a href="orders.php">here</a> to view your orders.</center>';
				if($_POST['timeslot']=='10:30-11:00')
					echo '<center>Your shipment will be delivered on '.$_POST['date'].' between 10:30 AM - 11:00 AM. <br>Thank you for shopping with us.<br>Click <a href="home.php">here</a> to continue shopping with us.<br>Click <a href="orders.php">here</a> to view your orders.</center>';
				if($_POST['timeslot']=='11:00-11:30')
					echo '<center>Your shipment will be delivered on '.$_POST['date'].' between 11:00 AM - 11:30 AM. <br>Thank you for shopping with us.<br>Click <a href="home.php">here</a> to continue shopping with us.<br>Click <a href="orders.php">here</a> to view your orders.</center>';
				if($_POST['timeslot']=='11:30-12:00')
					echo '<center>Your shipment will be delivered on '.$_POST['date'].' between 11:30 AM - 12:00 PM. <br>Thank you for shopping with us.<br>Click <a href="home.php">here</a> to continue shopping with us.<br>Click <a href="orders.php">here</a> to view your orders.</center>';
				if($_POST['timeslot']=='12:00-12:30')
					echo '<center>Your shipment will be delivered on '.$_POST['date'].' between 12:00 PM - 12:30 PM. <br>Thank you for shopping with us.<br>Click <a href="home.php">here</a> to continue shopping with us.<br>Click <a href="orders.php">here</a> to view your orders.</center>';
				if($_POST['timeslot']=='12:30-13:00')
					echo '<center>Your shipment will be delivered on '.$_POST['date'].' between 12:30 PM - 01:00 PM. <br>Thank you for shopping with us.<br>Click <a href="home.php">here</a> to continue shopping with us.<br>Click <a href="orders.php">here</a> to view your orders.</center>';
				if($_POST['timeslot']=='13:00-13:30')
					echo '<center>Your shipment will be delivered on '.$_POST['date'].' between 01:00 PM - 01:30 PM. <br>Thank you for shopping with us.<br>Click <a href="home.php">here</a> to continue shopping with us.<br>Click <a href="orders.php">here</a> to view your orders.</center>';
				if($_POST['timeslot']=='13:30-14:00')
					echo '<center>Your shipment will be delivered on '.$_POST['date'].' between 01:30 PM - 02:00 PM. <br>Thank you for shopping with us.<br>Click <a href="home.php">here</a> to continue shopping with us.<br>Click <a href="orders.php">here</a> to view your orders.</center>';
				if($_POST['timeslot']=='14:00-14:30')
					echo '<center>Your shipment will be delivered on '.$_POST['date'].' between 02:00 PM - 02:30 PM. <br>Thank you for shopping with us.<br>Click <a href="home.php">here</a> to continue shopping with us.<br>Click <a href="orders.php">here</a> to view your orders.</center>';
				if($_POST['timeslot']=='14:30-15:00')
					echo '<center>Your shipment will be delivered on '.$_POST['date'].' between 02:30 PM - 03:00 PM. <br>Thank you for shopping with us.<br>Click <a href="home.php">here</a> to continue shopping with us.<br>Click <a href="orders.php">here</a> to view your orders.</center>';
				if($_POST['timeslot']=='15:00-15:30')
					echo '<center>Your shipment will be delivered on '.$_POST['date'].' between 03:00 PM - 03:30 PM. <br>Thank you for shopping with us.<br>Click <a href="home.php">here</a> to continue shopping with us.<br>Click <a href="orders.php">here</a> to view your orders.</center>';
				if($_POST['timeslot']=='15:30-16:00')
					echo '<center>Your shipment will be delivered on '.$_POST['date'].' between 03:30 PM - 04:00 PM. <br>Thank you for shopping with us.<br>Click <a href="home.php">here</a> to continue shopping with us.<br>Click <a href="orders.php">here</a> to view your orders.</center>';
				if($_POST['timeslot']=='16:00-16:30')
					echo '<center>Your shipment will be delivered on '.$_POST['date'].' between 04:00 PM - 04:30 PM. <br>Thank you for shopping with us.<br>Click <a href="home.php">here</a> to continue shopping with us.<br>Click <a href="orders.php">here</a> to view your orders.</center>';
				if($_POST['timeslot']=='16:30-17:00')
					echo '<center>Your shipment will be delivered on '.$_POST['date'].' between 04:30 PM - 05:00 PM. <br>Thank you for shopping with us.<br>Click <a href="home.php">here</a> to continue shopping with us.<br>Click <a href="orders.php">here</a> to view your orders.</center>';
				if($_POST['timeslot']=='17:00-17:30')
					echo '<center>Your shipment will be delivered on '.$_POST['date'].' between 05:00 PM - 05:30 PM. <br>Thank you for shopping with us.<br>Click <a href="home.php">here</a> to continue shopping with us.<br>Click <a href="orders.php">here</a> to view your orders.</center>';
				if($_POST['timeslot']=='17:30-18:00')
					echo '<center>Your shipment will be delivered on '.$_POST['date'].' between 05:30 PM - 06:00 PM. <br>Thank you for shopping with us.<br>Click <a href="home.php">here</a> to continue shopping with us.<br>Click <a href="orders.php">here</a> to view your orders.</center>';
				if($_POST['timeslot']=='18:00-18:30')
					echo '<center>Your shipment will be delivered on '.$_POST['date'].' between 06:00 PM - 06:30 PM. <br>Thank you for shopping with us.<br>Click <a href="home.php">here</a> to continue shopping with us.<br>Click <a href="orders.php">here</a> to view your orders.</center>';
				if($_POST['timeslot']=='18:30-19:00')
					echo '<center>Your shipment will be delivered on '.$_POST['date'].' between 06:30 PM - 07:00 PM. <br>Thank you for shopping with us.<br>Click <a href="home.php">here</a> to continue shopping with us.<br>Click <a href="orders.php">here</a> to view your orders.</center>';
				
			}
			else{
				header("Location: home.php");
			}
		}
	}
	else{
		header("Location: index.php");
	}
?>
</html>