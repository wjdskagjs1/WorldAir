<?PHP
  include( "./class.inc" );

  @session_start();

        if($num != all)
                $cart->delete( $num );

                echo("
					<script>
					history.go(-1)
					</script>
				");
				exit;
?>