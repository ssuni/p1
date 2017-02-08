<? include "inc/head.php" ?>
<?
$sub_menu = '200800';
auth_check($auth[$sub_menu]);

$pageNum = 2;
$subNum = 8;
?>
<body class="commonBg">
sadsadsadsad
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
		if( $search && $keyword ) {
			$searchQuery .= ( $searchQuery ) ? " AND ".$search." LIKE '%".$keyword."%'" : "WHERE ".$search." LIKE '%".$keyword."%'";
		}

		$p = ( !$p ) ? "1" : $p;
		$linenum = ( $linenum ) ? $linenum : "30";
		$startnum = ( $p - 1 ) * $linenum;
		$countQuery = mysql_query( "SELECT * FROM tbl_contact_model ".$searchQuery );
		$count_arr = mysql_num_rows( $countQuery );
		$data_num = $count_arr;
		$viewCount = $data_num - $startnum;
		@$total_page = intval( ( $data_num - 1 ) / $linenum )+1;

		$tmp = 0;
		$sql = "SELECT * FROM tbl_contact_model ".$searchQuery." ORDER BY uid DESC LIMIT $startnum, $linenum";
		$result = mysql_query( $sql );
		$nTmp	= 0;
		while ( $aSelQuery = mysql_fetch_array($result) ){
			$Data[$nTmp]['uid']		= $aSelQuery['uid'];
			$Data[$nTmp]['wr_name']	= $aSelQuery['wr_name'];
			$Data[$nTmp]['wr_birth']		= $aSelQuery['wr_birth'];
			$Data[$nTmp]['wr_email']			= $aSelQuery['wr_email'];
			$Data[$nTmp]['wr_datetime']	= $aSelQuery['wr_datetime'];
			$nTmp++;
		}

		include ("html/contact_model_list.html");
	}

	if( $act == 'view' ) {
		if( !$uid ) {
			echo "<script language='javascript'>";
			echo "	alert('경로가 올바르지 않습니다.');";
			echo "	history.go(-1);";
			echo "</script>";
			exit;
		}
		$Query = "SELECT * FROM tbl_contact_model WHERE uid='".$uid."'";
		$Sql = mysql_query( $Query );
		$row = mysql_fetch_array( $Sql );

		include ("html/contact_model_view.html");
	}


	if( $act == 'modify' ) {
		if( !$uid ) {
			echo "<script language='javascript'>";
			echo "	alert('경로가 올바르지 않습니다.');";
			echo "	history.go(-1);";
			echo "</script>";
			exit;
		}
		$Query = "SELECT * FROM tbl_contact_model WHERE uid='".$uid."'";
		$Sql = mysql_query( $Query );
		$row = mysql_fetch_array( $Sql );

		include ("html/contact_model_edit.html");
	}

	if( $act == 'edit_ok' ) {
		$Query = "UPDATE tbl_contact_model SET ";
		$Query .= "wr_name = '".$_POST["wr_name"]."',";
		$Query .= "wr_birth = '".$_POST["wr_birth"]."',";
		$Query .= "wr_gender = '".$_POST["wr_gender"]."',";
		$Query .= "wr_job = '".$_POST["wr_job"]."',";
		$Query .= "wr_height = '".$_POST["wr_height"]."',";
		$Query .= "wr_weight = '".$_POST["wr_weight"]."',";
		$Query .= "wr_phone1 = '".$_POST["wr_phone1"]."',";
		$Query .= "wr_phone2 = '".$_POST["wr_phone2"]."',";
		$Query .= "wr_phone3 = '".$_POST["wr_phone3"]."',";
		$Query .= "wr_address = '".$_POST["wr_address"]."',";
		$Query .= "wr_email = '".$_POST["wr_email"]."',";
		$Query .= "wr_married = '".$_POST["wr_married"]."',";
		$Query .= "wr_army = '".$_POST["wr_army"]."',";
		$Query .= "wr_exp = '".$wr_exp_txt."',";
		$Query .= "wr_apply = '".$wr_apply_txt."',";
		$Query .= "wr_text = '".$_POST["wr_text"]."',";
		$Query .= "wr_file1 = '".$wr_file1."',";
		$Query .= "wr_file2 = '".$wr_file2."',";
		$Query .= "wr_file3 = '".$wr_file3."',";
		$Query .= "wr_file4 = '".$wr_file4."',";
		$Query .= "wr_file5 = '".$wr_file5."',";
		$Query .= "wr_file6 = '".$wr_file6."',";
		$Query .= "wr_file7 = '".$wr_file7."',";
		$Query .= "wr_file8 = '".$wr_file8."',";
		$Query .= "wr_file9 = '".$wr_file9."',";
		$Query .= "wr_file10 = '".$wr_file10."'";
		$Query .= " WHERE uid='".$uid."'";

		$Sql = mysql_query( $Query ) or die ( mysql_error() );
		echo "<script language='javascript'>";
		echo "	location.href='$PHP_SELF';";
		echo "</script>";
	}

	if( $act == 'delete' ) {
		$result = mysql_query("select * FROM tbl_contact_model WHERE uid='".$_POST["uid"]."'");
		$row = mysql_fetch_array( $result );

		@unlink( $_SERVER['DOCUMENT_ROOT'].$row['wr_file1'] );
		@unlink( $_SERVER['DOCUMENT_ROOT'].$row['wr_file2'] );
		@unlink( $_SERVER['DOCUMENT_ROOT'].$row['wr_file3'] );
		@unlink( $_SERVER['DOCUMENT_ROOT'].$row['wr_file4'] );
		@unlink( $_SERVER['DOCUMENT_ROOT'].$row['wr_file5'] );
		@unlink( $_SERVER['DOCUMENT_ROOT'].$row['wr_file6'] );
		@unlink( $_SERVER['DOCUMENT_ROOT'].$row['wr_file7'] );
		@unlink( $_SERVER['DOCUMENT_ROOT'].$row['wr_file8'] );
		@unlink( $_SERVER['DOCUMENT_ROOT'].$row['wr_file9'] );
		@unlink( $_SERVER['DOCUMENT_ROOT'].$row['wr_file10'] );

		$Query = "DELETE FROM tbl_contact_model WHERE uid='".$_POST["uid"]."'";
		$Sql = mysql_query( $Query ) or die ( mysql_error() );
		echo "<script language='javascript'>";
		echo "	location.href='$PHP_SELF';";
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