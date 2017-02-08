<?
	include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";
	include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
	include $_SERVER['DOCUMENT_ROOT']."/include/function.php";
	include $_SERVER['DOCUMENT_ROOT']."/include/log_analysis.php";

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

	if( count( $chk ) <1 ) { 
		echo "<script language='javascript'>";
		echo "	alert('경로가 올바르지 않습니다.');";
		echo "	history.go(-1);";
		echo "</script>";
	}

	for( $i = 0; $i < count( $chk ); $i++ ) {
		
		//  회원정보
		$strsql = "SELECT * FROM tblPerMember WHERE tblNumber='".$chk[$i]."'";
		$stmt = mysql_query($strsql, $connect);
		$row = mysql_fetch_array($stmt);

		$Query = "DELETE FROM tblPerMember WHERE tblNumber='".$chk[$i]."'";
		$Sql = mysql_query( $Query ) or die( mysql_error() );

		// 관리자 로그분석
		$logData = array(
			"table" => "tblPerMember",
			"pk" => $chk[$i],
			"content" => '성명아이디: ' .$row["tblStrID"], 
			"act" => "delete"
		);
		setAnalysis($logData);
	}
	echo "<script language='javascript'>";
	echo "	alert('삭제되었습니다.');";
	echo "	location.href='../admin_03_01.php';";
	echo "</script>";
?>