<? include "inc/head.php" ?>
<?
switch($tblType) {
	case 'main': $sub_menu = '200510';  break;
}

auth_check($auth[$sub_menu]);

$pageNum = 2;
$subNum = 9;
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
				<h2><?=$sub_title[$sub_menu]?></h2>
				<p class="location">HOME > <?=$sub_tit?> > <strong><?=$sub_title[$sub_menu]?></strong></p>
			</div>
			<div class="contentsArea"><!---width:740px--->
				<!--- start : 본문 --->
<?	
	if( !$act || $act == 'list' ) {
		
		$searchQuery = " where tblType = '".$_GET['tblType']."'";
		if( $search && $keyword ) {
			$searchQuery .= ( $searchQuery ) ? " AND ".$search." LIKE '%".$keyword."%'" : "";
		}

		$p = ( !$p ) ? "1" : $p;
		$linenum = ( $linenum ) ? $linenum : "20";
		$startnum = ( $p - 1 ) * $linenum;
		$countQuery = mysql_query( "SELECT * FROM tb_counsel ".$searchQuery );
		$count_arr = mysql_num_rows( $countQuery );
		$data_num = $count_arr;
		$viewCount = $data_num - $startnum;
		@$total_page = intval( ( $data_num - 1 ) / $linenum )+1;
		
		$i = 0;
//		$sql = "SELECT * FROM  tb_counsel ".$searchQuery." ORDER BY idx DESC LIMIT $startnum, $linenum";
		$sql = "SELECT * FROM  tb_counsel ".$searchQuery." ORDER BY idx DESC";
		$result = mysql_query( $sql );
		while ( $aSelQuery = mysql_fetch_array($result) ){

			switch( $aSelQuery['tblIntStatus'] ) {
				case "1" : $ld_status		= "<font color='blue'>접수</font>"; break;
				case "2" : $ld_status		= "<font color='FF6600'>완료</font>"; break;
				case "3" : $ld_status		= "<font color='gray'>대기</font>"; break;
			}
			switch( $aSelQuery["division"] ) {
				case "1" : $division		= "<font color='purple'>논현</font>"; break;
				case "2" : $division		= "<font color='#adff2f'>강남</font>"; break;
				case "3" : $division		= "<font color='#ff69b4'>청담</font>"; break;
			}

			$list[] = array(
				"num" => $data_num - ($i + ($linenum*($p - 1))),
				"idx" => $aSelQuery['idx'],
				"tblType" => $aSelQuery['tblType'],
				"name" => $aSelQuery['tblStrName'],
				"phone" => $aSelQuery['tblStrMobile'],
				"subject" => $aSelQuery['subject'],
				//"gubun" => ($aSelQuery['cgubun']=='instar')?'인스타':'페이스북',
				"gubun" => $cgubun,
				"status" => $ld_status,
				"division" => $division,
				"regdate" => $aSelQuery['tblDtmRegDate']
			);
			$i++;
		}

		include ("html/counsel_list.html");
	}


	if( $act == 'modify' ) {
		
		$sql = "SELECT * FROM  tb_counsel where tblType='".$_GET['tblType']."' and idx=".$_GET['idx']." limit 1	";
		$result = mysql_query( $sql );
		$Data = mysql_fetch_array($result);

		include ("html/counsel_edit.html");
	}


	if( $act == 'edit_ok' ) {
		
		$Query = "UPDATE  tb_counsel SET ";
		$Query .= "tblStrName='".$_POST["tblStrName"]."',";
		$Query .= "tblStrMobile='".$_POST["tblStrMobile"]."',";
		$Query .= "tblIntField1='".$_POST["tblIntField1"]."',";
		$Query .= "tblIntField2='".$_POST["tblIntField2"]."',";
		$Query .= "tblStrComment='".$_POST["tblStrComment"]."',";
		$Query .= "tblIntStatus='".$_POST["tblIntStatus"]."' WHERE idx='".$_POST["idx"]."'";
		$Sql = mysql_query( $Query ) or die( mysql_error() );
		
		echo "<script language='javascript'>";
		echo "	location.href='".$_POST['referer']."'";
		echo "</script>";
	}

	


	if( $act == 'delete' ) {
		foreach($_POST['chk'] as $k => $v) {
			$Query = "DELETE FROM  tb_counsel WHERE idx='".$v."'";
			$Sql = mysql_query( $Query ) or die ( mysql_error() );
		}
		echo "<script language='javascript'>";
		echo "	location.href='$PHP_SELF?tblType=$tblType';";
		echo "</script>";
	}	?>

				<!--- end : 본문 --->
			</div>
		</div><div class="clr"></div>
	</div>
	<? include "inc/bottom.php" ?>
</div>
</body>
</html>