<? 
$class01 = "";
$class02 = "";
$class03 = "";
$class04 = "";
$class05 = "";
$class06 = "";
$class07 = "";
$class08 = "";
$class09 = "";
$class10 = "";

switch($tabNum){
	case('1'): $class01 = "over"; break;
	case('2'): $class02 = "over"; break;
	case('3'): $class03 = "over"; break;
	case('4'): $class04 = "over"; break;
	case('5'): $class05 = "over"; break;
	case('6'): $class06 = "over"; break;
	case('7'): $class07 = "over"; break;
	case('8'): $class08 = "over"; break;
	case('9'): $class09 = "over"; break;
	case('10'): $class10 = "over"; break;
} ?>

<div class="m_top_bar">&nbsp;</div>
<div class="m_top_area">
	<div class="m_top">
		<h1><a href="/"><img src="/002/images/common/logo02.png" alt="홈으로 가기"></a></h1>
		<table summary="" class="m_menu">
			<caption></caption>
			<tbody>
				<tr>
					<? if ($_SESSION['ss_name']) { ?>
					<td><a href="javascript:;" onclick="javascript:document.formout.submit();" class="<?=$class01;?>">로그아웃</a></td> <!-- 로그인전 -->
					<td><a href="/member/modify.php" class="<?=$class04;?>">회원정보수정</a></td> <!-- 로그인후 -->
					<? if (!$_SESSION['sns']) { ?><td><a href="/member/out.php" class="<?=$class05;?>">회원탈퇴</a></td> <!-- 로그인후 --><? } ?>
					<? } else { ?>
					<td><a href="/member/login.php" class="<?=$class01;?>">회원로그인</a></td> <!-- 로그인전 -->
					<td><a href="/member/join01.php" class="<?=$class02;?>">회원가입</a></td> <!-- 로그인전 -->
					<td><a href="/member/idpw.php" class="<?=$class03;?>">아이디/비밀번호 찾기</a></td> <!-- 로그인전 -->
					<? } ?>
					<td><a href="/member/provision.php" class="<?=$class06;?>">회원약관</a></td>
					<td><a href="/member/privacy.php" class="last <?=$class07;?>">개인정보처리(취급)방침</a></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>