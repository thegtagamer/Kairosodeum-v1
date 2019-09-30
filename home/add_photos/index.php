<?php
// Start_session, check if user is logged in or not, and connect to the database all in one included file
include("../../scripts/user_session.php");
include("../../scripts/DB_connect.php");
if (!isset($_SESSION['idx'])) {
	 header('Location: ../../index.php');
	}

$id = $sessionInit_id;
$UploadDirectory	= '../../users/'.$id.'/photos/'; //Upload Directory, ends with slash & make sure folder exist
// replace with your mysql database details

if (!@file_exists($UploadDirectory)) {
	//destination folder does not exist
	mkdir('../../users/$id/photos/');
}
if($_POST)
{	
	if(!isset($_POST['photo_name']) || strlen($_POST['photo_name'])<1)
	{
		//required variables are empty
		die("Enter the title of the photo");
	}
	if(!isset($_FILES['photoFile']))
	{
		//required variables are empty
		die("File is empty!");
	}
	if($_FILES['photoFile']['error'])
	{
		//File upload error encountered
		die(upload_errors($_FILES['photoFile']['error']));
	}
	$FileName			= strtolower($_FILES['photoFile']['name']); //uploaded file name
	$FileTitle			= mysqli_real_escape_string($connection,$_POST['audio_name']); // file title
	$ImageExt			= substr($FileName, strrpos($FileName, '.')); //file extension
	$OwnId				= $sessionInit_id;
	$FileType			= $_FILES['photoFile']['type']; //file type
	$FileSize			= $_FILES['photoFile']["size"]; //file size
	$RandNumber   		= rand(0, 9999999999); //Random number to make each filename unique.
	$uploaded_date		= date("Y-m-d H:i:s");
	switch(strtolower($FileType))
	{
		//allowed file types
		case 'image/png': //png file
		case 'image/gif': //gif file 
		case 'image/jpeg': //jpeg file
	    case 'image/jpg': //jpg file
		
			break;
		default:
			die('Unsupported File!<br />
<a href="home.php">Go Back</a>');
			 //output error
	}
	//File Title will be used as new File name
	$NewFileName = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), strtolower($FileName));
	$NewFileName = $NewFileName.'_'.$RandNumber.$ImageExt;
   //Rename and save uploded file to destination folder.
   if(move_uploaded_file($_FILES['photoFile']["tmp_name"], $UploadDirectory . $NewFileName ))
   {
		//connect & insert file record in database
		$query =mysqli_query($connection,"INSERT INTO gallery(filename,title, file_size, own_id, uploaded_date) VALUES ('$NewFileName','$FileTitle', '$FileSize', '$OwnId', now())");


		///////////////////////////////PDF conversion and mail sending //////////////////////////////////////////////




		/////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		header('location:../');
   }else{
   		die('error uploading File!<br />
<a href="home.php">Go Back</a>');
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