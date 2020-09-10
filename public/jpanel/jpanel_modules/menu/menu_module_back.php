<?php
	session_start();
	$ckey = "MODULE_INCLUDE";
	include("../../../functions/config.php");
	require_once('../../../functions/main_settings_admin.php');

	
	if($authenticated_cp == false) { exit("Access denied"); }
	if($user_data['userType'] != "A") exit("Access denied");  
	$places = explode("|",$_POST['w']);
	$i = 1;
	foreach($places as $item) {
		if (empty($item)) { continue; }
	
		$query = "UPDATE menu SET place='$i' WHERE id='$item' ";
		$result = mysql_query($query);
		$i++;
	}
	
	if($result)  { print "<br/><span style='background-color:#FFFF99; font-family:Arial; padding:6px;'>Dəyişildi</span>"; }
?>