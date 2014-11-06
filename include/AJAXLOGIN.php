<?php

include("./DB.php");

$dom = new DOMDocument();
if (!isset($_GET["email"]) || !isset($_GET["password"])) {
	echo $dom->saveXML();
}

$email = $_GET["email"];
if(!emailValidate($email)){
		echo $dom->saveXML();
}

$password = $_GET["password"];
$userinfo = LogIN($email, $password);
if (!isset($userinfo["login"])) {
	echo $dom->saveXML();
}
if($userinfo["login"] == -1){
	echo $dom->saveXML();
}

/*foreach ($userinfo as $key => $variable) {
	# code...
	echo "$key == > $variable<br/>\n";
}
*/

$user_Info = $dom->createElement("Info");

$user_ID = $dom->createElement("user-ID");
$user_Name = $dom->createElement("user-name");
$user_group = $dom->createElement("user-group");
$user_credits = $dom->createElement("user-credits");

$text = $dom->createTextNode($userinfo["UID"]);
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



/*opendir(getcwd());
$filename = "text.xml";
$fh = fopen($filename, "w");
fwrite($fh, $xmlString);
*/
?>