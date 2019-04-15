<?
  session_start();
  unset($_SESSION['userid']);
  unset($_SESSION['usernick']);
  unset($_SESSION['userpriv']);

  echo("
       <script>
          location.href = '../../index.php'; 
         </script>
       ");
?>
