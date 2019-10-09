<?php
error_reporting(E_ALL);
ini_set("display_errors", 0);
include_once ("../scripts/user_session.php");
include_once '../scripts/DB_connect.php';
if (!isset($_SESSION['idx'])) {
    header('Location: ../index.php');
}
$id = $sessionInit_id; // Set the profile owner ID
$error_msg = "";
$errorMsg = "";
$success_msg = "";
$experiences = "";
$user_type = "";
$cacheBuster = rand(9999999, 99999999999); // Put appended to the image URL will help always show new when changed
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
if (file_exists($check_bg)) {
    $user_bg = "../users/$id/bg.jpg";
} else {
    $user_bg = "../users/0/bg.jpg";
}
$sql_default = mysqli_query($connection, "SELECT * FROM users WHERE id='$id'");
while ($row = mysqli_fetch_array($sql_default)) {
    $username = $row['username'];
    $email = $row['email'];
    $phone = $row['phone'];
    $country = $row['country'];
    $state = $row['state'];
    $city = $row['city'];
    $address = $row['address'];
    $pincode = $row['pincode'];
    $birthday = $row['birthday'];
    $user_type = $row['user_type'];
    $about = $row['bio_body'];
    $about = str_replace("<br />", "", $about);
    $about = stripslashes($about);
    $experiences = $row['experiences_body'];
    $experiences = str_replace("<br />", "", $experiences);
    $experiences = stripslashes($experiences);
} // close while loop
// If a file is posted with the form
if ($_FILES['update_pic']['tmp_name'] != "") {
    if (!preg_match("/\.(gif|jpg|png)$/i", $_FILES['update_pic']['name'])) {
        $error_msg = 'Unaccepted format';
        unlink($_FILES['update_pic']['tmp_name']);
    } else {
        $newname = "pic.jpg";
        $place_file = move_uploaded_file($_FILES['update_pic']['tmp_name'], "../users/$id/" . $newname);
    }
}
if (isset($_POST['username'])) {
    $username_c = mysqli_real_escape_string($connection, $_POST['username']);
    // Update the database data now here for all fields posted in the form
    $sqlUpdate = mysqli_query($connection, "UPDATE users SET username='$username_c' WHERE id='$id' LIMIT 1");
    if ($sqlUpdate) {
        header('Location: ../account/');
        $success_msg = '<div class="alert alert-success fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    Success!</strong> Your username has been changed to ' . $username_c . '
</div>';
    } else {
        $error_msg = 'Please try again later.';
    }
}
if (isset($_POST['email'])) {
    $email_c = mysqli_real_escape_string($connection, $_POST['email']);
    // Update the database data now here for all fields posted in the form
    $sqlUpdate = mysqli_query($connection, "UPDATE users SET email='$email_c' WHERE id='$id' LIMIT 1");
    if ($sqlUpdate) {
        header('Location: ../account/');
        $success_msg = '<div class="alert alert-success fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    Success!</strong> Your email has been changed to ' . $email_c . '
</div>';
    } else {
        $error_msg = 'Please try again later.';
    }
}
if (isset($_POST['phone'])) {
    $phone_c = mysqli_real_escape_string($connection, $_POST['phone']);
    // Update the database data now here for all fields posted in the form
    $sqlUpdate = mysqli_query($connection, "UPDATE users SET phone='$phone_c' WHERE id='$id' LIMIT 1");
    if ($sqlUpdate) {
        header('Location: ../account/');
        $success_msg = '<div class="alert alert-success fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    Success!</strong> Your phone number has been changed to ' . $phone_c . '
</div>';
    } else {
        $error_msg = 'Please try again later.';
    }
}
if (isset($_POST['country'])) {
    $country_c = mysqli_real_escape_string($connection, $_POST['country']);
    // Update the database data now here for all fields posted in the form
    $sqlUpdate = mysqli_query($connection, "UPDATE users SET country='$country_c' WHERE id='$id' LIMIT 1");
    if ($sqlUpdate) {
        header('Location: ../account/');
        $success_msg = '<div class="alert alert-success fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    Success!</strong> Your country has been changed to ' . $country_c . '
</div>';
    } else {
        $error_msg = 'Please try again later.';
    }
}
if (isset($_POST['state'])) {
    $state_c = mysqli_real_escape_string($connection, $_POST['state']);
    // Update the database data now here for all fields posted in the form
    $sqlUpdate = mysqli_query($connection, "UPDATE users SET state='$state_c' WHERE id='$id' LIMIT 1");
    if ($sqlUpdate) {
        header('Location: ../account/');
        $success_msg = '<div class="alert alert-success fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    Success!</strong> Your state has been changed to ' . $state_c . '
</div>';
    } else {
        $error_msg = 'Please try again later.';
    }
}
if (isset($_POST['city'])) {
    $city_c = mysqli_real_escape_string($connection, $_POST['city']);
    // Update the database data now here for all fields posted in the form
    $sqlUpdate = mysqli_query($connection, "UPDATE users SET city='$city_c' WHERE id='$id' LIMIT 1");
    if ($sqlUpdate) {
        header('Location: ../account/');
        $success_msg = '<div class="alert alert-success fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    Success!</strong> Your city has been changed to ' . $city_c . '
</div>';
    } else {
        $error_msg = 'Please try again later.';
    }
}
if (isset($_POST['address'])) {
    $address_c = mysqli_real_escape_string($connection, $_POST['address']);
    // Update the database data now here for all fields posted in the form
    $sqlUpdate = mysqli_query($connection, "UPDATE users SET address='$address_c' WHERE id='$id' LIMIT 1");
    if ($sqlUpdate) {
        header('Location: ../account/');
        $success_msg = '<div class="alert alert-success fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    Success!</strong> Your address has been changed to ' . $address_c . '
</div>';
    } else {
        $error_msg = 'Please try again later.';
    }
}
if (isset($_POST['pincode'])) {
    $pincode_c = mysqli_real_escape_string($connection, $_POST['pincode']);
    // Update the database data now here for all fields posted in the form
    $sqlUpdate = mysqli_query($connection, "UPDATE users SET pincode='$pincode_c' WHERE id='$id' LIMIT 1");
    if ($sqlUpdate) {
        header('Location: ../account/');
        $success_msg = '<div class="alert alert-success fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    Success!</strong> Your pin code has been changed to ' . $pincode_c . '
</div>';
    } else {
        $error_msg = 'Please try again later.';
    }
}
if (isset($_POST['birthday'])) {
    $birthday_c = mysqli_real_escape_string($connection, $_POST['birthday']);
    // Update the database data now here for all fields posted in the form
    $sqlUpdate = mysqli_query($connection, "UPDATE users SET birthday='$birthday_c' WHERE id='$id' LIMIT 1");
    if ($sqlUpdate) {
        header('Location: ../account/');
        $success_msg = '<div class="alert alert-success fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    Success!</strong> Your birthday has been changed to ' . $birthday_c . '
</div>';
    } else {
        $error_msg = 'Please try again later.';
    }
}
if (isset($_POST['about'])) {
    $bio_c = mysqli_real_escape_string($connection, $_POST['about']);
    // Update the database data now here for all fields posted in the form
    $sqlUpdate = mysqli_query($connection, "UPDATE users SET bio_body='$bio_c' WHERE id='$id' LIMIT 1");
    if ($sqlUpdate) {
        header('Location: ../account/');
        $success_msg = '<div class="alert alert-success fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    Success!</strong> Your about has been changed to ' . $bio_c . '
</div>';
    } else {
        $error_msg = 'Please try again later.';
    }
}
if (isset($_POST['experiences'])) {
    $exp_c = mysqli_real_escape_string($connection, $_POST['experiences']);
    // Update the database data now here for all fields posted in the form
    $sqlUpdate = mysqli_query($connection, "UPDATE users SET experiences_body='$exp_c' WHERE id='$id' LIMIT 1");
    if ($sqlUpdate) {
        header('Location: ../account/');
        $success_msg = '<div class="alert alert-success fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    Success!</strong> Your experiences has been changed to ' . $exp_c . '
</div>';
    } else {
        $error_msg = 'Please try again later.';
    }
}
if (isset($_POST['user_type'])) {
    $usr_c = mysqli_real_escape_string($connection, $_POST['user_type']);
    // Update the database data now here for all fields posted in the form
    $sqlUpdate = mysqli_query($connection, "UPDATE users SET user_type='$usr_c' WHERE id='$id' LIMIT 1");
    if ($sqlUpdate) {
        header('Location: ../account/');
        $success_msg = '<div class="alert alert-success fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    Success!</strong> Your account type has been changed to ' . $usr_c . '
</div>';
    } else {
        $error_msg = 'Please try again later.';
    }
}
?>
<?php echo $success_msg; ?> 
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
								<a data-music="  http://djboyradio.streamguys1.com/sub-pop-records.mp3 " title="Radio Pop Live" target=""></a>
						<a data-music="  http://0.s3.envato.com/files/151969330/preview.mp3 " title="Forever Dance" target=""></a>
						<a data-music="  http://0.s3.envato.com/files/151505358/preview.mp3 " title="Stoner Party" target=""></a>
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
} else {
?>
					<button class="kairosodeum-btn-sidebar">
						<i class="fa fa-plus"></i> <span>Login/Signup</span>
					</button>

					<?php } ?>
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
<?php echo $success_msg; ?>
<?php echo $error_msg; ?>
    <div class="card2 hovercard2">
<h1>Account @<?php echo $username; ?></h1>        
        <div class="useravatar2">
                <?php echo $user_pic; ?>
        </div>
       



    </div>




      
    </div>




			 
				
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

					<div class="clearfix"></div>

													<div class="kairosodeum-contact-form">
								<div class="row">
									



<div class="container">
	<div class="row">
	
		
		<form id="account_form" action="index.php" enctype="multipart/form-data" method="post" style="margin-top: 40px;" class="form-horizontal">
<fieldset>
<h2>Basic information</h2>

<!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="uploadPhoto">Profile Pic</label>
  <div class="col-md-4">
    <input id="uploadPhoto" name="update_pic" class="input-file" type="file">
  </div>
</div>



<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">About</label>  
  <div class="col-md-4">
  <input id="textinput" name="about" placeholder="<?php echo $about; ?>" class="form-control input-md" required="" type="text" value="<?php echo $about; ?>">
    
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Experiences</label>  
  <div class="col-md-4">
  <input id="textinput" name="experiences" placeholder="<?php echo $experiences; ?>" class="form-control input-md" required="" type="text" value="<?php echo $experiences; ?>">
    
  </div>
</div>

<h2>Account information</h2>
<!-- Form Name -->
<!-- Text input-->
<!--<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Username</label>  
  <div class="col-md-4">
  <input id="textinput" name="username" placeholder="<?php echo $username; ?>" class="form-control input-md" required="" type="text">
    
  </div>
</div>-->


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Email</label>  
  <div class="col-md-4">
  <input id="textinput" name="email" placeholder="<?php echo $email; ?>" class="form-control input-md" required="" type="text" value="<?php echo $email; ?>" >
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Phone</label>  
  <div class="col-md-4">
  <input id="textinput" name="phone" placeholder="<?php echo $phone; ?>" class="form-control input-md" required="" type="text" value="<?php echo $phone; ?>" >
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Address</label>  
  <div class="col-md-4">
  <input id="textinput" name="address" placeholder="<?php echo $address; ?>" class="form-control input-md" required="" type="text" value="<?php echo $address; ?>" >
    
  </div>
</div>



<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">City</label>  
  <div class="col-md-4">
  <input id="textinput" name="city" placeholder="<?php echo $city; ?>" class="form-control input-md" required="" type="text" value="<?php echo $city; ?>" >
    
  </div>
</div>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">State</label>  
  <div class="col-md-4">
  <input id="textinput" name="state" placeholder="<?php echo $state; ?>" class="form-control input-md" required="" type="text" value="<?php echo $state; ?>" >
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Country</label>  
  <div class="col-md-4">
  <input id="textinput" name="country" placeholder="<?php echo $country; ?>" class="form-control input-md" required="" type="text" value="<?php echo $country; ?>" >
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Pin Code</label>  
  <div class="col-md-4">
  <input id="textinput" name="pincode" placeholder="<?php echo $pincode; ?>" class="form-control input-md" required="" type="text" value="<?php echo $pincode; ?>" >
    
  </div>
</div>



<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Account Type</label>
  <div class="col-md-4">
    <select id="selectbasic" name="user_type" class="form-control">
    <?php if ($user_type == "u") { ?>
      <option value="u">Artist</option>
      <option value="c">Club</option>
      <?php }else if($user_type=="c"){ ?>
       <option value="c">Club</option>
       <option value="u">Artist</option>
     <?php }else{ ?>

     <?php }?>
    </select>
  </div>
</div>


<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="save"></label>
  <div class="col-md-8">
    <button id="save" type="submit" name="save" class="btn btn-success">Save</button>
    <button id="cancel" name="cancel" class="btn btn-danger">Cancel</button>
  </div>
</div>

</fieldset>
</form>

	</div>
</div>


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

<



<!-- footer-->
<script type="text/javascript">
       
    $(document).ready(function(){                    
       $('.kairosodeum-nav-fixed').css('display','block');

       });
    
</script>
	<!-- MUSIC PLAYER OPTIONS -->
	<script src="../assets/themes/default/js/soundmanager2-nodebug-jsmin.js"></script>


	
	
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