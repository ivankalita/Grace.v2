jQuery(function($){
    
    $(document).ready(function() {

        // *********** Добавление к якорям class = data-scroll **************** //
        var anchor = $('a.nav-link');
        anchor.addClass('data-scroll');
        //******************************************************* */
        // *********** Smooth Scrolling **************** //
        var scroll = new SmoothScroll('.data-scroll', {
            speed: 800,
            offset: 100,
            easing: 'easeInOutCubic',
        });
        //************************************************/

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
                $('.return-up').css('display', 'inline-block').addClass('animated fadeInRight');
            } else {
                $('nav').removeClass('fadeInDown').addClass('fadeOutUp');
                $('.return-up').removeClass('fadeInRight').addClass('fadeOutRight');
                setTimeout(()=> {
                    $('nav').removeClass('sticky scrolling animated fadeOutUp');
                    $('.return-up').removeClass('animated fadeOutRight').css('display', 'none');
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
    
                offset: '120px'
    
            });
            
        };
        ssWaypoints();
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
        ssMobileMenu();

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
        function fromLeftToRight(prev, currnet) {
            slides[prev - 1].classList.add('animated', 'slideOutLeft');
            setTimeout(()=> {
                slides[prev - 1].style.display = 'none';
            }, 500);
            setTimeout(()=> {
                slides[currnet - 1].classList.add('animated', 'slideInRight');
                slides[currnet - 1].style.display = 'flex';
            }, 500);

            setTimeout(()=> {
                slides[prev - 1].classList.remove('animated', 'slideOutLeft');
            }, 500);
            setTimeout(()=> {
                slides[currnet - 1].classList.remove('animated', 'slideInRight');
            }, 1000);

            slideIndex = currnet;
            uploadStatusSlider(currnet);
        }
        function fromRightToLeft(prev, currnet) {
            slides[prev - 1].classList.add('animated', 'slideOutRight');
            setTimeout(()=> {
                slides[prev - 1].style.display = 'none';
            }, 500);
            setTimeout(()=> {
                slides[currnet - 1].classList.add('animated', 'slideInLeft');
                slides[currnet - 1].style.display = 'flex';
            }, 500);  

            setTimeout(()=> {
                slides[prev - 1].classList.remove('animated', 'slideOutRight');
            }, 500);
            setTimeout(()=> {
            slides[currnet - 1].classList.remove('animated', 'slideInLeft');
            }, 1000); 

            slideIndex = currnet;
            uploadStatusSlider(currnet);
        }
        function uploadStatusSlider(n) {
            for (let i = 0; i < dots.length; i++) {
                dots[i].classList.remove('active');
            }
            dots[n - 1].classList.add('active');
        }
        dotsArea.onclick = function(e) {
            for (let i = 0; i < dots.length + 1; i++) {
                if (e.target.classList.contains('dots-items') && e.target == dots[i - 1]) {
                    if (i > slideIndex - 1) fromLeftToRight(slideIndex, i)
                    else fromRightToLeft(slideIndex, i);
                }
            }
        }
        showSlides(slideIndex);
        /****************************************************** */

        //* Set Cookies
        /*---------------------------------------------------- */ 
        function randomSession(min, max) {
            var rand = min - 0.5 + Math.random() * (max - min + 1);
            rand = Math.round(rand);
            return rand;
        }
        var id = randomSession(1, Date.now());
        if (Cookies.get('IDUser') == null) {
            Cookies.set('IDUser', id, { expires: 1 });
            Cookies.set('flag', false, { expires: 1 });
        }
        /****************************************************** */
        
        
        $('.schedule').on('click', function(e) {
            var target = getTarget(e),
                scheduleChange = $('.schedule-change'),
                selectTriangle = $('.select-triangle'),
                scheduleChoice = $('.schedule-choice');
                scheduleGroup = $('.schedule-group');

            if ($(target).hasClass('schedule-change') || $(target).hasClass('select-triangle')) dropList(target, scheduleChoice, scheduleGroup, selectTriangle);
            if ($(target).hasClass('schedule-choice')) {
                selectChoice(target, scheduleChange, scheduleChoice, scheduleGroup);
            }
        })

        function getTarget(e) {
            if (!e) {
                e = window.event;
            }
            return e.target || e.srcElement;
        }
        //* Анимация выпадающего списка
        /*---------------------------------------------------- */ 
        function dropList(target, scheduleChoice, scheduleGroup, selectTriangle) {
            if ($(target).attr('data-collapse') == 'true') {
                $(scheduleGroup).css('opacity', 1).parent().css('z-index', 1);
                $(scheduleChoice).removeClass('animated fadeOutUp').addClass('animated fadeInDown');
                $(target).attr('data-collapse', 'false');
                $(selectTriangle).css('transform', 'rotate(180deg)');
            } else {
                $(scheduleChoice).removeClass('animated fadeInDown').addClass('animated fadeOutUp');
                $(target).attr('data-collapse', 'true');
                $(selectTriangle).css('transform', 'rotate(0deg)');
                $(scheduleGroup).parent().css('z-index', -10);
            }
        }

        function selectChoice(target, scheduleChange, scheduleChoice, scheduleGroup) {
            var value = $(target).text();

            getDayTime(matchingLabels(value.trim()));

            $(scheduleChange).html(value + '<i class=\"fas fa-caret-down select-triangle\"></i>');
            $(scheduleChoice).removeClass('animated fadeInDown').addClass('animated fadeOutUp');
            $(scheduleChange).attr('data-collapse', 'true');
            $(scheduleGroup).parent().css('z-index', -10);
        }
        function matchingLabels(value) {
            var valueLabel = {
                'juveniles': 'Ювеналы (12-14 лет)',
                'juniors': 'Юниоры/Молодежь (15-18лет)',
                'adult_beginner': 'Взрослые начинающие (до 35 лет)',
                'adult_continue': 'Взрослые-синьоры продолжающие (35-50 лет)',
                'grandees': 'Грандессы (50+)'
            }

            for (let item in valueLabel) {
                if (value == valueLabel[item]) return item;
            }
            return false;
        }
        function getDayTime(item) {
            var data = {
                'action': 'daytime',
                'value': item
            };
            
            $.ajax({
				url:  ajaxurl, // обработчик
				data: data, // данные
                type: 'POST', // тип запроса
                beforeSend: function() {
                    $('.wait__schedule').css('display', 'inline-block');
                },
				success: function(data){
                    var schedule = JSON.parse(data);
                    $('.wait__schedule').css('display', 'none');
                    if (schedule) pasteTimeInSchedule(schedule);
                },
                error: function(jqXHR) {
                    console.log(jqXHR);
                }
			})
        }

        function pasteTimeInSchedule(schedule) {
            var monday = $('.monday'),
            tuesday = $('.tuesday'),
            wednesday = $('.wednesday'),
            thursday = $('.thursday'),
            friday = $('.friday'),
            saturday = $('.saturday'),
            sunday = $('.sunday');

            $(monday).find('.from').text(schedule['monday']['from']);
            $(monday).find('.to').text(schedule['monday']['to']);
            if (!$(monday).find('.from').text()) {
                $(monday).find('.from').css('height', '72px');
                $(monday).find('.to').css('height', '72px');
            }
            $(tuesday).find('.from').text(schedule['tuesday']['from']);
            $(tuesday).find('.to').text(schedule['tuesday']['to']);
            if (!$(tuesday).find('.from').text()) {
                $(tuesday).find('.from').css('height', '72px');
                $(tuesday).find('.to').css('height', '72px');
            }
            $(wednesday).find('.from').text(schedule['wednesday']['from']);
            $(wednesday).find('.to').text(schedule['wednesday']['to']);
            if (!$(wednesday).find('.from').text()) {
                $(wednesday).find('.from').css('height', '72px');
                $(wednesday).find('.to').css('height', '72px');
            }
            $(thursday).find('.from').text(schedule['thursday']['from']);
            $(thursday).find('.to').text(schedule['thursday']['to']);
            if (!$(thursday).find('.from').text()) {
                $(thursday).find('.from').css('height', '72px');
                $(thursday).find('.to').css('height', '72px');
            }
            $(friday).find('.from').text(schedule['friday']['from']);
            $(friday).find('.to').text(schedule['friday']['to']);
            if (!$(friday).find('.from').text()) {
                $(friday).find('.from').css('height', '72px');
                $(friday).find('.to').css('height', '72px');
            }
            $(saturday).find('.from').text(schedule['saturday']['from']);
            $(saturday).find('.to').text(schedule['saturday']['to']);
            if (!$(saturday).find('.from').text()) {
                $(saturday).find('.from').css('height', '72px');
                $(saturday).find('.to').css('height', '72px');
            }
            $(sunday).find('.from').text(schedule['sunday']['from']);
            $(sunday).find('.to').text(schedule['sunday']['to']);
            if (!$(sunday).find('.from').text()) {
                $(sunday).find('.from').css('height', '72px');
                $(sunday).find('.to').css('height', '72px');
            }
        }

        $('.schedule-change').hover(function() {
            $(this).css({'color': 'black',
                        'background': '#ffffff7d'});
            $('.select-triangle').css('color', 'black');
        }, function() {
            $(this).css({'color': 'white',
                        'background': 'transparent'});
            $('.select-triangle').css('color', 'white');
        })


        /****************************************************** */
    })
})