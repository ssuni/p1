<?
// 경고메세지를 경고창으로
function alerts($msg='', $url='')
{
	global $g4;

    if (!$msg) $msg = '올바른 방법으로 이용해 주십시오. 자동등록 방지 글자를 올바르게 입력하세요.';

	//header("Content-Type: text/html; charset=$g4[charset]");
	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=$g4[charset]\">";
	echo "<script language='javascript'>alerts('$msg');";
    if (!$url)
        echo "history.go(-1);";
    echo "</script>";
    if ($url)
        // 4.06.00 : 불여우의 경우 아래의 코드를 제대로 인식하지 못함
        //echo "<meta http-equiv='refresh' content='0;url=$url'>";
        goto_url($url);
    exit;
}
//  norobot.inc.php 가 선행된 후 사용

// 자동등록방지 검사

if($_SESSION["ss_level"]  < 2){

}else{

    // 우선 이 URL 로 부터 온것인지 검사
    $parse = parse_url($_SERVER[HTTP_REFERER]);
    // 3.35
    // 포트번호가 존재할 경우의 처리 (mumu님께서 알려주셨습니다)
    $parse2 = explode(":", $_SERVER[HTTP_HOST]);
    if ($parse[host] != $parse2[0]) {
    //if ($parse[host] != $_SERVER[HTTP_HOST]) {
        alerts("올바른 접근이 아닌것 같습니다. 자동등록 방지 글자를 올바르게 입력하세요.", "./");
    }

    $key = $_SESSION[ss_norobot_key];
    if (!$member[no] && $mode!="modify") {
		if ($key) {
            if ($key != $_POST[wr_key]) {
                alerts("정상적인 등록이 아닌것 같습니다. 자동등록 방지 글자를 올바르게 입력하세요.");
            }
        } else {
            alerts("정상적인 접근이 아닌것 같습니다. 자동등록 방지 글자를 올바르게 입력하세요.");
        }
    }

}
?>
