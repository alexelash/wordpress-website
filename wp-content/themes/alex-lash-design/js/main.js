$(document).ready(function(){
	initFullscrnHover();
});
function initFullscrnHover() {
	$('.project').each(function() {
		$(this).mouseenter(function() {
			$('html').css({
				'background-color': $(this).find('a').data('bgcolor')
			});
			$('.preview img').attr('src', ($(this).find('a').data('bgimg'))),
			$('.preview').css({
				'background-image': 'url('+$(this).find('a').data('bgimg')+')',
				'background-position': $(this).find('a').data('bglocation'),
				'background-size': $(this).find('a').data('bgsize')
			})
			imagesLoaded($('.preview img'), $('.preview'))
		});
		$(this).mouseleave(function() {
			$('html').css({
				'background-color': $('html').data('origcolor')
			});	
			$('.preview img').attr('src', ''),
			$('.preview').removeClass('isLoaded').css({
				'background-image': '',
				'background-position': ''
			})
		});
	});
	// ajaxifyThumbs();
}

function imagesLoaded(elem, container) {
	container.imagesLoaded()
  .always( function( instance ) {
    // console.log('all images loaded');
  })
  .done( function( instance ) {
    // console.log('all images successfully loaded');
  })
  .fail( function() {
    // console.log('all images loaded, at least one is broken');
  })
  .progress( function( instance, image ) {
  	// console.log(image)
  	$(image.img).closest(container).addClass('isLoaded');
    // var result = image.isLoaded ? 'loaded' : 'broken';
    // console.log( 'image is ' + result + ' for ' + image.img.src );
  });
}
