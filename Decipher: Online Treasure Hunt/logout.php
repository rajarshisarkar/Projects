<?php
session_start();
ob_start();
?>
<?php
$_SESSION = array(); // destroy all $_SESSION data
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', 1);
        setcookie($name, '', 1, '/');
    }
}
session_destroy();


header("Location: login.php");
?>