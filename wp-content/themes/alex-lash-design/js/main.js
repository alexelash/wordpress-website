$(document).ready(function(){
	if ($(window).width()>680) initFullscrnHover();
	mobileMenu();
});
$(window).on('resize', function() {
	if ($('body').hasClass('openMenu') && $(window).width()>680) $('body').removeClass('openMenu')
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
				$('.preview-image#'+$(this).attr('id')).addClass('showPreview')	.css({
				'background-position': bglocation,
				'background-size': bgsize
			});

			imagesLoaded($('img.loader-image#'+$(this).attr('id')), $('.preview-image#'+$(this).attr('id')), bgimg)
		});
		$(this).mouseleave(function() {
			$('html').css({
				'background-color': origbgcolor,
				'color': origtxtcolor,
				'fill': origtxtcolor
			});	
			$('.preview-image#'+$(this).attr('id')).removeClass('showPreview').css({
				'background-image': 'url()',
				'background-image': '',
				'background-position': ''
			});
		});
	});
}

function imagesLoaded(elem, container, url) {
	container.imagesLoaded()
  .progress( function( instance, image ) {
  	if ($('body').hasClass('home')) {
  		container.css({
				'background-image': 'url('+url+')',
			});
  	};
		if (container.css('background-url')!='') container.addClass('isLoaded');
  });
}
function mobileMenu() {
	$('.hamburglar-button').bind('tap',function(){
		$('body').toggleClass('openMenu');
	});	
}

