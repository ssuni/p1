<?
$subNum1 = ""; $subNum2 = ""; $subNum3 = ""; $subNum4 = ""; $subNum5 = ""; $subNum6 = ""; $subNum7 = ""; $subNum8 = ""; $subNum9 = ""; $subNum10 = "";

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
?>
			<p class="titleBar">통계관리</p>
			<ul class="navi">
				<li class="<?=$subNum1?>"><a href="/admin/s_member01.php">회원현황</a></li>
				<li class="<?=$subNum2?>"><a href="/admin/s_member02.php">회원가입</a></li>
				<li class="<?=$subNum3?>"><a href="/admin/s_counsel01.php">온라인상담</a></li>
				<li class="<?=$subNum4?>"><a href="/admin/statistics01.php">일별상세</a></li>
				<li class="<?=$subNum5?>"><a href="/admin/statistics02.php">경로별</a></li>
				<li class="<?=$subNum6?>"><a href="/admin/statistics03.php">검색어별</a></li>
				<li class="<?=$subNum7?>"><a href="/admin/statistics04.php">기간별</a></li>
			</ul>