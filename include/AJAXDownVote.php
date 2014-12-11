<?php

include ("DB.php");

$dom = new DOMDocument ();
$UpCount = $dom->createElement ( "Up Count" );
$DownCount = $dom->createElement ( "Down Count" );
$resp = $dom->createElement ( "Response" );
$Up = -1;
$Down = -1;
if (isset ( $_POST ['UID'] ) && isset ( $_POST ['AID'] )) {
	if (VoteDown( $_POST ['AID'], $_POST ['UID'] ) == - 1) {
		$Up = GetUpCount($_POST ['AID']);
		$Down = GetDownCount($_POST ['AID']);
	}
}

$UpN = $dom->createTextNode("$Up");
$DownN = $dom->createTextNode("$Down");
$UpCount->appendChild($UpN);
$DownCount->appendChild($DownN);
$resp->appendChild ( $UpCount );
$resp->appendChild ( $DownCount );
$dom->appendChild ( $resp );
echo $dom->saveXML ();
return;
?>