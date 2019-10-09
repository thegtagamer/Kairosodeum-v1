<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include_once ("../scripts/user_session.php");
include_once '../scripts/DB_connect.php';
if (isset($_SESSION['idx'])) {
    header('Location: ../index.php');
}
$id = $sessionInit_id; // Set the profile owner ID
$error_msg = "";
$errorMsg = "";
$success_msg = "";
$user_type = "";
$cacheBuster = rand(9999999, 99999999999); // Put appended to the image URL will help always show new when changed
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
} // close while loop
if (isset($_POST['email_reset'])) {
    $email = mysqli_real_escape_string($connection, $_POST['email_reset']);
    if ($email != "") {
        $sql_query = mysqli_query($connection, "SELECT * FROM users where email='$email' ");
        $email_check = mysqli_num_rows($sql_query);
        if ($email_check > 0) {
            $email_cut = substr($email, 0, 2);
            $gen_rand = rand();
            $temp = "$email_cut$gen_rand";
            $hash = md5($temp);
            @mysqli_query($connection, "UPDATE users set password='$hash' where email='$email'");
            $to = "$email";
            $from = "info@kairosodeum.com";
            $subject = 'Password Reset';
            $message = "Hello there, 
      Your KairosOdeum password has been successfully changed, You can login to your KairosOdeum account using these new credintials.

      Email: $email,
      Password: $temp";
            //end of message
            $headers = "From: $from\r\n";
            $headers.= "Content-type: text\r\n";
            mail($to, $subject, $message, $headers);
            $Successmsg = 'Your request has been registered, We will reach out to you soon through your email - Team kairosodeum';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en-US" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<title>#About Us #KairosOdeum</title>

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

	




    
        <!-- SIDEBAR OPTIONS -->
    <div class="kairosodeum-sidebar-menu kairosodeum-sidebar-menu-two">
      <!-- TAB MENU -->
            <div class="kairosodeum-sidebar-tab">
        <ul>
                      <li class="active">
              <a href="#sidebarmenu" data-toggle="tab">
                <span class="kairosodeum-btn-tab-sidebar">
                                      Login                                 </span>
              </a>
            </li>
          
                      <li  >
              <a href="#sidebarwidget" data-toggle="tab">
                <span class="kairosodeum-btn-tab-sidebar">
                                      Sign Up                               </span>
              </a>
            </li>
                  </ul>
        <div class="clearfix"></div>
        <div class="hidden-md hidden-lg kairosodeum-sidebar-closed">
          <span class="btn btn-block btn-lg btn-success">
            <i class="fa fa-times"></i> Close         </span>
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
            <form action="../index.php" method="post" enctype="application/data">
<div class="form-group " style="width: 220px">
  <label for="email">Email</label>
  <input type="text" class="form-control" id="email" name="email" placeholder="Email">
</div>
<div class="form-group" style="width: 220px">
  <label for="password">Password</label>
  <input type="password" class="form-control" name="pass" placeholder="Password">
</div>
<a href="../forgot/" class="forgot_link">forgot ?</a>
<button type="submit" class="login-action" style="width: 180px; margin-left: -20px">Sign in</button>
</form>
</div>
</div>

  

</div>          </div>
        
                  <!-- #2 -->
          <div class="tab-pane" id="sidebarwidget">

            <div class="kairosodeum-dark-widget">
    

<h5>Start your journey</h5>

<div class="signbox">
<form action="../index.php" method="post" enctype="application/data">
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
				<a href="../index.php">
											<img src="../assets/themes/default/images/logo.png" alt="Logo">
									</a>
			</div>
			<div class="kairosodeum-logo hidden-md hidden-lg">
				<a href="../index.php">
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
	





  <div class="clearfix"></div>




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
            <h1>#Forgot Password</h1>
                          <h2>Reset your password</h2>

                          <h2><?php echo $Successmsg; ?> </h2>
                      </div>
        </div>
      
      <div class="clearfix"></div>

              <div  class=" team-showcase kairosodeum-mod-featcon" style="display: block;">
                        
           
     
       
       <div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
        <form role="form" class="sign_up_form" method="post" action="index.php" enctype="multipart/form-data">
          <h2 class="sign_up_title">Reset password</h2>
          <p>Enter your email address we will send you new password details.</p>
          <div class="form-group">
            <input type="email" name="email_reset" id="email_reset" class="form-control input-lg" placeholder="Email address" tabindex="4">
          </div>
          <div class="row">
            <div class="col-xs-12 col-md-12"><input type="submit" class="btn btn-success btn-block btn-lg" value="Reset"></div>
          </div>
        </form>
      </div>
    </div>
</div>
      







          
           
        
          </div>
  </div>
</div>
</div>


 <div class="clearfix"></div>


			 
				
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
		<div id="gallery" class="container-fluid kairosodeum-mod-newsblog kairosodeum-container kairosodeum-mod-grey ">
			<div class="container">
				<div class="row">
					<div class="col-md-12">

					<div class="clearfix"></div>

													<div class="kairosodeum-contact-form">
								<div class="row">
									





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