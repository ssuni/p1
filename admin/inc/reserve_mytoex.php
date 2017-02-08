<?
$today=date("Y_m_d");

header( "Content-type: application/vnd.ms-excel" ); 
header( "Content-Disposition: attachment; filename=member_".$today.".xls" ); 
header( "Content-Description: PHP4 Generated Data" ); 

# 게시판 환경 설정 화일

include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
include $_SERVER['DOCUMENT_ROOT']."/include/function.php";

###### 현재 등록되어 있는 총게시물의 개수를 구한다. ###############

// 오늘이 속한 주 구함
function getWeek($today="") {
    if(!$today) $today = time();
    if(strlen($today)==8) {
        $ty = substr($today,0,4);
        $tm = substr($today,4,2);
        $td = substr($today,6,2);
        $now_time = mktime(0,0,0,$tm,$td,$ty);
    } elseif(strlen($today)==10) $now_time = $today;
    else return 0; //error
    $t_week = date("w", $now_time);

    $set[0] = $now_time-($t_week*86400);
    $set[1] = $now_time+((1-$t_week)*86400);
		$set[2] = $now_time+((2-$t_week)*86400);
		$set[3] = $now_time+((3-$t_week)*86400);
		$set[4] = $now_time+((4-$t_week)*86400);
		$set[5] = $now_time+((5-$t_week)*86400);
		$set[6] = $now_time+((6-$t_week)*86400);

    return $set;
}

$thisweek = getWeek($week);
$prev_week	= $thisweek[0] - (7 * 24 * 60 * 60);
$prev_week	= date("Ymd", $prev_week);
$next_week	= $thisweek[0] + (7 * 24 * 60 * 60);
$next_week	= date("Ymd", $next_week);

$query = "SELECT count(tblNumber) FROM tblReserve WHERE tblDtmRsvDate BETWEEN '".date("Y-m-d 00:00:00", $thisweek[0])."' AND '".date("Y-m-d  23:59:59", $thisweek[6])."'";
$result = mysql_query( $query );
if(!$result){
	echo("쿼리에러01");
	exit;
}
$total_record = mysql_result($result,0,0);

?>		
					
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<table width="800" border="0" cellspacing="0" cellpadding="0">
	<tr align="center" bgcolor="#DEDEDE">
		<td height="30">이름</td>
		<td>진료항목</td>
		<td>진료일시</td>
		<td>환자구분</td>
		<td>상태</td>
		<td>제목</td>
		<td>내용</td>
		<td>연락처</td>
		<td>이메일</td>
	</tr>

	<!-- 리스트-->
	<?
	// 리스트
	$Query = "SELECT * FROM  tblReserve WHERE tblDtmRsvDate BETWEEN '".date("Y-m-d 00:00:00", $thisweek[0])."' AND '".date("Y-m-d  23:59:59", $thisweek[6])."' ORDER BY tblDtmRsvDate ASC";
	$Result = mysql_query( $Query );
	$i = 0;
	while( $Array = mysql_fetch_array( $Result )) {
		$Data[$i]["name"]			= $Array["tblStrName"];
		$Data[$i]["field"]		= $medicalField[$Array["tblIntField"]];
		$Data[$i]["rsvdate"]	= $Array["tblDtmRsvDate"];
		$Data[$i]["gubun"]		= $mediGubunArr[$Array["tblIntGubun"]];
		$Data[$i]["status"]		= $statusArr[$Array["tblIntStatus"]];
		$Data[$i]["subject"]	= $Array["tblStrSubject"];
		$Data[$i]["comment"]	= $Array["tblStrComment"];
		$Data[$i]["phone"]		= $Array["tblStrPhone"];
		$Data[$i]["email"]		= $Array["tblStrEmail"];
		$i++;
	}
	
	for( $m = 0; $m < $i; $m++ ) {
	?>
		<tr align="center">
			<td height="30"><? echo $Data[$m]["name"]; ?></td>
			<td><? echo $Data[$m]["field"]; ?></td>
			<td><? echo $Data[$m]["rsvdate"]; ?></td>
			<td><? echo $Data[$m]["gubun"]; ?></td>
			<td><? echo $Data[$m]["status"]; ?></td>
			<td><? echo $Data[$m]["subject"]; ?></td>
			<td><? echo $Data[$m]["comment"]; ?></td>
			<td><? echo $Data[$m]["phone"]; ?></td>
			<td><? echo $Data[$m]["email"]; ?></td>
		</tr>
	<?
	}
	?>								
</table>
