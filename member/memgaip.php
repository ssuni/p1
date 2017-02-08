<?
include $_SERVER['DOCUMENT_ROOT']."/include/session_start.php";	
include $_SERVER['DOCUMENT_ROOT']."/include/dbconfig.php";
include $_SERVER['DOCUMENT_ROOT']."/include/function.php";

$mode=$_POST["mode"];
$url=$_POST["url"];
$time=time();
$tblsection="general";  //empty

if ($mode=="join2" || $mode=="edit"){
	$userid = eregi_replace(" ","",$_POST["strUserId"]);  //아이디
	$idchch = eregi_replace(" ","",$_POST["idchch"]);  //아이디중복확인값
	$pwd = eregi_replace(" ","",$_POST["pwd"]);  //비번
	$name = eregi_replace(" ","",$_POST["strName"]);  //이름
	$phone = eregi_replace(" ","",$_POST["phone1"])."-".eregi_replace(" ","",$_POST["phone2"])."-".eregi_replace(" ","",$_POST["phone3"]);  //휴대폰
	$email = implode("@", $_POST["strEmail"]);  //이메일
	$ismail = eregi_replace(" ","",$_POST["ismail"]);
	$issms = eregi_replace(" ","",$_POST["issms"]);
	if ($ismail=="") $ismail="N";
	if ($issms=="") $issms="N";
}

switch($mode) {
	case 'join2':		//회원가입시만
		if ($userid=="" || strlen($userid) < 4 || strlen($userid) > 15){
			alert('아이디는 숫자 또는 영문만 입력가능하며, 4~15자 이내로 작성해야 합니다.');
		}
		if ($idchch=="" || str_replace("_","",$idchch)!='checkingsuccess'){
			alert('아이디 중복확인을 해주세요!');
		}
		if ($pwd!=$_POST["repwd"]){
			alert('비밀번호가 일치하지 않습니다! 다시 입력해 주세요.');
		}
		if ($pwd=="" || strlen($pwd) < 4 || strlen($pwd) > 15){
			alert('비밀번호는 숫자 또는 영문만 입력가능하며, 4~15자 이내로 작성해야 합니다.');
		}
		if (strlen($phone) < 12 || strlen($phone) > 13){
			alert('핸드폰번호를 정확히 입력하세요.');
		}

	$sibb=0;
	if (strlen($userid) < 4 || strlen($userid) > 15) $sibb=1; else if (strlen($pwd) < 4 || strlen($pwd) > 15) $sibb=2; else if (mb_strlen($name,"euc-kr") < 3 || mb_strlen($name,"euc-kr") > 6) $sibb=3; else if (strpos("a".$email,".")==false) $sibb=9; else if (strpos("a".$email,"@")==false) $sibb=10; else if (strlen($phone) < 12) $sibb=11;

		$wonin="";
		switch($sibb){
			case 1 :
				$wonin="아이디 4자 미만 또는 15자 초과";
			break;
			case 2 :
				$wonin="비밀번호 4자 미만 또는 15자 초과";
			break;
			case 3 :
				$wonin="이름 3자 미만 또는 6자 초과";
			break;
			case 10 :
				$wonin="이메일 입력오류(@)";
			break;
			case 11 :
				$wonin="휴대폰번호";
			break;
		}
		if ($sibb>0){
			alert('회원정보를 정확히 입력해 주십시오! 오류번호 : '.$sibb.'['.$wonin.']');
		}

		if ($_SESSION["ss_id"]!=""){
			alertTour('로그아웃을 하시고 가입신청을 하시기 바랍니다.', $url);
		}

		$strsql="select tblStrID from tblPerMember where tblStrID='$userid'";
		$stmt=mysql_query($strsql,$connect);
		$rows=mysql_num_rows($stmt);
		if ($rows!=0 || !$userid){
			alert('이미 아이디가 존재합니다. 다시 입력해 주십시오.');
		}
		unset($rows);
		mysql_free_result($stmt);
		unset($stmt);

		$mlevel=8;  //웹회원 레벨

		$iQue = "INSERT INTO tblPerMember SET ";
		$iQue .= "tblStrID = '".$userid."',";
		$iQue .= "tblStrName = '".$name."',";
		$iQue .= "tblSection = '".$tblsection."',";
		$iQue .= "tblStrPass=password('".$pwd."'),";
		$iQue .= "tblStrMobile = '".$phone."',";
		$iQue .= "tblBlnEmail = '".$ismail."',";
		$iQue .= "tblBlnSms = '".$issms."',";
		$iQue .= "tblStrEmail = '".$email."',";
		$iQue .= "tblIntLevel = '".$mlevel."',";
		$iQue .= "tblDtmRegDate = now(),";
		$iQue .= "tblDtmLastDate= now(),";
		$iQue .= "tblDtmRegIp = '".$_SERVER['REMOTE_ADDR']."'";
		$stmt = mysql_query($iQue,$connect);

		if ($stmt){   
			$mailArg['host'] = $bagData["host"];
			$mailArg['fromName'] = $bagData["siteName"];
			$mailArg['fromEmail'] = $admData["email"];
			$mailArg['toEmail'] = $email;
			$mailArg['userid'] = $userid;
			$mailArg['name'] = $name;
			$mailArg['mailSendType'] = 'memberJoin';

			$result = mailToSend($mailArg);

			if ($result){

				// 전환,공통 스크립트
				include $_SERVER['DOCUMENT_ROOT']."/include/switch_script.php";  
				include $_SERVER['DOCUMENT_ROOT']."/include/common_script.php"; 

				alertTour('회원가입이 성공적으로 되었습니다.', $url);
			} else {
				alertTour('회원가입 메일발송 실패!', $url);
			}
		} else {
			alert('데이터베이스의 입력이 실패되었습니다. 고객센터로 연락주시면 해결해 드리겠습니다.');
		}
		break;

	case 'edit':	//수정시
		$sibb=0;
		if (strpos("a".$email,"@")==false) $sibb=10; else if (strlen($phone) < 12) $sibb=11;
			$wonin="";
			switch($sibb){
				case 10 :
					$wonin="이메일 입력오류(@)";
				break;
				case 11 :
					$wonin="휴대폰번호";
				break;
			}
			if ($sibb>0){
				alert('회원정보를 정확히 입력해 주십시오! 오류번호 : '.$sibb.'['.$wonin.']');
			}

		if ($_SESSION["ss_id"]==""){
			alertTour('로그인을 하시고 회원정보수정을 하시기 바랍니다.', $url);
		}

		if (!$_POST["sns"]){
			if ($_POST["newpwd"]!=""){
				if ($_POST["newpwd"]!=$_POST["re_newpwd"]){
					alert('새로운 비밀번호와 비밀번호 확인 값이 맞지 않습니다.');
				}
			}
			$chkemail = eregi_replace(" ","",$_POST["chkemail"]);  //기존이메일
			if ($chkemail!=$email){  //이메일이 다르다면 다른 회원들 이메일과 비교
				$strsql="select * from tblPerMember where tblStrEmail='$email' and tblStrID <> '$userid'";
				$stmt=mysql_query($strsql,$connect);
				$rows=mysql_num_rows($stmt);
				if ($rows!=0){
					alert('이미 같은 이메일을 사용하는 회원이 계십니다. 다시 입력해 주십시오.');
				}
				mysql_free_result($stmt);
				unset($stmt);
				unset($rows);  
			}


			$stmt=mysql_query("select * from tblPerMember where tblStrID='$userid'",$connect);
			$row=mysql_fetch_array($stmt);
		  
			if ($row['tblPassType'] == 'ksq') {		// 마이그레이션 데이터 일경우
				$pass = md5($pwd);
				$strsql="select * from tblPerMember where tblStrID='$userid' and tblStrPass='$pass'";
			} else {
				$strsql="select * from tblPerMember where tblStrID='$userid' and tblStrPass=password('$pwd')";
			}
			$stmt=mysql_query($strsql,$connect);
			$rows=mysql_num_rows($stmt);
			if ($rows==0 || !$userid){
				alert('비밀번호가 틀렸습니다. 다시 입력해 주십시오.');
			}
			mysql_free_result($stmt);
			unset($stmt);
			unset($rows);
		}

		$strsql = "update tblPerMember set ";
		if ($_POST["newpwd"] != "") $strsql .= "tblStrPass = password('".$_POST["newpwd"]."'), tblPassType = '', ";
		$strsql .= "tblStrName = '$name', tblStrEmail = '$email', tblStrMobile = '$phone', ";
		$strsql .= "tblBlnEmail = '$ismail', tblBlnSms = '$issms' ";
		$strsql .= " where tblStrID = '$userid'";
		$sttt=mysql_query($strsql,$connect);

		if ($sttt){
			//session_unset();
			$_SESSION["ss_email"]=$email;
			$_SESSION["ss_name"]=$name;
			$_SESSION["ss_mobile"]=$phone;

			unset($rs);
			unset($stmt);

			alertTour('회원정보가 성공적으로 수정되었습니다.', $url);
		} else {
			alert('데이터베이스의 수정이 실패되었습니다. 관리자에게 문의하여 주세요.');
		}
		unset($sttt);

		break;

	case 'del':			//탈퇴시
		if ($_SESSION["ss_id"]==""){
			echo "<script>alert('로그인을 하시고 접속해 주십시오.'); window.parent.location.href='".$url."';</script>";
			exit;
		}
		$userid = eregi_replace(" ","",$_POST["strUserId"]);  //아이디
		$duserid=$_POST["duserid"];
		$content = stripslashes($_POST["content"]);
		$reason=$_POST["reason"];
		if ($userid!=$duserid){
			echo "<script>alert('본인 아이디로 회원탈퇴를 해주시기 바랍니다!'); window.parent.location.href='".$url."';</script>";
			exit;
		}
		if (!$duserid || !$pwd || !$content){
			echo "<script>alert('아이디, 비밀번호, 사유, 바라는점 모두 입력해 주시기 바랍니다!');</script>";
			exit;
		}

		$search="select * from tblPerMember where tblStrID='$userid' and tblStrPass=password('$pwd')";
		$stmt=mysql_query($search,$connect);
		$row=mysql_num_rows($stmt);

		if ($row!=0){
			$sql="insert into tblPerMember_Del set reason='$reason', hope='$content', deldate=now()";
			$good=mysql_query($sql,$connect);
		  
			$strsql="update tblPerMember set memDel='Y', memDel_reason='$reason', memDel_hope='$content', memDel_date=now() where tblStrID='$userid'";
			$stmm=mysql_query($strsql,$connect);
				if ($stmm){
					session_unset();
					session_destroy();

					echo "<script>alert('탈퇴신청이 되었습니다. 관리자가 확인하는대로 처리가 이루어 질 것입니다. 감사합니다.'); window.parent.location.href='".$url."';</script>";
					exit;
			} else {
				echo "<script>alert('오류!! 탈퇴에 실패하였습니다.'); //window.parent.location.href='".$url."';</script>";
				exit;
			}
		} else {
			echo "<script>alert('비밀번호 또는 아이디가 잘못 입력되었습니다.');</script>";
			exit;
		}
		break;

	case 'login':		//회원로그인시
		$pwd=$_POST["pwd"];
		$userid=$_POST["userid"];
		if (!$userid || !$pwd){
			echo "<script>alert('아이디 또는 비밀번호를 입력해 주십시오.'); window.parent.location.href='".$url."';</script>";
			exit;
		} else {
			$strsql="select tblStrID,memDel from tblPerMember where tblStrID='$userid'";
			$stmt=mysql_query($strsql,$connect);
			$rows=mysql_num_rows($stmt);
			if ($rows==0){
				echo "<script>alert('존재하지 않는 아이디입니다. 다시 입력해 주십시오.'); window.parent.location.href='".$url."';</script>";
				exit;
			} else {
				$ds=mysql_fetch_array($stmt);
				if ($ds["memDel"]=='Y'){
					echo "<script>alert('회원님은 지금 탈퇴신청중입니다. 해제를 원하신다면 관리자에게 전화문의 하시기 바랍니다.'); window.parent.location.href='/member/login.php';</script>";
					exit;
				}
				unset($ds);
			}
			mysql_free_result($stmt);

			$stmt=mysql_query("select * from tblPerMember where tblStrID='$userid'",$connect);
			$row=mysql_fetch_array($stmt);
	  
			$strsql="select * from tblPerMember where tblStrID='$userid' and tblStrPass in (OLD_PASSWORD('$pwd'),PASSWORD('$pwd')) and memDel <> 'Y'";
			$stmt=mysql_query($strsql,$connect);
			$rows=mysql_num_rows($stmt);
			if ($rows==0){
				echo "<script>alert('비밀번호가 틀렸습니다. 다시 입력해 주십시오.'); window.parent.location.href='".$url."';</script>";
				exit;
			} else {
				$rs=mysql_fetch_array($stmt);
				session_unset();

				$_SESSION["ss_id"] = $rs["tblStrID"];
				$_SESSION["ss_email"] = $rs["tblStrEmail"];
				$_SESSION["ss_name"] = $rs["tblStrName"];
				$_SESSION["ss_level"] = $rs["tblIntLevel"];
				$_SESSION["ss_mobile"] = $rs["tblStrMobile"];

				if ($id_save == 'y'){
					setcookie('ss_id_save',$rs["tblStrID"],time()+864000,'/');
				} else {
					setcookie('ss_id_save','',0,'/');
				}
		
				// 마지막 로그인일자
				$update="update tblPerMember set tblDtmLastDate='".date("Y-m-d H:i:s")."' where tblStrID='".$rs["tblStrID"]."'";
				mysql_query($update,$connect);

				echo "<script>";
				if ($_SESSION["ss_level"] < 6){
					echo "top.location.href='/admin/'";
				} else {
					if ($ref){
						 echo "alert('".$_SESSION["ss_name"]."님 반갑습니다. ^^');window.parent.location.href='".$ref."';</script>";
					} else {
						 echo "alert('".$_SESSION["ss_name"]."님 반갑습니다. ^^');window.parent.location.href='".$url."';</script>";
					}
				}
				echo "</script>";
				unset($rs);
			}
			mysql_free_result($stmt);
			unset($rows);
			unset($stmt);
			unset($strsql);
		}
		break;

	case 'out':		//로그아웃
		session_destroy();
	/*  SetCookie("mss_id","",time()-3600,"/");
	  SetCookie("mss_email","",time()-3600,"/");
	  SetCookie("mss_name","",time()-3600,"/");
	  SetCookie("mss_level","",time()-3600,"/");
	  SetCookie("mss_phone","",time()-3600,"/");
	  SetCookie("mss_mobile","",time()-3600,"/");*/
		 $url = "/";
		 echo "<script>alert('로그아웃 하셨습니다.'); window.parent.location.href='".$url."';</script>";
		break;

	case 'join1':		//약관 동의
		 $agree1 = eregi_replace(" ","",$_POST["agree1"]);
		 $agree2 = eregi_replace(" ","",$_POST["agree2"]);
		 $name = eregi_replace(" ","",$_POST["strName"]);
		 $jumin = eregi_replace(" ","",$_POST["strBirth"]);
		 $email = eregi_replace(" ","",$_POST["strEmail"]);
		 if (!$agree1 || !$agree2 || !$name || !$jumin || !$email){
		  echo "<script>alert('빈 칸 또는 체크를 하셔야 합니다.');</script>";
		  exit;
		 }
		 $sql="select * from tblPerMember where tblStrEmail='$email'"; //tblStrName='$name' and tblIntBirth='$jumin' and tblStrEmail='$email'"; 이메일만 체크해야지
		 $stmt=mysql_query($sql,$connect);
		 $row=mysql_num_rows($stmt);
		 if ($row > 0){
			  $url = "/member/idpw.php";
			  echo "<script>alert('이미 가입된 회원입니다. 아이디 및 비밀번호를 잃어버리셨으면 아이디/비밀번호 찾기를 해주세요.'); window.parent.location.href='$url';</script>";
			  exit;
		 } else {
		?>
	<form method="post" action="<?=$url?>" name="gotothego">
	 <input type="hidden" name="strName" value="<?=$name?>">
	 <input type="hidden" name="strBirth" value="<?=$jumin?>">
	 <input type="hidden" name="strEmail" value="<?=$email?>">
	 <input type="hidden" name="agree1" value="<?=$agree1?>">
	 <input type="hidden" name="agree2" value="<?=$agree2?>">
	 <input type="hidden" name="join1_2" value="ok">
	</form>
	 <script language="JavaScript"> 
		document.gotothego.target="_parent";
		document.gotothego.submit();
	 </script>
	<?  exit;  
	 }
		break;

	case 'idcheck':		//아이디 체크
		  $checking_id = eregi_replace(" ","",$_POST["checking_id"]);
		  if ($checking_id==""){
			  echo "<script>alert('아이디를 입력해 주세요.');</script>";
			  exit;
		  }
		  if (strlen($checking_id) < 4 || strlen($checking_id) > 15){
			  echo "<script>alert('아이디는 숫자 또는 영문만 입력가능하며, 4~15자 이내로 작성해야 합니다.');</script>";
			  exit;
		  }
		  $sql="select * from tblPerMember where tblStrID='$checking_id'";
		  $stmt=mysql_query($sql,$connect);
		  $row=mysql_num_rows($stmt);
		  if ($row > 0){
		   echo "<script>alert('이미 존재하는 아이디입니다. 다른 아이디를 입력해 주세요.'); parent.ElementVar('idchch',''); </script>";
		   exit;
		  } else {
		   echo "<script>alert('[".$checking_id."] 사용가능한 아이디 입니다.'); parent.ElementVar('idchch','c_hec_king_succ_ess_'); </script>";
		   exit;
		  }
		break;

	case 'idpw1':		//아이디 찾기
		 $name = eregi_replace(" ","",$_POST["fname"]);  //이름
		 $email = eregi_replace(" ","",$_POST["femail"]);  //이메일
		  if (!$name || !$email){
			  echo "<script>alert('모든 기재사항을 입력해 주십시오.'); window.parent.location.href='/member/idpw.php';</script>";
			  exit;
		  }
		  $sql="select tblStrID,memDel from tblPerMember where tblStrName='$name' and tblStrEmail='$email'";
		  $stmt=mysql_query($sql,$connect);
		  $row=mysql_num_rows($stmt);
		  if ($row==0){
		   echo "<script>alert('일치하는 정보가 없습니다. 다시 확인하고 입력해 주세요.');window.parent.location.href='/member/idpw.php';</script>";
		   exit;
		  } else {
		   $rs=mysql_fetch_array($stmt);
			 if ($rs["memDel"]=='Y'){
			   echo "<script>alert('회원님은 지금 탈퇴신청중입니다. 해제를 원하신다면 관리자에게 전화문의 하시기 바랍니다.'); window.parent.location.href='/member/login.php';</script>";
			   exit;
			 } else {
			   echo "<script>alert('찾으시는 아이디는 [".$rs["tblStrID"]."] 입니다.'); window.parent.location.href='/member/login.php?findid=".$rs["tblStrID"]."';</script>";
			   exit;
			 }
		   unset($rs);
		  } 
		  unset($stmt);

		break;

	case 'idpw2':		//비밀번호 찾기
 $name = eregi_replace(" ","",$_POST["fname2"]);  //이름
 $userid = eregi_replace(" ","",$_POST["fuserid"]);  //아이디
 $email = eregi_replace(" ","",$_POST["femail2"]);  //이메일
  if (!$name || !$userid || !$email){
	  echo "<script>alert('모든 기재사항을 입력해 주십시오.');window.parent.location.href='/member/idpw.php';</script>";
	  exit;
  }
  $sql="select * from tblPerMember where tblStrName='$name' and tblStrID='$userid' and tblStrEmail='$email' and memDel <> 'Y'";
  $stmt=mysql_query($sql,$connect);
  $row=mysql_num_rows($stmt);
  if ($row==0){
   echo "<script>alert('일치하는 정보가 없습니다. 다시 확인하고 입력해 주세요.');window.parent.location.href='/member/idpw.php';</script>";
   exit;
  } else {
   $new_pass=new_ambo(6);
   $ssql="update tblPerMember set tblStrPass=password('$new_pass'), tblPassType='' where tblStrID='$userid'";
   $ssqlstmt=mysql_query($ssql,$connect);
    if ($ssqlstmt){  //aa

			$mailArg['host'] = $bagData["host"];
			$mailArg['fromName'] = $bagData["siteName"];
			$mailArg['fromEmail'] = $admData["email"];
			$mailArg['toEmail'] = $email;
			$mailArg['userid'] = $userid;
			$mailArg['name'] = $name;
			$mailArg['new_pass'] = $new_pass;
			$mailArg['mailSendType'] = 'memberIdPw';

			$result = mailToSend($mailArg);

		/* 메일보내기 끝*/
		if ($result){
			alertTour('가입하신 메일로 새비밀번호를 발송했습니다. 감사합니다.', '/member/login.php?findid='.$userid);
		} else {
			alertTour('메일발송 실패!', '/member/idpw.php');
		}
	} else {  //aa
		alertTour('비밀번호 발송 실패!', '/member/idpw.php');
	}  //aa
	exit;
	} 
unset($stmt);
		break;
}


mysql_close($connect);
unset($connect);
?>