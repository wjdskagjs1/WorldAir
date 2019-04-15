<meta charset="utf-8">
<?
if(!preg_match("/^5\.2/", PHP_VERSION)){ //if(PHP_VERSION != "5.2.12")
	$userid = $_POST['userid'];
	$password = $_POST['password'];
	$nickname = $_POST['nickname'];
	$email = $_POST['email'];
}

   $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장
   //$ip = $_SERVER['REMOTE_ADDR'];         // 방문자의 IP 주소를 저장
	$ip = gethostbyname(trim(`hostname`));

   include "../../lib/dbconn.php";       // dconn.php 파일을 불러옴

   $sql = "select * from member where userid='$userid'";
   $result = mysql_query($sql, $connect);
   $exist_id = mysql_num_rows($result);

   $sql = "select * from member where nickname='$nickname'";
   $result = mysql_query($sql, $connect);
   $exist_nick = mysql_num_rows($result);

   if($exist_id) {
     echo("
           <script>
             window.alert('해당 아이디가 이미 존재합니다.')
             history.go(-1)
           </script>
         ");
         exit;
   }
   else if($exist_nick) {
     echo("
           <script>
             window.alert('해당 닉네임이 이미 존재합니다.')
             history.go(-1)
           </script>
         ");
         exit;
   }
   else
   {            // 레코드 삽입 명령을 $sql에 입력
	    $sql = "insert into member(userid, password, nickname, email, regist_day, point, privilege, ip) ";
		$sql .= "values('$userid', '$password', '$nickname', '$email', '$regist_day', 100, false, '$ip')";

		mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행
   }

   mysql_close();                // DB 연결 끊기
   echo "
	   <script>
	    window.alert('가입이 완료되었습니다.')
	    location.href = '../login_register.php';
	   </script>
	";
?>

   
