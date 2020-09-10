<?php
    error_reporting(E_ALL & ~E_NOTICE);
	$connect = @mysql_connect("127.0.0.1","root","");

	if(!$connect) {
		exit("<br><center><strong>Error connecting to database server.</strong></center>");
	}
	$db_connect = mysql_select_db("zeferan");
	
	if(!$db_connect) {
		exit("<br><center><strong>Error selecting database.</strong></center>");
	}
	mysql_query("SET names utf8");
	date_default_timezone_set("Asia/Baku");
	
?>