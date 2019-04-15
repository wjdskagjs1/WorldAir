<?PHP
  include( "./class.inc" );
include "../lib/version_up.php";

session_start();

  if (!session_is_registered('cart'))
  {
    $cart = new Cart;
    session_register('cart');
   } else {
          $_SESSION['cart'] = unserialize(serialize($_SESSION['cart']));
          $cart = $_SESSION['cart'];
  }

if(!preg_match("/^5\.2/", PHP_VERSION)){ //if(PHP_VERSION != "5.2.12")
  $num = $_GET['num'];
  $amount = $_GET['amount'];
}

        $cart->add( $num, $amount );
?>

