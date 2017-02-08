$(function () {
	$("#right_quick").quickInit();

});




(function( $ ) {
	
	// 퀵메뉴 열고닫기, 가로사이즈가 기준사이즈보다 작아질경우 퀵메뉴 안보이게 처리
	$.fn.quickInit = function() {
		
		var $this = this;
		var rightPos;
		var closeWidth = 80;
		var openWidth = 513

		function config(){
			$(window).resize(function () {					
				quickResize();
			});
			quickResize();
			$this.find(".btn_openClose").click(toggleQuick);			
			$this.find(".btn_kakao_counsel").click(toggleQuick);			
		}
		function quickResize(){		
			var windowW = $(window).width();
			var tx;
			if(windowW>hideW){
				tx = 0;
			}else{				
				tx = -closeWidth;
			}
			if(rightPos == tx){
				return;
			}
			
			rightPos = tx;
			$this.stop().stop().animate({right:tx+"px"}, 800,"easeOutQuint");
			
			if(tx==-closeWidth){
				quickClose();
			}
			
		}
		function quickClose(){
			tx = -closeWidth;
			$this.removeClass("open");
			tw2 = closeWidth;

			$this.find(".btn_openClose span").stop().stop().animate({left:0+"px"}, 700,"easeInOutQuint");
			$this.stop().stop().animate({right:tx+"px",width:tw2+"px"}, 800,"easeOutQuint");
			$(".dark_bg").stop().stop().animate({opacity:0}, 700,null,bgMotionComplete);
		}
		function toggleQuick(obj,isOpen){
			var b;
			
			if(obj==null){
				b = isOpen;
			}else{
				b = $this.hasClass("open");
			}
			
			var tw = $this.width();
			var tx = 0;
			var tw2;

			if(b){
				// 닫기
				tx = 0;
				$this.removeClass("open");
				tw2 = closeWidth;
				$(".dark_bg").stop().stop().animate({opacity:0}, 700,null,bgMotionComplete);
			}else{
				// 열기
				tx = -tw;
				$this.addClass("open");
				tw2 = openWidth;

				$(".dark_bg").css("display","block");
				$(".dark_bg").stop().stop().animate({opacity:1}, 700);
			}
			
			$this.find(".btn_openClose span").stop().stop().animate({left:tx+"px"}, 700,"easeInOutQuint");
			$this.stop().stop().animate({width:tw2+"px"}, 800,"easeOutQuint");
			
			

		}
		function bgMotionComplete(){
			$(".dark_bg").css("display","none");
		}
		
		config();

    };







})( jQuery );
