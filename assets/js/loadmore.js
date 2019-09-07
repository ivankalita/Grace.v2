
jQuery(function($){
	$(document).ready(function() {
		//
		//
		$('.wait__posts').hide();
		$('.wait__schedule').css('display', 'none');
		$('.wait__send').css('display', 'none');
		$('.schedule-group').parent().css('z-index', -10);
		//
		//
		$('.timeline__showmore').click(function(){
			$('.wait__posts').show();
			$(this).attr('disabled', '');
			$('.button__text').text('Вспоминаем...');
			var data = {
				'action': 'loadmore',
				'query': true_posts,
				'page' : current_page
			};
		
			$.ajax({
				url: ajaxurl,
				data: data,
				type: 'POST',
				success:function(data){
					if( data ) {
					
						$('.timeline > li:last').after(data);
						$('.timeline:before').addClass('animated fadeIn');

						var index_item = $('.timeline-image');
						$(index_item).on('click', function(e) {

							var index = $(this).parent().index();
							var body = $('.timeline').children().eq(index).find('.timeline-gallery');
							var bodyHtml = $(body).html();
							
						
							if (+bodyHtml || isNaN(+bodyHtml)) notsendAjax(index, body);
							else sendAjax(index, body);     
						
							e.preventDefault();
						})

						$('.wait__posts').hide();
						$('.button__text').text('показать ещё');
						$('.timeline__showmore').css('background-color', '');
						current_page++; 
						if (current_page == max_pages) {
							$(".timeline__showmore").remove(); 
							$(".timeline-lastchild").remove();
						}
					} else {
						$('.timeline__showmore').remove();
						$(".timeline-lastchild").remove();
					}
				}
			})

			function sendAjax(index, body) {
				var data = {
					'action': 'showgallerypost',
					'index': index
				};
	
				$.ajax({
					url: ajaxurl,
					data: data,
					type: 'POST',
					success: function(data) {
	
						$(body).append(data);
						$(body).lightGallery().find('a').first().trigger('click');
					}
				})
			}
	
			function notsendAjax(index,body) {
				$(body).lightGallery().children().first().trigger('click');
			}
		})
	})
	})