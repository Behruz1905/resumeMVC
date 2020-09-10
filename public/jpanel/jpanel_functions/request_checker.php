<?php 
	foreach($_POST as $k=>$v) {
		$_POST[$k] = tags_filter(SqlInjectFilterMini($_POST[$k]));
	}
	foreach($_GET as $k=>$v) {
		$_GET[$k] = tags_filter(SqlInjectFilterMini($_GET[$k]));
	}
	foreach($_SESSION as $k=>$v) {
		$_SESSION[$k] = tags_filter(SqlInjectFilterMini($_SESSION[$k]));
	}
	
	$_SERVER['REQUEST_URI'] = tags_filter(SqlInjectFilterMini($_SERVER['REQUEST_URI']));;

	$checked = true;

?>