<?php
session_start();

unset($_SESSION['UID']);
unset($_SESSION['Name']);
unset($_SESSION['GRP']);
unset($_SESSION['CRD']);

$_SESSION['login'] = false;
$dm = new DOMDocument();
$title = $dm->createElement("Info");
$tep = $dm->createElement("Logout");
$ls = $dm->createTextNode("true");
$tep->appendChild($ls);
$title->appendChild($tep);
$dm->appendChild($title);

echo $dm->saveXML();
?>