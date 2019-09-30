<?php
error_reporting(E_ALL);
ini_set("display_errors", 0);
include_once ("../scripts/user_session.php");
include_once '../scripts/DB_connect.php';
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

?>
<?php echo $success_msg; ?> 
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

					<? } ?>
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
	


<div id="component" class="component component-fullwidth fxStickIt">

      <ul class="itemwrap">

            <li class="current" style="background-image: url(../assets/themes/default/images/Main-Slide6.jpg);">
                <div class="kairosodeum-slidertitle">
                                          <h1>What we do </h1><h1>Its important</h1>
                                                              <h2>For you to know!</h2>
                                                             <!-- <div class="kairosodeum-slider-button">
                      <a href="/about" class="btn btn-lg btn-success">
                        Explore                 </a>
                    </div>-->
                                </div>
                <img src="../assets/themes/default/images/Main-Slide6.jpg)" alt="Slider">
            </li>


                 
                </ul>
   
  </div>



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
            <h1>#About Us</h1>
                          <h2>Who we are</h2>
                      </div>
        </div>
      
      <div class="clearfix"></div>

              <div  class=" team-showcase kairosodeum-mod-featcon" style="display: block;">
                        
           
     
       
        <p>“Kairos Odeum” - A string that connects; musical ability, artistic integrity, love and passion for music! ‘Kairos Odeum’, is a Greek word with ‘Kairos’ meaning ‘Opportune moment’ and ‘Odeum’ meaning ‘a platform for musical performance’. Thus, Kairos Odeum is born; a platform that gives the budding and established Indian musicians alike, a platform to play and perform on their own terms, giving you full access to gigs in just a few simple clicks.
        Previously, if a band had to perform, it had to approach the platform, agree on performance conditions, negotiate prices, give a sample of their performance and then maybe, just maybe it got the chance to perform… Now think! By making a simple profile and updating it, you get the gigs you deserve, at your preferred locations, on your terms and, more importantly at your price! All you have to do is sign up, upload your videos and maintain your profile.
        Seems utopian? Well, wake up and smell the coffee because Kairos Odeum gives you the stage for this, assuring you gigs with a few clicks.
        Just wait and see how Kairos Odeum turn your musical journey into silver screen performances!
        </p>
     
      







          
           
        
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


             <div class="col-md-12" style="margin-bottom: 40px;">
          <div class="kairosodeum-mod-title">
            <h1>#Our Team</h1>
                          <h2>Who are always there for you</h2>
                      </div>
        </div>



<!--Team -->


<div class="container" >
    <div class="clearfix"></div>

  <div class="at-section">

  </div>
  <div class="at-grid" data-column="3" >
    <div class="at-column">
      <div class="at-user">
        <div class="at-user__avatar"><img src="../assets/themes/default/images/arnav.jpg"/></div>
        <div class="at-user__name">Arnav Batra</div>
        <div class="at-user__title">CEO & Founder</div>
       
      </div>
    </div>
    <!--<div class="at-column">
      <div class="at-user">
        <div class="at-user__avatar"><img src="https://s3.amazonaws.com/uifaces/faces/twitter/rem/128.jpg"/></div>
        <div class="at-user__name">Marco Gomez</div>
        <div class="at-user__title">Co-Founder, Creative Director</div>
        <ul class="at-social">
          <li class="at-social__item"><a href="">
              <svg viewBox="0 0 24 24" width="18" height="18" xmlns="http://www.w3.org/2000/svg">
                <path d="M14 9h3l-.375 3H14v9h-3.89v-9H8V9h2.11V6.984c0-1.312.327-2.304.984-2.976C11.75 3.336 12.844 3 14.375 3H17v3h-1.594c-.594 0-.976.094-1.148.281-.172.188-.258.5-.258.938V9z" fill-rule="evenodd"></path>
              </svg></a></li>
          <li class="at-social__item"><a href="">
              <svg viewBox="0 0 24 24" width="18" height="18" xmlns="http://www.w3.org/2000/svg">
                <path d="M20.875 7.5v.563c0 3.28-1.18 6.257-3.54 8.93C14.978 19.663 11.845 21 7.938 21c-2.5 0-4.812-.687-6.937-2.063.5.063.86.094 1.078.094 2.094 0 3.969-.656 5.625-1.968a4.563 4.563 0 0 1-2.625-.915 4.294 4.294 0 0 1-1.594-2.226c.375.062.657.094.844.094.313 0 .719-.063 1.219-.188-1.031-.219-1.899-.742-2.602-1.57a4.32 4.32 0 0 1-1.054-2.883c.687.328 1.375.516 2.062.516C2.61 9.016 1.938 7.75 1.938 6.094c0-.782.203-1.531.609-2.25 2.406 2.969 5.515 4.547 9.328 4.734-.063-.219-.094-.562-.094-1.031 0-1.281.438-2.36 1.313-3.234C13.969 3.437 15.047 3 16.328 3s2.375.484 3.281 1.453c.938-.156 1.907-.531 2.907-1.125-.313 1.094-.985 1.938-2.016 2.531.969-.093 1.844-.328 2.625-.703-.563.875-1.312 1.656-2.25 2.344z" fill-rule="evenodd"></path>
              </svg></a></li>
          <li class="at-social__item"><a href="">
              <svg viewBox="0 0 24 24" width="18" height="18" xmlns="http://www.w3.org/2000/svg">
                <path d="M19.547 3c.406 0 .75.133 1.031.398.281.266.422.602.422 1.008v15.047c0 .406-.14.766-.422 1.078a1.335 1.335 0 0 1-1.031.469h-15c-.406 0-.766-.156-1.078-.469C3.156 20.22 3 19.86 3 19.453V4.406c0-.406.148-.742.445-1.008C3.742 3.133 4.11 3 4.547 3h15zM8.578 18V9.984H6V18h2.578zM7.36 8.766c.407 0 .743-.133 1.008-.399a1.31 1.31 0 0 0 .399-.96c0-.407-.125-.743-.375-1.009C8.14 6.133 7.813 6 7.406 6c-.406 0-.742.133-1.008.398C6.133 6.664 6 7 6 7.406c0 .375.125.696.375.961.25.266.578.399.984.399zM18 18v-4.688c0-1.156-.273-2.03-.82-2.624-.547-.594-1.258-.891-2.133-.891-.938 0-1.719.437-2.344 1.312V9.984h-2.578V18h2.578v-4.547c0-.312.031-.531.094-.656.25-.625.687-.938 1.312-.938.875 0 1.313.578 1.313 1.735V18H18z" fill-rule="evenodd"></path>
              </svg></a></li>
        </ul>
      </div>
    </div>
    <div class="at-column">
      <div class="at-user">
        <div class="at-user__avatar"><img src="https://s3.amazonaws.com/uifaces/faces/twitter/boheme/128.jpg"/></div>
        <div class="at-user__name">Brad Joe</div>
        <div class="at-user__title">Office Manager</div>
        <ul class="at-social">
          <li class="at-social__item"><a href="">
              <svg viewBox="0 0 24 24" width="18" height="18" xmlns="http://www.w3.org/2000/svg">
                <path d="M14 9h3l-.375 3H14v9h-3.89v-9H8V9h2.11V6.984c0-1.312.327-2.304.984-2.976C11.75 3.336 12.844 3 14.375 3H17v3h-1.594c-.594 0-.976.094-1.148.281-.172.188-.258.5-.258.938V9z" fill-rule="evenodd"></path>
              </svg></a></li>
          <li class="at-social__item"><a href="">
              <svg viewBox="0 0 24 24" width="18" height="18" xmlns="http://www.w3.org/2000/svg">
                <path d="M20.875 7.5v.563c0 3.28-1.18 6.257-3.54 8.93C14.978 19.663 11.845 21 7.938 21c-2.5 0-4.812-.687-6.937-2.063.5.063.86.094 1.078.094 2.094 0 3.969-.656 5.625-1.968a4.563 4.563 0 0 1-2.625-.915 4.294 4.294 0 0 1-1.594-2.226c.375.062.657.094.844.094.313 0 .719-.063 1.219-.188-1.031-.219-1.899-.742-2.602-1.57a4.32 4.32 0 0 1-1.054-2.883c.687.328 1.375.516 2.062.516C2.61 9.016 1.938 7.75 1.938 6.094c0-.782.203-1.531.609-2.25 2.406 2.969 5.515 4.547 9.328 4.734-.063-.219-.094-.562-.094-1.031 0-1.281.438-2.36 1.313-3.234C13.969 3.437 15.047 3 16.328 3s2.375.484 3.281 1.453c.938-.156 1.907-.531 2.907-1.125-.313 1.094-.985 1.938-2.016 2.531.969-.093 1.844-.328 2.625-.703-.563.875-1.312 1.656-2.25 2.344z" fill-rule="evenodd"></path>
              </svg></a></li>
          <li class="at-social__item"><a href="">
              <svg viewBox="0 0 24 24" width="18" height="18" xmlns="http://www.w3.org/2000/svg">
                <path d="M19.547 3c.406 0 .75.133 1.031.398.281.266.422.602.422 1.008v15.047c0 .406-.14.766-.422 1.078a1.335 1.335 0 0 1-1.031.469h-15c-.406 0-.766-.156-1.078-.469C3.156 20.22 3 19.86 3 19.453V4.406c0-.406.148-.742.445-1.008C3.742 3.133 4.11 3 4.547 3h15zM8.578 18V9.984H6V18h2.578zM7.36 8.766c.407 0 .743-.133 1.008-.399a1.31 1.31 0 0 0 .399-.96c0-.407-.125-.743-.375-1.009C8.14 6.133 7.813 6 7.406 6c-.406 0-.742.133-1.008.398C6.133 6.664 6 7 6 7.406c0 .375.125.696.375.961.25.266.578.399.984.399zM18 18v-4.688c0-1.156-.273-2.03-.82-2.624-.547-.594-1.258-.891-2.133-.891-.938 0-1.719.437-2.344 1.312V9.984h-2.578V18h2.578v-4.547c0-.312.031-.531.094-.656.25-.625.687-.938 1.312-.938.875 0 1.313.578 1.313 1.735V18H18z" fill-rule="evenodd"></path>
              </svg></a></li>
        </ul>
      </div>
    </div>
    -->


  </div>
</div>

<!-- Team End -->






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