<?
    $connect=mysql_connect( "localhost", "worldair", "world1234") or  
        die( "SQL server에 연결할 수 없습니다."); 
	
	mysql_set_charset("UTF8", $connect);
    
	mysql_select_db("worldair",$connect);
?>
