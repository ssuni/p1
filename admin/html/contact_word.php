<?	include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";
	include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";

header( "Content-type: application/vnd.msword;" );
header( "Content-Disposition: attachment; filename=model_".time().".doc" );
header( "Content-Description: PHP4 Generated Data" ); 
print("<meta http-equiv=\"Content-Type\" content=\"application/vnd.msword; charset=utf-8\">"); // 한글깨짐방지

		$Query = "SELECT * FROM tbl_contact_model WHERE uid='".$uid."'";
		$Sql = mysql_query( $Query );
		$R = mysql_fetch_array( $Sql );


if($R['wr_gender']=='male'): $_wr_gender = "남성"; endif;
if($R['wr_gender']=='female'): $_wr_gender = "여성"; endif;

if($R['wr_married']=='yes'): $_wr_married = "기혼"; endif;
if($R['wr_married']=='no'): $_wr_married = "미혼"; endif;

if($R['wr_army']=='yes'): $_wr_army = "제대"; endif;
if($R['wr_army']=='no'):  $_wr_army = "미필"; endif;
if($R['wr_army']=='none'): $_wr_army = "해당사항없음"; endif;

$_wr_exp = "";
$arr=explode("|" , $R['wr_exp']);
$arr_length = count($arr);
for($i=0; $i<$arr_length; $i++):
	switch ($arr[$i]):
	  case 'face'   : $_wr_exp .= "안면윤곽"; break;
	  case 'breast' : $_wr_exp .= "가슴"; break;
	  case 'eyes'   : $_wr_exp .= "눈"; break;
	  case 'nose'   : $_wr_exp .= "코"; break;
	  case 'fat'    : $_wr_exp .= "지방이식"; break;
	  default   : $_wr_exp .= ""; break;
	endswitch;

	if($i < $arr_length-1){
		$_wr_exp .= ", ";
	}
endfor;


$_wr_apply = "";
$arr=explode("|" , $R['wr_apply']);
$arr_length = count($arr);
for($i=0; $i<$arr_length; $i++):
	switch ($arr[$i]):
	  case 'face'   : $_wr_apply .= "안면윤곽"; break;
	  case 'breast' : $_wr_apply .= "가슴"; break;
	  case 'eyes'   : $_wr_apply .= "눈"; break;
	  case 'nose'   : $_wr_apply .= "코"; break;
	  case 'fat'    : $_wr_apply .= "지방이식"; break;
	  default   : $_wr_apply .= ""; break;
	endswitch;

	if($i < $arr_length-1){
		$_wr_apply .= ", ";
	}
endfor;


echo '
<table summary="성형모델 신청상세내용" border="1">
	<colgroup> 
	<col width="100"> 
	<col width=""> 
	</colgroup> 
	<tbody>
	<tr>
		<th scope="col">이름</th>
		<td>'.$R[wr_name].'</td>
	</tr>
	<tr>
		<th scope="col">생년월일</th>
		<td>'.$R[wr_birth].'</td>
	</tr>
	<tr>
		<th scope="col">성별</th>
		<td>'.$_wr_gender.'</td>
	</tr>
	<tr>
		<th scope="col">직업</th>
		<td>'.$R[wr_job].'</td>
	</tr>
	<tr>
		<th scope="col">키</th>
		<td>'.$R[wr_height].'cm</td>
	</tr>
	<tr>
		<th scope="col">몸무게</th>
		<td>'.$R[wr_weight].'kg</td>
	</tr>
	<tr>
		<th scope="col">휴대전화</th>
		<td>'.$R[wr_phone1].'-'.$R[wr_phone2].'-'.$R[wr_phone3].'</td>
	</tr>
	<tr>
		<th scope="col">거주지</th>
		<td>'.$R[wr_address].'</td>
	</tr>
	<tr>
		<th scope="col">이메일</th>
		<td>'.$R[wr_email].'</td>
	</tr>
	<tr>
		<th scope="col">결혼여부</th>
		<td>'.$_wr_married.'</td>
	</tr>
	<tr>
		<th scope="col">군필사항</th>
		<td>'.$_wr_army.'</td>
	</tr>
	<tr>
		<th scope="col">과거수술부위</th>
		<td>'.$_wr_exp.'</td>
	</tr>
	<tr>
		<th scope="col">신청분야</th>
		<td>'.$_wr_apply.'</td>
	</tr>
	<tr>
		<th scope="col">지원내용</th>
		<td>'.$R[wr_text].'</td>
	</tr>
	

	</tbody>
</table>';