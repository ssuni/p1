<link href="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/css/board.css" rel="stylesheet" type="text/css">
<?if($tNum!='' && $act=='view'){	//view 페이지	?>
<div id="boardSkin">
	<div class="subjectBox"><?=$Data["subject"]?> &nbsp;&nbsp; 
		<? if (strtotime($Data["entStart"]." 00:00:00") <= time() && time() <= strtotime($Data["entEnd"]." 23:59:59")) { ?>
			<img src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/btn_ing.gif" alt="이벤트 진행중" class="middle" />
		<? } else if (date("Y-m-d") > $Data["entStart"]) { ?>
			<img src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/btn_end.gif" alt="이벤트 종료" class="middle" />
		<? } ?>
	</div>
	<? if ($Data["entSubject"]) { ?><div class="infor"><ul><li><strong>이벤트 설명</strong> : <?=$Data["entSubject"];?></li></ul></div><? } ?>
	<? if ($Data["entStart"] || $Data["entEnd"]) { ?><div class="infor"><ul><li><strong>이벤트 기간</strong> : <?=$Data["entStart"];?> ~ <?=$Data["entEnd"];?> </li></ul></div><? } ?>
	<!--<div class="infor">
		<ul>
			<li class="bg">작성자 : <?=$Data["name"]?></li>
			<li class="bg">작성일 : <?=str_replace("-",".",$Data["regdate"])?></li>
			<li<?if($tb=='banner' || $tb=='banner2') echo " class='bg'";?>>조회수 : <?=$Data["ref"]?></li>
		  <?if($tb=='banner' || $tb=='banner2'){?>
			<li>링크 : <?=$Data["email"]?></li>
		  <?}?>

		</ul><div class="clr"></div>
	</div>-->
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
					for( $i = 1; $i < count( $Data["savefile"] ); $i++ ){
						if( $Data["openimg"][$i] ){		?>
						<div class="imgWrap"><?=$Data["openimg"][$i]?></div>
			<?			}
					}
				}
				echo "<br>".$Data["comment"];?>
	</div>
	<div class="btnArea2">
		<? /* 본인과 관리자만 출력 */ ?>
		<? if ($_SESSION['ss_level'] == 1 || $_SESSION['ss_id'] == $Data['id']) { ?>
			<?=$view["modifylink"]?><img src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/btn_modify.gif"></a></span>&nbsp;
			<?=$view["deletelink"]?><img src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/btn_del.gif"></a></span>&nbsp;
		<? } ?>
		<a href="<?="$PHP_SELF?tb=$tb&act=list&Name=$tblStrName&Pass=$tblStrPass"?>"><img src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/btn_list.gif"></a>
	</div>
</div>
<script>
	function img_resize(){
		maxsize = 590;
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
		<!-------- start : 카테고리 -------->
		<ul class="category">
		<?if($List["category"]){
			for($i=0;$i<count($List["categoryarr"]);$i++){?>
				<li<?if($i!=(count($List["categoryarr"])-1)){?> class="<?if($sField==$i || ($sField=='' && $i==0)) echo "select ";?>bg"<?}?>><a href="<?=$PHP_SELF?>?tb=<?=$tb?>&sField=<?if($i!=0) echo $i;?>"><?if($i==0) echo "전체보기"; else echo $List["categoryarr"][$i];?></a></li>
		<?	}
		  }?>
		</ul>
		<!-------- end : 카테고리 -------->
		<form name="inputFrm" method="post" action="<?=$PHP_SELF?>" autocomplete="off">
			<input type="hidden" name="tb" value="<?=$tb?>">
			<input type="hidden" name="act" value="<?=$act?>">
			<input type="hidden" name="sField" value="<?=$sField?>">
			<input type="hidden" name="sField2" value="<?=$sField2?>">
			<select name="sSearch" id="sSearch">
				<option value="tblStrSubject" <?=($sSearch == 'tblStrSubject')?"selected":""?>>글제목</option>
				<option value="tblStrComment" <?=($sSearch == 'tblStrComment')?"selected":""?>>글내용</option>
				<option value="tblStrName" <?=($sSearch=='tblStrName')?"selected":""?>>글쓴이</option>
			</select>
			<input name="sKeyword" id="sKeyword" value="<?=$sKeyword?>" type="text" class="textForm" style="width:200px;">
			<input type="image" src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/btn_search_list.gif" class="middleCon">
		</form>
	</div>
	
	<table summary="" id="boardList">
		<colgroup>
			<col width="55" />
			<col width="250" />
			<col width="*" />
		</colgroup>
		<thead>
			<tr>
				<th>번호</th>
				<th>글정보</th>
				<th>바로가기</th>
			</tr>
		</thead>
		<tbody>
		<?		for( $i = 0; $i < $lTmp; $i++ ){
				## 공지일경우 ##
				if( $Data[$i]["notice"] == '1' ){	?>
			<tr class="notice">
				<td class="td1">공지</td>
				<td class="td3">
					<div class="timg"><img src="<?=($Data[$i]["savefile"][0])?$bagData["host"].$Data[$i]["savefile"][0]:'/board/skin/'.$boardSet["skin"].'/images/noimg.gif';?>" width="218" height="110" /></div>
				</td>
				<td class="td5">
					<div class="ebtn">
					<? if (strtotime($Data[$i]["entStart"]." 00:00:00") <= time() && time() <= strtotime($Data[$i]["entEnd"]." 23:59:59")) { ?>
					<img src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/btn_ing.gif" alt="이벤트 진행중" class="middle" />
					<? } else if (date("Y-m-d") > $Data[$i]["entStart"]) { ?>
					<img src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/btn_end.gif" alt="이벤트 종료" class="middle" />
					<? } ?>
					</div>
					<!--<div class="subject"><?=$Data[$i]["viewlink"].$Data[$i]["subject"]."</a>".$Data[$i]["newimg"].$Data[$i]["fileIcon"]?></div>-->
					<div class="subject"><?=$Data[$i]["viewlink"].$Data[$i]["subject"]."</a>".$Data[$i]["newimg"]?></div>
					<div class="etext"><?=$Data[$i]["entSubject"];?></div>
					<? if ($Data[$i]["entStart"] && $Data[$i]["entStart"]) { ?>
					<div class="edate">기간 : <?=$Data[$i]["entStart"];?> ~ <?=$Data[$i]["entEnd"];?></div>
					<? } ?>
					<div class="go_btn"><?=$Data[$i]["viewlink"]?><img src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/btn_view.gif"/></a></div>
				</td>
			</tr>
		<?		}
				## 공지일경우 ##
				else{	?>
			<tr>
				<td class="td1"><?=$Data[$i]["noticeImg"]?></td>
				<td class="td3">
					<div class="timg"><img src="<?=($Data[$i]["savefile"][0])?'http://'.$bagData["host"].$Data[$i]["savefile"][0]:'/board/skin/'.$boardSet["skin"].'/images/noimg.gif';?>" width="218" height="110" /></div>
				</td>
				<td class="td5">
					<div class="ebtn">
					<? if (strtotime($Data[$i]["entStart"]." 00:00:00") <= time() && time() <= strtotime($Data[$i]["entEnd"]." 23:59:59")) { ?>
					<img src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/btn_ing.gif" alt="이벤트 진행중" class="middle" />
					<? } else if (date("Y-m-d") > $Data[$i]["entStart"]) { ?>
					<img src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/btn_end.gif" alt="이벤트 종료" class="middle" />
					<? } ?>
					</div>
					<!--<div class="subject"><?=$Data[$i]["viewlink"].$Data[$i]["subject"]."</a>".$Data[$i]["newimg"].$Data[$i]["fileIcon"]?></div>-->
					<div class="subject"><?=$Data[$i]["viewlink"].$Data[$i]["subject"]."</a>".$Data[$i]["newimg"]?></div>
					<div class="etext"><?=$Data[$i]["entSubject"];?></div>
					<? if ($Data[$i]["entStart"] && $Data[$i]["entStart"]) { ?>
					<div class="edate">기간 : <?=$Data[$i]["entStart"];?> ~ <?=$Data[$i]["entEnd"];?></div>
					<? } ?>
					<div class="go_btn"><?=$Data[$i]["viewlink"]?><img src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/btn_view.gif"/></a></div>
				</td>
			</tr>
		<?		}
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