<?php
session_start();
echo '<body bgcolor="#333333" text="#FFFFFF" marginwidth="45"><center>';
$name=$_SESSION['uname'];
$allowedExts = array("jpg","jpeg","gif","png","JPG","PNG","GIF");
$extension = end(explode(".", $_FILES["file"]["name"])); 
echo ''.$extension.'';
if ((($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["files"]["type"] == "image/jpeg") || ($_FILES["files"]["type"] == "image/JPG") || ($_FILES["files"]["type"] == "image/PNG") || ($_FILES["files"]["type"] == "image/GIF") || ($_FILES["files"]["type"] == "image/pjpeg")) && ($_FILES["file"]["size"] < 6000000) && in_array($extension, $allowedExts)) 
	{
		if ($_FILES["file"]["error"] > 0)
			{
			echo "Return Code : " .$_FILES["file"]["error"]. "<br />";
			}
				else 
				{
				$photo=$name.".".$extension;

						move_uploaded_file($_FILES["file"]["tmp_name"],"images/".$photo); 
						echo " uploaded in the system !";
						
						include ("connect.php");
						$picname="images/".$name.".".$extension;
						$query="update user set userimage='$picname' where username='$name'";
						$result=mysqli_query($con,$query);
						
				}
	}

else
{
echo "Invalid photo file";
}
echo '<center><br><a href="account.php"><font color="white">Click here to go back to your account</font></a></center><br>';
?>