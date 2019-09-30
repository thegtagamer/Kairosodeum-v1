<?php
include_once("../scripts/user_session.php");
?>
<?php
session_start();
if (isset($_SESSION['idx'])) {
	header("location: ../home/");
}
$errorMsg = '';
$email = '';
$pass = '';
$remember = '';
$timestamp = time() + 300;
if (isset($_POST['email'])) {
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	if (isset($_POST['remember'])) {
		$remember = $_POST['remember'];
	}
	$email = stripslashes($email);
	$pass = stripslashes($pass);
	$email = strip_tags($email);
	$pass = strip_tags($pass);
	
	if ((!$email) || (!$pass)) { 
		echo 'error';
		//$errorMsg = 'Please fill in both fields';

	} else { 
		include '../scripts/DB_connect.php'; 
		$email = mysqli_real_escape_string($connection, $email); 
	 
		$pass = md5($pass); 
		
        $sql = mysqli_query($connection,"SELECT * FROM users WHERE email='$email' AND password='$pass'"); 
		$login_check = mysqli_num_rows($sql);
        
		if($login_check > 0){ 
			echo "success";
    			while($row = mysqli_fetch_array($sql))
					{
		
					$id = $row["id"]; 
					$username = $row["username"];  
					$_SESSION['id'] = $id;
					$_SESSION['idx'] = base64_encode("g4p37hmp3h9xfn8sq03hs2234$id");
					$_SESSION['username'] = $username;

					mysqli_query($connection, "UPDATE users SET last_log=now(), online = '1', timestamp = '$timestamp' WHERE id='$id' LIMIT 1");
          			} 
	
    			if($remember == "yes")
					{
                    $encryptedID = base64_encode("ghdg94enm2c0c4y3dn3727553$id");
    			    setcookie("idCookie", $encryptedID, time()+60*60*24*100, "/"); 
			        setcookie("passCookie", $pass, time()+60*60*24*100, "/"); 
    				} 
    			exit();
		} else { 
		    echo "error";
		    //$errorMsg = "Incorrect login data, please try again";
		}
    } 
}
?>
