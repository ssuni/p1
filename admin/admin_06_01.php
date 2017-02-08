<? include "inc/head.php" ?>
<?
$sub_menu = '600100';
auth_check($auth[$sub_menu]);

$pageNum = 6;
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
<?	
	if( !$act || $act == 'list' ) { 

		$whereIs = ( $whereIs ) ? $whereIs : "";
		/*검색에 사용할 변수 설정 시작*/
		$sh["level"]		= $level;
		$sh["place"]		= $place;
		$sh["sex"]			= $sex;
		$sh["blnemail"] = $blnemail;
		$sh["blnsms"]		= $blnsms;
		$sh["age"]			= $age;
		$sh["search"]		= $search;
		$sh["keyword"]	= $keyword;
		/*검색에 사용할 변수 설정 끝*/

		if( trim( $sh["level"] ) != '' ) {
			$whereIs .= ( $whereIs ) ? " AND tblIntLevel='".$sh["level"]."'" : "WHERE tblIntLevel='".$sh["level"]."'";
		}
		
		if( $sh["blnemail"] ) {
			$whereIs .= ( $whereIs ) ? " AND tblBlnEmail='".$sh["blnemail"]."'" : "WHERE tblBlnEmail='".$sh["blnemail"]."'";
		}

		if( $sh["blnsms"] ) {
			$whereIs .= ( $whereIs ) ? " AND tblBlnSms='".$sh["blnsms"]."'" : "WHERE tblBlnSms='".$sh["blnsms"]."'";
		}
		
	
		if( $sh["search"] && $sh["keyword"] ) {
			$whereIs .= ( $whereIs ) ? " AND ".$sh["search"]." LIKE '%".$sh["keyword"]."%'" : "WHERE ".$sh["search"]." LIKE '%".$sh["keyword"]."%'";
		}

		$p = ( !$p ) ? "1" : $p;
		$linenum = ( $linenum ) ? $linenum : "50";
		$startnum = ( $p - 1 ) * $linenum;
		$countQuery = mysql_query( "SELECT tblNumber FROM tblPerMember ".$whereIs );
		$count_arr = mysql_num_rows( $countQuery );
		$data_num = $count_arr;
		$viewCount = $data_num - $startnum;
		@$total_page = intval( ( $data_num - 1 ) / $linenum )+1;

		$tmp = 0;
		$Query = "SELECT * FROM tblPerMember ".$whereIs." ORDER BY tblDtmRegDate ASC LIMIT ".$startnum.", ".$linenum;
		$Sql = mysql_query( $Query );
		while( $Array = mysql_fetch_array( $Sql ) ) {
			switch($Array["tblSnsType"]) {
				case 'naver':	$Data[$tmp]["sns"] = '네이버';	break;
				case 'kakao':	$Data[$tmp]["sns"] = '카카오';	break;
				case 'facebook':	$Data[$tmp]["sns"] = '페이스북';	break;
			}

			$Data[$tmp]["number"] = $Array["tblNumber"];
			$Data[$tmp]["level"]	= $memberNameArr[$Array["tblIntLevel"]];
			$Data[$tmp]["id"]			= $Array["tblStrID"];
			$Data[$tmp]["name"]		= $Array["tblStrName"];
			$Data[$tmp]["mobile"]	= $Array["tblStrMobile"];
			$Data[$tmp]["email"]	= $Array["tblStrEmail"];
			$tmp++;
		}

		include ( "./html/mailing_list.html" );
	}


	if( $act == 'mailsend' ) {
		if( count( $_POST['chk'] ) > 0 ) {
			for( $i = 0; $i < count( $chk ); $i++ ) {
				$mQuery = "SELECT tblStrName, tblStrEmail from tblPerMember WHERE tblNumber='".$_POST['chk'][$i]."'";
				$mSql = mysql_query( $mQuery );
				while( $mArray = mysql_fetch_array( $mSql ) ) {

					$mailData["name"]		= $mArray["tblStrName"];
					$mailData["email"]		= $mArray["tblStrEmail"];
					$mailData["subject"]	= stripslashes( $strSubject );
					$mailData["comment"]	= stripslashes( $strComment );

					$homeUrl = "http://".$bagData["host"];
					$fromname = $bagData["siteName"];
					$fromname='=?UTF-8?B?'.base64_encode($fromname).'?=';
					$fromaddress = $admData["email"];
					$server_mail = $admData["email"];
					$headers = "From:".$fromname."<".$fromaddress.">\n"; 
					$headers .= "X-Sender:<".$server_mail.">\n";
					$headers .= "X-Mailer:PHP\n";
					$headers .= "Return-Path:<".$fromaddress.">\n";
					$headers .= "Content-Type:text/html;charset=utf-8\n";
					$headers .= "\n";
					/*$fp = fopen($_SERVER['DOCUMENT_ROOT']."/mail/mail_join.html","r");
					$m_content = fread($fp,"100000");
					fclose($fp);*/
					$m_contents = sock_url( $bagData["host"], "80", "http://".$bagData["host"]."/mail/letter_webmail.html");
					$m_contents = str_replace("@HOMEURL@",$homeUrl,$m_contents);
					$m_contents = str_replace("@COMMENT@",$mailData["comment"],$m_contents);
					$m_contents_arr = explode("\r\n\r\n",$m_contents);
					$m_contents = $m_contents_arr[1];

					$title = $mailData["subject"];
					$title='=?UTF-8?B?'.base64_encode($title).'?=';
					$res = mail($mailData["email"],$title,$m_contents,$headers,"-f$fromaddress");
				}
			}
		}
		echo "<script language='javascript'>";
		echo "	location.href='$PHP_SELF'";
		echo "</script>";
		exit;
	}	?>
				<!--- end : 본문 --->
			</div>
		</div><div class="clr"></div>
	</div>
	<? include "inc/bottom.php" ?>
</div>
</body>
</html>