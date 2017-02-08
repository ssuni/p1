<? include "inc/head.php" ?>
<?
$sub_menu = '900600';
auth_check($auth[$sub_menu]);

$pageNum = 9;
$subNum = 6;
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
				<h2><?=$sub_tit2_6?></h2>
				<p class="location">HOME > <?=$sub_tit?> > <strong><?=$sub_tit2_6?></strong></p>
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

// 검색어별

$arr_end	= explode("-", $edate);
$etime		= mktime(0, 0, 0, $arr_end[1], $arr_end[2]+1, $arr_end[0]);
$start		= $sdate;
$end		= date("Y-m-d", $etime) ; 
$sSelQuery	= " SELECT * FROM tblStatistics ";
$sSelQuery	.= " WHERE statistics_date BETWEEN '{$start}' AND '{$end}' ";
$rSelQuery	= @mysql_query($sSelQuery);
while ( $aSelQuery = @mysql_fetch_array($rSelQuery) ){
	if ( fnGetKeyword($aSelQuery["statistics_refer"]) == "" ){
		$arrKeyword["북마크"]++;
	}else{
		$arrKeyword[fnGetKeyword($aSelQuery["statistics_refer"])]++;
	}
}
@arsort($arrKeyword);


?><script src="/js/calender.js" language="javascript"></script>

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
								<td class="main_title_01">검색어별</td>
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
								<input type="text" name="sdate" id="sdate" value="<?=$sdate?>" class="text_basic" style="width:80px;height:20px;cursor:pointer;"onclick="check_mouse('frmMain.'+this.name)" readonly >
								부터 
								<input type="text" name="edate" id="edate" value="<?=$edate?>" class="text_basic" style="width:80px;height:20px;cursor:pointer;"onclick="check_mouse('frmMain.'+this.name)" readonly >
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
								<td class="main_title_01">검색어별 접속 현황 </td>
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
							<? if ( is_array( $arrKeyword ) ) { ?>
							<? $tmp_max	= max($arrKeyword); ?>
							<? foreach ( $arrKeyword as $key => $val ) { ?>
							<tr>
								<td width="135" class="left_8"><?=$key?></td>
								<td width="60" height="30" align="center" bgcolor="#E6E6E6"><?=$val?></td>
								<td class="left_8">
								<!-- 일요일 그래프 아래 테이블 %를 조절하면 됩니다.  -->
									<table width="<?=(100*$val/$tmp_max)?>%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="4"><img src="./img/chart_left_02.gif" width="4" height="16"></td>
											<td height="16" bgcolor="#0053A9"><img src="./img/ghost.gif" width="1" height="1"></td>
											<td width="9"><img src="./img/chart_right_02.gif" width="9" height="16"></td>
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