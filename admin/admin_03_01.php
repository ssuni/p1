<? include "inc/head.php" ?>
<?
$sub_menu = '300100';
auth_check($auth[$sub_menu]);

$pageNum = 3;
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
	// 부관리자의 권한으로 넘겨줬기 때문에 해당 기능은 무의미함.
	/*
	// 관리자가 아닐때는 권한 제한
	if( $_SESSION["ss_level"] > 1 ) {
		$searchQuery = "WHERE tblIntGP='".$_SESSION["ss_gp"]."'";
	}
	*/

	if( !$act || $act == 'list' ) {
		$searchQuery = ( $searchQuery ) ? $searchQuery : "";
		if( $level ) {
			$searchQuery .= ( $searchQuery ) ? " AND tblIntLevel='".$level."'" : "WHERE tblIntLevel='".$level."'";
		}
		
		if( $place ) {
			$searchQuery .= ( $searchQuery ) ? " AND tblintFirAddr='".$place."'" : "WHERE tblintFirAddr='".$place."'";
		}

		if( $sex ) {
			$searchQuery .= ( $searchQuery ) ? " AND tblStrSex='".$sex."'" : "WHERE tblStrSex='".$sex."'";
		}
		
		if( $blnemail == 'Y' || $blnemail == 'N' ) {
			$searchQuery .= ( $searchQuery ) ? " AND tblBlnEmail='".$blnemail."'" : "WHERE tblBlnEmail='".$blnemail."'";
		}

		if( $blnsms == 'Y' || $blnsms == 'N' ) {
			$searchQuery .= ( $searchQuery ) ? " AND tblBlnSms='".$blnsms."'" : "WHERE tblBlnSms='".$blnsms."'";
		}
		
		if( $age ) {
			//$age2 = $age-1;
			$searchQuery .= ( $searchQuery ) ? " AND ".(ceil(date("Y"))-ceil($age-1))." >= left(tblIntBirth,4) and ".(ceil(date("Y"))-ceil($age+8))." <= left(tblIntBirth,4)" : "WHERE ".(ceil(date("Y"))-ceil($age-1))." >= left(tblIntBirth,4) and ".(ceil(date("Y"))-ceil($age+8))." <= left(tblIntBirth,4)";
		}

		if( $memDel == 'Y' || $memDel == 'N' ) {
			$searchQuery .= ( $searchQuery ) ? " AND memDel='".$memDel."'" : "WHERE memDel='".$memDel."'";
		}

		if( $search && $keyword ) {
			$searchQuery .= ( $searchQuery ) ? " AND ".$search." LIKE '%".$keyword."%'" : "WHERE ".$search." LIKE '%".$keyword."%'";
		}

		$p = ( !$p ) ? "1" : $p;
		$linenum = ( $linenum ) ? $linenum : "30";
		$startnum = ( $p - 1 ) * $linenum;
		$countQuery = mysql_query( "SELECT tblNumber FROM tblPerMember ".$searchQuery );
		$count_arr = mysql_num_rows( $countQuery );
		$data_num = $count_arr;
		$viewCount = $data_num - $startnum;
		@$total_page = intval( ( $data_num - 1 ) / $linenum )+1;

		$tmp = 0;
		$sql = "SELECT * FROM tblPerMember ".$searchQuery." ORDER BY tblDtmRegDate DESC LIMIT $startnum, $linenum";
		$result = mysql_query( $sql );
		while( $Array = mysql_fetch_array( $result ) ) {
			switch($Array["tblSnsType"]) {
				case 'naver':	$Data[$tmp]["sns"] = '네이버';	break;
				case 'kakao':	$Data[$tmp]["sns"] = '카카오';	break;
				case 'facebook':	$Data[$tmp]["sns"] = '페이스북';	break;
			}
			$Data[$tmp]["number"]				= $Array["tblNumber"];
			$Data[$tmp]["id"]					= $Array["tblStrID"];
			$Data[$tmp]["passwd"]				= bokho(urldecode($Array["tblStrPass"]),$Array["tblIntBirth"]);
			$Data[$tmp]["name"]					= $Array["tblStrName"];
			$Data[$tmp]["email"]				= $Array["tblStrEmail"];
			$Data[$tmp]["blnemail"]				= $Array["tblBlnEmail"];
			$Data[$tmp]["mobile"]				= $Array["tblStrMobile"];
			$Data[$tmp]["blnsms"]				= $Array["tblBlnSms"];
			$Data[$tmp]["level"]				= $Array["tblIntLevel"];
			if ($Array["tblIntLevel"] == 2) $Data[$tmp]["auth_set"] = '<a href="admin_03_01_auth.php?tNum='.$Array["tblNumber"].'&'.str_replace("&tNum=", "", $_SERVER['QUERY_STRING']).'">관리권한설정</a>';
			$Data[$tmp]["regdate"]				= $Array["tblDtmRegDate"];
			$Data[$tmp]["lastdate"]				= $Array["tblDtmLastDate"];
			$Data[$tmp]["gp"]					= $Array["tblIntGP"];
			$Data[$tmp]["strdate"]				= $Array["tblDtmStrDate"];
			$Data[$tmp]["enddate"]				= $Array["tblDtmEndDate"];
			$Data[$tmp]["movdate"]				= ( $Data[$tmp]["strdate"] && $Data[$tmp]["enddate"] ) ? date( 'Y/m/d', $Data[$tmp]["strdate"] )."~".date( 'Y/m/d', $Data[$tmp]["enddate"] ) : "";
			$Data[$tmp]["gp"]					= $Array["tblIntGP"];
			$Data[$tmp]["memDel"]				= $Array["memDel"];
			$tmp++;
		}

		include ("html/member_list.html");
	}

	if( $act == 'modify' ) {
		if( !$tNum ) {
			echo "<script language='javascript'>";
			echo "	alert('경로가 올바르지 않습니다.');";
			echo "	history.go(-1);";
			echo "</script>";
			exit;
		}
		$Query = "SELECT * FROM tblPerMember WHERE tblNumber='".$tNum."'";
		$Sql = mysql_query( $Query );
		$Array = mysql_fetch_array( $Sql );
		$Data["tblNumber"]	= $Array["tblNumber"];
		$Data["id"]				= $Array["tblStrID"];
		$Data["tblPassType"]				= $Array["tblPassType"];
		$Data["pass"]			= $Array["tblStrPass"];
		$Data["name"]			= $Array["tblStrName"];
		$Data["sex"]			= $Array["tblStrSex"];
		$Data["email"]			= $Array["tblStrEmail"];
		$Data["blnemail"]		= $Array["tblBlnEmail"];
		$Data["mobile"]			= explode( '-', $Array["tblStrMobile"] );
		$Data["blnsms"]			= $Array["tblBlnSms"];
		$Data["level"]			= $Array["tblIntLevel"];
		$Data["profile"]		= stripslashes( $Array["tblStrProfile"] );
		$Data["memo"]			= stripslashes( $Array["tblStrMemo"] );
		$Data["regdate"]		= $Array["tblDtmRegDate"];
		$Data["gp"]				= $Array["tblIntGP"];
		$Data["memDel"]			= $Array["memDel"];
		$Data["memDel_reason"]	= $Array["memDel_reason"];
		$Data["memDel_hope"]	= $Array["memDel_hope"];
		$Data["memDel_date"]	= $Array["memDel_date"];

		include ("html/member_edit.html");
	}	?>

				<!--- end : 본문 --->
			</div>
		</div><div class="clr"></div>
	</div>
	<? include "inc/bottom.php" ?>
</div>
</body>
</html>