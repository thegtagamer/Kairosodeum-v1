<?php
include("../scripts/user_session.php");

$user_pic = "";
$links = "";	 	 	 	 	 	 	 
$username = ""; 	 	 	 	 
$firstname = ""; 	 	 	 	 	 	 
$middlename	= ""; 	 	 	 	 	 	 
$lastname = "";	 	 	 	 	 	 
$gender = "";		 	 	 	 	 	 	
$birthday = "";	 	 	 	 	 	
$email = "";	 	 	 	 	 	 	 	 	 	 	 	 	 	 
$sign_up_date = "";	 	 	 	 	 	 	
$last_log_date = "";	 	 	 	 	 	 	
$bio_body = "";		 	 	 				 
$website = "";	 	 	 	 	 	 	 
$youtube = "";		 	 	 	 	 	 	 
$facebook = "";	 	 	 	 	 	 	 
$twitter = "";	 	 	 	 	 	 	  	 	 				 
$user_type = "";	 	 	 	 	 	 	
$account_status	= "";	 	 	 	 	 	 	 	 	 	 	 	 	 
$phone = "";	 	 	 	 	 	 	 
$address = "";	 	 	 	 	 	 	 	 	 	 	 	 	 
$user_type="";
$contract = "";	 	 	 	 
$cacheBuster = rand(999999999,9999999999999); // Put on an image URL will help always show new when changed
$encrypted_nos = base64_encode("s6k3k4lsjdfsdsasf453fs"); //this will be used in deleting response
// ------- END INITIALIZE SOME VARIABLES ---------

//------- ESTABLISH THE PAGE ID ACCORDING TO CONDITIONS ---------
if (isset($_GET['id'])) {
	 $id = preg_replace('#[^0-9]#i', '', $_GET['id']); // filter everything but numbers
} else if (isset($_SESSION['idx'])) {
	 $id = $sessionInit_id;
} else {
   header("location: index.php");
   exit();
}

$id = preg_replace("#[^0-9]#i", '', $id);
$check_user = mysqli_query($connection,"SELECT * FROM users WHERE id = '$id' LIMIT 1") or die(mysqli_connect_error());
$sql_confirmation = mysqli_num_rows($check_user);

if($sql_confirmation == 0){
	// header("location:index.php?msg=user_does_not_exist");
	}
while($row = mysqli_fetch_array($check_user)) {
    $email = $row['email'];
	
	$username = $row["username"];
	//$firstname = $row["firstname"];
	//$middlename = $row["middlename"];
	$lastname = $row["lastname"];
	$address = $row["address"];	
	$sign_up_date = $row["sign_up_date"];
    $sign_up_date = strftime("%b %d, %Y", strtotime($sign_up_date));
	$last_log_date = $row["last_log_date"];
    $last_log_date = strftime("%b %d, %Y", strtotime($last_log_date));	
	$bio_body = $row["bio_body"];	
	$bio_body = str_replace("&#39;", "'", $bio_body);
	$bio_body = stripslashes($bio_body);
	$experience = $row["experiences_body"];	
	$experience = str_replace("&#39;", "'", $experience);
	$experience = stripslashes($experience);
	$website = $row["website"];
	$youtube = $row["youtube"];
    $facebook = $row["facebook"];
	$twitter = $row["twitter"];
	$google = $row["google"];	
	$friends_array = $row["friend_array"]; 	 	 	 	 	 	 
	$gender = $row["gender"];		 	 	 	 	 	 	
	$birthday = $row["birthday"];	 	 	 	 	  	 	 	 	 	 	 	 	 	 	 	 	 	 	 	  	 	 				
	$user_type = $row["user_type"] ;	
	$contract = $row["contract"]; 	 	 	 	 	
	$account_status	= $row["account_status"];	 	 	 	 	 	 	 	 	 	 	 	 	 
	$phone = $row["phone"];	 
	$city = $row["city"];	 	 	 	 	 	 
}//close while loop
/////////////////////////CHECK FOR USERNAME TO DISPLAY//////////
if($firstname != "")
	{
	$username = $firstname;
	$username = ucfirst($firstname).' '.ucfirst($middlename).' '.ucfirst($lastname);
	}else 
		{
		$username = ucfirst($username);
		}

///////  Mechanism to Display Pic. See if they have uploaded a pic or not  //////////////////////////
	$check_pic = "../users/$id/pic.jpg";
	$default_pic = "../users/0/pic.jpg";
	if (file_exists($check_pic)) {
    $user_pic = "

 <img class=\"card-bkimg\" src=\"$check_pic?$cacheBuster\"  alt=\"img\" />";
	} else {
	$user_pic = "<img class=\"card-bkimg\" src=\"$default_pic\"  alt=\"img\" />"; 
	}

	$check_bg = "../users/$id/bg.jpg";

	if(file_exists($check_bg)){
		$user_bg = "../users/$id/bg.jpg";
	}else{
		$user_bg = "../users/0/bg.jpg";
	}


	
	///////////////////////////////////////////////////////////
	/////////////////FUNCTIONS GOES HERE////////////////////////////////////////////////////////-------------///
	////function show name in active links//////////
	function show_name($name,$profile_id, $true = true, $s = true)
		{
		if($s == true)
			{
			$s = '\'s';
			}else
				{
				$s = '';
				}
		if($true == true)
			{
			$name = '<a href="home.php?id='.$profile_id.'">'.$name.$s.'</a>';
			}else 
				{
				$name = $name;
				}
		
		return $name;
		}
		//--------//
		//close function------//
		
		//----------//FUNCTION TO CUT LONG WORDS IN STRING VERY POWERFUL/////////////---//
		function wrap($str, $width=20, $break="\n", $char_no=5) 
			{
			  return preg_replace('#(\S{'.$width.',})#e', "chunk_split('$1', ".$char_no.", '".$break."')", $str);
			}
		
					
		/////////////////////END FUNCTIONS BUILDING///////////////////
		
	//MECHANISM TO DISPLAY NAME
	if($firstname != ""){
		$show_name = show_name($username, $id);
		}else
		 {
			$show_name = show_name($username, $id);
			}
	//MECHANISM TO DISPLAY INFOS
	$bio = "";
	
	if($bio_body != ""){
		$bio.='<div class="infoHeader"><span class="boldStuff2"><strong>Bio:</strong></span></div>';
		$bio.='<div class="infoBody">'.wrap($bio_body).'</div>';
		}else 
			{
			$bio = "";
			}
	
/////////////////////////////////END MECHANISM TO DISPLAY LINKS///////////////////////
////////////////////////////////Mechanism to invite//////////////////////////////////

 if(isset($_POST['invite_q'])){

 	$invite_q = $_POST['invite_q'];
 	$invite_q = mysqli_real_escape_string($connection,$invite_q);
  	


     if(!$invite_q){
    	$error_p=  'Error. Please fill the form properly.';

    }else{

    
 $to = "$invite_q";
                     
    $from = "info@kairosodeum.com";
    $subject = 'You have been invited to KairosOdeum';

      $message = "<html>
<head>
<style>
#mail_header{
background:#282828;
width:100%;
height:120px;	
}
#header_logo{
	margin-left:45%;
	margin-top:1%;	
}
#mail_content h2{
	text-align:center;
	font-size:28px;
	font-weight:bold;}
#mail_content{
	text-align:center;
	
    font-size: 15px;
    line-height: 1.6em;
    margin-bottom: .8em;
}
	#mail_footer{
		
		margin-top:16px;
		width:100%;
		height:40px;
		bottom:0;
		text-align:center;}
</style>
</head>

<body>

<div id=\"mail_header\">
<img id=\"header_logo\" src=\"http://www.kairosodeum.com/assets/themes/default/images/logo.png\">
</div>
<div id=\"mail_content\">
<h2>Welcome to KairosOdeum</h2>
<p>Hi,  </p>
<p>We are very glad to invite you to be the member of this growing community.</p>

<p> &ldquo;Kairos Odeum&rdquo; - A string that connects; musical ability, artistic integrity, love and passion for music! &lsquo;Kairos Odeum&rsquo;, is a Greek word where &lsquo;Kairos&rsquo; stands &lsquo;The opportune moment&rsquo; and &lsquo;Odeum&rsquo; stands for &lsquo;a platform for musical performance&rsquo;. Thus, Kairos Odeum is born; a platform that gives the budding and established Indian musicians alike, a platform to play and perform on your own terms, giving you full access to gigs in just a few simple clicks. Previously, if a band had to perform, it had to approach the platform, agree on performance conditions, negotiate prices, give a sample performance and then maybe, just maybe it got the chance to perform.
Now think! By making a simple profile and updating it, you get the gigs you deserve, at your preferred locations, on your terms and, more importantly at your price! All you have to do is sign up, upload your videos, audios, photographs and your performance experience. Seems utopian? Well, wake up and smell the coffee because Kairos Odeum gives you opportunity to get gigs with just a click. Just wait and see how Kairos Odeum turns your musical journey into silver screen performances!</p>
<p> See you on KairosOdeum <br />
Thanking You,<br />
Team Kairos<br />
<a href=\"http://www.kairosodeum.com\" class=\"btn btn-primary\">Start your journey</a>
</p>
</div>

<div id=\"mail_footer\">Copyright © 2017 KAIROSODEUM All rights reserved.</div>
</body>
</html>";
   //end of message
  $headers  = "From: $from\r\n";
   $headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    mail($to, $subject, $message, $headers);

    $Successmsg= 'Your request has been registered, We will reach out to you soon - Team kairosodeum';

    }


}







			//////////////////////////////// Check if already hired ////////////////////////////

$hire_check = mysqli_query($connection, "SELECT * from hire_request WHERE own_id='$sessionInit_id' AND hiring_id='$id'");
while($row=mysqli_fetch_array($hire_check)){
	$approval = $row['approved'];
	$book_price = $row['price'];
}

	$bb_price = $book_price;


$hire_check_flag = mysqli_num_rows($hire_check);


$follow_check = mysqli_query($connection, "SELECT * from followers where own_id='$sessionInit_id' AND following_id='$id'");
while($row= mysqli_fetch_array($follow_check)){
	$follow_approval = $row['approved'];

}
$follow_check_flag = mysqli_num_rows($follow_check);


//////////////////////Follow Mechanism //////////////////////////////////////////////
if(isset($_POST['follow'])){

	$user_value = mysqli_real_escape_string($connection, $_POST['user_value']);

	$follow_query=mysqli_query($connection, "INSERT INTO followers (own_id,following_id,follow_date) VALUES('$sessionInit_id','$user_value',now())");

if($follow_query){
	header('location:/home?id='.$user_value.'');
}
}


//////////////////Unfollow Mechanism ////////////////////////////////////////////////
if(isset($_POST['unfollow'])){

	$user_value = mysqli_real_escape_string($connection, $_POST['user_value']);

	$follow_query=mysqli_query($connection, "DELETE FROM followers WHERE own_id='$sessionInit_id' AND following_id='$user_value'");

if($follow_query){
	header('location:/home?id='.$user_value.'');
}
}

/////////////////////////////////////////////////////////////////////////////////////

  $error_p ="";
  /////////////////////////////// Mechanism to Hire ///////////////////////////////////////
  if(isset($_POST['bookDate'])){
  	$bookDate= preg_replace('#[^0-9]#i', "", $_POST['bookDate']);
    $bookTime= preg_replace('#[^0-9]#i', '', $_POST['bookTime']); // filter everything but numbers
    $quotePrice =  preg_replace('#[^0-9]#i', "", $_POST['quotePrice']);
    $owners_id = preg_replace('#[^0-9]#i', "", $_POST['od']);
    $hiring_user = preg_replace('#[^0-9]#i', "", $_POST['hd']);
    $approved = 0;
    $req_date		= date("Y-m-d H:i:s");

   


    	$hire_query = mysqli_query($connection, "INSERT INTO hire_request(own_id,hiring_id,bookdate,booktime,price,approved,req_date) VALUES ('$owners_id','$hiring_user','$bookDate','$bookTime','$quotePrice','$approved','$req_date')");


    
 $to = "kairosodeum@gmail.com";
                     
    $from = "info@kairosodeum.com";
    $subject = 'Booking Request';

      $message = "Hi Arnav,

    $sessionInit_username has requested to hire $username_hire for $book_date at $book_time for a total amount of $price.


    Please, Reach out to them soon.


";
   //end of message
  $headers  = "From: $from\r\n";
    $headers .= "Content-type: text\r\n";

    mail($to, $subject, $message, $headers);

    $Successmsg= 'Your request has been registered, We will reach out to you soon - Team kairosodeum';

    header('location: /home/?id='.$hiring_user.'');

    

  // Connect to database
  
  /*  $sql_check_if_con = mysql_query("SELECT con_array FROM users WHERE id='$id' LIMIT 1") or die(mysql_error());
    $sql_con_check2 = mysql_query("SELECT usera,userb FROM con_req WHERE usera='$phone'");
     $con_check2 = mysqli_num_rows($sql_con_check2);
    $con_list_arr = explode(",", $con_list);

  while($row = mysqli_fetch_array($connection,$sql_check_if_con))
    {
    $con_list = $row['con_array'];
    }//close while

      if(in_array($phone, $con_list_arr)){
        echo '<div>Already connected to this number</div>';
      }elseif($phone == $phone_c){
        echo 'You cant connect with yourself';
      }elseif($con_check2>0){
        echo 'Request pending';

      }else{

       $sql = mysql_query("INSERT INTO con_req (usera, userb, con_date) VALUES('$phone','$phone_c',now())")  
     or die (mysql_error());
      

       echo 'success';
      }*/



      }


      $hire_area="";
      /////////////////////////// Hire Alert ///////////////////////////////////////

      $hire_alert = mysqli_query($connection, "SELECT * FROM hire_request WHERE hiring_id='$sessionInit_id' AND approved='0'");


      while($row= mysqli_fetch_array($hire_alert)){
      	$o_id = $row['own_id'];
      	$h_id = $row['hiring_id'];
      	$b_date = $row['bookdate'];
      	$b_time = $row['booktime'];
      	$b_price = $row['price'];

      	$sql_hire_user = mysqli_query($connection, "SELECT * FROM users WHERE id='$o_id'");
      	while($row= mysqli_fetch_array($sql_hire_user)){

      		$hiring_name = $row['username'];
      


      	$hire_area.='<div>'.$hiring_name.' wants to hire you for '.$b_date.' at time '.$b_time.' HRS for the amount of Rs.'.$b_price.'</div>

      	<div id="">
<form action="index.php" method="post" enctype="multipart/form-data">
<input type="hidden" id="hire_approval" name="hire_approval" value="'.$o_id.'">
      	<button type="submit" class="btn btn-primary">Approve</button>

      	</form>
      	</div>
      	<div id="">
<form action="index.php" method="post" enctype="multipart/form-data">
<input type="hidden" id="hire_deny" name="hire_deny" value="'.$o_id.'">
      	<button type="submit" class="btn btn-primary">Deny</button>

      	</form></div>';

      }
	}

//////////////////////Clubs can only hire other artist and clubs cannot hire another club///////////////////

$sql_user_a = mysqli_query($connection, "SELECT user_type from users where id='$sessionInit_id'");
while($row=mysqli_fetch_array($sql_user_a)){
	$logged_user_type = $row['user_type'];
}

////////////////Hire Acccept and Deny //////////////////////////////////////////




      if(isset($_POST['hire_approval'])){



      	$approval_id = preg_replace('#[^0-9]#i', "", $_POST['hire_approval']);

      

      	$sql_approved_query = mysqli_query($connection, "UPDATE hire_request SET approved='1' WHERE hiring_id='$sessionInit_id' AND own_id='$approval_id' LIMIT 1");

      	header('location: /home');

    
      }

       if(isset($_POST['hire_deny'])){



      	$deny_id = preg_replace('#[^0-9]#i', "", $_POST['hire_deny']);

      

      	$sql_deny_query = mysqli_query($connection, "DELETE FROM hire_request WHERE hiring_id='$sessionInit_id' AND own_id='$deny_id' LIMIT 1");

    header('location: /home');
      }

      ////////////////////// Notification for phone Request /////////////////////////

      $sql_alert_p = mysqli_query($connection, "SELECT * from con_req where userb='$phone' LIMIT 1"); 
      $check_palert = mysqli_num_rows($sql_alert_p);   

      while($row=mysqli_fetch_array($sql_alert_p)){
        $ap_id = $row["id"];
        $c_u = $row["usera"]; 
        $con_date = $row["con_date"];

        $sql_cname = mysqli_query($connection, "SELECT * from users where phone='$c_u' LIMIT 1");

        while($row= mysqli_fetch_array($sql_cname)){

        $d_name= $row['username'];
        }
        
        if($check_palert>0){

        $p_alert.= '<div id="'.$ap_id.'""> '.$d_name.' wants to connect to you</div>

        <a id="'.$c_u.'" class="accept" onclick="return false">Accept</a> | 
        <a id="'.$c_u.'" class="deny" onclick="return false">Deny</a>';

      }else{
        $p_alert.= '';
      }
      }
      
//////////////////////// get current booking price ///////////////////////////////////////


   


		//////////////////////////paqyment gateway////////////////////////////////////////////
if(isset($_POST['payment_method'])){

$b_price2 = mysqli_real_escape_string($connection, $_POST['parse_var']);
$b_username = mysqli_real_escape_string($connection, $_POST['parse_var2']);


include('online_pay.php');

}













			////////////////Display Music//////////////////////////////////////////////////

			
				$musicDisplay="";
		///////  END Mechanism to Display Pic	
$sql_music = mysqli_query($connection, "SELECT * FROM music where own_id='$id' ORDER BY uploaded_date DESC");
$count_music = mysqli_num_rows($sql_music);




while($row = mysqli_fetch_array($sql_music)){
	
			$music_id = $row['id'];
			//$id_to_delete = "ks007".$row_id; 
			//$encrypted_login_id = base64_encode("g4p3h9xfn8sq03hs2234h$id_to_delete");
			$musicTitle = $row["file_title"];
			$music = $row["filename"];
			$coverurl = $row["filename2"];
			$musicDesc = $row["file_desc"];
			$owner_id = $row["own_id"];
			$musicPath = "../users/$owner_id/music/$music";
			$coverPath = "../users/$owner_id/music/$coverurl";
			

			//////////////////////////////////////  ///////////////////////////////////////////////
			$sql5 = mysqli_query($connection, "SELECT id, username FROM users where id = '$owner_id' LIMIT 1");
				while($row = mysqli_fetch_array($sql5)) 
					{
					$music_poster_id = $row['id'];
					//$blabbers_uname = $row['username'];
					
					}



			//check for username display
			
	
	
	/*$del_btn = "";
				if(isset($_SESSION['idx']))
					{
					if($id == $logOptions_id)
						{
						$del_btn = '<a href="#" class="delete_blab" id="'.$row_id.'" alt="remove">Delete</a>';
						}else
							{
							$del_btn = '';
							}}*/

if($count_music>0){
						
				$musicDisplay.= '<div class="item" id="'.$music_id.'">
							<div class="meida-holder kairosodeum-mod-thumb">
																	<div class="kairosodeum-single-gallery">
										
										   <ol class="fap-my-playlist">
																																	<li>
													<!--  TRACK -->
													<a data-music="  '.$musicPath.'" title="'.$musicTitle.'" target="'.$musiPath.'">
														<img style="width:150px; height:150px;" width="450" height="450" src="'.$coverPath.'" class="attachment-kairosodeum-thumb-medium size-kairosodeum-thumb-medium wp-post-image" alt="" srcset="'.$coverPath.' 450w, '.$coverPath.' 150w, '.$coverPath.' 250w" sizes="(max-width: 450px) 100vw, 450px" />														</a>

													<!-- DOWNLOAD -->
													<div class="kairosodeum-single-download">
														<i class="fa fa-music"></i>
													</div>
												</li>
																							
																								
									</ol>										
										
									</div>
															</div>

							<div class="kairosodeum-mod-detail  kairosodeum-mod-detail-dark ">
																	<h1>'.$musicTitle.'</a></h1>
																<h2>"'.$musicDesc.'"</h2>
																				
                        



                        </div>
                            
                            
						</div>
				
			';
	
}else{

	$musicDisplay.= '<div class="row"><h2>No songs are available</h2></div>';
}


}


////////////////Display Videos//////////////////////////////////////////////////

			
				$vidDisplay="";
		///////  END Mechanism to Display Pic	
$sql_vids = mysqli_query($connection, "SELECT * FROM videos where own_id='$id' ORDER BY uploaded_date DESC");
$count_vid = mysqli_num_rows($sql_vids);




while($row = mysqli_fetch_array($sql_vids)){
$vid_id = $row['id'];
			//$id_to_delete = "ks007".$row_id; 
			//$encrypted_login_id = base64_encode("g4p3h9xfn8sq03hs2234h$id_to_delete");
			$vidurl = $row['file_url'];
			$vidName = $row['title'];
			$vidCover = $row['cover'];
			$owner_id = $row["own_id"];
			$vidPath = "../users/$owner_id/videos/$vidCover";
			///////////////////
			$sql5 = mysqli_query($connection,"SELECT id, username FROM users where id = '$owner_id' LIMIT 1");
				while($row = mysqli_fetch_array($sql5)) 
					{
					$vid_poster_id = $row['id'];
					//$blabbers_uname = $row['username'];
					
					}



			//check for username display
			
	
	
	/*$del_btn = "";
				if(isset($_SESSION['idx']))
					{
					if($id == $logOptions_id)
						{
						$del_btn = '<a href="#" class="delete_blab" id="'.$row_id.'" alt="remove">Delete</a>';
						}else
							{
							$del_btn = '';
							}}*/

if($count_vid>0){
						
				$vidDisplay.= '

	<div class="col-md-6" id="n_div'.$vid_id.'">
													<div class="kairosodeum-single-gallery">
								<a class="kairosodeum-video-popup" href="#kairosodeum-video144">
									<img width="700" height="450" src="'.$vidPath.'" class="attachment-kairosodeum-thumb-formal size-kairosodeum-thumb-formal wp-post-image" alt="" />									<div class="kairosodeum-video-play"><i class="fa fa-play"></i></div>
								</a>
							</div>
												<div class="kairosodeum-mod-detail ">
															<h1></h1>
														<h2>
																	"'.$vidName.'"
															</h2>
						</div>

						<div id="kairosodeum-video144" class="mfp-hide">
							<div class="col-md-2"></div>
							<div class="col-md-8">
															<div class="embed-container">
															   <iframe id="ytplayer" type="text/html" width="200" height="113"
    src="https://www.youtube.com/embed/'. $vidurl . '?rel=0&showinfo=0&color=white&iv_load_policy=3"
    frameborder="0" allowfullscreen></iframe> 
    							</div>
														</div>
							<div class="col-md-2"></div>
						</div>
					</div>

						    							
					


				
				';
	
}else{

	$vidDisplay.= '<div class="row"><h2>No videos are available</h2></div>';
}


}



////////////////Display Photos//////////////////////////////////////////////////

	$photoDisplay="";
		///////  END Mechanism to Display Pic	
$sql_photos = mysqli_query($connection, "SELECT * FROM gallery where own_id='$id' ORDER 
								BY uploaded_date DESC");
$count_photo = mysqli_num_rows($sql_photos);




while($row = mysqli_fetch_array($sql_photos)){
$photo_id = $row['id'];
			//$id_to_delete = "ks007".$row_id; 
			//$encrypted_login_id = base64_encode("g4p3h9xfn8sq03hs2234h$id_to_delete");
			$photo_filename = $row['filename'];
			$photoTitle = $row['title'];
			$owner_id = $row["own_id"];
			$photoPath = "../users/$owner_id/photos/$photo_filename";
			///////////////////
			$sql5 = mysqli_query($connection,"SELECT id, username FROM users where id = '$owner_id' LIMIT 1");
				while($row = mysqli_fetch_array($sql5)) 
					{
					$photo_poster_id = $row['id'];
					
					
					}


					
			//check for username display
			
	
	
	/*$del_btn = "";
				if(isset($_SESSION['idx']))
					{
					if($id == $logOptions_id)
						{
						$del_btn = '<a href="#" class="delete_blab" id="'.$row_id.'" alt="remove">Delete</a>';
						}else
							{
							$del_btn = '';
							}}*/

if($count_photo>0){
						
				$photoDisplay.= '
				
				    <div class="col-xs-6 col-sm-3 thumb"  id="n_div'.$photo_id.'">
					<div class="kairosodeum-single-gallery">
					
            <a class="photoGallery" href="#" data-image-id="" data-toggle="modal" data-title="'.$photoTitle.'" data-caption="'.$photoTitle.'" data-image="'.$photoPath.'" data-target="#image-gallery">
                <img class="img-responsive" src="'.$photoPath.'" alt="'.$photoTitle.'">
            </a>
			
				<div class="kaiosodeum-gallery-hover"></div>
						  
						</div>
        </div>';
	
}else{

	$photoDisplay.= '<div class="row"><h2>No photos are available</h2></div>';
}





}


//-----encoded str for delete response-----------//
$thisRandNum2 = rand(999999999999,99999999999999999);
//----------END ENCODE STR FOR DELETE RESPONSE----------///


?>
<!DOCTYPE html>
<html lang="en-US" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<title>#<?php echo $username; ?> #KairosOdeum</title>

<link rel='stylesheet' id='bootstrap-css'  href='../assets/plugins/easy-bootstrap-shortcodes/styles/bootstrap.min.css?ver=4.7.5' type='text/css' media='all' />
<link rel='stylesheet' id='bootstrap-fa-icon-css'  href='../assets/plugins/easy-bootstrap-shortcodes/styles/font-awesome.min.css?ver=4.7.5' type='text/css' media='all' />
<link rel='stylesheet' id='contact-form-7-css'  href='assets/plugins/contact-form-7/includes/css/styles4906.css?ver=4.7' type='text/css' media='all' />
<link rel='stylesheet' id='kairosodeum-bootstrap-css-css'  href='../assets/themes/default/css/bootstrap.css?ver=4.7.5' type='text/css' media='all' />
<link rel='stylesheet' id='kairosodeum-theme-css-css'  href='../assets/themes/default/css/kairosodeum-main.css?ver=4.7.5' type='text/css' media='all' />
<link rel='stylesheet' id='kairosodeum-color-css-css'  href='../assets/themes/default/css/kairosodeum-style.css?ver=4.7.5' type='text/css' media='all' />
<link rel='stylesheet' id='kairosodeum-app-css'  href='../assets/themes/default/css/kairosodeum-app.css?ver=4.7.5' type='text/css' media='all' />
<link rel='stylesheet' id='kairosodeum-carousel-css-css'  href='../assets/themes/default/js/utilcarousel-files/utilcarousel/util.carousel.css?ver=4.7.5' type='text/css' media='all' />
<link rel='stylesheet' id='kairosodeum-skins-css-css'  href='../assets/themes/default/js/utilcarousel-files/utilcarousel/util.carousel.skins.css?ver=4.7.5' type='text/css' media='all' />
<link rel='stylesheet' id='kairosodeum-popup-css-css'  href='../assets/themes/default/js/utilcarousel-files/magnific-popup/magnific-popup.css?ver=4.7.5' type='text/css' media='all' />
<link rel='stylesheet' id='ebs_dynamic_css-css'  href='../assets/plugins/easy-bootstrap-shortcodes/styles/ebs_dynamic_css.css?ver=4.7.5' type='text/css' media='all' />
<script type='text/javascript' src='../assets/plugins/advanced-ajax-page-loader/jquery.js?ver=4.7.5'></script>
<script type='text/javascript' src='../assets/plugins/easy-bootstrap-shortcodes/js/bootstrap.min.js?ver=4.7.5'></script>
<script type='text/javascript' src='../assets/themes/default/js/kairosodeum-js.js'></script>

	<script type="text/javascript">
		checkjQuery = false;
		jQueryScriptOutputted = false;
		
		//Content ID
		var AAPL_content = 'content';
		
		//Search Class
		var AAPL_search_class = 'searchform';
		
		//Ignore List - this is for travisavery who likes my comments... hello
		var AAPL_ignore_string = new String('#, /wp-, .pdf, .zip, .rar'); 
		var AAPL_ignore = AAPL_ignore_string.split(', ');
		
		//Shall we take care of analytics?
		var AAPL_track_analytics = false		
		//Various options and settings
		var AAPL_scroll_top = true		
		//Maybe the script is being a tw**? With this you can find out why...
		var AAPL_warnings = false;
		
		//This is probably not even needed anymore, but lets keep for a fallback
		function initJQuery() {
			if (checkjQuery == true) {
				//if the jQuery object isn't available
				if (typeof(jQuery) == 'undefined') {
				
					if (! jQueryScriptOutputted) {
						//only output the script once..
						jQueryScriptOutputted = true;
						
						//output the jquery script
						//one day I will complain :/ double quotes inside singles.
						document.write('<scr' + 'ipt type="text/javascript" src="../assets/plugins/advanced-ajax-page-loader/jquery.js"></scr' + 'ipt>');
					}
					setTimeout('initJQuery()', 50);
				}
			}
		}

		initJQuery();

	</script>

	<script type="text/javascript" src="../assets/plugins/advanced-ajax-page-loader/ajax-page-loader.js"></script>
	<script type="text/javascript" src="../assets/plugins/advanced-ajax-page-loader/reload_code.js"></script>
	
	<script type="text/javascript">
		//urls
		var AAPLsiteurl = "localhost";
		var AAPLhome = "localhost";
		
		var AAPLloadingIMG = jQuery('<img/>').attr('src', '');
		var AAPLloadingDIV = jQuery('<div/>').attr('style', 'display:none;').attr('id', 'ajaxLoadDivElement');
		AAPLloadingDIV.appendTo('body');
		AAPLloadingIMG.appendTo('#ajaxLoadDivElement');
		

		var str = "\t<div class=\"snd-loading\">\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"snd-loading-image\">\n\t\t\t\t\t\t\t\t\t\t\t\t\t\n\t\t\t\t\t\t\t\t\t\t\t\t<\/div>\n\t\t\t\t\t\t\t\t\t\t\t<\/div>";
		var AAPL_loading_code = str.replace('{loader}', AAPLloadingIMG.attr('src'));
		str = "\t<div class=\"snd-loading\">\n\t\t\t\t\t\t\t\t\t\t\t<div class=\"snd-loading-image\">\n\t\t\t\t\t\t\t\t\t\t\t\t<H1>There was a problem and the page didnt load.<\/H1>\n\t\t\t\t\t\t\t\t\t\t\t<\/div>\n\t\t\t\t\t\t\t\t\t\t<\/div>";
		var AAPL_loading_error_code = str.replace('', AAPLloadingIMG.attr('src'));
	</script>
		<script>
$(document).ready(function() {

$("#search_q").keyup(function() 
{
var search_q= $(this).val();
var dataString = 'searchword='+ search_q;

if(search_q=='')
{
document.getElementById('display_result').style.display = 'none';
}
else
{

$.ajax({
type: "POST",
url: "../search/index.php",
data: dataString,
cache: false,
success: function(html)
{

$("#display_result").html(html).show();
  
  }


});


}return false;    


});

//////IF LOGIN USER ACCPT A FRND//////
$(".accept").click(function(){
  var pid = $(this).attr("id");
 
  var url = "con_parse.php";
  $("#loader"+pid).html("<img src='images/loading30.gif' />").fadeIn().delay(7000).fadeOut();
  //$("#loader").fadeIn().delay(10000).fadeOut();
  $.post(url, {request: "acceptCon", reqID: pid}, function(data){
    //$("#loader").html(data).show();
    window.location.href = data;
  });//close function(data) success
});//close $.accept

////////////////IF A USER DENY FRIEND REQUESTS////
$(".deny").click(function(){
  var pid = $(this).attr("id");
  alert(pid);
  var url = "con_parse.php";
  $("#loader"+pid).html("<img src='images/loading30.gif' />").fadeIn().delay(7000).fadeOut();
  //$("#loader").fadeIn().delay(10000).fadeOut();
  $.post(url, {request: "denyCon", reqID: pid}, function(data){
    $("#loader"+pid).html(data).parent().parent().fadeOut();
    //$("#loader").html(data).show();
    //window.location.href = data;
  });//close function(data) success
});//close $.deny
});

      
      

</script>
		</head>

<body class="home page-template page-template-page-templates page-template-page-builder page-template-page-templatespage-builder-php page page-id-457">

	
	<!-- BODY -->
	<div class="kairosodeum-body"></div>

	<!-- MUSIC PLAYER -->
	<div id="fap">
							<!--	<a data-music="  http://djboyradio.streamguys1.com/sub-pop-records.mp3 " title="Radio Pop Live" target=""></a>
						<a data-music="  http://0.s3.envato.com/files/151969330/preview.mp3 " title="Forever Dance" target=""></a>
						<a data-music="  http://0.s3.envato.com/files/151505358/preview.mp3 " title="Stoner Party" target=""></a>-->
						</div>

	<!-- SEARH BAR -->
	<div class="kairosodeum-top-search">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="kairosodeum-top-search-form">
						<form role="search" method="get" id="searchform" class="kairosodeum-search searchform"  action="">
							<input type="text" value="" name="s" id="s" placeholder="Type and Press Enter to Search .." onfocus="this.placeholder = ''" onblur="this.placeholder = 'Type and Press Enter to Search ..'" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	
	<!-- SOUND THEME / TOP NAVIGATION -->
	<div class="container-fluid kairosodeum-nav-fixed kairosodeum-nav-fixed-mobil">
		
		<!-- SOUND THEME / LOGO AREA -->
				<div class="col-xs-12 col-sm-12 col-md-12">

							<div class="kairosodeum-menu-icon">
<?php if (isset($_SESSION['idx'])) { 

								echo "<button class=\"kairosodeum-btn-\">
								<a href=\"/home/\" >
						<i class=\"fa fa-plus\"></i> <span>Dashboard</span>
					</a>&nbsp; &nbsp;
						<a href=\"/account/\" >
						<i class=\"fa fa-plus\"></i> <span>Account</span>
					</a>
					</button>";
}else{
								?>
					<button class="kairosodeum-btn-sidebar">
						<i class="fa fa-plus"></i> <span>Login/Signup</span>
					</button>

					<? } ?>
				</div>
			
			<div class="kairosodeum-logo hidden-sm hidden-xs">
				<a href="index.php">
											<img src="../assets/themes/default/images/logo.png" alt="Logo">
									</a>
			</div>
			<div class="kairosodeum-logo hidden-md hidden-lg">
				<a href="index.php">
											<img src="../assets/themes/default/images/logo.png" alt="Logo">
									</a>
			</div>

			<div class="kairosodeum-search-icon">
				<!--<button class="kairosodeum-btn-search">
					 <i class="fa fa-search"></i>  
				</button>-->
			</div>
			<div class="clearfix"></div>

		</div>
		<div class="clearfix"></div>
	</div>
	<div class="clearfix"></div>

<!-- SOUND THEME / AJAX CONTENT START -->
<div id="content" class="site-content">
	<!-- SOUND THEME / MODULE SLIDER -->
	<!-- Module Slider -->
	

	<div class="profile-content">
    <div class="card hovercard">
        
        <div class="useravatar">
                <?php echo $user_pic;?>
        </div>
        <div class="card-info"> <span class="card-title"><?php echo $username; ?></span><br />
           <span class="card-title-city"><?php echo $city;?></span>



        </div>


<?php if($sessionInit_id ==$id) {?>

         <a data-toggle="modal" data-target="#uploadMusic"><button class="btn btn-primary"><i class="fa fa-music"></i></button></a>

		<a data-toggle="modal" data-target="#uploadPhoto"><button class="btn btn-primary"><i class="fa fa-photo"></i></button></a>
<a data-toggle="modal" data-target="#uploadVideo"><button class="btn btn-primary"><i class="fa fa-file-video-o"></i> </button></a>

<?php } ?>
<!--<a data-toggle="modal" data-target="#uploadPhoto"><button class="btn btn-primary"><i class="fa fa-user"></i> </button></a>-->


<?php

if($logged_user_type!=$user_type){


 if($sessionInit_id !=$id) {?>

<?php if($hire_check_flag>0 && $approval==0 ) { ?>

<a><button class="btn btn-primary">Hired! Awaiting Confirmation </button></a>

<?php }else if($hire_check_flag>0 && $approval==1){ ?>


<a data-toggle="modal" data-target="#payment_window"><button class="btn btn-primary">Pay for Gig </button></a>

<?php }else{ ?>



<a data-toggle="modal" data-target="#hire_window"><button class="btn btn-primary">Hire </button></a>



<?php }}} ?>



<?php




 if($sessionInit_id !=$id) {?>

<?php if($follow_check_flag>0) { ?>
<form action="index.php" method="post" enctype="multipart\form-data">
<a>
<input type="hidden" name="user_value" value="<?php echo $id; ?>">
<button type="submit" name="unfollow" id="unfollow" class="btn btn-primary">Unfollow </button></a>
</form>

<?php }else{ ?>


<form action="index.php" method="post" enctype="multipart\form-data">
<a>
<input type="hidden" name="user_value" value="<?php echo $id; ?>">
<button type="submit" name="follow" id="follow" class="btn btn-primary">Follow </button></a>
</form>


<?php }} ?>



  <?php if($sessionInit_id ==$id) {?>

<a data-toggle="modal" data-target="#invite_window"><button class="btn btn-primary">Invite </button></a>
<?php } ?>
<a href="../logout/"><button class="btn btn-primary">Logout </button></a>

<div class="container" style="margin-top: 80px;">
	<div class="row">
           <div id="custom-search-input">
                            <div class="input-group col-md-12">
                                <input id="search_q" type="text" class="  search-query form-control" placeholder="Search for the artists and clubs by their name and city. " />
                                <span class="input-group-btn">
                                    <!--<button class="btn btn-danger" type="button">
                                        <span class=" glyphicon glyphicon-search"></span>
                                    </button>-->
                                </span>
                            </div>
                            <div id="display_result"></div>
            </div>

	</div>
</div>


<?php echo $hire_area; ?>


    </div>




      <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <a href="#about">
            <button type="button" id="about" class="btn btn-primary" ><i class="fa fa-user"></i>
                <div class="hidden-xs">About</div>
            </button>
            </a>
        </div>
        <div class="btn-group" role="group">
           <a href="#music">
            <button type="button" id="music" class="btn btn-primary" href="#music" ><i class="fa fa-music"></i>
                <div class="hidden-xs">Music</div>
            </button>
            </a>
        </div>
        <div class="btn-group" role="group">
           <a href="#gallery">
            <button type="button" id="gallery" class="btn btn-primary" href="#gallery" ><i class="fa fa-photo"></i>
                <div class="hidden-xs">Gallery</div>

            </button>
            </a>
        </div>
          <div class="btn-group" role="group">
             <a href="#videos">
            <button type="button" id="videos" class="btn btn-primary" href="#videos" ><i class="fa fa-video-camera"></i>
                <div class="hidden-xs">Videos</div>
            </button>
            </a>
        </div>
    </div>

      
    </div>

    <!-- Modal Music -->
<div id="uploadMusic" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Track</h4>
      </div>
      <div class="modal-body">
      <?php echo $ErrorFlag; ?>
        <form class="form-horizontal" action="add_audio/index.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label class="control-label col-sm-2" for="audio_name">Title:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="audio_name" name="audio_name" placeholder="Track Title">
    </div>
  </div>
  <div class="form-group">
  
   <label class="control-label col-sm-2" for="audio_desc">Description:</label>
  <div class="col-sm-10"> 
  <textarea class="form-control" rows="5" id="audio_desc" name="audio_desc" placeholder="Description of Track"></textarea>
  </div>
</div>



    <div class="form-group">
    <label class="control-label col-sm-2" for="genre">Genre:</label>
    <div class="col-sm-10"> 
      <input type="text" class="form-control" id="genre" name="genre" placeholder="Genre (Rock, Country, Pop, Blues, etc...)">
    </div>
  </div>
  

    <div class="form-group">
    <label class="control-label col-sm-2" for="cover">Track Art:</label>
    <div class="col-sm-10"> 
      <input type="file" class="form-control" id="cover" name="cover" />
    </div>
  </div>

 <div class="form-group">
    <label class="control-label col-sm-2" for="cover">Upload Mp3:</label>
    <div class="col-sm-10"> 
      <input type="file" class="form-control" id="musicFile" name="musicFile" />
    </div>
  </div>


      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default" >Save</button>
      </div>
    </div>

    </form>

  </div>
</div>

<!--modal music end-->

<!-- Modal Photo -->
<div id="uploadPhoto" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Photo</h4>
      </div>
      <div class="modal-body">
      <?php echo $ErrorFlag; ?>
        <form class="form-horizontal" action="add_photos/index.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label class="control-label col-sm-2" for="photo_name">Title:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="photo_name" name="photo_name" placeholder="Photo Title">
    </div>
  </div>



 <div class="form-group">
    <label class="control-label col-sm-2" for="photoFile">Upload Photo:</label>
    <div class="col-sm-10"> 
      <input type="file" class="form-control" id="photoFile" name="photoFile" />
    </div>
  </div>


      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default" >Save</button>
      </div>
    </div>

    </form>

  </div>
</div>

<!--modal photo end-->



<!-- Modal Photo -->
<div id="uploadVideo" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Video</h4>
      </div>
      <div class="modal-body">
      <?php echo $ErrorFlag; ?>
         <form class="form-horizontal" action="add_videos/index.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label class="control-label col-sm-2" for="videoTitle">Title:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="videoTitle" name="videoTitle" placeholder="VideoTitle">
    </div>
  </div>
  <div class="form-group">
  
   <label class="control-label col-sm-2" for="video_url">Video URL:</label>
  <div class="col-sm-10"> 
  <input type="text" class="form-control" id="video_url" name="video_url" placeholder="Youtube URL Of Video" />
  </div>
</div>



  

    <div class="form-group">
    <label class="control-label col-sm-2" for="cover">Video Art:</label>
    <div class="col-sm-10"> 
      <input type="file" class="form-control" id="vidCover" name="vidCover" />
    </div>
  </div>




      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default" >Save</button>
      </div>
    </div>

    </form>

  </div>
</div>

<!--modal Video end-->

<?php if($sessionInit_id !=$id) {?>
<!-- Modal Hiring -->
<div id="hire_window" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Hire #<?php echo $username; ?></h4>
        <?php echo  $error_p ;?>
      </div>
      <div class="modal-body">
      <?php echo $ErrorFlag; ?>
         <form class="form-horizontal" action="index.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label class="control-label col-sm-2" for="bookDate">Booking Date:</label>
    <div class="col-sm-10">
      <input type="date" class="form-control" id="bookDate" name="bookDate" required="true" />
    </div>
  </div>
  <div class="form-group">
  
   <label class="control-label col-sm-2" for="bookTime">Booking Time:</label>
  <div class="col-sm-10"> 
  <input type="time" class="form-control" id="bookTime" name="bookTime" required="true" />
  </div>
</div>


<div class="form-group">
    <label class="control-label col-sm-2" for="quotePrice">Quote Price:</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="quotePrice" name="quotePrice" required="true" />
    </div>
  </div>


      <input type="hidden" class="form-control" id="hd" name="hd" value="<?php echo $id; ?>" />

      <input type="hidden" class="form-control" id="od" name="od" value="<?php echo $sessionInit_id; ?>" />
 




      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default" >Send Hire Request</button>
      </div>
    </div>

    </form>

  </div>
</div>

<!--modal Hire end-->

<?php } ?>





<!-- Modal Invite -->
<div id="invite_window" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Invite your friends</h4>
        <?php echo  $error_p ;?>
        <?php echo $Successmsg; ?>
      </div>
      <div class="modal-body">
      <?php echo $ErrorFlag; ?>
         <form class="form-horizontal" action="index.php" method="post" enctype="multipart/form-data">
 

 <input type="text" class="form-control" id="invite_q" name="invite_q" placeholder="Enter email addresses seperated by comma operator ( ,)" required="true" />

	



      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default" >Send invites</button>
      </div>
    </div>

    </form>

  </div>
</div>

<!--modal Invite end-->



<?php if($sessionInit_id !=$id) {?>
<!-- Modal Hiring -->

<div id="payment_window" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Pay #<?php echo $username; ?></h4>
        <?php echo  $error_p ;?>
      </div>
      <div class="modal-body">
      <?php echo $ErrorFlag; ?>
         <form class="form-horizontal" action="index.php" method="post" enctype="multipart/form-data">
 



              <label for="payment"><span class="glyphicon glyphicon-user"></span> Payment Method:</label>
             
  <select class="form-control" id="payment_method" name="payment_method">
    <option value="pg">Instamojo Payment Gateway (Online)</option>
    
  </select>

  <input type="hidden" class="form-control" id="parse_var" name="parse_var" value="<?php echo $book_price; ?>">
      <input type="hidden" class="form-control" id="hd" name="hd" value="<?php echo $id; ?>" />
      <input type="hidden" class="form-control" id="parse_var" name="parse_var2" value="<?php echo $username; ?>">
      <input type="hidden" class="form-control" id="od" name="od" value="<?php echo $sessionInit_id; ?>" />
 







      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default" >Send Hire Request</button>
      </div>
    </div>

    </form>

  </div>
</div>
<!--modal Hire end-->

<?php } ?>
           

	<!-- SOUND THEME / BUILDER START -->

<!-- SOUND THEME / FEATURED SLIDER -->

		
			<style type="text/css">
				.kairosodeum-gradient-wall {
				background: url(<?php echo $user_bg; ?>) no-repeat center center;
				background-color:#24252A;
				  -webkit-background-size: cover;
				  -moz-background-size: cover;
				  -o-background-size: cover;
				  background-size: cover; 
				  filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="<?php echo $user_bg; ?>", sizingMethod='scale');
				  -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $user_bg; ?>', sizingMethod='scale')";
				}
			</style>
					
<div id="about" class="container-fluid kairosodeum-mod-gradient kairosodeum-container kairosodeum-gradient-wall ">


<div class="container ">
	<div class="row">
			<div class="col-md-12">
					<div class="kairosodeum-mod-title kairosodeum-mod-title-dark">
						<h1>#ABOUT</h1>
						<h2>@<?php echo $username;?></h2>
						<h2><?php echo $bio_body; ?></h2>
						<h1 style="margin-top:8%;">#Experience</h1>
						<h2>@<?php echo $username;?></h2>
						<h2><?php echo $experience; ?></h2>
					</div>
			</div>

		</div>
	</div>
</div>


			
	
<!-- SOUND THEME / FEATURED SLIDER -->
			<style type="text/css">
		.kairosodeum-mod-galleries {
		background: url(assets/themes/default/images/gradient_2.jpg) no-repeat center center;
				background-color:#24252A;
				  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  -o-background-size: cover;
		  background-size: cover; 
		  filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='assets/uploads/2017/10/Music-Header.png', sizingMethod='scale');
		  -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='assets/uploads/2017/10/Music-Header.png', sizingMethod='scale')";
		}
	</style>

<div class="container-fluid kairosodeum-mod-galleries kairosodeum-container kairosodeum-mod-dark ">
	<div class="container">
		<div class="row">
							<div class="col-md-12">
					<div class="kairosodeum-mod-title  kairosodeum-mod-title-dark ">
						<h1>#Music </h1>
													<h2>@<?php echo $username; ?></h2>
											</div>
				</div>
			
			<div class="clearfix"></div>

							<div id="kairosodeum-module-gallery" class="util-carousel team-showcase kairosodeum-mod-featcon">
								    	                             
                                                                     
                                                                     
                                                  <?php echo $musicDisplay; ?>
                        
								    														
                                                              
				</div>
					</div>
	</div>
</div>

					
		
		<!-- SOUND THEME / FEATURED SLIDER -->
				<style type="text/css">
		.kairosodeum-mod-events {
		background: url(../assets/uploads/2017/10/Event-Light.png) no-repeat center center;
				background-color:#F4F6F7;
				  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  -o-background-size: cover;
		  background-size: cover; 
		  filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../assets/uploads/2017/10/Event-Light.png', sizingMethod='scale');
		  -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../assets/uploads/2017/10/Event-Light.png', sizingMethod='scale')";
		}
	</style>



	
						<style type="text/css">
		.kairosodeum-mod-newsblog {
		/*background: url(assets/themes/default/images/trending.jpg) no-repeat center center;*/
				background-color:#F4F6F7;
				  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  -o-background-size: cover;
		  background-size: cover; 
		  filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../assets/themes/default/images/trending.jpg', sizingMethod='scale');
		  -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../assets/themes/default/images/trending.jpg', sizingMethod='scale')";
		}
	</style>



	

<div class="container-fluid kairosodeum-mod-newsblog kairosodeum-container kairosodeum-mod-grey ">
	<div class="container">
					<div class="col-md-12">
						<div class="kairosodeum-mod-title">
								<h1>#Videos</h1>
								<h2>@<?php echo $username; ?></h2>
						</div>
					</div>
		
		<div class="clearfix"></div>

		<div class="row kairosodeum-mod-videolist" style="margin-top:60px;">									    							
				<?php echo $vidDisplay; ?>
			<div class="clearfix"></div>
		</div>

				<div class="row">
				<div class="col-md-4 kairosodeum-mod-playreposive"></div>
			
				<div class="col-md-4"></div>
				<div class="clearfix"></div>
			</div>
			

</div>
</div>




		<!-- SOUND THEME / VIDEO -->



		<!-- SOUND THEME / BIG NEWS -->
			 
				
				<!-- Photo gallery -->
						<style type="text/css">
		.kairosodeum-mod-photoGallery {
		/*background: url(assets/themes/default/images/trending.jpg) no-repeat center center;*/
				background-color:#FFFFFF;
				  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  -o-background-size: cover;
		  background-size: cover; 
		  filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../assets/themes/default/images/trending.jpg', sizingMethod='scale');
		  -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../assets/themes/default/images/trending.jpg', sizingMethod='scale')";
		}
	</style>

		<!-- Footer -->
			 
				
					<style type="text/css">
				.kairosodeum-footer-wall {
				background: url(assets/themes/default/images/found.jpg) no-repeat center center;
				background-color:#24252A;
				  -webkit-background-size: cover;
				  -moz-background-size: cover;
				  -o-background-size: cover;
				  background-size: cover; 
				  filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="assets/themes/default/images/found.jpg", sizingMethod='scale');
				  -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='assets/themes/default/images/found.jpg', sizingMethod='scale')";
				}
			</style>
		
		<!-- Footer -->
		<div id="gallery" class="container-fluid kairosodeum-darkback-one kairosodeum-footer-wall">
			<div class="container">
				<div class="row">
					<div class="col-md-12">

						<div class="kairosodeum-related-title">
															<h1>#Gallery</h1>
							
															<h6>@<?php echo $username; ?></h6>
													</div>

													<div class="kairosodeum-contact-form">
								<div class="row">
									


<div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
         
              
                
           
            <div class="modal-body">
                <img style="width:600px; height:400px;" id="image-gallery-image" class="img-responsive" src="">
            </div>
            <div class="modal-footer">

                <div class="col-md-2">
                    <button type="button" class="btn btn-primary" id="show-previous-image">Previous</button>
                </div>

                <div class="col-md-8 text-center" id="image-gallery-caption">
                    No photos
                </div>

                <div class="col-md-2">
                    <button type="button" id="show-next-image" class="btn btn-primary">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>

						    				    
						    			<?php echo $photoDisplay;?>




									<div class="clearfix"></div>
								</div>
							</div>
											</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	
						<!-- icons -->
			<div class="container-fluid kairosodeum-darkback-two">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="kairosodeum-logo-footer">
								<ul>
																			<li>
											<a href="https://www.youtube.com/channel/UC9wsWr46RbTAEdleFzjSKXg"><i class="fa fa-youtube"></i></a>
										</li>
																			<li>
											<a href="https://www.instagram.com/kairosodeum/"><i class="fa fa-instagram"></i></a>
										</li>
																			<li>
											<a href="https://www.twitter.com/kairosodeum/"><i class="fa fa-twitter"></i></a>
										</li>
																			<li>
											<a href="https://www.facebook.com/kairosodeum/"><i class="fa fa-facebook"></i></a>
										</li>
																	</ul>


								<div class="clearfix"></div>



<div class="container">
      <div class="row">
        <div class="copyright">
   
         &copy; 2017 Kairos Odeum. 

         
        </div>
       
      </div>
    </div>


							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			
	
</div>
<!-- scripts -->
<script type="text/javascript">
       
    $(document).ready(function(){                    
       $('.kairosodeum-nav-fixed').css('display','block');

       });
    
</script>

<script type="text/javascript">
	$(document).ready(function(){

    loadGallery(true, 'a.photoGallery');

    //This function disables buttons when needed
    function disableButtons(counter_max, counter_current){
        $('#show-previous-image, #show-next-image').show();
        if(counter_max == counter_current){
            $('#show-next-image').hide();
        } else if (counter_current == 1){
            $('#show-previous-image').hide();
        }
    }

    /**
     *
     * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
     * @param setClickAttr  Sets the attribute for the click handler.
     */

    function loadGallery(setIDs, setClickAttr){
        var current_image,
            selector,
            counter = 0;

        $('#show-next-image, #show-previous-image').click(function(){
            if($(this).attr('id') == 'show-previous-image'){
                current_image--;
            } else {
                current_image++;
            }

            selector = $('[data-image-id="' + current_image + '"]');
            updateGallery(selector);
        });

        function updateGallery(selector) {
            var $sel = selector;
            current_image = $sel.data('image-id');
            $('#image-gallery-caption').text($sel.data('caption'));
            $('#image-gallery-title').text($sel.data('title'));
            $('#image-gallery-image').attr('src', $sel.data('image'));
            disableButtons(counter, $sel.data('image-id'));
        }

        if(setIDs == true){
            $('[data-image-id]').each(function(){
                counter++;
                $(this).attr('data-image-id',counter);
            });
        }
        $(setClickAttr).on('click',function(){
            updateGallery($(this));
        });
    }
});

</script>




<!-- footer-->

	<!-- MUSIC PLAYER OPTIONS -->
	<script src="../assets/themes/default/js/soundmanager2-nodebug-jsmin.js"></script>

	
	<script src="connect.soundcloud.com/sdk.js"></script>
	<script src="../assets/themes/default/js/jquery.fullwidthAudioPlayer.js"></script>
	<script type="text/javascript">
		soundManager.url = 'assets/themes/default/swf/index.html';
		soundManager.flashVersion = 9;
		soundManager.useHTML5Audio = true;
		soundManager.debugMode = true;
		$(document).ready(function(){
			$('#fap').fullwidthAudioPlayer({
									autoPlay: true,
								autoLoad: false, 
				sortable: true,
				popup: false,
				wrapperPosition: 'top',
				wrapperColor: '#2A2B30',
				mainColor: '#45B39D',
				metaColor: '#F0F3F4',
				strokeColor: '#2A2B30',
				activeTrackColor: '#24252A',
									twitterText: 'Share on Twitter',
				
									facebookText: 'Share on Facebook',
								height: 75,
				loopPlaylist: true,
				playlistHeight: 250,
				offset: 30,
									playlist: true,
								keyboard: false,
				socials: true,
				shuffle: false,
				openPlayerOnTrackPlay: true,
				layout: 'fullwidth',
				openLabel: '<i class="fa fa-volume-up"></i>',
				closeLabel: '<i class="fa fa-power-off"></i>'
			});

							$('#fap-wrapper').addClass('fap-wrapper-open');

				$('#fap-closer .fa-power-off').click(function() {
					$('#fap-wrapper').addClass('fap-wrapper-close');
					$("#fap-closer .fa-power-off").css({ opacity: '0', display:'none'  });
					$("#fap-closer .fa-music").css({ opacity: '0.95', display:'block'  });
				});

				$('#fap-closer .fa-music').click(function() {
					$('#fap-wrapper').removeClass('fap-wrapper-close');
					$("#fap-closer .fa-power-off").css({ opacity: '0.95', display:'block'  });
					$("#fap-closer .fa-music").css({ opacity: '0', display:'none'  });
				});
			
			$('.kairosodeum-btn-sidebar').click(function() {
				$("#fap-wrapper").animate({ opacity: '0' }, 100, 'easeInOutExpo');
			});

			$('#content, .kairosodeum-sidebar-closed, .kairosodeum-body').click(function() {
				$("#fap-wrapper").animate({ opacity: '1' }, 10, 'easeInOutExpo');
			});


		});
	</script>
	
			<script type="text/javascript">
			function AAPL_reload_code() {
			jQuery.getScript("../assets/themes/default/js/utilcarousel-files/utilcarousel/jquery.utilcarousel.min.js", function(data, textStatus, jqxhr){ });
			jQuery.getScript("../assets/themes/default/js/utilcarousel-files/magnific-popup/jquery.magnific-popup.js", function(data, textStatus, jqxhr){ }); 
			jQuery.getScript("../assets/themes/default/js/jquery.mixitup.js", function(data, textStatus, jqxhr){ }); 
			jQuery.getScript("../assets/themes/default/js/kairosodeum-load-up.js", function(data, textStatus, jqxhr){ });  
			jQuery.getScript("../assets/themes/default/js/kairosodeum-load-down.js", function(data, textStatus, jqxhr){ });
					}
		</script>
<script type='text/javascript' src='../assets/plugins/contact-form-7/includes/js/jquery.form.mind03d.js?ver=3.51.0-2014.06.20'></script>
<script type='text/javascript' src='../assets/plugins/contact-form-7/includes/js/scripts4906.js?ver=4.7'></script>
<script type='text/javascript' src='../assets/themes/default/js/kairosodeum-ui.js'></script>
<script type='text/javascript' src='../assets/themes/default/js/bootstrap.js'></script>
<script type='text/javascript' src='../assets/themes/default/js/utilcarousel-files/utilcarousel/jquery.utilcarousel.min.js'></script>
<script type='text/javascript' src='../assets/themes/default/js/utilcarousel-files/magnific-popup/jquery.magnific-popup.js'></script>
<script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false'></script>
<script type='text/javascript' src='../assets/themes/default/js/kairosodeum-fixed.js'></script>
<script type='text/javascript' src='../assets/themes/default/js/kairosodeum-fixed-down.js'></script>
<script type='text/javascript' src='../assets/themes/default/js/jquery.mixitup.js'></script>
<script type='text/javascript' src='../assets/themes/default/js/kairosodeum-load-up.js'></script>
<script type='text/javascript' src='../assets/themes/default/js/kairosodeum-load-down.js'></script>
<script type='text/javascript' src='../wp-includes/js/wp-embed.min.js?ver=4.7.5'></script>
</body>
</html>
