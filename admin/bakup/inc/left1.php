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
			<p class="titleBar">병원관리</p>
			<ul class="navi">
				<li class="<?=$subNum1?>"><a href="/admin/config.php">운영정보설정</a></li>
				<li class="<?=$subNum2?>"><a href="/admin/adconfig.php">관리자설정</a></li>
				<li class="<?=$subNum3?>"><a href="/admin/call.php">전화상담</a></li>
			</ul>