<?	include $_SERVER['DOCUMENT_ROOT'].$bagData["mdir"]."/board/inc/board_setting.php";
	include $_SERVER['DOCUMENT_ROOT']."/board/inc/".$boardSet["head"];
	include $_SERVER['DOCUMENT_ROOT'].$bagData["mdir"]."/include/lib/board.lib.php";

	$_SESS["ss_id"] = ( $_SESSION["ss_id"] ) ? $_SESSION["ss_id"] : "";
	$_SESS["ss_name"] = ( $_SESSION["ss_name"] ) ? $_SESSION["ss_name"] : "";
	$_SESS["ss_level"] = ( $_SESSION["ss_level"] ) ? $_SESSION["ss_level"] : "10" ;
	$_SESS["ss_email"] = ( $_SESSION["ss_email"] ) ? $_SESSION["ss_email"] : "" ;
	$_SESS["ss_phone"] = ( $_SESSION["ss_phone"] ) ? $_SESSION["ss_phone"] : "" ;
	$_SESS["ss_mobile"] = ( $_SESSION["ss_mobile"] ) ? $_SESSION["ss_mobile"] : "" ;
	$Pass["passwd"] = ( trim( $_SESSION["boardSess"] ) ) ? $_SESSION["boardSess"] : "";


	$act=($_GET['act'])?$_GET['act']:$_POST['act'];
	$tNum=($_GET['tNum'])?$_GET['tNum']:$_POST['tNum'];
	if ($_GET['tb']) $tb = $_GET['tb'];
	if ($_POST['tb']) $tb = $_POST['tb'];
	$step=($_GET['step'])?$_GET['step']:$_POST['step'];

	/***********************************************************************************************/
	/* 게시판 유무 체크                                                                            */
	/***********************************************************************************************/
	if( !$tb ) 
		echo "<script language='javascript'>alert('게시판을 선택해주세요.'); history.go(-1);</script>";

	$List["category"] = str_replace( "\r", '', $boardSet["category"] );
	if( $List["category"] ) {
		$List["categoryarr"] = explode( "\n", $List["category"] );	
	}

	if($boardSet["skin"] == 'call' && $_SESSION["ss_level"] > 2){
		if(!$act || $act=='') $act="write";
	}
	$bibun=$_POST["strPass"];  //비밀번호

	/***********************************************************************************************/
	/* 리스트( 목록 ) 시작                                                                         */
	/***********************************************************************************************/
	if( !$act || $act == "list" ) {

		if ($tb == 'customer' && $_SESS["ss_level"] > 2) {
			echo "<script language='javascript'>location='/community/community02.php?tb=customer&act=write';</script>";
			exit;
		}

		if( $_SESS["ss_level"] > $boardSet["listlevel"] ) 
			echo "<script language='javascript'>alert('".$boardSet["bname"]."의 목록보기 권한이 없습니다.'); history.go(-1);</script>";

		/* 검색 시작 */
		if ($_SESS["ss_level"] == 1) {
			$subQuery = "WHERE (1)";			// 관리자는 모든 게시물 확인
		} else {
			$subQuery = "WHERE tblStrShow='Y'";
		}
		/* 서브게시물 보임/안보임 설정 시작 */
		
		/*tap_key 가 있으면 자기 자신 글만 보이게*/
		if( $tap_key ) {
			$subQuery .= " AND tblStrID='".$_SESS["ss_id"]."'";
		}
		/*tap_key 가 있으면 자기 자신 글만 보이게*/

		if( $boardSet["sub"] == 'N' ) {
			//$subQuery = ( $subQuery ) ? $subQuery." AND tblStrThread='A'" : "WHERE tblStrThread='A'";
			$subQuery .= " AND tblStrThread='A'";
		}

		if( $sField != '' ) {
			$subQuery .= " AND tblIntField like '%[".$_GET['sField']."]%'";
		}

		if( $sGP ) {
			$subQuery .= " AND tblIntGP='".$sGP."'";
		}

		if( $sSecret != '' ) {
			$subQuery .= " AND tblStrSecret='".$sSecret."'";
		}

		/* 서브게시물 보임/안보임 설정 끝   */
		if( trim( $sKeyword ) ) {
			$subQuery .= " AND ".$_GET['sSearch']." LIKE '%".$sKeyword."%'";
		}

		/* 검색 끝   */

		/* 정렬 시작 */
		$OrderBy = "ORDER BY tblIntNotice DESC, tblDtmRegDate desc, tblIntFid DESC, tblStrThread";
		/* 정렬 끝   */

		/* 페이지 설정 시작 */
		$p = ( !$p ) ? "1" : $p;
		$boardSet["mlinenumber"] = ( $boardSet["mlinenumber"] ) ? $boardSet["mlinenumber"] : "10";
		$startnum = ( $p - 1 ) * $boardSet["mlinenumber"];
		$countQuery = mysql_query( "SELECT tblNumber FROM tbl_".$tb." ".$subQuery );
		$count_arr = mysql_num_rows( $countQuery );
		$data_num = $count_arr;
		$viewCount = $data_num - $startnum;
		@$total_page = intval( ( $data_num - 1 ) / $boardSet["mlinenumber"] )+1;
		/* 페이지 설정 끝   */

		$Query = "SELECT * FROM tbl_".$tb." ".$subQuery." ".$OrderBy." limit ".$startnum.", ".$boardSet["mlinenumber"];
		$Sql = mysql_query( $Query );			

		$List["writelink"] = ( $_SESS["ss_level"] <= 2 || $_SESS["ss_level"] <= $boardSet["writelevel"] ) ? "<a href='".$PHP_SELF."?tb=".$tb."&act=write'>" : "<a href=\"javascript: alert('고객님은 현재 [".$memberNameArr[$_SESSION["ss_level"]]."] 입니다.\\n\\n[".$memberNameArr[$boardSet["writelevel"]]."] 이상만 글쓰기가 가능합니다.')\">";	

		$lTmp = 0;
		while( $Array = mysql_fetch_array( $Sql ) ) {
			$Data[$lTmp]["number"]		= $Array["tblNumber"];
			$Data[$lTmp]["fid"]			= $Array["tblIntFid"];
			$Data[$lTmp]["thread"]		= $Array["tblStrThread"];
			$Data[$lTmp]["field"]		= $Array["tblIntField"];
			$Data[$lTmp]["id"]			= $Array["tblStrID"];
			$Data[$lTmp]["passwd"]		= $Array["tblStrPass"];
			$Data[$lTmp]["name"]		= $Array["tblStrName"];
			$Data[$lTmp]["subject"]		= stripslashes( $Array["tblStrSubject"] );
			$Data[$lTmp]["content"]		= stripslashes( $Array["tblStrComment"] );
			$Data[$lTmp]["phone"]		= $Array["tblStrPhone"];
			$Data[$lTmp]["mobile"]		= $Array["tblStrMobile"];
			$Data[$lTmp]["blnsms"]		= $Array["tblBlnSms"];
			$Data[$lTmp]["email"]		= $Array["tblStrEmail"];
			$Data[$lTmp]["blnemail"]	= $Array["tblBlnEmail"];
			$Data[$lTmp]["homepage"]	= $Array["tblStrHomePage"];
			$Data[$lTmp]["notice"]		= $Array["tblIntNotice"];
			$Data[$lTmp]["secret"]		= $Array["tblStrSecret"];
			$Data[$lTmp]["comment"]		= mb_strimwidth( preg_match("/<[^>]*>/", "", stripslashes( $Array["tblStrComment"] ) ), 0, 60, "...", "utf-8" );
		if( $boardSet["skin"] == 'bna'){
			$Data[$lTmp]["comment"]		= mb_strimwidth( preg_match("/<[^>]*>/", "", stripslashes( $Array["tblStrComment"] ) ), 0, 44, "...", "utf-8" );
		}
			if ($Array["tblStrSaveFile"]) {
				$Data[$lTmp]["savefile"]	= explode( '|', $Array["tblStrSaveFile"] );
			} else {
				$src = imgTag($Array["tblStrComment"]);
				$Data[$lTmp]["savefile"][0] = str_replace("http://varabon.co.kr","",str_replace("http://www.varabon.co.kr","",str_replace("\\","",$src[0])));
			}
			$Data[$lTmp]["liefile"]		= explode( '|', $Array["tblStrLieFile"] );
			$Data[$lTmp]["thumfile1"]	= explode( '|', $Array["tblStrThum1"] );
			$Data[$lTmp]["thumfile2"]	= explode( '|', $Array["tblStrThum2"] );
			$Data[$lTmp]["thumfile3"]	= explode( '|', $Array["tblStrThum3"] );
			$Data[$lTmp]["thumfile4"]	= explode( '|', $Array["tblStrThum4"] );
			$Data[$lTmp]["thumfile5"]	= explode( '|', $Array["tblStrThum5"] );
			$Data[$lTmp]["ref"]			= $Array["tblIntRef"];
			$Data[$lTmp]["ip"]			= $Array["tblStrIp"];
			$Data[$lTmp]["show"]		= $Array["tblStrShow"];
			$Data[$lTmp]["reid"]		= $Array["tblStrReID"];
			$Data[$lTmp]["reply"]		= $Array["tblStrReply"];
			$Data[$lTmp]["rename"]		= $Array["tblStrReName"];
			$Data[$lTmp]["regdate"]		= $Array["tblDtmRegDate"];
			$Data[$lTmp]["moddate"]		= $Array["tblDtmModDate"];
			$Data[$lTmp]["redate"]		= $Array["tblDtmReDate"];
			$Data[$lTmp]["gp"]			= $Array["tblIntGP"];

			$Data[$lTmp]["sex"]			= $Array["tblSex"];
			$Data[$lTmp]["age"]			= $Array["tblAge"];
			$Data[$lTmp]["period"]		= $Array["tblPeriod"];
			$Data[$lTmp]["comment2"]	= mb_strimwidth( preg_match("/<[^>]*>/", "", stripslashes( $Array["tblStrComment2"] ) ), 0, 220, "...", "utf-8" ); 
			$Data[$lTmp]["etc"]			= $Array["tblStrEtc"];

			$Data[$lTmp]["entSubject"]			= $Array["entSubject"];
			$Data[$lTmp]["entStart"]	= $Array["entStart"];
			$Data[$lTmp]["entEnd"]	= $Array["entEnd"];

			$Data[$lTmp]["vodSubject"]			= $Array["vodSubject"];
			$Data[$lTmp]["vodCeo"]			= $Array["vodCeo"];
			$Data[$lTmp]["vodDate"]			= $Array["vodDate"];
			$Data[$lTmp]["vodPart"]			= $Array["vodPart"];

			$Data[$lTmp]["icon_logo"]	= ( ( $Data[$lTmp]["thread"] == 'A' && $Data[$lTmp]["id"] == 'admin') || ( $Data[$lTmp]["thread"] != 'A' && $Data[$lTmp]["id"] == 'admin' ) ) ? "<img src='/board/images/name_logo.gif' align='absmiddle'>" : "";

			/* 덧글수 선택 시작 */
			//$tQue = "SELECT tblNumber FROM tblBoardComment WHERE tblStrBtable='$tb' AND tblIntCode='$tblNumber'";
			//$tSql = mysql_query($tQue);
			//$tCount = mysql_num_rows($tSql);
			/* 덧글수 선택 끝   */

			$Data[$lTmp]["fileIcon"] = ( $Data[$lTmp]["savefile"][0] ) ? "&nbsp;<img src='/board/skin/".$boardSet["skin"]."/images/icon_photo.gif' align='absmiddle' alt='첨부파일'>" : "";

			/* 공지사항일때 시작 */
			if( $Data[$lTmp]["notice"] == '1' ) {
				$Data[$lTmp]["noticeImg"] = "<img src='/board/skin/".$boardSet["skin"]."/images/icon_notice.gif' alt='공지' align='absmiddle'>";
			} else {
				$Data[$lTmp]["noticeImg"] = $viewCount;
			}
			/* 공지사항일때 끝   */

			/* 새글일때 NEW 아이콘 표시 시작 */
			$Data[$lTmp]["newdate"] = date( 'Y-m-d 00:00:00', time() - ( 86400*3 ) ); /* 3일간 표시 */
			$Data[$lTmp]["newimg"] = ( $Data[$lTmp]["regdate"] >= $Data[$lTmp]["newdate"] ) ? "&nbsp;<img src='/board/skin/".$boardSet["skin"]."/images/icon_new.gif' align='absmiddle' alt='새글'>" : "";
			/* 새글일때 NEW 아이콘 표시 Rmx  */

			/* 제목길이 조절 시작 */
			$tCuts = ( $boardSet["skin"] == 'counsel' ) ? "55" : "70";
			$Data[$lTmp]["subject"] = mb_strimwidth( stripslashes( $Data[$lTmp]["subject"] ), 0, $tCuts, "...", "utf-8" );
			/* 제목길이 조절 끝   */

			/* 날짜길이 조절 시작 */
			$Data[$lTmp]["regdate"] = substr( $Data[$lTmp]["regdate"], 0, 10 );
			/* 날짜길이 조절 끝   */

			/* 답변 이미지 셀렉트 시작 */
				$Data[$lTmp]["answerimg"] = (trim($Data[$lTmp]["reply"])!='') ? "<span class='end'>답변완료</span>" : "<span class='ing'>답변대기</span>";
			/* 답변 이미지 셀렉트 끝   */

			/* 링크설정 시작 */
			//if( $boardSet["skin"] != "faq" && $boardSet["skin"] != "media" ) {
			if( $boardSet["skin"] != "question" ) {
				if ( $_SESS["ss_level"] <= 2 || ( $Data[$lTmp]["secret"] == 'N' && $_SESS["ss_level"] <= $boardSet["viewlevel"] ) || ( $_SESS["ss_name"] && $_SESS["ss_id"] == $Data[$lTmp]["id"] ) ) {
					$Data[$lTmp]["viewlink"] = "<a href='".$PHP_SELF."?tb=".$tb."&act=view&tNum=".$Data[$lTmp]["number"]."&sSearch=$sSearch&sKeyword=".urlencode($sKeyword)."&p=$p'>";
				} else {
					if ($_SESS["ss_level"] > $boardSet["viewlevel"]) {
						 $Data[$lTmp]["viewlink"]="<a href='javascript:mem_login();'>";
					} else {
						$Data[$lTmp]["viewlink"] = pwd_link(array("tb"=>$tb,"act"=>"view","tNum"=>$Data[$lTmp]["number"]));
					}
				}

				// 게시판의 의료법 적용으로 로그인시 보이게 할때
				if(($tb=='review2' || $tb=='rubyrealstory2' || $tb=='rubystory') && ($_SESS["ss_id"]=='' || !$_SESS["ss_id"])){
					 $Data[$lTmp]["viewlink"]="<a href='javascript:mem_login();'>";
				}
			}else {
				$Data[$lTmp]["viewlink"] = "<a href=\"javascript:show_mytr('".$lTmp."');\">";
			}
			if( $boardSet["skin"] == 'faq' ) {
				/* 수정링크 */
				$Data[$lTmp]["modifylink"] = ( $_SESSION["ss_level"] > 2 ) ? "" : "<a href='".$PHP_SELF."?tb=".$tb."&act=modify&tNum=".$Data[$lTmp]["number"]."'>";											
				/* 삭제링크 */
				$Data[$lTmp]["deletelink"] = ( $_SESSION["ss_level"] > 2 ) ? "" : "<a href='".$PHP_SELF."?tb=".$tb."&act=delete&tNum=".$Data[$lTmp]["number"]."' onClick=\"return confirm('삭제하시겠습니까?')\">";
			}

			if( $boardSet["skin"] == 'gallery' ) {
				$Data[$lTmp]["viewImg"][0]	= ( trim( $Data[$lTmp]["thumfile2"][0] ) ) ? "<img src='/_data/".$tb."/".$Data[$lTmp]["thumfile2"][0]."' width='165' height='119'>" : "<img src='/board/skin/".$boardSet["skin"]."/images/noimg_small.gif' width='165' height='119'>";
				$Data[$lTmp]["viewImg"][1]	= ( trim( $Data[$lTmp]["thumfile2"][1] ) ) ? "<img src='/_data/".$tb."/".$Data[$lTmp]["thumfile2"][1]."' width='165' height='119'>" : "<img src='/board/skin/".$boardSet["skin"]."/images/noimg_small.gif' width='165' height='119'>";
			} 
			
			if( $boardSet["skin"] == 'vod' ){
				$Data[$lTmp]["viewImg"][0]	= ( trim( $Data[$lTmp]["savefile"][0] ) ) ? "<img src='".$Data[$lTmp]["savefile"][0]."' border='0' width='200' height='160'>" : "<img src='/board/skin/".$boardSet["skin"]."/images/img_noimg.gif' border='0' width='200' height='160'>";
			}
			
			if( $boardSet["skin"] == 'webzine' ){
				$Data[$lTmp]["viewImg"][0]	= ( trim( $Data[$lTmp]["savefile"][0] ) ) ? "<img src='/_data/".$tb."/".$Data[$lTmp]["savefile"][0]."' border='0' width='138' height='103'>" : "<img src='/board/skin/".$boardSet["skin"]."/images/noimg_list.gif' border='0' width='138' height='103'>";
			}
			
			if( $boardSet["skin"] == 'customer' ){
				$Data[$lTmp]["viewImg"][0]	= ( trim( $Data[$lTmp]["savefile"][0] ) ) ? "<img src='/_data/".$tb."/".$Data[$lTmp]["savefile"][0]."' border='0' width='240' height='192'>" : "<img src='/board/skin/".$boardSet["skin"]."/images/img_noimg.gif' border='0' width='240' height='192'>";
			}
			/* 링크설정 끝   */
		
			/* 비밀글 시작 */
			$Data[$lTmp]["keyimg"]	= ( $Data[$lTmp]["secret"] == 'Y' ) ? "<img src='/board/skin/".$boardSet["skin"]."/images/icon_lock.gif' align='absmiddle' alt='비밀글'>&nbsp;" : "";
			/* 비밀글 끝 */

			$viewCount--;
			$lTmp++;
		}

		/* 스킨파일 인클루드 */
		$list_file = getListSkinFile($boardSet["skin"]);
		include $list_file;
	}

	/***********************************************************************************************/
	/* 썸네일 생성및 단어 필터링                                                                   */	/***********************************************************************************************/
	if( $act == 'write_ok' || $act == 'modify_ok' || $act == 'reply_ok' ) {

		/*
		var_dump($_FILES['strSaveFile']['name']);
		echo '<br/><br/><br/><br/>';
		var_dump($_FILES['strSaveFile']['tmp_name']);
		echo '<br/><br/><br/><br/>';
		var_dump($_FILES['strSaveFile']['size']);
		*/

		/* 썸네일 생성 시작 */
		include $_SERVER['DOCUMENT_ROOT']."/include/fileupload.php";
		/* 썸네일 생성 끝   */

		/* 필터링 시작 */
			/*$filter_Arr = explode(',',$tblFilter);
			for($f = 0; $f < count($filter_Arr); $f++) {
				$fcount1 = substr_count($subject,$filter_arr[$f]);
				$fcount2 = substr_count($comment,$filter_arr[$f]);
				if( $fcount1 > 0 || $fcount2 > 0 ) {
					echo "<script language='javascript'>";
					echo "	alert('[$filter_Arr[$f]]는 사용하실 수 없는 단어입니다.');";
					echo "	history.go(-1);";
					echo "</script>";
				}
			}*/
		/* 필터링 끝   */

		/* 홈페이지 입력시 'http://' 제거 시작 */
		$Data["homepage"] = str_replace('http://','',$strHomePage);
		/* 홈페이지 입력시 'http://' 제거 끝   */
	}

	/***********************************************************************************************/
	/* 글 등록 시작                                                                                */	/***********************************************************************************************/
	if( $act == 'write' ) {

		if( $_SESS["ss_level"] > $boardSet["writelevel"] ) {
			echo "<script language='javascript'>";
			echo "	alert('고객님은 현재 [".$memberNameArr[$_SESSION["ss_level"]]."] 입니다.\\n\\n[".$memberNameArr[$boardSet["writelevel"]]."] 이상만 글쓰기가 가능합니다.');";
			echo "	history.go(-1);";
			echo "</script>";
			exit;
		}
		
		/* 자동글등록방지 시작 */
		include $_SERVER['DOCUMENT_ROOT']."/norobot/norobot.inc.php";
		echo "<script language='javascript' src='/norobot/md5.js'></script>";
		/* 자동글등록방지 끝   */

		$Data["name"]			= ( $_SESSION["ss_name"] ) ? $_SESSION["ss_name"] : "";
		$Data["phone"]		= ( $_SESS["ss_phone"] ) ? explode( '-', $_SESS["ss_phone"] ) : "";
		$Data["mobile"]		= ( $_SESSION["ss_mobile"] ) ? explode( '-', $_SESS["ss_mobile"] ) : "";
		$Data["email"]		= ( $_SESSION["ss_email"] ) ? $_SESSION["ss_email"] : "";

		/* 스킨파일 인클루드 */
		include $_SERVER['DOCUMENT_ROOT']."/board/skin/".$boardSet["skin"]."/write.php";

	}

	/***********************************************************************************************/
	/* 글 저장 시작                                                                                */	/***********************************************************************************************/
	if( $act == 'write_ok' ) {

		// 전환,공통 스크립트
		include $_SERVER['DOCUMENT_ROOT']."/m/include/switch_script.php";  
		include $_SERVER['DOCUMENT_ROOT']."/m/include/common_script.php"; 			

			if( !$step || $step != 'next' ) {
				echo "<script language='javascript'>alert('잘못된 접근입니다.'); history.go(-1);</script>";
				exit;
			}

			if( $_SESS["ss_level"] > $boardSet["writelevel"] ) {
				echo "<script language='javascript'>alert('고객님은 현재 [".$memberNameArr[$_SESSION["ss_level"]]."] 입니다.\\n\\n[".$memberNameArr[$boardSet["writelevel"]]."] 이상만 글쓰기가 가능합니다.'); history.go(-1);</script>";
				exit;
			}

			/* 자동글등록방지 체크 시작 */
			if( $boardSet["skin"] != 'call'){
				include $_SERVER['DOCUMENT_ROOT']."/norobot/norobot_check.inc.php";
			}
			/* 자동글등록방지 체크 끝   */

			$result = mysql_query( "select max(tblIntFid) from tbl_".$tb );
			$row = mysql_fetch_row( $result );

			$Data["fid"]			= ( $row[0] ) ? $row[0] + 1 : 1;		
			$Data["thread"]			= "A";			
			$Data["field"]			= $_POST["intField"];
			$Data["phone"]			= $_POST["strPhone1"]."-".$_POST["strPhone2"]."-".$_POST["strPhone3"];
			$Data["mobile"]			= $_POST["strMobile1"]."-".$_POST["strMobile2"]."-".$_POST["strMobile3"];	
			$Data["name"]			= $_POST["strName"];
			$Data["subject"]		= addslashes( $_POST["strSubject"] );
			$Data["comment"]		= addslashes( str_replace($bagData["host"], "", $_POST["strComment"] ));
			$Data["blnsms"]			= ( $_POST["blnSms"] == 'Y' ) ? 'Y' : "N";
			$Data["email"]			= $_POST["strEmail"];
			$Data["blnemail"]		= ( $_POST["blnEmail"] == 'Y' ) ? 'Y' : "N";
			$Data["notice"]			= ( $_POST["intNotice"] == 1 ) ? 1 : 0;
			$Data["secret"]			= ( $_POST["strSecret"] == 'Y' ) ? 'Y' : "N";
			$Data["passwd"]			= $_POST["strPass"];
			/*
			// strShow 선택할수 있는 기능이 없음
			if( $boardSet["control"] == 'Y' ) {
				$Data["show"]		= ( $_POST["strShow"] == 'Y' ) ? 'Y' : "N";
			} else {
				$Data["show"]		= 'Y';
			}
			*/
			$Data["show"]		= 'Y';
			$Data["intgp"]			= $_POST["intGP"];
			$Data["press"]			= $_POST["intPress"];
			$Data["streaming"]		= $_POST["strStreaming"];
			$Data["ip"]				= $HTTP_SERVER_VARS["REMOTE_ADDR"];
			if ($tb == 'online_counsel') {
				$Data["etc"]			= $_POST["cate1"].'|'.$_POST["cate2"].'|'.$_POST["cate3"];		
			} else {
				$Data["etc"]			= $_POST["etc"];		
			}
			$Data["ref"]			= ( $_POST["intRef"] ) ? $_POST["intRef"] : 0;	
			$Data["regdate"]		=	( $_POST["iYear"] && $_POST["iMonth"] && $_POST["iDay"] ) ? $_POST["iYear"]."-".$_POST["iMonth"]."-".$_POST["iDay"]." ".date('H').":".date('i').":".date('s') : date('Y-m-d H:i:s', time());
			$Data["homepage"]		= $_POST["strHomepage"];

			$Data["sex"]			= $_POST["tblSex"];
			$Data["age"]			= $_POST["tblAge"];
			$Data["period"]			= $_POST["tblPeriod"];
			$Data["comment2"]		= $_POST["tblStrComment2"];

			// $Data["savefile"] 가 없으면 에디터 첫번째 이미지 등록
			if (!$Data["savefile"]) {
				$src = imgTag($Data["comment"]);
				$Data["savefile"][] = str_replace("\\","",$src[0]);
			}

			/* 이미지 정리 시작 */
			$Data["savefile"]		= ( $Data["savefile"] ) ? implode( '|', $Data["savefile"] ) : "";
			$Data["liefile"]		= ( $Data["liefile"] )  ? implode( '|', $Data["liefile"] ) : "";
			$Data["thumfile1"]		= $Data["savefile"];
			$Data["thumfile2"]		= ( $Data["thumfile2"] ) ? implode( '|', $Data["thumfile2"] ) : "";
			$Data["thumfile3"]		= ( $Data["thumfile3"] ) ? implode( '|', $Data["thumfile3"] ) : "";
			$Data["thumfile4"]		= ( $Data["thumfile4"] ) ? implode( '|', $Data["thumfile4"] ) : "";
			$Data["thumfile5"]		= ( $Data["thumfile5"] ) ? implode( '|', $Data["thumfile5"] ) : "";
			/* 이미지 정리 끝   */

			$iQue = "INSERT INTO tbl_".$tb." SET ";
			$iQue .= " tblIntFid='".$Data["fid"]."',";
			$iQue .= " tblStrThread='".$Data["thread"]."',";
			$iQue .= " tblIntField='".$Data["field"]."',";
			$iQue .= " tblStrID='".$_SESS["ss_id"]."',";
			$iQue .= " tblStrPass=password('".$Data["passwd"]."'),";
			$iQue .= " tblStrName='".$Data["name"]."',";
			$iQue .= " tblStrSubject='".$Data["subject"]."',";
			$iQue .= " tblStrPhone='".$Data["phone"]."',";
			$iQue .= " tblStrMobile='".$Data["mobile"]."',";
			$iQue .= " tblBlnSms='".$Data["blnsms"]."',";
			$iQue .= " tblStrEmail='".$Data["email"]."',";
			$iQue .= " tblBlnEmail='".$Data["blnemail"]."',";
			$iQue .= " tblStrHomePage='".$Data["homepage"]."',";
			$iQue .= " tblIntNotice='".$Data["notice"]."',";
			$iQue .= " tblStrSecret='".$Data["secret"]."',";
			$iQue .= " tblStrComment='".$Data["comment"]."',";
			$iQue .= " tblStrSaveFile='".$Data["savefile"]."',";
			$iQue .= " tblStrLieFile='".$Data["liefile"]."',";
			$iQue .= " tblStrThum1='".$Data["thumfile1"]."',";
			$iQue .= " tblStrThum2='".$Data["thumfile2"]."',";
			$iQue .= " tblStrThum3='".$Data["thumfile3"]."',";
			$iQue .= " tblStrThum4='".$Data["thumfile4"]."',";
			$iQue .= " tblStrThum5='".$Data["thumfile5"]."',";
			$iQue .= " tblIntRef='".$Data["ref"]."',";
			$iQue .= " tblStrShow='".$Data["show"]."',";
			$iQue .= " tblStrIp='".$Data["ip"]."',";
			$iQue .= " tblIntGP='".$Data["intgp"]."',";
			$iQue .= " tblIntPress='".$Data["press"]."',";
			$iQue .= " tblStrStreaming='".$Data["streaming"]."',";
			$iQue .= " tblStrEtc='".$Data["etc"]."',";
		if($boardSet["skin"] == 'bna_type1'){
			$iQue .= " tblSex='".$Data["sex"]."',";
			$iQue .= " tblAge='".$Data["age"]."',";
			$iQue .= " tblPeriod='".$Data["period"]."',";
			$iQue .= " tblStrComment2='".$Data["comment2"]."',";
		}
		if($boardSet["skin"] == 'event_type1'){
			$iQue .= " start_date='".$Data["start_date"]."',";
			$iQue .= " end_date='".$Data["end_date"]."',";
		}
			$iQue .= " tblDtmRegDate='".$Data["regdate"]."'";
	
			//echo "$iQue"; die();
			$iSql = mysql_query($iQue) or die(mysql_error());


		if($tb == 'online'){
			echo "<script>";
			echo "	window.open('/popup_Alert04.html','colortemplet','toolbar =no, location=no, directiries=no, status=no, menubar=no, scrollbars=no, resizable=no,width=360,height=200,top=100,left=200');";
			echo "</script>";
		}

		echo "<script language='javascript'>";
		echo "	location.href='$PHP_SELF?tb=$tb&act=list';";
		echo "</script>";
	}

	//////////////////// 수정일때 ///////////////////////////////////////////////////////////////////// 
	if( $act == 'modify' ) {

		if( !$tNum ) echo "<script language='javascript'>alert('게시물 번호가 필요합니다.'); history.go(-1);</script>";

		/*if( $_SESS["ss_level"] > $boardSet["modifylevel"] && $Pass["passwd"] != $Data["passwd"] )
			echo "<script language='javascript'>alert('수정하기 권한이 없습니다.'); history.go(-1);</script>";*/


		/* 자동글등록방지 시작 */
		include $_SERVER['DOCUMENT_ROOT']."/norobot/norobot.inc.php";
		echo "<script language='javascript' src='/norobot/md5.js'></script>";
		/* 자동글등록방지 끝   */

		$Query = "SELECT * FROM tbl_$tb WHERE tblNumber='$tNum'";
		$Sql = mysql_query( $Query );
		$Array = mysql_fetch_array($Sql);
		$Data["number"]			= $Array["tblNumber"];
		$Data["fid"]			= $Array["tblIntFid"];
		$Data["thread"]			= $Array["tblStrThread"];
		$Data["field"]			= $Array["tblIntField"];
		$Data["id"]				= $Array["tblStrID"];
		$Data["passwd"]			= $Array["tblStrPass"];
		$Data["name"]			= $Array["tblStrName"];
		$Data["subject"]		= stripslashes( $Array["tblStrSubject"] );
		$Data["phone"]			= explode( '-', $Array["tblStrPhone"] );
		$Data["mobile"]			= explode( '-', $Array["tblStrMobile"] );
		$Data["blnsms"]			= $Array["tblBlnSms"];
		$Data["email"]			= $Array["tblStrEmail"];
		$Data["blnemail"]		= $Array["tblBlnEmail"];
		$Data["homepage"]		= $Array["tblStrHomePage"];
		$Data["notice"]			= $Array["tblIntNotice"];
		$Data["secret"]			= $Array["tblStrSecret"];
		$Data["comment"]		= str_replace("src=\"/_data/", "src=\"".$bagData["host"]."/_data/", stripslashes( $Array["tblStrComment"] ));
		$Data["savefile"]		= explode( '|', $Array["tblStrSaveFile"] );
		$Data["liefile"]		= explode( '|', $Array["tblStrLieFile"] );
		$Data["thumfile1"]		= explode( '|', $Array["tblStrThum1"] );
		$Data["thumfile2"]		= explode( '|', $Array["tblStrThum2"] );
		$Data["thumfile3"]		= explode( '|', $Array["tblStrThum3"] );
		$Data["thumfile4"]		= explode( '|', $Array["tblStrThum4"] );
		$Data["thumfile5"]		= explode( '|', $Array["tblStrThum5"] );
		$Data["reply"]			= stripslashes( $Array["tblStrReply"] );
		$Data["ref"]			= $Array["tblIntRef"];
		$Data["ip"]				= $Array["tblStrIp"];
		$Data["show"]			= $Array["tblStrShow"];
		$Data["reid"]			= $Array["tblStrReID"];
		$Data["rename"]			= $Array["tblStrReName"];
		$Data["regdate"]		= $Array["tblDtmRegDate"];
		$Data["moddate"]		= $Array["tblDtmModDate"];
		$Data["redate"]			= $Array["tblDtmReDate"];
		$Data["intgp"]			= $Array["tblIntGP"];
		$Data["press"]			= $Array["tblIntPress"];
		$Data["streaming"]		= $Array["tblStrStreaming"];
		$Data["etc"]			= $Array["tblStrEtc"];
		$Data["age"]			= $Array["tblAge"];
		$Data["sex"]			= $Array["tblSex"];
		$Data["period"]			= $Array["tblPeriod"];
		$Data["comment2"]		= stripslashes( $Array["tblStrComment2"] );

		$Data["start_date"]		= stripslashes( $Array["start_date"] );
		$Data["end_date"]		= stripslashes( $Array["end_date"] );

		if ($_SESSION['ss_level'] == 8) {		// 수정시 문제발생
			$strName=($_SESSION["ss_name"])?$_SESSION["ss_name"]:$Data["name"];
		} else {
			$strName=$Data["name"];
		}

		if( $_SESS["ss_level"] > 2 && $_SESS["ss_level"] > $boardSet["modifylevel"]){
			if($bibun != $Data["passwd"] || $bibun==''){
				echo "<script language='javascript'>alert('고객님은 현재 [".$memberNameArr[$_SESSION["ss_level"]]."] 입니다.\\n\\n[".$memberNameArr[$boardSet["modifylevel"]]."] 이상만 수정하기가 가능합니다.'); history.go(-1);</script>";
				exit;
			}
		}

		if($Data["secret"] == 'Y' && $_SESS["ss_level"] > 2){
			if($_SESS["ss_id"] != $Data["id"] || $_SESS["ss_id"]==''){
				if($bibun != $Data["passwd"] || $bibun==''){
					echo "<script language='javascript'>alert('비밀글입니다.\\n글을 입력하신분과 관리자만 수정할 수 있습니다.'); history.go(-1);</script>";
					exit;
				}
			}
		}

		/* 스킨파일 인클루드 */
		include $_SERVER['DOCUMENT_ROOT']."/board/skin/".$boardSet["skin"]."/write.php";
	}

	if( $act == 'modify_ok' ) {

		if( !$step || $step != 'next' ) echo "<script language='javascript'>alert('잘못된 접근입니다.'); history.go(-1);</script>";

		/* if( $_SESS["ss_level"] > $boardSet["modifylevel"] ) echo "<script language='javascript'>alert('수정하기 권한이 없습니다.'); history.go(-1);</script>"; */

		/* 자동글등록방지 체크 시작 */
		if( $boardSet["skin"] != 'call'){
			include $_SERVER['DOCUMENT_ROOT']."/norobot/norobot_check.inc.php";
		}
		/* 자동글등록방지 체크 끝   */
		
		/* 기존 파일들 삭제하고 다시 올리기 시작 */
		$Que = "SELECT * FROM tbl_".$tb." WHERE tblNumber='$tNum' and tblStrPass=password('".$strPass."')";
		$Sql = mysql_query( $Que );
		$Result = mysql_fetch_array( $Sql );

		if( $_SESS["ss_level"] > 2 && !$Result["tblNumber"]) {
			echo "<script langauge='javascript'>alert('비밀번호가 잘못되었습니다.'); history.go(-1);</script>";
			exit;
		}

		$Modify["savefile"] = explode('|',$Result["tblStrSaveFile"]);
		$Modify["liefile"] = explode('|',$Result["tblStrLieFile"]);
		$Modify["thumfile1"] = explode('|',$Result["tblStrThum1"]);
		$Modify["thumfile2"] = explode('|',$Result["tblStrThum2"]);
		$Modify["thumfile3"] = explode('|',$Result["tblStrThum3"]);
		$Modify["thumfile4"] = explode('|',$Result["tblStrThum4"]);
		$Modify["thumfile5"] = explode('|',$Result["tblStrThum5"]);

		for( $j = 0; $j < $boardSet["addfilenumber"]; $j++ ) {
			/* 초기값 세팅 시작 */
			$mData["savefile"]	= ( $mData["savefile"] ) ? $mData["savefile"]."|" : ""; 
			$mData["liefile"]	= ( $mData["liefile"] ) ? $mData["liefile"]."|" : ""; 
			$mData["thumfile1"]	= ( $mData["thumfile1"] ) ? $mData["thumfile1"]."|" : ""; 
			$mData["thumfile2"]	= ( $mData["thumfile2"] ) ? $mData["thumfile2"]."|" : ""; 
			$mData["thumfile3"]	= ( $mData["thumfile3"] ) ? $mData["thumfile3"]."|" : ""; 
			$mData["thumfile4"]	= ( $mData["thumfile4"] ) ? $mData["thumfile4"]."|" : ""; 
			$mData["thumfile5"]	= ( $mData["thumfile5"] ) ? $mData["thumfile5"]."|" : ""; 
			/* 초기값 세팅 끝   */
			if( trim( $Data["savefile"][$j] ) ) { 
				/* 첨부파일이 있고 기존 파일이 존재할때 기존파일 삭제 시작 */
				if( $Modify["savefile"][$j] ){
					@unlink( $bagData["absoluteDir"]."/_data/".$tb."/".$Modify["savefile"][$j] );
					@unlink( $bagData["absoluteDir"]."/_data/".$tb."/".$Modify["liefile"][$j] );
					@unlink( $bagData["absoluteDir"]."/_data/".$tb."/".$Modify["thumfile1"][$j] );
					@unlink( $bagData["absoluteDir"]."/_data/".$tb."/".$Modify["thumfile2"][$j] );
					@unlink( $bagData["absoluteDir"]."/_data/".$tb."/".$Modify["thumfile3"][$j] );
					@unlink( $bagData["absoluteDir"]."/_data/".$tb."/".$Modify["thumfile4"][$j] );
					@unlink( $bagData["absoluteDir"]."/_data/".$tb."/".$Modify["thumfile5"][$j] );

					@unlink( $bagData["absoluteDir"].$Modify["savefile"][$j] );
					@unlink( $bagData["absoluteDir"].$Modify["liefile"][$j] );
					@unlink( $bagData["absoluteDir"].$Modify["thumfile1"][$j] );
					@unlink( $bagData["absoluteDir"].$Modify["thumfile2"][$j] );
					@unlink( $bagData["absoluteDir"].$Modify["thumfile3"][$j] );
					@unlink( $bagData["absoluteDir"].$Modify["thumfile4"][$j] );
					@unlink( $bagData["absoluteDir"].$Modify["thumfile5"][$j] );
				} 
				/* 이미지 정리 시작 */
				$mData["savefile"]	.= $Data["savefile"][$j];
				$mData["liefile"]	.= $Data["liefile"][$j];
				$mData["thumfile1"]	.= $Data["savefile"][$j];
				$mData["thumfile2"]	.= $Data["thumfile2"][$j];
				$mData["thumfile3"]	.= $Data["thumfile3"][$j];
				$mData["thumfile4"]	.= $Data["thumfile4"][$j];
				$mData["thumfile5"]	.= $Data["thumfile5"][$j];
				/* 이미지 정리 끝   */
				/* 첨부파일이 있고 기존 파일이 존재할때 기존파일 삭제 끝   */
			} else {
				/* 이미지 정리 시작 */
				$mData["savefile"]	.= $Modify["savefile"][$j];
				$mData["liefile"]	.= $Modify["liefile"][$j];
				$mData["thumfile1"]	.= $Modify["savefile"][$j];
				$mData["thumfile2"]	.= $Modify["thumfile2"][$j];
				$mData["thumfile3"]	.= $Modify["thumfile3"][$j];
				$mData["thumfile4"]	.= $Modify["thumfile4"][$j];
				$mData["thumfile5"]	.= $Modify["thumfile5"][$j];
				/* 이미지 정리 끝   */
			}
		}
		/* 기존 파일들 삭제하고 다시 올리기 끝   */
		$mData["field"]			= $intField;
		$mData["subject"]		= addslashes( $strSubject );
		$mData["name"]			= $strName;
		$mData["rename"]		= ( trim( $strReName ) ) ? $strReName : $Result["tblStrReName"];
		$mData["reid"]			= ( trim( $Result["tblStrReID"] ) ) ? $Result["tblStrReID"] : $_SESSION["ss_id"];
		$mData["phone"]			= $strPhone1."-".$strPhone2."-".$strPhone3;
		$mData["mobile"]		= $strMobile1."-".$strMobile2."-".$strMobile3;
		$mData["email"]			= $strEmail;
		$mData["blnsms"]		= ( $blnSms == 'Y' ) ? "Y" : "N";
		$mData["blnemail"]		= ( $blnEmail == 'Y' ) ? "Y" : "N";
		$mData["notice"]		= ( $intNotice == 1 ) ? 1 : 0;
		$mData["secret"]		= ( $strSecret == 'Y' ) ? "Y" : "N";
		$mData["comment"]		= addslashes( str_replace($bagData["host"], "", $_POST["strComment"] ));

		$mData["ref"]			= ( $_POST["intRef"] ) ? $_POST["intRef"] : $Result["tblIntRef"];	
		$mData["regdate"]		=	( $_POST["iYear"] && $_POST["iMonth"] && $_POST["iDay"] ) ? $_POST["iYear"]."-".$_POST["iMonth"]."-".$_POST["iDay"]." ".date('H').":".date('i').":".date('s') : "";

		$mData["reply"]			= ( $strReply ) ? addslashes( $strReply ) : $Result["tblStrReply"];
		if( $boardSet["control"] == 'Y' ) {
			$mData["show"]		= ( $strShow == 'Y' ) ? "Y" : "N";
		} else {
			$mData["show"]		= "Y";
		}
		//$mData["show"]		= "Y";
		$mData["intgp"]			= $intGP;
		$mData["press"]			= $intPress;
		$mData["streaming"]		= $strStreaming;
		$mData["newemail"]		= $_POST["newemail"];
		$mData["newsms"]		= $_POST["newsms"];
		$mData["etc"]			= $_POST["etc"];
		$mData["homepage"]		= $_POST["strHomepage"];
		
		$mData["age"]			= $_POST["tblAge"];
		$mData["sex"]			= $_POST["tblSex"];
		$mData["period"]		= $_POST["tblPeriod"];
		$mData["comment2"]		= $_POST["tblStrComment2"];

		$mData["start_date"]	= $_POST["start_date"];
		$mData["end_date"]		= $_POST["end_date"];
		if ($tb == 'online_counsel') {
			$Data["etc"]			= $_POST["cate1"].'|'.$_POST["cate2"].'|'.$_POST["cate3"];		
		} else {
			$Data["etc"]			= $_POST["etc"];		
		}

		$mQue = "UPDATE tbl_".$tb." SET ";
		$mQue .= "tblIntField='".$mData["field"]."',";
		$mQue .= "tblStrName='".$mData["name"]."',";
		$mQue .= "tblStrSubject='".$mData["subject"]."',";
		$mQue .= "tblStrPhone='".$mData["phone"]."',";
		$mQue .= "tblStrMobile='".$mData["mobile"]."',";
		$mQue .= "tblBlnSms='".$mData["blnsms"]."',";
		$mQue .= "tblStrEmail='".$mData["email"]."',";
		$mQue .= "tblBlnEmail='".$mData["blnemail"]."',";
		$mQue .= "tblStrHomePage='".$mData["homepage"]."',";
		$mQue .= "tblIntNotice='".$mData["notice"]."',";
		$mQue .= "tblStrSecret='".$mData["secret"]."',";
		$mQue .= "tblStrComment='".$mData["comment"]."',";
		$mQue .= "tblStrSaveFile='".$mData["savefile"]."',";
		$mQue .= "tblStrLieFile='".$mData["liefile"]."',";
		$mQue .= "tblStrThum1='".$mData["thumfile1"]."',";
		$mQue .= "tblStrThum2='".$mData["thumfile2"]."',";
		$mQue .= "tblStrThum3='".$mData["thumfile3"]."',";
		$mQue .= "tblStrThum4='".$mData["thumfile4"]."',";
		$mQue .= "tblStrThum5='".$mData["thumfile5"]."',";
		$mQue .= "tblStrReply='".$mData["reply"]."',";
		if($mData["reply"]!='') $mQue .= "tblStrReID='".$mData["reid"]."',";
		$mQue .= "tblStrReName='".$mData["rename"]."',";
		if($mData["reply"]!='') $mQue .= "tblDtmReDate=now(),";
		$mQue .= "tblStrShow='".$mData["show"]."',";
		$mQue .= "tblIntGP='".$mData["intgp"]."',";
		$mQue .= "tblIntPress='".$mData["press"]."',";
		$mQue .= "tblStrStreaming='".$mData["streaming"]."',";
		$mQue .= "tblStrEtc='".$mData["etc"]."',";
		$mQue .= "tblIntRef='".$mData["ref"]."',";
		$mQue .= "tblStrEtc='".$Data["etc"]."',";
		if($tb == 'event'){
			$mQue .= " entSubject='".$_POST["entSubject"]."',";
			$mQue .= " entStart='".$_POST["entStart"]."',";
			$mQue .= " entEnd='".$_POST["entEnd"]."',";
		}
		if( $mData["regdate"] ) {
			$mQue .= "tblDtmRegDate='".$mData["regdate"]."',";
		}
		$mQue .= "tblDtmModDate=now() WHERE tblNumber='".$tNum."' AND tblIntFid='".$Result["tblIntFid"]."'";
		//echo "$mQue"; die();

		$mSql = mysql_query($mQue) or die(mysql_error());

		/* 메일발송 */
		if( $_SESS["ss_level"] <= 2 && $mData["newemail"] == 'Y' && trim( $mData["reply"] ) ) {
			$homeUrl = "http://".$bagData["host"];
			$fromname = $bagData["siteName"];
			$fromname='=?UTF-8?B?'.base64_encode($fromname).'?=';
			$fromaddress = $admData["email"];
			$server_mail = $admData["email"];
			$headers = "From: ".$fromname." < ".$fromaddress." > \n"; 
			$headers .= "X-Sender: < ".$server_mail." >\n"; 
			$headers .= "X-Mailer: PHP\n"; 
			$headers .= "Return-Path: < ".$fromaddress." >\n";  
			$headers .= "Content-Type: text/html; charset=utf-8\n"; 
			$headers .= "\n"; 
			/*$fp = fopen($_SERVER['DOCUMENT_ROOT']."/mail/mail_join.html","r");
			$m_content = fread($fp,"100000");
			fclose($fp);*/
			$m_contents = sock_url( $bagData["host"], "80", "http://".$bagData["host"]."/mail/letter_answer.html");
			$m_contents = str_replace("@HOMEURL@",$homeUrl,$m_contents);
			$m_contents = str_replace("@NAME@",$mData["name"],$m_contents);
			$m_contents = str_replace("@SUBJECT@",$mData["subject"],$m_contents);
			$m_contents = str_replace("@COMMENT@",stripslashes( $mData["comment"] ),$m_contents);
			$m_contents = str_replace("@RENAME@",$mData["rename"],$m_contents);
			$m_contents = str_replace("@REPLY@",$mData["reply"],$m_contents);

			$m_contents = str_replace("@ETC1@"," 회원님의 상담내역 입니다.",$m_contents);
			$m_contents = str_replace("@ETC2@","의 답변입니다.",$m_contents);

			$m_contents_arr = explode("\r\n\r\n",$m_contents);			
			$this_real="";
			if(substr($m_contents_arr[0],0,8)=="<!DOCTYP"){
				$this_real=$m_contents_arr[0];
			}else if(substr($m_contents_arr[1],0,8)=="<!DOCTYP"){
				$this_real=$m_contents_arr[1];
			}else if(substr($m_contents_arr[2],0,8)=="<!DOCTYP"){
				$this_real=$m_contents_arr[2];
			}else if(substr($m_contents_arr[3],0,8)=="<!DOCTYP"){
				$this_real=$m_contents_arr[3];
			}
			$m_contents = $this_real;

			$title = stripslashes( $mData["subject"] );
			$title='=?UTF-8?B?'.base64_encode($title).'?=';
			$res = mail($mData["email"],$title,$m_contents,$headers);
		}
		/* 메일발송 끝 */
		
		/*sms발송*/
		//if( $_SESS["ss_level"] <= 2 && $mData["newsms"] == 'Y' && trim( $mData["reply"] ) ) {
			/******************** 인증정보 ********************/
			/*$sms_id = $bagData["smsid"]; //SMS 아이디.
			$sms_pw = $bagData["smspass"];//SMS 패스워드
			if( $aSmsData[4]["use"] == 'Y' && trim( $aSmsData[4]["comment"] ) ) {
				$content = str_replace( "@NAME@", $mData["name"], trim( $aSmsData[4]["comment"] ) );
				$sms_msg = $content;
			} else {
				$sms_msg = $mData["name"]."님의 상담글에 답변이 등록되었습니다. [".$bagData["siteName"]."]";
			}
			$sms_from = $admData["phone"];
			$sms_to		= $mData["mobile"];
			$sms_ip		= $HTTP_SERVER_VARS["REMOTE_ADDR"];
			
			$sms = new EmmaSMS();
			$sms->login($sms_id, $sms_pw);	// $sms->login( [고객 ID], [고객 패스워드]);
			$ret = $sms->send($sms_to, $sms_from, $sms_msg, $sms_date);
			
			if($ret) {
				//print_r($ret);

				$smvQuery = "INSERT INTO tblSmsLogs SET ";
				$smvQuery .= "tblStrSender='".$sms_from."',";
				$smvQuery .= "tblStrAddressee='".$sms_to."',";
				$smvQuery .= "tblStrComment='".$sms_msg."',";
				$smvQuery .= "tblStrIp='".$sms_ip."',";
				$smvQuery .= "tblStrStatus='Y',";
				$smvQuery .= "tblDtmRegDate=now()";
				$smvSql = mysql_query( $smvQuery ) or die( mysql_error() );

				echo "<script language='javascript'>";
				echo "	location.href='$PHP_SELF?tb=$tb&act=list';";
				echo "</script>";
			} else {					

				$smvQuery = "INSERT INTO tblSmsLogs SET ";
				$smvQuery .= "tblStrSender='".$sms_from."',";
				$smvQuery .= "tblStrAddressee='".$sms_to."',";
				$smvQuery .= "tblStrComment='".$sms_msg."',";
				$smvQuery .= "tblStrIp='".$sms_ip."',";
				$smvQuery .= "tblStrStatus='N',";
				$smvQuery .= "tblDtmRegDate=now()";
				$smvSql = mysql_query( $smvQuery ) or die( mysql_error() );

				echo $sms->errMsg;
			}
		} else {*/
			echo "<script language='javascript'>";
			echo "	location.href='$PHP_SELF?tb=$tb&act=list';";
			echo "</script>";
		//}
	}

	//////////////////// 뷰일때 /////////////////////////////////////////////////////////////////////// 
	if( $act == 'view' ) {		

		$Query = "SELECT * FROM tbl_$tb WHERE tblNumber='$tNum'";
		$Sql = mysql_query( $Query );		
		$Array = mysql_fetch_array( $Sql );
		$Data["number"]			= $Array["tblNumber"];
		$Data["fid"]			= $Array["tblIntFid"];
		$Data["thread"]			= $Array["tblStrThread"];
		$Data["field"]			= $Array["tblIntField"];
		$Data["id"]				= $Array["tblStrID"];
		$Data["passwd"]			= $Array["tblStrPass"];
		$Data["name"]			= $Array["tblStrName"];
		$Data["subject"]		= stripslashes( $Array["tblStrSubject"] );
		$Data["phone"]			= $Array["tblStrPhone"];
		$Data["mobile"]			= $Array["tblStrMobile"];
		$Data["blnsms"]			= $Array["tblBlnSms"];
		$Data["email"]			= $Array["tblStrEmail"];
		$Data["blnemail"]		= $Array["tblBlnEmail"];
		$Data["homepage"]		= $Array["tblStrHomePage"];
		$Data["notice"]			= $Array["tlStrNotice"];
		$Data["secret"]			= $Array["tblStrSecret"];
		$Data["comment"]		= str_replace("src=\"".$bagData["host"]."/_data/", "src=\"/_data/", stripslashes( $Array["tblStrComment"] ));
		$Data["savefile"]		= explode( '|', $Array["tblStrSaveFile"] );
		$Data["liefile"]		= explode( '|', $Array["tblStrLieFile"] );
		$Data["thumfile1"]		= explode( '|', $Array["tblStrThum1"] );
		$Data["thumfile2"]		= explode( '|', $Array["tblStrThum2"] );
		$Data["thumfile3"]		= explode( '|', $Array["tblStrThum3"] );
		$Data["thumfile4"]		= explode( '|', $Array["tblStrThum4"] );
		$Data["thumfile5"]		= explode( '|', $Array["tblStrThum5"] );
		$Data["reply"]			= stripslashes( $Array["tblStrReply"] );
		$Data["ref"]			= $Array["tblIntRef"];
		$Data["ip"]				= $Array["tblStrIp"];
		$Data["show"]			= $Array["tblStrShow"];
		$Data["reid"]			= $Array["tblStrReID"];
		$Data["rename"]			= $Array["tblStrReName"];
		$Data["regdate"]		= substr( $Array["tblDtmRegDate"], 0, 10 );
		$Data["moddate"]		= $Array["tblDtmModDate"];
		$Data["redate"]			= $Array["tblDtmReDate"];
		$Data["intgp"]			= $Array["tblIntGP"];
		$Data["press"]			= $Array["tblIntPress"];
		$Data["streaming"]		= $Array["tblStrStreaming"];
		$Data["etc"]			= $Array["tblStrEtc"];
		$Data["age"]			= $Array["tblAge"];
		$Data["sex"]			= $Array["tblSex"];
		$Data["period"]			= $Array["tblPeriod"];
		$Data["comment2"]		= $Array["tblStrComment2"];
		$Data["entSubject"]			= $Array["entSubject"];
		$Data["entStart"]			= $Array["entStart"];
		$Data["entEnd"]			= $Array["entEnd"];

		$Data["vodSubject"]			= $Array["vodSubject"];
		$Data["vodCeo"]			= $Array["vodCeo"];
		$Data["vodDate"]			= $Array["vodDate"];
		$Data["vodPart"]			= $Array["vodPart"];

		$Data["rename"] = ( $Data["reid"] == 'admin' ) ? "<img src='/board/images/name_logo.gif' aling='absmiddle'>" : $Data["rename"];

		/* 읽기 권한 체크 시작 */
		if( $_SESS["ss_level"] > $boardSet["viewlevel"]) echo "<script language='javascript'>alert('고객님은 현재 [".$memberNameArr[$_SESSION["ss_level"]]."] 입니다.\\n\\n[".$memberNameArr[$boardSet["viewlevel"]]."] 이상만 글읽기가 가능합니다.'); location.href='?act=list';</script>";
		
		if($Data["secret"] == 'Y' && $_SESS["ss_level"] > 2){
			if($_SESS["ss_id"] != $Data["id"] || $_SESS["ss_id"]==''){
				if($bibun != $Data["passwd"] || $bibun==''){
					echo "<script language='javascript'>alert('비밀글입니다.\\n글을 입력하신분과 관리자만 볼수 있습니다.'); history.go(-1);</script>";
					exit;
				}
			}
		}
			
		//echo $Data["secret"]."-".$_SESS["ss_level"]."-".$_SESS["ss_id"]."-".$Data["id"]."-".$bibun."-".$Data["passwd"];
		/* 읽기 권한 체크 끝   */

		/* 조회수 증가 시작 */
		$ref_Que = "UPDATE tbl_".$tb." SET tblIntRef=tblIntRef+1 where tblNumber='$tNum'";
		$ref_Sql = @mysql_query($ref_Que);
		/* 조회수 증가 끝   */

		/* 글쓰기링크 시작 */
		$view["writelink"] = ( $_SESS["ss_level"] > $boardSet["writelevel"] ) ? "<a href=\"javascript: alert('고객님은 현재 [".$memberNameArr[$_SESSION["ss_level"]]."] 입니다.\\n\\n[".$memberNameArr[$boardSet["writelevel"]]."] 이상만 글쓰기가 가능합니다.')\">" : "<a href='$PHP_SELF?tb=$tblBtable&mode=write'>";
		/* 글쓰기링크 끝   */

		/* 수정하기 링크 시작 */
		if ( $_SESS["ss_level"] <= 2 || ( $_SESS["ss_level"] <= $boardSet["modifylevel"] && $_SESS["ss_id"] && ( $_SESS["ss_id"] == $Data["id"] ) ) ) {
			$view["modifylink"] =  "<span><a href='".$PHP_SELF."?tb=".$tb."&act=modify&tNum=".$Data["number"]."'>";
		} else {
			if ($_SESS["ss_level"] == 10 && $boardSet["modifylevel"] == 10) {
				 $view["modifylink"] = pwd_link(array("tb"=>$tb,"act"=>"modify","tNum"=>$Data["number"]));
			}
		 }
		/* 수정하기 링크 끝   */

		/* 삭제하기 링크 시작 */
		if ( $_SESS["ss_level"] <= 2 || ( $_SESS["ss_level"] <= $boardSet["deletelevel"] && $_SESS["ss_id"] && ( $_SESS["ss_id"] == $Data["id"] ) ) ) {
			$view["deletelink"] =  "<span><a href='".$PHP_SELF."?tb=".$tb."&act=delete&tNum=".$Data["number"]."' onClick=\"return confirm('삭제하시겠습니까?')\">";
		} else {
			if ($_SESS["ss_level"] == 10 && $boardSet["deletelevel"] == 10) {
				 $view["deletelink"] = pwd_link(array("tb"=>$tb,"act"=>"delete","tNum"=>$Data["number"]));
			}
		 }
		/* 삭제하기 링크 끝   */

		/* 답변하기 링크 시작 */
		$view["replylink"] = ( $_SESS["ss_level"] <= 2 || ( $_SESS["ss_level"] <= $boardSet["replylevel"] && $_SESS["ss_id"] && ( $_SESS["ss_id"] == $Data["id"] ) ) ) ? "<a href='".$PHP_SELF."?tb=".$tb."&act=reply&tNum=".$Data["number"]."'>" : "<a href=\"javascript:alert('고객님은 현재 [".$memberNameArr[$_SESSION["ss_level"]]."] 입니다.\\n\\n[".$memberNameArr[$boardSet["replylevel"]]."] 이상만 답변쓰기가 가능합니다.');\">";
		/* 답변하기 링크 끝   */
		
		/* 목록보기 링크 시작 */
		$view["listlink"] = "<a href='".$PHP_SELF."?tb=".$tb."&act=list&sSearch=".$sSearch."&sKeyword=".$sKeyword."'>";
		/* 목록보기 링크 끝   */

		/* 첨부파일 시작 */
		// 썸네일까지 view단에서 보여주기 때문에 1부터
		//for( $fileCnt = 0; $fileCnt < count( $Data["savefile"] ); $fileCnt++ ) { 
		for( $fileCnt = 2; $fileCnt < count( $Data["savefile"] ); $fileCnt++ ) { 
			if( $Data["savefile"][$fileCnt] ) {
				$Data["filename"] = ( $Data["liefile"][$fileCnt] ) ? $Data["liefile"][$fileCnt] : $Data["savefile"][$fileCnt];
				$saveFileStr = $Data["savefile"][$fileCnt];
				$Data["imgSize"] = @getImageSize($bagData["absoluteDir"].$saveFileStr);
				if( $boardSet["skin"] == 'webzine_type1' ) {
					if( $Data["imgSize"][0] >= $Data["imgSize"][1] ) {
						$Data["imgSize"][0] = ( $Data["imgSize"][0] > 500 ) ? "500" : $Data["imgSize"][0];
						$Data["WidthHeight"] = "width=".$Data["imgSize"][0];
					} else {
						$Data["imgSize"][1] = ( $Data["imgSize"][1] > 225 ) ? "225" : $Data["imgSize"][1];
						$Data["WidthHeight"] = "height=".$Data["imgSize"][1];
					}
					$Data["filename2"] = ( $Data["savefile"][$fileCnt] ) ? $Data["savefile"][$fileCnt] : "<img src='/board/skin/".$boardSet["skin"]."/images/noimg_big.gif' width='338' height='255' name='att_img' id='att_img'>";
				}else if($boardSet["skin"] == 'gallery'){
					$Data["filename2"] = ( $Data["savefile"][$fileCnt] ) ? $Data["savefile"][$fileCnt] : "/board/skin/".$boardSet["skin"]."/images/noimg_big.gif";
				    $Data["WidthHeight"]="width='360'";
				} else {
					$Data["filename2"] = ( $Data["thumfile1"][$fileCnt] ) ? $Data["thumfile1"][$fileCnt] : "/board/skin/".$boardSet["skin"]."/images/noimg_big.gif";
					if($Data["imgSize"][0] > 1100) $Data["WidthHeight"]="width='1100'"; else $Data["WidthHeight"]="";
				}
				// 다운로드 이미지 세팅
				//$Data["downimg"][$fileCnt] = "<a href='/board/download.php?tb=".$tb."&FileName=".$Data["savefile"][$fileCnt]."&wn=".urlencode( $Data["liefile"][$fileCnt] )."'><img src='/board/skin/".$boardSet["skin"]."/images/icon_download.gif' align='absmiddle' border='0'></a>";
				$Data["downimg"][$fileCnt] = "<a href='/board/download.php?tb=".$tb."&FileName=".$Data["savefile"][$fileCnt]."&wn=".urlencode( $Data["liefile"][$fileCnt] )."'>".$Data["filename"]."</a>";
				// 미리보기 이미지 세팅
				$Data["openimg"][$fileCnt] = "<img src='".$bagData["host"].$Data["filename2"]."' ".$Data["WidthHeight"]." name='att_img' id='att_img'>";
			}else{
				$Data["openimg"][$fileCnt] = "";
			}
		}
		/* 첨부파일 끝 */

		/* 다음글 이전금 시작 */
		$perSubQuery = "WHERE tblStrShow='Y' AND tblNumber<$tNum";
		$nextSubQuery = "WHERE tblStrShow='Y' AND tblNumber>$tNum";
		/* 다음글 이전금 끝 */

		/* 검색 시작 */
		/* 서브게시물 보임/안보임 설정 시작 */
		if( $boardSet["sub"] == 'N' ) {
			//$subQuery = ( $subQuery ) ? $subQuery." AND tblStrThread='A'" : "WHERE tblStrThread='A'";
			$perSubQuery .= " AND tblStrThread='A'";
			$nextSubQuery .= " AND tblStrThread='A'";
		}
		/* 서브게시물 보임/안보임 설정 끝   */
		if( trim( $sKeyword ) ) {
			$perSubQuery .= " AND tblStrSubject LIKE '%".$sKeyword."%'";
			$nextSubQuery .= " AND tblStrSubject LIKE '%".$sKeyword."%'";
		}
		/* 검색 끝   */

		/* 정렬 시작 */
		$perOrderBy = "ORDER BY tblIntNotice DESC, tblIntFid DESC, tblStrThread";
		$nextOrderBy = "ORDER BY tblIntNotice DESC, tblIntFid ASC, tblStrThread";
		/* 정렬 끝   */

		$perQuery = "SELECT * FROM tbl_".$tb." ".$perSubQuery." ".$perOrderBy." limit 1";
		$perSql = mysql_query( $perQuery );		
		
		$nextQuery = "SELECT * FROM tbl_".$tb." ".$nextSubQuery." ".$nextOrderBy." limit 1";
		$nextSql = mysql_query( $nextQuery );			
		/* 다음글 이전금 끝 */

		/* 스킨파일 인클루드 */
		$list_file = getListSkinFile($boardSet["skin"]);
		include $list_file;

		/*if( $re_Count > 0 ) {	// 답변이 1개 이상일때 답변 노출
			include "./skin/".$tblSkin."/reply_view.html";
		}*/

		/*if( $tblUserComment ) { // 덧글기능 활성화시 덧글 노출
			include "./skin/".$tblSkin."/comment_view.html";
		}*/
	}

	//////////////////// 답변일때 /////////////////////////////////////////////////////////////////////
	if( $act == 'reply' ) {

		$Query = "SELECT * FROM tbl_$tb WHERE tblNumber='$tNum'";
		$Sql = mysql_query( $Query );		
		$Array = mysql_fetch_array( $Sql );
		$Data["number"]			= $Array["tblNumber"];
		$Data["fid"]			= $Array["tblIntFid"];
		$Data["thread"]			= $Array["tblStrThread"];
		$Data["field"]			= $Array["tblIntField"];
		$Data["id"]				= $Array["tblStrID"];
		$Data["passwd"]			= $Array["tblStrPass"];
		$Data["name"]			= $Array["tblStrName"];
		$Data["subject"]		= stripslashes( $Array["tblStrSubject"] );
		$Data["phone"]			= $Array["tblStrPhone"];
		$Data["mobile"]			= $Array["tblStrMobile"];
		$Data["blnsms"]			= $Array["tblBlnSms"];
		$Data["email"]			= $Array["tblStrEmail"];
		$Data["blnemail"]		= $Array["tblBlnEmail"];
		$Data["homepage"]		= $Array["tblStrHomePage"];
		$Data["notice"]			= $Array["tlStrNotice"];
		$Data["secret"]			= $Array["tblStrSecret"];
		$Data["comment"]		= stripslashes( $Array["tblStrComment"] );
		$Data["savefile"]		= explode( '|', $Array["tblStrSaveFile"] );
		$Data["liefile"]		= explode( '|', $Array["tblStrLieFile"] );
		$Data["thumfile1"]		= explode( '|', $Array["tblStrThum1"] );
		$Data["thumfile2"]		= explode( '|', $Array["tblStrThum2"] );
		$Data["thumfile3"]		= explode( '|', $Array["tblStrThum3"] );
		$Data["thumfile4"]		= explode( '|', $Array["tblStrThum4"] );
		$Data["thumfile5"]		= explode( '|', $Array["tblStrThum5"] );
		$Data["reply"]			= stripslashes( $Array["tblStrReply"] );
		$Data["ref"]			= $Array["tblIntRef"];
		$Data["ip"]				= $Array["tblStrIp"];
		$Data["show"]			= $Array["tblStrShow"];
		$Data["reid"]			= $Array["tblStrReID"];
		$Data["rename"]			= $Array["tblStrReName"];
		$Data["regdate"]		= $Array["tblDtmRegDate"];
		$Data["moddate"]		= $Array["tblDtmModDate"];
		$Data["redate"]			= $Array["tblDtmReDate"];
		$Data["intgp"]			= $Array["tblIntGP"];
		$Data["press"]			= $Array["tblIntPress"];
		$Data["streaming"]		= $Array["tblStrStreaming"];
		$Data["etc"]			= $Array["tblStrEtc"];
		
		if( $_SESS["ss_level"] > 2 && $_SESS["ss_level"] > $boardSet["replylevel"] ) echo "<script language='javascript'>alert('고객님은 현재 [".$memberNameArr[$_SESSION["ss_level"]]."] 입니다.\\n\\n[".$memberNameArr[$boardSet["replylevel"]]."] 이상만 답변쓰기가 가능합니다.'); history.go(-1);</script>";

		if($Data["secret"] == 'Y' && $_SESS["ss_level"] > 2){
			if($_SESS["ss_id"] != $Data["id"] || $_SESS["ss_id"]==''){
				if($bibun != $Data["passwd"] || $bibun==''){
					echo "<script language='javascript'>alert('비밀글입니다.\\n권한이 있는 분만 답변할 수 있습니다.'); history.go(-1);</script>";
					exit;
				}
			}
		}

		/* 자동글등록방지 시작 */
		include $_SERVER['DOCUMENT_ROOT']."/norobot/norobot.inc.php";
		echo "<script language='javascript' src='/norobot/md5.js'></script>";
		/* 자동글등록방지 끝   */
		
		/*답변저장목록 불러옴*/
		//$svQuery = "SELECT * FROM tblReplySave WHERE tblStrTable='".$tb."' AND tblIntField='".$Data["field"]."' ORDER BY tblNumber ASC";
		$svQuery = "SELECT * FROM tblReplySave WHERE tblStrTable='".$tb."' ORDER BY tblNumber ASC";
		$svSql = mysql_query( $svQuery );
		$svTmp = 0;
		while( $svArray = mysql_fetch_array( $svSql ) ) {
			$svData[$svTmp]["number"]		= $svArray["tblNumber"];
			$svData[$svTmp]["field"]		= $svArray["tblIntField"];
			$svData[$svTmp]["subject"]	= $svArray["tblStrSubject"];
			$svData[$svTmp]["comment"]	= $svArray["tblStrComment"];
			$svTmp++;
		}
		/*/답변저장목록 불러옴*/		

		/* 첨부파일 시작 */
		for( $fileCnt = 0; $fileCnt < count( $Data["savefile"] ); $fileCnt++ ) { 
			if( $Data["savefile"][$fileCnt] ) {
				$Data["filename"] = ( $Data["liefile"][$fileCnt] ) ? $Data["liefile"][$fileCnt] : $Data["savefile"][$fileCnt];
				$saveFileStr = $Data["savefile"][$fileCnt];
				$Data["imgSize"] = getImageSize("../_data/$tb/$saveFileStr");
				if( $boardSet["skin"] == 'gallery' ) {
					if( $Data["imgSize"][0] >= $Data["imgSize"][1] ) {
						$Data["imgSize"][0] = ( $Data["imgSize"][0] > 158 ) ? "158" : $Data["imgSize"][0];
						$Data["WidthHeight"] = "width=".$Data["imgSize"][0];
					} else {
						$Data["imgSize"][1] = ( $Data["imgSize"][1] > 119 ) ? "119" : $Data["imgSize"][1];
						$Data["WidthHeight"] = "height=".$Data["imgSize"][1];
					}
					$Data["filename2"] = $Data["savefile"][$fileCnt];
				} else {
					$Data["filename2"] = ( $Data["thumfile5"][$fileCnt] ) ? $Data["thumfile5"][$fileCnt] : "/board/skin/".$boardSet["skin"]."/images/noimg_small.gif";
					$Data["WidthHeight"] = "";
				}
				// 다운로드 이미지 세팅
				//$Data["downimg"][$fileCnt] = "<a href='/board/download.php?tb=".$tb."&FileName=".$Data["savefile"][$fileCnt]."&wn=".urlencode( $Data["liefile"][$fileCnt] )."'><img src='/board/skin/".$boardSet["skin"]."/images/icon_download.gif' align='absmiddle' border='0'></a>";
				$Data["downimg"][$fileCnt] = "<a href='/board/download.php?tb=".$tb."&FileName=".$Data["savefile"][$fileCnt]."&wn=".urlencode( $Data["liefile"][$fileCnt] )."'>".$Data["filename"]."</a>";
				// 미리보기 이미지 세팅
				$Data["openimg"][$fileCnt] = "<img src='".$Data["filename2"]."' ".$Data["WidthHeight"].">";
			}
		}
		/* 첨부파일 끝 */

		/* 스킨파일 인클루드 */
		include $_SERVER['DOCUMENT_ROOT']."/board/skin/".$boardSet["skin"]."/reply.php";
	}

	//////////////////// 답변일때 /////////////////////////////////////////////////////////////////////
	if( $act == 'reply_ok' ) {

		/* if( $_SESS["ss_level"] > 2 && $_SESS["ss_level"] > $boardSet["replylevel"] ) echo "<script language='javascript'>alert('답변쓰기 권한이 없습니다.'); history.go(-1);</script>"; */

		/* 자동글등록방지 체크 시작 */
		if( $boardSet["skin"] != 'call'){
			include $_SERVER['DOCUMENT_ROOT']."/norobot/norobot_check.inc.php";
		}
		/* 자동글등록방지 체크 끝   */
		
		$Data["reply"]	= addslashes( $strReply );
		$Data["rename"]	= trim( $strReName );
		$Data["ip"]			= $HTTP_SERVER_VARS[REMOTE_ADDR];

		/* 기존 데이타 답변 업데이트 시자 */
		$rQue = "UPDATE tbl_".$tb." SET ";
		$rQue .= "tblStrReply='".$Data["reply"]."',";
		$rQue .= "tblStrReID='".$_SESS["ss_id"]."',";
		$rQue .= "tblStrReName='".$_SESS["ss_name"]."',";
		$rQue .= "tblDtmReDate=now() WHERE tblNumber='".$tNum."'";
		$rSql = mysql_query( $rQue ) or die( mysql_error() );
		/* 기존 데이타 답변 업데이트 끝   */

		/* 서브표시용 글 복사 시작 */			
		/*$Query = "SELECT * FROM tbl_".$tb." WHERE tblIntFid='".$intFid."' AND tblStrThread='".$strThread."' AND tblNumber='".$tNum."'";
		$Sql = mysql_query( $Query );
		$Array = mysql_fetch_array( $Sql );
		$Data["id"]					= $Array["tblStrID"];
		$Data["name"]				= $Array["tblStrName"];
		$Data["subject"]		= "[RE]".$Array["tblStrSubject"];
		$Data["phone"]			=	$Array["tblStrPhone"];
		$Data["mobile"]			=	$Array["tblStrMobile"];
		$Data["blnsms"]			=	$Array["tblBlnSms"];
		$Data["email"]			=	$Array["tblStrEmail"];
		$Data["blnemail"]		=	$Array["tblBlnEmail"];
		$Data["homepage"]		=	$Array["tblStrHomePage"];
		$Data["notice"]			=	$Array["tblIntNotice"];
		$Data["secret"]			=	$Array["tblStrSecret"];
		$Data["comment"]		=	$Array["tblStrComment"];
		$Data["savefile"]		=	$Array["tblStrSaveFile"];
		$Data["liefile"]		=	$Array["tblStrLieFile"];
		$Data["thumfile1"]	=	$Array["tblStrThum1"];
		$Data["thumfile2"]	=	$Array["tblStrThum2"];
		$Data["thumfile3"]	=	$Array["tblStrThum3"];
		$Data["thumfile4"]	=	$Array["tblStrThum4"];
		$Data["thumfile5"]	=	$Array["tblStrThum5"];
		$Data["regdate"]		=	$Array["tblDtmRegDate"];
		$Data["moddate"]		=	$Array["tblDtmModDate"];
		$Data["intgp"]			=	$Array["tblIntGP"];
		$Data["press"]			= $Array["tblIntPress"];
		$Data["streaming"]	= $Array["tblStrStreaming"];
		$Data["etc"]				= $Array["tblStrEtc"];

		$tqry = "SELECT tblStrThread FROM tbl_".$tb." WHERE tblIntFid='".$intFid."' AND length(tblStrThread)=length('".$strThread."')+1 AND locate('".$strThread."',tblStrThread)=1 ORDER BY tblStrThread DESC LIMIT 1";
		$tresult = mysql_query( $tqry );
		$trow = mysql_fetch_row( $tresult );
		if( $trow ) {
			$thread1 = substr($trow[0],0,-1);
			$thread2 = substr($trow[0],-1);
			$thread2 = ++$thread2;
			$Data["thread"] = $thread1.$thread2;
		} else { 
			$Data["thread"] = $strThread.'A';
		}

		$iQue = "INSERT INTO tbl_".$tb." SET ";
		$iQue .= "tblIntFid='".$intFid."',";
		$iQue .= "tblStrThread='".$Data["thread"]."',";
		$iQue .= "tblIntField='".$intField."',";
		if( $boardSet["sub"] == 'Y' ) {
			$iQue .= "tblStrID='".$_SESS["ss_id"]."',";
			$iQue .= "tblStrName='".$SESS["ss_name"]."',";
		} else {
			$iQue .= "tblStrID='".$Data["id"]."',";
			$iQue .= "tblStrName='".$Data["name"]."',";
		}
		$iQue .= "tblStrSubject='".$Data["subject"]."',";
		$iQue .= "tblStrPhone='".$Data["phone"]."',";
		$iQue .= "tblStrMobile='".$Data["mobile"]."',";
		$iQue .= "tblBlnSms='".$Data["blnsms"]."',";
		$iQue .= "tblStrEmail='".$Data["email"]."',";
		$iQue .= "tblBlnEmail='".$Data["blnemail"]."',";
		$iQue .= "tblStrHomePage='".$Data["homepage"]."',";
		$iQue .= "tblIntNotice='".$Data["notice"]."',";
		$iQue .= "tblStrSecret='".$Data["secret"]."',";
		$iQue .= "tblStrComment='".$Data["comment"]."',";
		$iQue .= "tblStrSaveFile='".$Data["savefile"]."',";
		$iQue .= "tblStrLieFile='".$Data["liefile"]."',";
		$iQue .= "tblStrThum1='".$Data["thumfile1"]."',";
		$iQue .= "tblStrThum2='".$Data["thumfile2"]."',";
		$iQue .= "tblStrThum3='".$Data["thumfile3"]."',";
		$iQue .= "tblStrThum4='".$Data["thumfile4"]."',";
		$iQue .= "tblStrThum5='".$Data["thumfile5"]."',";
		$iQue .= "tblStrReply='".$Data["reply"]."',";
		$iQue .= "tblIntRef='0',";
		$iQue .= "tblStrIp='".$Data["ip"]."',";
		$iQue .= "tblStrShow='Y',";
		$iQue .= "tblStrReID='".$_SESS["ss_id"]."',";
		$iQue .= "tblStrReName='".$_SESS["ss_name"]."',";
		$iQue .= "tblIntGP='".$Data["intgp"]."',";
		$iQue .= "tblIntPress='".$Data["press"]."',";
		$iQue .= "tblStrStreaming='".$Data["streaming"]."',";
		$iQue .= "tblStrEtc='".$Data["etc"]."',";
		$iQue .= "tblDtmRegDate='".$Data["regdate"]."',";
		$iQue .= "tblDtmModDate='".$Data["moddate"]."',";
		$iQue .= "tblDtmReDate=now();";
		$iSql = mysql_query($iQue) or die(mysql_error());*/
		/* 서브표시용 글 복사 끝   */

		/*답변저장*/
		if( $_POST["blnSave"] == 'Y' && $_POST["saveSubject"] && $Data["reply"] ) {
			$sQuery = "INSERT INTO tblReplySave SET ";
			$sQuery .= "tblStrTable='".$tb."',";
			$sQuery .= "tblIntField='".$intField."',";
			$sQuery .= "tblStrSubject='".$_POST["saveSubject"]."',";
			$sQuery .= "tblStrComment='".$Data["reply"]."'";
			$sSql = mysql_query( $sQuery ) or die( mysql_error() );
		}
		/*/답변저장*/

		/* 메일발송 */
		if( $Data["blnemail"] == 'Y' ) {
			$homeUrl = "http://".$bagData["host"];
			$fromname = $bagData["siteName"];
			$fromname='=?UTF-8?B?'.base64_encode($fromname).'?=';
			$fromaddress = $admData["email"];
			$server_mail = $admData["email"];
			$headers = "From: ".$fromname." < ".$fromaddress." > \n"; 
			$headers .= "X-Sender: < ".$server_mail." >\n"; 
			$headers .= "X-Mailer: PHP\n"; 
			$headers .= "Return-Path: < ".$fromaddress." >\n";  
			$headers .= "Content-Type: text/html; charset=utf-8\n"; 
			$headers .= "\n"; 
			/*$fp = fopen($_SERVER['DOCUMENT_ROOT']."/mail/mail_join.html","r");
			$m_content = fread($fp,"100000");
			fclose($fp);*/
			$m_contents = sock_url( $bagData["host"], "80", "http://".$bagData["host"]."/mail/letter_answer.html");
			$m_contents = str_replace("@HOMEURL@",$homeUrl,$m_contents);
			$m_contents = str_replace("@NAME@",$Data["name"],$m_contents);
			$m_contents = str_replace("@SUBJECT@",$Data["subject"],$m_contents);
			$m_contents = str_replace("@COMMENT@",stripslashes( $Data["comment"] ),$m_contents);
			$m_contents = str_replace("@RENAME@",$_SESSION["ss_name"],$m_contents);
			$m_contents = str_replace("@REPLY@",$Data["reply"],$m_contents);

			$m_contents = str_replace("@ETC1@"," 회원님의 상담내역 입니다.",$m_contents);
			$m_contents = str_replace("@ETC2@","의 답변입니다.",$m_contents);

			$m_contents_arr = explode("\r\n\r\n",$m_contents);
			$this_real="";
			if(substr($m_contents_arr[0],0,8)=="<!DOCTYP"){
				$this_real=$m_contents_arr[0];
			}else if(substr($m_contents_arr[1],0,8)=="<!DOCTYP"){
				$this_real=$m_contents_arr[1];
			}else if(substr($m_contents_arr[2],0,8)=="<!DOCTYP"){
				$this_real=$m_contents_arr[2];
			}else if(substr($m_contents_arr[3],0,8)=="<!DOCTYP"){
				$this_real=$m_contents_arr[3];
			}
			$m_contents = $this_real;

			$title = stripslashes( $Data["subject"] );
			$title='=?UTF-8?B?'.base64_encode($title).'?=';
			$res = mail($Data["email"],$title,$m_contents,$headers);
		}
		/* 메일발송 끝 */
		/*상담 스킨일때는 고객에게 sms 전송*/
		//if( $boardSet["skin"] == 'counsel' ) {
			/******************** 인증정보 ********************/
			/*$sms_id = $bagData["smsid"]; //SMS 아이디.
			$sms_pw = $bagData["smspass"];//SMS 패스워드
			if( $aSmsData[4]["use"] == 'Y' && trim( $aSmsData[4]["comment"] ) ) {
				$content = str_replace( "@NAME@", $Data["name"], trim( $aSmsData[4]["comment"] ) );
				$sms_msg = $content;
			} else {
				$sms_msg = $Data["name"]."님의 상담글에 답변이 등록되었습니다. [".$bagData["siteName"]."]";
			}
			$sms_from = $admData["phone"];
			$sms_to		= $Data["mobile"];
			$sms_ip		= $HTTP_SERVER_VARS["REMOTE_ADDR"];
			
			$sms = new EmmaSMS();
			$sms->login($sms_id, $sms_pw);	// $sms->login( [고객 ID], [고객 패스워드]);
			$ret = $sms->send($sms_to, $sms_from, $sms_msg, $sms_date);
			
			if($ret) {
				//print_r($ret);				

				$smvQuery = "INSERT INTO tblSmsLogs SET ";
				$smvQuery .= "tblStrSender='".$sms_from."',";
				$smvQuery .= "tblStrAddressee='".$sms_to."',";
				$smvQuery .= "tblStrComment='".$sms_msg."',";
				$smvQuery .= "tblStrIp='".$sms_ip."',";
				$smvQuery .= "tblStrStatus='Y',";
				$smvQuery .= "tblDtmRegDate=now()";
				$smvSql = mysql_query( $smvQuery ) or die( mysql_error() );

				echo "<script language='javascript'>";
				echo "	location.href='$PHP_SELF?tb=$tb&act=list';";
				echo "</script>";
			} else {									

				$smvQuery = "INSERT INTO tblSmsLogs SET ";
				$smvQuery .= "tblStrSender='".$sms_from."',";
				$smvQuery .= "tblStrAddressee='".$sms_to."',";
				$smvQuery .= "tblStrComment='".$sms_msg."',";
				$smvQuery .= "tblStrIp='".$sms_ip."',";
				$smvQuery .= "tblStrStatus='N',";
				$smvQuery .= "tblDtmRegDate=now()";
				$smvSql = mysql_query( $smvQuery ) or die( mysql_error() );

				echo $sms->errMsg;
			}
		} else {*/
			echo "<script language='javascript'>";
			echo "	location.href='$PHP_SELF?tb=$tb&act=list';";
			echo "</script>";
		//}
	}

	//////////////////// 삭제일때 /////////////////////////////////////////////////////////////////////
	if( $act == 'delete' ) {
		if( !$tNum ) echo "<script language='javascript'>alert('게시물 번호가 필요합니다.'); history.go(-1);</script>";

		$Que = "SELECT * FROM tbl_".$tb." WHERE tblNumber='".$tNum."'";
		$Sql = mysql_query( $Que );
		$result = mysql_fetch_array( $Sql );
		$Data["id"]		= $result["tblStrID"];
		$Data["secret"]	= $result["tblStrSecret"];
		$Data["passwd"]	= $result["tblStrPass"];
		$Data["thread"]	= $result["tblStrThread"];
		
		// 내용에 있는 이미지 삭제(pc용 절대 경로)
		$src = imgTag($result["tblStrComment"]);
		if (is_array($src)) {
			foreach($src as $k => $v) {
				@unlink( $bagData["absoluteDir"].str_replace("\\","",$v) );
			}
		}

		if( $_SESS["ss_level"] > 2 && $_SESS["ss_level"] > $boardSet["deletelevel"] && ( !$_SESS["ss_id"] || $_SESS["ss_id"] != $Data["id"] ) && ($bibun != $Data["passwd"] || $bibun=='') ) 
			echo "<script language='javascript'>alert('고객님은 현재 [".$memberNameArr[$_SESSION["ss_level"]]."] 입니다.\\n\\n[".$memberNameArr[$boardSet["deletelevel"]]."] 이상만 삭제가 가능합니다.'); history.go(-1);</script>";

		if($Data["secret"] == 'Y' && $_SESS["ss_level"] > 2){
			if($_SESS["ss_id"] != $Data["id"] || $_SESS["ss_id"]==''){
				if($bibun != $Data["passwd"] || $bibun==''){
					echo "<script language='javascript'>alert('비밀글입니다.\\n글을 입력하신분과 관리자만 삭제할 수 있습니다.'); history.go(-1);</script>";
					exit;
				}
			}
		}		

		if( $Data["thread"]		== 'A' ) {
			$Data["savefile"]	= explode( '|', $result["tblStrSaveFile"] );
			$Data["thumfile1"]	= explode( '|', $result["tblStrThum1"] );
			$Data["thumfile2"]	= explode( '|', $result["tblStrThum2"] );
			$Data["thumfile3"]	= explode( '|', $result["tblStrThum3"] );
			$Data["thumfile4"]	= explode( '|', $result["tblStrThum4"] );
			$Data["thumfile5"]	= explode( '|', $result["tblStrThum5"] );

			for( $i = 0; $i < count( $Data["savefile"] ); $i++ ) {
				if( $Data["savefile"][$i] ){
					@unlink( $bagData["absoluteDir"].$Data["savefile"][$i] );
					@unlink( $bagData["absoluteDir"].$Data["thumfile1"][$i] );
					@unlink( $bagData["absoluteDir"].$Data["thumfile2"][$i] );
					@unlink( $bagData["absoluteDir"].$Data["thumfile3"][$i] );
					@unlink( $bagData["absoluteDir"].$Data["thumfile4"][$i] );
					@unlink( $bagData["absoluteDir"].$Data["thumfile5"][$i] );
				}
			}
		}

		$dQue = "DELETE FROM tbl_".$tb." WHERE tblNumber='".$tNum."'";
		$dSql = mysql_query($dQue) or die(mysql_error());

		echo "<script language='javascript'>";
		echo "	location.href='$PHP_SELF?tb=$tb&act=list';";
		echo "</script>";
		exit;
	}

	//////////////////// 비번일때 /////////////////////////////////////////////////////////////////////
	if( $act == "passwd" ) {
		/*
		if( !$_POST["tNum"] )
		{
			echo "<script>";
			echo "	alert('올바른 경로가 아닙니다.');";
			echo "	history.go(-1);";
			echo "</script>";
			exit;
		}
		*/
		$mji = $act_after;		// 검증후
		$kdj = $tNum;			// $tnum
		$nmh = $PHP_SELF."?tb=".$tb."&sField=".$sField."&sSearch=".$sSearch."&sField2=".$sField2."&sKeyword=".$sKeyword."&sGP=".$sGP."&sSecret=".$sSecret."&tNum=".$tNum."&act=".$act_after;

		include $_SERVER['DOCUMENT_ROOT']."/board/password.php";
	}
	
	if( $act == 'passChk' ) { 

		$Sql = mysql_query("SELECT * FROM tbl_".$tb." WHERE tblNumber='".$tNum."'");
		$chk = mysql_fetch_array($Sql);

		if (strlen($chk['tblStrPass']) > 20) {		// 마이그레이션 데이터 일경우
			$pass = md5($strPass);
			
			$Que = "SELECT * FROM tbl_".$tb." WHERE tblNumber='".$tNum."' AND tblStrPass='".$pass."'";
		} else {
			$Que = "SELECT * FROM tbl_".$tb." WHERE tblNumber='".$tNum."' AND tblStrPass='".$strPass."'";
		}
		$Sql = mysql_query($Que);
		$arr = mysql_fetch_array($Sql);
			if( $arr["tblStrPass"] ) { 
				echo "<form name='f1orm' method='post' action='".$gogos."'>\n";
				echo "<input type='hidden' name='strPass' value='".$strPass."'>\n";
				echo "</form>";
				echo "<script language='javascript'>";
				echo "document.f1orm.submit();";
				echo "</script>";
				exit;
			}	else { 
				echo "<script language='javascript'>";
				echo "	alert('비밀번호가 일치하지 않습니다.');";
				echo "	history.go(-2);";
				echo "</script>";
				exit;
			}
	}
	//////////////////// 비번일때 /////////////////////////////////////////////////////////////////////
	
	//////////////////// 덧글일때 /////////////////////////////////////////////////////////////////////
	if( $mode == "com_ok" ) {

			//$comComment =str_replace("\n",'',$comComment);
			//$comComment =str_replace("\r",'',$comComment);
			//$comComment =str_replace("'",'"',$comComment);

			$comComment = addslashes($comComment);

			$strIp = $HTTP_SERVER_VARS[REMOTE_ADDR];

			include $_SERVER['DOCUMENT_ROOT']."/include/fileupload2.php";

			$iQue = "insert into tblBoardComment set ";
			$iQue .= "tblStrBtable='$tb',";
			$iQue .= "tblIntCode='$tNum2',";
			$iQue .= "tblStrUser='$board_mem_level',";
			$iQue .= "tblStrID='$strID',";
			$iQue .= "tblStrName='$comName',";
			$iQue .= "tblStrPass='$comPass',";
			//$iQue .= "tblStrSecret='',";
			$iQue .= "tblIntAppraisal='',";
			$iQue .= "tblStrComment='$comComment',";
			$iQue .= "tblStrSaveFile='$strCommentFile_Arr',";
			$iQue .= "tblStrLieFile='$strCommentLieName_Arr',";
			$iQue .= "tblDtmRegDate=now(),";
			$iQue .= "tblStrIp='$strIp',";
			$iQue .= "tblIntSame='0',";
			$iQue .= "tblIntReport='0'";

			$iSql = mysql_query($iQue) or die(mysql_error());
			echo "<script language='javascript'>";
			echo "	location.href='$PHP_SELF?tb=$tb&mode=view&tNum=$tNum';";
			echo "</script>";
			exit;

	}

	unset( $boardSess );
	include $_SERVER['DOCUMENT_ROOT']."/board/inc/".$boardSet["foot"];
	///////////////////////////////////////////////////////////////////////////////////////////////////
?>
<script id="dynamic"></script>
<script language="JavaScript">
	function loadData(tbl,tNum,tNum2,act) {
		dynamic.src = "/board/ChanmArea.php?tb=" + tbl + "&tNum=" + tNum + "&tNum2=" + tNum2 + "&act=" + act;
	}
	/* 첨부파일 삭제 */
	function fnDel(tbl,tNum,dNum) {
		dynamic.src = "/board/fileDel.php?tb=" + tbl + "&tNum=" + tNum + "&dNum=" + dNum;
	}
	/* 첨부파일 삭제*/
</script>
<form name="locateFrm" method="post" action="">
<input type="hidden" name="gogos" value="">
<input type="hidden" name="tNum" value="">
<input type="hidden" name="act" value="">
</form>
<script language='javascript'>
	function passwdChk(num,act) {
		if( act == 'view' ) {
			document.locateFrm.gogos.value = "<? echo $PHP_SELF; ?>?act=view&tNum=" + num;
		} else if( act == 'delete' ) {
			document.locateFrm.gogos.value = "<? echo $PHP_SELF; ?>?act=delete&tNum=" + num;
		} else if( act == 'modify' ) {
			document.locateFrm.gogos.value = "<? echo $PHP_SELF; ?>?act=modify&tNum=" + num;
		} else if( act == 'reply' ) {
			document.locateFrm.gogos.value = "<? echo $PHP_SELF; ?>?act=reply&tNum=" + num;
		} else {
			alert('경로가 잘못되었습니다.');
			return;
		}
		document.locateFrm.tNum.value = num;
		document.locateFrm.act.value = "passwd";
		///window.open('about:blank','pp','width=690 height=240 top:300 left:400');
		//document.locateFrm.action = '/board/skin/<? echo $boardSet["skin"]; ?>/password.php';
		document.locateFrm.action = '<? echo $PHP_SELF; ?>';
		//document.locateFrm.target = 'pp';
		document.locateFrm.submit();
	}

	function mem_login(){
		alert('<?=$bagData["siteName"]?>는 의료법을 준수합니다.\n\n본 페이지는 로그인한 회원에게만 제공되는 페이지입니다.');
	 	$("#example0_linker").click();
		location.href = "<?=$bagData["mdir"];?>/member/login.php?ref=<?=$PHP_SELF;?>";

	}

	function pwd_layer(oo,aa){
		document.getElementById('mji').value=oo;
		document.getElementById('kdj').value=aa;
		document.getElementById('nmh').value="<?=$PHP_SELF?>?tb=<?=$tb?>&sField=<?=$sField?>&sSearch=<?=$sSearch?>&sField2=<?=$sField2?>&sKeyword=<?=$sKeyword?>&sGP=<?=$sGP?>&sSecret=<?=$sSecret?>&tNum="+aa+"&act="+oo;
	}
</script>