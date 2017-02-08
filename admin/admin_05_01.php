<? include "inc/head.php" ?>
<?
$sub_menu = '500100';
auth_check($auth[$sub_menu]);

$pageNum = 5;
$subNum = 1;
?>
<body class="commonBg">
<div id="bodyWrap">
	<? include "inc/top.php" ?>
	<div id="contentsWrap">
		<div class="leftArea">
			<? include "inc/left.php" ?>
		</div>
		<div class="rightArea">
			<div id="locationBar">
				<h2><?=$sub_tit2_1?></h2>
				<p class="location">HOME > <?=$sub_tit?> > <strong><?=$sub_tit2_1?></strong></p>
			</div>
			<div class="contentsArea"><!---width:740px--->
				<!--- start : 본문 --->
<?	
			///////////////////////////////// 코멘트 테이블 생성
			if( ( $act == 'add_ok' || $act == 'mod_ok' ) && $intCommentLevel > 0 ) {
				$eque = "SELECT * FROM tbl_".$strBtable."_comment";
				if( !mysql_query( $eque ) ) {
					$cque = "CREATE TABLE tbl_".$strBtable."_comment (";
					$cque .= "tblNumber int(11) unsigned not null auto_increment,";
					$cque .= "tblParent int(11) unsigned not null,";
					$cque .= "tblStrID varchar(20),";
					$cque .= "tblStrName varchar(30),";
					$cque .= "tblStrPass varchar(30),";
					$cque .= "tblStrComment text not null,";
					$cque .= "tblDtmRegDate datetime,";
					$cque .= "tblStrIp varchar(20),";
					$cque .= "tblIntRef int(11),";
					$cque .= "primary key (tblNumber)";
					$cque .= ")";

					$result = mysql_query( $cque ) or die( mysql_error() );
				}
			}


			///////////////////////////////////게시판 생성
			if ( !$act || $act == "add" ) {
				$sql = "select * from tblBoardManager order by tblGroup asc, tblBname asc";
				$result = mysql_query($sql);

				include ("./html/board_add.html");
			}
			
			if ( $act == "add_ok" ) {

				//테이블이름 중복 체크
				$sql = "select count(*) from tblBoardManager where tblBtable='$strBtable'";
				$result3 = mysql_query($sql);
				$tb_check = mysql_fetch_array($result3);
				if($tb_check[0]>0) {
					echo "<script language='javascript'>";
					echo "	alert('이미 등록되어 있는 테이블입니다.');";
					echo "	history.go(-1);";
					echo "</script>";
					exit;
				}

				//이미 존재하는 테이블인가?
				$result3 = mysql_list_tables($db_name);
				while( $ex_table = mysql_fetch_row($result3) )
				{
					if ($ex_table[0] == "tbl".$strBtable ) {
						echo "<script language='javascript'>";
						echo "	alert('이미 사용하는 있는 테이블입니다.');";
						echo "	history.go(-1);";
						echo "</script>";
					}
				}

				$sql = "insert into tblBoardManager set ";
				$sql .= "tblBname='$strBname',";											// 테이블명
				$sql .= "tblBtable='$strBtable',";										// 테이블이름
				$sql .= "tblSkin='$strSkin',";												// 사용스킨
				$sql .= "tblCategory='$strCategory',";								// 카테고리	
				$sql .= "tblUser='$intUser',";												// 사용자
				$sql .= "tblListLevel='$intListLevel',";							// 목록보기등급
				$sql .= "tblViewLevel='$intViewLevel',";							// 읽기등급
				$sql .= "tblWriteLevel='$intWriteLevel',";						// 쓰기등급
				$sql .= "tblModifyLevel='$intModifyLevel',";					// 수정등급
				$sql .= "tblReplyLevel='$intReplyLevel',";						// 답변등급
				$sql .= "tblDeleteLevel='$intDeleteLevel',";					// 삭제등급
				$sql .= "tblHead='$strHead',";												// 상단파일	
				$sql .= "tblFoot='$strFoot',";												// 하단파일
				$sql .= "tblSub='$strSub',";													// 서브노출
				$sql .= "tblSecret='$strSecret',";										// 비밀글성정
				$sql .= "tblHomePage='$strHomePage',";								// 홈페이지 설정
				$sql .= "tblLineNumber='$intLineNumber',";						// 페이지당 목록수
				$sql .= "tblPageNumber='$intPageNumber',";						// 페이징수	
				$sql .= "tblmLineNumber='$intmLineNumber',";						// 페이지당 목록수(모바일)
				$sql .= "tblmPageNumber='$intmPageNumber',";						// 페이징수	(모바일)
				$sql .= "tblViewImage='$strViewImage',";							// 이미지 출력유무
				$sql .= "tblAddfileNumber='$intAddFileNumber',";			// 첨부파일수
				$sql .= "tblUploadSize='$intUploadSize',";						// 첨부파일용량
				$sql .= "tblNoExt='$strNoExt',";											// 업로드불가 확장자
				$sql .= "tblNotice='$strNotice',";										// 공지설정
				$sql .= "tblUserComment='$intUserComment',";					// 덧글사용자
				$sql .= "tblCommentLevel='$intCommentLevel',";				// 덧글쓰기등급
				$sql .= "tblViewType='$intViewType',";								// 뷰하단 타입
				$sql .= "tblPoint='$strPoint',";											// 포인트 설정
				$sql .= "tblChoice='$strChoice',";										// 채택 설정
				$sql .= "tblProfileView='$strProfileView',";					// 프로필 노출 설정
				$sql .= "tblAppraisal='$strAppraisal',";							// 평가 설정
				$sql .= "tblScrap='$strScrap',";											// 스크랩 설정
				$sql .= "tblPrint='$strPrint',";											// 프린트 설정	
				$sql .= "tblControl='$strControl',";									// 출력옵션
				$sql .= "tblNickname='$strNickname',";								// 닉네임 설정 ( 설정지 회원가입시 입력 이름대신 닉네임 노출 )
				$sql .= "tblFilter='$strFilter',";										// 필터 설정
				$sql .= "tblGroup='$strGroup',";											// 그룹설정 ( 관리자에서 보기위한 그룹 )
				$sql .= "tblWidth='$strWidth',";											// 테이블 크기
				$sql .= "tblStreaming='$strStreaming',";								// 스트리밍 사용유무
				$sql .= "tblWatermark='$strWatermark'";								// 워터마크 사용유무
				$result = mysql_query($sql) or die(mysql_error());

				$sql2 ="CREATE TABLE tbl_$strBtable (";
				$sql2 .= "tblNumber int(11) unsigned NOT NULL auto_increment primary key,";
				$sql2 .= "tblIntFid int(11),";							// 서브넘버
				$sql2 .= "tblStrThread varchar(50),";				// 서브연결
				$sql2 .= "tblIntField varchar(30),";						// 카테고리
				//$sql2 .= "tblStrUser int(11),";						// 사용자
				$sql2 .= "tblStrID varchar(30),";						// 아이디
				$sql2 .= "tblStrPass varchar(100),";				// 비밀번호
				$sql2 .= "tblStrName varchar(30),";					// 작성자
				$sql2 .= "tblStrSubject varchar(200),";			// 제목
				$sql2 .= "tblStrPhone varchar(20),";				// 연락처
				$sql2 .= "tblStrMobile varchar(20),";				// 휴대전화
				$sql2 .= "tblBlnSms enum('Y','N') not null default 'N',";				// SMS 수신
				$sql2 .= "tblStrEmail varchar(100),";				// E-mail
				$sql2 .= "tblBlnEmail enum('Y','N') not null default 'N',";			// E-mail 수신
				$sql2 .= "tblStrHomePage varchar(255),";		// 홈페이지
				$sql2 .= "tblIntNotice int(1) not null default '0',";						// 공지
				$sql2 .= "tblStrSecret enum('Y','N') not null default 'N',";			// 비밀글
				$sql2 .= "tblStrComment text,";							// 내용	
				$sql2 .= "tblStrSaveFile text,";						// 원본파일(변경된이름)
				$sql2 .= "tblStrLieFile text,";							// 원본파일(기존이름)
				$sql2 .= "tblStrThum1 text,";								// 썸네일
				$sql2 .= "tblStrThum2 text,";
				$sql2 .= "tblStrThum3 text,";
				$sql2 .= "tblStrThum4 text,";
				$sql2 .= "tblStrThum5 text,";
				$sql2 .= "tblStrReply text,";							// 답변	
				//$sql2 .= "tblStrUrgency enum('Y','N'),";	// 긴급
				//$sql2 .= "tblIntSame int(11),";						// 동감(추천수)	
				//$sql2 .= "tblIntScrap int(11),";					// 스크랩수	
				//$sql2 .= "tblIntReport int(11),";					// 신고수
				$sql2 .= "tblIntRef int(11),";							// 조회수
				//$sql2 .= "tblStrSelect enum('Y','N'),";		// 채택
				//$sql2 .= "tblIntSetPoint int(11),";				// 포인트
				$sql2 .= "tblStrIp varchar(20),";						// 아이피
				$sql2 .= "tblStrShow enum('Y','N') not null default 'Y',";				// 표시유무
				$sql2 .= "tblStrReID varchar(30),";					// 답변자아이디
				$sql2 .= "tblStrReName varchar(30),";				// 답변자이름
				$sql2 .= "tblDtmRegDate datetime,";					// 등록일
				$sql2 .= "tblDtmModDate datetime,";					// 수정일
				$sql2 .= "tblDtmReDate datetime,";					// 답변일
				$sql2 .= "tblIntGP tinyint(1),";						// 지점코드
				$sql2 .= "tblIntPress tinyint(5),";					// 매체
				$sql2 .= "tblStrStreaming varchar(100),";		// 스트리밍
				$sql2 .= "tblStrEtc text";						// 임시
				$sql2 .= ");";
				$result2 = mysql_query($sql2) or die(mysql_error());
				//echo "$sql<BR>$sql2";

				$mkdir1 = mkdir("../_data/$strBtable",0755);
				//$mkdir2=mkdir("../../../_board/upload/$mtable/small",0755);
				if( !$mkdir1 ) { 
					echo "<script language='javascript'>";
					echo "	alert('업로드폴더 생성오류! - $strBtable');";
					echo "	history.go(-1);";
					echo "</script>";
				}

				echo "<script language='javascript'>";
				echo "	location.href='$PHP_SELF?act=add';";
				echo "</script>";
			}


			///////////////////////////////////////////////게시판 수정
			if ( $act == "mod" ) {

				$Query = "SELECT * FROM tblBoardManager WHERE tblNumber='$tNum'";
				$Result = mysql_query( $Query );
				$Array = mysql_fetch_array( $Result );

				$Data["number"]					= $Array["tblNumber"];
				$Data["bname"]					= $Array["tblBname"];
				$Data["btable"]					= $Array["tblBtable"];
				$Data["skin"]						= $Array["tblSkin"];
				$Data["category"]				= $Array["tblCategory"];
				$Data["listlevel"]			= $Array["tblListLevel"];
				$Data["viewlevel"]			= $Array["tblViewLevel"];
				$Data["writelevel"]			= $Array["tblWriteLevel"];
				$Data["modifylevel"]		= $Array["tblModifyLevel"];
				$Data["replylevel"]			= $Array["tblReplyLevel"];
				$Data["deletelevel"]		= $Array["tblDeleteLevel"];
				$Data["head"]						= $Array["tblHead"];
				$Data["foot"]						= $Array["tblFoot"];
				$Data["sub"]						= $Array["tblSub"];
				$Data["secret"]					= $Array["tblSecret"];
				$Data["homepage"]				= $Array["tblHomePage"];
				$Data["linenumber"]			= $Array["tblLineNumber"];
				$Data["pagenumber"]			= $Array["tblPageNumber"];
				$Data["mlinenumber"]			= $Array["tblmLineNumber"];
				$Data["mpagenumber"]			= $Array["tblmPageNumber"];
				$Data["viewimage"]			= $Array["tblViewImage"];
				$Data["addfilenumber"]	= $Array["tblAddfileNumber"];
				$Data["uploadsize"]			= $Array["tblUploadSize"];
				$Data["noext"]					= ( $Array["tblNoExt"] ) ? $Array["tblNoExt"] : "html,htm,php,php3,inc,cgi,asp,jsp";
				$Data["notice"]					= $Array["tblNotice"];
				$Data["commentlevel"]		= $Array["tblCommentLevel"];
				$Data["viewtype"]				= $Array["tblViewType"];
				$Data["profileview"]		= $Array["tblProfileView"];
				$Data["print"]					= $Array["tblPrint"];
				$Data["control"]				= $Array["tblControl"];
				$Data["filter"]					= $Array["tblFilter"];
				$Data["group"]					= $Array["tblGroup"];
				$Data["width"]					= $Array["tblWidth"];
				$Data["streaming"]			= $Array["tblStreaming"];
				$Data["watermark"]			= $Array["tblWatermark"];

				include ("./html/board_mod.html");

			}

			if ( $act == "mod_ok" ) {

				$Query = "UPDATE tblBoardManager set ";
				$Query .= "tblBname='$strBname',";											// 테이블명
				$Query .= "tblBtable='$strBtable',";											// 테이블이름
				$Query .= "tblSkin='$strSkin',";												// 사용스킨
				$Query .= "tblCategory='$strCategory',";										// 카테고리	
				//$Query .= "tblUser='$intUser',";												// 사용자
				$Query .= "tblListLevel='$intListLevel',";									// 목록보기등급
				$Query .= "tblViewLevel='$intViewLevel',";									// 읽기등급
				$Query .= "tblWriteLevel='$intWriteLevel',";									// 쓰기등급
				$Query .= "tblModifyLevel='$intModifyLevel',";								// 수정등급
				$Query .= "tblReplyLevel='$intReplyLevel',";									// 답변등급
				$Query .= "tblDeleteLevel='$intDeleteLevel',";								// 삭제등급
				$Query .= "tblHead='$strHead',";												// 상단파일	
				$Query .= "tblFoot='$strFoot',";												// 하단파일
				$Query .= "tblSub='$strSub',";												// 서브노출
				$Query .= "tblSecret='$strSecret',";											// 비밀글성정
				$Query .= "tblHomePage='$strHomePage',";										// 홈페이지 설정
				$Query .= "tblLineNumber='$intLineNumber',";									// 페이지당 목록수
				$Query .= "tblPageNumber='$intPageNumber',";									// 페이징수	
				$Query .= "tblmLineNumber='$intmLineNumber',";									// 페이지당 목록수(모바일)
				$Query .= "tblmPageNumber='$intmPageNumber',";									// 페이징수	(모바일)
				$Query .= "tblViewImage='$strViewImage',";									// 이미지 출력유무
				$Query .= "tblAddfileNumber='$intAddFileNumber',";							// 첨부파일수
				$Query .= "tblUploadSize='$intUploadSize',";									// 첨부파일용량
				$Query .= "tblNoExt='$strNoExt',";											// 업로드불가 확장자
				$Query .= "tblNotice='$strNotice',";											// 공지설정
				//$Query .= "tblUserComment='$intUserComment',";								// 덧글사용자
				$Query .= "tblCommentLevel='$intCommentLevel',";								// 덧글쓰기등급
				$Query .= "tblViewType='$intViewType',";										// 뷰하단 타입
				//$Query .= "tblPoint='$strPoint',";											// 포인트 설정
				//$Query .= "tblChoice='$strChoice',";											// 채택 설정
				$Query .= "tblProfileView='$strProfileView',";								// 프로필 노출 설정
				//$Query .= "tblAppraisal='$strAppraisal',";									// 평가 설정
				//$Query .= "tblScrap='$strScrap',";											// 스크랩 설정
				$Query .= "tblPrint='$strPrint',";											// 프린트 설정	
				$Query .= "tblControl='$strControl',";									// 출력옵션
				//$Query .= "tblNickname='$strNickname',";										// 닉네임 설정 ( 설정지 회원가입시 입력 이름대신 닉네임 노출 )
				$Query .= "tblFilter='$strFilter',";											// 필터 설정
				$Query .= "tblGroup='$strGroup',";											// 그룹설정 ( 관리자에서 보기위한 그룹 )
				$Query .= "tblWidth='$strWidth',";
				$Query .= "tblStreaming='$strStreaming',";
				$Query .= "tblWatermark='$strWatermark' WHERE tblNumber='$tNum'";	// 테이블 크기
				$result = mysql_query( $Query );
//				go("$PHP_SELF?mode=mod&num=$num");
				echo "<script language='javascript'>";
				echo "	location.href='$PHP_SELF?act=add';";
				echo "</script>";
			}

			///////////////////////////////////////////////게시판 삭제
			if ( $act == "del_ok" ) {

				$sql = "DELETE FROM tblBoardManager WHERE tblNumber='$tNum'";
				$result = mysql_query($sql);

				$sql2 = "DROP TABLE tbl_$tb";
				$result2 = mysql_query($sql2);

				$backupDate = date('Ymd',time());
				$sql3 = @rename("../_data/$tb","../_data/".$tb."_".$backupDate);

				echo "<script language='javascript'>";
				echo "	location.href='$PHP_SELF?act=add';";
				echo "</script>";
			}	?>
				<!--- end : 본문 --->
			</div>
		</div><div class="clr"></div>
	</div>
	<? include "inc/bottom.php" ?>
</div>
</body>
</html>