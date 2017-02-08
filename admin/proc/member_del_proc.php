<?
	include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";
	include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
	include $_SERVER['DOCUMENT_ROOT']."/include/function.php";

	echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";

	if( !$_SESSION["ss_id"] || $_SESSION["ss_level"] > 2 ) {
		include "../html/login.html";
	}

	if( $step != 'next' ) {
		echo "<script language='javascript'>";
		echo "	alert('경로가 올바르지 않습니다.');";
		echo "	history.go(-1);";
		echo "</script>";
	}

	if( count( $chk ) <= 0 ) {
		echo "<script language='javascript'>";
		echo "	alert('회원이 선택되지 않았습니다.');";
		echo "	history.go(-1);";
		echo "</script>";
	}

	for( $i = 0; $i < count( $chk ); $i++ ) {
		/*사진삭제*/
		$iQue = "SELECT tblStrSaveFile, tblStrThumFile FROM tblPerMember WHERE tblNumber='".$chk[$i]."'";
		$iSql = mysql_query( $iQue );
		$iArr = mysql_fetch_array( $iSql );
		if( $iArr["tblStrSaveFile"] ) {
			@unlink( "/_data/member/".$iArr["tblStrSaveFile"] );
		}
		if( $iArr["tblStrThumFile"] ) {
			@unlink( "/_data/member/".$iArr["tblStrThumFile"] );
		}

		/*회원삭제*/
		$Query = "DELETE FROM tblPerMember WHERE tblNumber='".$chk[$i]."'";
		@$Sql = mysql_query( $Query );
	}

	echo "<script language='javascript'>";
	echo "	alert('삭제되었습니다.');";
	echo "	location.href='../admin_03_01.php';";
	echo "</script>";
?>