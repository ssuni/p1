<link href="/board/skin/<?=$boardSet["skin"];?>/css/board.css" rel="stylesheet" type="text/css">
<?if($tNum!='' && $act=='view'){	//view 페이지	?>
<div id="boardSkin">
	<div class="subjectBox"><?=$Data["subject"]?></div>
	<div class="infor">
		<ul>
			<li class="bg">작성자 : <?=$Data["name"]?></li>
			<li class="bg">작성일 : <?=str_replace("-",".",$Data["regdate"])?></li>
			<li<?if($tb=='banner' || $tb=='banner2') echo " class='bg'";?>>조회수 : <?=$Data["ref"]?></li>
		  <?if($tb=='banner' || $tb=='banner2'){?>
			<li>링크 : <?=$Data["email"]?></li>
		  <?}?>

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
				echo "<br>".$Data["comment"];?>
			<? if ($Data["homepage"]) { ?><p>관련주소 : <a href="http://<?=$Data["homepage"];?>" target="_blank"><?=$Data["homepage"];?></a></p><? } ?>
	</div>
	<!--div class="goList">
		<ul>
<?	$perArray = mysql_fetch_array( $perSql ); 
	$perData["number"]	= $perArray["tblNumber"];
	$perData["subject"]	= mb_strimwidth( stripslashes( $perArray["tblStrSubject"] ), 0, 50, "...", "utf-8");
	$perData["id"]			= $perArray["tblStrID"];
	$perData["secret"]	= $perArray["tblStrSecret"];
	/* 링크설정 시작 */
	$perData["viewlink"] = ( $_SESS["ss_level"] < 2 || ( $perData["secret"] == 'N' && $_SESS["ss_level"] <= $boardSet["viewlevel"] ) || ( $_SESS["ss_name"] && $_SESS["ss_id"] == $perData["id"] ) ) ? "<a href='".$PHP_SELF."?tb=".$tb."&act=view&tNum=".$perData["number"]."'>" : "<a href=\"javascript: passwdChk('".$tb."','".$perData["number"]."','view');\">";
	/* 링크설정 끝   */
	$perList["str"] = ( trim( $perArray["tblStrSubject"] ) ) ? $perData["viewlink"].$perData["subject"]."</a>" : "이전글이 없습니다.";
	
	//$nextList["str"] = "";
	$nextArray = mysql_fetch_array( $nextSql ); 
	$nextData["number"]	= $nextArray["tblNumber"];
	$nextData["subject"]	= mb_strimwidth( stripslashes( $nextArray["tblStrSubject"] ), 0, 50, "...", "utf-8");
	$nextData["id"]			= $nextArray["tblStrID"];
	$nextData["secret"]	= $nextArray["tblStrSecret"];
	/* 링크설정 시작 */
	$nextData["viewlink"] = ( $_SESS["ss_level"] < 2 || ( $nextData["secret"] == 'N' && $_SESS["ss_level"] <= $boardSet["viewlevel"] ) || ( $_SESS["ss_name"] && $_SESS["ss_id"] == $nextData["id"] ) ) ? "<a href='".$PHP_SELF."?tb=".$tb."&act=view&tNum=".$nextData["number"]."'>" : "<a href=\"javascript: passwdChk('".$tb."','".$nextData["number"]."','view');\">";
	/* 링크설정 끝   */
	$nextList["str"] = ( trim( $nextArray["tblStrSubject"] ) ) ? $nextData["viewlink"].$nextData["subject"]."</a>" : "다음글이 없습니다.";	?>
			<li class="prev"><?=$perList["str"]?></li>
			<li class="next"><?=$nextList["str"]?></li>
		</ul>
	</div-->
	<div class="btnArea2">
		<? if ($pre_row['tblNumber']) { ?><a href="<?=$_SERVER['PHP_SELF'];?>?tb=<?=$_GET['tb'];?>&act=view&tNum=<?=$pre_row['tblNumber'];?>&sField="><img src="/board/skin/<?=$boardSet["skin"];?>/images/btn_view_prev.gif"></a>&nbsp;<? } ?>
		<? if ($next_row['tblNumber']) { ?><a href="<?=$_SERVER['PHP_SELF'];?>?tb=<?=$_GET['tb'];?>&act=view&tNum=<?=$next_row['tblNumber'];?>&sField="><img src="/board/skin/<?=$boardSet["skin"];?>/images/btn_view_next.gif"></a>&nbsp;<? } ?>
		<? if ($_SESSION['ss_level'] == 1 || $_SESSION['ss_id'] == $Data['id']) { ?>
			<?=$view["modifylink"]?><img src="/board/skin/<?=$boardSet["skin"];?>/images/btn_modify.gif"></a></span>&nbsp;
			<?=$view["deletelink"]?><img src="/board/skin/<?=$boardSet["skin"];?>/images/btn_del.gif"></a></span>&nbsp;
		<? } ?>
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
	</div>

	<table summary="" id="boardList">
		<colgroup>
			<col width="80" />
			<?if(count($List["categoryarr"]) > 0){?>
			<col width="120" />
			<?}?>
			<col width="*" />
			<col width="120" />
			<col width="120" />
			<col width="80" />
		</colgroup>
		<thead>
			<tr>
				<th>번호</th>
			<?if(count($List["categoryarr"]) > 0){?>
				<th>분류</th>
			<?}?>
				<th>글제목</th>
				<th>글쓴이</th>
				<th>작성일</th>
				<th>조회수</th>
			</tr>
		</thead>
		<tbody>
		<?		for( $i = 0; $i < $lTmp; $i++ ){
				## 공지일경우 ##
				if( $Data[$i]["notice"] == '1' ){	?>
			<tr class="notice">
				<td class="td1">공지</td>
			<?if(count($List["categoryarr"]) > 0){?>
				<td class="td2">&nbsp;</td>
			<?}?>
				<td class="td3"><?=$Data[$i]["viewlink"].$Data[$i]["subject"]."</a>".$Data[$i]["newimg"].$Data[$i]["fileIcon"]?></td>
				<td class="td4"><?=$Data[$i]["name"]?></td>
				<td class="td5"><?=str_replace("-",".",$Data[$i]["regdate"])?></td>
				<td class="td6"><?=$Data[$i]["ref"]?></td>
			</tr>
		<?		}
				## 공지일경우 ##
				else{	?>
			<tr>
				<td class="td1"><?=$Data[$i]["noticeImg"]?></td>
			<?if(count($List["categoryarr"]) > 0){?>
				<td class="td2"><?=$List["categoryarr"][$Data[$i]["field"]]?></td>
			<?}?>
				<td class="td3"><?=$Data[$i]["keyimg"].$Data[$i]["viewlink"].$Data[$i]["subject"].$Data[$i]["newimg"].$Data[$i]["fileIcon"]?></td>
				<td class="td4"><?=$Data[$i]["name"]?></td>
				<td class="td5"><?=str_replace("-",".",$Data[$i]["regdate"])?></td>
				<td class="td6"><?=$Data[$i]["ref"]?></td>
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