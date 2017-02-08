<? include "inc/head.php" ?>
<?
$pageNum = 1;
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
<?	// 관리자가 아닐때는 권한 제한
	if( $_SESSION["ss_level"] > 1 ) {
		echo "<script language='javascript'>";
		echo "	alert('[".$memberNameArr[$_SESSION["ss_level"]]."]님은 이용이 제한되었습니다.');";
		echo "	history.go(-1);";
		echo "</script>";
		exit;
	}

	$Data["id"]			= $_SESSION["ss_id"];
	$Query = "SELECT * FROM tblAdminMember WHERE tblStrID='".$Data["id"]."'";
	$Sql = mysql_query( $Query );
	$Array = mysql_fetch_array( $Sql );
	$Data["name"]		= $Array["tblStrName"];
	$Data["email"]		= $Array["tblStrEmail"];
	$Data["phone"]		= $Array["tblStrPhone"];
	$Data["mobile"]		= $Array["tblStrMobile"];	?>
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
					<!-- 관리자 기본정보 폼 -->
					<table width="99%" border="0" cellspacing="0" cellpadding="0">
					<form name="nameFrm" method="post" action="proc/adconfig_edit_proc.php">
					<input type="hidden" name="act" value="bic">
					<input type="hidden" name="step" value="next">
					<input type="hidden" name="url" value="<?=$PHP_SELF?>">
						<tr>
							<td class="main_title_01">관리자 기본정보 변경</td>
						</tr>
					</table>
					<table width="99%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td height="1" colspan="2" class="board-view_title_line"></td>
						</tr>
						<tr>
							<td height="1"></td>
							<td height="1"></td>
						</tr>
						<tr>
							<td width="140" height="30" class="board-write_content_name"><img src="./img/sub_dot.gif"align="absmiddle">관리자 이름</td>
							<td class="left_8">
							<input class="text_basic" style="width:200px; height:20px;" name="strName" type="text" value="<? echo $Data["name"]; ?>"><b> ※</b> 게시판 작성시 기본 이름으로 사용됩니다. </td>
						</tr>
						<tr>
							<td height="1"></td>
							<td height="1" class="board-view_title_line"></td>
						</tr>
						<tr>
							<td height="30" class="board-write_content_name"><img src="./img/sub_dot.gif"align="absmiddle">관리자 이메일</td>
							<td class="left_8"><input class="text_basic" style="width:200px; height:20px;" name="strEmail" value="<? echo $Data["email"]; ?>"><b> ※</b> 게시판 작성 / 메일 발송시 기본 이메일로 사용됩니다. </td>
						</tr>
						<tr>
							<td height="1"></td>
							<td height="1" class="board-view_title_line"></td>
						</tr>
						<tr>
							<td height="30" class="board-write_content_name"><img src="./img/sub_dot.gif"align="absmiddle">관리자 전화번호</td>
							<td class="left_8">
							<input class="text_basic" style="width:200px; height:20px;" name="strPhone" value="<? echo $Data["phone"]; ?>"><b> ※</b> 병원 전화번호로 사용됩니다.</td>
						</tr>
						<tr>
							<td height="1"></td>
							<td height="1" class="board-view_title_line"></td>
						</tr>
						<tr>
							<td height="30" class="board-write_content_name"><img src="./img/sub_dot.gif"align="absmiddle">관리자 휴대전화</td>
							<td class="left_8">
							<input class="text_basic" style="width:200px; height:20px;" name="strMobile" value="<? echo $Data["mobile"]; ?>"><b> ※</b> SMS 전화번호로 사용됩니다.</td>
						</tr>
						<tr>
							<td height="1"></td>
							<td height="1"></td>
						</tr>
						<tr>
							<td height="1" colspan="2" class="board-view_title_line"></td>
						</tr>
					</table>
					<!-- 관리자 기본정보 폼 끝 -->
					<table width="99%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td height="30" align="center"><input type="image" src="./img/btn_modify_ok_01.gif" width="60" height="18" style="cursor:pointer;"></td>
						</tr>
					</form>
					</table></td>
					<td background="./img/ct_box_right.gif"></td>
				</tr>
				<tr>
					<td height="5"><img src="./img/ct_box_left_bottom.gif" width="5" height="5"></td>
					<td background="./img/ct_box_bottom.gif"></td>
					<td><img src="./img/ct_box_right_bottom.gif" width="5" height="5"></td>
				</tr>
			</table>
			<!-- 관리자 기본정보 변경 끝 -->
			<!-- 관리자 비밀번호 변경 변경 -->
			<table width="99%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="5"><img src="./img/ct_box_left_top.gif" width="5" height="5"></td>
					<td background="./img/ct_box_top.gif"></td>
					<td width="5"><img src="./img/ct_box_right_top.gif" width="5" height="5"></td>
				</tr>
				<tr>
					<td background="./img/ct_box_left.gif"></td>
					<td align="center" bgcolor="#F5F5F5">
					<!-- 관리자 비밀번호 변경 폼 -->
					<table width="99%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td class="main_title_01">관리자 비밀번호 변경</td>
						</tr>
					</table>
					<table width="99%" border="0" cellpadding="0" cellspacing="0">
					<form name="passFrm" method="post" action="proc/adconfig_edit_proc.php">
					<input type="hidden" name="act" value="pass">
					<input type="hidden" name="step" value="next">
					<input type="hidden" name="url" value="<?=$PHP_SELF?>">
						<tr>
							<td height="1" colspan="2" class="board-view_title_line"></td>
						</tr>
						<tr>
							<td height="1"></td>
							<td height="1"></td>
						</tr>
						<tr>
							<td width="140" height="30" class="board-write_content_name"><img src="./img/sub_dot.gif"align="absmiddle">현재 비밀번호</td>
							<td class="left_8"><input class="text_basic" style="width:200px; height:20px;" name="strPass" type="password" itemname="현재비밀번호" required></td>
						</tr>
						<tr>
							<td height="1"></td>
							<td height="1" class="board-view_title_line"></td>
						</tr>
						<tr>
							<td height="30" class="board-write_content_name"><img src="./img/sub_dot.gif"align="absmiddle">변경할 비밀번호</td>
							<td class="left_8"><input name="strPass1" type="password" class="text_basic" style="width:200px; height:20px;" itemname="변경할 비밀번호" required></td>
						</tr>
						<tr>
							<td height="1"></td>
							<td height="1" class="board-view_title_line"></td>
						</tr>
						<tr>
							<td height="30" class="board-write_content_name"><img src="./img/sub_dot.gif"align="absmiddle">변경할 비밀번호 확인</td>
							<td class="left_8"><input class="text_basic" style="width:200px; height:20px;" name="strPass2" type="password" itemname="변경할 비밀번호 확인" required></td>
						</tr>
						<tr>
							<td height="1"></td>
							<td height="1"></td>
						</tr>
						<tr>
							<td height="1" colspan="2" class="board-view_title_line"></td>
						</tr>
					</table>
					<table width="99%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td height="30" align="center"><input type="image" src="./img/btn_modify_ok_01.gif" width="60" height="18" style="cursor:pointer;"></td>
						</tr>
					</form>
					</table>
					<!-- 관리자 비밀번호 변경 폼 끝 -->
					</td>
					<td background="./img/ct_box_right.gif"></td>
				</tr>
				<tr>
					<td height="5"><img src="./img/ct_box_left_bottom.gif" width="5" height="5"></td>
					<td background="./img/ct_box_bottom.gif"></td>
					<td><img src="./img/ct_box_right_bottom.gif" width="5" height="5"></td>
				</tr>
			</table>
<script language="javascript" src="/js/wrest.js"></script>
				<!--- end : 본문 --->
			</div>
		</div><div class="clr"></div>
	</div>
	<? include "inc/bottom.php" ?>
</div>
</body>
</html>