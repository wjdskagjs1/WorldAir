<?PHP
include "./lib/get_session.php" ;
?>

<?PHP
if(!$userid) {
		echo("
		<script>
	     window.alert('로그인 후 이용해 주세요.')
	     history.go(-1)
	   </script>
		");
		exit;
}
  include( "./shop/class.inc" );

  if (!session_is_registered('cart'))
  {
    $cart = new Cart;
    session_register('cart');
   } else {
          $_SESSION['cart'] = unserialize(serialize($_SESSION['cart']));
          $cart = $_SESSION['cart'];
  }
/*
  if ( $code=="insert" )
      {
        $cart->add( $num, $amount );
    }
    else if ( $code="delete" )
      {
        $cart->delete( $num );
      }
	  */
?>
    <html>
    <body>
    <p><font size="6">장바구니</font></p>
    <p><a href="./index.php?mode=list">쇼핑계속</a></p>
    <?PHP
      if ( $cart->get_count() )
      {
    ?>
    <table width="auto" border="1" cellspacing="1" cellpadding="0">
      <tr align="center">
	  	<td width="50">
          <input type="checkbox" name="check_all" value="Bike">
        </td>
        <td width="70">
          이미지
        </td>
        <td width="200">
          이름
        </td>
        <td width="50">
          수량
        </td>
		<td width="100">
          가격
        </td>
		<td width="100">
          소계
        </td>
        <td width="100">
          제거
        </td>
      </tr>

    <?PHP
	include "./lib/dbconn.php";

       $sql = "select * from product";
 
    $result = mysql_query($sql);
        $sum = 0;
	while ($row = mysql_fetch_array($result)){

        
		$num = $row[num];
        $amount = $cart->getAmount($num);
            
            if(!$amount)
                break;
        
		$name = $row[name];
		$price = $row[price];
                
        $thumbnail = $row[thumbnail_copied];
		if($thumbnail)
            $thumbnail = './data/'.$thumbnail;    
        else
            $thumbnail = 'http://placehold.it/700x400'; 
            
        $sum += $amount*$price;
    ?>
      <tr>
		<td width="50" align="center"><input type="checkbox" name="check<?=$num?>" value="<?=$name?>"></td>
        <td width="100"><img src="<?=$thumbnail?>" href="./index.php?mode=detail&num=<?=$num?>" width="70" height="40"></td>
        <td width="100"><a href="./index.php?mode=detail&num=<?=$num?>"><?=$name?></a></td>
        <td width="50"><?=$amount?></td>
        <td width="80"><?=$price?> 원</td>
		<td width="80"><?=$amount*$price?> 원</td>
        <td width="100">
            <input type="button" name="delete" value="삭제"
              onClick="javascript:location='./shop/delete_cart.php?num=<?=$num?>'">
        </td>
      </tr>
    <?PHP
        }
    ?>
      <tr>
	    <td height="30"> </td>
        <td colspan="4" height="30"> 총합 </td>
        <td width="65" height="30" valign="middle"><?=$sum?> 원</td>
      </tr>
    </table>
    <?PHP
      }
    ?>
    </body>
</html>
