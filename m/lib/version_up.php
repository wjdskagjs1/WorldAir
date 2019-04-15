<?
if(!preg_match("/^5\.2/", PHP_VERSION)){ //if(PHP_VERSION != "5.2.12")
        @include( "./lib/session_func.inc" );
		@include( "../lib/session_func.inc" );
}

?>
