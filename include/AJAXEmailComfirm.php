<?php
include ("DB.php");


$dom = new DOMDocument();
if(!isset($_POST['email'])){
	$content = $dom->createElement("Contnet", "Empty");
	$resp = $dom->createElement("Response");
	$resp->appendChild($content);
	$dom->appendChild($resp);
}
else
{
	if(checkEmailExist($_POST['email']) == 1){
	$con = $dom->createElement("Validate");
	$text = $dom->createTextNode("true");
	$content = $dom->createElement("Contnet");
	$resp = $dom->createElement("Response");
	$con->appendChild($text);
	$content->appendChild($con);
	$resp->appendChild($content);
	$dom->appendChild($resp);
	}
	else{
	$con = $dom->createElement("Validate");
	$text = $dom->createTextNode("false");
	$content = $dom->createElement("Contnet");
	$resp = $dom->createElement("Response");
	$con->appendChild($text);
	$content->appendChild($con);
	$resp->appendChild($content);
	$dom->appendChild($resp);
	}
}


	echo $dom->saveXML();
	return;
?>