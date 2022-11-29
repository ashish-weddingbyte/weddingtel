(function ($) {

    "use strict";

    var wporganic = {

        loader: function () {

            $(window).on('load', function () {

                $('.status').fadeOut();
                $('.preloader').delay(350).fadeOut('slow');
            });
        },


        activate_scrollspy: function () {
            if ($('.header-anim').length) {

                $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function () {
                    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                        var target = $(this.hash);
                        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                        if (target.length) {
                            $('html, body').animate({
                                scrollTop: (target.offset().top - 56)
                            }, 1000, "easeInOutExpo");
                            return false;
                        }
                    }
                });

                // Closes responsive menu when a scroll trigger link is clicked
                $('.js-scroll-trigger').click(function () {
                    $('.navbar-collapse').collapse('hide');
                });

                // Activate scrollspy to add active class to navbar items on scroll
                $('body').scrollspy({
                    target: '#mainNav',
                    offset: 56
                });
            }
        },
          // Smooth scrolling using jQuery easing
  

        header_anim: function () {
            if ($('.header-anim').length) {

                $(window).scroll(function () {
                    if ($(this).scrollTop() > 50) {
                        $('.header-anim').addClass('fixed');
                    } else {
                        $('.header-anim').removeClass('fixed');
                    }
                });
            }
        },

        back_to_top: function () {

            if ($('#back-to-top').length) {

                $(window).scroll(function () {

                    if ($(this).scrollTop() > 100) {

                        $('#back-to-top').fadeIn();

                    } else {

                        $('#back-to-top').fadeOut();
                    }
                });

                $('#back-to-top').click(function () {

                    $('body,html').animate({ scrollTop: 0 }, 800);
                    return false;
                });
            }
        },


        bs_tootltip: function () {
            $('[data-toggle="tooltip"]').tooltip()
        },


        captured_gallery : function(){

            if( $('.captured-img-gallery').length ){

                $('.captured-img-gallery').each(function() { // the containers for all your galleries
                    $(this).magnificPopup({
                        delegate: 'a', // the selector for gallery item
                        type: 'image',
                        gallery: {
                            enabled: true, // set to true to enable gallery
                        
                            preload: [0,2], // read about this option in next Lazy-loading section
                        
                            navigateByImgClick: true,
                        
                            arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>', // markup of an arrow button
                        
                            tPrev: 'Previous (Left arrow key)', // title for left button
                            tNext: 'Next (Right arrow key)', // title for right button
                            tCounter: '<span class="mfp-counter">%curr% of %total%</span>' // markup of counter
                        }
                    });
                });
            }
        },


        isotope_gallery: function () {

            // Porfolio isotope and filter
            $(window).on('load', function () {
                var portfolioIsotope = $('.isotope-gallery').isotope({
                    itemSelector: '.gallery-item'
                });

                $('#portfolio-flters li').on('click', function () {
                    $("#portfolio-flters li").removeClass('filter-active');
                    $(this).addClass('filter-active');

                    portfolioIsotope.isotope({
                        filter: $(this).data('filter')
                    });
                    aos_init();
                });
            });
        },

        toggle_datepicker : function(){

            if( $('[data-toggle="datepicker"]').length ){

                $('[data-toggle="datepicker"]').datepicker({
                autoHide: true,
                zIndex: 2048,
                });
            }
        },

        wedding_countdown: function () {
            loopcounter("counter-class");
        },

        slider_partners : function(){

            if( $('#slider-partners').length ){
    
                $('#slider-partners').owlCarousel({
    
                    loop: true,
                    stagePadding: 0,
                    margin: 30,
                    autoplay: true,
                    autoplayTimeout: 10000,
                    smartSpeed: 1000,
                    nav: false,
                    dots: true,
                    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                    responsive: {
                        0: {
                            items: 2
                        },
                        600: {
                            items: 2
                        },
                        767: {
                            items: 3
                        },
                        1000: {
                            items: 5
                        }
                    }
                });
            }
        },

        slider_testimonail : function(){

            if( $('#slider-testimonail').length ){
    
                $('#slider-testimonail').owlCarousel({
                    items: 1,
                    loop: true,
                    stagePadding: 0,
                    margin: 30,
                    autoplay: false,
                    autoplayTimeout: 10000,
                    smartSpeed: 1000,
                    nav: false,
                    dots: true,
                    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
                });
            }
        },
        

        
        



        initializ: function () {
            this.slider_testimonail();
            this.header_anim();
            this.isotope_gallery();
            this.captured_gallery();
            this.activate_scrollspy();
            this.wedding_countdown();
            this.slider_partners();
        }

    }

    /* ---------------------------------------------
   Document ready function
   --------------------------------------------- */
    $(function () {

        wporganic.loader();
        wporganic.initializ();
    });

    $(window).resize(function () {
        //wporganic.initializ();
    });

})(jQuery);