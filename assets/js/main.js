jQuery(function($){
    $(document).ready(function() {

        // *********** Блок перерисовки header **************** //
        function heightDetect() {
            var header_height = $('header').outerHeight();
            var nav_height = $('nav').outerHeight();
            var header_banner_height = $('.header-banner').outerHeight();
            var header_extra_height = header_height - nav_height - header_banner_height;
            $('.header-extra').css('height', header_extra_height);
        }
        heightDetect();
        $(window).resize(function() {
            heightDetect();
        })
        //******************************************************* */
        
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
        }}, {offset: '0px'})
        //******************************************************* */

        function windowSize(){
            $('.preheader').css('background-color', 'transparent');
            if ($(window).width() < '1200'){
                $('.nav-block').css('display', '');
                $('.nav-block').addClass('mobile');
                if ($('.nav-block').hasClass('desktop')) $('.nav-block').removeClass('desktop');
            } else {
                $('.nav-block').addClass('desktop');
                if ($('.nav-block').hasClass("col-12")) $(".nav-block").toggleClass('col-12 col');
                if ($('.nav-block').hasClass('mobile')) $('.nav-block').removeClass('mobile');
                if ($('#hamburger-icon').hasClass('active')) $('#hamburger-icon').toggleClass('active');
                
            }
        }

        $(window).on('load resize',windowSize);

        

        $('#hamburger-icon').click(function(e) {
            $('#hamburger-icon').toggleClass('active');
            if ($('#hamburger-icon').hasClass('active')) {
                
                $(".nav-block").toggleClass('col col-12').css('display', 'grid').removeClass('animated fadeOutUp').addClass('animated fadeInDown');
                // setTimeout(()=> {
                //     $('.preheader').css('background-color', '#000000');
                // }, 600)
            } else {
                $('.preheader').css('background-color', 'transparent');
                $('.nav-block').removeClass('animated fadeInDown').addClass('animated fadeOutUp').toggleClass('col-12 col');
                
            }
            e.preventDefault();
        })
    })
})