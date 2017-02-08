<?
//--------------------------------------------------------------------------------------//
// 카운터 로그
//--------------------------------------------------------------------------------------//
if ( $_COOKIE['counter'] == '') {
	$conn_time=10800; //1분 이후에 카운터 증가
	
	$now	= getdate();
	$statistics_year	= $now["year"];
	$statistics_month	= $now["mon"];
	$statistics_day		= $now["mday"];
	$statistics_hour	= $now["hours"];
	$statistics_week	= $now["wday"];
	$statistics_date	= "NOW()";
	$statistics_browser	= $_SERVER["HTTP_USER_AGENT"];

	$statistics_host	= fnGetHost($_SERVER["HTTP_REFERER"]);
	$statistics_hostname	= fnGetHostName($_SERVER["HTTP_REFERER"]);
	$statistics_keyword		= fnGetKeyword($_SERVER["HTTP_REFERER"]);
	$statistics_refer	= $_SERVER["HTTP_REFERER"];
	$statistics_ip		= $_SERVER["REMOTE_ADDR"];
	//$statistics_original = ($_SERVER["HTTP_REFERER"]);
	//echo $statistics_original."test";
	//exit;

	$sChkQuery	= " SELECT COUNT(*) FROM tblStatistics ";
	$sChkQuery	.= " WHERE statistics_year = '{$statistics_year}' ";
	$sChkQuery	.= " AND statistics_month = '{$statistics_month}' ";
	$sChkQuery	.= " AND statistics_day = '{$statistics_day}' ";
	$sChkQuery	.= " AND statistics_ip = '{$statistics_ip}' ";
	
	//echo $sChkQuery;
	//exit;

	$rChkQuery	= @mysql_query($sChkQuery);
	$aChkQuery	= @mysql_fetch_row($rChkQuery);


	if ( $aChkQuery[0] == 0) { 

		$sCntQuery	= " INSERT INTO tblStatistics ";
		$sCntQuery	.= " ( statistics_year, statistics_month, statistics_day, statistics_hour, statistics_week, statistics_date, statistics_browser, statistics_host, statistics_hostname, statistics_keyword, statistics_refer, statistics_ip ) ";
		$sCntQuery	.= " VALUES ";
		$sCntQuery	.= " ( '{$statistics_year}', '{$statistics_month}', '{$statistics_day}', '{$statistics_hour}', '{$statistics_week}', {$statistics_date}, '{$statistics_browser}', '{$statistics_host}', '{$statistics_hostname}', '{$statistics_keyword}', '{$statistics_refer}', '{$statistics_ip}' ) ";


		@mysql_query($sCntQuery);

	}	
	@setcookie('counter',time(),time()+$conn_time,'/');
}
//--------------------------------------------------------------------------------------// ?>