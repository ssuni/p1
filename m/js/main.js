$(function () {
	// 메인비주얼 
	var slider1 = $('#main_visual .slider_wrap ul').bxSlider({		
		auto : true,
		pager : true,
	});

	$(document).on('click','#main_visual',function() {
		slider1.stopAuto();
		slider1.startAuto();
	});



});



(function( $ ) {




})( jQuery );
