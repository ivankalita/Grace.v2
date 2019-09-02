jQuery(function($){
	$(document).ready(function() {

        var index_item = $('.timeline-image');

        index_item.on('click', function(e) {

            var index = $(this).parent().index();
            var body = $('.timeline').children().eq(index).find('.timeline-gallery');
            var bodyHtml = $(body).html();
            
            // $(body).addClass('lightgallery');
            console.log(+bodyHtml);
            if (+bodyHtml || isNaN(+bodyHtml)) notsendAjax(index, body);
            else sendAjax(index, body);     
        
            e.preventDefault();
        })


        function sendAjax(index, body) {
            console.log(index);
			var data = {
				'action': 'showgallerypost',
                'index': index
			};

            $.ajax({
                url: ajaxurl, // обработчик
				data: data, // данные
                type: 'POST', // тип запроса
                success: function(data) {

                    $(body).append(data);
                    console.log('success');
                    $(body).lightGallery().find('a').first().trigger('click');
                    console.log('sendAjax');
                }
            })
        }

        function notsendAjax(index,body) {
            console.log(index);
            $(body).lightGallery().children().first().trigger('click');
            console.log('notsendAjax');
        }
    })
})