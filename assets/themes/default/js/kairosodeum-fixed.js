// SIDEBAR OPTIONS
$(document).ready(function () {
	// SIDEBAR OPEN
	$(".kairosodeum-btn-sidebar").click(function () {
		$('body').addClass('body-over');
	  	$(".kairosodeum-menu-icon, .kairosodeum-search-icon").animate({opacity: '0'}, 400, 'easeInOutExpo');
	  	$(".kairosodeum-nav-fixed-mobil").css({top: '-120px'});
	  	$('.kairosodeum-body').addClass('body-lock');
	  	$(".body-lock").animate({opacity: '0.5', zIndex: 999}, 600, 'easeInOutExpo');
	  	$(".kairosodeum-sidebar-menu").animate({right: '0'}, 800, 'easeInOutExpo');
	});

	// SIDEBAR CLOSE
	$("#content, .kairosodeum-sidebar-closed, .kairosodeum-body").click(function () {
		$('body').removeClass('body-over');
		$(".kairosodeum-sidebar-menu").animate({right: '-450'}, 400, 'easeInOutExpo');
		$(".body-lock").animate({opacity: '0'}, 600, 'easeInOutExpo');
		$('.kairosodeum-body')
		   .delay(600)
		   .queue(function() {
		       $(this).removeClass("body-lock");
		       $(this).dequeue();
		});
		$(".kairosodeum-nav-fixed-mobil").css({ top: '0'});
		$(".kairosodeum-menu-icon, .kairosodeum-search-icon").animate({ opacity: '0.9'}, 600, 'easeInOutExpo');
	});

	// SEARCH OPEN
	$(".kairosodeum-btn-search").click(function () {
	   $(".kairosodeum-top-search").animate({top: '100px'}, 600, 'easeInOutExpo');
	   $(".kairosodeum-menu-icon, .kairosodeum-search-icon").animate({opacity: '0'}, 600, 'easeInOutExpo');
	});

	// SEARCH CLOSE
	$("#content").click(function () {
	   $(".kairosodeum-menu-icon, .kairosodeum-search-icon").animate({opacity: '0.9'}, 700, 'easeInOutExpo');
	   $(".kairosodeum-top-search").animate({top: '-120px'}, 500, 'easeInOutExpo');
	});

	// SEARCH ENTER CLOSE
	$('#searchform').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
    	$(".kairosodeum-menu-icon").animate({opacity: '0.9'}, 500, 'easeInOutExpo');
	   	$(".kairosodeum-top-search").animate({top: '-120px'}, 300, 'easeInOutExpo');
    }
	});
});

// VIDEO FIXED
var $allVideos = $("iframe[src^='//player.vimeo.com'], iframe[src^='//www.youtube.com'], object, embed"),
	$fluidEl = $("body");
	$allVideos.each(function() {
	  $(this)
	    .data('aspectRatio', this.height / this.width)
	    .removeAttr('height')
	    .removeAttr('width');

	});
	$(window).resize(function() {
	  var newWidth = $fluidEl.width();
	  $allVideos.each(function() {
	    var $el = $(this);
	    $el
	      .width(newWidth)
	      .height(newWidth * $el.attr('aspectRatio'));

	  });
	}).resize();