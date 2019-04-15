<?
session_start();
include( "../lib/get_session.php" );

if(!preg_match("/^5\.2/", PHP_VERSION)){ //if(PHP_VERSION != "5.2.12")
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
}
?>

<meta charset="utf-8">
<?
//$userpriv = true;
	if(!$userpriv) {
		echo("
		<script>
	     window.alert('로그인 후 이용해 주세요.')
	     history.go(-1)
	   </script>
		");
		exit;
	}

	$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장
		/*   단일 파일 업로드 
		$upfile_name	 = $_FILES["upfile"]["name"];
		$upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
		$upfile_type     = $_FILES["upfile"]["type"];
		$upfile_size     = $_FILES["upfile"]["size"];
		$upfile_error    = $_FILES["upfile"]["error"];
		*/

	// 다중 파일 업로드
	$files = $_FILES["upfile"];
	$count = count($files["name"]);
			
	$upload_dir = '../data/';

	for ($i=0; $i<$count; $i++)
	{
		$upfile_name[$i]     = $files["name"][$i];
		$upfile_tmp_name[$i] = $files["tmp_name"][$i];
		$upfile_type[$i]     = $files["type"][$i];
		$upfile_size[$i]     = $files["size"][$i];
		$upfile_error[$i]    = $files["error"][$i];
      
		$file = explode(".", $upfile_name[$i]);
		$file_name = $file[0];
		$file_ext  = $file[1];

		if (!$upfile_error[$i])
		{
			$new_file_name = date("Y_m_d_H_i_s");
			$new_file_name = $new_file_name."_".$i;
			$copied_file_name[$i] = $new_file_name.".".$file_ext;      
			$uploaded_file[$i] = $upload_dir.$copied_file_name[$i];

			if( $upfile_size[$i]  > 500000 ) {
				echo("
				<script>
				alert('업로드 파일 크기가 지정된 용량(500KB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
				history.go(-1)
				</script>
				");
				exit;
			}

			if ( ($upfile_type[$i] != "image/gif") &&
				($upfile_type[$i] != "image/jpeg") &&
				($upfile_type[$i] != "image/pjpeg") )
			{
				echo("
					<script>
						alert('JPG와 GIF 이미지 파일만 업로드 가능합니다!');
						history.go(-1)
					</script>
					");
				exit;
			}

			if (!move_uploaded_file($upfile_tmp_name[$i], $uploaded_file[$i]) )
			{
				echo("
					<script>
					alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
					history.go(-1)
					</script>
				");
				exit;
			}
		}
	}

	include "../lib/dbconn.php";       // dconn.php 파일을 불러옴

	if ($mode=="modify")
	{
		$num_checked = count($_POST['del_file']);
		$position = $_POST['del_file'];

		for($i=0; $i<$num_checked; $i++)                      // delete checked item
		{
			$index = $position[$i];
			$del_ok[$index] = "y";
		}

		$sql = "select * from product where num=$num";   // get target record
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		for ($i=0; $i<$count; $i++)					// update DB with the value of file input box
		{
                $i = ($i == 0 ? "thumbnail" : "detail" );
			$field_org_name = $i;
			$field_real_name = $i."_copied";

			$org_name_value = $upfile_name[$i];
			$org_real_value = $copied_file_name[$i];
			if ($del_ok[$i] == "y")
			{
				$delete_field = $i."_copied";
				$delete_name = $row[$delete_field];
				
				$delete_path = "../data/".$delete_name;

				unlink($delete_path);

				$sql = "update product set $field_org_name = '$org_name_value', $field_real_name = '$org_real_value'  where num=$num";
				mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행
			}
			else
			{
				if (!$upfile_error[$i])
				{
					$sql = "update product set $field_org_name = '$org_name_value', $field_real_name = '$org_real_value'  where num=$num";
					mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행					
				}
			}

		}
		$sql = "update product set name='$name', price='$price', description='$description' where num=$num";
		mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행
	}
	else
	{
		if ($html_ok=="y")
		{
			$is_html = "y";
		}
		else
		{
			$is_html = "";
			$content = htmlspecialchars($content);
		}

		$sql = "insert into product (name, price, description, ";
		$sql .= "thumbnail, detail, thumbnail_copied,  detail_copied) ";
		$sql .= "values('$name', $price, '$description', ";
		$sql .= "'$upfile_name[0]', '$upfile_name[1]', '$copied_file_name[0]', '$copied_file_name[1]')";
		mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행
	}

	mysql_close();                // DB 연결 끊기
	echo "
	   <script>
	    location.href = '../index.php';
	   </script>
	";
?>

  
