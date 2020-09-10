<?php 
	session_start();
	
	unset($_SESSION['id']);
	unset($_SESSION['login']);
	unset($_SESSION['ip']);
	unset($_SESSION['sessid']);
	
	session_destroy();
	header("location: index.php");
	exit();
?>