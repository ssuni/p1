<?	include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";	
include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
include $_SERVER['DOCUMENT_ROOT']."/include/function.php";

$Que = "SELECT * FROM tbl_".$tb." WHERE tblNumber='".$tNum."' AND tblStrPass=password('".$strPass."')";
$Sql = mysql_query($Que);
$arr = mysql_fetch_array($Sql);
	if( $arr["tblStrPass"] ) { 
		echo "<form name='f1orm' method='post' action='".$gogos."' target='_parent'>\n";
		echo "<input type='hidden' name='strPass' value='".$arr['tblStrPass']."'>\n";
		echo "</form>";
		echo "<script language='javascript'>";
		echo "document.f1orm.submit();";
		echo "</script>";
		exit;
	}else{ 
		echo "<script language='javascript'>";
		echo "	alert('비밀번호가 일치하지 않습니다.');";
		echo "</script>";
		exit;
	}?>