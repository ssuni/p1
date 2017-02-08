<?	$subNum1 = ""; $subNum2 = ""; $subNum3 = ""; $subNum4 = ""; $subNum5 = ""; $subNum6 = ""; $subNum7 = ""; $subNum8 = ""; $subNum9 = ""; $subNum10 = "";

switch($subNum){
	case('1'): $subNum1 = "on"; break;
	case('2'): $subNum2 = "on"; break;
	case('3'): $subNum3 = "on"; break;
	case('4'): $subNum4 = "on"; break;
	case('5'): $subNum5 = "on"; break;
	case('6'): $subNum6 = "on"; break;
	case('7'): $subNum7 = "on"; break;
	case('8'): $subNum8 = "on"; break;
	case('9'): $subNum9 = "on"; break;
	case('10'): $subNum10 = "on"; break;
}

if($pageNum!=''){ //$pageNum 있을경우 시작
	switch($pageNum){
		case('1'):
			$sub_tit = "병원관리";
			$sub_tit2_1 = "운영정보설정";
			$sub_tit2_2 = "관리자설정";
			//$sub_tit2_3 = "전화상담";
		break;
		case('2'):
			$sub_tit = "프로모션";
			$sub_tit2_1 = "팝업관리";
			$sub_tit2_2 = "전화상담";
			$sub_tit2_3 = "이벤트관리";
			$sub_tit2_4 = "이벤트관리(6월)";
			$sub_tit2_5 = "모바일상담";
			$sub_tit2_6 = "빠른상담";
			$sub_tit2_7 = "카카오톡상담";
			$sub_tit2_9 = "온라인상담";
		break;
		case('3'):
			$sub_tit = "회원관리";
			$sub_tit2_1 = "회원관리";
			$sub_tit2_2 = "회원등록";
			$sub_tit2_3 = "휴면계정메일로그";
		break;
		case('4'):
			$sub_tit = "예약관리";
			$sub_tit2_1 = "진료스케쥴";
			$sub_tit2_2 = "진료예약";
		break;
		case('5'):
			$sub_tit = "커뮤니티";
			$sub_tit2_1 = "게시판관리";
			$sub_tit2_2 = "공지사항";
			$sub_tit2_3 = "방송/언론보도";
			$sub_tit2_4 = "시술후기";
			$sub_tit2_5 = "온라인상담";
			$sub_tit2_6 = "이벤트";
			$sub_tit2_7 = "전후사진";
		break;
		case('6'):
			$sub_tit = "메일관리";
			$sub_tit2_1 = "회원메일발송";
		break;
		case('7'):
			$sub_tit = "SMS관리";
			$sub_tit2_1 = "회원SMS 발송";
			$sub_tit2_2 = "자동SMS 설정";
			$sub_tit2_3 = "SMS발송 로그";
			$sub_tit2_4 = "SMS상용구 설정";
		break;
		case('8'):
			$sub_tit = "일정관리";
			$sub_tit2_1 = "일정관리";
		break;
		case('9'):
			$sub_tit = "통계관리";
			$sub_tit2_1 = "회원현황";
			$sub_tit2_2 = "회원가입";
			$sub_tit2_3 = "온라인상담";
			$sub_tit2_4 = "일별상세";
			$sub_tit2_5 = "경로별";
			$sub_tit2_6 = "검색어별";
			$sub_tit2_7 = "기간별";
			$sub_tit2_8 = "관리자 로그분석";
		break;
	}	?>
			<p class="titleBar"><?=$sub_tit?></p>
			<ul class="navi">
			<?
			foreach($auth as $k => $v) {
				if (substr($v,0,3) == substr($sub_menu,0,3)) {
					//echo $sub_menu.' -- '.$v.'--'.$sub_title[$v].'--'.$sub_link[$v].'<br/>';				
					$on=($sub_menu == $v)?'on':'';
					echo '<li class="'.$on.'"><a href="'.$sub_link[$v].'">'.$sub_title[$v].'</a></li>';
				}
			}
			// 단순 개별 링크
//			switch(substr($sub_menu,0,3)) {
////				case '200':
////					echo '<li><a href="/admin/community.php?tb=online_counsel&act=list">온라인상담</a></li>';
////					break;
//				case '500':
//					$sql = "select * from tblBoardManager order by tblGroup asc, tblBname asc";
//					$result = mysql_query($sql);
//					while( $list = mysql_fetch_array( $result ) ) {
//						$on=($tb==$list["tblBtable"])?'on':'';
//						echo '<li class="'.$on.'"><a href="/admin/community.php?tb='.$list["tblBtable"].'&act=list">'.$list["tblBname"].'</a></li>';
//					}
//					break;
//			}
//			?>
			</ul>
<?} //$pageNum 있을경우 끝?>
<div class="leftBar">
				<div class="left_tt" id="sms">
					<h2><img src="/admin/images/common/tt_sms.gif" /></h2>
					<table class="infoBox">
						<tr>
							<td class="tt1">SMS 잔여횟수</td>
							<td class="info"><strong><?=$api->getSmsCount()?></strong> 건</td>

						</tr>

					</table>
					<p class="bottom"></p>
				</div>
				<div class="left_tt" id="member">
					<h2><img src="/admin/images/common/tt_member.gif" /></h2>
					<table class="infoBox">
						<tr>
							<td class="tt2">이달 회원수</td>
							<td class="info"><strong><?=$nMonthMem?></strong> 명</td>
						</tr>
						<tr>
							<td class="tt2">총 회원수</td>
							<td class="info"><strong><?=$nTotalMem?></strong> 명</td>
						</tr>
						<tr>
							<td class="tt1">금일 방문자</td>
							<td class="info"><strong><?=number_format($darr[0])?></strong> 명</td>
						</tr>
						<tr>
							<td class="tt1">어제 방문자</td>
							<td class="info"><strong><?=number_format($yarr[0])?></strong> 명</td>
						</tr>
						<tr>
							<td class="tt1">총 방문자</td>
							<td class="info"><strong><?=number_format($tarr[0])?></strong> 명</td>
						</tr>
					</table>
					<p class="bottom"></p>
				</div>
				<div class="left_tt" id="type">
					<h2><img src="/admin/images/common/tt_type.gif" /></h2>
					<table class="infoBox">
						<tr>
							<td class="tt2">전체</td>
							<td class="info"><strong><?=$nTotalMem?></strong> 명</td>
						</tr>
					</table>
					<p class="bottom"></p>
				</div>
			</div>