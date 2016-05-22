<?php
session_start();
ob_start();
?>
<html>
	<head>
		<script>
			function validate(){
				var address=document.forms["placeorder"]["nameaddress"].value;
				var phone=document.forms["placeorder"]["namephone"].value;
				var pincode=document.forms["placeorder"]["pincode"].value;
						
				if ((address==null || address=="") && !(phone==null || phone=="")){
					alert("Please enter your address.");
					return false;
				}
			
				if (!(address==null || address=="") && (phone==null || phone=="")){
					alert("Please enter your phone number.");
					return false;
				}
			
				if ((phone==null || phone=="") && (address==null || address=="")){
					alert("Please enter your address and phone number.");
					return false;
				}
				if(pincode=="default"){
					alert("Please select your pincode.");
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
		
		<style>
		body{
			background-image: url("images/background.bmp");
			background-repeat: repeat;
		}
		</style>
	</head>
	<body>
	<?php
		//echo $_SESSION['totprice'];
		if($_SESSION['username']!=''){
			echo '<center><p><u><b>Place order</b></u></p>Hello '.$_SESSION['username'].'!<br><br><a href="home.php">Home</a>&nbsp;&nbsp;<a href="cart.php">My cart</a>&nbsp;&nbsp;<a href="orders.php">My orders</a>&nbsp;&nbsp;<a href="changepassword.php">Change password</a>&nbsp;&nbsp;<a href="logout.php">Logout</a><br><br></center>';
			
			if(!isset($_POST['submit'])){
				echo '<center><table width=1000 border=1>
				<tr><td><center>Cart value: <b>'.$_SESSION['totprice'].'</b></center></td></tr>
				<form name="placeorder" method="post" onSubmit="return validate();" >
				<tr><td><center>Address: <input type ="text" name="nameaddress" size="40"></center></td></tr>
				<tr><td><center>Pincode*: <select name="pincode">
				<option value="default" selected>Select</option>
				<option value="560101">560101</option>
				<option value="560102">560102</option>
				<option value="560103">560103</option>
				</select><br>*Your shipment is available only at pincodes of the drop down list.</center></td></tr>
				<tr><td><center>&nbsp;&nbsp;Phone*: <input type ="text" name="namephone" maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57"><br>*Enter your 10 digit mobile number.</center></td></tr>
				<tr><td><center>Payment: <b>Only Cash On Delivery (COD) available for your shipment.</b></center></td></tr>
				<br></table>
				<br><input type="submit" value="Set date and time slot for delivery" name="submit">
				</form>
				</center>';
			}
			else{
				//header("Location: date_time_slots.php");
				$_SESSION['address'] = $_POST['nameaddress'];
				$_SESSION['pincode'] = $_POST['pincode'];
				$_SESSION['phone'] = $_POST['namephone'];
				//echo $_SESSION['address'].'<br>'.$_SESSION['pincode'].'<br>'.$_SESSION['phone'];
				header("Location: date_time_slots.php");
			}
		}
		else{
			header("Location: index.php");
		}
	?>
	</body>
</html>