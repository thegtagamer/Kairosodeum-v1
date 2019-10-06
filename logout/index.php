<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '0');
$_SESSION = array();
if (isset($_COOKIE['idCookie'])) {
    setcookie("idCookie", '', time()-42000, '/');
	setcookie("passCookie", '', time()-42000, '/');
}
// Destroy the session variables
session_destroy();

//if(!session_is_registered('username')){ 
header("location: ../"); 
//} else {
//echo "We cannot log you out.";
//exit();
//} 
?> 