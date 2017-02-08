$(document).ready(function(){
	/**전후사진**/
	if(document.getElementById('bnf_wrap')){
		var big_btn = $('.view_box .btn li');
		var big_img = $('.view_box .img li');
		var sum_btn = $('#bnf_wrap .sum li');
		var tblname = $('#bnf_wrap').attr('tblname');
		var skin = $('#bnf_wrap').attr('skin');
		var over = 0;
		var time = 3000;
		var max = big_btn.length-1;
		var res=null;
		var bnf_id=null;
		var chk=null;

		big_btn.click(function(e){clearInterval(bnf_id); chk=$(this).index(); if(over!=chk){res=over;over=chk; activeEvent(); bnfPlay();}});

		function activeEvent(){
			var big_btn = $('.view_box .btn li');
			var big_img = $('.view_box .img li');
			if (big_img.size() >=1) {
				big_btn.each(function(){$(this).find('img').attr('src',$(this).find('img').attr('src').replace('_ov.gif','.gif'));});
				big_btn.eq(over).find('img').attr('src',big_btn.eq(over).find('img').attr('src').replace('.gif','_ov.gif'));
				big_img.eq(res).css({'z-index':'1'}).stop().animate({opacity:0},1000);
				big_img.eq(over).css({'z-index':'2'}).stop().animate({opacity:1},1000);
			}
		}
		
		function off_img(){
			if(sum_btn.length<=4){
				$('#bnf_wrap .next').css({top:640});
				$('#bnf_wrap .prev').css({top:640});
			}else{
				$('#bnf_wrap .next').css({top:400});
				$('#bnf_wrap .prev').css({top:400});
			}
			
			big_img.each(function(){$(this).css({'z-index':'1'}).stop().animate({opacity:0},0);});
			big_img.eq(over).css({'z-index':'2'}).stop().animate({opacity:1},0);
			sum_btn.each(function(i){
				$(this).find('img').stop().animate({opacity:.5},0);if(i%3 == 2){$(this).css({'margin-right':0})}})
 				sum_btn.find('img').eq(over).stop().animate({opacity:1},0);
		};
		function bnfPlay(){bnf_id = setInterval(function(){next_bnf();},time)};
		function restart(){clearInterval(bnf_id);over = 0;off_img();activeEvent();bnfPlay();}
    	function next_bnf(){
			var max = $('.view_box .btn li') .length-1;
			if(over == max){res = over;over = 0;activeEvent();}else{res = over;over++;activeEvent();}
		}
		//function prev_bnf(){if(over == 0){res = over;over = max;activeEvent();}else{res = over;over--;activeEvent();}}
		function sum_btnClick() {
			var sum_btn = $('#bnf_wrap .sum li');
			/*섬네일 클릭시 큰이미지 교체 이벤트 재시작*/
			sum_btn.on('click',function(e){
				var number = $(e.target).attr('number');
				if ($('#edit_link'))
				{
					$('#edit_link').attr('href', '/admin/community.php?tb='+tblname+'&act=modify&tNum='+number);
					$('#del_link').attr('href', '/admin/community.php?tb='+tblname+'&act=delete&tNum='+number);
				}
				/**아작스 연동**/
				$.get('/board/ajax.board_bna.php?number='+number+'&tb='+tblname,
					function(data,state){
						clearInterval(bnf_id);
						over = 0;activeEvent();bnfPlay();

						var jsonObj = JSON.parse(data)
						$('.view_box .btn').html(jsonObj.bnf_wrap_btn);
						$('#bnf_wrap .subject').html(jsonObj.subject);
						$('.view_box .img').html(jsonObj.bnf_wrap_li);

						$('.view_box .btn li').click(function(e){clearInterval(bnf_id); chk=$(this).index(); if(over!=chk){res=over;over=chk; activeEvent(); bnfPlay();}});
					}
				);	
				sum_btn.each(function(){$(this).find('img').stop().animate({opacity:.5},0);});
				$(this).find('img').stop().animate({opacity:1},0);
			});
		}
		restart();
		sum_btnClick();

		/*이전컨텐츠 클릭시 큰이미지 교체,썸네일교체 이벤트 재시작*/
		$('#bnf_wrap .prev').on('click',function(e){
			var bnalist = $('#bnalist');
			var page = eval(bnalist.attr('page'))-1;
			var last_page = bnalist.attr('last_page');
			var line_number = bnalist.attr('line_number');
			var field = bnalist.attr('field');
			if (bnalist.attr('page') == 1) {
				//alert('처음 데이터 입니다.');
				/**아작스 연동**/
				$.get('/board/ajax.board_bna_page.php?page='+last_page+'&line_number='+line_number+'&field='+field+'&tblname='+tblname,
					function(data,state){
						var jsonObj = JSON.parse(data);
						$('#bnf_wrap .subject').html(jsonObj.subject);
						$('#bnf_wrap .sum').html(jsonObj.bnf_wrap_li);
						$('#bnalist').attr('page', jsonObj.page);
						$('#bnalist').attr('line_number', jsonObj.line_number);
						sum_btnClick();
					}
				);
			} else {
				/**아작스 연동**/
				$.get('/board/ajax.board_bna_page.php?page='+page+'&line_number='+line_number+'&field='+field+'&tblname='+tblname,
					function(data,state){
						var jsonObj = JSON.parse(data);
						$('#bnf_wrap .subject').html(jsonObj.subject);
						$('#bnf_wrap .sum').html(jsonObj.bnf_wrap_li);
						$('#bnalist').attr('page', jsonObj.page);
						$('#bnalist').attr('line_number', jsonObj.line_number);
						sum_btnClick();
					}
				);
			}
		});

		/*다음컨텐츠 클릭시 큰이미지 교체,썸네일교체 이벤트 재시작*/
		$('#bnf_wrap .next').on('click',function(e){
			var bnalist = $('#bnalist');
			var page = eval(bnalist.attr('page'))+1;
			var line_number = bnalist.attr('line_number');
			var field = bnalist.attr('field');

			/**아작스 연동**/
				$.get('/board/ajax.board_bna_page.php?page='+page+'&line_number='+line_number+'&field='+field+'&tblname='+tblname,
				function(data,state){
					var jsonObj = JSON.parse(data);
					if (jsonObj != null) {
						$('#bnf_wrap .subject').html(jsonObj.subject);
						$('#bnf_wrap .sum').html(jsonObj.bnf_wrap_li);
						$('#bnalist').attr('page', jsonObj.page);
						$('#bnalist').attr('line_number', jsonObj.line_number);
						sum_btnClick();
					} else {
						alert('마지막 데이터 입니다.');
					}
				}
			);
		});
	};
});