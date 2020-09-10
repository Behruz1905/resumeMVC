<?php 
	session_start();
	$ckey = "MODULE_INCLUDE";
	require_once('../../../functions/config.php');
	require_once('../../../functions/functions.php');
	require_once('../../../functions/php_functions.php');
	include("../../../admincontrol/admin_functions.php");
	require_once('../../../functions/main_settings_admin.php');
	require_once('../../../functions/language.php');
	
	$action = $_REQUEST['action'];
	
	$res_arr = array();
	
	$result_par = mysql_query("SELECT catPropertyTypeId,catPropertyTypeName,parentId FROM cat_property_types   ");
	
	while($row_par = mysql_fetch_array($result_par)){
		$res_arr[]
	}


?>