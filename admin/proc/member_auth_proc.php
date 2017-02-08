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

	if (is_array($_POST['auth_key'])) {
		$auth_key = "[".implode("][", $_POST['auth_key'])."]";
	} else {
		$auth_key = "";
	}

	$chk = mysql_fetch_array(mysql_query("SELECT * FROM auth_menu WHERE mb_id='".$mb_id."'"));
	if (!$chk['mb_id']) {
	
		$Query = "INSERT INTO auth_menu SET ";
		$Query .= "mb_id='".$mb_id."',";
		$Query .= "auth_key='".$auth_key."'";
	
	} else {
	
		$Query = "UPDATE auth_menu SET ";
		$Query .= "auth_key='".$auth_key."' WHERE mb_id='".$mb_id."'";

	}
	$Sql = mysql_query( $Query ) or die( mysql_error() );


	$get_val = "step=".$step."&level=".$level."&blnemail=".$blnemail."&blnsms=".$blnsms."&age=".$age."&search=".$search."&keyword=".$keyword;
	echo "<script>location.href='../admin_03_01.php?".$get_val."';</script>";
?>