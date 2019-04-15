<?php
session_start();
include "../lib/get_session.php";
?>
<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php
//$userpriv = true;
if(!$userpriv) {
		echo("
		<script>
	     window.alert('잘못된 접근입니다.')
	     history.go(-1)
	   </script>
		");
		exit;
	}
?>
        
<a href="./sign/login_register.php?mode=login">[로그인]</a>
<a href="./sign/login_register.php?mode=register">[회원가입]</a><p>
<?php

echo "아이디(session:userid, field:userid) : ".$userid."<br>";
echo "닉네임(session:usernick, field:nickname) : ".$usernick."<br>";
echo "관리자 권한(session:userpriv, field:privilege) : ".$userpriv."<br>";

?>
        
<a href="./product_enroll.php">[제품 등록]</a>
        
        
</html>
