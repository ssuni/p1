
$(document).ready(function(){
    set_gallery();
});

function set_gallery(){
  
  var $btnItem_m= $('#gallery_wrap>.tep_m>li');
  var $sum_box= $('#gall_box>#gall_sum');
  var $imgItem = null;
  var $nextBtn=null;
  var $nprevBtn=null;
  var $titles=null;
  var max_m = $btnItem_m.length-1;
  var max_s = null;
  var over_m =0;
  var res_m = over_m;
  var over_s =0;
  var res_s = over_s;
  var geb = $('#gallery_wrap').width();
  var spd = 1000;
  var time = 3000;
  var chkOn = {'background':'#0ca5af','border':'1px solid #221f1f'};
  var chkOff = {'background':'#463e3e','border':'1px solid #221f1f'};
  var dph = 140;
  var mrn = 16;
  
  $("#gallery_wrap>.titlebox").html(title_conts[1]); 
  $("#gallery_wrap>.imgbox").html(img_conts[1]);

  function init(){$btnItem_m.eq(over_m).css(chkOn);} init();
  function init_s(){$imgItem=$('#gallery_wrap>.imgbox>li'); $nextBtn=$('#gallery_wrap>.right_btn'); $prevBtn=$('#gallery_wrap>.left_btn'); $titles=$('#gallery_wrap>.titlebox>li'); $titles.css("display","none"); max_s = $imgItem.length-1; over_s =0; res_s = over_s; $imgItem.css({left:geb}); $imgItem.eq(over_s).css({left:0}); $titles.eq(over_s).css("display","block");}
  function removeEvent_m(){$btnItem_m.css(chkOff);} 
  function activeEvent_m(){removeEvent_m(); $btnItem_m.eq(over_m).css(chkOn);}
  $btnItem_m.on("mouseenter",function(e){removeEvent_m(); $(this).css(chkOn);});
  $btnItem_m.on("mouseleave",function(e){activeEvent_m();});
  $btnItem_m.on("click",function(e){res_m = over_m; if ($imgItem.is(':animated')){return false;} $("#gallery_wrap>.titlebox").html(title_conts[($(this).index()+1)]); $("#gallery_wrap>.imgbox").html(img_conts[($(this).index()+1)]); set_content(); if(over_m!=$(this).index()){over_m = Number($(this).index()); activeEvent_m();}});
  
  /**********************************************************************************************************************/

  function set_content(){
	init_s();
	var sums = '';
	var bh = dph;
	for(var i=0; i<=max_s; i++){
	   if(i%4 == 3){
		 sums += "<li class='chk'><img src="+$imgItem.eq(i).find('img').attr('src')+" alt=''/></li>";
		 if(max_s>i){bh+=(dph+mrn);} 
	   }else{
		 sums += "<li><img src="+$imgItem.eq(i).find('img').attr('src')+" alt=''/></li>";
	   }
	   
	}
	$sum_box.html(sums);

	$sum_box.find('li').css({width:$sum_box.width()/4-mrn,height:dph,'float':'left','border':'1px solid #e6e6e6','margin-right':mrn,'margin-bottom':mrn,'cursor':'pointer'});
	$sum_box.find('li.chk').css({'margin-right':0});
	$sum_box.find('li>img').css({width:$sum_box.width()/4-mrn,height:dph,opacity:.5});
	$sum_box.css({height:bh+(mrn*2)});
	$sum_box.find('li').eq(over_s).find('img').css({opacity:1});
	$sum_box.find('li').on("click",function(e){if($imgItem.is(':animated')){return false;} if(over_s !=$(this).index()){res_s = over_s; over_s =$(this).index(); activeEvent_n();}});

	$nextBtn.on("click",function(e){if($imgItem.is(':animated')){return false;} nextBox();});
    $prevBtn.on("click",function(e){if($imgItem.is(':animated')){return false;} prevBox();});
    function removeEvent_s(){$titles.css("display","none");} 
    function activeEvent_n(){removeEvent_s(); $titles.eq(over_s).css("display","block"); $imgItem.eq(over_s).css({left:geb}); $imgItem.eq(over_s).stop().animate({left:0},spd,"easeInOutExpo"); $imgItem.eq(res_s).stop().animate({left:-geb},spd,"easeInOutExpo"); $sum_box.find('li>img').css({opacity:.5}); $sum_box.find('li').eq(over_s).find('img').css({opacity:1});}
    function activeEvent_p(){removeEvent_s(); $titles.eq(over_s).css("display","block"); $imgItem.eq(over_s).css({left:-geb}); $imgItem.eq(over_s).stop().animate({left:0},spd,"easeInOutExpo"); $imgItem.eq(res_s).stop().animate({left:geb},spd,"easeInOutExpo"); $sum_box.find('li>img').css({opacity:.5}); $sum_box.find('li').eq(over_s).find('img').css({opacity:1});}
    function nextBox(){if(over_s == max_s){res_s = over_s; over_s = 0; activeEvent_n();}else{res_s = over_s; over_s++; activeEvent_n();}}
    function prevBox(){if(over_s == 0){res_s = over_s; over_s = max_s; activeEvent_p();}else{res_s = over_s; over_s--; activeEvent_p();}}
  }
  set_content();
}
    var title_conts = new Array();
	var img_conts = new Array();
	
	/*전체보기*/
	title_conts[1] = "<li>바라본성형외과 내부전경</li>";
	title_conts[1] += "<li>바라본성형외과 내부전경</li>";
	title_conts[1] += "<li>바라본성형외과 내부전경</li>";
	title_conts[1] += "<li>바라본성형외과 내부전경</li>";
	title_conts[1] += "<li>바라본성형외과 내부전경</li>";
	title_conts[1] += "<li>바라본성형외과 내부전경</li>";
	title_conts[1] += "<li>바라본성형외과 내부전경</li>";
	title_conts[1] += "<li>바라본성형외과 내부전경</li>";
	title_conts[1] += "<li>바라본성형외과 내부전경</li>";
	title_conts[1] += "<li>바라본성형외과 내부전경</li>";
	title_conts[1] += "<li>바라본성형외과 내부전경</li>";
	title_conts[1] += "<li>바라본성형외과 내부전경</li>";
	title_conts[1] += "<li>바라본성형외과 내부전경</li>";
	title_conts[1] += "<li>바라본성형외과 내부전경</li>";
	title_conts[1] += "<li>바라본성형외과 내부전경</li>";
	title_conts[1] += "<li>바라본성형외과 내부전경</li>";

	
	img_conts[1] = "<li><img src='../images/gallery/img1.jpg' alt=''/></li>";
	img_conts[1] += "<li><img src='../images/gallery/img2.jpg' alt=''/></li>";
	img_conts[1] += "<li><img src='../images/gallery/img3.jpg' alt=''/></li>";
	img_conts[1] += "<li><img src='../images/gallery/img4.jpg' alt=''/></li>";
	img_conts[1] += "<li><img src='../images/gallery/img5.jpg' alt=''/></li>";
	img_conts[1] += "<li><img src='../images/gallery/img6.jpg' alt=''/></li>";
	img_conts[1] += "<li><img src='../images/gallery/img7.jpg' alt=''/></li>";
	img_conts[1] += "<li><img src='../images/gallery/img8.jpg' alt=''/></li>";
	img_conts[1] += "<li><img src='../images/gallery/img9.jpg' alt=''/></li>";
	img_conts[1] += "<li><img src='../images/gallery/img10.jpg' alt=''/></li>";
	img_conts[1] += "<li><img src='../images/gallery/img11.jpg' alt=''/></li>";
	img_conts[1] += "<li><img src='../images/gallery/img12.jpg' alt=''/></li>";
	img_conts[1] += "<li><img src='../images/gallery/img13.jpg' alt=''/></li>";
	img_conts[1] += "<li><img src='../images/gallery/img14.jpg' alt=''/></li>";
	img_conts[1] += "<li><img src='../images/gallery/img15.jpg' alt=''/></li>";
	img_conts[1] += "<li><img src='../images/gallery/img16.jpg' alt=''/></li>";
	
