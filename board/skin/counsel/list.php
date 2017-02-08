<link href="/board/skin/<?=$boardSet["skin"];?>/css/board.css" rel="stylesheet" type="text/css">
<?if($tNum!='' && $act=='view'){	//view 페이지	?>
<div id="boardSkin">
	<div class="subjectBox"><?=$Data["subject"]?></div>
	<div class="infor">
		<ul>
			<?	if( count( $List["categoryarr"] ) > 0 ){	?>
			<li class="bg">분류 : <?=$List["categoryarr"][$Data["field"]-1]?></li>
			<? } ?>
			<? if ($_SESSION['ss_id'] == $Data["id"] || $_SESSION['ss_level'] <= 3) { ?>
			<li class="bg">실명 : <?=$Data["name"]?></li>
			<? } ?>
			<? if ($_SESSION['ss_level'] == 1) { ?>
			<li class="bg">연락처 : <?=$Data["mobile"]?></li>
			<? } ?>
			<li class="bg">작성일 : <?=str_replace("-",".",$Data["regdate"])?></li>
			<li<?if($tb=='banner' || $tb=='banner2') echo " class='bg'";?>>조회수 : <?=$Data["ref"]?></li>
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
	<div class="contents">
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
		<? if ($pre_row['tblNumber']) { ?><a href="<?=$_SERVER['PHP_SELF'];?>?tb=<?=$_GET['tb'];?>&act=view&tNum=<?=$pre_row['tblNumber'];?>&sField="><img src="/board/skin/<?=$boardSet["skin"];?>/images/btn_view_prev.gif"></a>&nbsp;<? } ?>
		<? if ($next_row['tblNumber']) { ?><a href="<?=$_SERVER['PHP_SELF'];?>?tb=<?=$_GET['tb'];?>&act=view&tNum=<?=$next_row['tblNumber'];?>&sField="><img src="/board/skin/<?=$boardSet["skin"];?>/images/btn_view_next.gif"></a>&nbsp;<? } ?>
		<? if ($view["replylink"]) { ?><?=$view["replylink"];?><img src="/board/skin/<?=$boardSet["skin"];?>/images/btn_reply.gif"></a>&nbsp;<? } ?>
		<?=$view["modifylink"]?><img src="/board/skin/<?=$boardSet["skin"];?>/images/btn_modify.gif"></a>&nbsp;
		<?=$view["deletelink"]?><img src="/board/skin/<?=$boardSet["skin"];?>/images/btn_del.gif"></a>&nbsp;
		<a href="<?="$PHP_SELF?tb=$tb&act=list&Name=$tblStrName&Pass=$tblStrPass"?>"><img src="/board/skin/<?=$boardSet["skin"];?>/images/btn_list.gif"></a>
	</div>
</div>
<?} //view 페이지	?>

<?//여기서부터 리스트?>

<?if($act=='view'){
		include $_SERVER['DOCUMENT_ROOT']."/board/list_core.php";
		echo "<br><br><br><br><br><br><br><br><br><br>";
}?>
<div id="boardSkin">

	<div id="searchBox">
		<div class="write_btn"><?if($_SESS["ss_level"] <= $boardSet["writelevel"]){?><?=$List["writelink"]?><img src="/board/skin/<?=$boardSet["skin"];?>/images/btn_write2.gif" class="img" border="0"></a><?}?></div>
		<form name="inputFrm" method="get" action="<?=$PHP_SELF?>">
			<input type="hidden" name="tb" value="<?=$tb?>">
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
	<div id="categoryBox">
		<?=getCategoryList($List["categoryarr"]);?>
		<?
			$cate_display = false;
		?>
	</div>
	
	<table summary="" id="boardList">
		<colgroup>
			<col width="100" />
			<? if ($cate_display) { ?><col width="100" /><? } ?>
			<col width="*" />
			<col width="100" />
			<col width="100" />
			<col width="100" />
		</colgroup>
		<thead>
			<tr>
				<th>번호</th>
				<? if ($cate_display) { ?><th>분류</th><? } ?>
				<th>글제목</th>
				<th>처리현황</th>
				<th>글쓴이</th>
				<th>작성일</th>
			</tr>
		</thead>
		<tbody>		
		<?		for( $i = 0; $i < $lTmp; $i++ ){
				## 공지일경우 ##
				if( $Data[$i]["notice"] == '1' ){	?>
			<tr class="notice">
				<td class="td1">공지</td>
				<? if ($cate_display) { ?><td class="td2">&nbsp;</td><? } ?>
				<td class="td3"><?=$Data[$i]["viewlink"].$Data[$i]["subject"]."</a>".$Data[$i]["newimg"].$Data[$i]["fileIcon"]?></td>
				<td class="counsel">&nbsp;</td>
				<td class="td4"><?=$Data[$i]["name"]?></td>
				<td class="td5"><?=str_replace("-",".",$Data[$i]["regdate"])?></td>
			</tr>
		<?		}
				## 공지일경우 ##
				else{	?>
			<tr>
				<td class="td1"><?=$Data[$i]["noticeImg"]?></td>
				<? if ($cate_display) { ?><td class="td2"><?=$List["categoryarr"][$Data[$i]["field"]-1]?></td><? } ?>
				<td class="td3"><?=$Data[$i]["keyimg"].$Data[$i]["viewlink"].$Data[$i]["subject"].$Data[$i]["newimg"].$Data[$i]["fileIcon"]?></td>
				<td class="counsel"><?=$Data[$i]["answerimg"]?></td>
				<td class="td4"><?=$Data[$i]["name"]?>	</td>
				<td class="td5"><?=str_replace("-",".",$Data[$i]["regdate"])?></td>
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
	<?	$get_val = "tb=".$tb."&sSearch=".$sSearch."&sKeyword=".urlencode($sKeyword)."&sGP=".$sGP."&sSecret=".$sSecret;
	include $_SERVER['DOCUMENT_ROOT']."/include/page_board.php"; ?>
		</ul><div class="clr"></div>
	</div>

	<div class="btnArea_list">
		<?if($_SESS["ss_level"] <= $boardSet["writelevel"]){?><?=$List["writelink"]?><img src="/board/skin/<?=$boardSet["skin"];?>/images/btn_write.gif" class="img" border="0"></a><?}?>
	</div>

</div>