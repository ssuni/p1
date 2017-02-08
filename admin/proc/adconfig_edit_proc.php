<?	include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";
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

	$url					= $_REQUEST["url"];
	if($url=='') $url='/admin/';

	if( $act == 'bic' ) {
		$Data["name"]		= trim( $strName );
		$Data["email"]	= $strEmail;
		$Data["phone"]	= $strPhone;
		$Data["mobile"]	= $strMobile;

		$Query = "UPDATE tblAdminMember SET ";
		$Query .= "tblStrName='".$Data["name"]."',";
		$Query .= "tblStrEmail='".$Data["email"]."',";
		$Query .= "tblStrPhone='".$Data["phone"]."',";
		$Query .= "tblStrMobile='".$Data["mobile"]."'";
		$Sql = mysql_query( $Query ) or die( mysql_error() );
		echo "<script language='javascript'>";
		echo "	alert('저장되었습니다.');";
		echo "	location.href='$url';";
		echo "</script>";
	} 
	
	if( $act == 'pass' ) {
		$Data["id"]			= $_SESSION["ss_id"];
		$Data["pass"]		= $strPass;
		$Data["pass1"]	= $strPass1;
		$Data["pass2"]	= $strPass2;

		$pQuery = "SELECT tblStrPass FROM tblAdminMember WHERE tblStrID='".$Data["id"]."' AND tblStrPass='".$Data["pass"]."'";
		$pSql = mysql_query( $pQuery );
		$pArray = mysql_fetch_array( $pSql );
		if( $pArray["tblStrPass"] ) {
			if( $Data["pass1"] == $Data["pass2"] ) {
				$Query = "UPDATE tblAdminMember SET ";
				$Query .= "tblStrPass='".$Data["pass1"]."'";
				$Query .= " WHERE tblStrID='".$Data["id"]."' AND tblStrPass='".$Data["pass"]."'";
				$Sql = mysql_query( $Query ) or die( mysql_error() );
				echo "<script language='javascript'>";
				echo "	alert('저장되었습니다.');";
				echo "	location.href='$url';";
				echo "</script>";
			} else {
				echo "<script language='javascript'>";
				echo "	alert('비밀번호가 맞지 않습니다.');";
				echo "	history.go(-1);";
				echo "</script>";
			}
		} else {
			echo "<script language='javascript'>";
			echo "	alert('일치하는 관리자가 없습니다.');";
			echo "	history.go(-1);";
			echo "</script>";
		}
	} ?>