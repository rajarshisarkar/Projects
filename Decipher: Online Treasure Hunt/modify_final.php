<?php
session_start();
ob_start();
?>
<head>
<title> Modify a Question</title>
</head><link rel="shortcut icon" href="photos/favicon.ico"><link rel="stylesheet" href="css.css" type="text/css"/>
<body bgcolor="#333333" text="#FFFFFF" marginwidth="45">
<center><br><center><b><font face="calibri" color="red" size=8>de</font><font face="calibri" size ="8">cipher</font></b></center>Hi admin !&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;<a href="admindash.php"><font color="white">Admin's Dashboard</a> | <a href="logout.php"><font color="white">Logout</a>

			<hr color="#CC0000">
			<p>
			  <strong> <center>
			  <font size="5">Modify a Question</strong><br></font><br>
			  </h2>
<?php
if($_SESSION['username']=='admin')
{
			include("connect.php");
			$f=0;
			  
			  if(isset($_POST['mqdesc']))
			  {
			  
						$qno=$_POST['qno'];
						$mdesc=$_POST['qdesc'];
						$query="select * from questions where qno=$qno" ;
						$result=mysqli_query($con,$query);
						if($result)
						{
							if(mysqli_num_rows($result)>0)
							{ 
								$result=mysqli_query($con,"update questions set qdesc='$mdesc' where qno=$qno");			
							}	
								else 
									{
									$f=1;
									echo 'No such question exists !<br><a href="modify.php"><font color="white">Click here to modify another Question</a>';
									}
						}
			  
			  }
			  if(isset($_POST['mlife1']))
			  {
			  
						$qno=$_POST['qno'];
						$mlife1=$_POST['life1'];
						$query="select * from questions where qno=$qno" ;
						$result=mysqli_query($con,$query);
						if($result)
						{
							if(mysqli_num_rows($result)>0)
							{ 
								$result=mysqli_query($con,"update questions set lifeline1='$mlife1' where qno=$qno");			
							}	
								else 
									{
									$f=1;
									echo 'No such question exists !<br><a href="modify.php"><font color="white">Click here to modify another Question</a>';
									}
						}
			  
			  }
			  if(isset($_POST['mlife2']))
			  {
			  
						$qno=$_POST['qno'];
						$mlife2=$_POST['life2'];
						$query="select * from questions where qno=$qno" ;
						$result=mysqli_query($con,$query);
						if($result)
						{
							if(mysqli_num_rows($result)>0)
							{ 
								$result=mysqli_query($con,"update questions set lifeline2='$mlife2' where qno=$qno");			
							}	
								else 
									{
									$f=1;
									echo 'No such question exists !<br><a href="modify.php"><font color="white">Click here to modify another Question</a>';
									}
						}
			  
			  }
			  if(isset($_POST['mname']))
			  {
			  			$qno=$_POST['qno'];
						$mname=$_POST['name'];
						$query="select * from questions where qno=$qno" ;
						$result=mysqli_query($con,$query);
						if($result)
						{
							if(mysqli_num_rows($result)>0)
							{ 
								$result=mysqli_query($con,"update questions set imagename='$mname' where qno=$qno");			
							}	
								else 
									{
									$f=1;
									echo 'No such question exists !<br><a href="modify.php"><font color="white">Click here to modify another Question</a>';
									}
						}
			  }
			  if(isset($_POST['mfile']))
			  {
			  
						$qno=$_POST['qno'];
						$mname=$_POST['name'];
						$query="select * from questions where qno=$qno" ;
						$result=mysqli_query($con,$query);
						if($result)
						{
							if(mysqli_num_rows($result)>0)
							{ 
								//yahan kaam karna hai
								$name=$_POST['name'];
								$allowedExts = array("jpg","jpeg","gif","png","JPG","PNG","GIF"); // variable mein all kind of extensions store kar rahe hai
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
													echo $photo. " already exists !<br>" ;
													}
														else
														{
														move_uploaded_file($_FILES["file"]["tmp_name"],"photos/".$photo); 
														// temporary name aur location mein store hota hai server pe // toh photos ke andar .$photo bolke store kar do
														echo $photo." uploaded in the system !<br>";
														}
												}
									}

													else
													{
													echo "Invalid photo file";
													}
							}	
								else 
									{
									$f=1;
									echo 'No such question exists !<br><a href="modify.php"><font color="white">Click here to modify another Question</a>';
									}
						}
			  
			  }
			  if(isset($_POST['mans']))
			  {
						$qno=$_POST['qno'];
						$mans=$_POST['ans'];
						$query="select * from questions where qno=$qno" ;
						$result=mysqli_query($con,$query);
						if($result)
						{
							if(mysqli_num_rows($result)>0)
							{ 
								$result=mysqli_query($con,"update questions set answer='$mans' where qno=$qno");			
							}	
								else 
									{
									$f=1;
									echo 'No such question exists !<br><a href="modify.php"><font color="white">Click here to modify another Question</a>';
									}
						}
			  }
			  if(isset($_POST['mqno']))
			  {
						$qno=$_POST['qno'];
						$mqno=$_POST['mqno'];
						$query="select * from questions where qno=$qno" ;
						$result=mysqli_query($con,$query);
						if($result)
						{
							if(mysqli_num_rows($result)>0)
							{ 
								$result=mysqli_query($con,"update questions set qno=$mqno where qno=$qno");			
							}	
								else 
									{
									$f=1;
									echo 'No such question exists !<br><a href="modify.php"><font color="white">Click here to modify another Question</a>';
									}
						}
							
						
			  }
			  if(!$f)
			  echo 'Question Sucessfully Modified! <br><a href="modify.php"><font color="white">Click here to modify another Question</a>';

}
		else header('Location: logout.php');
			  ?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			<footer><center><u><b><a href="leaderboard.php"><font color="white">Leaderboard</a> &nbsp;&nbsp;&nbsp;&nbsp;<a href="https://www.facebook.com/pages/Decipher/173912556090728" target="_blank"><font color="white">Discussion</a> &nbsp;&nbsp;&nbsp;&nbsp;    <a href="rules.php"><font color="white">Rules & Regulations</a>   &nbsp;&nbsp;&nbsp;  <a href="prizes.php"><font color="white">Prizes</a>  &nbsp;&nbsp;&nbsp;   <a href="contact.php"><font color="white">Contact</a></center></footer>

</body>
</html>