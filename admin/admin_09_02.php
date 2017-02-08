<? include "inc/head.php" ?>
<?
$sub_menu = '900200';
auth_check($auth[$sub_menu]);

$pageNum = 9;
$subNum = 2;
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
				<h2><?=$sub_tit2_2?></h2>
				<p class="location">HOME > <?=$sub_tit?> > <strong><?=$sub_tit2_2?></strong></p>
			</div>
			<div class="contentsArea"><!---width:740px--->
				<!--- start : 본문 --->
<?		// 관리자가 아닐때는 권한 제한
	if( $_SESSION["ss_level"] > 1 ) {
		$whereIs = "WHERE tblIntGP='".$_SESSION["ss_gp"]."'";
	}

	/*월별 회원가입 현황*/
	$Query = "SELECT * FROM tblPerMember ".$whereIs." ORDER BY tblDtmRegDate ASC";
	$Sql = mysql_query( $Query );
	while( $Array = mysql_fetch_array( $Sql ) ) {
		$timeArr				= explode( ' ', $Array["tblDtmRegDate"] );
		$ckDate["ymd"]	= explode( '-', $timeArr[0] );
		$Data["total"]++;
		$Year[$ckDate["ymd"][0]]++;
		$Month[$ckDate["ymd"][0]][$ckDate["ymd"][1]]++;
		$Day[$ckDate["ymd"][0]][$ckDate["ymd"][1]][$ckDate["ymd"][2]]++;
	}
?>
<script src="/include/calender.js" language="javascript"></script>

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
								<td class="main_title_01">회원가입 현황</td>
							</tr>
						</table>
						<!-- 검색 테이블 입니다. -->
						<table width="99%" border="0" cellpadding="0" cellspacing="1" bgcolor="E6E6E6">
							<tr>
								<td align="center" width="8%" class="main_title_02">년도</td>
								<? for( $m = 1; $m <= 12; $m++ ) { ?>
								<td align="center" width="7%" class="main_title_02"><? echo zero_full( $m, 2 ); ?>월</td>
								<? } ?>
								<td align="center" width="8%" class="main_title_02">TOTAL</td>
							</tr>
							<? for( $y = 2011; $y <= date('Y'); $y++ ) { ?>
							<tr>
								<td height="25" align="center" class="main_title_02"><a href="?sYe=<? echo $y; ?>"><? echo $y; ?>년</a></td>
								<? for( $m = 1; $m <= 12; $m++ ) { ?>
								<td height="25" align="right" bgcolor="#FFFFFF" style="padding-right:3px"><a href="?sYe=<? echo $y; ?>&sMo=<? echo $m; ?>"><? echo number_format( $Month[$y][zero_full( $m, 2 )] ); ?></a></td>
								<? } ?>
								<td height="25" align="right" bgcolor="#FFFFFF" style="padding-right:3px"><? echo number_format( $Year[$y] ); ?></td>
							</tr>
							<? } ?>
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
						<? if( $sYe && $sMo ) { ?>
						<table width="99%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td class="main_title_01"><? echo $sYe; ?>년 <? echo zero_full( $sMo, 2 ); ?>월</td>
							</tr>
						</table>
						<table width="99%" border="0" cellpadding="0" cellspacing="1" bgcolor="E6E6E6">
							<tr>
								<td width="80" align="center" class="main_title_02">일</td>
								<td width="80" align="center" class="main_title_02">회원수(%)</td>
								<td align="center" class="main_title_02">그래프</td>
							</tr>
							<? for( $d = 1; $d <= 31; $d++ ) { ?>
							<tr>
								<td height="25" align="center" bgcolor="#FFFFFF"><strong><? echo zero_full( $d, 2 ); ?>일 </strong></td>
								<td align="center" bgcolor="#FFFFFF"><font color="red"><strong><? echo number_format( $Day[$sYe][zero_full( $sMo, 2 )][zero_full( $d, 2 )] ); ?></strong> (<? echo round( 100 * $Day[$sYe][zero_full( $sMo, 2 )][zero_full( $d, 2 )] / $Month[$sYe][zero_full( $sMo, 2 )] ); ?>%)</font></td>
								<td bgcolor="#FFFFFF" style="padding-left:8px; padding-right:8px;">
								<!-- 그래프 통일 -->
									<table width="<? echo round( 100 * $Day[$sYe][zero_full( $sMo, 2 )][zero_full( $d, 2 )] / $Month[$sYe][zero_full( $sMo, 2 )] ) ?>%" border="0" cellspacing="0" cellpadding="0">
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
						<? } else if( $sYe )  { ?>
						<table width="99%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td class="main_title_01"><? echo $sYe; ?>년</td>
							</tr>
						</table>
						<table width="99%" border="0" cellpadding="0" cellspacing="1" bgcolor="E6E6E6">
							<tr>
								<td width="80" align="center" class="main_title_02">월</td>
								<td width="80" align="center" class="main_title_02">회원수(%)</td>
								<td align="center" class="main_title_02">그래프</td>
							</tr>
							<? for ( $m = 1 ; $m <= 12 ; $m++ ) { ?>
							<tr>
								<td height="25" align="center" bgcolor="#FFFFFF"><strong><? echo zero_full( $m, 2 ); ?>월 </strong></td>
								<td align="center" bgcolor="#FFFFFF"><font color="red"><strong><? echo number_format( $Month[$sYe][zero_full( $m, 2 )] ); ?></strong> (<? echo round( 100 * $Month[$sYe][zero_full( $m, 2 )] / $Year[$sYe] ); ?>%)</font></td>
								<td bgcolor="#FFFFFF" style="padding-left:8px; padding-right:8px;">
								<!-- 그래프 통일 -->
									<table width="<? echo round( 100 * $Month[$sYe][zero_full( $m, 2 )] / $Year[$sYe] ) ?>%" border="0" cellspacing="0" cellpadding="0">
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
						<? } else { ?>
						<table width="99%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td class="main_title_01">그래프</td>
							</tr>
						</table>
						<table width="99%" border="0" cellpadding="0" cellspacing="1" bgcolor="E6E6E6">
							<tr>
								<td width="80" align="center" class="main_title_02">년도</td>
								<td width="80" align="center" class="main_title_02">회원수(%)</td>
								<td align="center" class="main_title_02">그래프</td>
							</tr>
							<? for ( $y = 2011 ; $y <= date('Y') ; $y++ ) { ?>
							<tr>
								<td height="25" align="center" bgcolor="#FFFFFF"><strong><? echo $y?>년도 </strong></td>
								<td align="center" bgcolor="#FFFFFF"><font color="red"><strong><? echo number_format( $Year[$y] ); ?></strong> (<? echo round( 100 * $Year[$y] / $Data["total"] ); ?>%)</font></td>
								<td bgcolor="#FFFFFF" style="padding-left:8px; padding-right:8px;">
								<!-- 그래프 통일 -->
									<table width="<? echo round( 100 * $Year[$y] / $Data["total"] ) ?>%" border="0" cellspacing="0" cellpadding="0">
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
						<? } ?>
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