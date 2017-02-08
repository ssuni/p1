<?
	include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";
	include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
	include $_SERVER['DOCUMENT_ROOT']."/include/function.php";

	echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";

	if( !$_SESSION["ss_id"] || $_SESSION["ss_level"] > 2 ) {
		include "../html/login.html";
	}


	foreach($_POST['chk'] as $k =>$v) {
		$row = mysql_fetch_array(mysql_query("SELECT * FROM tbl_contact_model WHERE uid = ".$v, $connect));
		
		for($i=1; $i<=10; $i++) {
			if ($row['wr_file'.$i]) {
				@unlink($_SERVER['DOCUMENT_ROOT'].$row['wr_file'.$i]);
			}
		}

		mysql_query( "DELETE FROM tbl_contact_model WHERE uid=".$v ) or die( mysql_error() );
	}

	echo "<script language='javascript'>";
	echo "	alert('삭제되었습니다.');";
	echo "	location.href='../admin_02_08.php';";
	echo "</script>";
?>