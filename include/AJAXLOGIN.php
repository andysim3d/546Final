<?php
session_start();
include("./DB.php");

$dom = new DOMDocument();

$user_Info = $dom->createElement("Info");
$user_Login = $dom->createElement("Login");
//$txt = $dom->createTextNode("true");

if (!isset($_POST["email"]) || !isset($_POST["password"])) {
	$txt = $dom->createTextNode("false");

	$user_Login->appendChild($txt);
	$user_Info->appendChild($user_Login);
	$dom->appendChild($user_Info);
	echo $dom->saveXML();
	return;
}

$email = $_POST["email"];
if(!emailValidate($email)){
	$txt = $dom->createTextNode("false");
$user_Login->appendChild($txt);
$user_Info->appendChild($user_Login);
	$dom->appendChild($user_Info);

	
		echo $dom->saveXML();
		return;
}

$password = $_POST["password"];
$userinfo = LogIN($email, $password);
if (!isset($userinfo["login"])) {
	$txt = $dom->createTextNode("false");
$user_Login->appendChild($txt);
$user_Info->appendChild($user_Login);
	$dom->appendChild($user_Info);

	
	echo $dom->saveXML();
	return;
}
if($userinfo["login"] == -1){
	$txt = $dom->createTextNode("false");
$user_Login->appendChild($txt);
$user_Info->appendChild($user_Login);
	$dom->appendChild($user_Info);

	
	echo $dom->saveXML();
	return;
}

/*foreach ($userinfo as $key => $variable) {
	# code...
	echo "$key == > $variable<br/>\n";
}
*/

$user_Info = $dom->createElement("Info");
$user_Login = $dom->createElement("Login");
$txt = $dom->createTextNode("true");

$user_ID = $dom->createElement("user-ID");
$user_Name = $dom->createElement("user-name");
$user_group = $dom->createElement("user-group");
$user_credits = $dom->createElement("user-credits");

$user_Login->appendChild($txt);
$user_Info->appendChild($user_Login);

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

$_SESSION['UID'] = $user_ID;
$_SESSION['Name'] = $user_Name;
$_SESSION['GRP'] = $user_group;
$_SESSION['CRD'] = $user_credits;

$xmlString = $dom->saveXML();
echo $xmlString;

/*opendir(getcwd());
$filename = "text.xml";
$fh = fopen($filename, "w");
fwrite($fh, $xmlString);
*/
?>