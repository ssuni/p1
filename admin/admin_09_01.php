<? include "inc/head.php" ?>
<?
$sub_menu = '900100';
auth_check($auth[$sub_menu]);

$pageNum = 9;
$subNum = 1;
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
				<h2><?=$sub_tit2_1?></h2>
				<p class="location">HOME > <?=$sub_tit?> > <strong><?=$sub_tit2_1?></strong></p>
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
		$Data["total"]++;

		// 성별 계산
		switch( $Array["tblStrSex"] ) {
			case "M" : $Sex["M"]++; break;
			case "F" : $Sex["F"]++; break;
			default : $Sex["M"]++; break;
		}

		// 나이별 계산
		if( $Array["tblIntAge"] <= 10 ) {
			$Age["10"]++;
		} else if( $Array["tblIntAge"] <= 20 ) {
			$Age["20"]++;
		} else if( $Array["tblIntAge"] <= 30 ) {
			$Age["30"]++;
		} else if( $Array["tblIntAge"] <= 40 ) {
			$Age["40"]++;
		} else if( $Array["tblIntAge"] <= 50 ) {
			$Age["50"]++;
		} else if( $Array["tblIntAge"] <= 60 ) {
			$Age["60"]++;
		} else {
			$Age["70"]++;
		}

		// 지역별 계산
		$FirAddr[$Array["tblIntFirAddr"]]++;
	}
?>
<script src="/include/calender.js" language="javascript"></script>

<form name="frmMain" method="post" action="" style="margin:0px;" onsubmit="return false;">
<input type="hidden" name="proc" value="">			
			<!-- 검색결과 시작 -->
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
								<td class="main_title_01">성별</td>
							</tr>
						</table>
						<table width="99%" border="0" cellpadding="0" cellspacing="1" bgcolor="E6E6E6">
							<tr>
								<td width="80" align="center" class="main_title_02">성별</td>
								<td width="80" align="center" class="main_title_02">회원수(%)</td>
								<td align="center" class="main_title_02">그래프</td>
							</tr>
							<tr>
								<td height="25" align="center" bgcolor="#FFFFFF"><strong>남 </strong></td>
								<td align="center" bgcolor="#FFFFFF"><font color="red"><strong><? echo number_format( $Sex["M"] ); ?></strong> (<? echo round( 100 * $Sex["M"] / $Data["total"] ); ?>%)</font></td>
								<td bgcolor="#FFFFFF" style="padding-left:8px; padding-right:8px;">
								<!-- 그래프 통일 -->
									<table width="<? echo round( 100 * $Sex["M"] / $Data["total"] ) ?>%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="4"><img src="./img/chart_left_02.gif" width="4" height="16"></td>
											<td height="16" bgcolor="#0053A9"><img src="./img/ghost.gif" width="1" height="1"></td>
											<td width="9"><img src="./img/chart_right_02.gif" width="9" height="16"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="25" align="center" bgcolor="#FFFFFF"><strong>여 </strong></td>
								<td align="center" bgcolor="#FFFFFF"><font color="red"><strong><? echo number_format( $Sex["F"] ); ?></strong> (<? echo round( 100 * $Sex["F"] / $Data["total"] ); ?>%)</font></td>
								<td bgcolor="#FFFFFF" style="padding-left:8px; padding-right:8px;">
								<!-- 그래프 통일 -->
									<table width="<? echo round( 100 * $Sex["F"] / $Data["total"] ) ?>%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="4"><img src="./img/chart_left_02.gif" width="4" height="16"></td>
											<td height="16" bgcolor="#0053A9"><img src="./img/ghost.gif" width="1" height="1"></td>
											<td width="9"><img src="./img/chart_right_02.gif" width="9" height="16"></td>
										</tr>
									</table>
								</td>
							</tr>
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
								<td class="main_title_01">연령별</td>
							</tr>
						</table>
						<table width="99%" border="0" cellpadding="0" cellspacing="1" bgcolor="E6E6E6">
							<tr>
								<td width="80" align="center" class="main_title_02">연령</td>
								<td width="80" align="center" class="main_title_02">회원수(%)</td>
								<td align="center" class="main_title_02">그래프</td>
							</tr>
							<? 
								for( $a = 10; $a <= 70; $a += 10 ) { 
									$ageTxt = ( $a > 60 ) ? $a."세 이상" : $a."세 이하";
							?>
							<tr>
								<td height="25" align="center" bgcolor="#FFFFFF"><strong><? echo $ageTxt; ?> </strong></td>
								<td align="center" bgcolor="#FFFFFF"><font color="red"><strong><? echo number_format( $Age[$a] ); ?></strong> (<? echo round( 100 * $Age[$a] / $Data["total"] ); ?>%)</font></td>
								<td bgcolor="#FFFFFF" style="padding-left:8px; padding-right:8px;">
								<!-- 그래프 통일 -->
									<table width="<? echo round( 100 * $Age[$a] / $Data["total"] ) ?>%" border="0" cellspacing="0" cellpadding="0">
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
			</table>
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
								<td class="main_title_01">지역별</td>
							</tr>
						</table>
						<table width="99%" border="0" cellpadding="0" cellspacing="1" bgcolor="E6E6E6">
							<tr>
								<td width="80" align="center" class="main_title_02">지역</td>
								<td width="80" align="center" class="main_title_02">회원수(%)</td>
								<td align="center" class="main_title_02">그래프</td>
							</tr>
							<? 
								for( $f = 0; $f < count( $placeArr ); $f++ ) { 
									$placeTxt = ( $f == 0 ) ? "기타" : $placeArr[$f];
							?>
							<tr>
								<td height="25" align="center" bgcolor="#FFFFFF"><strong><? echo $placeTxt; ?> </strong></td>
								<td align="center" bgcolor="#FFFFFF"><font color="red"><strong><? echo number_format( $FirAddr[$f] ); ?></strong> (<? echo round( 100 * $FirAddr[$f] / $Data["total"] ); ?>%)</font></td>
								<td bgcolor="#FFFFFF" style="padding-left:8px; padding-right:8px;">
								<!-- 그래프 통일 -->
									<table width="<? echo round( 100 * $FirAddr[$f] / $Data["total"] ) ?>%" border="0" cellspacing="0" cellpadding="0">
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