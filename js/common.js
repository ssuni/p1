$(function () {

	// 이미지 onoff 효과
	$(".img_onoff").mouseover(imgOnOffOver).mouseout(imgOnOffOut);
	function imgOnOffOver(){
		var src = $(this).find('img').attr('src');	
		src = src.replace("_ov","");
		src2 = src.replace(".png","_ov.png");
		src2 = src.replace(".jpg","_ov.jpg");
		$(this).find('img').attr('src',src2);
		$(this).addClass("on");
	}
	function imgOnOffOut(){
		var src = $(this).find('img').attr('src');	
		src2 = src.replace("_ov.png",".png");
		src2 = src.replace("_ov.jpg",".jpg");
		$(this).find('img').attr('src',src2);
		$(this).removeClass("on");
	}

	



	
	// 마우스휠 동작
	$('#header').mousewheel(function(event) {

		event.preventDefault();			
		var scrollTop = this.scrollTop;			
		this.scrollTop = (scrollTop + ((event.deltaY * event.deltaFactor) * -1));
	});

	$('#right_quick').mousewheel(function(event) {

		event.preventDefault();			
		var scrollTop = this.scrollTop;			
		this.scrollTop = (scrollTop + ((event.deltaY * event.deltaFactor) * -1));
	});

	$('#right_banner').mousewheel(function(event) {

		event.preventDefault();			
		var scrollTop = this.scrollTop;			
		this.scrollTop = (scrollTop + ((event.deltaY * event.deltaFactor) * -1));
	});


	

	
	/*
	$(window).resize(function () {					
		windowResize();
	});	
	windowResize();
	*/

});


