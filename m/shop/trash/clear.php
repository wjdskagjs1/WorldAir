<?PHP
  include ("./class.inc");
  include ("./products.inc");

  session_start ();

  if ($cart->get_count())
  {
     $contents = $cart->get_list ();

     while (list($name, $value) = each($contents))
     {
        $cart->delete($name);
     }

  }
  print "Your cart is cleared....";

?>
