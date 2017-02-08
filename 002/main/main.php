<?
$mn = 0;
$sn = 0;
$cn = 0;
?>
<? include "../include/head.php" ?>	
<? include "../../include/head_proc.php" ?>	
<? for ( $i = 0 ; $i < $nPopCnt; $i++ ) {    // 팝업창 추가?>
	<div id="popup<?=$arrPopup[$i]['idx']?>" style="cursor:pointer; position:absolute; z-index:<?=(1000 + $i )?>; width:<?=$arrPopup[$i]['width']?>px; height:<?=$arrPopup[$i]['height']?>; left:<?=$arrPopup[$i]['left']?>px; top: <?=$arrPopup[$i]['top']?>px; display:block;">
		<table width="100%" height="<?=$arrPopup[$i]['height']?>" border="0" bordercolor="#212121" cellpadding="0" cellspacing="0">
			<tr valign="top">
				<td class="popStyle"><?=$arrPopup[$i]['comment']?></td>
			</tr>
			<tr height="25">
				<td align="center" bgcolor="#212121"  >
					<table width="90%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td class="notice_black" style="font-weight:bold; text-align:left;">
								<input type="checkbox" style="width:14px;height:14px;" name="pop_cookie" onClick="set_cookie('popup<?=$arrPopup[$i]['idx']?>','doned',1);hide_popup('popup<?=$arrPopup[$i]['idx']?>');">
								<font color="white">오늘 하루 창을 열지 않습니다.</font></b></td>
							<td class="notice_black" align="right"><span style="cursor:pointer;font-weight:bold;" onClick="hide_popup('popup<?=$arrPopup[$i]['idx']?>');"><font color="white">[닫기]</font></span></td>
					</table>
				</td>
			</tr>
		</table>
	</div>
	<script>
	if ( get_cookie( 'popup<?=$arrPopup[$i]['idx']?>' )  == 'doned' ){
		hide_popup('popup<?=$arrPopup[$i]['idx']?>');
	}
	</script>
	<script>
	    Q_drg_drp.add('popup<?=$arrPopup[$i]['idx']?>');
	</script>
<? } ?>


	<!-- main_visual -->
	<div id="main_visual">
		<div class="slider_wrap">
			<ul>
				<li><a href="../intro/intro01.php"><img src="../images/main/main_visual01.jpg" alt=""/></a></li>
				<li><a href="../intro/intro03.php"><img src="../images/main/main_visual05.jpg" alt=""/></a></li>
				<li><a href="../laser/laser02.php"><img src="../images/main/main_visual02.jpg" alt=""/></a></li>
				<li><a href="../lifting/lifting03.php"><img src="../images/main/main_visual03.jpg" alt=""/></a></li>
				<li><a href="../waxing/waxing01.php"><img src="../images/main/main_visual04.jpg" alt=""/></a></li>				
			</ul>			
		</div>
	</div>
	<!-- //main_visual -->


	<!-- container -->
	<div id="container" class="main">
		
		<!-- hot_new -->
		<div id="hot_new" class="cont_size01">
			<h2 class="mtitle01"><img src="../images/main/title_hotnew.jpg" alt="HOT & NEW"/></h2>

			<div>
				<a href="/new/body/body01.php"><img src="../images/main/hotnew_img01.jpg" alt="" class="first"/></a>
				<a href="/new/filler/filler04.php"><img src="../images/main/hotnew_img02.jpg" alt=""/></a>
				<a href="../filler/filler07.php"><img src="../images/main/hotnew_img03.jpg" alt=""/></a>
				<a href="../waxing/waxing01.php"><img src="../images/main/hotnew_img04.jpg" alt=""/></a>
				<a href="#link" onclick="popOpen();"><img src="../images/main/hotnew_img05.jpg" alt=""/></a>
			</div>
		</div>
		<!-- //hot_new -->



		<!-- filler_event -->
		<div id="filler_event">
			<h2 class="mtitle01"><img src="../images/main/title_fillerevent.jpg" alt="PPEUM FILLER EVENT"/></h2>

			<div>
				<a href="../filler/filler03.php"><img src="../images/main/fillerevent_cont.jpg" class="cont" alt=""/></a>
			</div>
		</div>
		<!-- //filler_event -->



		

<script type="text/javascript">
function loading_field() {
	$.post("/loading_counselField.php", { tblIntField1:$('#tblIntField1').val()},function(data,state) {
		var optionHtml = '';
		for(var i=0; i<data.field.length; i++) {
			optionHtml += '<option value="'+ data.field[i] +'">'+ data.field_name[i] +'</option>';
		}
		title = '<option value="">선택하여 주세요</option>';
		$("#tblIntField2 option").remove();
		$('#tblIntField2').append(title+optionHtml);
	});
}
</script>
		<!-- main_cont01 -->
		<div id="main_cont01" class="cont_size01">
			<div id="main_consult">
				<h2><img src="../images/main/title_consult.jpg" alt=""/></h2>
				<script type="text/javascript" src="/js/customer_form.js"></script>
				<form action="/board/counsel_proc.php" method="post" enctype="multipart/form-data" name="wform" onsubmit="return counselSubmit()">
					<input type="hidden" name="tblType" value="main">
					<table>
						<colgroup>
							<col style="width:75px;">
							<col style="width:*;">
						</colgroup>	
						<tbody>		
							<tr>
								<th scope="row">이름</th>
								<td>									
									<input type="text" name="tblStrName" id="tblStrName">
								</td>
							</tr>
							<tr>
								<th scope="row">연락처</th>
								<td>									
									<input type="text" name="tblStrMobile" id="tblStrMobile">
								</td>
							</tr>
							<tr>
								<th scope="row">상담부위</th>
								<td>
									<select name="tblIntField1" id="tblIntField1" onchange="loading_field();">
										<option value="">선택하여 주세요</option>
										<? foreach($m_counselField1 as $k => $v) { ?>
										<option <?=($Data['tblIntField']==$k)?'selected':'';?> value="<?=$k;?>"><?=$v;?></option>
										<? } ?>
									</select>
									<select name="tblIntField2" id="tblIntField2">
										<option value="">선택하여 주세요</option>
									</select>
								</td>
							</tr>
						</tbody>
					</table>

					<p><img src="../images/main/counsel_txt01.jpg" alt=""/></p>
					<p><input type="image" src="../images/main/btn_submit.jpg" alt=""/></p>
				</form>
			</div>

			<div class="cont_link">
				<a href="/new/community/community04.php"><img src="../images/main/main_talk.jpg" alt="카톡상담"/></a>
				<a href="/new/community/community05.php"><img src="../images/main/main_view.jpg" alt="시술후기"/></a>
				<a href="/new/community/community02.php"><img src="../images/main/main_luckbox.jpg" alt="LUCKY BOX"/></a>
			</div>
		</div>
		<!-- //main_cont01 -->
		
		
		



		<!-- story -->
		<div id="story">
			<h2 class="mtitle01"><img src="../images/main/title_story.jpg" alt="PPEUM BRAND STORY"/></h2>

			<div class="slider_wrap">
				<span class="l_bg"></span>
				<span class="r_bg"></span>
				<ul>
					<li><img src="../images/main/story_img05.jpg" alt=""/></li>
					<li><img src="../images/main/story_img01.jpg" alt=""/></li>
					<li><img src="../images/main/story_img02.jpg" alt=""/></li>
					<li><img src="../images/main/story_img03.jpg" alt=""/></li>
					<li><img src="../images/main/story_img04.jpg" alt=""/></li>		
				</ul>			
			</div>

		</div>
		<!-- //story -->

		<!-- location -->
		<div id="location">
			<img src="../images/main/pc_main_location.jpg" alt=""/>			
			<ul>
				<li class="active"><a href="http://www.ppeum2.com">강남점</a></li>
				<li><a href="http://www.ppeum1.com" target="_blank">신논현점</a></li>
				<li><a href="http://www.ppeum3.com" target="_blank">청담점</a></li>
			</ul>
		</div>
		<!-- //location -->
		

		


	</div>
	<!-- //container -->

<? include "../include/footer.php" ?>	