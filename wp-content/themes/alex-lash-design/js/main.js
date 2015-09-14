$(document).ready(function(){
	if ($(window).width()>680) initFullscrnHover();
});

$(window).load(function(){
	imagesLoaded($('.gallery .image-container img.loader-image'), $('.gallery .image-container'));
});
function initFullscrnHover() {
	$('.project').each(function() {
		var origbgcolor = $('html').data('origcolor'),
				origtxtcolor = $('html').data('origtextcolor'),
				bgcolor = $(this).find('a').data('bgcolor'),
				txtcolor = $(this).find('a').data('textcolor'),
				bgimg = $(this).find('a').data('bgimg'),
				bglocation = $(this).find('a').data('bglocation'),
				bgsize = $(this).find('a').data('bgsize');

		$(this).mouseenter(function() {
			$('html').css({
				'background-color': bgcolor,
				'color': txtcolor,
				'fill': txtcolor
			});
			$('.preview img#'+$(this).attr('id')).attr('src', bgimg);
			$('.preview').css({
				'background-position': bglocation,
				'background-size': bgsize
			});
			imagesLoaded($('.preview img.loader-image#'+$(this).attr('id')), $('.preview'), bgimg)
		});
		$(this).mouseleave(function() {
			$('html').css({
				'background-color': origbgcolor,
				'color': origtxtcolor,
				'fill': origtxtcolor
			});	
			$('.preview img').attr('src', ''),
			$('.preview').removeClass('isLoaded').css({
				'background-image': 'url()',
				'background-image': '',
				'background-position': ''
			})
		});
	});
	// ajaxifyThumbs();
}

function imagesLoaded(elem, container, url) {
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
  	if ($('body').hasClass('home')) {
  		$(image.img).closest(container).css({
				'background-image': 'url('+url+')',
			});
  	};
		if ($(image.img).closest(container).css('background-url')!='') container.addClass('isLoaded');
    // var result = image.isLoaded ? 'loaded' : 'broken';
    // console.log( 'image is ' + result + ' for ' + image.img.src );
  });
}
