<link href="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/css/board.css" rel="stylesheet" type="text/css">
<?if($tNum!='' && $act=='view'){	//view 페이지	?>
<div id="boardSkin">
	<div class="subjectBox"><?=$Data["subject"]?></div>
	<div class="infor">
		<ul>
			<li class="bg">작성자 : <?=$Data["name"]?></li>
			<!--li class="bg">작성일 : <?=str_replace("-",".",$Data["regdate"])?></li-->
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


	<div class="contents" id="contents">
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
	<div class="btnArea2">
		<? if ($pre_row['tblNumber']) { ?><a href="<?=$_SERVER['PHP_SELF'];?>?tb=<?=$_GET['tb'];?>&act=view&tNum=<?=$pre_row['tblNumber'];?>&sField="><img src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/btn_view_prev.gif"></a>&nbsp;<? } ?>
		<? if ($next_row['tblNumber']) { ?><a href="<?=$_SERVER['PHP_SELF'];?>?tb=<?=$_GET['tb'];?>&act=view&tNum=<?=$next_row['tblNumber'];?>&sField="><img src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/btn_view_next.gif"></a>&nbsp;<? } ?>

		<? 
			// 본인 또는 admins 아이디만 수정 권한
			if ($Data["id"] == $_SESS["ss_id"] || $_SESS["ss_id"] == 'admins') {
		?>
		<?=$view["modifylink"]?><img src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/btn_modify.gif"></a></span>&nbsp;
		<? } ?>
		<? if ($view["deletelink"]) { ?><?=$view["deletelink"]?><img src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/btn_del.gif"></a></span>&nbsp;<? } ?>
		<a href="<?="$PHP_SELF?tb=$tb&act=list&Name=$tblStrName&Pass=$tblStrPass"?>"><img src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/btn_list.gif"></a>
	</div>
</div>
<script>
	function img_resize(){
		maxsize = 600;
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

	<table summary="" id="boardList">
		<colgroup>
			<col width="60" />
			<col width="120" />
			<col width="*" />
		</colgroup>
		<thead>
			<tr>
				<th>번호</th>
				<th>파일</th>
				<th>글제목</th>
			</tr>
		</thead>
		<tbody>
		<?		for( $i = 0; $i < $lTmp; $i++ ){
				## 베스트일경우 ##
				if( $Data[$i]["notice"] == '1' ){	?>
			<tr>
				<td class="td1" <?=($Data[$i]['number']==$_GET['tNum'])?'style="background-color:#f5f5f5"':'';?>><?=$Data[$i]["noticeImg"]?></td>
				<td class="td2" <?=($Data[$i]['number']==$_GET['tNum'])?'style="background-color:#f5f5f5"':'';?>><img src="<?if($Data[$i]["savefile"][0]!=''){?><?=$Data[$i]["savefile"][0]?><?}else{?>/board/skin/<?=$boardSet["skin"];?>/images/noimg.jpg<?}?>" class="noimg" width="80" ></a></td>
				<td class="td3" <?=($Data[$i]['number']==$_GET['tNum'])?'style="background-color:#f5f5f5"':'';?>><?=$Data[$i]["keyimg"].$Data[$i]["viewlink"].$Data[$i]["subject"].$Data[$i]["newimg"].$Data[$i]["fileIcon"]?></a><div class="info"><?=$Data[$i]["name"]?> / <?=$Data[$i]["viewlink"]?><?=str_replace("-",".",$Data[$i]["regdate"])?></a> / <?=$Data[$i]["ref"]?></div></td>
			</tr>
		<?		}
				else{	?>
			<tr>
				<td class="td1" <?=($Data[$i]['number']==$_GET['tNum'])?'style="background-color:#f5f5f5"':'';?>><?=$Data[$i]["noticeImg"]?></td>
				<td class="td2" <?=($Data[$i]['number']==$_GET['tNum'])?'style="background-color:#f5f5f5"':'';?>><img src="<?if($Data[$i]["savefile"][0]!=''){?><?=$Data[$i]["savefile"][0]?><?}else{?>/board/skin/<?=$boardSet["skin"];?>/images/noimg.jpg<?}?>" class="noimg" width="80" ></a></td>
				<td class="td3" <?=($Data[$i]['number']==$_GET['tNum'])?'style="background-color:#f5f5f5"':'';?>><?=$Data[$i]["keyimg"].$Data[$i]["viewlink"].$Data[$i]["subject"].$Data[$i]["newimg"].$Data[$i]["fileIcon"]?></a><div class="info"><?=$Data[$i]["name"]?> / <?=$Data[$i]["viewlink"]?><?=str_replace("-",".",$Data[$i]["regdate"])?></a> / <?=$Data[$i]["ref"]?></div></td>
			</tr>
		<?		}
			}
			if( $lTmp == 0 ){	?>
			<!--글이 없을 때-->
			<tr>
				<td colspan="3" align="center" height="100">没有登记的留言<!--등록된 게시글이 없습니다.--></td>
			</tr>
		<?	}	?>
		</tbody>
	</table>

	<div class="pageArea">
		<ul class="pagingList">
	<?	$get_val = "tb=".$tb."&sSearch=".$sSearch."&sKeyword=".urlencode($sKeyword)."&sGP=".$sGP."&sSecret=".$sSecret;
	include $_SERVER['DOCUMENT_ROOT'].$bagData["mdir"]."/include/page_board.php"; ?>
		</ul><div class="clr"></div>
	</div>
	<div class="btnArea">
		<?if($_SESS["ss_level"] <= $boardSet["writelevel"]){?><?=$List["writelink"]?><img src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/btn_write.gif" class="img" border="0"></a><?}?>
	</div>
</div>