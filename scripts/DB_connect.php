<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'gofp');
define('DB_DATABASE', 'kairosodeum');
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysqli_connect_error());
$database = mysqli_select_db($connection, DB_DATABASE) or die(mysqli_connect_error());

if($connection && $database){
    echo "Database connected";
}

?>
