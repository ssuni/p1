<script src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/bna.js"></script>
<link href="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/css/style.css" rel="stylesheet" type="text/css">
<?if($tNum!='' && $act=='view'){	//view 페이지	?>
<div id="boardSkin">
	<div class="subjectBox"><?=$Data["subject"]?></div>
	<div class="infor">
		<ul>
			<li class="bg">작성자 : <?=$Data["name"]?></li>
			<li class="bg">작성일 : <?=str_replace("-",".",$Data["regdate"])?></li>
			<li>조회수 : <?=$Data["ref"]?></li>
		</ul><div class="clr"></div>
	</div>
	<?if( count( $Data["savefile"] ) > 0 && $boardSet["viewimage"] == 'N' ){?>
	<!----start:첨부파일 다운로드 할 경우---->
	<div class="file">
		<ul>
			<?	if( $boardSet["streaming"] == 'N' || !trim( $Data["streaming"] ) ){
					for( $i = 1; $i < count( $Data["savefile"] ); $i++ ){
						if( $Data["downimg"][$i] ){	?>
					<li>첨부파일 <?=$Data["downimg"][$i]?></li>
			<?			}
					}
				}	?>
		</ul>
	</div>
	<!----end:첨부파일 다운로드 할 경우---->
	<?}	?>


	<div class="contents" id="contents">
	전후사진 설명글 : <?=$Data["comment"];?>
			<?	if( count( $Data["savefile"] ) > 0 && $boardSet["viewimage"] == 'Y' ){
					for( $i = 0; $i < count( $Data["savefile"] ); $i++ ){
						if( $Data["openimg"][$i] ){		?>
						<div class="imgWrap"><?=$Data["openimg"][$i]?></div>
			<?			}
					}
				}
				echo "<br>";?>
	</div>
	
	<?if($_SESS["ss_level"] <= $boardSet["writelevel"]){ ?>
	<div class="btnArea2">
		<?=$view["modifylink"]?><img src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/btn_modify.gif"></a></span>&nbsp;
		<?=$view["deletelink"]?><img src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/btn_del.gif"></a></span>&nbsp;
		<a href="<?="$PHP_SELF?tb=$tb&act=list&Name=$tblStrName&Pass=$tblStrPass"?>"><img src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/btn_list.gif"></a>
	</div>
	<? } ?>
</div>
<?} //view 페이지	?>

<?//여기서부터 리스트?>

<?if($act=='view'){
		include $_SERVER['DOCUMENT_ROOT'].$bagData["mdir"]."/board/list_core.php";
		echo "<br><br><br><br><br><br><br><br><br><br>";
}?>

<div id="boardSkin">

<? if ($category_display != 'none') {	// 파트별 페이지에선 카테고리 출력안함?>

	<? if($List["categoryarr"]){ ?>
	<div id="categoryBox">
		<?=getCategoryList($List["categoryarr"]);?>
	</div>
	<? } ?>

	<div id="subjectBox" class="subjectBox"></div>

	<? } ?>

	<div id='bnf_wrap' tblname='<?=$tb;?>'>
		<strong class="subject"><? echo $Data[0]["subject"]; ?></strong>
		<div class='view_box'>
			<div class="btnarea">
				<ul class='btn'>
					<? for($i=0; $i<sizeof($Data[0]['savefile']); $i++) {
						if ($Data[0]['savefile'][$i]) {
							switch($i) {
								case '0': echo '<li><img src="<?=$bagData["mdir"];?>/board/skin/'.$boardSet["skin"].'/images/btn1.gif" alt="정면"/></li>'; break;
								case '1': echo '<li><img src="<?=$bagData["mdir"];?>/board/skin/'.$boardSet["skin"].'/images/btn2.gif" alt="45도"/></li>'; break;
								case '2': echo '<li><img src="<?=$bagData["mdir"];?>/board/skin/'.$boardSet["skin"].'/images/btn3.gif" alt="측면"/></li>'; break;
								case '3': echo '<li><img src="<?=$bagData["mdir"];?>/board/skin/'.$boardSet["skin"].'/images/btn4.gif" alt="치아"/></li>'; break;
							}
						}
					}
					?>
				</ul><div class="clr">&nbsp;</div>
			</div>
			<!--큰이미지 3셋트-->
			<ul class='img'>
				<? for($i=0; $i<sizeof($Data[0]['savefile']); $i++) {
					if ($Data[0]['savefile'][$i]) {
				?>
				<li><img src='<?=$bagData["host"].$Data[0]['savefile'][$i]?>' width="590" height="234"/></li>
				<? 
					}
				}
				?>
			</ul>
			<p><img src='<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/bnf_won.png' alt=''/></p>
		</div>
		
		<div class="comment"><?=$Data[0]['comment']?></div>
	
		<!--썸네일 큰이미지 공유-->
		<ul class='sum' id="bnalist" page="1" line_number="<?=$boardSet["mlinenumber"];?>" field="<?=$_GET['sField'];?>">
			<?	for( $i = 0; $i < $boardSet["mlinenumber"]; $i++ ) {
				if (is_array($Data[$i]["thumfile1"])) {
			?>
			<li><img src='<?=$bagData["host"].$Data[$i]["thumfile1"][0]?>' alt='<? echo $Data[$i]["subject"]; ?>' number="<? echo $Data[$i]["number"]; ?>"/><p>&nbsp;<? echo mb_strimwidth( stripslashes(addslashes($Data[$i]["subject"] )), 0, ceil(20), "..", "utf-8" ); ?></p></li>
			<? 
				}
			} ?>
		</ul><div class="clr">&nbsp;</div>
	
		<p class='next'><img src='<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/bnf_n.png' alt='next'/></p>
		<p class='prev'><img src='<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/bnf_p.png' alt='prev'/></p>
	</div>

	<div class="pageArea">
		<ul class="pagingList">
			<?	$get_val = "tb=".$tb."&act=".$act."&sSearch=".$sSearch."&sField=".$sField."&sField2=".$sField2."&sKeyword=".$sKeyword."&sGP=".$sGP."&sSecret=".$sSecret;
			include $_SERVER['DOCUMENT_ROOT'].$bagData["mdir"]."/include/page_board.php"; ?>
		</ul><div class="clr"></div>
	</div>

	<div class="btnArea_list">
		<?if($_SESS["ss_level"] <= $boardSet["writelevel"]){
		
				/* 수정하기 링크 시작 */
				$edit_url = $PHP_SELF."?tb=".$tb."&act=modify&tNum=".$Data[0]["number"];
				/* 수정하기 링크 끝   */
		
				/* 삭제하기 링크 시작 */
				$del_url = $PHP_SELF."?tb=".$tb."&act=delete&tNum=".$Data[0]["number"];
				/* 삭제하기 링크 끝   */
		?>
		<div class="img">
		<a href="<?=$edit_url;?>" id="edit_link"><img src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/btn_modify.gif" border="0"></a>&nbsp;
		<a href="<?=$del_url;?>" id="del_link" onclick="javascript:delete_confirm();"><img src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/btn_del.gif" border="0"></a>&nbsp;
		<?=$List["writelink"]?><img src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/btn_write.gif" border="0"></a>
		</div>
		<? } ?>
	</div>

</div>

<script type="text/javascript">
	function delete_confirm(){
	    if( confirm('게시물을 삭제 하시겠습니까?') )
		{
			document.location.href = document.getElementById('del_link').href;
		}
	}
</script>