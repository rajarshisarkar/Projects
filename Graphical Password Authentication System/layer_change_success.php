<?php
session_start();
?>
<html>
<head>


<title>
Result
</title>
</head>
<body>
<?php

include("connect.php");
			
                           $var=$_GET['var'];
          
			$_SESSION['a1'][5]=$_GET['var'];

header("Location: change_sequence.php");	

		?>


</body>
</html>