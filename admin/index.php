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
		
		$stmt=mysql_query("select * from tblPerMember where tblStrID='$strID'",$connect);
		$row=mysql_fetch_array($stmt);
		  
		if ($row['tblPassType'] == 'ksq') {		// 마이그레이션 데이터 일경우
			$pass = md5($strPass);
			$strsql="select * from tblPerMember where tblStrID='$strID' and tblStrPass='$pass' AND tblIntLevel<=2";
		} else {
			$strsql="select * from tblPerMember where tblStrID='$strID' and tblStrPass=password('$pwd') AND tblIntLevel<=2";
		}

		$sql = mysql_query( "SELECT * FROM tblAdminMember WHERE tblStrID='$strID' AND tblStrPass='$strPass' AND tblIntLevel<=2" );
		$arr = mysql_fetch_array( $sql );

		$sql2 = mysql_query( $strsql );
		$arr2 = mysql_fetch_array( $sql2 );

		// 로그인 성공시
		if( $arr[tblStrID] ) {

			$_SESSION['ss_id']				= $arr[tblStrID];
			$_SESSION['ss_name']			= $arr[tblStrName];
			$_SESSION['ss_nickname']		= $arr[tblStrNickName];
			$_SESSION['ss_email']			= $arr[tblStrEmail];
			$_SESSION['ss_phone']			= $arr[tblStrPhone];
			$_SESSION['ss_mobile']			= $arr[tblStrMobile];
			$_SESSION['ss_level']			= $arr[tblIntLevel];

			echo "<script language='javascript'>";
			echo "	location.href='./main.php';";
			echo "</script>";
		} else if( $arr2[tblStrID] ) {
			
			$_SESSION['ss_id']				= $arr2[tblStrID];
			$_SESSION['ss_name']			= $arr2[tblStrName];
			$_SESSION['ss_nickname']		= $arr2[tblStrNickName];
			$_SESSION['ss_email']			= $arr2[member_email];
			$_SESSION['ss_phone']			= $arr2[member_phone];
			$_SESSION['ss_mobile']			= $arr2[member_mobile];
			$_SESSION['ss_level']			= $arr2[tblIntLevel];
			$_SESSION['ss_gp']				= $arr2[tblIntGP];

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
		echo "	alert('{$_SESSION['ss_name']} 님 로그아웃 되었습니다.\\n\\n이용해주셔서 감사합니다.');";
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
<link href="/admin/css/login.css" rel="stylesheet" type="text/css" />
<script language="javascript">
	// 초기커서 위치
	window.onload=function()
		{
		document.all.strID.focus();
	}
</script>
<script src="/admin/js/design_js.js"></script>
<script src="/js/jquery-1.9.1.min.js"></script>
<script src="/js/total.js"></script>
<!-- 익스6 png 핵 - (div 내에서 배경png 적용시에 사용, 태그내에 a 링크 사용가능) -->
<!--[if IE 6]>
<script type="text/javascript" src="/admin/js/DD_belatedPNG.js"></script>
<script type="text/javascript">
 DD_belatedPNG.fix('img, #bodyWrap');
</script>
<![endif]-->
</head>
<body>
	<div id="al_wrap">
	<div class="al_center">
		<h1><img src="images/login/login_logo.jpg" /></h1>
		<div class="al_form">
		<form name="frmLogin" method="post" action="<?=$PHP_SELF?>" style="margin:0px;">
		<input type="hidden" name="proc" value="login">
			<p><img src="images/login/login_title.jpg" /></p>
			<ul>
				<li class="al_input_area1">
					<p class="first"><img src="images/login/login_id.jpg" /></p>
					<p><img src="images/login/login_pw.jpg" /></p>
				</li>
				<li class="al_input_area2">
					<p class="first"><input class="al_input" name="strID" type="text" tabindex="1" style="width:158px;" itemname="아이디" required memberid></p>
					<p><input name="strPass" type="password" class="al_input" style="width:158px;" tabindex="2" itemname="패스워드" required></p>
				</li>
				<li>
					<input name="image" type="image" tabindex="3" src="images/login/login_btn.jpg" />
				</li>
			</ul>
		</form>
		</div>
		<div class="al_banner">
			<img src="images/login/login_banner.jpg" />
		</div>
	</div>
</div>
</body>

</body>
</html>