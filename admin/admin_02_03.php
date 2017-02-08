<? include "inc/head.php" ?>
<?
$sub_menu = '200300';
auth_check($auth[$sub_menu]);

$pageNum = 2;
$subNum = 5;
?>
<body class="commonBg">
<div id="bodyWrap">
	<? include "inc/top.php" ?>
	<div id="contentsWrap">
		<div class="leftArea">
			<? include "inc/left.php" ?>
		</div>
		<div class="rightArea">
			<div id="locationBar">
				<h2><?=$sub_tit2_5?></h2>
				<p class="location">HOME > <?=$sub_tit?> > <strong><?=$sub_tit2_5?></strong></p>
			</div>
			<div class="contentsArea"><!---width:740px--->
				<!--- start : 본문 --->
<?	$del_idx=$_REQUEST["del_idx"];
if($del_idx!='' && $_SESSION["ss_level"] < 3){
	$sql="delete from tblMobile where idx='$del_idx'";
	$stmt=mysql_query($sql);
	$mmsg="선택하신 데이터가 삭제되었습니다.";
	if(!$stmt) $mmsg="DB오류!! 삭제가 실패되었습니다!!";	
	echo "<script>alert('$mmsg');</script>";
}

$sSelQuery	= " SELECT * FROM tblMobile ORDER BY idx DESC ";
$rSelQuery	= @mysql_query($sSelQuery);
$nTmp	= 0;
while ( $aSelQuery = @mysql_fetch_array($rSelQuery) ){
	$arrList[$nTmp]['idx']		= $aSelQuery['idx'];
	$arrList[$nTmp]['name']		= $aSelQuery['name'];
	$arrList[$nTmp]['phone']	= $aSelQuery['phone'];	
	$arrList[$nTmp]['email']	= $aSelQuery['email'];
	if($aSelQuery['time']=="0"){
		$arrList[$nTmp]['time']="피부(색소)";
	}else if($aSelQuery['time']=="1"){
		$arrList[$nTmp]['time']="피부(여드름)";
	}else if($aSelQuery['time']=="2"){
		$arrList[$nTmp]['time']="피부(기타)";
	}else if($aSelQuery['time']=="3"){
		$arrList[$nTmp]['time']="주름/탄력";
	}else if($aSelQuery['time']=="4"){
		$arrList[$nTmp]['time']="보톡스";
	}else if($aSelQuery['time']=="5"){
		$arrList[$nTmp]['time']="필러";
	}else if($aSelQuery['time']=="6"){
		$arrList[$nTmp]['time']="비만";
	}else if($aSelQuery['time']=="7"){
		$arrList[$nTmp]['time']="기타";
	}

	$arrList[$nTmp]['content']	= nl2br($aSelQuery['content']);
	$arrList[$nTmp]['regdate']	= $aSelQuery['regdate'];
	$nTmp++;
}	?>
<script>
	function del( oo ) {
		if(confirm('삭제된 데이터는 복구할 수 없습니다.\n\n정말로 삭제하시겠습니까?')){
			location.href	= '<?=$PHP_SELF?>?del_idx='+oo;
		}	
	}
</script>
			<table width="99%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height="12" colspan="3"></td>
				</tr>
				<tr>
					<td width="5" height="5"><img src="./img/ct_box_left_top.gif" width="5" height="5"></td>
					<td background="./img/ct_box_top.gif"></td>
					<td width="5"><img src="./img/ct_box_right_top.gif" width="5" height="5"></td>
				</tr>
				<tr>
					<td background="./img/ct_box_left.gif"></td>
					<td align="center" bgcolor="#F5F5F5">
					<!-- 팝업설정 -->
						<table width="99%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="50"> </td>
								<td class="main_title_01">모바일 상담</td>
								<td width="50"><a href="./inc/ex_mobile.php"><img align="absmiddle" src="./img/btn_member_down.gif" border="0"></a></td>
							</tr>
						</table>
						<table width="99%" border="0" cellpadding="0" cellspacing="1" bgcolor="E6E6E6">
							<tr>
								<td width="40" align="center" class="main_title_02">번호</td>
								<td width="60" align="center" class="main_title_02">이름</td>
								<td width="100" align="center" class="main_title_02">연락처</td>
								<td width="70" align="center" class="main_title_02">항목</td>
								<td width="*" align="center" class="main_title_02">이메일</td>
								<td width="*" align="center" class="main_title_02">내용</td>
								<td width="80" align="center" class="main_title_02">작성일</td>
								<td width="30" align="center" class="main_title_02">삭제</td>
							</tr>
							<? for ( $i = 0 ; $i < $nTmp ; $i++ ) { ?>
							<tr>
								<td height="25" align="center" bgcolor="#FFFFFF"><?=$nTmp-$i?></td>
								<td align="center" bgcolor="#FFFFFF" class="left_8"><?=$arrList[$i]["name"]?></td>
								<td align="center" bgcolor="#FFFFFF"><?=$arrList[$i]["phone"]?></td>
								<td align="center" bgcolor="#FFFFFF"><?=$arrList[$i]["time"]?></td>
								<td align="center" bgcolor="#FFFFFF"><?=$arrList[$i]["email"]?></td>
								<td align="left" bgcolor="#FFFFFF"><?=$arrList[$i]["content"]?></td>
								<td align="center" bgcolor="#FFFFFF"><?=$arrList[$i]["regdate"]?></td>
								<td align="center" bgcolor="#FFFFFF"><a href="javascript:del('<?=$arrList[$i]["idx"]?>')"><font color="red">X</font></a></td>
							</tr>
							<? } ?>
							<?if($nTmp==0){?>
							<tr>
								<td height="55" align="center" bgcolor="#FFFFFF" colspan="8">등록된 게시물이 없습니다.</td>
							</tr>
							<? } ?>
						</table>
						<table width="99%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td height="30" align="center"></td>
							</tr>
						</table>
						<!-- 예약 처리 대상자 끝 -->
					</td>
					<td background="./img/ct_box_right.gif"></td>
				</tr>
				<tr>
					<td height="5"><img src="./img/ct_box_left_bottom.gif" width="5" height="5"></td>
					<td background="./img/ct_box_bottom.gif"></td>
					<td><img src="./img/ct_box_right_bottom.gif" width="5" height="5"></td>
				</tr>
			</table>

				<!--- end : 본문 --->
			</div>
		</div><div class="clr"></div>
	</div>
	<? include "inc/bottom.php" ?>
</div>
</body>
</html>