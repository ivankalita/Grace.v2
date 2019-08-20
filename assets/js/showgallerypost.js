jQuery(function($){
	$(document).ready(function() {
        console.log('showgallerypost');

        var index_item = $('.timeline-image');

        index_item.on('click', function() {
            $(this).parent().addClass('index-item');

            $(this).find('.timeline-body').addClass('lightgallery');
            var index = $('.index-item').index();
            console.log($(this));

			var data = {
				'action': 'showgallerypost',
                'index': index
			};

            $.ajax({
                url: ajaxurl, // обработчик
				data: data, // данные
                type: 'POST', // тип запроса
                success: function(data) {
                    if ($('.index-item').find('.timeline-body').is('.lightgallery')) {
                        $('.index-item').find('.timeline-body').append(data);
                        console.log('success');
                        $('.lightgallery').lightGallery();
                    } else console.log('Not fined class lightgallery');
                    
                    
                    
                }
            })

		})
    })
})