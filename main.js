/* ---------------------------------------------
 common scripts
 --------------------------------------------- */

;(function () {

    "use strict"; // use strict to start
	
	/* ---------------------------------------------
		Custom Scrollbar for site
     --------------------------------------------- */
    var mainBody = $("html").niceScroll({
        cursorwidth: 8,
        cursorborder: "10px solid #fff",
        cursorborderradius: '25px',
		cursoropacitymin:1,
    });

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