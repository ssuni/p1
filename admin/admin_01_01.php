<? include "inc/head.php" ?>
<?
$pageNum = 1;
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
<?	// 관리자가 아닐때는 권한 제한
	if( $_SESSION["ss_level"] > 1 ) {
		echo "<script language='javascript'>";
		echo "	alert('[".$memberNameArr[$_SESSION["ss_level"]]."]님은 이용이 제한되었습니다.');";
		echo "	history.go(-1);";
		echo "</script>";
		exit;
	}

	$Query = "SELECT * FROM tblBasicConfig LIMIT 1";
	$Sql = mysql_query( $Query );
	$Array = mysql_fetch_array( $Sql );

	$Data["header"]			= $Array["tblHeader"];
	$Data["title"]			= stripslashes( $Array["tblTitle"] );
	$Data["keyword"]		= $Array["tblKeyword"];
	$Data["clauses"]		= stripslashes( $Array["tblClauses"] );
	$Data["consent1"]		= stripslashes( $Array["tblConsent1"] );
	$Data["consent2"]		= stripslashes( $Array["tblConsent2"] );
	$Data["consent3"]		= stripslashes( $Array["tblConsent3"] );
	$Data["consent4"]		= stripslashes( $Array["tblConsent4"] );
	$Data["rejection"]	= $Array["tblRejection"];
	$Data["smsid"]			= $Array["tblSmsid"];
	$Data["smspass"]		= $Array["tblSmspass"];
	$Data["smsurl"]			= $Array["tblSmsurl"];
	$Data["smscnt"]			= $Array["tblSmscnt"];
	$Data["nid_ClientID"]			= $Array["nid_ClientID"];
	$Data["nid_ClientSecret"]			= $Array["nid_ClientSecret"];
	$Data["fb_appId"]			= $Array["fb_appId"];
	$Data["fb_secret"]			= $Array["fb_secret"];
	$Data["m_fb_appId"]			= $Array["m_fb_appId"];
	$Data["m_fb_secret"]			= $Array["m_fb_secret"];
	$Data["kakao_secret"]			= $Array["kakao_secret"];
?>
			<form name="confFrm" method="post" action="proc/config_edit_proc.php">
			<input type="hidden" name="act" value="edit">
			<input type="hidden" name="step" value="next">
			<input type="hidden" name="url" value="<?=$PHP_SELF?>">
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
					<!-- 예약 처리 대상자-->
					<table width="99%" border="0" cellpadding="0" cellspacing="1" bgcolor="E6E6E6">
						<tr>
							<td align="center" class="main_title_02">타이틀 문구 설정</td>
						</tr>
						<tr>
							<td height="25" align="center" bgcolor="#FFFFFF"><table width="97%" border="0" cellspacing="0" cellpadding="0">
								<tr valign="top">
									<td height="8"></td>
								</tr>
								<tr valign="top">
									<td height="90" background="./img/homepage_title_ment_01.gif" style="background-repeat:no-repeat"><table valign="top" width="100%" height="20" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td align="left" style="padding-left:22px;"><font color="white"><? echo $Data["title"]; ?></font></td>
										</tr>
									</table></td>
								</tr>
								<tr>
									<td class="font_11">- 아래 박스에 변경하시고자 하는 <strong>타이틀명을 입력후 변경 버튼</strong>을 누르세요. </td>
								</tr>
								<tr>
									<td height="33"><textarea name="strTitle" style="width:100%;height:24px;background-color:#f0f0f0;"><? echo $Data["title"]; ?></textarea></td>
								</tr>
							</table></td>
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
			<p class="btn_area"><img src="./img/btn_modify_ok_01.gif" width="60" height="18" style="cursor:pointer;" onClick="submitContents(this);"></p>

			<!-- 키워드 설정 -->
			<table width="99%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="5"><img src="./img/ct_box_left_top.gif" width="5" height="5"></td>
					<td background="./img/ct_box_top.gif"></td>
					<td width="5"><img src="./img/ct_box_right_top.gif" width="5" height="5"></td>
				</tr>
				<tr>
					<td background="./img/ct_box_left.gif"></td>
					<td align="center" bgcolor="#F5F5F5" class="top_5"><table width="99%" border="0" cellpadding="0" cellspacing="1" bgcolor="E6E6E6">
						<tr>
							<td align="center" class="main_title_02">검색 키워드 설정</td>
						</tr>
						<tr>
							<td height="25" align="center" bgcolor="#FFFFFF"><table width="97%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td height="25" class="font_11">- 아래 박스에 변경하시고자 하는 <strong>검색키워드를(을) 입력후 변경 버튼</strong>을 누르세요. </td>
								</tr>
								<tr>
									<td height="33" valign="top"><input style="width:100%;height:24px;background-color:#f0f0f0;" name="strKeyword" type="text" value="<? echo $Data["keyword"]; ?>" /></td>
								</tr>
							</table></td>
						</tr>
					</table>
					</td>
					<td background="./img/ct_box_right.gif"></td>
				</tr>
				<tr>
					<td height="5"><img src="./img/ct_box_left_bottom.gif" width="5" height="5"></td>
					<td background="./img/ct_box_bottom.gif"></td>
					<td><img src="./img/ct_box_right_bottom.gif" width="5" height="5"></td>
				</tr>
			</table>
			<p class="btn_area"><img src="./img/btn_modify_ok_01.gif" width="60" height="18" style="cursor:pointer;" onClick="submitContents(this);"></p>
			<!-- 키워드 설정 끝-->
			<!-- 이용약관 설정 -->
			<table width="99%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="5"><img src="./img/ct_box_left_top.gif" width="5" height="5"></td>
					<td background="./img/ct_box_top.gif"></td>
					<td width="5"><img src="./img/ct_box_right_top.gif" width="5" height="5"></td>
				</tr>
				<tr>
					<td background="./img/ct_box_left.gif"></td>
					<td align="center" bgcolor="#F5F5F5" class="top_5"><table width="99%" border="0" cellpadding="0" cellspacing="1" bgcolor="E6E6E6">
						<tr>
							<td align="center" class="main_title_02">이용약관</td>
						</tr>
						<tr>
							<td height="25" align="center" bgcolor="#FFFFFF"><table width="97%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td height="33" valign="top" class="top_5_bottom_5">
										<textarea name="ir1" id="ir1" rows="5" cols="100" style="width:100%; height:200px; display:none;"><? echo $Data["clauses"]; ?></textarea>
										<p style="display:none"><textarea name="strClauses" id="strClauses" style="width:100%;height:100px;background-color:#f0f0f0;"><? echo $Data["clauses"]; ?></textarea></p>
									</td>
								</tr>
							</table></td>
						</tr>
					</table>
					</td>
					<td background="./img/ct_box_right.gif"></td>
				</tr>
				<tr>
					<td height="5"><img src="./img/ct_box_left_bottom.gif" width="5" height="5"></td>
					<td background="./img/ct_box_bottom.gif"></td>
					<td><img src="./img/ct_box_right_bottom.gif" width="5" height="5"></td>
				</tr>
			</table>
			<p class="btn_area"><img src="./img/btn_modify_ok_01.gif" width="60" height="18" style="cursor:pointer;" onClick="submitContents(this);"></p>
			<!-- 이용약관 설정 끝-->

			<!-- 개인정보의 수집 및 이용목적 설정 -->
			<table width="99%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="5"><img src="./img/ct_box_left_top.gif" width="5" height="5"></td>
					<td background="./img/ct_box_top.gif"></td>
					<td width="5"><img src="./img/ct_box_right_top.gif" width="5" height="5"></td>
				</tr>
				<tr>
					<td background="./img/ct_box_left.gif"></td>
					<td align="center" bgcolor="#F5F5F5" class="top_5"><table width="99%" border="0" cellpadding="0" cellspacing="1" bgcolor="E6E6E6">
						<tr>
							<td align="center" class="main_title_02">개인정보의 수집 및 이용목적</td>
						</tr>
						<tr>
							<td height="25" align="center" bgcolor="#FFFFFF"><table width="97%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="top_5_bottom_5">
										<textarea name="ir2" id="ir2" rows="5" cols="100" style="width:100%; height:200px; display:none;"><? echo $Data["consent1"]; ?></textarea>
										<p style="display:none"><textarea name="strConsent1" id="strConsent1" style="width:100%;height:100px;background-color:#f0f0f0;"><? echo $Data["consent1"]; ?></textarea></p>
								</tr>
							</table></td>
						</tr>
					</table>
					</td>
					<td background="./img/ct_box_right.gif"></td>
				</tr>
				<tr>
					<td height="5"><img src="./img/ct_box_left_bottom.gif" width="5" height="5"></td>
					<td background="./img/ct_box_bottom.gif"></td>
					<td><img src="./img/ct_box_right_bottom.gif" width="5" height="5"></td>
				</tr>
			</table>
			<p class="btn_area"><img src="./img/btn_modify_ok_01.gif" width="60" height="18" style="cursor:pointer;" onClick="submitContents(this);"></p>
			<!-- 개인정보보호정책 설정 끝-->

			<!-- 개인정보의 수집항목 및 방법 -->
			<table width="99%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="5"><img src="./img/ct_box_left_top.gif" width="5" height="5"></td>
					<td background="./img/ct_box_top.gif"></td>
					<td width="5"><img src="./img/ct_box_right_top.gif" width="5" height="5"></td>
				</tr>
				<tr>
					<td background="./img/ct_box_left.gif"></td>
					<td align="center" bgcolor="#F5F5F5" class="top_5"><table width="99%" border="0" cellpadding="0" cellspacing="1" bgcolor="E6E6E6">
						<tr>
							<td align="center" class="main_title_02">개인정보의 수집항목 및 방법</td>
						</tr>
						<tr>
							<td height="25" align="center" bgcolor="#FFFFFF"><table width="97%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="top_5_bottom_5">
										<textarea name="ir3" id="ir3" rows="5" cols="100" style="width:100%; height:200px; display:none;"><? echo $Data["consent2"]; ?></textarea>
										<p style="display:none"><textarea name="strConsent2" id="strConsent2" style="width:100%;height:100px;background-color:#f0f0f0;"><? echo $Data["consent2"]; ?></textarea></p>
									</td>
								</tr>
							</table></td>
						</tr>
					</table>
					</td>
					<td background="./img/ct_box_right.gif"></td>
				</tr>
				<tr>
					<td height="5"><img src="./img/ct_box_left_bottom.gif" width="5" height="5"></td>
					<td background="./img/ct_box_bottom.gif"></td>
					<td><img src="./img/ct_box_right_bottom.gif" width="5" height="5"></td>
				</tr>
			</table>
			<p class="btn_area"><img src="./img/btn_modify_ok_01.gif" width="60" height="18" style="cursor:pointer;" onClick="submitContents(this);"></p>
			<!-- 개인정보의 수집항목 및 방법 끝-->

			<!-- 개인정보의 보유 및 이용기간 -->
			<table width="99%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="5"><img src="./img/ct_box_left_top.gif" width="5" height="5"></td>
					<td background="./img/ct_box_top.gif"></td>
					<td width="5"><img src="./img/ct_box_right_top.gif" width="5" height="5"></td>
				</tr>
				<tr>
					<td background="./img/ct_box_left.gif"></td>
					<td align="center" bgcolor="#F5F5F5" class="top_5"><table width="99%" border="0" cellpadding="0" cellspacing="1" bgcolor="E6E6E6">
						<tr>
							<td align="center" class="main_title_02">개인정보의 보유 및 이용기간</td>
						</tr>
						<tr>
							<td height="25" align="center" bgcolor="#FFFFFF"><table width="97%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="top_5_bottom_5">
										<textarea name="ir4" id="ir4" rows="5" cols="100" style="width:100%; height:200px; display:none;"><? echo $Data["consent3"]; ?></textarea>
										<p style="display:none"><textarea name="strConsent3" id="strConsent3" style="width:100%;height:100px;background-color:#f0f0f0;"><? echo $Data["consent3"]; ?></textarea></p>
									</td>
								</tr>
							</table></td>
						</tr>
					</table>
					</td>
					<td background="./img/ct_box_right.gif"></td>
				</tr>
				<tr>
					<td height="5"><img src="./img/ct_box_left_bottom.gif" width="5" height="5"></td>
					<td background="./img/ct_box_bottom.gif"></td>
					<td><img src="./img/ct_box_right_bottom.gif" width="5" height="5"></td>
				</tr>
			</table>
			<p class="btn_area"><img src="./img/btn_modify_ok_01.gif" width="60" height="18" style="cursor:pointer;" onClick="submitContents(this);"></p>
			<!-- 개인정보의 보유 및 이용기간 끝-->

			<!-- 개인정보처리(취급)방침 -->
			<table width="99%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="5"><img src="./img/ct_box_left_top.gif" width="5" height="5"></td>
					<td background="./img/ct_box_top.gif"></td>
					<td width="5"><img src="./img/ct_box_right_top.gif" width="5" height="5"></td>
				</tr>
				<tr>
					<td background="./img/ct_box_left.gif"></td>
					<td align="center" bgcolor="#F5F5F5" class="top_5"><table width="99%" border="0" cellpadding="0" cellspacing="1" bgcolor="E6E6E6">
						<tr>
							<td align="center" class="main_title_02">개인정보처리(취급)방침</td>
						</tr>
						<tr>
							<td height="25" align="center" bgcolor="#FFFFFF">FTP접속 후 수동변경 /member/text_privacy_all1.html ~ /member/text_privacy_all3.html<!--<table width="97%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="top_5_bottom_5">
										<textarea name="ir5" id="ir5" rows="5" cols="100" style="width:100%; height:200px; display:none;"><? echo $Data["consent4"]; ?></textarea>
										<p style="display:none"><textarea name="strConsent4" id="strConsent4" style="width:100%;height:100px;background-color:#f0f0f0;"><? echo $Data["consent4"]; ?></textarea></p>
									</td>
								</tr>
							</table>--></td>
						</tr>
					</table>
					</td>
					<td background="./img/ct_box_right.gif"></td>
				</tr>
				<tr>
					<td height="5"><img src="./img/ct_box_left_bottom.gif" width="5" height="5"></td>
					<td background="./img/ct_box_bottom.gif"></td>
					<td><img src="./img/ct_box_right_bottom.gif" width="5" height="5"></td>
				</tr>
			</table>
			<p class="btn_area"><img src="./img/btn_modify_ok_01.gif" width="60" height="18" style="cursor:pointer;" onClick="submitContents(this);"></p>
			<!-- 개인정보처리(취급)방침 끝-->

			<!-- 접근금지 IP -->
			<table width="99%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="5"><img src="./img/ct_box_left_top.gif" width="5" height="5"></td>
					<td background="./img/ct_box_top.gif"></td>
					<td width="5"><img src="./img/ct_box_right_top.gif" width="5" height="5"></td>
				</tr>
				<tr>
					<td background="./img/ct_box_left.gif"></td>
					<td align="center" bgcolor="#F5F5F5" class="top_5"><table width="99%" border="0" cellpadding="0" cellspacing="1" bgcolor="E6E6E6">
						<tr>
							<td align="center" class="main_title_02">접근금지 IP</td>
						</tr>
						<tr>
							<td height="25" align="center" bgcolor="#FFFFFF"><table width="97%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="top_5_bottom_5">, 로 구분
									<textarea name="strRejection" style="width:100%;height:50px;background-color:#F0F0F0;"><? echo $Data["rejection"]; ?></textarea></td>
								</tr>
							</table></td>
						</tr>
					</table>
					</td>
					<td background="./img/ct_box_right.gif"></td>
				</tr>
				<tr>
					<td height="5"><img src="./img/ct_box_left_bottom.gif" width="5" height="5"></td>
					<td background="./img/ct_box_bottom.gif"></td>
					<td><img src="./img/ct_box_right_bottom.gif" width="5" height="5"></td>
				</tr>
			</table>
			<p class="btn_area"><img src="./img/btn_modify_ok_01.gif" width="60" height="18" style="cursor:pointer;" onClick="submitContents(this);"></p>
			<!-- 접근금지 IP -->
			<!-- SMS -->
			<table width="99%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="5"><img src="./img/ct_box_left_top.gif" width="5" height="5"></td>
					<td background="./img/ct_box_top.gif"></td>
					<td width="5"><img src="./img/ct_box_right_top.gif" width="5" height="5"></td>
				</tr>
				<tr>
					<td background="./img/ct_box_left.gif"></td>
					<td align="center" bgcolor="#F5F5F5" class="top_5">
					<table width="99%" border="0" cellpadding="0" cellspacing="1" bgcolor="E6E6E6">
						<tr>
							<td align="center" class="main_title_02">SMS 등록</td>
						</tr>
						<tr>
							<td height="25" align="center" bgcolor="#FFFFFF"><table width="97%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="top_5_bottom_5" align="center">
										<b>ID :</b> <input type="text" name="strSmsid" style="width:80px;height:20px;background-color:#f0f0f0;" value="<? echo $Data["smsid"]; ?>">
										&nbsp; &nbsp; <b>PASS :</b> <input type="password" name="strSmspass" style="width:80px;height:20px;background-color:#f0f0f0;" value="<? echo $Data["smspass"]; ?>">
										<!-- &nbsp; &nbsp; <b>cafe24URL :</b> <input type="text" name="strSmsurl" style="width:220;height:20px" value="<? echo $Data["smsurl"]; ?>"> -->
										&nbsp; &nbsp; <b>smscnt :</b> <input type="text" name="intSmscnt" style="width:50px;height:20px;background-color:#f0f0f0;" readonly value="<?echo $bagData["smscnt"];?>">
									</td>
								</tr>
							</table></td>
						</tr>
					</table>

					</td>
					<td background="./img/ct_box_right.gif"></td>
				</tr>
				<tr>
					<td height="5"><img src="./img/ct_box_left_bottom.gif" width="5" height="5"></td>
					<td background="./img/ct_box_bottom.gif"></td>
					<td><img src="./img/ct_box_right_bottom.gif" width="5" height="5"></td>
				</tr>
			</table>

			<p class="btn_area"><img src="./img/btn_modify_ok_01.gif" width="60" height="18" style="cursor:pointer;" onClick="submitContents(this);"></p>

			<!-- 소셜네트워크서비스(SNS : Social Network Service) -->
			<table width="99%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="5" height="5"><img src="./img/ct_box_left_top.gif" width="5" height="5"></td>
					<td background="./img/ct_box_top.gif"></td>
					<td width="5"><img src="./img/ct_box_right_top.gif" width="5" height="5"></td>
				</tr>
				<tr>
					<td background="./img/ct_box_left.gif"></td>
					<td align="center" bgcolor="#F5F5F5" class="top_5">
					<table width="99%" border="0" cellpadding="0" cellspacing="1" bgcolor="E6E6E6">
						<tr>
							<td align="center" class="main_title_02">소셜네트워크서비스(SNS : Social Network Service)</td>
						</tr>
						<tr>
							<td height="25" align="center" bgcolor="#FFFFFF">
							<table width="97%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="top_5_bottom_5" align="center">
										<strong>네이버 Client ID</strong> <input type="text" name="nid_ClientID" style="width:170px;height:20px;background-color:#f0f0f0;" value="<? echo $Data["nid_ClientID"]; ?>"> / 
										<strong>Client Secret</strong> <input type="text" name="nid_ClientSecret" style="width:170px;height:20px;background-color:#f0f0f0;" value="<? echo $Data["nid_ClientSecret"]; ?>">
										<a class="btn_frmline" target="_blank" href="https://nid.naver.com/devcenter/register.nhn">API Key 등록하기</a>
									</td>
								</tr>
								<tr>
									<td class="top_5_bottom_5" align="center">
										<strong>PC웹</strong><br/>
										서비스 URL : http://www.<?=str_replace("www.", "", $_SERVER['HTTP_HOST']);?><br/>
										Callback URL : http://www.<?=str_replace("www.", "", $_SERVER['HTTP_HOST']);?>/sns/naver_callback.php<br/>
										<strong>Mobile웹</strong><br/>
										서비스 URL : http://m.<?=str_replace("www.", "", $_SERVER['HTTP_HOST']);?><br/>
										Callback URL : http://m.<?=str_replace("www.", "", $_SERVER['HTTP_HOST']);?>/sns/naver_callback.php
									</td>
								</tr>
								<tr>
									<td class="top_5_bottom_5" align="center">
										<strong>페이스북 PC</strong><br/>
										<strong>Client ID</strong> <input type="text" name="fb_appId" style="width:130px;height:20px;background-color:#f0f0f0;" value="<? echo $Data["fb_appId"]; ?>"> / 
										<strong>Client Secret</strong> <input type="text" name="fb_secret" style="width:240px;height:20px;background-color:#f0f0f0;" value="<? echo $Data["fb_secret"]; ?>">
										<a class="btn_frmline" target="_blank" href="https://developers.facebook.com">API Key 등록하기</a>
									</td>
								</tr>
								<tr>
									<td class="top_5_bottom_5" align="center">
										<strong>페이스북 모바일(호스트가 틀릴경우)</strong><br/>
										<strong>Client ID</strong> <input type="text" name="m_fb_appId" style="width:130px;height:20px;background-color:#f0f0f0;" value="<? echo $Data["m_fb_appId"]; ?>"> / 
										<strong>Client Secret</strong> <input type="text" name="m_fb_secret" style="width:240px;height:20px;background-color:#f0f0f0;" value="<? echo $Data["m_fb_secret"]; ?>">
									</td>
								</tr>
								<tr>
									<td class="top_5_bottom_5" align="center">
										<strong>카카오톡 Client ID</strong> <input type="text" name="kakao_secret" style="width:230px;height:20px;background-color:#f0f0f0;" value="<? echo $Data["kakao_secret"]; ?>">
										<a class="btn_frmline" target="_blank" href="https://developers.kakao.com">API Key 등록하기</a>
									</td>
								</tr>
							</table>
							</td>
						</tr>
					</table>

					</td>
					<td background="./img/ct_box_right.gif"></td>
				</tr>
				<tr>
					<td height="5"><img src="./img/ct_box_left_bottom.gif" width="5" height="5"></td>
					<td background="./img/ct_box_bottom.gif"></td>
					<td><img src="./img/ct_box_right_bottom.gif" width="5" height="5"></td>
				</tr>
			</table>

			<p class="btn_area"><img src="./img/btn_modify_ok_01.gif" width="60" height="18" style="cursor:pointer;" onClick="submitContents(this);"></p>
			</form>
				<!--- end : 본문 --->
			</div>
		</div><div class="clr"></div>
	</div>
	<? include "inc/bottom.php" ?>
</div>

<script type="text/javascript" src="/editor/js/HuskyEZCreator.js" charset="utf-8"></script>
<script type="text/javascript">
var oEditors1 = [];
var oEditors2 = [];
var oEditors3 = [];
var oEditors4 = [];
var oEditors5 = [];

nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors1,
	elPlaceHolder: "ir1",
	sSkinURI: "/editor/SmartEditor2Skin.html",	
	htParams : {
		bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
		//aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
		fOnBeforeUnload : function(){
			//alert("완료!");
		}
	}, //boolean
	fCreator: "createSEditor2"
});

nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors2,
	elPlaceHolder: "ir2",
	sSkinURI: "/editor/SmartEditor2Skin.html",	
	htParams : {
		bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
		//aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
		fOnBeforeUnload : function(){
			//alert("완료!");
		}
	}, //boolean
	fCreator: "createSEditor2"
});

nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors3,
	elPlaceHolder: "ir3",
	sSkinURI: "/editor/SmartEditor2Skin.html",	
	htParams : {
		bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
		//aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
		fOnBeforeUnload : function(){
			//alert("완료!");
		}
	}, //boolean
	fCreator: "createSEditor2"
});

nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors4,
	elPlaceHolder: "ir4",
	sSkinURI: "/editor/SmartEditor2Skin.html",	
	htParams : {
		bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
		//aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
		fOnBeforeUnload : function(){
			//alert("완료!");
		}
	}, //boolean
	fCreator: "createSEditor2"
});

nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors5,
	elPlaceHolder: "ir5",
	sSkinURI: "/editor/SmartEditor2Skin.html",	
	htParams : {
		bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
		//aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
		fOnBeforeUnload : function(){
			//alert("완료!");
		}
	}, //boolean
	fCreator: "createSEditor2"
});

	
function submitContents(elClickedObj) {
	oEditors1.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
	oEditors2.getById["ir2"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
	oEditors3.getById["ir3"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
	oEditors4.getById["ir4"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.

	
	// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.
	document.getElementById("strClauses").value = document.getElementById("ir1").value;
	document.getElementById("strConsent1").value = document.getElementById("ir2").value;
	document.getElementById("strConsent2").value = document.getElementById("ir3").value;
	document.getElementById("strConsent3").value = document.getElementById("ir4").value;
	document.confFrm.submit();
}
</script>

</body>
</html>

