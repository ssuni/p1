$(function () {
	$("#gnb").menuInit();
});



(function( $ ) {

	$.fn.menuInit = function() {
		
		var $this = this;
		var pre = -1;
		var interval;
		var max = 6;
		var menuHeight = 55;

		function config(){


			$this.find(".gnb_list > li").mouseover(oneOver);			
			$this.find(".gnb_list .sub a").mouseover(twoOver).mouseout(twoOut);			

			$this.mouseover(areaOver).mouseout(areaOut);
				
			clearTimeout(interval);
			interval = setTimeout(intervalFn, 200);			
		}		
		function oneOver(){
			var idx = $(this).index();
			onePlayFn(idx,true);
		}	
		function twoOver(){
			var n = $(this).parent().parent().parent().index();
			var src = $(this).find('img').attr('src');				
			var src2="";
			src = src.replace("_ov","");
			src2 = src.replace(".png","_ov.png");
			$(this).find(' img').attr('src',src2);
			onePlayFn(n,true);
		}
		function twoOut(){			
			var src = $(this).find('img').attr('src');				
			var src2="";
			src2 = src.replace("_ov.png",".png")
		    $(this).find('img').attr('src',src2);

		}
		function areaOver(){
			clearTimeout(interval);
		}
		function areaOut(){
			clearTimeout(interval);
            interval = setTimeout(intervalFn, 200);
		}
		function intervalFn(){
			onePlayFn(mn-1,false);
		}
		function onePlayFn(n,b){
			
			$this.find(".gnb_list > li").each(function (i) {
				var src = $(this).find('>a img').attr('src');				
				var src2="";
				if(i==n){
				   $(this).addClass("active");
				   src = src.replace("_ov","");
				   src2 = src.replace(".png","_ov.png");
				   $(this).find('> a img').attr('src',src2);
				}else{
				   $(this).removeClass("active");
				   src2 = src.replace("_ov.png",".png")
				   $(this).find('> a img').attr('src',src2);
				}
				
			});
		

			
			var th;
			if(n<0 || !b){
				th = 55;
			}else{
				th = 310;
				$this.addClass("open");
			}
			
			if(menuHeight== th){
				return;
			}
			menuHeight = th;
			if(th==55){
				$this.stop().stop().animate({height:th+"px"}, {duration: 450,complete:end});
			}else{
				$this.stop().stop().animate({height:th+"px"}, {duration: 450});
			}			
			
		}
		function end(){
			$this.removeClass("open");
		}
		

		config();

    };






})( jQuery );
