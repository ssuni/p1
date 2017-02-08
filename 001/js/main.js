$(function () {
	// 메인비주얼 
	var slider1 = $('#main_visual .slider_wrap ul').bxSlider({		
		auto : true,
		mode:'vertical',
		pager : true,
	});

	$(document).on('click','#main_visual',function() {
		slider1.stopAuto();
		slider1.startAuto();
	});





	// 브랜드 스토리
	var slider3 = $('#story .slider_wrap ul').bxSlider({		
		auto : true,
		pager : false,
		slideWidth: 920,
		maxSlides: 3,
		moveSlides:1,
	});

	$(document).on('click','#story',function() {
		slider3.stopAuto();
		slider3.startAuto();
	});


		
	
	



});



(function( $ ) {




})( jQuery );
