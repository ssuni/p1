<?		if( $_SESS["ss_level"] > $boardSet["listlevel"] ) 
			echo "<script language='javascript'>alert('".$boardSet["bname"]."의 목록보기 권한이 없습니다.'); history.go(-1);</script>";

		/* 검색 시작 */
		$subQuery = "WHERE tblStrShow='Y'";
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
			$subQuery .= " AND tblIntField='".$sField."'";
		}

		if( $sGP ) {
			$subQuery .= " AND tblIntGP='".$sGP."'";
		}

		if( $sSecret != '' ) {
			$subQuery .= " AND tblStrSecret='".$sSecret."'";
		}

		/* 서브게시물 보임/안보임 설정 끝   */
		if( trim( $sKeyword ) ) {
			$subQuery .= " AND tblStrSubject LIKE '%".$sKeyword."%'";
		}

		/* 추가 검색   */
		if( $gubun <> '' ) {
			$subQuery .= " AND tblIntField = '".$gubun."'";
		}

		/* 검색 끝   */

		/* 정렬 시작 */
		$OrderBy = "ORDER BY tblIntNotice DESC, tblDtmRegDate desc, tblIntFid DESC, tblStrThread";
		/* 정렬 끝   */

		/* 페이지 설정 시작 */
		$p = ( !$p ) ? "1" : $p;
		$boardSet["linenumber"] = ( $boardSet["linenumber"] ) ? $boardSet["linenumber"] : "10";
		$startnum = ( $p - 1 ) * $boardSet["linenumber"];
		$countQuery = mysql_query( "SELECT tblNumber FROM tbl_".$tb." ".$subQuery );
		$count_arr = mysql_num_rows( $countQuery );
		$data_num = $count_arr;
		$viewCount = $data_num - $startnum;
		@$total_page = intval( ( $data_num - 1 ) / $boardSet["linenumber"] )+1;
		/* 페이지 설정 끝   */

		$Query = "SELECT * FROM tbl_".$tb." ".$subQuery." ".$OrderBy." limit ".$startnum.", ".$boardSet["linenumber"];
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
			$Data[$lTmp]["comment"]		= mb_strimwidth( preg_match("/<[^>]*>/", "", stripslashes( $Array["tblStrComment"] ) ), 0, 80, "...", "utf-8" );
			if( $boardSet["skin"] == 'bna'){
				$Data[$lTmp]["comment"]		= mb_strimwidth( preg_match("/<[^>]*>/", "", stripslashes( $Array["tblStrComment"] ) ), 0, 44, "...", "utf-8" );
			}
			$Data[$lTmp]["savefile"]	= explode( '|', $Array["tblStrSaveFile"] );
			$Data[$lTmp]["liefile"]		= explode( '|', $Array["tblStrLieFile"] );
			$Data[$lTmp]["thumfile1"]	= explode( '|', $Array["tblStrThum1"] );
			$Data[$lTmp]["thumfile2"]	= explode( '|', $Array["tblStrThum2"] );
			$Data[$lTmp]["thumfile3"]	= explode( '|', $Array["tblStrThum3"] );
			$Data[$lTmp]["thumfile4"]	= explode( '|', $Array["tblStrThum4"] );
			$Data[$lTmp]["thumfile5"]	= explode( '|', $Array["tblStrThum5"] );

			// 첨부화일에 이미지 없으면 내용에서 첫번째 이미지 불러오기
			if (!$Data[$lTmp]["savefile"][0]) {
				$src = imgTag($Array["tblStrComment"]);
				$Data[$lTmp]["savefile"][0] = str_replace("\\","",$src[0]);
			}	

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

			$Data[$lTmp]["period"]		= $Array["tblPeriod"];
			$Data[$lTmp]["comment2"]	= mb_strimwidth( preg_match("/<[^>]*>/", "", stripslashes( $Array["tblStrComment2"] ) ), 0, 220, "...", "utf-8" );
			$Data[$lTmp]["etc"]			= $Array["tblStrEtc"];

			$Data[$lTmp]["start_date"]	= $Array["start_date"];
			$Data[$lTmp]["end_date"]	= $Array["end_date"];

			$Data[$lTmp]["viewlink"] = ( $_SESS["ss_level"] <= 2 || ( $Data[$lTmp]["secret"] == 'N' && $_SESS["ss_level"] <= $boardSet["viewlevel"] ) || ( $_SESS["ss_name"] && $_SESS["ss_id"] == $Data[$lTmp]["id"] ) ) ? "<a href='".$_SERVER['PHP_SELF']."?tb=".$tb."&act=view&tNum=".$Data[$lTmp]["number"]."&sField=$sField&p=".$p."'>" : "<span class='popupsP'><a href=\"#passwordBox\" id='pass_linker' onclick=\"javascript:pwd_layer('view','".$Data[$lTmp]["number"]."');\">";

			// 게시판의 의료법 적용으로 로그인시 보이게 할때
			if(($tb=='board074' || $tb=='board061') && ($_SESS["ss_id"]=='' || !$_SESS["ss_id"])){
				 $Data[$lTmp]["viewlink"]="<a href='javascript:mem_login();'>";
			}


			$Data[$lTmp]["icon_logo"]	= ( ( $Data[$lTmp]["thread"] == 'A' && $Data[$lTmp]["id"] == 'admin') || ( $Data[$lTmp]["thread"] != 'A' && $Data[$lTmp]["id"] == 'admin' ) ) ? "<img src='/board/images/name_logo.gif' align='absmiddle'>" : "";

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

			/* 비밀글 시작 */
			$Data[$lTmp]["keyimg"]	= ( $Data[$lTmp]["secret"] == 'Y' ) ? "<img src='/board/skin/".$boardSet["skin"]."/images/icon_lock.gif' align='absmiddle' alt='비밀글'>&nbsp;" : "";
			/* 비밀글 끝 */

			$viewCount--;
			$lTmp++;	
		}	?>