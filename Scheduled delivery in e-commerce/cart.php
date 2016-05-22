<?php
session_start();
ob_start();
?>
<html>
	<head>
		<script src="jquery-1.9.1.js"></script>
		<script>
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
			My Cart
		</title>
		<link rel="icon" href="images/favicon.png" type="image/png" sizes="20x20">
	</head>
	<body>
		<?php
			if($_SESSION['username']!=''){
					if(!isset($_POST['submit'])){
						echo '<center><p><u><b>My Cart</b></u></p>Hello '.$_SESSION['username'].'!<br><br><a href="home.php">Home</a>&nbsp;&nbsp;<a href="orders.php">My orders</a>&nbsp;&nbsp;<a href="changepassword.php">Change password</a>&nbsp;&nbsp;<a href="logout.php">Logout</a><br><br>Scroll down to place your order.</center>';
				
						include ("connect.php");
						$query="select cart from users where username='".$_SESSION['username']."'";
						$result=mysqli_query($con,$query);
						$row=mysqli_fetch_array($result);
						$items = explode(";", $row[0]);
						$itemscount = print_r(array_count_values($items), true);
						$itemscount = substr($itemscount, 7, strlen($itemscount)-9);
						//echo $itemscount;
						echo '<center><br><table width=1000 border=1>';
						echo '<tr><td><center><b>Item</td><td><center><b>Quantity</td><td><center><b>Price</td><td><b><center>Remove item</td></tr>';
						$totprice = 0;
						for($i = 0; $i <= strlen($itemscount)-20; $i=$i+20){
							$char = substr($itemscount, $i, 20);
							$itemno = substr($char, 1, 15);
							$itemno = substr($itemno, 5, 8);
							$quantity = substr($char, 19, 1);
							$obj = simplexml_load_file('http://api.walmartlabs.com/v1/items/'.$itemno.'?apiKey=4e3e3b4use86g3zr3gdeybsd&format=xml');
							//echo $i.' ~'.$itemno.'<br>';
							echo '<tr>';
							echo '<td><center><a href="javascript:void(0);"><img onclick="clickIt('.$itemno.')" height="320" width="320" src="'.$obj->largeImage.'"></img></a></td><td><center>'.$quantity.'</td><td><center>'.(float)($obj->salePrice)*(float)$quantity.' $</td><td><center><a href="remove.php?del='.$itemno.'">Remove item</a></td>';
							echo '</tr>';
							$totprice = $totprice + (float)($obj->salePrice)*(float)$quantity;
						}
						
						$_SESSION['totprice'] = $totprice.' $';
						echo '<tr><td colspan=2><center><b>Total Price:</td><td><center><b>'.$totprice.' $</td><td border=0></td></tr>';
						echo '</table></center>';
						
						if($totprice!=0){
							echo '<br><br><center><form name="placeorder" method="post"><input type="submit" value="Place Order" name="submit"></form></center><br><br>';	
						}
						else{
							echo '<center><br><br>Add some items in your cart to place order.</center>';
						}
					}
					else{
						header("Location: placeorder.php");
					}
				}
			else{
				header("Location: index.php");
			}
		?>
	</body>
</html>