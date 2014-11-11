<?php

include("./DB.php");

if(!isset($_POST["title"]) || !isset($_POST["content"]) || !isset($_POST["UID"])){
	return;
}
$title = $_POST["title"];
$content = $_POST["content"];
$UID = $_POST["UID"];
if( -1 == postquestion($UID, $title, $content)){
	return;
}
else{
	echo"Post Success!<br/>\n";
}
	
?>