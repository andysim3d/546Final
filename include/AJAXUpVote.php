<?php
include ("DB.php");

$dom = new DOMDocument();
		$content = $dom->createElement("Contnet", "Empty");
		$resp = $dom->createElement("Response");
		$resp->appendChild($content);
		$dom->appendChild($resp);
if (isset($_POST['UID'] ) && isset($_POST['AID'])) {
	
	
	

	
	echo $dom->saveXML();
	return;
	;
}


?>