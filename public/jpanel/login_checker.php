<?php 
	if(!isset($_SESSION['id']) or $_SESSION['ip'] != $_SERVER['REMOTE_ADDR'] or $_SESSION['sessid'] != session_id()) {
		header('Location: admincontrol/ ');
		exit;
	}
	if(!isset($_SESSION['id']) || $_SESSION['id'] == "") { 
		header('Location: admincontrol/');
		exit;
	}

?>