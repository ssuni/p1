<?
// 회원가입 2, 10
// 온라인 상담 4, 10  > 신청예약
// 기타 5, 10
switch($_SERVER['PHP_SELF']) {
	case '/member/memgaip.php':
		$cnv = "2";
		break;
	case '/new/community/community03.php':
		$cnv = "4";
		break;
	default:
		$cnv = "5";
		break;
}
?>
<!-- 전환페이지 설정 -->
<script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script> 
<script type="text/javascript"> 
var _nasa={};
_nasa["cnv"] = wcs.cnv("<?=$cnv;?>","10"); // 전환유형, 전환가치 설정해야함. 설치매뉴얼 참고
</script> 