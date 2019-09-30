<?php
include_once ("scripts/user_session.php");
?>
<?php
if (!isset($_SESSION)) {
    session_start();
}
/*if (isset($_SESSION['idx'])) {
	header("location: ../home/");
}*/
$errorMsg = '';
$successMsg = '';
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
        //echo 'error';
        $errorMsg = '<div class="alert alert-danger fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Error!</strong> Please fill the both fields.
</div>';
        echo $errorMsg;
    } else {
        include 'scripts/DB_connect.php';
        $email = mysqli_real_escape_string($connection, $email);
        $pass = md5($pass);
        $sql = mysqli_query($connection, "SELECT * FROM users WHERE email='$email' AND password='$pass'");
        $login_check = mysqli_num_rows($sql);
        if ($login_check > 0) {
            header("location: /home");
            while ($row = mysqli_fetch_array($connection, $sql)) {
                $id = $row["id"];
                $username = $row["username"];
                $_SESSION['id'] = $id;
                $_SESSION['idx'] = base64_encode("g4p37hmp3h9xfn8sq03hs2234$id");
                $_SESSION['username'] = $username;
                mysqli_query($connection, "UPDATE users SET last_log=now(), online = '1', timestamp = '$timestamp' WHERE id='$id' LIMIT 1");
            }
            if ($remember == "yes") {
                $encryptedID = base64_encode("ghdg94enm2c0c4y3dn3727553$id");
                setcookie("idCookie", $encryptedID, time() + 60 * 60 * 24 * 100, "/");
                setcookie("passCookie", $pass, time() + 60 * 60 * 24 * 100, "/");
            }
            exit();
        } else {
            $errorMsg = '<div class="alert alert-danger fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    Error!</strong> Login not succesfull, Please try again.
</div>';
            echo $errorMsg;
        }
    }
}
$from = "";
$dyn_www = $_SERVER['HTTP_HOST'];
if (isset($_POST['email_reg'])) {
    $username = preg_replace('#[^A-Za-z0-9]#i', '', $_POST['usr']);
    $user_type = preg_replace('#[^a-z]#i', '', $_POST['profile']);
    $email = $_POST['email_reg'];
    $pass = $_POST['pass'];
    $city = $_POST['city'];
    $email = stripslashes($email);
    $pass = stripslashes($pass);
    $email = strip_tags($email);
    $pass = strip_tags($pass);
    include_once 'scripts/DB_connect.php';
    $emailValid = mysqli_real_escape_string($connection, $email);
    $emailValid = str_replace("`", "", $emailValid);
    $sql_email_check = mysqli_query($connection, "SELECT email FROM users WHERE email='$emailValid'");
    $email_check = mysqli_num_rows($sql_email_check);
    if ((!$username) || (!$user_type) || (!$email) || (!$pass) || (!$city)) {
        //echo 'error'
        $errorMsg = '<div class="alert alert-danger fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    Error!</strong> You must fill all the informations.
</div>';
        echo $errorMsg;
    } else if ($email_check > 0) {
        $errorMsg = '<div class="alert alert-danger"><strong>Error!:</strong> Your Email address is already in use inside of our system. Please use another.</div>';
        echo $errorMsg;
        // echo 'error';
        
    } else { // Error handling is ended, process the data and add member to database
        $email = mysqli_real_escape_string($connection, $email);
        $pass = mysqli_real_escape_string($connection, $pass);
        $db_pass = md5($pass);
        $ipaddress = getenv('REMOTE_ADDR');
        $sql = mysqli_query($connection, "INSERT INTO users (username, user_type, email, password, city, ipaddress, sign_up_date) 
     VALUES('$username','$user_type','$email','$db_pass','$city', '$ipaddress', now())") or die(mysqli_connect_error());
        $id = mysqli_insert_id($connection);
        mkdir("users/$id", 0755);
        mkdir("users/$id/photos", 0755);
        mkdir("users/$id/music", 0755);
        mkdir("users/$id/videos", 0755);
        $to = "$email";
        $from = "info@kairosodeum.com";
        $subject = 'Welcome To Kairosodeum';
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
<img id=\"header_logo\" src=\"http://www.kairosodeum.com/assets/images/nav-logo.png\">
</div>
<div id=\"mail_content\">
<h2>Welcome to KairosOdeum</h2>
<p>Hi $username,  </p>
<p>We are very glad to have you as the member of this growing community.</p>
<p> &ldquo;Kairos Odeum&rdquo; - A string that connects; musical ability, artistic integrity, love and passion for music! &lsquo;Kairos Odeum&rsquo;, is a Greek word with &lsquo;Kairos&rsquo; meaning &lsquo;Opportune moment&rsquo; and &lsquo;Odeum&rsquo; meaning &lsquo;a platform for musical performance&rsquo;. Thus, Kairos Odeum is born; a platform that gives the budding and established Indian musicians alike, a platform to play and perform on their own terms, giving you full access to gigs in just a few simple clicks. Previously, if a band had to perform, it had to approach the platform, agree on performance conditions, negotiate prices, give a sample of their performance and then maybe, just maybe it got the chance to perform… Now think! By making a simple profile and updating it, you get the gigs you deserve, at your preferred locations, on your terms and, more importantly at your price! All you have to do is sign up, upload your videos and maintain your profile. Seems utopian? Well, wake up and smell the coffee because Kairos Odeum gives you the stage for this, assuring you gigs with a few clicks. Just wait and see how Kairos Odeum turn your musical journey into silver screen performances!</p>
<p> You can login to your account using these details below: <br />
E-mail Address: $email <br />
Pass: $pass<br />
</p>
</div>

<div id=\"mail_footer\">Copyright © 2017 KAIROSODEUM All rights reserved.</div>
</body>
</html>
";
        //end of message
        $headers = "From: $from\r\n";
        $headers.= "MIME-Version: 1.0\r\n";
        $headers.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        mail($to, $subject, $message, $headers);
        $successMsg = '<div class="alert alert-success fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    Success!</strong> You have been successfully registered. Please login
</div>';
        //echo 'success';
        include_once 'success.php';
        exit();
    } // Close else after duplication checks
    
} else {
    $errorMsg = "";
    $successMsg = "";
    $username = "";
    $aadhar = "";
    $email = "";
    $pass = "";
}
?>



<!DOCTYPE html>
<html lang="en-US" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<title>KairosOdeum &#8211; Rediscover Yourself</title>

<link rel='stylesheet' id='bootstrap-css'  href='assets/plugins/easy-bootstrap-shortcodes/styles/bootstrap.min.css?ver=4.7.5' type='text/css' media='all' />
<link rel='stylesheet' id='bootstrap-fa-icon-css'  href='assets/plugins/easy-bootstrap-shortcodes/styles/font-awesome.min.css?ver=4.7.5' type='text/css' media='all' />
<link rel='stylesheet' id='contact-form-7-css'  href='assets/plugins/contact-form-7/includes/css/styles4906.css?ver=4.7' type='text/css' media='all' />
<link rel='stylesheet' id='kairosodeum-bootstrap-css-css'  href='assets/themes/default/css/bootstrap.css?ver=4.7.5' type='text/css' media='all' />
<link rel='stylesheet' id='kairosodeum-theme-css-css'  href='assets/themes/default/css/kairosodeum-main.css?ver=4.7.5' type='text/css' media='all' />
<link rel='stylesheet' id='kairosodeum-color-css-css'  href='assets/themes/default/css/kairosodeum-style.css?ver=4.7.5' type='text/css' media='all' />
<link rel='stylesheet' id='kairosodeum-app-css'  href='assets/themes/default/css/kairosodeum-app.css?ver=4.7.5' type='text/css' media='all' />
<link rel='stylesheet' id='kairosodeum-carousel-css-css'  href='assets/themes/default/js/utilcarousel-files/utilcarousel/util.carousel.css?ver=4.7.5' type='text/css' media='all' />
<link rel='stylesheet' id='kairosodeum-skins-css-css'  href='assets/themes/default/js/utilcarousel-files/utilcarousel/util.carousel.skins.css?ver=4.7.5' type='text/css' media='all' />
<link rel='stylesheet' id='kairosodeum-popup-css-css'  href='assets/themes/default/js/utilcarousel-files/magnific-popup/magnific-popup.css?ver=4.7.5' type='text/css' media='all' />
<link rel='stylesheet' id='ebs_dynamic_css-css'  href='assets/plugins/easy-bootstrap-shortcodes/styles/ebs_dynamic_css.css?ver=4.7.5' type='text/css' media='all' />
<script type='text/javascript' src='assets/plugins/advanced-ajax-page-loader/jquery.js?ver=4.7.5'></script>
<script type='text/javascript' src='assets/plugins/easy-bootstrap-shortcodes/js/bootstrap.min.js?ver=4.7.5'></script>
<script type='text/javascript' src='assets/themes/default/js/kairosodeum-js.js'></script>

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
						document.write('<scr' + 'ipt type="text/javascript" src="assets/plugins/advanced-ajax-page-loader/jquery.js"></scr' + 'ipt>');
					}
					setTimeout('initJQuery()', 50);
				}
			}
		}

		initJQuery();

	</script>

	<script type="text/javascript" src="assets/plugins/advanced-ajax-page-loader/ajax-page-loader.js"></script>
	<script type="text/javascript" src="assets/plugins/advanced-ajax-page-loader/reload_code.js"></script>
	
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
	
	

				
				<!-- SIDEBAR OPTIONS -->
		<div class="kairosodeum-sidebar-menu kairosodeum-sidebar-menu-two">
			<!-- TAB MENU -->
						<div class="kairosodeum-sidebar-tab">
				<ul>
											<li class="active">
							<a href="#sidebarmenu" data-toggle="tab">
								<span class="kairosodeum-btn-tab-sidebar">
																			Login																	</span>
							</a>
						</li>
					
											<li  >
							<a href="#sidebarwidget" data-toggle="tab">
								<span class="kairosodeum-btn-tab-sidebar">
																			Sign Up																</span>
							</a>
						</li>
									</ul>
				<div class="clearfix"></div>
				<div class="hidden-md hidden-lg kairosodeum-sidebar-closed">
					<span class="btn btn-block btn-lg btn-success">
						<i class="fa fa-times"></i> Close					</span>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>

			<!-- TAB CONTENT -->
			<div class="tab-content kairosodeum-tab-content">
									<!-- #1 -->
					<div class="tab-pane active" id="sidebarmenu">
						<div class="menu-top-menu-container">


					<div class="kairosodeum-dark-widget">

					<h5>Login</h5>


						<div class="loginbox">
						<form action="index.php" method="post" enctype="application/data">
<div class="form-group " style="width: 220px">
  <label for="email">Email</label>
  <input type="text" class="form-control" id="email" name="email" placeholder="Email">
</div>
<div class="form-group" style="width: 220px">
  <label for="password">Password</label>
  <input type="password" class="form-control" name="pass" placeholder="Password">
</div>
<a href="/forgot/" class="forgot_link">forgot ?</a>
<button type="submit" class="login-action" style="width: 180px; margin-left: -20px">Sign in</button>
</form>
</div>
</div>

	

</div>					</div>
				
									<!-- #2 -->
					<div class="tab-pane" id="sidebarwidget">

						<div class="kairosodeum-dark-widget">
		

<h5>Start your journey</h5>

<div class="signbox">
<form action="index.php" method="post" enctype="application/data">
<div class="form-group"  style="width: 220px">
  <label for="profile">Select your profile</label>
  <select class="form-control" id="profile" name="profile">
    <option value="u">Artist</option>
    <option value="c">Club</option>

  </select>
</div>
<div class="form-group"  style="width: 220px">
  <label for="usr">Username</label>
  <input type="text" class="form-control" id="usr" name="usr" placeholder="Username">
</div>
<div class="form-group"  style="width: 220px">
   <label for="pass">Password</label>
  <input type="password" class="form-control" id="pass" name="pass" placeholder="Password">
</div>
<div class="form-group"  style="width: 220px">
   <label for="pass2">Confirm Password</label>
  <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Confirm Password">
</div>
<div class="form-group"  style="width: 220px">
   <label for="email_reg">Email</label>
  <input type="text" class="form-control" id="email_reg" name="email_reg" placeholder="Email">
</div>
<div class="form-group"  style="width: 220px">
   <label for="email_reg">City</label>
  <input type="text" class="form-control" id="city" name="city" placeholder="City">
</div>



<div class="form-group"  style="width: 220px">
				  <p>
					By clicking on sign up, you agree to our
					<a href="/terms">Terms</a>
					and
					<a href="/policy" id="privacy-link" target="_blank" rel="nofollow">Data Policy</a>
				  </p>
</div>
<button type="submit" class="sign-action" style="width: 180px; ">Sign up</button>
</form>
</div>



															</div>
						<div class="clearfix"></div>
						<div class="kairosodeum-dark-widget-space"></div>
					</div>
							</div>
		</div>
	
	<!-- SOUND THEME / TOP NAVIGATION -->
	<div class="container-fluid kairosodeum-nav-fixed kairosodeum-nav-fixed-mobil">

		<!-- SOUND THEME / LOGO AREA -->
				<div class="col-xs-12 col-sm-12 col-md-12">

							<div class="kairosodeum-menu-icon">
<?php
// if (isset($_SESSION['idx'])) {
// 								echo "<button class=\"kairosodeum-btn-\">
// 								<a href=\"/home/\" >
// 						<i class=\"fa fa-plus\"></i> <span>Dashboard</span>
// 					</a>&nbsp; &nbsp;
// 						<a href=\"/account/\" >
// 						<i class=\"fa fa-plus\"></i> <span>Account</span>
// 					</a>
// 					</button>
// 					";
// }else{

?>
					<button class="kairosodeum-btn-sidebar">
						<i class="fa fa-plus"></i> <span>Login/Signup</span>
					</button>

					<? /*}*/ ?>
					
				</div>
			
			<div class="kairosodeum-logo hidden-sm hidden-xs">
				<a href="index.php">
											<img src="assets/themes/default/images/logo.png" alt="Logo">
									</a>
			</div>
			<div class="kairosodeum-logo hidden-md hidden-lg">
				<a href="index.php">
											<img src="assets/themes/default/images/logo.png" alt="Logo">
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
	
	<div id="component" class="component component-fullwidth fxStickIt">

	    <ul class="itemwrap">

		        <li  class="current"  style="background-image: url(assets/themes/default/images/Main-Slide1.jpg);" >
		            <div class="kairosodeum-slidertitle">
		                		                	<h1>A Gig</h1><h1>With just a click!</h1>
		                		                		                	<h2>Explore a complete new era!</h2>
		                		                			                <div class="kairosodeum-slider-button">
				            	<a href="/about" class="btn btn-lg btn-success">
				            		Explore		            	</a>
				            </div>
				        		            </div>
		            <img src="assets/themes/default/images/Main-Slide1.jpg)" alt="Slider" />
	        	</li>


	        	        			        <li  style="background-image: url(assets/themes/default/images/Main-Slide2.jpg);" >
		            <div class="kairosodeum-slidertitle">
		                		                	<h1>Passion is money!</h1><h1>Money is passion!</h1>
		                		                		                	<h2>And if you are good at something, never do it for free!</h2>
		                		                			                <div class="kairosodeum-slider-button">
				            	<a href="/about" class="btn btn-lg btn-success">
				            		Get Hired Now		            	</a>
				            </div>
				        		            </div>
		            <img src="assets/themes/default/images/Main-Slide2.jpg)" alt="Slider" />
	        	</li>
	        	        			        <li  style="background-image: url(assets/themes/default/images/Main-Slide3.jpg);" >
		            <div class="kairosodeum-slidertitle">
		                		                	<h1>Be the hero of your own life story</h1>
		                		                		                	<h2>Trend on Kairos Odeum, trend in the music world</h2>
		                		                			                <div class="kairosodeum-slider-button">
				            	<a href="/about" class="btn btn-lg btn-success">
				            		Discover More				            	</a>
				            </div>
				        		            </div>
		            <img src="assets/themes/default/images/Main-Slide3.jpg" alt="Slider" />
	        	</li>
	        	        			        <li  style="background-image: url(assets/themes/default/images/Main-Slide4.jpg);" >
		            <div class="kairosodeum-slidertitle">
		                		                	<h1>Be the uncut diamond in the coal mine and shine bright</h1>
		                		                		                	<h2>Let your music do the talking</h2>
		                		                			                <div class="kairosodeum-slider-button">
				            	<a href="/about" class="btn btn-lg btn-success">
				            		Start Your Journey				            	</a>
				            </div>
				        		            </div>
		            <img src="assets/themes/default/images/Main-Slide4.jpg" alt="Slider" />
	        	</li>
	        	        			        <li  style="background-image: url(assets/themes/default/images/Main-Slide5.jpg);" >
		            <div class="kairosodeum-slidertitle">
		                		                	<h1>love to have myriad served on your platter</h1>
		                		                		                	<h2>Have bazillions of artists at your disposal</h2>
		                		                			                <div class="kairosodeum-slider-button">
				            	<a href="/about" class="btn btn-lg btn-success">
				            		Find out				            	</a>
				            </div>
				        		            </div>
		            <img src="assets/themes/default/images/Main-Slide5.jpg" alt="Slider" />
	        	</li>
	        	        			      <!--    <li  style="background-image: url(assets/themes/default/images/Main-Slide5.jpg);" >
		          <div class="kairosodeum-slidertitle">
		                		                	<h1>Creative Awesome Events</h1>
		                		                		                	<h2>Event Magazine</h2>
		                		                			                <div class="kairosodeum-slider-button">
				            	<a href="http://www.kairosodeum.com/sound/event-page-four-grid/" class="btn btn-lg btn-success">
				            		Discovery Events				            	</a>
				            </div>
				        		            </div>
		            <img src="assets/themes/default/images/Main-Slide5.jpg" alt="Slider" />
	        	</li>-->
	        	    </ul>
	    <nav>
	        <a class="prev" href="#"><i class="fa fa-chevron-left"></i></a>
	        <a class="next" href="#"><i class="fa fa-chevron-right"></i></a>
	    </nav>
	</div>
	<div class="clearfix"></div>
 




	<!-- SOUND THEME / BUILDER START -->

<!-- SOUND THEME / FEATURED SLIDER -->

			<style type="text/css">
				.kairosodeum-gradient-wall {
				background: url(assets/themes/default/images/gradient.jpg) no-repeat center center;
				background-color:#24252A;
				  -webkit-background-size: cover;
				  -moz-background-size: cover;
				  -o-background-size: cover;
				  background-size: cover; 
				  filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="assets/themes/default/images/gradient.jpg", sizingMethod='scale');
				  -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='assets/themes/default/images/gradient.jpg', sizingMethod='scale')";
				}
			</style>
					
<div class="container-fluid kairosodeum-mod-gradient kairosodeum-container kairosodeum-gradient-wall ">
	<!--<div class="container">
					<div class="col-md-12">
				<div class="kairosodeum-mod-title ">
					<h1>New Video Release</h1>
											<h2>Watch Now</h2>
									</div>
			</div>
		
		<div class="clearfix"></div>

		<div class="row kairosodeum-mod-videolist" style="margin-top:60px;">
									    							
					<div class="col-md-6">
													<div class="kairosodeum-single-gallery">
								<a class="kairosodeum-video-popup" href="#kairosodeum-video144">
									<img width="700" height="450" src="assets/uploads/2017/10/photo-1429305254053-2a1bfe816f36-700x450.jpg" class="attachment-kairosodeum-thumb-formal size-kairosodeum-thumb-formal wp-post-image" alt="" />									<div class="kairosodeum-video-play"><i class="fa fa-play"></i></div>
								</a>
							</div>
												<div class="kairosodeum-mod-detail ">
															<h1><a href="world-of-war/index.php">World of War</a></h1>
														<h2>
																	"It&#039;s Awesome Movie"
															</h2>
						</div>

						<div id="kairosodeum-video144" class="mfp-hide">
							<div class="col-md-2"></div>
							<div class="col-md-8">
															<div class="embed-container">
									<iframe width="200" height="113" src="https://www.youtube.com/embed/cXuC_v0KWaU?feature=oembed" frameborder="0" allowfullscreen></iframe>								</div>
														</div>
							<div class="col-md-2"></div>
						</div>
					</div>

						    							
					<div class="col-md-6">
													<div class="kairosodeum-single-gallery">
								<a class="kairosodeum-video-popup" href="#kairosodeum-video188">
									<img width="700" height="450" src="assets/uploads/2017/10/photo-1436128003323-97dab5d267a9-700x450.jpg" class="attachment-kairosodeum-thumb-formal size-kairosodeum-thumb-formal wp-post-image" alt="" />									<div class="kairosodeum-video-play"><i class="fa fa-play"></i></div>
								</a>
							</div>
												<div class="kairosodeum-mod-detail ">
															<h1><a href="prince-of-persie/index.php">Prince of Persie</a></h1>
														<h2>
																	"Little Prince in Life"
															</h2>
						</div>

						<div id="kairosodeum-video188" class="mfp-hide">
							<div class="col-md-2"></div>
							<div class="col-md-8">
															<div class="embed-container">
									<iframe width="200" height="113" src="https://www.youtube.com/embed/dJ8hccoZ6hQ?feature=oembed" frameborder="0" allowfullscreen></iframe>								</div>
														</div>
							<div class="col-md-2"></div>
						</div>
					</div>

							
			<div class="clearfix"></div>
		</div>

					<div class="row">
				<div class="col-md-4 kairosodeum-mod-playreposive">
				</div>
				<div class="col-md-4">
					<div class="kairosodeum-mod-bigbutton kairosodeum-mod-playbtn">
						<a href="http://www.kairosodeum.com/sound/video-page-four-grid/" class="btn btn-block btn-lg  btn-primary ">View All Videos</a>
					</div>
				</div>
				<div class="col-md-4">
				</div>

				<div class="clearfix"></div>
			</div>
			</div>


-->
<div class="container ">
	<div class="row">
			<div class="col-md-12">
					<div class="kairosodeum-mod-title kairosodeum-mod-title-dark">
						<h1>#Get Found</h1>
													<h2>Rediscover your passion</h2>



											</div>
				</div>

		<div class="carousel carousel-margin">
            <ul class="list-inline">
                <li class="clearfix">
                    <div class="carousel-block">
                        <h4>Maintain your profile</h4>

                        	
                        <img src="assets/themes/default/images/curriculum.png"/>
                    </div>
                </li>
                <li  class="clearfix">
                    <div class="carousel-block">
                        <h4>Start your journey</h4>
                        <img src="assets/themes/default/images/laptop.png"/>
                    </div>
                </li>
                <li  class="clearfix">
                    <div class="carousel-block">
                        <h4>Get Found by people around</h4>
                        <img src="assets/themes/default/images/team.png"/>
                    </div>
                </li>
                
                   <li  class="clearfix">
                    <div class="carousel-block">
                        <h4>Get Gigs, Make Money</h4>
                        <img src="assets/themes/default/images/networking.png"/>
                    </div>
                </li>

                    <li  class="clearfix">
                    <div class="carousel-block">
                        <h4>Build your musical career</h4>
                        <img src="assets/themes/default/images/profits.png"/>
                    </div>
                </li>
                
            </ul>
        </div>    
	</div>
</div>
</div>

		<!-- SOUND THEME / NEWS -->
			
		<!-- SOUND THEME / FEATURED SLIDER -->

					<style type="text/css">
		.kairosodeum-mod-black {
		/*background: url(assets/uploads/2017/10/Music-Header.png) no-repeat center center;*/
				background-color:#000;
			
		}
	</style>

					
<div class="container-fluid kairosodeum-container kairosodeum-mod-black ">
	
					<div class="col-md-12">
				<div class="kairosodeum-mod-title  kairosodeum-mod-title-dark ">
					<h1>#Everyone has their own story</h1>
					<h2>Check out now</h2>
				</div>
			</div>
		
		<div class="clearfix"></div>


		


<div class="wrapper">
  <div class="column">
    <div class="inner"></div>
  </div>
  <div class="column">
    <div class="inner"></div>
  </div>
  <div class="column">
    <div class="inner"></div>
  </div>
  <div class="column">
    <div class="inner"></div>
  </div>
  <div class="column">
    <div class="inner"></div>
  </div>
  <div class="column">
    <div class="inner"></div>
  </div>
  <div class="column">
    <div class="inner"></div>
  </div>
  <div class="column">
    <div class="inner"></div>
  </div>
  <div class="column">
    <div class="inner"></div>
  </div>
  <div class="column">
    <div class="inner"></div>
  </div>
  <div class="column">
    <div class="inner"></div>
  </div>
  <div class="column">
    <div class="inner"></div>
  </div>
</div>


		
</div>

			
		

		<!-- SOUND THEME / EVENT LIST -->
					
		
		<!-- SOUND THEME / FEATURED SLIDER -->
						<style type="text/css">
		.kairosodeum-mod-events {
		background: url(assets/uploads/2017/10/Event-Light.png) no-repeat center center;
				background-color:#F4F6F7;
				  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  -o-background-size: cover;
		  background-size: cover; 
		  filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='assets/uploads/2017/10/Event-Light.png', sizingMethod='scale');
		  -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='assets/uploads/2017/10/Event-Light.png', sizingMethod='scale')";
		}
	</style>



		<!-- SOUND THEME / PLAYLIST -->
					

		<!-- SOUND THEME / GALLERY -->
					
		
		
					
		
		
					
		
		<!-- SOUND THEME / FEATURED SLIDER -->
						<style type="text/css">
		.kairosodeum-mod-newsblog {
		/*background: url(assets/themes/default/images/trending.jpg) no-repeat center center;*/
				background-color:#F4F6F7;
				  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  -o-background-size: cover;
		  background-size: cover; 
		  filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='assets/themes/default/images/trending.jpg', sizingMethod='scale');
		  -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='assets/themes/default/images/trending.jpg', sizingMethod='scale')";
		}
	</style>

<div class="container-fluid kairosodeum-mod-newsblog kairosodeum-container kairosodeum-mod-grey ">
	<div class="container">
		<div class="row">
							<div class="col-md-12">
					<div class="kairosodeum-mod-title ">
						<h1>#Trending</h1>
													<h2>Whats Hot</h2>
											</div>
				</div>
			
			<div class="clearfix"></div>

							<div id="kairosodeum-module-news" class="util-carousel team-showcase kairosodeum-mod-featcon">
								    		
						<div class="item">
							<div class="meida-holder kairosodeum-mod-thumb">
																	<div class="kairosodeum-single-gallery">
										<a href="https://www.youtube.com/watch?v=ooZgYRH9OPE">
											<img width="700" height="450" src="assets/uploads/2017/10/empty-700x450.jpg" class="attachment-kairosodeum-thumb-formal size-kairosodeum-thumb-formal wp-post-image" alt="" />											<div class="kairosodeum-hover-play"><i class="fa fa-search-plus"></i></div>
										</a>
									</div>
															</div>

						<!--	<div class="kairosodeum-mod-detail kairosodeum-mod-news-detail ">
								<h1><a href="clone-of-monster/index.php">Clone of Monster</a></h1>
								<h2><i class="fa fa-bookmark-o"></i> 14 Oct 15 <i class="fa fa-commenting-o"></i> 3</h2>
								<p>A faucibus velit adipiscing est vitae scelerisque tristique eu adipiscing porta suspendisse aliquet duis class phasellus euismod...</p>
							</div>-->
						</div>
								    		
						<div class="item">
							<div class="meida-holder kairosodeum-mod-thumb">
																	<div class="kairosodeum-single-gallery">
										<a href="https://www.youtube.com/watch?v=oyaXJHgsU4c">
											<img width="700" height="450" src="assets/uploads/2017/10/photo-1432838765905-6881a8585474-700x450.jpg" class="attachment-kairosodeum-thumb-formal size-kairosodeum-thumb-formal wp-post-image" alt="" />											<div class="kairosodeum-hover-play"><i class="fa fa-search-plus"></i></div>
										</a>
									</div>
															</div>

							<!--<div class="kairosodeum-mod-detail kairosodeum-mod-news-detail ">
								<h1><a href="blue-spring-gallery/index.php">Blue Spring Gallery</a></h1>
								<h2><i class="fa fa-bookmark-o"></i> 14 Jul 15 <i class="fa fa-commenting-o"></i> 3</h2>
								<p>A faucibus velit adipiscing est vitae scelerisque tristique eu adipiscing porta suspendisse aliquet duis class phasellus euismod...</p>
							</div>-->
						</div>
								    		
					<div class="item">
							<div class="meida-holder kairosodeum-mod-thumb">
																	<div class="kairosodeum-single-gallery">
										<a href="https://www.youtube.com/watch?v=GN8BR1LT3sM">
											<img width="700" height="450" src="assets/uploads/2017/10/photo-1435575606138-4edaccd24021-700x450.jpg" class="attachment-kairosodeum-thumb-formal size-kairosodeum-thumb-formal wp-post-image" alt="" />											<div class="kairosodeum-hover-play"><i class="fa fa-search-plus"></i></div>
										</a>
									</div>
															</div>

						<!--	<div class="kairosodeum-mod-detail kairosodeum-mod-news-detail ">
								<h1><a href="corridor-movie/index.php">Corridor Movie</a></h1>
								<h2><i class="fa fa-bookmark-o"></i> 14 Oct 15 <i class="fa fa-commenting-o"></i> 4</h2>
								<p>A faucibus velit adipiscing est vitae scelerisque tristique eu adipiscing porta suspendisse aliquet duis class phasellus euismod...</p>
							</div>-->
						</div>
								    		
					<!--<div class="item">
							<div class="meida-holder kairosodeum-mod-thumb">
																	<div class="kairosodeum-single-gallery">
										<a href="index.php">
											<img width="700" height="450" src="assets/uploads/2017/10/photo-1436759644647-e274ee931eaa-700x450.jpg" class="attachment-kairosodeum-thumb-formal size-kairosodeum-thumb-formal wp-post-image" alt="" />											<div class="kairosodeum-hover-play"><i class="fa fa-search-plus"></i></div>
										</a>
									</div>
															</div>

							<div class="kairosodeum-mod-detail kairosodeum-mod-news-detail ">
								<h1><a href="index.php">Animation Planet</a></h1>
								<h2><i class="fa fa-bookmark-o"></i> 14 Oct 15 <i class="fa fa-commenting-o"></i> 3</h2>
								<p>A faucibus velit adipiscing est vitae scelerisque tristique eu adipiscing porta suspendisse aliquet duis class phasellus euismod...</p>
							</div>
						</div>-->
								    		
						<!--<div class="item">
							<div class="meida-holder kairosodeum-mod-thumb">
																	<div class="kairosodeum-single-gallery">
										<a href="index.php">
											<img width="700" height="450" src="assets/uploads/2017/10/photo-1435458983855-85e70c381591-700x450.jpg" class="attachment-kairosodeum-thumb-formal size-kairosodeum-thumb-formal wp-post-image" alt="" />											<div class="kairosodeum-hover-play"><i class="fa fa-search-plus"></i></div>
										</a>
									</div>
															</div>

							<div class="kairosodeum-mod-detail kairosodeum-mod-news-detail ">
								<h1><a href="index.php">The Lost Photos</a></h1>
								<h2><i class="fa fa-bookmark-o"></i> 14 Oct 15 <i class="fa fa-commenting-o"></i> 3</h2>
								<p>A faucibus velit adipiscing est vitae scelerisque tristique eu adipiscing porta suspendisse aliquet duis class phasellus euismod...</p>
							</div>
						</div>-->
								    		
						<!--<div class="item">
							<div class="meida-holder kairosodeum-mod-thumb">
																	<div class="kairosodeum-single-gallery">
										<a href="index.php">
											<img width="700" height="450" src="assets/uploads/2017/10/22-700x450.jpg" class="attachment-kairosodeum-thumb-formal size-kairosodeum-thumb-formal wp-post-image" alt="" />											<div class="kairosodeum-hover-play"><i class="fa fa-search-plus"></i></div>
										</a>
									</div>
															</div>

							<div class="kairosodeum-mod-detail kairosodeum-mod-news-detail ">
								<h1><a href="index.php">The Art Street</a></h1>
								<h2><i class="fa fa-bookmark-o"></i> 14 May 15 <i class="fa fa-commenting-o"></i> 3</h2>
								<p>A faucibus velit adipiscing est vitae scelerisque tristique eu adipiscing porta suspendisse aliquet duis class phasellus euismod...</p>
							</div>
						</div>-->
								    		
						<!--<div class="item">
							<div class="meida-holder kairosodeum-mod-thumb">
																	<div class="kairosodeum-single-gallery">
										<a href="index.php">
											<img width="700" height="450" src="assets/uploads/2017/10/42-700x450.jpg" class="attachment-kairosodeum-thumb-formal size-kairosodeum-thumb-formal wp-post-image" alt="" />											<div class="kairosodeum-hover-play"><i class="fa fa-search-plus"></i></div>
										</a>
									</div>
															</div>

							<div class="kairosodeum-mod-detail kairosodeum-mod-news-detail ">
								<h1><a href="index.php">It&#8217;s Perfect Day</a></h1>
								<h2><i class="fa fa-bookmark-o"></i> 14 Oct 15 <i class="fa fa-commenting-o"></i> 3</h2>
								<p>A faucibus velit adipiscing est vitae scelerisque tristique eu adipiscing porta suspendisse aliquet duis class phasellus euismod...</p>
							</div>
						</div>-->
								    		
						<!--<div class="item">
							<div class="meida-holder kairosodeum-mod-thumb">
																	<div class="kairosodeum-single-gallery">
										<a href="past-time-paradise/index.php">
											<img width="700" height="450" src="assets/uploads/2017/10/27-700x450.jpg" class="attachment-kairosodeum-thumb-formal size-kairosodeum-thumb-formal wp-post-image" alt="" />											<div class="kairosodeum-hover-play"><i class="fa fa-search-plus"></i></div>
										</a>
									</div>
															</div>

							<div class="kairosodeum-mod-detail kairosodeum-mod-news-detail ">
								<h1><a href="past-time-paradise/index.php">Past Time Paradise</a></h1>
								<h2><i class="fa fa-bookmark-o"></i> 14 Oct 15 <i class="fa fa-commenting-o"></i> 3</h2>
								<p>A faucibus velit adipiscing est vitae scelerisque tristique eu adipiscing porta suspendisse aliquet duis class phasellus euismod...</p>
							</div>
						</div>-->
					 
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
						<h1>#Discover Artists </h1>
													<h2>Best Musicians</h2>
											</div>
				</div>
			
			<div class="clearfix"></div>

							<div id="kairosodeum-module-gallery" class="util-carousel team-showcase kairosodeum-mod-featcon">
								    														<div class="item">
							<div class="meida-holder kairosodeum-mod-thumb">
																	<div class="kairosodeum-single-gallery">
										<a href="#">
											<img width="450" height="450" src="assets/uploads/2017/10/12-450x450.jpg" class="attachment-kairosodeum-thumb-medium size-kairosodeum-thumb-medium wp-post-image" alt="" srcset="assets/uploads/2017/10/12-450x450.jpg 450w, assets/uploads/2017/10/12-150x150.jpg 150w, assets/uploads/2017/10/12-250x250.jpg 250w" sizes="(max-width: 450px) 100vw, 450px" />											<div class="kairosodeum-hover-play"><i class="fa fa-search-plus"></i></div>
										</a>
									</div>
															</div>

							<div class="kairosodeum-mod-detail  kairosodeum-mod-detail-dark ">
																	<h1><a href="#">Leonardo Doe Caprio</a></h1>
																<h2>
																			"Pop Musician"
																	</h2>
							</div>
						</div>
								    														<div class="item">
							<div class="meida-holder kairosodeum-mod-thumb">
																	<div class="kairosodeum-single-gallery">
										<a href="#">
											<img width="450" height="450" src="assets/uploads/2017/10/37-450x450.jpg" class="attachment-kairosodeum-thumb-medium size-kairosodeum-thumb-medium wp-post-image" alt="" srcset="assets/uploads/2017/10/37-450x450.jpg 450w, assets/uploads/2017/10/37-150x150.jpg 150w, assets/uploads/2017/10/37-250x250.jpg 250w" sizes="(max-width: 450px) 100vw, 450px" />											<div class="kairosodeum-hover-play"><i class="fa fa-search-plus"></i></div>
										</a>
									</div>
															</div>

							<div class="kairosodeum-mod-detail  kairosodeum-mod-detail-dark ">
																	<h1><a href="#">Samuel Smith</a></h1>
																<h2>
																			"Pop Musician"
																	</h2>
							</div>
						</div>
								    														<div class="item">
							<div class="meida-holder kairosodeum-mod-thumb">
																	<div class="kairosodeum-single-gallery">
										<a href="#">
											<img width="450" height="450" src="assets/uploads/2017/10/4-450x450.jpg" class="attachment-kairosodeum-thumb-medium size-kairosodeum-thumb-medium wp-post-image" alt="" srcset="assets/uploads/2017/10/4-450x450.jpg 450w, assets/uploads/2017/10/4-150x150.jpg 150w, assets/uploads/2017/10/4-250x250.jpg 250w" sizes="(max-width: 450px) 100vw, 450px" />											<div class="kairosodeum-hover-play"><i class="fa fa-search-plus"></i></div>
										</a>
									</div>
															</div>

							<div class="kairosodeum-mod-detail  kairosodeum-mod-detail-dark ">
																	<h1><a href="#">Julia Spartow</a></h1>
																<h2>
																			"Jazz Musician"
																	</h2>
							</div>
						</div>
								    														<div class="item">
							<div class="meida-holder kairosodeum-mod-thumb">
																	<div class="kairosodeum-single-gallery">
										<a href="#">
											<img width="450" height="450" src="assets/uploads/2017/10/241-450x450.jpg" class="attachment-kairosodeum-thumb-medium size-kairosodeum-thumb-medium wp-post-image" alt="" srcset="assets/uploads/2017/10/241-450x450.jpg 450w, assets/uploads/2017/10/241-150x150.jpg 150w, assets/uploads/2017/10/241-250x250.jpg 250w" sizes="(max-width: 450px) 100vw, 450px" />											<div class="kairosodeum-hover-play"><i class="fa fa-search-plus"></i></div>
										</a>
									</div>
															</div>

							<div class="kairosodeum-mod-detail  kairosodeum-mod-detail-dark ">
																	<h1><a href="#">Adam Patrowich</a></h1>
																<h2>
																			"Jazz Musician"
																	</h2>
							</div>
						</div>
								    														<div class="item">
							<div class="meida-holder kairosodeum-mod-thumb">
																	<div class="kairosodeum-single-gallery">
										<a href="#">
											<img width="450" height="450" src="assets/uploads/2017/10/photo-1436190807865-2e156d40f1a2-450x450.jpg" class="attachment-kairosodeum-thumb-medium size-kairosodeum-thumb-medium wp-post-image" alt="" srcset="assets/uploads/2017/10/photo-1436190807865-2e156d40f1a2-450x450.jpg 450w, assets/uploads/2017/10/photo-1436190807865-2e156d40f1a2-150x150.jpg 150w, assets/uploads/2017/10/photo-1436190807865-2e156d40f1a2-250x250.jpg 250w" sizes="(max-width: 450px) 100vw, 450px" />											<div class="kairosodeum-hover-play"><i class="fa fa-search-plus"></i></div>
										</a>
									</div>
															</div>

							<div class="kairosodeum-mod-detail  kairosodeum-mod-detail-dark ">
																	<h1><a href="#">Elizabeth Smith</a></h1>
																<h2>
																			"Jazz Musician"
																	</h2>
							</div>
						</div>
								    														<div class="item">
							<div class="meida-holder kairosodeum-mod-thumb">
																	<div class="kairosodeum-single-gallery">
										<a href="#">
											<img width="450" height="450" src="assets/uploads/2017/10/20-450x450.jpg" class="attachment-kairosodeum-thumb-medium size-kairosodeum-thumb-medium wp-post-image" alt="" srcset="assets/uploads/2017/10/20-450x450.jpg 450w, assets/uploads/2017/10/20-150x150.jpg 150w, assets/uploads/2017/10/20-250x250.jpg 250w" sizes="(max-width: 450px) 100vw, 450px" />											<div class="kairosodeum-hover-play"><i class="fa fa-search-plus"></i></div>
										</a>
									</div>
															</div>

							<div class="kairosodeum-mod-detail  kairosodeum-mod-detail-dark ">
																	<h1><a href="#">Micheal Smith</a></h1>
																<h2>
																			"Jazz Musician"
																	</h2>
							</div>
						</div>
								    														<div class="item">
							<div class="meida-holder kairosodeum-mod-thumb">
																	<div class="kairosodeum-single-gallery">
										<a href="#">
											<img width="450" height="450" src="assets/uploads/2017/10/9-450x450.jpg" class="attachment-kairosodeum-thumb-medium size-kairosodeum-thumb-medium wp-post-image" alt="" srcset="assets/uploads/2017/10/9-450x450.jpg 450w, assets/uploads/2017/10/9-150x150.jpg 150w, assets/uploads/2017/10/9-250x250.jpg 250w" sizes="(max-width: 450px) 100vw, 450px" />											<div class="kairosodeum-hover-play"><i class="fa fa-search-plus"></i></div>
										</a>
									</div>
															</div>

							<div class="kairosodeum-mod-detail  kairosodeum-mod-detail-dark ">
																	<h1><a href="#">Marie Strazborg</a></h1>
																<h2>
																			"Pop Musician"
																	</h2>
							</div>
						</div>
								    														<div class="item">
							<div class="meida-holder kairosodeum-mod-thumb">
																	<div class="kairosodeum-single-gallery">
										<a href="#">
											<img width="450" height="450" src="assets/uploads/2017/10/33-450x450.jpg" class="attachment-kairosodeum-thumb-medium size-kairosodeum-thumb-medium wp-post-image" alt="" srcset="assets/uploads/2017/10/33-450x450.jpg 450w, assets/uploads/2017/10/33-150x150.jpg 150w, assets/uploads/2017/10/33-250x250.jpg 250w" sizes="(max-width: 450px) 100vw, 450px" />											<div class="kairosodeum-hover-play"><i class="fa fa-search-plus"></i></div>
										</a>
									</div>
															</div>

							<div class="kairosodeum-mod-detail  kairosodeum-mod-detail-dark ">
																	<h1><a href="#">Robert Doe Smith</a></h1>
																<h2>
																			"Rock Musician"
																	</h2>
							</div>
						</div>
					 
				</div>
					</div>
	</div>
</div>

		<!-- SOUND THEME / VIDEO -->



		<!-- SOUND THEME / BIG NEWS -->
			 
				
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
		
		<!-- SOUND THEME / CONTACT FORMS -->
		<div class="container-fluid kairosodeum-darkback-one kairosodeum-footer-wall">
			<div class="container">
				<div class="row">
					<div class="col-md-12">

						<div class="kairosodeum-related-title">
															<h1>Get Found</h1>
							
															<h6>With KairosOdeum</h6>
<div class="kairosodeum-slider-button">
															<h6><a href="/about" class="btn btn-lg btn-success">
				            		Explore		            	</a></h6>
				            	</div>
													</div>

													<div class="kairosodeum-contact-form">
								<div class="row">
									<div class="col-md-4"></div>
									<div class="col-md-4">
					

<!-- -->



													</div>
									<div class="col-md-4"></div>
									<div class="clearfix"></div>
								</div>
							</div>
											</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	
						<!-- SOUND THEME / SOCIAL ICONS -->
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
<!-- SOUND THEME / AJAX CONTENT END -->




<!-- SOUND THEME / THEME FOOTER -->
<script type="text/javascript">
(function($) {          
    $(document).ready(function(){                    
        $(window).scroll(function(){                          
            if ($(this).scrollTop() > 2) {
                $('.kairosodeum-nav-fixed').fadeIn(500);
            } else {
                $('.kairosodeum-nav-fixed').fadeOut(500);
            }
        });
    });
})(jQuery);
</script>


	<!-- MUSIC PLAYER OPTIONS -->
	<script src="assets/themes/default/js/soundmanager2-nodebug-jsmin.js"></script>

	<!--
	<script src="../../connect.soundcloud.com/sdk.js"></script>
	<script src="assets/themes/default/js/jquery.fullwidthAudioPlayer.js"></script>
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
	-->
			<script type="text/javascript">
			function AAPL_reload_code() {
			jQuery.getScript("assets/themes/default/js/utilcarousel-files/utilcarousel/jquery.utilcarousel.min.js", function(data, textStatus, jqxhr){ });
			jQuery.getScript("assets/themes/default/js/utilcarousel-files/magnific-popup/jquery.magnific-popup.js", function(data, textStatus, jqxhr){ }); 
			jQuery.getScript("assets/themes/default/js/jquery.mixitup.js", function(data, textStatus, jqxhr){ }); 
			jQuery.getScript("assets/themes/default/js/kairosodeum-load-up.js", function(data, textStatus, jqxhr){ });  
			jQuery.getScript("assets/themes/default/js/kairosodeum-load-down.js", function(data, textStatus, jqxhr){ });
					}
		</script>
<script type='text/javascript' src='assets/plugins/contact-form-7/includes/js/jquery.form.mind03d.js?ver=3.51.0-2014.06.20'></script>
<script type='text/javascript' src='assets/plugins/contact-form-7/includes/js/scripts4906.js?ver=4.7'></script>
<script type='text/javascript' src='assets/themes/default/js/kairosodeum-ui.js'></script>
<script type='text/javascript' src='assets/themes/default/js/bootstrap.js'></script>
<script type='text/javascript' src='assets/themes/default/js/utilcarousel-files/utilcarousel/jquery.utilcarousel.min.js'></script>
<script type='text/javascript' src='assets/themes/default/js/utilcarousel-files/magnific-popup/jquery.magnific-popup.js'></script>
<script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false'></script>
<script type='text/javascript' src='assets/themes/default/js/kairosodeum-fixed.js'></script>
<script type='text/javascript' src='assets/themes/default/js/kairosodeum-fixed-down.js'></script>
<script type='text/javascript' src='assets/themes/default/js/jquery.mixitup.js'></script>
<script type='text/javascript' src='assets/themes/default/js/kairosodeum-load-up.js'></script>
<script type='text/javascript' src='assets/themes/default/js/kairosodeum-load-down.js'></script>
<script type='text/javascript' src='wp-includes/js/wp-embed.min.js?ver=4.7.5'></script>
</body>
</html>
