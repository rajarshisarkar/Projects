<?php
session_start();
ob_start();
?>
<head><link rel="shortcut icon" href="photos/favicon.ico"><link rel="stylesheet" href="css.css" type="text/css"/>
<script>
			function validate()
			{
			var qno=document.forms["form2"]["qno"].value;
			if ((qno==null || qno==""))
			{
				alert("Q No. Field is compulsory ! \nPlease fill in the Q No. field !");return false;
			}
			else
			return true;
			}
			
		</script>
		<noscript>Your Javascript is off !! </noscript>
<title> Modify a Question</title>
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
			  <font size="5">Modify a Question</strong><br></font><br>
			  </h2>
<form name="form2" action="modify_final.php" method="post" onSubmit="return validate();" enctype="multipart/form-data">
			<p align="right">Enter a Q No* : <input type ="number" name="qno"><br>
			<input type="checkbox" name="mqno" value="mqno">Modify Q No : <input type ="number" name="mqno"><br>
			<input type="checkbox" name="mqdesc" value="mqdesc">Modify Q Description : <input type="text" name="qdesc"><br>
			<input type="checkbox" name="mlife1" value="mlife1">Modify Lifeline link 1 : <input type="text" name="life1"><br>
			<input type="checkbox" name="mlife2" value="mlife2">Modify Lifeline link 2 : <input type ="text" name="life2"><br>
			<input type="checkbox" name="mname" value="mname">Modify Image name : <input type="text" name="name"><br>
			<input type="checkbox" name="mfile" value="mfile">Modify Image : <input type="file" name="file"><br>
			<input type="checkbox" name="mans" value="mans"> Modify Answer : <input type ="text" name="ans"><br>
			* Fields are compulsory | Click on the checkbox / checkboxes to modify the required fields in the database


<input type="submit" name="submit" value="submit">
</form>
<br><br><br><br><br><br><br><br>
<footer><center><u><b><a href="leaderboard.php"><font color="white">Leaderboard</a> &nbsp;&nbsp;&nbsp;&nbsp;<a href="https://www.facebook.com/pages/Decipher/173912556090728" target="_blank"><font color="white">Discussion</a> &nbsp;&nbsp;&nbsp;&nbsp;    <a href="rules.php"><font color="white">Rules & Regulations</a>   &nbsp;&nbsp;&nbsp;  <a href="prizes.php"><font color="white">Prizes</a>  &nbsp;&nbsp;&nbsp;   <a href="contact.php"><font color="white">Contact</a></center></footer>';

}

		else header('Location: logout.php');
?>			
</body>
</html>