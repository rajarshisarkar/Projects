<?php
session_start();
ob_start();
?>
<head><link rel="shortcut icon" href="photos/favicon.ico"><link rel="stylesheet" href="css.css" type="text/css"/>
<script>
			function validate()
			{
			var qno=document.forms["form2"]["qno"].value;
			var qdesc=document.forms["form2"]["qdesc"].value;
			var life1=document.forms["form2"]["life1"].value;
			var life2=document.forms["form2"]["life2"].value;
			var name=document.forms["form2"]["name"].value;
			var file=document.forms["form2"]["file"].value;
			var ans=document.forms["form2"]["ans"].value;
			
			
			if ((qno==null || qno=="") || (qdesc==null || qdesc=="") || (life1==null || life1=="") || (life2==null || life2=="") || (name==null || name=="") || (file==null || file=="") || (ans==null || ans==""))
			{
				alert("All fields are compulsory ! \nPlease fill in the empty fields !");return false;
			}
			else
			return true;
			}
			
		</script>
		<noscript>Your Javascript is off !! </noscript>
<title>Add a Question</title>
</head>
<body bgcolor="#333333" text="#FFFFFF" marginwidth="45">
<?php
if($_SESSION['username']=='admin')
{
echo'<center><br><center><b><font face="calibri" color="red" size=8>de</font><font face="calibri" size ="8">cipher</font></b></center>Hi admin !&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;<a href="admindash.php"><font color="white">Admin\'s Dashboard</a> | <a href="logout.php"><font color="white">Logout</a>

			<hr color="#CC0000">
			<p>
			  <strong> <center>
			  <font size="5">Add a Question</strong><br></font><br>
			  </h2>
<form name="form2" action="sub1.php" method="post" onSubmit="return validate();" enctype="multipart/form-data">
			<p align="right">Q No : <input type ="number" name="qno"><br>
			Q Description : <input type="text" name="qdesc"><br>
			Lifeline link 1 : <input type="text" name="life1"><br>
			Lifeline link 2 : <input type ="text" name="life2"><br>
			Image name : <input type="text" name="name"><br>
			Add Image (only .jpg format) : <input type="file" name="file"><br>
			Answer : <input type ="text" name="ans"><br>
			All Fields are compulsory


<input type="submit" name="submit" value="submit">
</form>
<br><br><br><br><br><br><br><br><br>
<footer><center><u><b><a href="leaderboard.php"><font color="white">Leaderboard</a> &nbsp;&nbsp;&nbsp;&nbsp;<a href="https://www.facebook.com/pages/Decipher/173912556090728" target="_blank"><font color="white">Discussion</a> &nbsp;&nbsp;&nbsp;&nbsp;    <a href="rules.php"><font color="white">Rules & Regulations</a>   &nbsp;&nbsp;&nbsp;  <a href="prizes.php"><font color="white">Prizes</a>  &nbsp;&nbsp;&nbsp;   <a href="contact.php"><font color="white">Contact</a></center></footer>
';
}

		else header('Location: logout.php');
?>			
</body>
</html>