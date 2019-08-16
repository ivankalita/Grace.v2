jQuery(function($){
    $(document).ready(function() {

        // Add the User Agent to the <html>
        // will be used for IE10 detection (Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0))
        var doc = document.documentElement;
        doc.setAttribute('data-useragent', navigator.userAgent);
        
        // *********** Блок затемнения header **************** //
        $(window).scroll(function() {
            var header_height = $('header').outerHeight();
            // var nav_height = $('nav').outerHeight();
            var header_factor = header_height/100;
            var cursor = $(document).scrollTop();
            var alpha;
            if (cursor) {
                alpha = cursor/header_factor * 0.008;
            } else alpha = 0;
            $('header').css('box-shadow', `inset 0px 0px 20px ${header_height/2}px rgba(0,0,0,${alpha})`);      
        })
        //******************************************************* */

        // *********** Блок появления header при скролле **************** //
        $('#leader').waypoint(function(direction){
            if (direction == 'down') {
                $('nav').addClass('sticky scrolling animated fadeInDown');
            } else {
                $('nav').removeClass('fadeInDown').addClass('fadeOutUp');
                setTimeout(()=> {
                    $('nav').removeClass('sticky scrolling animated fadeOutUp')
                }, 500)
        }}, {offset: '180px'})
        //******************************************************* */

        // *********** Подсветка section при скролле **************** //
        var ssWaypoints = function() {

            var sections = $(".target-section"),
                navigation_links = $(".header-nav li a");
    
            sections.waypoint( {
    
                handler: function(direction) {
    
                    var active_section;
    
                    active_section = $('section#' + this.element.id);
    
                    if (direction === "up") active_section = active_section.prevAll(".target-section").first();
    
                    var active_link = $('.header-nav li a[href="#' + active_section.attr("id") + '"]');
    
                    navigation_links.parent().removeClass("current");
                    active_link.parent().addClass("current");
    
                },
    
                offset: '100px'
    
            });
            
        };
        //******************************************************* */

        $(window).on('load resize', function () {

            if ($(document).width() < 1200) {
                $('.home-content__buttons').css('top', '27rem');
                $('.home-content__scroll').css('top', '31rem');
                $('.header-nav-wrap').addClass('mobile');
            }
            else {
                $('.home-content__buttons').css('top', '');
                $('.home-content__scroll').css('top', '34rem');
                $('.header-nav-wrap').removeClass('mobile');
            }
        })
        
        /* Mobile Menu
        * ---------------------------------------------------- */ 
        var ssMobileMenu = function() {

            var toggleButton = $('.header-menu-toggle'),
                nav = $('.header-nav-wrap');

            toggleButton.on('click', function(event) {
                event.preventDefault();

                toggleButton.toggleClass('is-clicked');
                nav.slideToggle();
            });

            nav.find('a').on("click", function() {
                if (nav.hasClass('mobile')) {
                    toggleButton.toggleClass('is-clicked');
                    nav.slideToggle(); 
                }
            });
        };

        /* Carousel Groups
        * ---------------------------------------------------- */ 
        var dots = $('.dots-items'),
            dotsArea = $('.dots-block')[0],
            slides = $('.carousel-items'),
            slideIndex = 1;

        function showSlides(n) {
            if (n < 1) {
                slideIndex = slides.length;
            } else if (n > slides.length) {
                slideIndex = 1;
            }
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = 'none';
                // slides[i].classList.add('animated', 'fadeOutLeft');
            }
            for (let i = 0; i < dots.length; i++) {
                dots[i].classList.remove('active');
            }

            slides[slideIndex - 1].style.display = 'flex';
            dots[slideIndex - 1].classList.add('active');
        }
        function currentSlide(n) {
            if (n > slideIndex - 1) {
                // slides[slideIndex - 1].classList.add('animated', 'fadeOutLeft');
                slides[slideIndex].classList.add('animated', 'fadeInRight');
            }
            showSlides(slideIndex = n);
            console.log(slideIndex);
        }
        dotsArea.onclick = function(e) {
            for (let i = 0; i < dots.length + 1; i++) {
                if (e.target.classList.contains('dots-items') && e.target == dots[i - 1]) {
                    currentSlide(i);
                }
            }
        }
        showSlides(slideIndex);
        (function ssInit() {
            ssWaypoints();
            ssMobileMenu();
        })();

    })
})