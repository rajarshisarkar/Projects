<?php
session_start();
ob_start();
?>
<html>
<head>

<script>
function changeIt(img)
{
var name = img.src;
window.location.href = "login_success.php?var=" + name;
}
</script>



<title>
Layer 5!
</title>
</head>
<?php
echo '<body bgcolor="#333333" text="#FFFFFF" marginwidth="45"> <br><center><b><font face="calibri" color="red" size=8>Graph</font><font face="calibri" size ="8">ical Password Authentication System</font></b></center>
<a href="logout.php"><font color="white">Logout</font></a><hr color="#CC0000">
<center><h4>Image Layer 5/5<br><i>After selecting any image on this layer - <br><font color="lime">If your selection sequence is correct
then you will be redirected to your account</font> , <font color="orange">else you\'ll be redirected to to the beginning of the selection process again!</font></center>
<center><b>Choose your Image ::</b><br><br><center>';



            $var=$_GET['var'];
			$_SESSION['a'][9]=$_GET['var'];
			$_SESSION['layer4']=$_GET['var'];
			


$ar[0]="wood.";
$ar[1]="edu.";
$ar[2]="bit.";
$ar[3]="two.";
$ar[4]="virus.";
shuffle($ar);

echo '<center>';
for($i=0;$i<=4;$i++)
echo '<img src="images\\'.$ar[$i].'jpg" onclick="changeIt(this)" height="120" width="120"> ';
echo '</center>
</body>';
echo '<footer><br><br><br><br><br><br><i><p align="right">Designed by <a href="https://www.facebook.com/RaJarshiSarkar"><font color="white">Rajarshi Sarkar</font></a> and <a href="https://www.facebook.com/saurabh290493"><font color="white">Saurabh Garg</font></a></i></footer>';			
?>

</body>
</html>