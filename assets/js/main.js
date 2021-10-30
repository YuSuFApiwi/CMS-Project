/*
Coding Name: Youssef Apiwi
Website : www.Apiwi-multimedia.com
*/

/*==========
----- JS INDEX -----
1.Whole Script Strict Mode Syntax
2.Loader JS
3.Wow Animation JS
4.Smooth Scrolling JS
5.Scroll To Top JS
6.Sticky Header JS
7.Toogle Menu Mobile JS
8.Search Form JS
9.Menu Bar JS
10.Banner Slider JS
11.Testimonial Slider JS
12.Portfolio Slider JS
13.Team Slider JS
14.Blog Post Slider JS
15.Submenu For Mobile JS
16.Pricing Plans Slider For Mobile JS
17.Team Page Slider For Mobile JS
18.Pricing Switch JS
19.Portfolio Tabbing JS
20.Magnific Popup
21.Light Gallery
==========*/



$(document).ready(function($) {

	// Whole Script Strict Mode Syntax
	"use strict";

	// Loader JS Start
	$(window).ready(function(){
		$('.loader-box').fadeOut();
		$('body').removeClass('fixed');
   });
	// Loader JS End

	// Wow Animation JS Start
	new WOW().init(); 
	// Wow Animation JS Start

	// Smooth Scrolling JS Start
	$('a[href*=\\#]:not([href$=\\#])').on('click',function(e) {
		e.preventDefault();
		var offset = 100;
		var target = this.hash;
		if ($(this).data('offset') != undefined) offset = $(this).data('offset');
		$('html, body').stop().animate({
			'scrollTop': $(target).offset().top - offset
		}, 800, 'swing', function() {
			// window.location.hash = target;
		});
	});
	// Smooth Scrolling JS End

	// Scroll To Top JS Start
	$('#scroll-to-top').on('click', function() {
        $("html, body").animate({ scrollTop: 0 }, 800);
        return false;
    });
	$(window).on( 'scroll', function() {
	  if ($(window).scrollTop() > 300) {
	    $("#scroll-to-top").fadeIn(500);
	  } else {
	    $("#scroll-to-top").fadeOut(500);
	  }
	});
	// Scroll To Top JS End

	// Sticky Header JS Start
	$(window).on( 'scroll', function(){
	  if ($(window).scrollTop() >= 100) {
	    $('.site-header').addClass('sticky-header');
	   }
	   else {
	    $('.site-header').removeClass('sticky-header');
	   }
	});
	// Sticky Header JS End

	// Toogle Menu Mobile JS Start
	$(".toggle-button").on( 'click', function(){
		$(".main-navigation").toggleClass('toggle-menu');
		$(".header-menu .black-shadow").fadeToggle();
	});
	$(".main-navigation ul li a").on( 'click', function(){
		$(".main-navigation").removeClass('toggle-menu');
		$(".header-menu .black-shadow").fadeOut();
	});
	$(".main-navigation ul li.sub-items>a").on( 'click', function(){
		$(".main-navigation").addClass('toggle-menu');
		$(".header-menu .black-shadow").stop();
	});
	$(".header-menu .black-shadow").on( 'click', function(){
		$(this).fadeOut();
		$(".main-navigation").removeClass('toggle-menu');
	});
	// Toogle Menu Mobile JS End

	// Search Form JS Start
	$(".search-icon a").on( 'click', function(){
		$(".search-input input").focus();
	});
	// Search Form JS End

	// Menu Bar JS Start
	$(".extra-menu-icon a, .search-icon a").on( 'click', function(){
		$(".extra-menu-info").addClass('active');
		$(".extra-menu .black-shadow").fadeIn();
	});
	$(".extra-menu .black-shadow, .close-extra-menu").on( 'click', function(){
		$(".extra-menu .black-shadow").fadeOut();
		$(".extra-menu-info").removeClass('active');
	});
	// Menu Bar JS End

	// Banner Slider JS Start
	$('.banner-slider').slick({
	  infinite: true,
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  prevArrow: '<button class="slick-arrow prev-arrow"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
	  nextArrow: '<button class="slick-arrow next-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
	  arrows: false,
	  dots: false,
	  fade: true,
	  speed: 3000,
	  autoplay: true,
	  autoplaySpeed: 5000,
	  responsive: [
  	  {
  	  	breakpoint: 1200,
  	  	settings: {
  	  		slidesToShow: 1,
  	  	}
  	  }
    ]
	});
	// Banner Slider JS End

	// Testimonial Slider JS Start
	$('.testimonial-slider').slick({
	  infinite: true,
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  prevArrow: '<button class="slick-arrow prev-arrow"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
	  nextArrow: '<button class="slick-arrow next-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
	  dots: true,
	  arrows: false,
	  autoplay: true,
	  autoplaySpeed: 2000,
	  responsive: [
  	  {
  	  	breakpoint: 992,
  	  	settings: {
  	  		slidesToShow: 1,
  	  	}
  	  },
  	  {
  	  	breakpoint: 768,
  	  	settings: {
  	  		slidesToShow: 1
  	  	}
  	  }
    ]
	});
	// Testimonial Slider JS End

	// Portfolio Slider JS Start
	$('.project-slider').slick({
	  infinite: true,
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  prevArrow: '<button class="slick-arrow prev-arrow"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
	  nextArrow: '<button class="slick-arrow next-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
	  arrows: false,
	  dots: false,
	  autoplay: true,
	  autoplaySpeed: 2000,
	  responsive: [
  	  {
  	  	breakpoint: 1200,
  	  	settings: {
  	  		slidesToShow: 1,
  	  	}
  	  }
    ]
	});
	// Portfolio Slider JS End

	// Team Slider JS Start
	$('.team-slider').slick({
	  infinite: true,
	  slidesToShow: 4,
	  slidesToScroll: 1,
	  prevArrow: '<button class="slick-arrow prev-arrow"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
	  nextArrow: '<button class="slick-arrow next-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
	  dots: true,
	  arrows: false,
	  autoplay: true,
	  autoplaySpeed: 2000,
	  responsive: [
  	  {
  	  	breakpoint: 1200,
  	  	settings: {
  	  		slidesToShow: 3,
  	  	}
  	  },
  	  {
  	  	breakpoint: 992,
  	  	settings: {
  	  		slidesToShow: 2
  	  	}
  	  },
  	  {
  	  	breakpoint: 768,
  	  	settings: {
  	  		slidesToShow: 1
  	  	}
  	  }
    ]
	});
	// Team Slider JS End

	// Blog Post Slider JS Start
	$('.blog-post-slider').slick({
	  infinite: true,
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  prevArrow: '<button class="slick-arrow prev-arrow"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
	  nextArrow: '<button class="slick-arrow next-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
	  dots: false,
	  arrows: true,
	  autoplay: true,
	  autoplaySpeed: 2000,
	  responsive: [
  	  {
  	  	breakpoint: 768,
  	  	settings: {
  	  		slidesToShow: 1,
  	  	}
  	  }
    ]
	});
	// Blog Post Slider JS End

	if ($(window).width() < 992) {
		// Submenu For Mobile JS Start
		$('body').on('click', '.main-navigation ul li.sub-items>a', function() {
            if (($(this).parent().hasClass('active-sub-menu'))) {
            $(this).parent().removeClass('active-sub-menu');
            $(this).parent().find('ul').slideUp();
            } else {
                $(this).parent().addClass('active-sub-menu');
                $(this).parent().find('ul').slideDown();
            }
        });
		// Submenu For Mobile JS End

		// Pricing Plans Slider For Mobile JS Start
	   $('.pricing-slider').slick({
		  infinite: true,
		  slidesToShow: 2,
		  slidesToScroll: 1,
		  prevArrow: '<button class="slick-arrow prev-arrow"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
	  	  nextArrow: '<button class="slick-arrow next-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
		  dots: true,
		  arrows: false,
		  autoplay: false,
	  	  autoplaySpeed: 2000,	
	  	  responsive: [
	  	  {
	  	  	breakpoint: 768,
	  	  	settings: {
	  	  		slidesToShow: 1
	  	  	}
	  	  }
	      ]	
	   });
	   // Pricing Plans Slider For Mobile JS End

	   // Team Slider JS Start
		$('.team-mobile-slider').slick({
		  infinite: true,
		  slidesToShow: 4,
		  slidesToScroll: 1,
		  prevArrow: '<button class="slick-arrow prev-arrow"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
		  nextArrow: '<button class="slick-arrow next-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
		  dots: true,
		  arrows: false,
		  autoplay: true,
		  autoplaySpeed: 2000,
		  responsive: [
	  	  {
	  	  	breakpoint: 1200,
	  	  	settings: {
	  	  		slidesToShow: 3,
	  	  	}
	  	  },
	  	  {
	  	  	breakpoint: 992,
	  	  	settings: {
	  	  		slidesToShow: 2
	  	  	}
	  	  },
	  	  {
	  	  	breakpoint: 768,
	  	  	settings: {
	  	  		slidesToShow: 1
	  	  	}
	  	  }
	    ]
		});
		// Team Slider JS End
	}
	
	// Magnific Popup JS Start
	if(jQuery('.popup-youtube').length){
		$('.popup-youtube').magnificPopup({
			disableOn: 700,
			type: 'iframe',
			mainClass: 'mfp-fade',
			removalDelay: 160,
			preloader: false,
			fixedContentPos: false
		});
	}
	// Magnific Popup JS End
	
	// Light Gallery JS Start
	if(jQuery('#lightgallery, .lightgallery').length){
		$('#lightgallery, .lightgallery').lightGallery({
			selector : '.lightimg',
			loop:true,
			thumbnail:true,
			exThumbImage: 'data-exthumbimage'
		});
	}
	// Light Gallery JS End
	
	var support = '<a href="https://themeforest.net/item/shivaa-creative-agency-bootstrap-template/31977765" target="_blank" class="bt-buy-now theme-btn"><i class="ti-shopping-cart"></i><span>Buy Now</span></a><a href="https://support.w3itexperts.com" target="_blank" class="bt-support-now theme-btn"><i class="ti-headphone-alt"></i><span>Support</span></a><!-- Go to www.addthis.com/dashboard to customize your tools --><script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5b221c5e31b4e54b"></script>';
	jQuery('body').append(support);

});

// Pricing Switch JS Start
function check() {
  var price_check = document.getElementById("price_check");
  var annually_text = document.getElementsByClassName("annually_text");
  var monthly_text = document.getElementsByClassName("monthly_text");

  for (var i = 0; i < annually_text.length; i++) {
    if (price_check.checked == true) {
      annually_text[i].style.display = "none";
      monthly_text[i].style.display = "block";
    } else if (price_check.checked == false) {
      annually_text[i].style.display = "block";
      monthly_text[i].style.display = "none";
    }
  }
}
check();
// Pricing Switch JS End

// Portfolio Tabbing JS Start
$(function() {
    var filterList = {
        init: function() {
            // MixItUp plugin
            // http://mixitup.io
            $('#portfoliolist').mixItUp({
                selectors: {
                    target: '.portfolio',
                    filter: '.filter'
                },
                load: {
                    filter: '.all, .web-design, .web-development, .branding, .mobile-app'
                }
            });
        }
    };
    // Run the show!
    filterList.init();
});
// Portfolio Tabbing JS End
