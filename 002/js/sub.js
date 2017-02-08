$(function () {
	


	// 제휴사
	var slider4 = $('#sub_cooperation .slider_wrap ul').bxSlider({		
		auto : false,
		pager : false,
	});

	$(document).on('click','#sub_cooperation .bx-pager',function() {
		slider4.stopAuto();
		slider4.startAuto();
	});	


	

	$("#intro_gallery").galleryInit();

});



(function( $ ) {
	

	$.fn.galleryInit = function() {
		
		var $this = this;
		var max = 8;
		var cur = 0;

		function config(){
			
			max = $this.find(".btn_list li").length;

			$this.find(".btn_list li").click(btnClick);		
			$this.find(".btn_prev").click(prevClick);
			$this.find(".btn_next").click(nextClick);

			viewGallery(0);
		}		
		function btnClick(){
			var idx = $(this).index();
			viewGallery(idx);
		}			
		function prevClick(){
			cur--;
			if(cur<0){
				cur = max-1;
			}
			viewGallery(cur);
		}
		function nextClick(){
			cur++;
			if(cur>=max){
				cur = 0;
			}
			viewGallery(cur);
		}
		function viewGallery(n){
			
			$this.find(".btn_list li").removeClass("on");
			$this.find(".btn_list li").eq(n).addClass("on");


			$this.find(".timg li").each(function (i) {				
				if(i==n){				  				   
				   $(this).css("display","block");
				   $(this).stop().stop().animate({opacity:1}, {duration: 400});
				}else{	
				   $(this).stop().stop().animate({opacity:0}, {duration: 400});
				}				
			});
			$this.find(".bcont li").each(function (i) {				
				if(i==n){
				   $(this).css("display","block");
				   $(this).stop().stop().animate({opacity:1}, {duration: 400});
				}else{	
					$(this).stop().stop().animate({opacity:0}, {duration: 400});
				}				
			});
		}
		function end(){
			$this.removeClass("open");
		}
		

		config();

    };

	
})( jQuery );
