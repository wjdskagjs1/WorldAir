<?
           session_start();
if(!preg_match("/^5\.2/", PHP_VERSION)){ //if(PHP_VERSION != "5.2.12")
	$userid = $_POST['userid'];
	$password = $_POST['password'];
}
?>
<meta charset="utf-8">
<?
   // 이전화면에서 이름이 입력되지 않았으면 "이름을 입력하세요"
   // 메시지 출력
   if(!$userid) {
     echo("
           <script>
             window.alert('아이디를 입력하세요.')
             history.go(-1)
           </script>
         ");
         exit;
   }

   if(!$password) {
     echo("
           <script>
             window.alert('비밀번호를 입력하세요.')
             history.go(-1)
           </script>
         ");
         exit;
   }

   include "../../lib/dbconn.php";

   $sql = "select * from member where userid='$userid'";
   $result = mysql_query($sql, $connect);

   $num_match = mysql_num_rows($result);

   if(!$num_match) 
   {
     echo("
           <script>
             window.alert('등록되지 않은 아이디입니다.')
             history.go(-1)
           </script>
         ");
    }
    else
    {
        $row = mysql_fetch_array($result);

        $db_pass = $row[pass];

        if($pass != $db_pass)
        {
           echo("
              <script>
                window.alert('비밀번호가 틀립니다.')
                history.go(-1)
              </script>
           ");

           exit;
        }
        else
        {
           $userid = $row[userid];
		   $usernick = $row[nickname];
		   $userpriv = $row[privilege];

           $_SESSION['userid'] = $userid;
           $_SESSION['usernick'] = $usernick;
           $_SESSION['userpriv'] = $userpriv;

           echo("
              <script>
                location.href = '../../index.php';
              </script>
           ");
        }
   }          
?>
