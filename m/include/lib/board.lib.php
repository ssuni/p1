<?
// 베스트 글
function getBestList($tb) {

	$Query = "SELECT * FROM tbl_".$tb." where tblIntNotice=1 order by tblDtmRegDate desc limit 4";
	$Sql = mysql_query( $Query );			
	$lTmp = 0;
	while( $Array = mysql_fetch_array( $Sql ) ) {

		$Best[$lTmp]["link"]				= "<a href='".$_SERVER['PHP_SELF']."?tb=".$tb."&act=view&tNum=".$Array["tblNumber"]."&sField=".$_GET['sField']."'>";
		$Best[$lTmp]["number"]		= $Array["tblNumber"];
		$Best[$lTmp]["subject"]		= stripslashes( $Array["tblStrSubject"] );
		$Best[$lTmp]["comment"]		= mb_strimwidth( eregi_replace("<[^>]*>", "", stripslashes( $Array["tblStrComment"] ) ), 0, 60, "...", "utf-8" );
		$Best[$lTmp]["savefile"]	= explode( '|', $Array["tblStrSaveFile"] );
		$lTmp++;

	}

	return $Best;
}


// 게시물 상세보기
function getBoard_info($ary) {
	$Query = "SELECT * FROM tbl_".$ary['tb']." where tblNumber=".$ary['tNum'];
	$Sql = mysql_query( $Query );			
	return mysql_fetch_array( $Sql );
}


// 리스트 > 카테고리 출력
function getCategoryList($category) {
	global $tb;
    ob_start();
		echo '<ul class="category">';
			if ($category) {
				$select_all = ($_GET['sField']=='')?'select ':'';
				echo '<li class="'.$select_all.'bg"><a href="'.$_SERVER['PHP_SELF'].'?tb='.$tb.'&sField=">전체보기</a></li>';
				for($i=0; $i<count($category); $i++) {
					if (trim($category[$i])) {
						$select = ($_GET['sField']==($i+1))?'select ':'';
						echo '<li class="'.$select.'bg"><a href="'.$_SERVER['PHP_SELF'].'?tb='.$tb.'&sField='.($i+1).'">'.$category[$i].'</a></li>';
					}
				}
			}
		echo '</ul><div class="clr"></div>';
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}

// 글쓰기 > 카테고리 셀렉트 박스 출력
function getSelectCategory($ary) {
    ob_start();
		echo '<select name="'.$ary['name'].'" id="'.$ary['name'].'" itemname="'.$ary['itemname'].'">';
		echo '<option value="">'.$ary['itemname'].'를 선택해 주세요</option>';
		for($i=0; $i<count($ary['list']); $i++) {
			if (trim($ary['list'][$i])) {
				$select = ($ary['value']==($i+1))?'selected':'';
				echo '<option '.$select.' value="'.($i+1).'">'.$ary['list'][$i].'</option>';
			}
		}
		echo '</select>';
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}

// 글쓰기 > 카테고리 체크 박스 출력(다중선택)
function getChkCategory($ary) {
    ob_start();
		for($i = 0; $i < count( $ary['list'] ); $i++ ) {
			$chked=(strpos($ary["value"], '['.(int)($i+1).']')!==false)?'checked':'';
			echo '<input type="checkbox" name="'.$ary['name'].'" value="'.($i+1).'" id="chk_'.($i+1).'" '.$chked.'/> <label for="chk_'.($i+1).'">'.$ary['list'][$i].'</label><span style="padding-left:20px"></span>';
		}
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}

// 관리자 스킨 리스트 화일
function getListSkinFile($skin) {
	global $_SESSION, $bagData;

	if ($_SESSION["ss_level"] == 1) {
		if(file_exists($_SERVER['DOCUMENT_ROOT'].$bagData["mdir"]."/board/skin/".$skin."/list_admin.php"))
		{
			$list_file = $_SERVER['DOCUMENT_ROOT'].$bagData["mdir"]."/board/skin/".$skin."/list_admin.php";
		}
		else
		{
			$list_file = $_SERVER['DOCUMENT_ROOT'].$bagData["mdir"]."/board/skin/".$skin."/list.php";
		}
	} else {
		$list_file = $_SERVER['DOCUMENT_ROOT'].$bagData["mdir"]."/board/skin/".$skin."/list.php";
	}
	return $list_file;
}

// 비밀번호를 이용한 링크
function pwd_link($ary) {
	global $_SERVER;
	return "<a href='".$_SERVER['PHP_SELF']."?tb=".$ary['tb']."&act=passwd&act_after=".$ary['act']."&tNum=".$ary['tNum']."'>";
}
?>