<?
$today=date("Y_m_d");
$e_name="모바일상담";
header( "Content-type: application/vnd.ms-excel" ); 
header( "Content-Disposition: attachment; filename=".iconv("UTF-8","EUC-KR",$e_name)."_".$today.".xls" ); 
header( "Content-Description: PHP4 Generated Data" ); 

# 게시판 환경 설정 화일

include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
include $_SERVER['DOCUMENT_ROOT']."/include/function.php";

###### 현재 등록되어 있는 총게시물의 개수를 구한다. ###############

$where = ( $field ) ? " WHERE field='".$field."'" : "";
$query = "SELECT count(idx) FROM tblMobile".$where;
$result = mysql_query($query,$connect);
if(!$result){
	echo("쿼리에러01");
	exit;
}
$total_record = mysql_result($result,0,0);	?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<table width="800" border="1" cellspacing="0" cellpadding="0">
	<tr align="center">
		<td height="50" colspan="7"><?=$e_name?></td>
	</tr>
	<tr align="center" style="background-color:yellow;">
		<td width="50">번호</td>
		<td width="100">항목</td>
		<td width="80">이름</td>
		<td width="120">연락처</td>
		<td width="150">이메일</td>
		<td width="*">내용</td>
		<td width="150">등록일</td>
	</tr>
	<?
	// 리스트
	$Query = "SELECT * FROM  tblMobile ".$where." ORDER BY regdate DESC ";
	$Result = mysql_query( $Query );
	$i = 0;
	while( $Array = mysql_fetch_array( $Result )) {
		$Data[$i]["number"]		= $Array["idx"];
		$Data[$i]["name"]		= $Array["name"];
		$Data[$i]["phone"]		= $Array["phone"];
		$Data[$i]["email"]		= $Array["email"];
		$Data[$i]["content"]	= $Array["content"];
		$Data[$i]["regdate"]	= $Array["regdate"];
		
		if($Array['time']=="0"){
			$Data[$i]['time']="지방흡입";
		}else if($Array['time']=="1"){
			$Data[$i]['time']="지방이식";
		}else if($Array['time']=="2"){
			$Data[$i]['time']="종아리성형";
		}else if($Array['time']=="3"){
			$Data[$i]['time']="쁘띠성형";
		}else if($Array['time']=="4"){
			$Data[$i]['time']="여성형유방";
		}else if($Array['time']=="5"){
			$Data[$i]['time']="비만클리닉";
		}else if($Array['time']=="6"){
			$Data[$i]['time']="기타";
		}
		
		$i++;
	}
	
	for( $m = 0; $m < $i; $m++ ) {	?>
		<tr align="center">
			<td height="30"><?=$total_record?></td>
			<td><?=$Data[$m]["time"]?></td>
			<td><?=$Data[$m]["name"]?></td>
			<td><?=$Data[$m]["phone"]?></td>			
			<td><?=$Data[$m]["email"]?></td>
			<td><?=$Data[$m]["content"]?></td>
			<td><?=$Data[$m]["regdate"]?></td>
		</tr>
	<?	$total_record--;
	}	?>								
</table>