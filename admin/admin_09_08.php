<? include "inc/head.php" ?>
<? include $_SERVER['DOCUMENT_ROOT']."/include/log_analysis.php";?>
<?
$sub_menu = '900800';
auth_check($auth[$sub_menu]);

$pageNum = 9;
$subNum = 8;
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
				<h2><?=$sub_tit2_8?></h2>
				<p class="location">HOME > <?=$sub_tit?> > <strong><?=$sub_tit2_8?></strong></p>
			</div>
			<div class="contentsArea"><!---width:740px--->
				<!--- start : 본문 --->

			<table width="950" border="0" cellspacing="0" cellpadding="0">
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
					<td align="center" bgcolor="#F5F5F5" valign="top">

					<table width="99%" border="10" cellpadding="1" cellspacing="1" >
					<form name="frmMain" method="post" action="<? echo $PHP_SELF; ?>">
					<input type="hidden" name="step" value="next">
					<input type="hidden" name="act" value="">
					<input type="hidden" name="tNum" value="">
						<tr>
							<td align="left"></td>
							<td align="right">
								<input name="keyword" type="text" class="text_basic" value="<? echo $keyword; ?>" style="width:150px;height:19px" itemname="검색어" required>
								<input type="image" src="./img/btn_search.gif" align="absmiddle" style="cursor:pointer;">
							</td>
						</tr>
					</table>
					<br/>

					<table width="99%" border="0" cellpadding="0" cellspacing="1" bgcolor="E6E6E6">
						<tr>
							<td width="45" align="center" class="main_title_02">번호</td>
							<td width="100" align="center" class="main_title_02">관리자 아이디</td>
							<td width="100" align="center" class="main_title_02">메뉴</td>
							<td align="center" class="main_title_02">내용</td>
							<td width="150" align="center" class="main_title_02">처리일자</td>
							<td width="100" align="center" class="main_title_02">ip</td>
						</tr>
						<?
							if( $keyword ) {
								$searchQuery =  "WHERE content LIKE '%".$keyword."%'";
							}
		
							$p = ( !$p ) ? "1" : $p;
							$linenum = ( $linenum ) ? $linenum : "30";
							$startnum = ( $p - 1 ) * $linenum;
							$countQuery = mysql_query( "SELECT * FROM log_analysis ".$searchQuery );
							$count_arr = mysql_num_rows( $countQuery );
							$data_num = $count_arr;
							$viewCount = $data_num - $startnum;
							@$total_page = intval( ( $data_num - 1 ) / $linenum )+1;

							$tmp = 0;

							$sql = "SELECT * FROM log_analysis ".$searchQuery." ORDER BY idx DESC LIMIT $startnum, $linenum";
							$result = mysql_query( $sql );
							while( $list = mysql_fetch_array( $result ) ) {						
						?>
						<tr>
							<td align="center" class="table_ct_01"><? echo $viewCount; ?></td>
							<td align="center" class="table_ct_01"><? echo $list['admin_id']; ?></td>
							<td align="center" class="table_ct_01"><? echo $table_cfg[$list['table_name']]; ?></td>
							<td align="center" class="table_ct_01"><? echo $list['content']; ?> <? echo $act_cfg[$list['act']]; ?></td>
							<td align="center" class="table_ct_01"><? echo $list['reg_date']; ?></td>
							<td align="center" class="table_ct_01"><? echo $list['ip']; ?></td>
						</tr>
						<? 
							$viewCount--;
							} 
						?>
					</table>
					<!-- 페이징 시작 -->
					<table width="99%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td height="50" align="center">
					<? 
						$get_val = "keyword=".$keyword;
						include $_SERVER['DOCUMENT_ROOT']."/include/page.php";
					?>
							</td>
						</tr>
					</table><!-- 페이징 끝 -->

					</td>
					<td background="./img/ct_box_right.gif"></td>
				</tr>
				<tr>
					<td height="5"><img src="./img/ct_box_left_bottom.gif" width="5" height="5"></td>
					<td background="./img/ct_box_bottom.gif"></td>
					<td><img src="./img/ct_box_right_bottom.gif" width="5" height="5"></td>
				</tr>
					</form>
			</table>

				<!--- end : 본문 --->
			</div>
		</div><div class="clr"></div>
	</div>
	<? include "inc/bottom.php" ?>
</div>
</body>
</html>