<?
	$table_cfg = array(
		'tblPerMember' => '회원정보',
		'tb_counsel' => '비용상담',
		'tb_kakaotalk_reservation' => '카카오톡상담',
		'tblReserve' => '진료예약',
		'tbl_notice' => '공지사항 게시판',
		'tbl_news' => '보도자료 게시판',
		'tbl_online_counsel' => '온라인상담 게시판',
		'tbl_before_after' => '전후사진 게시판',
		'tbl_review' => '시술후기 게시판',
		'tbl_rubyrealstory' => '리얼스토리 게시판',
		'tbl_customer' => '고객의마음 게시판',
		'tbl_stargallery' => '스타갤러리 게시판',
		'tbl_event' => '이벤트 게시판'
	);

	$act_cfg = array(
		'insert' => '추가',
		'modify' => '수정',
		'delete' => '삭제'
	);
	
	/*
	* 테이블명, 전달값, 액션($array)
	*/
	function setAnalysis($array) {
		
		global $connect, $_SESSION;
		
		$sql = "insert into log_analysis set 
			admin_id = '{$_SESSION[ss_id]}',
			table_name = '{$array['table']}',
			pk = '{$array['pk']}',
			content = '{$array['content']}',
			act = '{$array['act']}',
			etc = '{$array['etc']}',
			reg_date = '".date("Y-m-d H:i:s")."',
			ip = '{$_SERVER['REMOTE_ADDR']}'";
		mysql_query($sql,$connect);
	}
?>