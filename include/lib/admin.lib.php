<?
	// 접근 권한 검사
	if ($_SESSION['ss_level'] == 1) {			// 관리자
		$sql = " select * from auth_list where length(auth_key) = '6' and view_state = 1";
		$result = mysql_query($sql);
		while($row=mysql_fetch_array($result)) {
			$auth[$row['auth_key']] = $row['auth_key'];

			// 1. 메뉴 설정, 2. 첫번째 서브메뉴에 선택된 대메뉴에 링크, 
			$toplink=mysql_fetch_array(mysql_query("select * from auth_list where auth_key='".$auth[$row['auth_key']]."' and view_state = 1"));

			$sub_title[$row['auth_key']] = $toplink['auth_menu'];	// 메뉴명 
			$sub_link[$row['auth_key']] = $toplink['link'];				// 링크
			if (!$auth[substr($row['auth_key'],0,3)]) {
				$auth[substr($row['auth_key'],0,3)] = $toplink['link'];
			}
		}
	} else if ($_SESSION['ss_level'] == 2) {					// 부관리자
		$sql = " select * from auth_menu where mb_id = '{$_SESSION['ss_id']}' ";
		$result = mysql_query($sql);
		$row=mysql_fetch_array($result);

		$authkey = getArrayString($row["auth_key"]);
		foreach($authkey['data'] as $k => $v) {
			$auth[$v] = $v;

			// 1. 메뉴 설정, 2. 첫번째 서브메뉴에 선택된 대메뉴에 링크, 
			$toplink = mysql_fetch_array(mysql_query("select * from auth_list where auth_key='".$auth[$v]."' and view_state = 1"));

			$sub_title[$v] = $toplink['auth_menu'];	// 메뉴명
			$sub_link[$v] = $toplink['link'];				// 링크
			//echo $toplink['auth_menu'].'<br/>';
			if (!$auth[substr($v,0,3)]) {
				$auth[substr($v,0,3)] = $toplink['link'];	// 대메뉴에 첫번째 서브링크
			}
		}
	}

	// 관리자 접속권한
	function auth_check($sub_menu) {
		global $auth, $memberNameArr;

		//var_dump($auth);
		if (!$auth[$sub_menu]) {
			echo "<script language='javascript'>";
			echo "	alert('[".$memberNameArr[$_SESSION["ss_level"]]."] 님은 이용이 제한되었습니다.');";
			echo "	history.go(-1);";
			echo "</script>";
			exit;
		}
	}
?>