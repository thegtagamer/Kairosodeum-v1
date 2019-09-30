<?php

session_start ();
$www = $_SERVER['HTTP_HOST'];

error_reporting (E_ALL);
ini_set ('display_errors', '0');

include_once ('DB_connect.php');

$user_panel = '';

if(!isset($_SESSION['idx'])) {
	if(!isset($_COOKIE['cookie'])) {
		$user_panel = '<a href="#">GET YOU ACCOUNT REGISTERED BY THE ADMINS</a>
		&nbsp;&nbsp;&nbsp;&nbsp;
		$user_panel = <a href="http://'.$www.'/">Login</a>';
	}
}
	
?>