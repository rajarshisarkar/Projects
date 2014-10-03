<?php
session_start();
ob_start();
?>
<head><link rel="shortcut icon" href="photos/favicon.ico"><link rel="stylesheet" href="css.css" type="text/css"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UserDash</title>
</head>
<?php
if($_SESSION['normaluser']=='normaluser' && $_SESSION['level']==1)
header('Location: easy.php');
else if($_SESSION['normaluser']=='normaluser' && $_SESSION['level']==2)
header('Location: q2.php');
else if($_SESSION['normaluser']=='normaluser' && $_SESSION['level']==3)
header('Location: nonsense.php');
else if($_SESSION['normaluser']=='normaluser' && $_SESSION['level']==4)
header('Location: brofist.php');
else if($_SESSION['normaluser']=='normaluser' && $_SESSION['level']==5)
header('Location: candle.php');
else if($_SESSION['normaluser']=='normaluser' && $_SESSION['level']==6)
header('Location: sweet.php');
else if($_SESSION['normaluser']=='normaluser' && $_SESSION['level']==7)
header('Location: dabangg.php');
else if($_SESSION['normaluser']=='normaluser' && $_SESSION['level']==8)
header('Location: hot.php');
else if($_SESSION['normaluser']=='normaluser' && $_SESSION['level']==9)
header('Location: aussie.php');
else if($_SESSION['normaluser']=='normaluser' && $_SESSION['level']==10)
header('Location: tall.php');
else if($_SESSION['normaluser']=='normaluser' && $_SESSION['level']==11)
header('Location: 1947.php');
else if($_SESSION['normaluser']=='normaluser' && $_SESSION['level']==12)
header('Location: dhoom.php');
else if($_SESSION['normaluser']=='normaluser' && $_SESSION['level']==13)
header('Location: hide.php');
else if($_SESSION['normaluser']=='normaluser' && $_SESSION['level']==14)
header('Location: superhero.php');
else if($_SESSION['normaluser']=='normaluser' && $_SESSION['level']==15)
header('Location: share.php');
else if($_SESSION['normaluser']=='normaluser' && $_SESSION['level']==16)
header('Location: god.php');
else if($_SESSION['normaluser']=='normaluser' && $_SESSION['level']==17)
header('Location: degree.php');
else if($_SESSION['normaluser']=='normaluser' && $_SESSION['level']==18)
header('Location: inceptionofgames.php');
else if($_SESSION['normaluser']=='normaluser' && $_SESSION['level']==19)
header('Location: hospital.php');
else if($_SESSION['normaluser']=='normaluser' && $_SESSION['level']==20)
header('Location: final_level.php');
else if($_SESSION['normaluser']=='normaluser' && $_SESSION['level']==21)
header('Location: congrats.php');
else header('Location: logout.php');


?>
</html>