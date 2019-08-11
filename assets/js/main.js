jQuery(function($){
    $(document).ready(function() {
        // $('body').css('display', 'none');
        // *********** Блок перерисовки header **************** //
        function heightDetect() {
            // $('header').css('height', $(window).height());
            var header_height = $('header').outerHeight();
            var navbar_height = $('.navbar').outerHeight();
            var header_banner_height = $('.header-banner').outerHeight();
            var header_extra_height = header_height - navbar_height - header_banner_height;
            $('.header-extra').css('height', header_extra_height);
            $('.header-extra-next').css('height', header_extra_height);
        }
        heightDetect();
        $(window).resize(function() {
            heightDetect();
        });
        //******************************************************* */
        $('body').addClass('animated fadeIn');

        $('#hamburger-icon').click(function(e) {
            $('#hamburger-icon').toggleClass('active');
            e.preventDefault();
        });
    });    
});
