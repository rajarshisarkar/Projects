<?php
//session_start();
ob_start();
?>

<?php 
	$server="localhost";
	$username="root";
	$password="";
	$database="preferred_delivery_time_db";
	$con=mysqli_connect($server,$username,$password,$database);
	if(!$con)
		echo 'Connection failed !';
?>

<?php 
	/* $server="localhost";
	$username="schedul6_root";
	$password="RUn!I+4O#-xc";
	$database="schedul6_preferred_delivery_time_db";
	$con=mysqli_connect($server,$username,$password,$database);
	if(!$con)
		echo 'Connection failed !'; */
?>