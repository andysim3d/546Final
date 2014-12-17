<?php session_start();
include ("DB.php");
$dom = new DOMDocument ();
$UpCount = $dom->createElement ( "Up_Count" );
$DownCount = $dom->createElement ( "Down_Count" );
$resp = $dom->createElement ( "Response" );
$Up = -1;
$Down = -1;
if (isset ( $_SESSION ['UID'] ) && isset ( $_POST ['ArtID'] )) {
	
	if (VoteUp ( $_POST ['ArtID'], $_SESSION ['UID'] ) == - 1) {
		
		$Up = GetUpCount_Art($_POST ['ArtID']);
		$Down = GetDownCount_Art($_POST ['ArtID']);
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