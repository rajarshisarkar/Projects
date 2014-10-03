		<?php 
		$server="localhost";
		$user="root";
		$password="";
		$database="graphical_pwd";
		$con=mysqli_connect($server,$user,$password,$database);
		if(!$con)
		echo 'Connection failed !';
		?>
	