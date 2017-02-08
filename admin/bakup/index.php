<?	include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";		
	include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
	include $_SERVER['DOCUMENT_ROOT']."/include/function.php";	
	
	$admin=$_REQUEST["proc"];
	$strID=$_POST["strID"];
	$strPass=$_POST["strPass"];
	
	if( $admin == 'login' ) {
		if( !get_magic_quotes_gpc() ) {
			$strID = addslashes( $strID );
		}		
		$sql = mysql_query( "SELECT * FROM tblAdminMember WHERE tblStrID='$strID' AND tblStrPass='$strPass' AND tblIntLevel<=2" );
		$arr = mysql_fetch_array( $sql );

		$sql2 = mysql_query( "SELECT * FROM $table_member WHERE tblStrID='$strID' AND tblStrPass=password('$strPass') AND tblIntLevel<=2" );
		$arr2 = mysql_fetch_array( $sql2 );

		// 로그인 성공시
		if( $arr[tblStrID] ) {
			session_register( "ss_id", "ss_name", "ss_nickname", "ss_phone", "ss_email", "ss_mobile", "ss_level" );
			session_set_cookie_params( 0, "/",".optimaclinic.co.kr" );
			
			$ss_id				= $arr[tblStrID];
			$ss_name			= $arr[tblStrName];
			$ss_nickname		= $arr[tblStrNickName];
			$ss_email			= $arr[tblStrEmail];
			$ss_phone			= $arr[tblStrPhone];
			$ss_mobile			= $arr[tblStrMobile];
			$ss_level			= $arr[tblIntLevel];

			echo "<script language='javascript'>";
			echo "	location.href='./main.php';";
			echo "</script>";
		} else if( $arr2[member_account] ) {
			session_register( "ss_id", "ss_name", "ss_nickname", "ss_phone", "ss_email", "ss_mobile", "ss_level", "ss_gp");
			session_set_cookie_params( 0, "/",".optimaclinic.co.kr" );
			
			$ss_id				= $arr2[member_account];
			$ss_name			= $arr2[member_name];
			$ss_nickname		= $arr2[tblStrNickName];
			$ss_email			= $arr2[member_email];
			$ss_phone			= $arr2[member_phone];
			$ss_mobile			= $arr2[member_mobile];
			$ss_level			= $arr2[tblIntLevel];
			$ss_gp				= $arr2[tblIntGP];

			echo "<script language='javascript'>";
			echo "	location.href='./main.php';";
			echo "</script>";
		} else {
			echo "<script language='javascript'>";
			echo "	alert('아이디/비번이 잘못되었거나 권한이 없습니다.\\n\\n관리자만이 로그인할 수 있습니다.\\n');";
			echo "	location.href='./';";
			echo "</script>";
		}
		exit;
	}

	if ( $admin == "logout" ) {
		session_destroy();
		echo "<script language='javascript'>";
		echo "	alert('$ss_name 님 로그아웃 되었습니다.\\n\\n이용해주셔서 감사합니다.');";
		echo "	location.href='./'; ";
		echo "</script>";
		exit;
	}
		
	if($_SESSION["ss_id"]!='' && $_SESSION["ss_level"] <= 2){
		Header("Location:http://".$bagData["host"]."/admin/main.php");
		exit;	
	}	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:::<?=$bagData["siteName"]?> 관리자페이지:::</title>
<link href="/admin/css/admin.css" rel="stylesheet" type="text/css" />
<script language="javascript">
	// 초기커서 위치
	window.onload=function()
		{
		document.all.strID.focus();
	}
</script>
<script src="/admin/js/design_js.js"></script>
<script src="/js/total.js"></script>
<!-- 익스6 png 핵 - (div 내에서 배경png 적용시에 사용, 태그내에 a 링크 사용가능) -->
<!--[if IE 6]>
<script type="text/javascript" src="/admin/js/DD_belatedPNG.js"></script>
<script type="text/javascript">
 DD_belatedPNG.fix('img, #bodyWrap');
</script>
<![endif]-->
</head>
<body class="indexBg">
	<div class="indexWrap">
		<div class="loginWrap">
			<div id="loginBox">
				<form name="frmLogin" method="post" action="<?=$PHP_SELF?>" style="margin:0px;">
				<input type="hidden" name="proc" value="login">
				<table border="0" cellspacing="0" cellpadding="0" class="formTable">
					<tr>
						<td><img src="images/index/login_tt1.gif" /></td>
						<td class="formBg"><input class="indexInput" name="strID" type="text" tabindex="1" style="width:158px;" itemname="아이디" required memberid></td>
						<td rowspan="2"><input name="image" type="image" tabindex="3" src="images/index/login_btn.gif"></td>
					</tr>
					<tr>
						<td><img src="images/index/login_tt2.gif" /></td>
						<td class="formBg"><input name="strPass" type="password" class="indexInput" style="width:158px;" tabindex="2" itemname="패스워드" required>
						</td>
					</tr>
				</table>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
<script language="javascript" src="/js/wrest.js"></script>