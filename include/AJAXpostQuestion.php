<?php
session_start();
include("./DB.php");

$dom = new DOMDocument();
$rootnode = $dom->createElement("Response");
$contentnode = $dom->createElement("Content");


if(!isset($_POST["title"]) || !isset($_POST["content"]) || !isset($_SESSION["UID"])){
	
	$bool = $dom->createTextNode("false");
	$contentnode->appendChild($bool);
	$rootnode->appendChild($contentnode);
	$dom->appendChild($rootnode);
	echo $dom->saveXML();
	return;
}
$title = $_POST["title"];
$content = $_POST["content"];
$UID = $_SESSION["UID"];
if( -1 == postquestion($UID, $title, $content)){
	$bool = $dom->createTextNode("false");
	$contentnode->appendChild($bool);
	$rootnode->appendChild($contentnode);
	$dom->appendChild($rootnode);
	echo $dom->saveXML();
	return;
}
else{
	$bool = $dom->createTextNode("true");
	$contentnode->appendChild($bool);
	$rootnode->appendChild($contentnode);
	$dom->appendChild($rootnode);
	echo $dom->saveXML();
	return;
}
	
?>