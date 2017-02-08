<link href="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/css/board.css" rel="stylesheet" type="text/css">
<?if($tNum!='' && $act=='view'){	//view 페이지	?>
<div id="boardSkin">
	<div class="subjectBox"><?=$Data["subject"]?></div>
	<div class="infor">
		<ul>
			<li class="bg">작성자 : <?=$Data["name"]?></li>
			<li class="bg">작성일 : <?=str_replace("-",".",$Data["regdate"])?></li>
			<? if ($_SESSION['ss_level'] == 1) { ?>
			<li class="bg">연락처 : <?=$Data["mobile"]?></li>
			<? } ?>
		</ul><div class="clr"></div>
	</div>
	<?if( count( $Data["savefile"] ) > 0 && $boardSet["viewimage"] == 'N' ){?>
	<!----start:첨부파일 다운로드 할 경우---->
	<div class="file">
		<ul>
			<?	if( $boardSet["streaming"] == 'N' || !trim( $Data["streaming"] ) ){
					for( $i = 0; $i < count( $Data["savefile"] ); $i++ ){
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
			<?	if( count( $Data["savefile"] ) > 0 && $boardSet["viewimage"] == 'Y' ){
					for( $i = 0; $i < count( $Data["savefile"] ); $i++ ){
						if( $Data["openimg"][$i] ){		?>
						<div class="imgWrap"><?=$Data["openimg"][$i]?></div>
			<?			}
					}
				}
				echo "<div class='counselQ'>[상담내용]</div> ".nl2br($Data["comment"]);?>
	</div>
	<? if($Data["reply"] != '') { ?>
	<div class="contents">
		<? echo "<div class='counselA'>[답변내용]</div> ".nl2br($Data["reply"]);?>
	</div>
	<? } ?>

	<div class="btnArea2">
		<? if($Data["reply"] == '') { ?>
		<?=$view["modifylink"]?><img src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/btn_modify.gif"></a></span>&nbsp;
		<?=$view["deletelink"]?><img src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/btn_del.gif"></a></span>&nbsp;
		<? } ?>
		<a href="<?="$PHP_SELF?tb=$tb&act=list&Name=$tblStrName&Pass=$tblStrPass"?>"><img src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/btn_list.gif"></a>
	</div>
</div>
<script>
	function img_resize(){
		maxsize = 550;
		var content;
		var img;
		if(document.getElementById("contents")){
			content=document.getElementById("contents");
			if(content.getElementsByTagName("img")){
				img = content.getElementsByTagName("img");
				for(i=0;i<img.length;i++){
					if(eval('img[' + i + '].width > maxsize')){
						eval('img[' + i + '].width = maxsize');
					}
				}
			}
		}
	}
	window.onload = img_resize; 
</script>
<?} //view 페이지	?>

<?//여기서부터 리스트?>

<?if($act=='view'){
		include $_SERVER['DOCUMENT_ROOT'].$bagData["mdir"]."/board/list_core.php";
		echo "<br><br><br>";
}?>
<div id="boardSkin">
	<div id="searchBox">
		<form name="inputFrm" method="get" action="<?=$PHP_SELF?>">
			<input type="hidden" name="tb" value="<?=$tb?>">
			<select name="sSearch" id="sSearch">
				<option value="tblStrSubject" <?=($sSearch == 'tblStrSubject')?"selected":""?>>글제목</option>
				<option value="tblStrComment" <?=($sSearch == 'tblStrComment')?"selected":""?>>글내용</option>
				<option value="tblStrName" <?=($sSearch=='tblStrName')?"selected":""?>>글쓴이</option>
			</select>
			<input name="sKeyword" id="sKeyword" value="<?=$sKeyword?>" type="text" class="textForm" style="width:200px;">
			<input type="image" src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/btn_search_list.gif" class="middleCon">
		</form>
	</div>
	
	<div id="categoryBox">
		<?=getCategoryList($List["categoryarr"]);?>
		<?
			$cate_display = false;
		?>
	</div>

	<table summary="" id="boardList">
		<colgroup>
			<col width="100" />
			<col width="*" />
			<col width="120" />
		</colgroup>
		<thead>
			<tr>
				<th>번호</th>
				<th>내용</th>
				<th>처리현황</th>
			</tr>
		</thead>
		<tbody>		
		<?		for( $i = 0; $i < $lTmp; $i++ ){
				## 공지일경우 ##
				if( $Data[$i]["notice"] == '1' ){	?>
			<tr class="notice">
				<td class="td1">공지</td>
				<td class="td2">
					<div class="t_subject"><?=$Data[$i]["viewlink"].$Data[$i]["subject"]."</a>".$Data[$i]["newimg"].$Data[$i]["fileIcon"]?></a></div>
					<div class="t_info">
						<?=$Data[$i]["name"]?> / <?=str_replace("-",".",$Data[$i]["regdate"])?>
					</div>
				</td>
				<td class="counsel">&nbsp;</td>
			</tr>
		<?		}
				## 공지일경우 ##
				else{	?>
			<tr>
				<td class="td1"><?=$Data[$i]["noticeImg"]?></td>
				<td class="td2">
					<div class="t_category"><?=$List["categoryarr"][$Data[$i]["field"]-1]?></div>
					<div class="t_subject"><?=$Data[$i]["keyimg"].$Data[$i]["viewlink"].$Data[$i]["subject"].$Data[$i]["newimg"].$Data[$i]["fileIcon"]?></a></div>
					<div class="t_info">
						<?=$Data[$i]["name"]?> / <?=str_replace("-",".",$Data[$i]["regdate"])?>
					</div>
				</td>
				<td class="counsel"><?=$Data[$i]["answerimg"]?></td>
			</tr>		<?		}
			}
			if( $lTmp == 0 ){	?>
			<!--글이 없을 때-->
			<tr>
				<td colspan="3" align="center" height="100">등록된 게시글이 없습니다.</td>
			</tr>
		<?	}	?>
		</tbody>
	</table>
	<div class="pageArea">
		<ul class="pagingList">
	<?	$get_val = "tb=".$tb."&act=".$act."&sSearch=".$sSearch."&sField=".$sField."&sField2=".$sField2."&sKeyword=".$sKeyword."&sGP=".$sGP."&sSecret=".$sSecret;
	include $_SERVER['DOCUMENT_ROOT'].$bagData["mdir"]."/include/page_board.php"; ?>
		</ul><div class="clr"></div>
	</div>
	<div class="btnArea">
		<?if($_SESS["ss_level"] <= $boardSet["writelevel"]){?><?=$List["writelink"]?><img src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/btn_write.gif" class="img" border="0"></a><?}?>
	</div>
</div>