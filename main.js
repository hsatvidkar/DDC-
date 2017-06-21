/* ---------------------------------------------
 common scripts
 --------------------------------------------- */

;(function () {

    "use strict"; // use strict to start

	/* ---------------------------------------------
		tb preloader init
     --------------------------------------------- */
    $(window).on('load', function() {
        $("body").imagesLoaded(function(){
            $(".tb-preloader-wave").fadeOut();
            $("#tb-preloader").delay(200).fadeOut("slow").remove();
        });
    });
	
	/* ---------------------------------------------
		Custom Scrollbar for site
     --------------------------------------------- */
    var mainBody = $("html").niceScroll({
		cursorwidth: 4,
		cursorborder: "4px solid #F7484E",
		cursorborderradius: '25px',
		cursoropacitymin:1,
    });
	
	/* ---------------------------------------------
		Sticky Header
     --------------------------------------------- */
	$(window).scroll(function() {
		if ($(this).scrollTop() > 0){  
			$('header').addClass("sticky");
		}
		else{
			$('header').removeClass("sticky");
		}
	});
	
	/* ---------------------------------------------
		Main Menu
     --------------------------------------------- */
	$(document).ready(function () {
		$('.navbar-nav li.expanded').removeClass('expanded');
		$('.navbar-nav li.first').removeClass('first');
		$('.navbar-nav li.leaf').removeClass('leaf');
		$('.navbar-nav li.last').removeClass('last');
		$('.navbar-nav li.active-trail').removeClass('active-trail');
	});
		
	/* ---------------------------------------------
		Hamburger Animation
     --------------------------------------------- */
	$(document).ready(function () {
		$(".navbar-toggle").on("click", function () {
			$(this).toggleClass("active");
		});
	});
	
	/* ---------------------------------------------
		Carousel slider
     --------------------------------------------- */
	 
	/*$(document).ready(function () {
		$('.carousel').carousel({
			interval: 4000
		});
	});*/
	
	$(document).ready(function(){
		var percent = 0, bar = $('.transition-timer-carousel-progress-bar'), crsl = $('#views-bootstrap-carousel-1');
		function progressBarCarousel() {
			bar.css({width:percent+'%'});
			percent = percent +0.5;
			if (percent>100) {
				percent=0;
				crsl.carousel('next');
			}      
		}
		crsl.carousel({
			interval: false,
			pause: true
		}).on('slid.bs.carousel', function () {});var barInterval = setInterval(progressBarCarousel, 30);
		crsl.hover(
			function(){
				clearInterval(barInterval);
			},
			function(){
				barInterval = setInterval(progressBarCarousel, 30);
			}
		)
    });
	
	/* ---------------------------------------------
		WOW init
     --------------------------------------------- */
    if (typeof WOW == "function")
    new WOW().init();
	
})(jQuery);