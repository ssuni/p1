<?
$today=date("Y_m_d");

header( "Content-type: application/vnd.ms-excel" ); 
header( "Content-Disposition: attachment; filename=member_".$today.".xls" ); 
header( "Content-Description: PHP4 Generated Data" ); 

# 게시판 환경 설정 화일

include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
include $_SERVER['DOCUMENT_ROOT']."/include/function.php";

###### 현재 등록되어 있는 총게시물의 개수를 구한다. ###############

$query = "SELECT count(tblNumber) FROM tblPerMember ";
$result = mysql_query($query,$connect);
if(!$result){
	echo("쿼리에러01");
	exit;
}
$total_record = mysql_result($result,0,0);	?>				
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<table width="800" border="1" cellspacing="0" cellpadding="0">
	<tr align="center">
		<td colspan="9" height="30">회원리스트</td>
	</tr>
	<tr align="center" style="background-color:yellow;">
		<td width="40" height="30">번호</td>
		<td width="70">구분</td>
		<td width="90">아이디</td>
		<td width="100">이름</td>
		<td width="110">핸드폰</td>
		<td>이메일</td>
		<td width="50">나이</td>
		<td width="80">가입일</td>
		<td width="50">탈퇴신청</td>
	</tr>
	<?
	$whereis = ( $gp ) ? "WHERE tblIntGP='".$gp."'" : "";
	// 리스트
	$Query = "SELECT * FROM  tblPerMember ".$whereis." ORDER BY tblDtmRegDate DESC ";
	$Result = mysql_query( $Query );
	$i = 0;
	while( $Array = mysql_fetch_array( $Result )) {
		$Data[$i]["number"]		= $Array["tblNumber"];
		$Data[$i]["id"]			= $Array["tblStrID"];
		$Data[$i]["passwd"]		= $Array["tblStrPass"];
		$Data[$i]["name"]		= $Array["tblStrName"];
		$Data[$i]["birth"]		= $Array["tblIntBirth"];
		$Data[$i]["age"]		= $Array["tblIntAge"];
		$Data[$i]["sex"]		= $Array["tblStrSex"];
		$Data[$i]["email"]		= $Array["tblStrEmail"];
		$Data[$i]["mobile"]		= $Array["tblStrMobile"];
		$Data[$i]["level"]		= $Array["tblIntLevel"];
		$Data[$i]["regdate"]	= $Array["tblDtmRegDate"];
		$Data[$i]["memDel"]		= $Array["memDel"];

		if($Data[$i]["memDel"]=='Y') $Data[$i]["mD"]="신청"; else $Data[$i]["mD"]="-";
		$i++;
	}
	
	for( $m = 0; $m < $i; $m++ ) {	?>
		<tr align="center"<?if($Data[$m]["memDel"]=='Y') echo " style='background-color:pink;'";?>>
			<td height="30"><?=$total_record?></td>
			<td height="30"><?=$memberNameArr[$Data[$m]["level"]]?></td>
			<td><?=$Data[$m]["id"]?></td>
			<td><?=$Data[$m]["name"]?></td>
			<td><?=$Data[$m]["mobile"]?></td>
			<td><?=$Data[$m]["email"]?></td>			
			<td><?=(ceil(date("Y")) - substr($Data[$m]["birth"],0,4) + 1)// echo $Data[$m]["age"]; ?></td>
			<td><?=$Data[$m]["regdate"]?></td>
			<td><?=$Data[$m]["mD"]?></td>
		</tr>
	<?	$total_record--;
	}	?>								
</table>