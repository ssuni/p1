$(function () {
	$(this).menuInit();
});



(function( $ ) {

	$.fn.menuInit = function() {
		
		var $this = this;		

		function config(){
			$this.find(".btn_menu").click(menuToggle);
			$this.find(".gnb_list > li > a").click(menuClick);
			
		}
		function menuToggle(){
			$this.find("#gnb").toggle();
			$this.find("#gnb > ul > li").removeClass("active");
			$this.find("#gnb .sub").css("display","none");
		}			
		function menuClick(){
			var $target = $(this).parent();
			$this.find("#gnb > ul > li").removeClass("active");
			$target.addClass("active");
			$this.find("#gnb .sub").css("display","none");
			$target.find(".sub").css("display","block");
		}		
		
		

		config();

    };






})( jQuery );
