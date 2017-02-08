<link href="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/css/board.css" rel="stylesheet" type="text/css">
<? if($tNum!='' && $act=='view'){	//view 페이지	?>
<div id="boardSkin">
	<div class="subjectBox"><?=$Data["subject"]?></div>
	<div class="infor">
		<ul>
			<li>작성자 : <?=$Data["name"]?></li>
			<li>작성일 : <?=str_replace("-",".",$Data["regdate"])?></li>
			<li<?if($tb=='banner' || $tb=='banner2') echo " class='bg'";?>>조회수 : <?=$Data["ref"]?></li>
		  <?if($tb=='banner' || $tb=='banner2'){?>
			<li>링크 : <?=$Data["email"]?></li>
		  <?}?>
		</ul><div class="clr"></div>
	</div>
	<? if( count( $Data["savefile"] ) > 0 && $boardSet["viewimage"] == 'N' ){ ?>
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
	<? } ?>

	<div class="contents">
			<?	if( count( $Data["savefile"] ) > 0 && $boardSet["viewimage"] == 'Y' ){
					for( $i = 0; $i < count( $Data["savefile"] ); $i++ ){
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
			<?=$view["modifylink"]?><img src="<?=$bagData["mdir"];?>/board/skin/counsel_ruby/images/btn_modify.gif"></a></span>&nbsp;
			<?=$view["deletelink"]?><img src="<?=$bagData["mdir"];?>/board/skin/counsel_ruby/images/btn_del.gif"></a></span>&nbsp;
		<? } ?>
		<a href="<?="$PHP_SELF?tb=$tb&act=list&Name=$tblStrName&Pass=$tblStrPass"?>"><img src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/btn_list.gif"></a>
	</div>
</div>
<? } //view 페이지	?>

<? //여기서부터 리스트 ?>

<? if($act=='view'){
		include $_SERVER['DOCUMENT_ROOT'].$bagData["mdir"]."/board/list_core.php";
		echo "<br><br><br>";
} ?>
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
			<col width="100" />
			<col width="*" />
		</colgroup>
		<thead>
			<tr>
				<th>번호</th>
				<th>내용</th>
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
					<div class="t_info">hit : <?=$Data[$i]["ref"]?> / <?=$Data[$i]["name"]?> / <?=str_replace("-",".",$Data[$i]["regdate"])?></div>
				</td>
			</tr>
		<?		}
				## 공지일경우 ##
				else{	?>
			<tr>
				<td class="td1"><?=$Data[$i]["noticeImg"]?></td>
				<td class="td2">
					<? if(count($List["categoryarr"]) > 0){?><div class="t_category">[<?=$List["categoryarr"][$Data[$i]["field"]]?>]</div><? }?>
					<div class="t_subject"><?=$Data[$i]["keyimg"].$Data[$i]["viewlink"].$Data[$i]["subject"].$Data[$i]["newimg"].$Data[$i]["fileIcon"]?></a></div>
					<div class="t_info">hit : <?=$Data[$i]["ref"]?> / <?=$Data[$i]["name"]?> / <?=str_replace("-",".",$Data[$i]["regdate"])?></div>
				</td>
			</tr>
		<?		}
			}
			if( $lTmp == 0 ){	?>
			<!--글이 없을 때-->
			<tr>
				<td colspan="2" align="center" height="300">등록된 게시글이 없습니다.</td>
			</tr>
		<?	}	?>
		</tbody>
	</table>
	<div class="pageArea">
		<ul class="pagingList">
		<?
			$get_val = "tb=".$tb."&sSearch=".$sSearch."&sKeyword=".urlencode($sKeyword)."&sGP=".$sGP."&sSecret=".$sSecret;
			include $_SERVER['DOCUMENT_ROOT'].$bagData["mdir"]."/include/page_board.php";
		?>
		</ul><div class="clr"></div>
	</div>
	<div class="btnArea">
		<?if($_SESS["ss_level"] <= $boardSet["writelevel"]){?><?=$List["writelink"]?><img src="<?=$bagData["mdir"];?>/board/skin/<?=$boardSet["skin"];?>/images/btn_write.gif" class="img" border="0"></a><?}?>
	</div>
</div>