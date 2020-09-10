<?php
	session_start();
	$ckey = "MODULE_INCLUDE";
	require_once('../../../functions/config.php');
	require_once('../../../functions/functions.php');
	require_once('../../../functions/php_functions.php');
	require_once('../../../functions/basket_functions.php');
	require_once('../../../functions/main_settings_admin.php');
	require_once('../../../functions/language.php');

	// no term passed - just exit early with no response
	if (empty($_GET['term'])) exit ;
	$qwery = SqlInjectFilterMini(strtolower($_GET["term"]));
	// remove slashes if they were magically added
	if (get_magic_quotes_gpc()) $qwery = stripslashes($qwery);
	
	
	$result = array();
	if(strlen($qwery)) {
		$result_qw = mysql_query("SELECT tagId,tagText FROM tags WHERE tagText LIKE '".$qwery."%' ");
		while($row = mysql_fetch_array($result_qw)){
			array_push($result, array("id"=>$row[0], "label"=>$row[1], "value" => $row[1]));
		}
	}

	
	echo json_encode($result);
	
?>