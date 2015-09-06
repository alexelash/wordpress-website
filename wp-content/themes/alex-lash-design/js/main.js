$(document).ready(function(){
	initFullscrnHover();
});
function initFullscrnHover() {
	$('.project').hover(function() {
		$('html').css({
			'background-color': $(this).find('a').data('bgcolor'),
			'background-image': 'url('+$(this).find('a').data('bgimg')+')',
			'background-position': $(this).find('a').data('bglocation')
		});
	},function() {
		$('html').css({
			'background-color': $('html').data('origcolor'),
			'background-image': '',
			'background-position': ''
		});	
	});


	// ajaxifyThumbs();
}
function ajaxifyThumbs(theThumb) {
	// $.ajax({
 //    type: 'POST',
 //    url: theThumb,
 //    // data: 'formName=register&penewuser='+newName+'',
 //    success: function(data){
 //        var usernameCount = data;
 //        if(1 == usernameCount){
 //            $('#penewuser').next('.error').css('display', 'inline');
 //        } else {
 //            $('#penewuser').next('.error').css('display', 'none');
 //        }
 //    },
 //    dataType: 'html'
	// });
}