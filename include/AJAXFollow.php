<?php
include("DB.php");


$followed = false;

if (isset($_POST['UID']) && isset($_POST['UUID'])) {
	
	//already followed
	if (IsFellowedBy($_POST['UID'],$_POST['UUID']) == 1 ||IsFellowedBy($_POST['UID'],$_POST['UUID']) == 3 ) {
		$followed = true;
	}
	else{
		//follow
		if(Follow($_POST['UID'],$_POST['UUID']) != -1){
			$followed = true;
		}
	}
}

$dm = new DOMDocument();
$title = $dm->createElement("Response");
$tep = $dm->createElement("Followed");
$ls = $dm->createTextNode($followed);
$tep->appendChild($ls);
$title->appendChild($tep);
$dm->appendChild($title);

echo $dm->saveXML();







?>