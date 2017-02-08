<script src="/board/skin/<?=$boardSet["skin"];?>/bna.js"></script>
<link href="/board/skin/<?=$boardSet["skin"];?>/css/style.css" rel="stylesheet" type="text/css">
<?if($tNum!='' && $act=='view'){	//view 페이지	?>
<div id="boardSkin">
	<div class="subjectBox2"><?=$Data["subject"]?></div>
	<div class="infor">
		<ul><li>전후사진 설명글 : <?=$Data["comment"];?></li></ul>
	</div>


	<div class="contents" id="contents">
			<?	if( count( $Data["savefile"] ) > 0 && $boardSet["viewimage"] == 'Y' ){
					for( $i = 0; $i < count( $Data["savefile"] ); $i++ ){
						if( $Data["openimg"][$i] ){
							switch($i) {
								case '0': echo '<h2>정면</h2>'; break;
								case '1': echo '<h2>45도</h2>'; break;
								case '2': echo '<h2>측면</h2>'; break;
							}
			?>
						<div class="imgWrap"><img src="<?=$Data["file_img"][$i]?>"/></div>
			<?			}
					}
				}
				echo "<br>";?>
	</div>
	
	<?if($_SESS["ss_level"] <= $boardSet["writelevel"]){ ?>
	<div class="btnArea2">
		<?=$view["modifylink"]?><img src="/board/skin/<?=$boardSet["skin"];?>/images/btn_modify.gif"></a></span>&nbsp;
		<?=$view["deletelink"]?><img src="/board/skin/<?=$boardSet["skin"];?>/images/btn_del.gif"></a></span>&nbsp;
		<a href="<?="$PHP_SELF?tb=$tb&act=list&Name=$tblStrName&Pass=$tblStrPass"?>"><img src="/board/skin/<?=$boardSet["skin"];?>/images/btn_list.gif"></a>
	</div>
	<? } ?>
</div>
<?} //view 페이지	?>

<?//여기서부터 리스트?>

<?if($act=='view'){
		include $_SERVER['DOCUMENT_ROOT']."/board/list_core.php";
		echo "<br><br><br><br><br><br><br><br><br><br>";
}?>

<div id="boardSkin">

<? if ($category_display != 'none') {	// 파트별 페이지에선 카테고리 출력안함?>
	<div id="searchBox">
		<form name="inputFrm" method="post" action="<?=$PHP_SELF?>">
			<input type="hidden" name="tb" value="<?=$tb?>">
			<input type="hidden" name="act" value="<?=$act?>">
			<input type="hidden" name="sField" value="<?=$sField?>">
			<input type="hidden" name="sField2" value="<?=$sField2?>">
			<select name="sSearch" id="sSearch">
				<option value="tblStrSubject" <?=($sSearch == 'tblStrSubject')?"selected":""?>>글제목</option>
				<option value="tblStrComment" <?=($sSearch == 'tblStrComment')?"selected":""?>>글내용</option>
				<option value="tblStrName" <?=($sSearch=='tblStrName')?"selected":""?>>글쓴이</option>
			</select>
			<input name="sKeyword" id="sKeyword" value="<?=$sKeyword?>" type="text" class="textForm" style="width:120px;">
			<input type="image" src="/board/skin/<?=$boardSet["skin"];?>/images/btn_search_list.gif" class="middleCon">
		</form>
	</div>
	<div class="cate">
		<div id="categoryBox"><?=getCategoryList($List["categoryarr"]);?></div>
	</div>

	<div id="subjectBox" class="subjectBox"></div>

	<? } ?>

	<table summary="" id="boardList">
		<colgroup>
			<col width="80" />
			<!--<col width="80" />-->
			<col width="150" />
			<col width="*" />
			<col width="120" />
			<col width="100" />
		</colgroup>
		<thead>
			<tr>
				<th>번호</th>
				<!--<th>분류</th>-->
				<th>이미지</th>
				<th>글제목</th>
				<th>공개여부</th>
				<th>작성일</th>
			</tr>
		</thead>
		<tbody>
		<?		for( $i = 0; $i < $lTmp; $i++ ){
				## 공지일경우 ##
				if( $Data[$i]["notice"] == '1' ){	?>
			<tr class="notice">
				<td class="best"><img src="/board/skin/<?=$boardSet["skin"];?>/images/icon_best.gif" alt="best" /></td>
				<!--<td class="td2">&nbsp;</td>-->
				<td class="td7"><div class="img"><?=$Data[$i]["viewlink"]?><img src="<?if($Data[$i]["thumfile1"][0]!=''){?><?=$Data[$i]["thumfile1"][0]?><?}else{?>/board/skin/<?=$boardSet["skin"];?>/images/noimg.jpg<?}?>" class="noimg" width="150" height="120"></a></div></td>
				<td class="td3">
					<div class="cate"><?
						$ary_data = getArrayString($Data[$i]["field"]);
						foreach($ary_data['data'] as $k => $v) echo '['.$List["categoryarr"][$v-1].']';
					?></div>
					<div class="sj"><?=$Data[$i]["viewlink"].$Data[$i]["subject"].$Data[$i]["newimg"].$Data[$i]["fileIcon"]?></a></div>
					<div class="content"><?=$Data[$i]["comment"]?></div>
				</td>
				<td class="view"><div class="icon"><img src="/board/skin/<?=$boardSet["skin"]?>/images/<?=($Data[$i]["show"]=='N')?'icon_view_no.gif':'icon_view.gif'?>"></div></td>
				<td class="date"><?=str_replace("-",".",$Data[$i]["regdate"])?></td>
			</tr>
		<?		}
				else{	?>
			<tr>
				<td class="td1"><?=$Data[$i]["noticeImg"]?></td>
				<!--<td class="td2"><?=$List["categoryarr"][$Data[$i]["field"]]?></td>-->
				<td class="td7"><div class="img"><?=$Data[$i]["viewlink"]?><img src="<?if($Data[$i]["thumfile1"][0]!=''){?><?=$Data[$i]["thumfile1"][0]?><?}else{?>/board/skin/<?=$boardSet["skin"];?>/images/noimg.jpg<?}?>" class="noimg" width="150" height="120"></a></div></td>
				<td class="td3">
					<div class="cate"><?
						$ary_data = getArrayString($Data[$i]["field"]);
						foreach($ary_data['data'] as $k => $v) echo '['.$List["categoryarr"][$v-1].']';
					?></div>
					<div class="sj"><?=$Data[$i]["viewlink"].$Data[$i]["subject"].$Data[$i]["newimg"].$Data[$i]["fileIcon"]?></a></div>
					<div class="content"><?=$Data[$i]["comment"]?></div>
				</td>
				<td class="view"><div class="icon"><img src="/board/skin/<?=$boardSet["skin"]?>/images/<?=($Data[$i]["show"]=='N')?'icon_view_no.gif':'icon_view.gif'?>"></div></td>
				<td class="date"><?=str_replace("-",".",$Data[$i]["regdate"])?></td>
			</tr>


		<?		}
			}
			if( $lTmp == 0 ){	?>
			<!--글이 없을 때-->
			<tr>
				<td colspan="6" align="center" height="100">등록된 게시글이 없습니다.</td>
			</tr>
		<?	}	?>
		</tbody>
	</table>

	<div class="pageArea">
		<ul class="pagingList">
			<?	$get_val = "tb=".$tb."&act=".$act."&sSearch=".$sSearch."&sField=".$sField."&sField2=".$sField2."&sKeyword=".$sKeyword."&sGP=".$sGP."&sSecret=".$sSecret;
			include $_SERVER['DOCUMENT_ROOT']."/include/page_board.php"; ?>
		</ul><div class="clr"></div>
	</div>

	<div class="btnArea_list">
		<?if($_SESS["ss_level"] <= $boardSet["writelevel"]){?><?=$List["writelink"]?><img src="/board/skin/<?=$boardSet["skin"];?>/images/btn_write.gif" class="img" border="0"></a><?}?>
	</div>
</div>