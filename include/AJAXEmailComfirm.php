<?php
include ("DB.php");


$dom = new DOMDocument();
if(!isset($_POST['email'])){
	$content = $dom->createElement("Contnet", "Empty");
	$resp = $dom->createTextNode("Response");
	$resp->appendChild($content);
	$dom->appendChild($resp);
	echo $dom->saveXML();
}
?>