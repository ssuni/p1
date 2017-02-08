<? include "inc/head.php";

	$thisDay = date('Y')."-".date('m')."-".date('d');

	/*예약처리대상자*/
	$rsvQuery = "SELECT * FROM tblReserve WHERE tblIntStatus='1' ORDER BY tblDtmRsvDate ASC";
	$rsvSql = mysql_query( $rsvQuery );
	$rsvCnt = 0;
	while( $rsvArray = mysql_fetch_array( $rsvSql ) ) {
		$rsvData[$rsvCnt]["cnt"]			= $rsvCnt+1;
		$rsvData[$rsvCnt]["number"]		= $rsvArray["tblNumber"];
		$rsvData[$rsvCnt]["field"]		= $medicalField[$rsvArray["tblIntField"]];
		$rsvData[$rsvCnt]["name"]			= $rsvArray["tblStrName"];
		$rsvData[$rsvCnt]["email"]		= $rsvArray["tblStrEmail"];
		$rsvData[$rsvCnt]["gp"]				= $rsvArray["tblIntGP"];
		$rsvData[$rsvCnt]["phone"]		= $rsvArray["tblStrPhone"];
		$rsvData[$rsvCnt]["status"]		= $rsvArray["tblIntStatus"];
		$rsvData[$rsvCnt]["subject"]	= mb_strimwidth( stripslashes( $rsvArray["tblStrSubject"] ), 0, 28, "...", "utf-8");
		$rsvData[$rsvCnt]["link"]			= "/admin/admin_04_01.php?act=modify&tNum=".$rsvData[$rsvCnt]["number"];
		$rsvData[$rsvCnt]["rsdate"]		= substr( $rsvArray["tblDtmRsvDate"], 0, 16 );
		$rsvCnt++;
	}	

	/*온라인상담*/
	$counQuery = "SELECT * FROM tbl_counsel WHERE tblStrThread='A' AND tblIntNotice='0' AND (tblStrReply='' or tblStrReply is null) ORDER BY tblDtmRegDate DESC limit 0,5";
	$counSql = mysql_query( $counQuery );
	$counCnt = 0;
	while( $counArray = @mysql_fetch_array( $counSql ) ) {
		$counData[$counCnt]["cnt"]			= $counCnt+1;
		$counData[$counCnt]["number"]		= $counArray["tblNumber"];
		$counData[$counCnt]["name"]			= $counArray["tblStrName"];
		$counData[$counCnt]["gp"]			= $counArray["tblIntGP"];
		$counData[$counCnt]["regdate"]		= str_replace( '-', '.', substr( $counArray["tblDtmRegDate"], 0, 10 ) );
		$counData[$counCnt]["subject"]		= mb_strimwidth( stripslashes( $counArray["tblStrSubject"] ), 0, 28, "...", "utf-8");
		$counData[$counCnt]["link"]			= "/admin/community.php?tb=counsel&act=view&tNum=".$counData[$counCnt]["number"];
		$counCnt++;
	}	

	/*금일가입회원*/
	$memberQuery = "SELECT * FROM tblPerMember WHERE tblDtmRegDate LIKE '%".$thisDay."%' ORDER BY tblDtmRegDate DESC";
	$memberSql = mysql_query( $memberQuery );
	$memberCnt = 0;
	while( $memberArray = mysql_fetch_array( $memberSql ) ) {
		$memberData[$memberCnt]["number"]		=	$memberArray["tblNumber"];
		$memberData[$memberCnt]["name"]			=	$memberArray["tblStrName"];
		$memberData[$memberCnt]["id"]			=	$memberArray["tblStrID"];
		$memberData[$memberCnt]["birth"]		=	$memberArray["tblIntBirth"];
		$memberData[$memberCnt]["age"]			=	$memberArray["tblIntAge"];
		$memberData[$memberCnt]["sex"]			=	( $memberArray["tblStrSex"] == 'M' ) ? "남" : "여";
		$memberData[$memberCnt]["regdate"]		=	str_replace( '-', '.', substr( $memberArray["tblDtmRegDate"], 0, 10 ) );
		$memberData[$memberCnt]["fir"]			=	$memberArray["tblIntFirAddr"];
		$memberData[$memberCnt]["link"]			=	"/admin/admin_03_01.php?act=modify&tNum=".$memberData[$memberCnt]["number"];
		$memberCnt++;
	}
	/*금일가입회원*/	?>
<body class="commonBg">
<div id="bodyWrap">
	<? include "inc/top.php" ?>
	<div id="contentsWrap">
		<div class="leftArea">
			<p class="titleBar"><?=$bagData["siteName"]?> <strong>ADMIN</strong></p>
			<? include "inc/left.php" ?>
		</div>
		<div class="rightArea">
			<div id="locationBar">
				<h2>관리자 HOME</h2>
				<p class="location">HOME > <strong>관리자메인</strong></p>
			</div>
			<div class="contentsArea"><!---width:740px--->
				<!--- start : 본문 --->
				<div class="commonBox" style="width:100%;">
					<div class="title">예약처리대상자<p class="more"><a href="/admin/admin_04_01.php?act=list"><img src="/admin/images/btn/btn_more.gif" /></a></p></div>
					<table class="commonTable1">
						<colgroup>
							<col width="7%" />
							<col width="10%" />
							<col width="15%" />
							<col width="*" />
							<col width="15%" />
							<col width="20%" />
							<col width="5%" />
						</colgroup>
						<thead>
							<tr>
								<th>번호</th>
								<th>이름</th>
								<th>연락처</th>
								<th>이메일</th>
								<th>진료항목</th>
								<th>예약일</th>
								<th>상태</th>
							</tr>
						</thead>
						<tbody>
							<? for( $i = 0; $i < $rsvCnt; $i++ ) { ?>
							<tr>
								<td class="center"><?=($i+1)?></td>
								<td class="center color1"><a href='<?=$rsvData[$i]["link"]?>'><?=$rsvData[$i]["name"]?></a></td>
								<td class="center"><?=$rsvData[$i]["phone"]?></td>
								<td class="center"><?=$rsvData[$i]["email"]?></td>
								<td class="center"><?=$rsvData[$i]["field"]?></td>
								<td class="center"><?=$rsvData[$i]["rsdate"]?></td>
								<td class="center"><img src="/admin/img/icon_0<?=$rsvData[$i]["status"]?>.gif"></td>
							</tr>
							<? } ?>
							<?if($rsvCnt==0){?>
							<tr>
								<td class="center" colspan="7" height="50">예약처리 대상자가 없습니다.</td>
							</tr>
							<?}?>
						</tbody>
					</table>
					<div class="info">미처리 건수 : <strong><?=$rsvCnt?></strong> 건</div>
				</div>
				<div class="commonBox" style="width:365px; float:left;">
					<div class="title">온라인상담 (미처리중인 상담글)<p class="more"><a href="/admin/community.php?tb=counsel"><img src="/admin/images/btn/btn_more.gif" /></a></p></div>
					<table class="commonTable1">
						<colgroup>
							<col width="15%" />
							<col width="20%" />
							<col width="*" />
						</colgroup>
						<thead>
							<tr>
								<th>번호</th>
								<th>이름</th>
								<th>제목</th>
							</tr>
						</thead>
						<tbody>
						<? for( $i = 0; $i < $counCnt; $i++ ) { ?>
							<tr>
								<td class="center"><?=($i+1)?></td>
								<td class="center color1"><?=$counData[$i]["name"]?></td>
								<td class="left"><a href="<?=$counData[$i]["link"]?>"><?=$counData[$i]["subject"]?></a></td>
							</tr>
						<? } ?>
							<?if($counCnt==0){?>
							<tr>
								<td class="center" colspan="3" height="50">미처리중인 상담글이 없습니다.</td>
							</tr>
							<?}?>
						</tbody>
					</table>
				</div>
				<div class="commonBox" style="width:365px; float:right;">
					<div class="title">금일가입회원<p class="more"><a href="/admin/admin_03_01.php"><img src="/admin/images/btn/btn_more.gif" /></a></p></div>
					<table class="commonTable1">
						<colgroup>
							<col width="15%" />
							<col width="20%" />
							<col width="12%" />
							<col width="15%" />
							<col width="18%" />
							<col width="*" />
						</colgroup>
						<thead>
							<tr>
								<th>이름</th>
								<th>아이디</th>
								<th>가입일</th>
							</tr>
						</thead>
						<tbody>
						<? for( $i = 0; $i < $memberCnt; $i++ ) { ?>
							<tr>
								<td class="center color1"><a href="<?=$memberData[$i]["link"]?>"><?=$memberData[$i]["name"]?></a></td>
								<td class="center"><?=$memberData[$i]["id"]?></td>
								<td class="center"><?=$memberData[$i]["regdate"]?></td>
							</tr>
						<? } ?>
							<?if($memberCnt==0){?>
							<tr>
								<td class="center" colspan="6" height="50">금일 가입한 회원이 없습니다.</td>
							</tr>
							<?}?>
						</tbody>
					</table>
				</div><div class="clr"></div>
				<!--- end : 본문 --->
			</div>
		</div><div class="clr"></div>
	</div>
	<? include "inc/bottom.php" ?>
</div>
</body>
</html>
