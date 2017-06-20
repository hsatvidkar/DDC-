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
		WOW init
     --------------------------------------------- */
    if (typeof WOW == "function")
    new WOW().init();
	
})(jQuery);