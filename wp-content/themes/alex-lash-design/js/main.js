$(document).ready(function(){
	initFullscrnHover();
});
function initFullscrnHover() {
	$('.project').hover(function() {
		$('html').css('background-color', $(this).find('a').data('bgcolor'));
	},function() {
		$('html').css('background-color', $('html').data('origcolor'));	
	});
}