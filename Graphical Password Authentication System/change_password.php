<?php
session_start();
?>
<html>
<head>


<title>
Result
</title>
</head>
<body><center>
<form name="form" action="change_password_success.php" method="post" onSubmit="return validate();"> <font size="2" color="blue">
Enter Old Password: <input type="password" name="old"><br>
Enter New Password: <input type="password" name="new"><br>
<input type="submit" name="sub" value="Update"></font>
</form>


</center>
</body>
</html>