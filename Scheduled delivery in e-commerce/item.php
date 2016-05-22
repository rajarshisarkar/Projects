<?php
session_start();
ob_start();
?>
<html>
	<head>
	<style>
		body{
			background-image: url("images/background.bmp");
			background-repeat: repeat;
		}
		</style>
		<link rel="icon" href="images/favicon.png" type="image/png" sizes="20x20">
	</head>
<?php
    //echo $_GET['imgsrc']; // use $_GET
    if($_SESSION['username']!=''){
		if(!isset($_POST['submit'])){
			$obj = simplexml_load_file('http://api.walmartlabs.com/v1/items/'.$_GET['imgsrc'].'?apiKey=4e3e3b4use86g3zr3gdeybsd&format=xml');
			echo '<body><center><p><u><b>Description Page</b></u></p>Hello '.$_SESSION['username'].'!<br><br><a href="home.php">Home</a>&nbsp;&nbsp;<a href="cart.php">My cart</a>&nbsp;&nbsp;<a href="orders.php">My orders</a>&nbsp;&nbsp;<a href="changepassword.php">Change password</a>&nbsp;&nbsp;<a href="logout.php">Logout</a></center>';
			echo '<b><u><br><center>'.$obj->name.'</center></u></b>';
			echo '<center><table width=1100>';
			echo '<tr><td><center><img height="400" width="400" src="'.$obj->largeImage.'"></img></center></td>
			<td><center>Price: '.$obj->salePrice.' $</center></td>
			<td><center>Customer Rating: '.$obj->customerRating.'</center></td>
			<td><center><form name="cart" method="post" onSubmit="return addtocart();"><input type="submit" value="Add to cart" name="submit"></form></center></td></tr>';
			echo '</table></center></body>';
			
			echo htmlspecialchars_decode($obj->shortDescription).'<br>';
			echo htmlspecialchars_decode($obj->longDescription);
		}
		else{
				include ("connect.php");
				$query="select cart from users where username='".$_SESSION['username']."'";
				$result=mysqli_query($con,$query);
				$row=mysqli_fetch_array($result);
				
				if($row[0]==''){
					$query="update users set cart = '".$row[0]."".$_GET['imgsrc']."' where username='".$_SESSION['username']."'";
					$result=mysqli_query($con,$query);
					//echo $query;
				}
				else{
					$query="update users set cart = '".$row[0].";".$_GET['imgsrc']."' where username='".$_SESSION['username']."'";
					$result=mysqli_query($con,$query);
					//echo $query;
				}
				
				header("Location: cart.php");
		}
	}
	else{
		header("Location: index.php");
	}
?>
</html>