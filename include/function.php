<?	// 후이즈 SMS 연동
@extract($_GET);
@extract($_POST);
@extract($_SERVER);

	require $_SERVER['DOCUMENT_ROOT']."/include/selectConfig.php";

	$newData["newdate"] = date( 'Y-m-d 00:00:00', time() - ( 86400*3 ) ); /* 3일간 표시 */

	$bagData["host"]			= "http://".$_SERVER['HTTP_HOST'];
	$bagData["siteName"]		= "예쁨주의쁨";			// 상호명
	$bagData["bizNumber"]		=	"784-11-00540";			// 사업자 번호
	$bagData["bizAddr"]		=	"서울특별시 서초구 강남대로 459 백암빌딩 4층 ";			// 주소
	$bagData["bizCeo"]		=	"정헌진";																			// ceo
	$bagData["bizTel"]		=	"02-593-3344";												// 고객센터
	$bagData["bizFax"]		=	"";												// Fax
	$bagData["copyRight"]		=	"@ 2016 ppeumclinic ";							// copyRight
	$bagData["streamingURL"]	= "mms://mms.".$_SERVER['HTTP_HOST'];
	$bagData["mdir"]	= "/m";					// 모바일 폴더경로
	$bagData["watermarkImage"]	= ""; // 워터마크이미지 경로(png)
	$bagData["smsSender"]		= '';
	$bagData["smsTo1"]		= '';
	$bagData["smsTo2"]		= '';

	$table_member	=	"tblPerMember"; //회원테이블

	/*관리자정보 select*/
	$admQuery = "SELECT * FROM tblAdminMember";
	$admSql = mysql_Query( $admQuery );
	$admArray = mysql_fetch_array( $admSql );
	$admData["id"]			= $admArray["tblStrId"];
	$admData["pass"]		= $admArray["tblStrPass"];
	$admData["name"]		= $admArray["tblStrName"];
	$admData["phone"]		= $admArray["tblStrPhone"];
	$admData["mobile"]		= $admArray["tblStrMobile"];
	$admData["email"]		= $admArray["tblStrEmail"];
	$admData["level"]		= $admArray["tblIntLevel"];

	/*운영정보 select*/
	$bagQuery = "SELECT * FROM tblBasicConfig";
	$bagSql = mysql_Query( $bagQuery );
	$bagArray = mysql_fetch_array( $bagSql );
	$bagData["header"]		= $bagArray["tblHeader"];
	$bagData["title"]		= stripslashes( $bagArray["tblTitle"] );
	$bagData["keyword"]		= $bagArray["tblKeyword"];
	$bagData["clauses"]		= stripslashes( $bagArray["tblClauses"] );
	$bagData["consent1"]		= stripslashes( $bagArray["tblConsent1"] );
	$bagData["consent2"]		= stripslashes( $bagArray["tblConsent2"] );
	$bagData["consent3"]		= stripslashes( $bagArray["tblConsent3"] );
	$bagData["consent4"]		= stripslashes( $bagArray["tblConsent4"] );
	$bagData["rejection"]	= $bagArray["tblRejection"];
	$bagData["smsid"]		= $bagArray["tblSmsid"];
	$bagData["smspass"]		= $bagArray["tblSmspass"];
	$bagData["smsurl"]		= $bagArray["tblSmsurl"];
	$bagData["securekey"]	= $bagArray["tblSmsSecureKey"];

	$bagData["nid_ClientID"]	= $bagArray["nid_ClientID"];
	$bagData["nid_ClientSecret"]	= $bagArray["nid_ClientSecret"];
	$bagData["fb_appId"]	= $bagArray["fb_appId"];
	$bagData["fb_secret"]	= $bagArray["fb_secret"];
	$bagData["m_fb_appId"]	= $bagArray["m_fb_appId"];
	$bagData["m_fb_secret"]	= $bagArray["m_fb_secret"];
	$bagData["kakao_secret"]	= $bagArray["kakao_secret"];
	
	/* sms 남은 건수 */
	//$sms = new EmmaSMS();
	//$sms->login($bagData["smsid"], $bagData["smspass"]);	// $sms->login( [고객 ID], [고객 패스워드]);
	//$bagData["smscnt"] = $sms->point();
	/* sms 남은 건수 */

	/*자동SMS select*/
	$aSmsQuery = "SELECT * FROM tblSmsSave";
	$aSmsSql = mysql_Query( $aSmsQuery );
	while( $aSmsArray = mysql_fetch_array( $aSmsSql ) ) {
		$aSmsData[$aSmsArray["tblIntType"]]["type"]			= $aSmsArray["tblIntType"];
		$aSmsData[$aSmsArray["tblIntType"]]["use"]			= $aSmsArray["tblStrUse"];
		$aSmsData[$aSmsArray["tblIntType"]]["comment"]	= stripslashes( $aSmsArray["tblStrComment"] );
	}

	$memberNameArr[0]='';
	$memberNameArr[1]='';
	$memberNameArr[2]='부관리자';
	$memberNameArr[3]='병원직원';
	$memberNameArr[4]='환자';
	$memberNameArr[5]='';
	$memberNameArr[6]='내원회원';
	$memberNameArr[7]='';
	$memberNameArr[8]='웹회원';
	$memberNameArr[9]='';
	$memberNameArr[10]='비회원';

	$memberNameColorArr[2]='660066';
	$memberNameColorArr[3]='FF6666';
	$memberNameColorArr[4]='FFCC00';
	$memberNameColorArr[5]='00CCCC';
	$memberNameColorArr[6]='336666';
	$memberNameColorArr[7]='0033FF';
	$memberNameColorArr[8]='009966';

	/*요일데이타*/
	$dataExtArr = array('일','월','화','수','목','금','토');

	/*이미지 확장자*/
	$imageExt = array('gif','jpg','GIF','JPG','JPEG','png','PNG');

	/*동영상 확장자*/
	$movieExt = array('wmv','wma','avi','mpg','mpeg');

	/*업로드불가확장자*/
	$no_ext = array('html','htm','php','php3','inc','cgi','jsp');

	/*환자구분*/
	//$mediGubunArr = array('','비수술척추','비수술관절','스포츠재활','줄기세포','성장','만성피로','기타');
	$mediGubunArr = array('','웹회원','전화회원','내원회원','수술회원','병원직원');

	$counselField = array('항목1','항목2');

	/*유입경로*/
	//$inflowArr = array('','소개','간판','잡지','신문','방송','e-뉴스','지식인','블로그','까페','네이버검색','다음검색','야후검색','기타사이트','기타','배너');
	$inflowArr = array('','키워드 검색','카페','블로그','지식인','e-뉴스','간판','잡지','신문','방송','배너광고','소개','기타');
	$inflowArr2 = array('','피부','주름','보톡스','필러','비만','기타');
	$flowNumArr = array('0','10','9','8','7','6','2','3','4','5','12','1','11');

	/*우편번호 및 지역번호*/
	$placeArr = array('','서울','부산','대구','인천','광주','대전','울산','강원','경기','경남','경북','전남','전북','제주','충남','충북');
	$phone_num1=array('','02','051','053','032','062','042','052','044','031','033','043','041','063','061','054','055','064','070','0505');
	$phone_num2=array('','010','011','016','017','018','019');

	$tvpressArr = array('','','','','');

	/*전화상담시간*/
	$teltimeArr	= array('', '10시~13시', '14시~17시', '17시~20시');

	/*상태*/
	$statusArr	= array('', '접수', '예약', '완료', '취소');
	/*상태2*/
	$statusArr2	= array('', '접수', '대기', '완료', '취소');

	/*sms타입*/
	$smsSaveTypeArr = array( '', '회원가입', '비밀번호찾기', '온라인예약', '온라인상담' );

	/*지점분류*/
	$GPArray = array();
	
	/*방송매체*/
	$pressArr = array( '','KBS','MBC','SBS','ITV','기타');

	/*리퍼러 체크*/
	function referer_check($url="")
	{
		if (!preg_match("/^http[s]?:\/\/".$_SERVER[HTTP_HOST]."/", $_SERVER[HTTP_REFERER]))
			echo "<script language='javascript'>";
			echo "	alert('제대로 된 접근이 아닌것 같습니다.');";
			echo "	history.go(-1);";
			echo "</script>";
			break;
	}
	
	function fnGetHost($p_sAddr){
		$f_rAddr	= @explode("/", $p_sAddr);
		return $f_rAddr[2];
	}
	
	function fnGetHostName($p_sRefer) {

		$f_rPortal	= Array(
			Array( "host" => "naver", "name" => "네이버"), 
			Array( "host" => "google", "name" => "구글"), 
			Array( "host" => "daum", "name" => "다음"), 
			Array( "host" => "paran", "name" => "파란"), 
			Array( "host" => "live.com", "name" => "라이브닷컴"), 
			Array( "host" => "cyworld", "name" => "싸이월드"), 
			Array( "host" => "yahoo", "name" => "야후"),
			Array( "host" => "nate", "name" => "네이트")
		);
		$f_rInfo	= parse_url($p_sRefer);
		$f_sHost	= $f_rInfo["host"];
		if ( $f_sHost != "" ) { 
			for ( $i = 0 ; $i < count($f_rPortal) ; $i++ ){
				if ( @eregi($f_rPortal[$i]["host"], $f_sHost) ){
					$f_sHost	= $f_rPortal[$i]["name"];
					return $f_sHost;
				}
			}
		}
		return $f_sHost;
	}
	
	function fnGetKeyword($p_sRefer) { 
		$f_rInfo	= parse_url($p_sRefer);
		$f_sQuery	= $f_rInfo["query"];
		$f_sKeyword	= "";
		if ( $f_sQuery != "" ) { 
			$f_rQuery	= explode("&", $f_sQuery);
			for ( $i = 0 ; $i <	count($f_rQuery) ; $i++ ){
				$f_rTmp	= explode("=", $f_rQuery[$i]);
				//if ( $f_rTmp[0] == "q" || $f_rTmp[0] == "query" || $f_rTmp[0] == "KeyWord"  || $f_rTmp[0] == "p" ){
					if ( $f_rTmp[0] == "q" || $f_rTmp[0] == "query" || $f_rTmp[0] == "KeyWord" ){
					$f_sKeyword	= urldecode($f_rTmp[1]);
				}
			}
		}
		return $f_sKeyword;
	}

	/*택스트 자르기(euc-kr)*/
	function kstrcut($str, $len, $co) { 
		if(strlen($str) > $len) 
		{ 
			if(ord($str[$len - 1]) <= 127) $pos = $len; 
			else 
			{ 
				for($pos = $len - 1; $pos >= 0; $pos--) 
					if(ord($str[$pos]) > 127) $h++; 
					else break; 

				if($h%2==0) $pos += $h + 1; 
				else $pos += $h; 
			}
			$str = substr($str, 0, $pos); 
			$str .= $co; 
		}
		return $str; 
	}

	/*택스트 자르기(utf-8)*/
	function cut_string_utf8($str, $max_len, $suffix)
	{
		$n = 0;
		$noc = 0;
		$len = strlen($str);
		while ( $n < $len )
		{
			$t = ord($str[$n]);
			if ( $t == 9 || $t == 10 || (32 <= $t && $t <= 126) )
			{
				$tn = 1;
				$n++;
				$noc++;
			}
			else if ( 194 <= $t && $t <= 223 )
			{
				$tn = 2;
				$n += 2;
				$noc += 2;                     
			}
			else if ( 224 <= $t && $t < 239 )
			{
				$tn = 3;
				$n += 3;
				$noc += 2;
			}
			else if ( 240 <= $t && $t <= 247 )
			{
				$tn = 4;
				$n += 4;
				$noc += 2;
			}
			else if ( 248 <= $t && $t <= 251 )
			{
				$tn = 5;
				$n += 5;
				$noc += 2;
			}
			else if ( $t == 252 || $t == 253 )
			{
				$tn = 6;
				$n += 6;
				$noc += 2;
			}
			else { $n++; }
			if ( $noc >= $max_len ) { break; }
		}
		if ( $noc <= $max_len ) return $str;
		if ( $noc > $max_len ) { $n -= $tn; }
		return substr($str, 0, $n) . $suffix;
	}

	/*숫자정렬*/
	function zero_full($value,$max) {	
		while (strlen($value) < $max) {
			$value="0".$value;
		}
		return $value;
	}

	function specialCharacters($str) {
		$str = str_replace("&", "&amp;", $str);
		//$str = str_replace("<", "&lt;", $str);
		//$str = str_replace(">", "&gt;", $str);
		$str = str_replace("'", "&acute;", $str);
		$str = str_replace('"', "&quot;", $str);
		//$str = str_replace("|", "&brvbar;", $str);
		//$str = str_replace("\n", "<BR>", $str);
		//$str = str_replace("\r\n", "<BR>", $str);
		//$str = str_replace("\r", "", $str);
		return $str;
	}

	function unspecialCharacters($str) {
		$str = str_replace("&amp;", "&", $str);
		$str = str_replace("&lt;", "<", $str);
		$str = str_replace("&gt;", ">", $str);
		$str = str_replace("&acute;", "'", $str);
		$str = str_replace("&quot;", '"', $str);
		//$str = str_replace("&brvbar;", "|", $str);
		//$str = str_replace("<BR>", "\n", $str);
		//$str = str_replace("<BR>", "\r\n", $str);
		//$str = str_replace("", "\r", $str);
		return $str;
	}

	/*현재주소*/
	function getURL(){
		//$server=getenv("SERVER_NAME"); 
		$file=getenv("SCRIPT_NAME"); 
		$query=getenv("QUERY_STRING"); 
		//$url="http://$server$file"; 
		$url="$file";
		if($query) $url.="?$query"; 
		return $url; 
	} 
	
	/*나이계산*/
	function createAge( $jumin ) { 
			$birth_year = substr($jumin,0,2); 
			$gubun = substr($jumin,6,1); 

			if($gubun==1 || $gubun==2)    //1900년대(남자:1, 여자:2) 
					$year_prefix = "19"; 
			else if($gubun==3 || $gubun==4)    //2000년대(남자:3, 여자:4) 
					$year_prefix = "20"; 
			else if($gubun==9 || $gubun==0)    //1800년대(남자:9, 여자:0) 
					$year_prefix = "18"; 
			else 
					return 0; 

			$creYear = $year_prefix.$birth_year;
			$age = date('Y') - intval($creYear) + 1; 
			return $age;
	} 

	/*성별계산*/
	function createSex( $jumin ) { 
			$gubun = substr($jumin,6,1); 

			if($gubun=='1' || $gubun=='3' || $gubun=='9') {
				$strSex = 'M';
			} else {
				$strSex = 'F';
			}

			return $strSex;
	} 

	/*지역명계산*/
	function createPlace($strAddress) { 
			$gubun = explode(' ', $strAddress); 
			$strPlace = array_search( $gubun[0], $placeArr );

			return $strPlace;
	} 

	/* 소켓 이메일 */
	function sock_url( $host, $port, $path ) {
		$fullpath = $path; // 검색하고자 하는 페이지의 도메인 포함 전체 주소 
		if(!($fp = fsockopen($host, $port, &$errno, &$errstr, 30))) // URL에 소켓 연결 
		{ 
		return array(1,"소켓에러 - 검색이 중지됨", "9"); 
		exit; 
		} 

		fputs($fp, "GET ".$fullpath." HTTP/1.0\r\n"."Host: $host:${port}\r\n"."User-Agent: Web 0.1\r\n"."\r\n"); // 서버에 URL 페이지 요청 

		//fputs($fp, "GET $fullpath HTTP/1.0\r\n"); 
		//fputs($fp, "User-Agent: Mozilla/4.0\r\n"); 
		//fputs($fp, "content-type:text/html\r\n\r\n"); 

		while( !feof( $fp ) ) // 페이지내 모든 내용을 저장 
		{  
		$output .= fgets( $fp, 1024 );  
		}  

		return $output; 
		fclose( $fp ); // 소켓 해제 
	}
	/*소켓 이메일*/
	
	/*소켓 sms*/
function sock_sms( $host, $post, $header, $data ) {
    $fp = fsockopen($host, 80);

    if ($fp) {
			fputs($fp, $header.$data);
			$rsp = '';
			while(!feof($fp)) {
					$rsp .= fgets($fp,8192);
			}
			return $rsp;
		}
		fclose($fp);
	}
	/*소켓 sms*/

	/* 슬라이더 */
function open_main( $tb, $limit, $width, $height, $txtcut, $n ) {
	echo"
		<script language='javascript'>
			var PM".$n." = new TextSlider('PM".$n."');
			PM".$n.".item = ['";
			$tmp = 0;
			$Que = "SELECT * FROM ".$tb." ORDER BY tblDtmRegDate DESC LIMIT ".$limit;
			$Sql = mysql_query( $Que );
			while( $Result = mysql_fetch_array( $Sql ) ) {

				$sliderData[$tmp]["subject"]	= mb_strimwidth( stripslashes( $Result["tblStrSubject"] ), 0, $txtcut, "...", "UTF-8");
				$sliderData[$tmp]["link"]	= "<a href=http://".$Result["tblStrLink"]." target=_blank>";

				if( $tmp > 0 ) { echo "' , '"; }
				echo "<table width=260 height=22 border=0 cellpadding=0 cellspacing=0><tr><td width=20 height=22>&nbsp;</td><td width=10 align=center><img src=/img/main/arrow.gif width=4 height=5></td><td background=/img/main/main_blog_bg.gif>".$sliderData[$tmp]["link"]."<font color=FFFFFF>".$sliderData[$tmp]["subject"]."</font></a></td></tr></table>";
				$tmp++;
			}
			echo "'];
			PM".$n.".width = 260;
			PM".$n.".height = 66;
			PM".$n.".speed = 10;
			PM".$n.".pixel = 1;
			PM".$n.".interval = 3000;
			PM".$n.".size = 21;
			PM".$n.".direction = 'up';
			PM".$n.".align = 'up';
			PM".$n.".init();
		</script>";
	}

/*GD썸네일*/
function thumnail($file, $save_filename, $save_path, $max_width, $max_height){
				 $img_info = getImageSize($file);
				 if($img_info[2] == 1)
				 {
								$src_img = ImageCreateFromGif($file);
								}elseif($img_info[2] == 2){
								$src_img = ImageCreateFromJPEG($file);
								}elseif($img_info[2] == 3){
								$src_img = ImageCreateFromPNG($file);
								}else{
								return 0;
				 }
				 $img_width = $img_info[0];
				 $img_height = $img_info[1];

				 if($img_width > $max_width || $img_height > $max_height)
				 {
								if($img_width == $img_height)
								{
											 $dst_width = $max_width;
											 $dst_height = $max_height;
								}elseif($img_width > $img_height){
											 $dst_width = $max_width;
											 $dst_height = ceil(($max_width / $img_width) * $img_height);
								}else{
											 $dst_height = $max_height;
											 $dst_width = ceil(($max_height / $img_height) * $img_width);
								}
				 }else{
								$dst_width = $img_width;
								$dst_height = $img_height;
				 }
				 if($dst_width < $max_width) $srcx = ceil(($max_width - $dst_width)/2); else $srcx = 0;
				 if($dst_height < $max_height) $srcy = ceil(($max_height - $dst_height)/2); else $srcy = 0;

				 if($img_info[2] == 1)
				 {
								$dst_img = imagecreate($max_width, $max_height);
				 }else{
								$dst_img = imagecreatetruecolor($max_width, $max_height);
				 }

				 $bgc = ImageColorAllocate($dst_img, 255, 255, 255);
				 ImageFilledRectangle($dst_img, 0, 0, $max_width, $max_height, $bgc);
				 ImageCopyResampled($dst_img, $src_img, $srcx, $srcy, 0, 0, $dst_width, $dst_height, ImageSX($src_img),ImageSY($src_img));

				 if($img_info[2] == 1)
				 {
								ImageInterlace($dst_img);
								ImageGif($dst_img, $save_path.$save_filename);
				 }elseif($img_info[2] == 2){
								ImageInterlace($dst_img);
								ImageJPEG($dst_img, $save_path.$save_filename);
				 }elseif($img_info[2] == 3){
								ImagePNG($dst_img, $save_path.$save_filename);
				 }
				 ImageDestroy($dst_img);
				 ImageDestroy($src_img);
	}

//GD를 이용한 이미지 리사이즈 함수 

//$img_file    :    원본파일 
//$simg_name    :리사이즈 파일 : 없을 경우 이미지를 직접출력합니다. 
//리사이즈와 워터 마크를 사용하지 않을 경우 직접 출력하는건 효율성이 떨어집니다. 
//(직접 출력의 경우 header가 수정되기 때문에 다른 출력이 있으면 안됩니다.) 
//$simg_width    :리사이즈 너비 
//$simg_height    :리사이즈 높이 
//$simg_width와$simg_height 가 둘다 없을 경우 원본크기 그대로 작업합니다. 
//$simg_type        :리사이즈 파일타입 (1:gif , 2:jpg , 3:png) : 기본 gif 
//$simg_str : 워터마크 문자열  (시작 위치:10px,20px ) 폰트는 gulim.ttc 지만, 없을 경우 ""로 바꿔주세요. 
//gulim.ttc 는 윈도우 font 폴더 안에 있습니다. 
/*function gd_image_resize($img_file, $simg_name='', $simg_width='', $simg_height='', $simg_type=1, $simg_str='', $fn_size='10', $opacity) { 

if(!is_file($img_file)) {    return '원본 파일이 없습니다.'; } 
//if(!$simg_name){    return '리사이즈 파일이름이 없습니다.'; } : 리사이즈 파일 이름이 없으면, 이미지로 그냥 출력합니다. 
//if(!$simg_width && !$simg_height){    return '너비 와 높이 둘중 하나는 값이 있어야합니다'; } : 원본 크기로 작업합니다. 

// GD 버젼체크 
$gd = gd_info(); 
$gdver = substr(preg_replace("/[^0-9]/", "", $gd['GD Version']), 0, 1); 
if(!$gdver) {
	return "GD 버젼체크 실패거나 GD 버젼이 1 미만입니다."; 
}

list($img_width, $img_height, $img_type, $img_attr) = getimagesize($img_file); //소스이미지파일 크기 
if(!$simg_width && !$simg_height) { 
    $simg_width = $img_width; 
    $simg_height = $img_height; 
} else if(!$simg_width) { 
    $simg_width = $img_width * ($simg_height/$img_height);    //자동 비율생성 : 너비 
} else if(!$simg_height) { 
    $simg_height = $img_height * ($simg_width/$img_width);    //자동 비율생성 : 높이 
} 
////////// 
지원 이미지 타입 
1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP, 7 = TIFF(intel byte order), 8 = TIFF(motorola byte order), 
9 = JPC, 10 = JP2, 11 = JPX, 12 = JB2, 13 = SWC, 14 = IFF, 15 = WBMP, 16 = XBM. 
1,2,3 만 지원하도록한다. 
/////////
if($img_type<1 && $img_type > 3) { 
    return "GIF,JPG,PNG 가 아닙니다."; 
} 

if($img_type==1) { 
$img_im = imagecreatefromgif($img_file);            //원본 이미지: gif 
} else if($img_type==2) { 
$img_im = imagecreatefromjpeg($img_file);            //원본 이미지: jpg 
} else if($img_type==3) { 
$img_im = imagecreatefrompng($img_file);            //원본 이미지: png 
} 

if($gdver >= 2) {    //GD 2.XX    : truecolor로 작업한다. 
    $simg_im = imagecreatetruecolor($simg_width, $simg_height); 
    imagecopyresampled($simg_im, $img_im, 0, 0, 0, 0, $simg_width, $simg_height,$img_width, $img_height); //이미지를 리사이즈한다.
		$simg_im2 = imagecreatetruecolor($simg_width, $simg_height); 
    imagecopyresampled($simg_im2, $img_im, 0, 0, 0, 0, $simg_width, $simg_height,$img_width, $img_height); //이미지를 리사이즈한다.
} else { //GD 1.xxx 
    $simg_im = imagecreate($simg_width, $simg_height); 
    imagecopyresized($simg_im, $img_im, 0, 0, 0, 0, $simg_width, $simg_height,$img_width, $img_height);    //이미지를 리사이즈한다..
		$simg_im2 = imagecreate($simg_width, $simg_height); 
    imagecopyresized($simg_im2, $img_im, 0, 0, 0, 0, $simg_width, $simg_height,$img_width, $img_height); //이미지를 리사이즈한다. 
} 

if($simg_str) { 
	$w = imagesx($simg_im); 
	$h = imagesy($simg_im); 
	$text_pos_x = $w/5; 
	$text_pos_y = $h/2; 
  //$color_000000 = imagecolorallocate($simg_im, 0, 0, 0); //색상 : 검정 
  //$color_FFFFFF = imagecolorallocate($simg_im, 0xFF, 0xFF, 0xFF); //색상 : 흰색 
	$fn_color = imagecolorallocate($simg_im,255,255,255); // 텍스트 컬러 지정 
  //$simg_str = iconv("EUC-KR","UTF-8",$simg_str); // UTF-8로 한글 변경 
  @imagettftext($simg_im, $fn_size, 0, $text_pos_x, $text_pos_y, $fn_color, $_SERVER['DOCUMENT_ROOT']."/GULIM.TTC",$simg_str); //글자 적기 

	//$org_simg_im = imagecreatefromjpeg($org_simg_im); // 원본 이미지를 다시한번 읽고

	imagecopymerge($simg_im,$simg_im2,0,0,0,0,$w,$h,$opacity); // 원본과 워터마크를 찍은 이미지를 적당한 투명도로 겹치기
  //@imagettftext($simg_im, 10, 0, 10, 20, $color_FFFFFF, $_SERVER['DOCUMENT_ROOT']."/GULIM.TTC",$simg_str); //글자 적기 
} 


if($simg_name) { 
    if($simg_type==1) { 
        imagegif($simg_im,$simg_name);            //원본 이미지: gif 
    } else if($simg_type==2) { 
        imagejpeg($simg_im,$simg_name,80);            //원본 이미지: jpg 
    } else if($simg_type==3) { 
        imagepng($simg_im,$simg_name);            //원본 이미지: png 
    } 
} else { 
        Header("Content-Disposition: attachment;; filename=".basename($img_file)); 
        header("Content-Transfer-Encoding: binary"); 
    if($simg_type==1) { 
        header("Content-type: image/gif");  //이미지 타입에 맞도록 해더 구성 
        imagegif($simg_im);            //원본 이미지: gif 
    } else if($simg_type==2) { 
        header("Content-type: image/jpg");  //이미지 타입에 맞도록 해더 구성 
        imagejpeg($simg_im,'',80);            //원본 이미지: jpg 
    } else if($simg_type==3) { 
        header("Content-type: image/png");  //이미지 타입에 맞도록 해더 구성 
        imagepng($simg_im);            //원본 이미지: png 
    } 
} 

// 메모리에 있는 그림 삭제 
imagedestroy($img_im); 
imagedestroy($simg_im);
}
*/

//================================================================================
// 워터마크 (png파일) 만들기
function WatermarkImage($CanvasImage, $WatermarkImage, $Opacity, $Quality, $WatermarkLocate){
  list($img_width, $img_height, $imgtype, $img_attr) = getimagesize($CanvasImage); //소스이미지파일 크기 

  // create true color canvas image:
  if($imgtype==1) {
	  $canvas_src = imagecreatefromgif($CanvasImage);
  } else if($imgtype==2) {
	  $canvas_src = imagecreatefromjpeg($CanvasImage);
  } else if($imgtype==3) {
	  $canvas_src = imagecreatefrompng($CanvasImage);
  }

  $canvas_w = ImageSX($canvas_src);
  $canvas_h = ImageSY($canvas_src);
  $canvas_img = imagecreatetruecolor($canvas_w, $canvas_h);
  imagecopy($canvas_img, $canvas_src, 0,0,0,0, $canvas_w, $canvas_h);
  imagedestroy($canvas_src);    // no longer needed

  // create true color overlay image:
  $overlay_src = imagecreatefrompng($WatermarkImage);
  $overlay_w = ImageSX($overlay_src);
  $overlay_h = ImageSY($overlay_src);
  $overlay_img = imagecreatetruecolor($overlay_w, $overlay_h);
  imagecopy($overlay_img, $overlay_src, 0,0,0,0, $overlay_w, $overlay_h);
  imagedestroy($overlay_src);    // no longer needed

  // setup transparent color (pick one):
  //$black  = imagecolorallocate($overlay_img, 0x00, 0x00, 0x00);
  //$white  = imagecolorallocate($overlay_img, 0xFF, 0xFF, 0xFF);
  //$magenta = imagecolorallocate($overlay_img, 0xFF, 0x00, 0xFF);
  $black  = imagecolorallocate($overlay_img, 0, 0, 0);
  $white  = imagecolorallocate($overlay_img, 0, 0, 0);
  $magenta = imagecolorallocate($overlay_img, 0, 0, 0);
  // and use it here:
  imagecolortransparent($overlay_img, $white);

  // 워터마크 이미지의 위치(기본값은 가운데 1입니다.)
  switch ($WatermarkLocate) {
case 0:  // 좌측상단
  $ww = 0;
  $wh = 0;
  break;
  case 1: // 가운데
  $ww = ($canvas_w / 2) - ($overlay_w / 2);
  $wh = ($canvas_h / 2) - ($overlay_h / 2);
  break;
  case 2: // 우측하단
  $ww = $canvas_w - ($overlay_w);
  $wh = $canvas_h - ($overlay_h);
  break;
}

  // copy and merge the overlay image and the canvas image:
  imagecopymerge($canvas_img, $overlay_img, $ww,$wh,0,0, $overlay_w, $overlay_h, $Opacity);

  //imagejpeg($canvas_img, $CanvasImage, $Quality);
	imagejpeg($canvas_img, $CanvasImage, $Quality);
/*
  // output:
  header("Content-type: image/jpeg");
  imagejpeg($canvas_img, '', $Quality);
*/
  imagedestroy($overlay_img);
  imagedestroy($canvas_img);
}


### PHP암호화 함수
function amho($data,$k) { 
 $encrypt_these_chars = "1234567890ABCDEFGHIJKLMNOPQRTSUVWXYZabcdefghijklmnopqrstuvwxyz.,/?!$@^*()_+-=:;~{}";
 $t = $data;
 $result2;
 $ki;
 $ti;
 $keylength = strlen($k);
 $textlength = strlen($t);
 $modulo = strlen($encrypt_these_chars);
 $dbg_key;
 $dbg_inp;
 $dbg_sum;
 for ($result2 = "", $ki = $ti = 0; $ti < $textlength; $ti++, $ki++) {
  if ($ki >= $keylength) {
   $ki = 0;
  }
  $dbg_inp += "["+$ti+"]="+strpos($encrypt_these_chars, substr($t, $ti,1))+" ";   
  $dbg_key += "["+$ki+"]="+strpos($encrypt_these_chars, substr($k, $ki,1))+" ";   
  $dbg_sum += "["+$ti+"]="+strpos($encrypt_these_chars, substr($k, $ki,1))+ strpos($encrypt_these_chars, substr($t, $ti,1)) % $modulo +" ";
  $c = strpos($encrypt_these_chars, substr($t, $ti,1));
  $d;
  $e;
  if ($c >= 0) {
   $c = ($c + strpos($encrypt_these_chars, substr($k, $ki,1))) % $modulo;
   $d = substr($encrypt_these_chars, $c,1);
   $e .= $d;
  } else {
   $e += $t.substr($ti,1);
  }
 }
 $key2 = $result2;
 $debug = "Key  : "+$k+"\n"+"Input: "+$t+"\n"+"Key  : "+$dbg_key+"\n"+"Input: "+$dbg_inp+"\n"+"Enc  : "+$dbg_sum;
 return $e . "";
}


function bokho($key2,$secret) {
 $encrypt_these_chars = "1234567890ABCDEFGHIJKLMNOPQRTSUVWXYZabcdefghijklmnopqrstuvwxyz.,/?!$@^*()_+-=:;~{}";
 $input = $key2;
 $output = "";
 $debug = "";
 $k = $secret;
 $t = $input;
 $result;
 $ki;
 $ti;
 $keylength = strlen($k);
 $textlength = strlen($t);
 $modulo = strlen($encrypt_these_chars);
 $dbg_key;
 $dbg_inp;
 $dbg_sum;
 for ($result = "", $ki = $ti = 0; $ti < $textlength; $ti++, $ki++) {
  if ($ki >= $keylength){
   $ki = 0;
  }
  $c = strpos($encrypt_these_chars, substr($t, $ti,1));
  if ($c >= 0) {
   $c = ($c - strpos($encrypt_these_chars , substr($k, $ki,1)) + $modulo) % $modulo;
   $result .= substr($encrypt_these_chars , $c, 1);
  } else {
   $result += substr($t, $ti,1);
  }
 }
 return $result;
} 

/*
암호화 사용 예:
$data = "iloveyou!good"; //암호화 해서 넘길 값
$key = "123456"; //암호화에 이용될 키 값
$edata = encrypt($data,$key); //key 값을 이용해 data 값을 암호화해서 edata에 담았습니다.
$getdata = urlencode($edata); //이 값을 post가 아닌 get으로 넘긴다면 urlencode를 해주시는게 좋겠죠!
echo $getdata; //최종 암호화 및 url 엔코드까지 한 값 입니다.

출력 : imqyi%3Fov%40jstd

출력된 값만 봐서는 도저히 어떤 값인지 모르겠죠?
이제 위 값으로 복호화 해 보겠습니다.

복호화 사용 예 :
$data = urldecode($getdata); //urlencode로 받은 값을 먼저 urldecode 처리해야함
$key = "123456"; //암호화 할 때 이용한 키값과 동일하게 사용
$ddata = decrypt($data,$key); //복호화 처리
echo $ddata; //최종 복호화 값 전달하고자 하는 값이 제대로 전달 되었군요!

출력결과 : iloveyou!good
*/

function check_value($aa,$value){
 $return='N';
 $split=split(",",$aa);
 for($i=0;$i<count($split);$i++){
  if($split[$i]==$value){
   $return='Y';
   break;
  }
 }
 return $return;
}

function new_ambo($su){
   $pass_pool=array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','x','y','z','0','1','2','3','4','5','6','7','8','9');
   $new_pass='';
   for($i = 0; $i < $su; $i++){
	$rand_num = array_rand($pass_pool); 
	$new_pass.= $pass_pool[$rand_num];
   }
   return $new_pass;
}

function hwakin($value,$value2){
 $return="";
 $value2=explode('-',$value2);
 $return=$value2[ceil($value)];
 return $return;
}

function hwakin2($value){
 $return="";
 switch ($value){
  case "10" :
  $return="확인중";
  break;
  case "20" :
  $return="진행중";
  break;
  case "30" :
  $return="부재1";
  break;
  case "40" :
  $return="부재2";
  break;
  case "50" :
  $return="부재3";
  break;
  case "60" :
  $return="완료";
  break;
  case "70" :
  $return="불가";
  break;
  case "80" :
  $return="취소";
  break;
 }
 return $return;
}

function suyoil($value1,$value2,$value3){
 $return="";
  switch ($value1){
   case "0" :
	$return="4,11,18,25";
	break;
   case "1" :
	if($value2!="2" && $value2!="4" && $value2!="6" && $value2!="9" && $value2!="11"){
	 if($value2=="10" && $value3=="2012"){
		 $return="10,17,24,31";
	 }else{
		 $return="3,10,17,24,31";
	 }
	}else{
	 if($value2=="10" && $value3=="2012"){
		 $return="10,17,24";
	 }else{
		 $return="3,10,17,24";
	 }
	}
	break;
   case "2" :
	if($value2!="2"){
	 $return="2,9,16,23,30";
	}else{
	 $return="2,9,16,23";
	}						 
	break;
   case "3" :
	if(($value2=="2" && ceil($value3) % 4 == 0) || $value2!="2"){
	 $return="1,8,15,22,29";
	}else{
	 $return="1,8,15,22";
	}
	break;
   case "4" :
	$return="7,14,21,28";
	break;
   case "5" :
	$return="6,13,20,27";
	break;
   case "6" :
	$return="5,12,19,26";
	break;
  }
  return $return;
 }


function sql_password($value)
{
    // mysql 4.0x 이하 버전에서는 password() 함수의 결과가 16bytes
    // mysql 4.1x 이상 버전에서는 password() 함수의 결과가 41bytes
    $row = sql_fetch(" select password('$value') as pass ");

    return $row['pass'];
}


function imgTag($content) {
	preg_match_all('!<img([^\>]*)src=([^\>]*?)\>!is', $content, $matches);
	foreach($matches[0] as $key => $val) {
		$content = str_replace($val,"",$content);
		preg_match_all('/([^=^"^ ]*)src=([^ ^>]*)/i', $val, $src_match);
		$src[] = str_replace("\"","",$src_match[2][0]);
	}
	return $src;
} 


//대괄호배열
function getArrayString($str)
{
	$arr1 = array();
	$arr1['data'] = array();
	$arr2 = explode('[',$str);
	foreach($arr2 as $val)
	{
		if($val=='') continue;
		$arr1['data'][] = str_replace(']','',$val);
	}
	$arr1['count'] = count($arr1['data']);
	return $arr1;
}


// 메일 전송
function mailToSend($mailArg) {

	$homeUrl = "http://".$mailArg["host"];
	//$mailArg['fromName']='=?UTF-8?B?'.base64_encode($mailArg['fromName']).'?=';
	$fromName='=?UTF-8?B?'.base64_encode($mailArg['fromName']).'?=';
	$headers = "From:".$fromName."<".$mailArg['fromEmail'].">\n";
	$headers .= "X-Sender:<".$mailArg['fromEmail'].">\n";
	$headers .= "X-Mailer:PHP\n";
	$headers .= "Return-Path:<".$mailArg['fromEmail'].">\n";
	$headers .= "Content-Type:text/html;charset=utf-8\n";
	$headers .= "\n";

	switch($mailArg['mailSendType']) {
		case 'memberJoin':
				$m_contents = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/mail/letter.html');
				$m_contents = str_replace("@HOMEURL@",$homeUrl,$m_contents);
				$m_contents = str_replace("@NAME@",$mailArg['name'],$m_contents);
				$m_contents = str_replace("@ID@",$mailArg['userid'],$m_contents);

				$m_contents = str_replace("@ETC1@","회원님은 <font color='#000000'>".date('Y')."년 ".date('m')."월 ".date('d')."일</font> 웹회원이 되셨습니다.",$m_contents);
				$m_contents = str_replace("@ETC2@"," 회원님, 홈페이지에 가입해 주신 것에 대해 깊이 감사 드리며,기대와 관심에 부응할 수 있도록 끊임없이 노력하겠습니다.",$m_contents);

				$title = "[".$mailArg['fromName']."] 회원가입 확인 메일입니다.";
			break;
		case 'memberIdPw':
			$m_contents = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/mail/letter_idpw.html');
			$m_contents = str_replace("@HOMEURL@",$homeUrl,$m_contents);
			$m_contents = str_replace("@NAME@",$mailArg['name'],$m_contents);
			$m_contents = str_replace("@ID@",$mailArg['userid'],$m_contents);
			$m_contents = str_replace("@PASS@",$mailArg['new_pass'],$m_contents);

			$m_contents = str_replace("@ETC1@"," 회원님께서 요청하신 아이디/패스워드입니다.",$m_contents);
			$m_contents = str_replace("@ETC2@","",$m_contents);

			$title = "[".$mailArg['fromName']."] 비밀번호 확인 메일입니다.";
			break;
		case 'reserveWrite':
			$m_contents = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/mail/letter_webmail.html');
			$m_contents = str_replace("@HOMEURL@",$homeUrl, $m_contents);
			$m_contents = str_replace("@COMMENT@",stripslashes("<strong>".$mailArg["name"]."</strong>님은 <strong>".$mailArg["rsvdate"]."</strong>에 예약을 접수하셨습니다."),$m_contents);

			$title = $mailArg["name"]."님 온라인예약 확인 메일입니다.";
			break;
	}

	$title='=?UTF-8?B?'.base64_encode($title).'?=';

	return mail($mailArg['toEmail'], $title, $m_contents, $headers);
}


// 메세지 출력후 원하는 뒤로
function alert($msg)
{
	echo "
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<script type='text/javascript' language='JavaScript' charset='utf-8'>
		alert('$msg');
	</script>
	";
	exit;
}


// 메세지 출력후 원하는 뒤로
function metaBack($msg)
{
	echo "
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<script type='text/javascript' language='JavaScript' charset='utf-8'>
		alert('$msg');
		history.go(-1);
	</script>
	</body>
	</html>
	";
	exit;
}


// 메세지 출력후 원하는 경로로 이동
function alertTour($msg, $tour)
	{
	echo "
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<script type='text/javascript' language='JavaScript' charset='utf-8'>
		alert('$msg');
		parent.location.href='$tour';
	</script>
	</body>
	</html>
	";
	exit;
}


function e($str) {
	if ($_SERVER['REMOTE_ADDR'] == '112.220.242.228') {
		echo "<br/>";
		echo $str."<br/>";
		echo "<br/>";
	}
}


function v($str) {
	if ($_SERVER['REMOTE_ADDR'] == '112.220.242.228') {
		echo "<br/>";
		var_dump($str);
		echo "<br/>";
	}
}	


function toJson($response) {
	header("Content-Type: application/json");
	header("Cache-Control:no-cashe");
	header("Pragma:no-cashe");
	echo json_encode($response);
	exit;
}
?>