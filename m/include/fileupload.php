<?
	/*
	$_FILES['filename']['name'] = 업로드파일명
	$_FILES['filename']['type'] = 포멧타입
	$_FILES['filename']['tmp_name'] = 임시서버파일명
	$_FILES['filename']['error'] = 오류일때 0, 아닐때 다른수
	$_FILES['filename']['size'] = 업로드 파일 사이즈( 바이트 )
	*/

	$iSzArr = array( array( '135', '117' ), array( '158', '119' ), array( '250', '176' ), array( '338', '225' ), array( '450', '316' ) );
	$fnSize = array( '10', '14', '19', '23', '34' );

	for( $f = 0; $f < $boardSet["addfilenumber"]; $f++ ) 
	{



		$file["name"]		= $_FILES['strSaveFile']['name'][$f];
		$file["tmpname"]	= $_FILES['strSaveFile']['tmp_name'][$f];
		$file["size"]		= $_FILES['strSaveFile']['size'][$f];
		$file["type"]		= $_FILES['strSaveFile']['type'][$f];
		$file["error"]		= $_FILES['strSaveFile']['error'][$f];

		if( $file["name"] ) {
			/* 사이즈 체크 시작 */		
			$okFileSize = $boardSet["uploadsize"] * 1024 * 1024;
			if( $file["size"] > $okFileSize ) {
				echo "<script>alert('파일크기는 $okFileSize 이하만 올려주세요.'); history.go(-1);</script>"; exit;
			}
			/* 사이즈 체크 끝   */		

			/* 확장자 검사 시작 */
			$fileExt = explode( '.', $file["name"] );
			if( count( $fileExt ) < 2 ) {
				echo "<script>alert('확장자가 없는 파일은 올리실 수 없습니다.'); history.go(-1);</script>"; exit;
			}
			/* 확장자 검사 끝   */

			/* 업로드불가 확장자 체크 시작 */
			if( in_array( $fileExt[1], $no_ext ) ) {
				echo "<script>alert('$fileExt[1]는 올리실 수 없습니다.'); history.go(-1);</script>"; exit;
			}
			/* 업로드불가 확장자 체크 끝   */

			$Data["liefile"][$f]	= $file["name"];

			/* 파일명 변경 시작 */
			if( in_array( $fileExt[1], $imageExt ) ) {
				$file["name"] = md5( $file["name"] );
				
				/* 같은 파일명 존재유무 체크 시작 */
				if ( is_file( $bagData["absoluteDir"]."/_data/".$tb."/".$file["name"] ) ) {
					$tmp = 0;
					$i = 1;
					while( $tmp == 0 ) {
						$file["name"] = md5( $fileExt[0].'_'.$i.'.'.$fileExt[1] );
						if ( is_file( $bagData["absoluteDir"]."/_data/".$tb."/".$file["name"] ) ) { $i++; }	else { $tmp = 1; }
					}
				}
				/* 같은 파일명 존재유무 체크 끝   */
			} else {
				$file["name"] = md5( $fileExt[0] ).".".$fileExt[1];
				
				/* 같은 파일명 존재유무 체크 시작 */
				if ( is_file( $bagData["absoluteDir"]."/_data/".$tb."/".$file["name"] ) ) {
					$tmp = 0;
					$i = 1;
					while( $tmp == 0 ) {
						$file["name"] = md5( $fileExt[0].'_'.$i ).'.'.$fileExt[1];
						if ( is_file( $bagData["absoluteDir"]."/_data/".$tb."/".$file["name"] ) ) { $i++; }	else { $tmp = 1; }
					}
				}
				/* 같은 파일명 존재유무 체크 끝   */
			}
			/* 파일명 변경 끝   */
						
			/* 원본 / 썸네일 파일 업로드 시작 */
			if( $boardSet["watermark"] == 'Y' ) {
				WatermarkImage($file["tmpname"], $bagData["watermarkImage"], 10, 100, 1);			
				//} else {
			}
			if( move_uploaded_file( $file["tmpname"], $bagData["absoluteDir"]."/_data/".$tb."/".$file["name"] ) ) {

				$Data["savefile"][$f] = "/_data/".$tb."/".$file["name"];
				//echo '<img src="'.$Data["savefile"][$f].'"><br/><br/><br/><br/><br/><br/><br/>';

				/* 이미지일때 썸네일 생성 시작 */
				//$max_width = '57'; $max_height = '66';
				if( in_array( $fileExt[1], $imageExt ) ) {
					switch( $fileExt[1]  ) {
						case "gif" : case "GIF" :
						$simg_type = 1; break;
						case "jpg" : case "JPG" :
						$simg_type = 2; break;
						case "png" : case "PNG" : 
						$simg_type = 3; break;
						case "bmp" : case "BMP" : 
						$simg_type = 4; break;
						default : $simg_type = 1; break;
					}
					for( $t = 0; $t < count( $iSzArr ); $t++ ) {
						$_t = $t+1;
						$max_width = $iSzArr[$t][0];
						$max_height = $iSzArr[$t][1];
						$file["thum$_t"] = md5( 'tm_'.$_t.'_'.$file["name"] );
						$oriImg = $bagData["absoluteDir"]."/_data/".$tb."/".$file["name"];
						$sImg = $bagData["absoluteDir"]."/_data/".$tb."/".$file["thum$_t"];

						/* 원본파일, 썸네일명, 썸네일저장위치, 썸네일가로길이, 썸네일세로길이 */
						thumnail($bagData["absoluteDir"]."/_data/".$tb."/".$file["name"], $file["thum$_t"], $bagData["absoluteDir"]."/_data/".$tb."/", $max_width, $max_height);
						
						$Data["thumfile$_t"][$f] = "/_data/".$tb."/".$file["thum$_t"];
						$Data["thumfile$_t"][$f] = "/_data/".$tb."/".$file["thum$_t"];
						$Data["thumfile$_t"][$f] = "/_data/".$tb."/".$file["thum$_t"];
						$Data["thumfile$_t"][$f] = "/_data/".$tb."/".$file["thum$_t"];
						$Data["thumfile$_t"][$f] = "/_data/".$tb."/".$file["thum$_t"];
					}
				}
				/* 이미지일때 썸네일 생성 끝   */
			}
			/* 원본 / 썸네일 파일 업로드 끝   */
		}
	}
?>
