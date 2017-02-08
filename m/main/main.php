<?
$mn = 0;
$sn = 0;
$cn = 0;
?>
<? include "../include/head.php" ?>	
<? include "../include/head_proc.php" ?>	
<? for ( $i = 0 ; $i < $nPopCnt; $i++ ) {    // 팝업창 추가?>
	<div id="popup<?=$arrPopup[$i]['idx']?>" style="cursor:pointer; position:absolute; z-index:<?=(10000 + $i )?>; width:<?=$arrPopup[$i]['width']?>px; height:<?=$arrPopup[$i]['height']?>; left:<?=$arrPopup[$i]['left']?>px; top: <?=$arrPopup[$i]['top']?>px; display:block;">
		<table width="100%" height="<?=$arrPopup[$i]['height']?>" border="0" bordercolor="#212121" cellpadding="0" cellspacing="0">
			<tr valign="top">
				<td class="popStyle"><?=str_replace("src=\"/_data/", "src=\"".$bagData["host"]."/_data/", $arrPopup[$i]['comment'])?></td>
			</tr>
			<tr class="notice_bg">
				<td align="center">
					<table width="90%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td class="notice_black" style="font-weight:bold; text-align:left;">
								<input type="checkbox" style="width:15px;height:15px;" name="pop_cookie" onClick="set_cookie('popup<?=$arrPopup[$i]['idx']?>','doned',1);hide_popup('popup<?=$arrPopup[$i]['idx']?>');">
								<span>오늘 하루 창을 열지 않습니다.</span></td>
							<td class="notice_black" align="right"><span style="cursor:pointer;" onClick="hide_popup('popup<?=$arrPopup[$i]['idx']?>');">[닫기]</span></td>
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

	<!-- container -->
	<div id="container">	

		<!-- main_visual -->
		<div id="main_visual">
			<div class="slider_wrap">
				<ul>
					<li><a href="../intro/intro01.php"><img src="../images/main/main_visual01.jpg" alt=""/></a></li>
					<li><a href="../intro/intro03.php"><img src="../images/main/main_visual05.jpg" alt=""/></a></li>
					<li><a href="../filler/filler01.php"><img src="../images/main/main_visual02.jpg" alt=""/></a></li>
					<li><a href="../filler/filler02.php"><img src="../images/main/main_visual03.jpg" alt=""/></a></li>
					<li><a href="../waxing/waxing01.php"><img src="../images/main/main_visual04.jpg" alt=""/></a></li>				
				</ul>		
			</div>
		</div>
		<!-- //main_visual -->
		

		<!-- main_contents -->
		<section id="main_contents">
			
			<!-- hot_new -->
			<div id="hot_new">
				<h2 class="mtitle01"><img src="../images/main/title_hotnew.jpg" alt="HOT & NEW"/></h2>

				<div>
					<a href="../body/body01.php"><img src="../images/main/hotnew_img01.jpg" alt="" class="first"/></a>
					<a href="../filler/filler04.php"><img src="../images/main/hotnew_img02.jpg" alt=""/></a>
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



			<!-- main_cont01 -->
			<div id="main_cont01">
				<div id="main_consult">
					<h2><img src="../images/main/title_consult.jpg" alt=""/></h2>
					<script type="text/javascript" src="/js/customer_form.js"></script>
					<form action="/board/counsel_proc.php" method="post" enctype="multipart/form-data" name="wform" onsubmit="return counselSubmit()">
						<input type="hidden" name="tblType" value="main">
						<table>
							<colgroup>
								<col style="width:120px;">
								<col style="width:*;">
							</colgroup>	
							<tbody>		
								<tr>
									<th scope="row">이름</th>
									<td>									
										<input type="text" name="tblStrName" id="tblStrName" value="<?=$_SESSION['ss_name'];?>">
									</td>
								</tr>
								<tr>
									<th scope="row">연락처</th>
									<td>									
										<input type="text" name="tblStrMobile" id="tblStrMobile" value="<?=$_SESSION["ss_mobile"];?>">
									</td>
								</tr>
								<tr>
									<th scope="row">상담부위</th>
									<td>
										<select name="tblIntField1" id="tblIntField1" class="sel" onchange="loading_field();">
											<option value="">선택하여 주세요</option>											
											<? foreach($m_counselField1 as $k => $v) { ?>
											<option <?=($Data['tblIntField']==$k)?'selected':'';?> value="<?=$k;?>"><?=$v;?></option>
											<? } ?>
										</select>
										<select name="tblIntField2" class="sel" id="tblIntField2">
											<option value="">선택하여 주세요</option>
										</select>
									</td>
								</tr>
							</tbody>
						</table>

						<p class="t01"><img src="../images/main/counsel_txt01.png" alt=""/></p>
						<p class="t02"><input type="image" src="../images/main/btn_submit.jpg" alt=""/></p>
					</form>
				</div>

				<div class="cont_link">
					<a href="http://plus.kakao.com/home/@쁨클리닉신논현점"  target="_blank"><img src="../images/main/main_talk.jpg" alt="카톡상담" class="first"/></a>
					<a href="../community/community05.php"><img src="../images/main/main_review.jpg" alt="시술후기"/></a>
					<a href="../community/community02.php"><img src="../images/main/main_luckybox.jpg" alt="LUCKY BOX" class="first"/></a>
				</div>
			</div>
			<!-- //main_cont01 -->



			<div class="tCenter mt60">
				<a href="../intro/intro04.php"><img src="../images/main/main_location.jpg" alt=""/></a>
			</div>
			<div class="tCenter">
				<img src="../images/main/main_openclose.jpg" alt=""/>
			</div>
			
			<div class="store_location_btn">
				<a href="http://www.ppeum2.com"><img src="../images/main/btn_go01.jpg" alt=""/></a>
				<a href="http://www.ppeum3.com"><img src="../images/main/btn_go02.jpg" alt=""/></a>
			</div>


		</section>
		<!-- //main_contents -->
	
	</div>
	<!-- //container -->

<? include "../include/footer.php" ?>	