<?php
session_start();
ob_start();
?>
<html>
	<head>
		<script>
			function close_window(){
				close();
			}
			$('img').click(function(){
				alert($(this).attr('src'));
			});
			function clickIt(data){
			    window.location.href = 'item.php?imgsrc='+data;
			}
		</script>
		<style>
		body{
			background-image: url("images/background.bmp");
			background-repeat: repeat;
		}
		</style>
		<title>
			View Order
		</title>
		
		<link rel="icon" href="images/favicon.png" type="image/png" sizes="20x20">
	</head>
	<body>
		<?php
			if($_SESSION['username']!=''){
				if($_SESSION['username']!='admin')
					echo '<center><p><u><b>View Order</b></u></p>Hello '.$_SESSION['username'].'!<br><br><a href="home.php">Home</a>&nbsp;&nbsp;<a href="orders.php">My orders</a>&nbsp;&nbsp;<a href="changepassword.php">Change password</a>&nbsp;&nbsp;<a href="javascript:close_window();">Close window</a>&nbsp;&nbsp;<a href="logout.php">Logout</a><br><br></center>';
				else
					echo '<center><p><u><b>View Order</b></u></p>Hello '.$_SESSION['username'].'!<br><br><a href="adminhome.php">Home</a>&nbsp;&nbsp;<a href="javascript:close_window();">Close window</a>&nbsp;&nbsp;<a href="logout.php">Logout</a><br><br></center>';
				
				$items = explode(";", $_GET['cartvalue']);
				$itemscount = print_r(array_count_values($items), true);
				$itemscount = substr($itemscount, 7, strlen($itemscount)-9);
				//echo $itemscount;
				
				include ("connect.php");
				$query="select * from shipment where order_id=".$_GET['order_id']."";
				$result=mysqli_query($con,$query);
				$row=mysqli_fetch_array($result);
				
				
				$exp = explode('-', $row[8]);
				$row[8] = $exp[2].'-'.$exp[1].'-'.$exp[0];
				
				if($row[9]=='09:00-09:30')
					echo '<center><table border=1 width="800">
					<tr><td colspan=3><center><b>Order Details</td></tr>
					<tr><td colspan=3><center>Order booked by '.$row[1].'.</td></tr>
					<tr><td colspan=3><center>Address: '.$row[4].' - '.$row[5].'.</td></tr>
					<tr><td><center>Phone: '.$row[6].'</td><td><center>Delivery Date: '.$row[8].'</td><td><center>Delivery Timeslot: 09:00 AM - 09:30 AM</td></tr>
					</table></center>';
				if($row[9]=='09:30-10:00')
					echo '<center><table border=1 width="800">
					<tr><td colspan=3><center><b>Order Details</td></tr>
					<tr><td colspan=3><center>Order booked by '.$row[1].'.</td></tr>
					<tr><td colspan=3><center>Address: '.$row[4].' - '.$row[5].'.</td></tr>
					<tr><td><center>Phone: '.$row[6].'</td><td><center>Delivery Date: '.$row[8].'</td><td><center>Delivery Timeslot: 09:30 AM - 10:00 AM</td></tr>
					</table></center>';
				if($row[9]=='10:00-10:30')
					echo '<center><table border=1 width="800">
					<tr><td colspan=3><center><b>Order Details</td></tr>
					<tr><td colspan=3><center>Order booked by '.$row[1].'.</td></tr>
					<tr><td colspan=3><center>Address: '.$row[4].' - '.$row[5].'.</td></tr>
					<tr><td><center>Phone: '.$row[6].'</td><td><center>Delivery Date: '.$row[8].'</td><td><center>Delivery Timeslot: 10:00 AM - 10:30 AM</td></tr>
					</table></center>';
				if($row[9]=='10:30-11:00')
					echo '<center><table border=1 width="800">
					<tr><td colspan=3><center><b>Order Details</td></tr>
					<tr><td colspan=3><center>Order booked by '.$row[1].'.</td></tr>
					<tr><td colspan=3><center>Address: '.$row[4].' - '.$row[5].'.</td></tr>
					<tr><td><center>Phone: '.$row[6].'</td><td><center>Delivery Date: '.$row[8].'</td><td><center>Delivery Timeslot: 10:30 AM - 11:00 AM</td></tr>
					</table></center>';
				if($row[9]=='11:00-11:30')
					echo '<center><table border=1 width="800">
					<tr><td colspan=3><center><b>Order Details</td></tr>
					<tr><td colspan=3><center>Order booked by '.$row[1].'.</td></tr>
					<tr><td colspan=3><center>Address: '.$row[4].' - '.$row[5].'.</td></tr>
					<tr><td><center>Phone: '.$row[6].'</td><td><center>Delivery Date: '.$row[8].'</td><td><center>Delivery Timeslot: 11:00 AM - 11:30 AM</td></tr>
					</table></center>';
				if($row[9]=='11:30-12:00')
					echo '<center><table border=1 width="800">
					<tr><td colspan=3><center><b>Order Details</td></tr>
					<tr><td colspan=3><center>Order booked by '.$row[1].'.</td></tr>
					<tr><td colspan=3><center>Address: '.$row[4].' - '.$row[5].'.</td></tr>
					<tr><td><center>Phone: '.$row[6].'</td><td><center>Delivery Date: '.$row[8].'</td><td><center>Delivery Timeslot: 11:30 AM - 12:00 PM</td></tr>
					</table></center>';
				if($row[9]=='12:00-12:30')
					echo '<center><table border=1 width="800">
					<tr><td colspan=3><center><b>Order Details</td></tr>
					<tr><td colspan=3><center>Order booked by '.$row[1].'.</td></tr>
					<tr><td colspan=3><center>Address: '.$row[4].' - '.$row[5].'.</td></tr>
					<tr><td><center>Phone: '.$row[6].'</td><td><center>Delivery Date: '.$row[8].'</td><td><center>Delivery Timeslot: 12:00 PM - 12:30 PM</td></tr>
					</table></center>';
				if($row[9]=='12:30-13:00')
					echo '<center><table border=1 width="800">
					<tr><td colspan=3><center><b>Order Details</td></tr>
					<tr><td colspan=3><center>Order booked by '.$row[1].'.</td></tr>
					<tr><td colspan=3><center>Address: '.$row[4].' - '.$row[5].'.</td></tr>
					<tr><td><center>Phone: '.$row[6].'</td><td><center>Delivery Date: '.$row[8].'</td><td><center>Delivery Timeslot: 12:30 PM - 01:00 PM</td></tr>
					</table></center>';
				if($row[9]=='13:00-13:30')
					echo '<center><table border=1 width="800">
					<tr><td colspan=3><center><b>Order Details</td></tr>
					<tr><td colspan=3><center>Order booked by '.$row[1].'.</td></tr>
					<tr><td colspan=3><center>Address: '.$row[4].' - '.$row[5].'.</td></tr>
					<tr><td><center>Phone: '.$row[6].'</td><td><center>Delivery Date: '.$row[8].'</td><td><center>Delivery Timeslot: 01:00 PM - 01:30 PM</td></tr>
					</table></center>';
				if($row[9]=='13:30-14:00')
					echo '<center><table border=1 width="800">
					<tr><td colspan=3><center><b>Order Details</td></tr>
					<tr><td colspan=3><center>Order booked by '.$row[1].'.</td></tr>
					<tr><td colspan=3><center>Address: '.$row[4].' - '.$row[5].'.</td></tr>
					<tr><td><center>Phone: '.$row[6].'</td><td><center>Delivery Date: '.$row[8].'</td><td><center>Delivery Timeslot: 01:30 PM - 02:00 PM</td></tr>
					</table></center>';
				if($row[9]=='14:00-14:30')
					echo '<center><table border=1 width="800">
					<tr><td colspan=3><center><b>Order Details</td></tr>
					<tr><td colspan=3><center>Order booked by '.$row[1].'.</td></tr>
					<tr><td colspan=3><center>Address: '.$row[4].' - '.$row[5].'.</td></tr>
					<tr><td><center>Phone: '.$row[6].'</td><td><center>Delivery Date: '.$row[8].'</td><td><center>Delivery Timeslot: 02:00 PM - 02:30 PM</td></tr>
					</table></center>';
				if($row[9]=='14:30-15:00')
					echo '<center><table border=1 width="800">
					<tr><td colspan=3><center><b>Order Details</td></tr>
					<tr><td colspan=3><center>Order booked by '.$row[1].'.</td></tr>
					<tr><td colspan=3><center>Address: '.$row[4].' - '.$row[5].'.</td></tr>
					<tr><td><center>Phone: '.$row[6].'</td><td><center>Delivery Date: '.$row[8].'</td><td><center>Delivery Timeslot: 02:30 PM - 03:00 PM</td></tr>
					</table></center>';
				if($row[9]=='15:00-15:30')
					echo '<center><table border=1 width="800">
					<tr><td colspan=3><center><b>Order Details</td></tr>
					<tr><td colspan=3><center>Order booked by '.$row[1].'.</td></tr>
					<tr><td colspan=3><center>Address: '.$row[4].' - '.$row[5].'.</td></tr>
					<tr><td><center>Phone: '.$row[6].'</td><td><center>Delivery Date: '.$row[8].'</td><td><center>Delivery Timeslot: 03:00 PM - 03:30 PM</td></tr>
					</table></center>';
				if($row[9]=='15:30-16:00')
					echo '<center><table border=1 width="800">
					<tr><td colspan=3><center><b>Order Details</td></tr>
					<tr><td colspan=3><center>Order booked by '.$row[1].'.</td></tr>
					<tr><td colspan=3><center>Address: '.$row[4].' - '.$row[5].'.</td></tr>
					<tr><td><center>Phone: '.$row[6].'</td><td><center>Delivery Date: '.$row[8].'</td><td><center>Delivery Timeslot: 03:30 PM - 04:00 PM</td></tr>
					</table></center>';
				if($row[9]=='16:00-16:30')
					echo '<center><table border=1 width="800">
					<tr><td colspan=3><center><b>Order Details</td></tr>
					<tr><td colspan=3><center>Order booked by '.$row[1].'.</td></tr>
					<tr><td colspan=3><center>Address: '.$row[4].' - '.$row[5].'.</td></tr>
					<tr><td><center>Phone: '.$row[6].'</td><td><center>Delivery Date: '.$row[8].'</td><td><center>Delivery Timeslot: 04:00 PM - 04:30 PM</td></tr>
					</table></center>';
				if($row[9]=='16:30-17:00')
					echo '<center><table border=1 width="800">
					<tr><td colspan=3><center><b>Order Details</td></tr>
					<tr><td colspan=3><center>Order booked by '.$row[1].'.</td></tr>
					<tr><td colspan=3><center>Address: '.$row[4].' - '.$row[5].'.</td></tr>
					<tr><td><center>Phone: '.$row[6].'</td><td><center>Delivery Date: '.$row[8].'</td><td><center>Delivery Timeslot: 04:30 PM - 05:00 PM</td></tr>
					</table></center>';
				if($row[9]=='17:00-17:30')
					echo '<center><table border=1 width="800">
					<tr><td colspan=3><center><b>Order Details</td></tr>
					<tr><td colspan=3><center>Order booked by '.$row[1].'.</td></tr>
					<tr><td colspan=3><center>Address: '.$row[4].' - '.$row[5].'.</td></tr>
					<tr><td><center>Phone: '.$row[6].'</td><td><center>Delivery Date: '.$row[8].'</td><td><center>Delivery Timeslot: 05:00 PM - 05:30 PM</td></tr>
					</table></center>';
				if($row[9]=='17:30-18:00')
					echo '<center><table border=1 width="800">
					<tr><td colspan=3><center><b>Order Details</td></tr>
					<tr><td colspan=3><center>Order booked by '.$row[1].'.</td></tr>
					<tr><td colspan=3><center>Address: '.$row[4].' - '.$row[5].'.</td></tr>
					<tr><td><center>Phone: '.$row[6].'</td><td><center>Delivery Date: '.$row[8].'</td><td><center>Delivery Timeslot: 05:30 PM - 06:00 PM</td></tr>
					</table></center>';
				if($row[9]=='18:00-18:30')
					echo '<center><table border=1 width="800">
					<tr><td colspan=3><center><b>Order Details</td></tr>
					<tr><td colspan=3><center>Order booked by '.$row[1].'.</td></tr>
					<tr><td colspan=3><center>Address: '.$row[4].' - '.$row[5].'.</td></tr>
					<tr><td><center>Phone: '.$row[6].'</td><td><center>Delivery Date: '.$row[8].'</td><td><center>Delivery Timeslot: 06:00 PM - 06:30 PM</td></tr>
					</table></center>';
				if($row[9]=='18:30-19:00')
					echo '<center><table border=1 width="800">
					<tr><td colspan=3><center><b>Order Details</td></tr>
					<tr><td colspan=3><center>Order booked by '.$row[1].'.</td></tr>
					<tr><td colspan=3><center>Address: '.$row[4].' - '.$row[5].'.</td></tr>
					<tr><td><center>Phone: '.$row[6].'</td><td><center>Delivery Date: '.$row[8].'</td><td><center>Delivery Timeslot: 06:30 PM - 07:00 PM</td></tr>
					</table></center>';
				
				echo '<center><br><table width=800 border=1>';
				echo '<tr><td><center><b>Item</td><td><center><b>Quantity</td><td><center><b>Price</td></tr>';
				$totprice = 0;
				for($i = 0; $i <= strlen($itemscount)-20; $i=$i+20){
					$char = substr($itemscount, $i, 20);
					$itemno = substr($char, 1, 15);
					$itemno = substr($itemno, 5, 8);
					$quantity = substr($char, 19, 1);
					$obj = simplexml_load_file('http://api.walmartlabs.com/v1/items/'.$itemno.'?apiKey=4e3e3b4use86g3zr3gdeybsd&format=xml');
					//echo $i.' ~'.$itemno.'<br>';
					echo '<tr>';
					echo '<td><center><a href="javascript:void(0);"><img onclick="clickIt('.$itemno.')" height="320" width="320" src="'.$obj->largeImage.'"></img></a></td><td><center>'.$quantity.'</td><td><center>'.(float)($obj->salePrice)*(float)$quantity.' $</td>';
					echo '</tr>';
					$totprice = $totprice + (float)($obj->salePrice)*(float)$quantity;
				}
				echo '<tr><td colspan=2><center><b>Total Price:</td><td><center><b>'.$totprice.' $</td></tr>';
						echo '</table></center><br><br>';
			}
			else{
				header("Location: index.php");
			}
		?>