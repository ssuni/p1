<? include "inc/head.php" ?>
<?
$sub_menu = '900400';
auth_check($auth[$sub_menu]);

$pageNum = 9;
$subNum = 4;
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
				<h2><?=$sub_tit2_4?></h2>
				<p class="location">HOME > <?=$sub_tit?> > <strong><?=$sub_tit2_4?></strong></p>
			</div>
			<div class="contentsArea"><!---width:740px--->
				<!--- start : 본문 --->
<?
$proc	= trim($_REQUEST["proc"]);
$date	= ( trim($_REQUEST["date"]) != "" ) ? trim($_REQUEST["date"]) : date("Y") . "-" . date("m") . "-" . date("d") ;
$arrWeek= Array(
	"<font color=\"#FF0000\">日</font>", 
	"<font color=\"#000000\">月</font>", 
	"<font color=\"#000000\">火</font>", 
	"<font color=\"#000000\">水</font>", 
	"<font color=\"#000000\">木</font>", 
	"<font color=\"#000000\">金</font>", 
	"<font color=\"#0000FF\">土</font>", 
);


	// 일별 상세
	$sSelQuery	= " SELECT * FROM tblStatistics ";
	$sSelQuery	.= " WHERE statistics_date LIKE '{$date}%' ORDER BY statistics_idx";
	$rSelQuery	= @mysql_query($sSelQuery);
	$nTmpCnt	= 0;
	while ( $sSelQuery = @mysql_fetch_array($rSelQuery) ){
		$arr_host	= parse_url($sSelQuery["statistics_refer"]);
		$arrDate[$nTmpCnt]["time"]		= $sSelQuery["statistics_date"];
		$arrDate[$nTmpCnt]["host"]		= fnGetHostName($sSelQuery["statistics_refer"]);
		if( $sSelQuery["statistics_refer"] )
		{
			$arrDate[$nTmpCnt]["keyword"]	= fnGetKeyword($sSelQuery["statistics_refer"]);
		}
		$arrDate[$nTmpCnt]["refer"]		= $sSelQuery["statistics_refer"];
		$arrDate[$nTmpCnt]["ip"]		= $sSelQuery["statistics_ip"];

		$nTmpCnt++;
	}

	// 시간대별 접속자수...
	for ( $i = 0 ; $i < 25 ; $i++ ) { 
		$j	= ( strlen($i) == 1 ) ? "0".$i : $i ; 
		$sSelQuery	= " SELECT COUNT(*) FROM tblStatistics ";
		$sSelQuery	.= " WHERE statistics_date LIKE '{$date}_{$j}______'";
		$rSelQuery	= @mysql_query($sSelQuery);
		$aSelQuery	= @mysql_fetch_row($rSelQuery);
		$arrTime[$i]	= $aSelQuery[0];
	}


?>
<script src="/js/calender.js" language="javascript"></script>

<script>
function fnSearch(){
	var f_oForm	= document.forms["frmMain"];
	if ( f_oForm.date.value == "" ){
		alert("시작일을 지정하십시오");
		return;
	}
	f_oForm.proc.value	= 'search';
	f_oForm.submit();
}
</script>

<form name="frmMain" method="post" action="" style="margin:0px;" onsubmit="return false;">
<input type="hidden" name="proc" value="">


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
					<td align="center" bgcolor="#F5F5F5" class="bottom_5">
					<!-- 타이틀 -->
						<table width="99%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td class="main_title_01">일별 상세 보기</td>
							</tr>
						</table>
						<!-- 검색 테이블 입니다. -->
						<table width="99%" border="0" cellpadding="0" cellspacing="1" bgcolor="E6E6E6">
							<tr>
								<td align="center" class="main_title_02">날짜를 선택하여 주세요.</td>
							</tr>
							<tr>
								<td height="35" bgcolor="#FFFFFF" class="left_8">
									<input type="text" name="date" id="date" value="<?=$date?>" class="text_basic" style="width:80px;height:20px;cursor:pointer;" onclick="check_mouse('frmMain.'+this.name)" readonly >
									<img src="./img/btn_search.gif" width="49" height="19" align="absmiddle" style="cursor:pointer;" onclick="fnSearch();">
								</td>
							</tr>
						</table>
						<!-- 검색 테이블 입니다. -->
						<!-- 끝 -->
					</td>
					<td background="./img/ct_box_right.gif"></td>
				</tr>
				<tr>
					<td height="5"><img src="./img/ct_box_left_bottom.gif" width="5" height="5"></td>
					<td background="./img/ct_box_bottom.gif"></td>
					<td><img src="./img/ct_box_right_bottom.gif" width="5" height="5"></td>
				</tr>
			</table>
			<!-- 회원목록 끝 -->

			
			<!-- 검색결과 시작 -->
			<table width="99%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="5"><img src="./img/ct_box_left_top.gif" width="5" height="5"></td>
					<td background="./img/ct_box_top.gif"></td>
					<td width="5"><img src="./img/ct_box_right_top.gif" width="5" height="5"></td>
				</tr>
				<tr>
					<td background="./img/ct_box_left.gif"></td>
					<td align="center" bgcolor="#F5F5F5" class="bottom_5">
					<!-- 타이틀 -->
						<table width="99%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td class="main_title_01">시간대별 상세 </td>
							</tr>
						</table>
						<table width="99%" border="0" cellpadding="0" cellspacing="1" bgcolor="E6E6E6">
							<tr>
								<td width="140" align="center" class="main_title_02">시간</td>
								<td width="110" align="center" class="main_title_02">아이피</td>
								<td width="150" align="center" class="main_title_02">경로</td>
								<td width="130" align="center" class="main_title_02">검색어</td>
								<td align="center" class="main_title_02">상세 </td>
							</tr>
							<? for ( $i = 0 ; $i < $nTmpCnt ; $i++ ) { ?>
							<tr>
								<td height="25" align="center" bgcolor="#FFFFFF"><?=$arrDate[$i]["time"]?></td>
								<td align="center" bgcolor="#FFFFFF"><?=$arrDate[$i]["ip"]?></td>
								<td bgcolor="#FFFFFF" class="left_5"><?=trim($arrDate[$i]["host"])?></td>
								<td bgcolor="#FFFFFF" class="left_5">
								<? if ( $arrDate[$i]["ip"]=='116.125.183.75' ) { ?>
								<?
								?>
								<?=utf8_decode('%uBA54%uAC00%uC131%uD615%uC678%uACFC');?>
								<? } ?>
								<?=trim($arrDate[$i]["keyword"])?>
								</td>
								<td bgcolor="#FFFFFF" class="left_5"><a href="<?=$arrDate[$i]["refer"]?>" title="<?=$arrDate[$i]["refer"]?>" target="_blank"><?=mb_strimwidth($arrDate[$i]["refer"], 0, 40, "...", "utf-8")?></a></td>
							</tr>
							<? } ?>
						</table>
					<!-- 끝 -->
					</td>
					<td background="./img/ct_box_right.gif"></td>
				</tr>
				<tr>
					<td height="5"><img src="./img/ct_box_left_bottom.gif" width="5" height="5"></td>
					<td background="./img/ct_box_bottom.gif"></td>
					<td><img src="./img/ct_box_right_bottom.gif" width="5" height="5"></td>
				</tr>
			</table>
			<!-- 검색결과 끝 -->


			<!-- 검색결과 시작 -->
			<table width="99%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="5"><img src="./img/ct_box_left_top.gif" width="5" height="5"></td>
					<td background="./img/ct_box_top.gif"></td>
					<td width="5"><img src="./img/ct_box_right_top.gif" width="5" height="5"></td>
				</tr>
				
				<tr>
					<td background="./img/ct_box_left.gif"></td>
					<td align="center" bgcolor="#F5F5F5" class="bottom_5">
					<!-- 타이틀 -->
						<table width="99%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td class="main_title_01"><font color="FF4E00">시간대별 접속자 수 </font></td>
							</tr>
						</table>
						<table width="99%" border="0" cellpadding="0" cellspacing="1" bgcolor="E6E6E6">
							<tr>
								<td width="80" align="center" class="main_title_02">시간대</td>
								<td width="80" align="center" class="main_title_02">접속자 수</td>
								<td align="center" class="main_title_02">그래프</td>
							</tr>
							<? $tmp_max	= max($arrTime); ?>
							<? for ( $i = 0 ; $i < 24 ; $i++ ) { ?>
							<tr>
								<td height="25" align="center" bgcolor="#FFFFFF"><strong><?=$i?> 시 </strong></td>
								<td align="center" bgcolor="#FFFFFF"><font color="red"><?=number_format( $arrTime[$i] )?></font></td>
								<td bgcolor="#FFFFFF" style="padding-left:8px; padding-right:8px;">
								<!-- 그래프 통일 -->
									<table width="<?=(100 * $arrTime[$i] / $tmp_max)?>%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="4"><img src="./img/chart_left_02.gif" width="4" height="16"></td>
											<td height="16" bgcolor="#0053A9"><img src="./img/ghost.gif" width="1" height="1"></td>
											<td width="9"><img src="./img/chart_right_02.gif" width="9" height="16"></td>
										</tr>
									</table>
								</td>
							</tr>
							<? } ?>
						</table>
						<!-- 끝 -->
					</td>
					<td background="./img/ct_box_right.gif"></td>
				</tr>
				
				<tr>
					<td height="5"><img src="./img/ct_box_left_bottom.gif" width="5" height="5"></td>
					<td background="./img/ct_box_bottom.gif"></td>
					<td><img src="./img/ct_box_right_bottom.gif" width="5" height="5"></td>
				</tr>
				<tr height="12"><td></td></tr>
			</table>
			</form>
				<!--- end : 본문 --->
			</div>
		</div><div class="clr"></div>
	</div>
	<? include "inc/bottom.php" ?>
</div>
</body>
</html>