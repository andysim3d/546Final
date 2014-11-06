<?php

include("./DB.php");

$dom = new DOMDocument();
if (!isset($_GET["email"]) || !isset($_GET["password"])) {
	return $dom;
}

$email = $_GET["email"];
if(!emailValidate($email)){
	return $dom;
}
$password = $_GET["password"];
$userinfo = LogIN($email, $password);
if (!isset($userinfo["login"])) {
	return $dom;
}
if($userinfo["login"] == -1){
	return $dom;
}
$user_Info = $dom->createElement("Info");

$user_ID = $dom->createElement("user-ID");
$user_Name = $dom->createElement("user-name");
$user_group = $dom->createElement("user-group");
$user_credits = $dom->createElement("user-credits");

$text = $dom->createTextNode($userinfo["ID"]);
$user_ID->appendChild($text);
$user_Info->appendChild($user_ID);

$text = $dom->createTextNode($userinfo["Name"]);
$user_Name->appendChild($text);
$user_Info->appendChild($user_Name);

$text = $dom->createTextNode($userinfo["group"]);
$user_group->appendChild($text);
$user_Info->appendChild($user_group);

$text = $dom->createTextNode($userinfo["credits"]);
$user_credits->appendChild($text);
$user_Info->appendChild($user_credits);

$dom->appendChild($user_Info);
$xmlString = $dom->saveXML();

echo $xmlString;
?>