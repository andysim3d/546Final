<?php
session_start();
unset($_SESSION['UID']);
unset($_SESSION['Name']);
unset($_SESSION['GRP']);
unset($_SESSION['CRD']);
$dm = new DOMDocument();
$tep = $dm->createElement("Logout");
$ls = $dm->createTextNode("true");
$tep->appendChild($ls);
$dm->appendChild($tep);
echo $dm->saveXML();
?>