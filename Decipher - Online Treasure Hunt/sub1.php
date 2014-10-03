<?php
session_start();
ob_start();
?>
<head><link rel="shortcut icon" href="photos/favicon.ico"><link rel="stylesheet" href="css.css" type="text/css"/></head>
<body bgcolor="#333333" text="#FFFFFF" marginwidth="45">
<center><br><center><b><font face="calibri" color="red" size=8>de</font><font face="calibri" size ="8">cipher</font></b></center>Hi admin !&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;<a href="admindash.php"><font color="white">Admin's Dashboard</a> | <a href="logout.php"><font color="white">Logout</a>

			<hr color="#CC0000">
			<p>
			  <strong> <center>
			  <font size="5">Add a Question</strong><br></font><br>
			  </h2>
<?php
if($_SESSION['username']=='admin')
{
		include("connect.php");
		$qno=$_POST['qno'];
		$qdesc=$_POST['qdesc'];
		$life1=$_POST['life1'];
		$life2=$_POST['life2'];
		$ans=$_POST['ans'];
$name=$_POST['name'];
$allowedExts = array("jpg"); // variable mein all kind of extensions store kar rahe hai
$extension = end(explode(".", $_FILES["file"]["name"])); // dot ke idhar udhar baat dega // sirf .jpg store ho raha hai extension mein
//img789000.jpg => img789000 and .jpg // name ="swapan" // so new name => swapan.jpg
//echo ''.$extension.'';
if ((($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["files"]["type"] == "image/jpeg") || ($_FILES["files"]["type"] == "image/JPG") || ($_FILES["files"]["type"] == "image/PNG") || ($_FILES["files"]["type"] == "image/GIF") || ($_FILES["files"]["type"] == "image/pjpeg")) && ($_FILES["file"]["size"] < 6000000) && in_array($extension, $allowedExts)) 
// file ka parameters hai file and type // in bytes // 6 mb // allowed extension mein hona chahiye
	{
		if ($_FILES["file"]["error"] > 0)
			{
			echo "Return Code : " .$_FILES["file"]["error"]. "<br />"; // file ka type mein error hoga toh kaam karega
			}
				else // agar error nahi hai tab code kaam karna chalu karega
				{
				$photo=$name.".".$extension; // naya naam banaya jaa raha hai // dot se jora gaya hai
					if (file_exists("photos/".$photo)) // agar photos folder ke andar wo photo exists kar raha hai toh ye kaam karega
					{
					echo $photo. " already exists !" ;
					}
						else
						{
						move_uploaded_file($_FILES["file"]["tmp_name"],"photos/".$photo); 
						// temporary name aur location mein store hota hai server pe // toh photos ke andar .$photo bolke store kar do
						echo $photo." uploaded in the system !";
						}
				}
	}

else
{
echo "Invalid photo file";
}


						$query="INSERT into questions(qno,qdesc,lifeline1,lifeline2,imagename,answer) values ('$qno','$qdesc','$life1','$life2','$name','$ans')";
						$result = mysqli_query($con,$query); 
						if($result) 
						{
						echo '<center>Question added successfully !<br><a href="addq.php"><font color="white">Click here to add another Question</font></a>!';
						}
						else echo '<br>Some problem occured - Question not added !<br><a href="addq.php"><font color="white">Click here to add another Question</font></a>';
		}

		else header('Location: logout.php');
						?>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			<footer><center><u><b><a href="leaderboard.php"><font color="white">Leaderboard</a> &nbsp;&nbsp;&nbsp;&nbsp;<a href="https://www.facebook.com/pages/Decipher/173912556090728" target="_blank"><font color="white">Discussion</a> &nbsp;&nbsp;&nbsp;&nbsp;    <a href="rules.php"><font color="white">Rules & Regulations</a>   &nbsp;&nbsp;&nbsp;  <a href="prizes.php"><font color="white">Prizes</a>  &nbsp;&nbsp;&nbsp;   <a href="contact.php"><font color="white">Contact</a></center></footer></body>

</body>
</html>