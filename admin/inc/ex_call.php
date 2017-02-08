<?
$today=date("Y_m_d");
$e_name="전화상담";
header( "Content-type: application/vnd.ms-excel" ); 
header( "Content-Disposition: attachment; filename=".iconv("UTF-8","EUC-KR",$e_name)."_".$today.".xls" ); 
header( "Content-Description: PHP4 Generated Data" ); 

# 게시판 환경 설정 화일

include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
include $_SERVER['DOCUMENT_ROOT']."/include/function.php";

###### 현재 등록되어 있는 총게시물의 개수를 구한다. ###############

$query = "SELECT count(tblNumber) FROM tblCall ";
$result = mysql_query($query,$connect);
if(!$result){
	echo("쿼리에러01");
	exit;
}
$total_record = mysql_result($result,0,0);	?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<table width="800" border="1" cellspacing="0" cellpadding="0">
	<tr align="center">
		<td height="50" colspan="8">전화상담</td>
	</tr>
	<tr align="center" style="background-color:yellow;">
		<td width="40">번호</td>
		<td width="90">과목</td>
		<td width="80">이름</td>
		<td width="100">전화번호</td>
		<td width="100">상담시간</td>
		<td>내용</td>
		<td width="130">등록일</td>
		<td width="40">상태</td>
	</tr>
	<?	$whereis = ( $gp ) ? "WHERE tblIntGP='".$gp."'" : "";
	// 리스트
	$Query = "SELECT * FROM  tblCall ".$whereis." ORDER BY tblDtmRegDate DESC ";
	$Result = mysql_query( $Query );
	$i = 0;
	while( $Array = mysql_fetch_array( $Result )) {
		$Data[$i]["number"]		= $Array["tblNumber"];
		$Data[$i]["field"]		= $medicalField[$Array["tblIntField"]];
		$Data[$i]["name"]		= $Array["tblStrName"];
		$Data[$i]["phone"]		= $Array["tblStrMobile"];
		$Data[$i]["time"]		= $Array["tblStrTime"];
		$Data[$i]["comment"]	= $Array["tblStrComment"];
		$Data[$i]["regdate"]	= $Array["tblDtmRegDate"];
		switch( $Array["tblIntStatus"] ) {
			case "1" : $Data[$i]["status"]	= "접수"; break;
			case "2" : $Data[$i]["status"]	= "완료"; break;
			case "3" : $Data[$i]["status"]	= "취소"; break;
			default : $Data[$i]["status"]	= "접수"; break;
		}
		$i++;
	}
	
	for( $m = 0; $m < $i; $m++ ) {	?>
		<tr align="center">
			<td height="30"><?=$total_record?></td>
			<td><?=$Data[$m]["field"]?></td>
			<td><?=$Data[$m]["name"]?></td>
			<td><?=$Data[$m]["phone"]?></td>			
			<td><?=$Data[$m]["time"]?>시~<?=ceil($Data[$m]["time"])+3?>시</td>
			<td><?=$Data[$m]["comment"]?></td>			
			<td><?=$Data[$m]["regdate"]?></td>
			<td><?=$Data[$m]["status"]?></td>
		</tr>
	<?	$total_record--;
	}	?>								
</table>