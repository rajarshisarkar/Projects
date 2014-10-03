<?php
session_start();
?>
<html>
<head>

<script>
function changeIt(img)
{
var name = img.src;
window.location.href = "layer_change_success.php?var=" + name;
}
</script>



<title>
Choose image5!
</title>
</head>
<body> <font size="6" color="blue">Choose Image 5(for the new sequence)::</font>

<?php

include("connect.php");
			
                           $var=$_GET['var'];
          
			$_SESSION['a1'][4]=$_GET['var'];
			

		?>
<?php 
     
$arr = array(0,1,2,3,4);
shuffle($arr);
$i=array("images\wood.jpg","images\bit.jpg","images\\edu.jpg","images\\two.jpg","images\\virus.jpg");

echo '<center>
<img src="'.$i[$arr[0]].'" onclick="changeIt(this)" height="120" width="120">
<img src="'.$i[$arr[1]].'" onclick="changeIt(this)" height="120" width="120">
<img src="'.$i[$arr[2]].'" onclick="changeIt(this)" height="120" width="120" >
<img src="'.$i[$arr[3]].'" onclick="changeIt(this)" height="120" width="120">
<img src="'.$i[$arr[4]].'" onclick="changeIt(this)" height="120" width="120"></center>';?>

</body>
</html>