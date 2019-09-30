<?php
// Start_session, check if user is logged in or not, and connect to the database all in one included file
error_reporting(E_ALL);
ini_set("display_errors", 1);
include ("../../scripts/user_session.php");
include ("../../scripts/DB_connect.php");
if (!isset($_SESSION['idx'])) {
    header('Location: ../../index.php');
}
$id = $sessionInit_id;
$UploadDirectory = '../../users/' . $id . '/music/'; //Upload Directory, ends with slash & make sure folder exist
// replace with your mysql database details
if (!@file_exists($UploadDirectory)) {
    //destination folder does not exist
    mkdir('../../users/$id/music/');
}
if ($_POST) {
    if (!isset($_POST['audio_name']) || strlen($_POST['audio_name']) < 1) {
        //required variables are empty
        die("Enter the title of the track!<br />
<a href='../'>Go Back</a>");
    }
    if (!isset($_POST['audio_desc']) || strlen($_POST['audio_desc']) < 1) {
        //required variables are empty
        die("Enter the description of the track!<br />
<a href='../'>Go Back</a>");
    }
    if (!isset($_POST['genre']) || strlen($_POST['genre']) < 1) {
        //required variables are empty
        die("Enter the genre of the track!<br />
<a href='../'>Go Back</a>");
    }
    if (!isset($_FILES['cover'])) {
        //required variables are empty
        die("File is empty!!<br />
<a href='../'>Go Back</a>");
    }
    if ($_FILES['cover']['error']) {
        //File upload error encountered
        die(upload_errors($_FILES['cover']['error']));
    }
    if (!isset($_FILES['musicFile'])) {
        //required variables are empty
        die("File is empty!!<br />
<a href='../'>Go Back</a>");
    }
    if ($_FILES['musicFile']['error']) {
        //File upload error encountered
        die(upload_errors($_FILES['musicFile']['error']));
    }
    $FileName = strtolower($_FILES['cover']['name']); //uploaded file name
    $FileName2 = strtolower($_FILES['musicFile']['name']); //uploaded file name
    $FileTitle = mysqli_real_escape_string($connection, $_POST['audio_name']); // file title
    $FileDesc = mysqli_real_escape_string($connection, $_POST['audio_desc']); // file title
    $FileGenre = mysqli_real_escape_string($connection, $_POST['genre']); // file title
    $ImageExt = substr($FileName, strrpos($FileName, '.')); //file extension
    $MusicExt = substr($FileName2, strrpos($FileName2, '.')); //file extension
    $OwnId = $sessionInit_id;
    $FileType = $_FILES['cover']['type']; //file type
    $FileSize = $_FILES['cover']["size"]; //file size
    $FileType2 = $_FILES['musicFile']['type']; //file type
    $FileSize2 = $_FILES['musicFile']["size"]; //file size
    $RandNumber = rand(0, 9999999999); //Random number to make each filename unique.
    $uploaded_date = date("Y-m-d H:i:s");
    switch (strtolower($FileType)) {
            //allowed file types
            
        case 'image/png': //png file
            
        case 'image/gif': //gif file
            
        case 'image/jpeg': //jpeg file
            
        case 'image/jpg': //jpg file
            
        break;
        default:
            die('Unsupported File!<br />
<a href="../">Go Back</a>');
            //output error
            
    }
    switch (strtolower($FileType2)) {
        case 'audio/mpeg':
        case 'audio/x-mpeg':
        case 'audio/mp3':
        case 'audio/x-mp3':
        case 'audio/mpeg3':
        case 'audio/x-mpeg3':
        case 'audio/mpg':
        case 'audio/x-mpg':
        case 'audio/x-mpegaudio':
        break;
        default:
            die('Unsupported File!<br />
<a href="../">Go Back</a>'); //output error
            
    }
    //File Title will be used as new File name
    $NewFileName = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), strtolower($FileName));
    $NewFileName = $NewFileName . '_' . $RandNumber . $ImageExt;
    //File Title will be used as new File name
    $NewFileName2 = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), strtolower($FileName2));
    $NewFileName2 = $NewFileName2 . '_' . $RandNumber . $MusicExt;
    //Rename and save uploded file to destination folder.
    if (move_uploaded_file($_FILES['musicFile']["tmp_name"], $UploadDirectory . $NewFileName2)) {
        if (move_uploaded_file($_FILES['cover']["tmp_name"], $UploadDirectory . $NewFileName)) {
            //connect & insert file record in database
            @mysql_query("INSERT INTO music (filename,file_title,file_size,file_size2,uploaded_date,own_id,filename2,file_desc,genre) VALUES ('$NewFileName2','$FileTitle','$FileSize','$FileSize2','$uploaded_date','$OwnId','$NewFileName','$FileDesc','$FileGenre')");
            header('location:../');
        } else {
            die('error!<br />
<a href="../">Go Back</a>');
        }
    } else {
        die('error!!<br />
<a href="../">Go Back</a>');
    }
}
//function outputs upload error messages, http://www.php.net/manual/en/features.file-upload.errors.php#90522
function upload_errors($err_code) {
    switch ($err_code) {
        case UPLOAD_ERR_INI_SIZE:
            return 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
        case UPLOAD_ERR_FORM_SIZE:
            return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
        case UPLOAD_ERR_PARTIAL:
            return 'The uploaded file was only partially uploaded';
        case UPLOAD_ERR_NO_FILE:
            return 'No file was uploaded';
        case UPLOAD_ERR_NO_TMP_DIR:
            return 'Missing a temporary folder';
        case UPLOAD_ERR_CANT_WRITE:
            return 'Failed to write file to disk';
        case UPLOAD_ERR_EXTENSION:
            return 'File upload stopped by extension';
        default:
            return 'Unknown upload error';
    }
}
?>