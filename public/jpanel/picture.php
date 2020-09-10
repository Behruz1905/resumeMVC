<?php 
header('Content-type: image/jpeg');

$imgpath = $_GET['imgpath'];
$type = $_GET['type'];

	$p =imagecreatetruecolor(154,124);
	
	if( $type == "image/pjpeg" ) { $im = imagecreatefromjpeg($imgpath); }
	if($type == "image/x-png") { $im = imagecreatefrompng($imgpath); }
	if($type == "image/gif") { $im = imagecreatefromgif($imgpath); }
	
	//list($width, $height) = getimagesize($imgpath);
	
//	imagecopyresized($p,$im,2,2,0,0,150,120,$width,$height);
	
//	imagejpeg($p);

?>