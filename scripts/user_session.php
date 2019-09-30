<?php
if(!isset($_SESSION)) 
{ 
	session_start(); 
} 
error_reporting(E_ALL);
ini_set("display_errors", 1);
///////////////////////////////////////////////////////
include_once "DB_connect.php"; 



$dyn_www = $_SERVER['HTTP_HOST']; 
//////CHECK IF USER IS LOGGED IN OR NOT ////
$sessionInit = ''; 
// If the session variable and cookie variable are not set...
if (!isset($_SESSION['idx'])) { 
  /*if (!isset($_COOKIE['idCookie'])) {
     $sessionInit = '<p><a href="/signup">Register</a>

	 <a title="Login" href="#?w=500" class="poplight" rel="popup1">Login</a></p>';
   	  }*/
}

// If session ID is set for logged in user without cookies remember me feature set
if (isset($_SESSION['idx'])) { 
   	$decryptedID = base64_decode($_SESSION['idx']);
	$id_array = explode("7hmp3h9xfn8sq03hs2234", $decryptedID);
	$sessionInit_id = $id_array[1];
    $sessionInit_username = $_SESSION['username'];
    $sessionInit_username = substr('' . $sessionInit_username . '', 0, 15); // cut user name down in length if too long
	////////////////////////////////////////////////////////////////////////////////////
	
        $sessionInit .= '<li><a href="http://' . $dyn_www . '/home/" class="scroll-link">Dashboard</a></li>
<li><a href="http://' . $dyn_www . '/logout/" class="scroll-link">Logout</a></li>';
$timestamp = time() + 600;

@mysqli_query($connection, "UPDATE users SET timestamp = '$timestamp'  WHERE id='$sessionInit_id'"); 
//////news div to be displayed if user is not login////
} else if (isset($_COOKIE['idCookie'])) {// If id cookie is set, but no session ID is set yet, we set it below and update stuff
	
	$decryptedID = base64_decode($_COOKIE['idCookie']);
	$id_array = explode("nm2c0c4y3dn3727553", $decryptedID);
	$userID = $id_array[1]; 
	$userPass = $_COOKIE['passCookie'];
	// Get their user first name to set into session var
    $sql_uname = mysqli_query($connection, "SELECT username FROM users WHERE id='$userID' AND password='$userPass' LIMIT 1");
	$numRows = mysqli_num_rows($connection, $sql_uname);
	if ($numRows == 0) {
		echo 'Something went wrong. Please <a href="login.php">Log in again here please</a>';
		exit();
	}
    while($row = mysqli_fetch_array($sql_uname)){ 
	    $username = $row["username"];
	}

    $_SESSION['id'] = $userID; // now add the value we need to the session variable
	$_SESSION['idx'] = base64_encode("g4p3h9xfn8sq03hs2234$userID");
    $_SESSION['username'] = $username;
    $sessionInit_id = $userID;
    $sessionInit_uname = $username;
    $sessionInit_uname = substr('' . $sessionInit_uname . '', 0, 15); 
    ///////////          Update Last Login Date Field       /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$timestamp = time() + 600;
   @mysqli_query($connection, "UPDATE users SET timestamp = '$timestamp'  WHERE id='$userID'"); 


     $sessionInit = '<li><a href="http://' . $dyn_www . '/home/" class="scroll-link">Dashboard</a></li>
<li><a href="http://' . $dyn_www . '/logout/" class="scroll-link">Logout</a></li>';
}
?>
