<? include "inc/head.php" ?>
<?
$sub_menu = '900700';
auth_check($auth[$sub_menu]);

$pageNum = 9;
$subNum = 7;
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
				<h2><?=$sub_tit2_7?></h2>
				<p class="location">HOME > <?=$sub_tit?> > <strong><?=$sub_tit2_7?></strong></p>
			</div>
			<div class="contentsArea"><!---width:740px--->
				<!--- start : 본문 --->
<?
$proc	= trim($_POST["proc"]);
$sdate	= ( trim($_POST["sdate"]) != "" ) ? trim($_POST["sdate"]) : date("Y") . "-" . date("m") . "-" . date("d") ;
$edate	= ( trim($_POST["edate"]) != "" ) ? trim($_POST["edate"]) : date("Y") . "-" . date("m") . "-" . date("d") ;

$arrWeek= Array(
	"<font color=\"#FF0000\">日</font>", 
	"<font color=\"#000000\">月</font>", 
	"<font color=\"#000000\">火</font>", 
	"<font color=\"#000000\">水</font>", 
	"<font color=\"#000000\">木</font>", 
	"<font color=\"#000000\">金</font>", 
	"<font color=\"#0000FF\">土</font>", 
);




// 일별
$arr_start	= explode("-", $sdate);
$arr_end	= explode("-", $edate);
$stime		= mktime(0, 0, 0, $arr_start[1], $arr_start[2], $arr_start[0]);
$etime		= mktime(0, 0, 0, $arr_end[1], $arr_end[2], $arr_end[0]);
$nTmpDate	= 0;
for ( $i = $stime ; $i <= $etime ; $i += 86400 ) {
	$tmp_date	= date("Y-m-d", $i);
	$tmp_week	= date("w", $i);
	$sDQuery	= " SELECT COUNT(*) FROM tblStatistics ";
	$sDQuery	.= " WHERE statistics_date LIKE '{$tmp_date}%'";
	$rDQuery	= @mysql_query($sDQuery);
	$aDQuery	= @mysql_fetch_row($rDQuery);
	$arrDate[$nTmpDate]	= Array(
		"date"	=> $tmp_date, 
		"week"	=> $tmp_week, 
		"count"	=> $aDQuery[0], 
	);
	$arrTmp[$nTmpDate]	= $aDQuery[0];
	$nTmpDate++;
}

// 요일별
for ( $i = 0 ; $i < 7 ; $i++ ) {
	$sWQuery	= " SELECT COUNT(*) FROM tblStatistics ";
	$sWQuery	.= " WHERE statistics_week = '{$i}' ";
	$sWQuery	.= " AND statistics_date BETWEEN '{$sdate} 00:00:00' AND '{$edate} 23:59:59' ";
	$rWQuery	= @mysql_query($sWQuery);
	$aWQuery	= @mysql_fetch_row($rWQuery);
	echo mysql_error();
	$week_counter[$i]	= $aWQuery[0];
}


?>
<script src="/js/calender.js" language="javascript"></script>

<script>
function fnSearch(){
	var f_oForm	= document.forms["frmMain"];
	if ( f_oForm.sdate.value == "" ){
		alert("시작일을 지정하십시오");
		return;
	}
	if ( f_oForm.edate.value == "" ){
		alert("종료일을 지정하십시오");
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
								<td class="main_title_01">기간별</td>
							</tr>
						</table>
						<!-- 검색 테이블 입니다. -->
						<table width="99%" border="0" cellpadding="0" cellspacing="1" bgcolor="E6E6E6">
							<tr>
								<td align="center" class="main_title_02">기간을 설정 하여 주세요.</td>
							</tr>
							<tr>
								<td height="35" bgcolor="#FFFFFF" class="left_8">
								
								<!-- 상세구분 -->
								<input type="text" name="sdate" id="sdate" value="<?=$sdate?>" class="text_basic" style="width:80px;height:20px;cursor:pointer;" onclick="check_mouse('frmMain.'+this.name)" readonly >
								부터 
								<input type="text" name="edate" id="edate" value="<?=$edate?>" class="text_basic" style="width:80px;height:20px;cursor:pointer;" onclick="check_mouse('frmMain.'+this.name)" readonly >
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

			<?
			$arr_img	= array("1", "5", "5", "5", "5", "5", "3");
			$tmp_color	= array("#A90000", "#555555", "#555555", "#555555", "#555555", "#555555", "#0053A9");	
			?>
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
								<td class="main_title_01"><font color="FF4E00">요일별 접속 현황</font></td>
							</tr>
						</table>
						<!-- 검색 테이블 입니다. -->
						<table width="751" height="195" border="0" cellpadding="0" cellspacing="1" background="./img/gr_bg.gif" bgcolor="E6E6E6">
							<tr>
								<? $tmp_max	= max($week_counter);?>
								<? for ( $i = 0 ; $i < 7 ; $i++ ) { ?>
								<td width="107" align="center" valign="bottom">
								<!-- 그래프 일요일 --><?=$week_counter[$i]?>명
									<table border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td><img src="./img/chart_top_0<?=$arr_img[$i]?>.gif" ></td>
										</tr>
										<tr>
											<td bgcolor="<?=$tmp_color[$i]?>" height="<?=(120 * $week_counter[$i] / $tmp_max )?>"></td>
										</tr>
										<tr>
											<td><img src="./img/chart_bottom_0<?=$arr_img[$i]?>.gif" width="54" height="6"></td>
										</tr>
									</table>
								<!-- 그래프 일요일 끝-->
								</td>
								<? } ?>
							</tr>
						</table>
						<table width="751" border="0" cellpadding="0" cellspacing="1" bgcolor="E6E6E6">
							<tr>
								<? $color_arr	= Array("#FF0000", "#000000", "#000000", "#000000", "#000000", "#000000", "#0000FF");?>
								<? for ( $i = 0 ; $i < 7 ; $i++ ) { ?>
								<? $bgcolor	= ( $i % 2 == 1 ) ? "#FFFFFF" : "#F7F7F7" ; ?>
								<td width="107" height="30" align="center" bgcolor="#F7F7F7"><?=$arrWeek[$i]?></td>
								<? } ?>
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
								<td class="main_title_01">일별 접속 현황 </td>
							</tr>
						</table>
						<table width="99%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td height="1" colspan="3" class="board-view_title_line"></td>
							</tr>
							<tr>
								<td height="1"></td>
								<td height="1"></td>
								<td height="1"></td>
							</tr>
							<? $arr_img	= array("1", "3", "3", "3", "3", "3", "2"); ?>
							<? $tmp_max	= max($arrTmp); ?>
							<? for ( $i = 0 ; $i < $nTmpDate ; $i++ ) { ?>
							<tr>
								<td width="135" class="left_8"><a href="sub_08_01.php?proc=search&date=<?=$arrDate[$i]["date"]?>"><?=$arrDate[$i]["date"]?></a> ( <?=$arrWeek[$arrDate[$i]["week"]]?> ) </td>
								<td width="60" height="30" align="center" bgcolor="#E6E6E6"><?=$arrDate[$i]["count"]?></td>
								<td class="left_8">
								<!-- 일요일 그래프 아래 테이블 %를 조절하면 됩니다.  -->
									<table width="<?=(100*$arrDate[$i]["count"]/$tmp_max)?>%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="4"><img src="./img/chart_left_0<?=$arr_img[$arrDate[$i]["week"]]?>.gif" width="4" height="16"></td>
											<td height="16" bgcolor="<?=$tmp_color[$arrDate[$i]["week"]]?>"><img src="./img/ghost.gif" width="1" height="1"></td>
											<td width="9"><img src="./img/chart_right_0<?=$arr_img[$arrDate[$i]["week"]]?>.gif" width="9" height="16"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="1" class="board-view_title_line"></td>
								<td height="1"></td>
								<td height="1" class="board-view_title_line"></td>
							</tr>
							<? } ?>
							<tr>
								<td height="1" colspan="3" class="board-view_title_line"></td>
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
				<tr height="12"><td></td></tr>
			</table>
			<form>
				<!--- end : 본문 --->
			</div>
		</div><div class="clr"></div>
	</div>
	<? include "inc/bottom.php" ?>
</div>
</body>
</html>