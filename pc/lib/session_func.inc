<?PHP
function session_is_registered($name){
    return isset( $_SESSION[$name] );
}
function session_register($name){
    if(isset($GLOBALS[$name])) $_SESSION[$name] = $GLOBALS[$name];
    $GLOBALS[$name] = &$_SESSION[$name];
}
?>