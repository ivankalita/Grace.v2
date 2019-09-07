jQuery(function($){
    $(document).ready(function() {
        var anchor = $('a.nav-link');
        anchor.addClass('data-scroll');

        var scroll = new SmoothScroll('.data-scroll', {
            speed: 800,
            offset: 100,
            easing: 'easeInOutCubic',
        });

        var doc = document.documentElement;
        doc.setAttribute('data-useragent', navigator.userAgent);
        
        $(window).scroll(function() {
            var header_height = $('header').outerHeight();
            var header_factor = header_height/100;
            var cursor = $(document).scrollTop();
            var alpha;
            if (cursor) {
                alpha = cursor/header_factor * 0.008;
            } else alpha = 0;
            $('header').css('box-shadow', `inset 0px 0px 20px ${header_height/2}px rgba(0,0,0,${alpha})`);      
        })

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

        var ssWaypoints = function() {

            var sections = $(".target-section"),
                navigation_links = $(".header-nav li a");
    
            sections.waypoint( {
    
                handler: function(direction) {
    
                    var active_section = $('section#' + this.element.id);
    
                    if (direction === "up") active_section = active_section.prevAll(".target-section").first();
    
                    var active_link = $('.header-nav li a[href="#' + active_section.attr("id") + '"]');
    
                    navigation_links.parent().removeClass("current");
                    active_link.parent().addClass("current");
    
                },
    
                offset: '120px'
    
            });
            
        };
        ssWaypoints();

        $(window).on('load resize', function () {

            if ($(document).width() < 1200) {
                $('.header-nav-wrap').addClass('mobile');
            }
            else {
                $('.header-nav-wrap').removeClass('mobile');
            }
        })
        
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

        $('.timeline-image').hover(function() {
            $(this).find('.gallery__more').addClass('current-more');
        }, function() {
            $('.current-more').removeClass('current-more');
        });

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
            }
            for (let i = 0; i < dots.length; i++) {
                dots[i].classList.remove('active');
            }

            slides[slideIndex - 1].style.display = 'flex';
            dots[slideIndex - 1].classList.add('active');
        }
        function fromLeftToRight(prev, current) {
            slides[prev - 1].classList.add('animated', 'slideOutLeft');
            setTimeout(()=> {
                slides[prev - 1].style.display = 'none';
            }, 500);
            setTimeout(()=> {
                slides[current - 1].classList.add('animated', 'slideInRight');
                slides[current - 1].style.display = 'flex';
            }, 500);

            setTimeout(()=> {
                slides[prev - 1].classList.remove('animated', 'slideOutLeft');
            }, 500);
            setTimeout(()=> {
                slides[current - 1].classList.remove('animated', 'slideInRight');
            }, 1000);

            slideIndex = current;
            uploadStatusSlider(current);
        }
        function fromRightToLeft(prev, current) {
            slides[prev - 1].classList.add('animated', 'slideOutRight');
            setTimeout(()=> {
                slides[prev - 1].style.display = 'none';
            }, 500);
            setTimeout(()=> {
                slides[current - 1].classList.add('animated', 'slideInLeft');
                slides[current - 1].style.display = 'flex';
            }, 500);  

            setTimeout(()=> {
                slides[prev - 1].classList.remove('animated', 'slideOutRight');
            }, 500);
            setTimeout(()=> {
            slides[current - 1].classList.remove('animated', 'slideInLeft');
            }, 1000); 

            slideIndex = current;
            uploadStatusSlider(current);
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

        var carouselBlock = $('.carousel-items');

        $(carouselBlock).on('mousedown',function( event ) {
            switch ( event.which ) {
                case 1:
                    var pointDown = event.pageX
                    $(carouselBlock).on('mousemove', function(event) {
                        if ( event.pageX - pointDown > 50 ) {
                            if (slideIndex == 1) fromRightToLeft(slideIndex, 3);
                            else if (slideIndex == 2) fromRightToLeft(slideIndex, 1);
                            else if (slideIndex == 3) fromRightToLeft(slideIndex, 2);
                            $(carouselBlock).off('mousemove');
                        };
                        if ( event.pageX - pointDown < -50 ) {
                            if (slideIndex == 1) fromLeftToRight(slideIndex, 2);
                            else if (slideIndex == 2) fromLeftToRight(slideIndex, 3);
                            else if (slideIndex == 3) fromLeftToRight(slideIndex, 1);
                            $(carouselBlock).off('mousemove');
                        }
                    })
                break;
            }
        });
        
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
        function dropList(target, scheduleChoice, scheduleGroup, selectTriangle) {
            if ($(target).attr('data-collapse') == 'true') {
                $('.schedule').css('box-shadow', 'inset 0px 0px 20px 1600px rgba(0,0,0,.8)');
                $('.day').css('color', '#af2b2b6b');
                $(scheduleGroup).css('opacity', 1).parent().css('z-index', 1);
                $(scheduleChoice).removeClass('animated fadeOutUp').addClass('animated fadeInDown');
                $(target).attr('data-collapse', 'false');
                $(selectTriangle).css('transform', 'rotate(180deg)');
            } else {
                $('.schedule').css('box-shadow', '');
                $('.day').css('color', '#AF2B2B');
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
            $('.day').css('color', '#AF2B2B');
            
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
				url:  ajaxurl,
				data: data,
                type: 'POST',
                beforeSend: function() {
                    $('.wait__schedule').css('display', 'inline-block');
                },
				success: function(data){
                    var schedule = JSON.parse(data);
                    $('.wait__schedule').css('display', 'none');
                    if (schedule) pasteTimeInSchedule(schedule);
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

            $(monday).find('.from').text(schedule['monday']['from']).toggleClass('animated fadeIn');
            $(monday).find('.to').text(schedule['monday']['to']).toggleClass('animated fadeIn');

            $(tuesday).find('.from').text(schedule['tuesday']['from']).toggleClass('animated fadeIn');
            $(tuesday).find('.to').text(schedule['tuesday']['to']).toggleClass('animated fadeIn');

            $(wednesday).find('.from').text(schedule['wednesday']['from']).toggleClass('animated fadeIn');
            $(wednesday).find('.to').text(schedule['wednesday']['to']).toggleClass('animated fadeIn');

            $(thursday).find('.from').text(schedule['thursday']['from']).toggleClass('animated fadeIn');
            $(thursday).find('.to').text(schedule['thursday']['to']).toggleClass('animated fadeIn');

            $(friday).find('.from').text(schedule['friday']['from']).toggleClass('animated fadeIn');
            $(friday).find('.to').text(schedule['friday']['to']).toggleClass('animated fadeIn');

            $(saturday).find('.from').text(schedule['saturday']['from']).toggleClass('animated fadeIn');
            $(saturday).find('.to').text(schedule['saturday']['to']).toggleClass('animated fadeIn');

            $(sunday).find('.from').text(schedule['sunday']['from']).toggleClass('animated fadeIn');
            $(sunday).find('.to').text(schedule['sunday']['to']).toggleClass('animated fadeIn');

            $('.schedule').css('box-shadow', '');
        }
        
        
        $('.schedule-change').hover(function() {
            $('.select-triangle').css('color', 'black');
        }, function() {
            $('.select-triangle').css('color', 'white');
        })
        $('.schedule').parallax({imageSrc: 'http://wordpress/wp-content/themes/grace/assets/images/schedule.jpg'});

        var galleryBlock = $('.gallery__block'); 
        $(galleryBlock).lightGallery();
        $(galleryBlock).find('img').after('<i class="fas fa-camera-retro gallery__more"></i>');
        $(galleryBlock).find('a').hover(function() {
            $(this).find('.gallery__more').addClass('current-more');
        }, function() {
            $('.current-more').removeClass('current-more');
        });

    })
})