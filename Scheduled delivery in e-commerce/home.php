<?php
	session_start();
	ob_start();
	//session_save_path("/var/www/html/hackathon");
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
		<title>
			Home Page
		</title>
		<style>
		body{
			background-image: url("images/background.bmp");
			background-repeat: repeat;
		}
		</style>
		<link rel="icon" href="images/favicon.png" type="image/png" sizes="20x20">
	</head>
	<body>
		<?php 
			if($_SESSION['username']=='admin'){
				header("Location: adminhome.php");
			}
			if($_SESSION['username']!=''){
				echo '<center><p><u><b>Home Page</b></u></p>Hello '.$_SESSION['username'].'!<br><br><a href="cart.php">My cart</a>&nbsp;&nbsp;<a href="orders.php">My orders</a>&nbsp;&nbsp;<a href="changepassword.php">Change password</a>&nbsp;&nbsp;<a href="logout.php">Logout</a>';
				echo '<b><u><br><br>Furnitures<br><br></u></b>';
				
				$query="select * from items;";
				include ("connect.php");
				$result=mysqli_query($con,$query);
				
				echo '<table border=1>';
				$i=1;
				if($result){
					while ($row=mysqli_fetch_array($result)){ 
						if(($i%3)==1){
							echo '<tr><td>';
							$obj = simplexml_load_file('http://api.walmartlabs.com/v1/items/'.$row[0].'?apiKey=4e3e3b4use86g3zr3gdeybsd&format=xml');
							echo '<center><a href="javascript:void(0);"><img onclick="clickIt('.$row[0].')" height="320" width="320" src="'.$obj->largeImage.'"></img></a><br>';
							echo $obj->salePrice.' $';
							echo '</center>';
							echo '</td>';
						}
						else if(($i%3)==2){
							echo '<td>';
							$obj = simplexml_load_file('http://api.walmartlabs.com/v1/items/'.$row[0].'?apiKey=4e3e3b4use86g3zr3gdeybsd&format=xml');
							echo '<center><a href="javascript:void(0);"><img onclick="clickIt('.$row[0].')" height="320" width="320" src="'.$obj->largeImage.'"></img></a><br>';
							echo $obj->salePrice.' $';
							echo '</center>';
							echo '</td>';	
						}
						else{
							echo '<td>';
							$obj = simplexml_load_file('http://api.walmartlabs.com/v1/items/'.$row[0].'?apiKey=4e3e3b4use86g3zr3gdeybsd&format=xml');
							echo '<center><a href="javascript:void(0);"><img onclick="clickIt('.$row[0].')" height="320" width="320" src="'.$obj->largeImage.'"></img></a><br>';
							echo $obj->salePrice.' $';
							echo '</center>';
							echo '</td></tr>';	
						}
						$i=($i+1);
					}
				}
				echo '</table><br><br>';
				
				/*
				$query="select * from users;";
				include ("connect.php");
				$result=mysqli_query($con,$query);
				echo '<br><br><b><u>List of all users</b></u><br><br>';
				echo '<table border=1 width=300><tr><th width=50>Sr No.</th><th width=125>Username</th><th width=125>Password</th></tr>';
				if($result){
					$i=1;
					while ($row=mysqli_fetch_array($result)){ 					
						echo'<tr><td><center>'.$i.'</td><td><center>'.$row[0].'</td><td><center>'.$row[1].'</td></tr>';
						$i=($i+1);
					}
					echo '</table>';
				}
				*/
			}
			else
				header("Location: index.php");
		?>
	</body>
</html>
