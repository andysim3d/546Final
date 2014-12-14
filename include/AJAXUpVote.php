<?php session_start();
include ("DB.php");
$dom = new DOMDocument ();
$UpCount = $dom->createElement ( "Up_Count" );
$DownCount = $dom->createElement ( "Down_Count" );
$resp = $dom->createElement ( "Response" );
$Up = -1;
$Down = -1;
if (isset ( $_SESSION ['UID'] ) && isset ( $_POST ['AID'] )) {
	
	if (VoteUp ( $_SESSION ['UID'], $_POST ['AID'] ) == - 1) {
		
		$Up = GetUpCount($_POST ['AID']);
		$Down = GetDownCount($_POST ['AID']);
	}
}

$UpN = $dom->createTextNode($Up);
$DownN = $dom->createTextNode($Down);
$UpCount->appendChild($UpN);
$DownCount->appendChild($DownN);
$resp->appendChild ( $UpCount );
$resp->appendChild ( $DownCount );
$dom->appendChild ( $resp );
echo $dom->saveXML ();
return;
?>