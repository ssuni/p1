<?	include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";
	include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
	include $_SERVER['DOCUMENT_ROOT']."/include/function.php";
	include $_SERVER['DOCUMENT_ROOT']."/include/lib/common.lib.php";
	include $_SERVER['DOCUMENT_ROOT']."/include/lib/admin.lib.php";

		include $_SERVER['DOCUMENT_ROOT']."/include/api.class.php";
		$api = new gabiaSmsApi('ppeum000','4ef81ca5eaa4654331ae3936400fb3dd');



	if($_SESSION["ss_id"]=='' || !$_SESSION["ss_id"] || $_SESSION["ss_level"] > 2){
		Header("Location:http://".$bagData["host"]."/admin/");
		exit;
	}

	$Counter["todate"]	= date('Y-m-d');
	$timestamp			= mktime(0, 0, 0, date("m"), date("d"), date("Y"));
	$timestamp1			= ($timestamp + (-1*86400));
	$Counter["yeday"]	= date("Y-m-d", $timestamp1);

	/*오늘 카운터*/
	$dque = "SELECT count(*) FROM tblStatistics WHERE SUBSTRING_INDEX( statistics_date, ' ', 1 )='".$Counter["todate"]."'";
	$darr = mysql_fetch_array(mysql_query($dque));
	
	/*어제 카운터*/
	$yque = "SELECT count(*) FROM tblStatistics WHERE SUBSTRING_INDEX( statistics_date, ' ', 1 )='".$Counter["yeday"]."'";
	$yarr = mysql_fetch_array(mysql_query($yque));

	// 기간 카운터
	//SELECT count(*) FROM tblStatistics WHERE SUBSTRING_INDEX( statistics_date, ' ', 1 )>='2016-05-02' and SUBSTRING_INDEX( statistics_date, ' ', 1 )<='2016-05-08'

	/*토탈카운터*/
	$tque = "SELECT count(*) FROM tblStatistics";
	$tarr = mysql_fetch_array(mysql_query($tque));

	/*통계*/
	$this_month	= date("Y") . "-" . date("m");
	$sTotalMem	= " SELECT COUNT(*) FROM tblPerMember";
	$rTotalMem	= @mysql_query($sTotalMem);
	$aTotalMem	= @mysql_fetch_row($rTotalMem);
	$nTotalMem	= $aTotalMem[0];

	$sMonthMem	= " SELECT COUNT(*) FROM tblPerMember ";
	$sMonthMem	.= " WHERE tblDtmRegDate LIKE '{$this_month}%'";
	$rMonthMem	= @mysql_query($sMonthMem);
	$aMonthMem	= @mysql_fetch_row($rMonthMem);
	$nMonthMem	= $aMonthMem[0];

	$sMan	= " SELECT COUNT(*) FROM tblPerMember ";
	$sMan	.= " WHERE tblStrSex = 'M'";
	$rMan	= @mysql_query($sMan);
	$aMan	= @mysql_fetch_row($rMan);
	$nMan	= $aMan[0];

	$sWoman	= " SELECT COUNT(*) FROM tblPerMember ";
	$sWoman	.= " WHERE tblStrSex = 'F'";
	$rWoman	= @mysql_query($sWoman);
	$aWoman	= @mysql_fetch_row($rWoman);
	$nWoman	= $aWoman[0];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:::<?=$bagData["siteName"]?> 관리자페이지:::</title>
<link href="/admin/css/admin.css" rel="stylesheet" type="text/css" />
<link href="/admin/css/admin_old.css" rel="stylesheet" type="text/css" />
<script src="/admin/js/design_js.js"></script>
<script src="/js/jquery-1.11.2.min.js"></script>
<script src="/js/total.js"></script>

<!--dataTables-->
	<link href="/admin/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
	<link href="https://cdn.datatables.net/select/1.2.1/css/select.dataTables.min.css" rel="stylesheet" type="text/css" />
	<script src="/admin/js/jquery.dataTables.js"></script>
	<script src="https://cdn.datatables.net/select/1.2.1/js/dataTables.select.min.js"></script>
<!--dataTables-->
	<link rel="stylesheet" href="/admin/css/remodal.css">
	<link rel="stylesheet" href="/admin/css/remodal-default-theme.css">
	<script src="/admin/js/remodal.js"></script>
<!--remodal-->


<!--remodal-->

<!-- 익스6 png 핵 - (div 내에서 배경png 적용시에 사용, 태그내에 a 링크 사용가능) -->
<!--[if IE 6]>
<script type="text/javascript" src="/admin/js/DD_belatedPNG.js"></script>
<script type="text/javascript">
 DD_belatedPNG.fix('img, #bodyWrap');
</script>
<![endif]-->
</head>