<? include "inc/head.php" ?>
<?
$sub_menu = '300300';
auth_check($auth[$sub_menu]);

$pageNum = 3;
$subNum = 3;
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
				<h2><?=$sub_tit2_3?></h2>
				<p class="location">HOME > <?=$sub_tit?> > <strong><?=$sub_tit2_3?></strong></p>
			</div>
			<div class="contentsArea"><!---width:740px--->
				<!--- start : 본문 --->
<?

		$searchQuery = ( $searchQuery ) ? $searchQuery : "";

		if( $search && $keyword ) {
			$searchQuery .= ( $searchQuery ) ? " AND ".$search." LIKE '%".$keyword."%'" : "WHERE ".$search." LIKE '%".$keyword."%'";
		}

		$p = ( !$p ) ? "1" : $p;
		$linenum = ( $linenum ) ? $linenum : "30";
		$startnum = ( $p - 1 ) * $linenum;
		$countQuery = mysql_query( "SELECT idx FROM log_dormancy ".$searchQuery );
		$count_arr = mysql_num_rows( $countQuery );
		$data_num = $count_arr;
		$viewCount = $data_num - $startnum;
		@$total_page = intval( ( $data_num - 1 ) / $linenum )+1;

		$tmp = 0;
		$sql = "SELECT * FROM log_dormancy ".$searchQuery." ORDER BY idx DESC LIMIT $startnum, $linenum";
		$result = mysql_query( $sql );
		while( $Array = mysql_fetch_array( $result ) ) {
			$Data[$tmp]["idx"]				= $Array["idx"];
			$Data[$tmp]["id"]					= $Array["tblStrID"];
			$Data[$tmp]["email"]				= $Array["tblStrEmail"];
			$Data[$tmp]["lastdate"]				= $Array["tblDtmLastDate"];
			$Data[$tmp]["regdate"]					= $Array["tblRegDate"];
			$tmp++;
		}
?>
<?	include ("html/dormancy_list.html"); ?>
				<!--- end : 본문 --->
			</div>
		</div><div class="clr"></div>
	</div>
	<? include "inc/bottom.php" ?>
</div>
</body>
</html>