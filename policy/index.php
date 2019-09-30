<?php
error_reporting(E_ALL);
ini_set("display_errors", 0);
// include_once("../scripts/user_session.php");
// include_once '../scripts/DB_connect.php';

$id = $sessionInit_id; // Set the profile owner ID
$error_msg = ""; 
$errorMsg = "";
$success_msg = "";

$user_type="";
$cacheBuster = rand(9999999,99999999999); // Put appended to the image URL will help always show new when changed





$sql_default = mysqli_query($connection, "SELECT * FROM users WHERE id='$id'");
while($row = mysqli_fetch_array($sql_default)){ 
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
<?php echo $success_msg;?> 
<!DOCTYPE html>
<html lang="en-US" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<title>#Privacy Policy #KairosOdeum</title>

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

	

</div>					</div>
				
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
}else{
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
            <h1>Privacy Policy</h1>
                          <!--<h2>Who we are</h2>-->
                      </div>
        </div>
      
      <div class="clearfix"></div>

              <div  class=" team-showcase kairosodeum-mod-featcon" style="display: block;">
                        
           
     
       
          <div class="col-sm-12"><center><p><small>We at Kairos Odeum(“<b>KairosOdeum</b>”, “<b>we</b>”, “<b>our</b>” or “<b>us</b>”) are committed to respecting the privacy rights of visitors and other users (“<b>user(s)</b>”, “<b>you</b>” or “<b>your</b>”) of our mobile application and website (“<b>Site</b>”) take appropriate measures to safeguard it. This privacy policy (“<b>Privacy Policy</b>”, “<b>Policy</b>”) describes our practices regarding the collection, use, disclosure, retention, and protection of your information.
This Policy covers the information collected through our Site, mobile application, software, tools and other application services (“<b>Services</b>”), and is applicable to the Site/mobile application, and not to any other websites that you may be able to access from the Site/mobile applications, each of which may have data collection and use practices and policies that differ materially from this Policy.
This policy is a part of our Terms of Use. By registering for, using or accessing our Services, you agree to the terms of this Privacy Policy and all other KairosOdeum policies governing the use of the Site/mobile application and you expressly consent to the collection, use and disclosure of your information in accordance with this Privacy Policy. Please read the Policy carefully. If you do not agree to be bound by such terms and conditions, you are not authorized to access or use the Services or access KairosOdeum website or mobile application.<br><br>
<b><h3>Information Collection and Use</h3></b><br>
In order to process your request and provide services and features that most likely meet your needs, we need certain information and details. The types of personal information collected at these pages are name, address, e-mail address, phone number and/or credit/debit card details information.<br>
Some of the information required by us is mandatory, and we may not be able to complete the registration process in case you do not provide such information. Where possible, we indicate which fields are required and which fields are optional, in order to complete your registration with us. <br><br
><b><h3><small><b>We may collect following information about you:</b></small></h3><br>
i)  Personal Information Provided by the User</b><br>
We collect personal information from you when you use our Site/mobile application, or give us in any other way, including your name, physical address, phone number, email address, and payment information. The type of information that we collect from you is used to confirm your identity, contact you and provide you a smooth user experience with our Services. KairosOdeum takes appropriate measures to encrypt the credit/debit card information in the system, and this information is used only for payment purposes.<b>
ii) Information About Your Interaction With Our Site /mobile application
</b><br>The type of information that we collect from you depends on your particular interaction with our Site/mobile application and Services as a buyer or seller.<br>
As a seller, we may collect information about products/ services listed or advertised by you through your profile at KairosOdeum, information about your customers that you share with us or that customers provide while shopping/making booking, from our Site/mobile application.<br>
As a buyer, we collect information such as the purchases you make or the advertisements you view at our Site/mobile application, your purchasing and browsing patterns.<br>
<b>
iii)  Transactional information</b><br>
In connection with your subscription to and use of our Services, payment details, bank account numbers, billing and delivery information, credit/debit card data including card number and expiry date in encrypted form, details for net banking services and tracking information from cheques or online transfers may be collected to facilitate the transaction.<br>
<b>
iv) Automated collection</b><br>
We and our third party service providers, use cookies, web beacons, and other tracking technologies to collect information about you automatically as you use our features and Services. This type of information includes but is not limited to, internet protocol (IP) addresses as well as browser type, internet service provider, operating system or domain name, browsing patterns, locale and language preferences, number of sessions and unique visitors, usage data and system configuration information, third party links accessed by you etc.<br><b>
v)  Information from Other Sources</b>
When you use support, feedback and other interactive features provided by us we will collect your hardware, software, and other communication details that you provide to us. We use this information to provide customer support, resolve disputes, and troubleshoot problems as permitted by law.<br><br>
<b><h3><small><b>Cookies and Analytic Tools</b></small></h3></b><br>
We use tools and tracking technologies such as cookies and third-party web analytics services on our Site/mobile application (such as those of Google Analytics to identify you as an individual user of this Site/mobile application). Cookies are small bits of data stored on user’s browser that capture small pieces of information while online content is accessed. You may refuse the use of cookies by selecting the appropriate settings on your browser. However, please note that if you do this, you may not be able to use the full functionality of this Site/mobile application.<br>
We use cookies and analytics to a) gather statistical information about usage of our Services; b) personalise your visits to this Site/mobile application; c) enable us to improve the content, reliability and functionality and make our Site/mobile application more convenient and useful to you; and d) understand your preferences and improve our Services accordingly to provide you with the best Services suited to your interests.<br>
<b><h3><small><b>Usage of Information</b></small></h3></b><br>
We primarily use your information to provide our Services to you and to facilitate the functioning of the Site/mobile application. In addition, information submitted to us when you register for our Services and use the features provided by us may be used for following general purposes:<br>
i)  to verify your identity and eligibility to register as a user and subscribe to our Services;<br>
ii) to facilitate your transactions, and to identify you when you log into your account on our Site/mobile application;
ii) to improve our marketing and promotional efforts, to analyze Site/mobile application usage, improve the Site's or mobile application’s content and product offerings, and customize the Site's or mobile application’s content, layout, and Services;<br>
iii)  to perform data analysis and statistical analysis through our tools to improve security features and determining what new features and content to prioritize;<br>
iii)  to deliver and personalize our communications with you, to notify you about any changes or modifications to our Site/mobile application, or terms and conditions;<br>
iv) to measure consumer interest in our products and Services, inform you about online and offline offers, products, services, and updates<br>
v)  to identify and protect against any fraud or other criminal activity, and comply with and enforce applicable legal requirements.<br>
vi) to respond quickly and efficiently to any queries, feedback, claims or disputes;<br><br>
Our primary purpose in collecting personal information is to provide you with a safe, smooth, efficient, and customized experience. You agree that we may use your information in other ways for which we may notify you at the time of collection. Your privacy is important to us and we have taken steps to ensure that we do not collect more information from you than is necessary for us to provide you with our Services and to protect your account.<br><br><b><h3><small><b>Information Disclosures and Onward Transfers
</b></small></h3></b><br>
We do not share your personal information with third parties, except as described in this Policy. We may share your personal information to our partners, affiliates and third parties to help us assess your interest in our products and Services; to process payments made to us and assist with product/service fulfillment and other operations; and to help detect and prevent identity theft, fraud and other potentially illegal acts.<br>
We may also use or disclose your personal information if required to do so by law or in the good faith belief that such disclosure is reasonably necessary to (i) conform to applicable laws or comply with legal process; (ii) protect and defend our rights or property of the Site/mobile application or our users; or (iii) protect the personal safety of users of the Site/mobile application or the public.<br>
We and our affiliates will share or sell some or all of your personal information with another business entity should we (or our assets) plan to merge with, or be acquired by that business entity, or re-organization, amalgamation, restructuring of business. Should such a transaction occur that other business entity (or the new combined entity) will be required to follow this privacy policy with respect to your personal information.<br>
Access to only as much information is made available as is reasonably necessary or required by law. These third parties are not authorized by us to use or disclose the information except as necessary to perform Services on our behalf. In some cases, we may provide personal information to a third party only if that third party agrees to provide adequate protections for your privacy interests that are no less protective than those set out in this Privacy Policy, and to use the personal information only for the purposes for which the third party has been engaged by KairosOdeum.<br>
We never use or share the personal information provided to us in ways unrelated to the ones described above without your consent or without providing you an opportunity to opt out or otherwise prohibit such unrelated uses.<br><br><b><h3><small><b>Third Party Service Providers
</b></small></h3></b>
To enable us to more efficiently provide the products and Services you have requested from us, we may share your personal information with selected third parties that act on our behalf as our agents, suppliers, or providers, or these third parties may collect your personal information on our behalf. The access to a third party link provided by our Services does not imply endorsement of the linked site by us or by our affiliates. Any information that you provide through the links to any third party sites will be subject to the privacy policy of that site, and you should read the relevant privacy policy for those third party sites before responding to any offers, services, or submitting any data. <br>
We are not responsible for the content of such third party sites, or the manner in which those sites collect, store, use, and distribute any personal information you provide.<br><br><b><h3><small><b>Security Precautions
</b></small></h3></b>
We have stringent security measures in place to protect the loss, misuse, and alteration of the information under our control. We at KairosOdeum ensure to protect your information by taking appropriate measures to safeguard against unauthorized disclosures of information and encrypting the transmission of information using commercially reasonable methods. Any payment transactions or any other sensitive information is encrypted.<br> 
Despite these protections, however, we cannot guarantee that information, during transmission through the Internet or while stored on our systems or otherwise in our care, will be absolutely safe from intrusion by others. You should take measures to protect your personal information. Safety and security of your information also depends on you, and we recommend you to keep your password confidential, and not to divulge any information related to your account to anyone. You hereby acknowledge that any transmission over the Internet and any submission by you is at your own risk and responsibility, and you shall not hold KairosOdeum responsible in any manner whatsoever.<br><br><b><h3><small><b>Your Rights and Choices
</b></small></h3></b>
In many instances, you have choices about the information you provide and limiting how we use your information. You can access all your personally identifiable information that we collect online and maintain by emailing us at official@kairosodeum.com . You may change, update, or correct your account information and email preferences by logging into your account anytime. If you are unable to change your personal information within your account settings, please contact us to make the required changes. You may also opt out of receiving promotional communications from KairosOdeum or opt-out of sharing your personal information with third parties by emailing us about the same. <br>
In case of cancellation or deletion of your account, please note that removed information may persist in backup copies for a reasonable period of time. If your account is managed by an administrator, that account administrator may have control with regards to how your account information is retained and deleted. Please remember any content that has been shared by you or submitted to any third party link provided via the Services may continue to be available to third parties and the public at large.<br> <br><b><h3><small><b>Your Use of Our Services
</b></small></h3></b>
You agree that you will not violate any l0aws in connection with your use of the Services. As a seller, it is your responsibility to obtain any permits or licenses that are required to list or sell your services/products on our Site/mobile application, and you agree not to commit fraud, theft or any other crimes against KairosOdeum, another KairosOdeum user or a third party.<br>
As a buyer, you are responsible for all payments in connection to your purchases from our Site/ mobile application. You agree to take appropriate measures and precautions to verify the genuineness of services/products, listed on our Site/mobile application before placing your order.<br>
You agree not to interfere with or try to disrupt our Services, for example by distributing a virus or other harmful computer code. You are also solely responsible for collecting and/or paying any applicable taxes for any purchases or sales you make through our Services.<br><br><b><h3><small><b>Updates to Our Privacy Policy
</b></small></h3></b>
We reserve the right to change our Privacy Policy and our Terms of Use at any time. Unless stated otherwise, our current Privacy Policy applies to all information that we have about you and your account. Such changes, modifications, additions or deletions shall be effective immediately upon our notification to you about such changes or posting the revised Policy on our Site/mobile application, and your continued use of our Services after such modifications shall constitute your acceptance to the revised Policy terms. It is your responsibility to review this Policy from time to time to ensure that you continue to agree with all of its terms.<br><br>
<b><h3><small><b>Children’s Privacy
</b></small></h3></b>
KairosOdeum is intended for users ages 18 and older only. If you are a minor i.e. under the age of 18 years, you shall not register as a user of the KairosOdeum and shall not transact on or use KairosOdeum. In an event, where a person below the age of 18 uses the Services, KairosOdeum shall not be held liable or responsible for any damage or injury suffered by such person by making use of the Services.<br>
<h1><small><b>
Contact Us</b></small></h1><br>
If you have any questions or comments about this Policy or our practices related to this Site/mobile application, you can contact us by email at official@kairosodeum.com or you can write to us at:<br>
Details of Grievance Officer: <b>Mr. Maatul Singha</b><br>
Contact details:-<br>
<b>
Kairos Odium</b>
Block B5, GF-03,<br>
Nirmal ChayyaTowers,<br>
VIP Road, Zirakpur, Punjab (140603)<br>
Phone: +91-9816917131<br>
Email: official@kairodeum.com 
</small></p></center></div>







          
           
        
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
