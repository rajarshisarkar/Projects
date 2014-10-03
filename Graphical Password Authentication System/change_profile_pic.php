<?php
session_start();
?>
<head><link rel="shortcut icon" href="photos/favicon.ico"><link rel="stylesheet" href="css.css" type="text/css"/>
<script>
			function validate()
			{

			var file=document.forms["form2"]["file"].value;		
			if (file==null || file=="")
			{
				alert("Please Upload a file !");return false;
			}
			else
			return true;
			}
			
		</script>
		<noscript>Your Javascript is off !! </noscript>
<title>Change Profile Picture</title>
</head>
<body bgcolor="#333333" text="#FFFFFF" marginwidth="45">
<?php
echo'<br><center><b><font face="calibri" color="red" size=8>Graph</font><font face="calibri" size ="8">ical Password Authentication System</font></b></center>
<a href="logout.php"><font color="white">Logout</a><hr color="#CC0000"><h2><center>Upload Profile Picture</h2>';
echo'<br><center><b><br>
<form name="form2" action="sub1.php" method="post" onSubmit="return validate();" enctype="multipart/form-data">
			
			Add Image (only .jpg, .jpeg, .gif, .png, .JPG, .PNG, .GIF format) : <input type="file" name="file"><br>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Upload">
</form>';
echo '<center><br><a href="account.php"><font color="white">Click here to go back to your account</font></a></center><br>';
?>			
</body>
</html>