
jQuery(function($){
	$(document).ready(function() {
		//
		//
		$('.wait__posts').css('display', 'none');
		$('.wait__schedule').css('display', 'none');
		$('.wait__send').css('display', 'none');
		$('.schedule-group').parent().css('z-index', -10);
		//
		//
		$('.timeline__showmore').click(function(){
			$(this).addClass('animated fadeOut'); // изменяем текст кнопки, вы также можете добавить прелоадер
			$('.spinner-grow').css('display', 'inline-block');
			var data = {
				'action': 'loadmore',
				'query': true_posts,
				'page' : current_page
			};
			$.ajax({
				url:ajaxurl, // обработчик
				data:data, // данные
				type:'POST', // тип запроса
				success:function(data){
					if( data ) {
						var last_child = '';
						$('.timeline li:last').after(data); // вставляем новые посты
						$('.timeline__showmore').removeClass('fadeOut').addClass('fadeIn');
						$('.spinner-grow').css('display', 'none');
						current_page++; // увеличиваем номер страницы на единицу
						if (current_page == max_pages) {
							$(".timeline__showmore").remove(); // если последняя страница, удаляем кнопку
							$(".timeline-lastchild").remove();
						}
					} else {
						$('.timeline__showmore').remove(); // если мы дошли до последней страницы постов, скроем кнопку
						$(".timeline-lastchild").remove();
					}
				}
			})
		})
	})
	})