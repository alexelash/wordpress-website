$(document).ready(function(){
	$('.page_item a').on('click',function(e){
		// e.preventDefault();
		// console.log('hello');
	})
	if ($(window).width()>680) initFullscrnHover();
	mobileMenu();
	imagesLoaded($('img.loader-image'), $('.image-container'), $('img.loader-image').attr('src'));
	// animsition();
});
$(window).on('resize', function() {
	if ($('body').hasClass('openMenu') && $(window).width()>680) $('body').removeClass('openMenu')
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

function animsition() {
	// $("main").animsition({
	// 	inClass: 'fade-in-up-sm',
	// 	outClass: 'fade-in-up-sm',
	// 	inDuration: 1500,
	// 	outDuration: 800,
	// 	linkElement: '.page_item a',
	// 	// e.g. linkElement: 'a:not([target="_blank"]):not([href^=#])'
	// 	loading: true,			
	// 	loadingParentElement: 'body', //animsition wrapper element
	// 	loadingClass: 'animsition-loading',
	// 	loadingInner: '', // e.g '<img src="loading.svg" />'
	// 	timeout: false,
	// 	timeoutCountdown: 5000,
	// 	onLoadEvent: true,
	// 	browser: [ 'animation-duration', '-webkit-animation-duration'],
	// 	// "browser" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
	// 	// The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
	// 	overlay: false,
	// 	overlayClass: 'animsition-overlay-slide',
	// 	overlayParentElement : 'body',
	// 	transition: function(url){ 
	// 		window.location.href = url; 
	// 		console.log(url);	
	// 	}
	// });
	// $('main').on('animsition.inEnd', function(){
	// 	imagesLoaded($('.gallery .image-container img.loader-image'), $('.gallery .image-container'));
	// })
	// $('.foo').on('animsition.inStart', function(){
		
	// })
	// $('.foo').animsition('out', $elem, url);
}
