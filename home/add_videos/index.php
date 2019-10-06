<?php
// Start_session, check if user is logged in or not, and connect to the database all in one included file
include("../../scripts/user_session.php");
include("../../scripts/DB_connect.php");
if (!isset($_SESSION['idx'])) {
	 header('Location: ../../index.php');
	}

$id = $sessionInit_id;
$UploadDirectory	= '../../users/'.$id.'/videos/'; //Upload Directory, ends with slash & make sure folder exist
// replace with your mysql database details

if (!@file_exists($UploadDirectory)) {
	//destination folder does not exist
	mkdir('../../users/$id/videos/');
}
if($_POST)
{	
	if(!isset($_POST['videoTitle']) || strlen($_POST['videoTitle'])<1)
	{
		//required variables are empty
		die("Enter the title of the video");
	}
	if(!isset($_POST['video_url']) || strlen($_POST['video_url'])<1)
	{
		//required variables are empty
		die("Enter the url of the video");
	}

	if(!isset($_FILES['vidCover']))
	{
		//required variables are empty
		die("File is empty!");
	}
	if($_FILES['vidCover']['error'])
	{
		//File upload error encountered
		die(upload_errors($_FILES['vidCover']['error']));
	}


function getYouTubeIdFromURL($url)
{
  $url_string = parse_url($url, PHP_URL_QUERY);
  parse_str($url_string, $args);
  return isset($args['v']) ? $args['v'] : false;
}


	$FileName			= strtolower($_FILES['vidCover']['name']); //uploaded file name
	$FileTitle			= mysql_real_escape_string($_POST['videoTitle']); // file title
	$FileURL_fetch			= mysql_real_escape_string($_POST['video_url']); // file title
	$FileURL = 			getYouTubeIdFromURL($FileURL_fetch);
	$ImageExt			= substr($FileName, strrpos($FileName, '.')); //file extension
	$OwnId				= $sessionInit_id;
	$FileType			= $_FILES['vidCover']['type']; //file type
	$FileSize			= $_FILES['vidCover']["size"]; //file size
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
   if(move_uploaded_file($_FILES['vidCover']["tmp_name"], $UploadDirectory . $NewFileName ))
   {
		//connect & insert file record in database
		$query =mysql_query("INSERT INTO videos (uploaded_date,own_id,file_url,file_size,title,cover) VALUES('$uploaded_date','$OwnId','$FileURL','$FileSize','$FileTitle','$NewFileName')");


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