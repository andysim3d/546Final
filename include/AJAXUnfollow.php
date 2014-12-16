<?php
include("DB.php");


$unfollowed = false;

if (isset($_POST['UID']) && isset($_POST['UUID'])) {
	
	//already followed
	if (IsFollowedBy($_POST['UID'],$_POST['UUID']) == 0 ||IsFollowedBy($_POST['UID'],$_POST['UUID']) == 2 ) {
		$unfollowed = true;
	}
	else{
		//follow
		if(Unfollow($_POST['UID'],$_POST['UUID']) != -1){
			$unfollowed = true;
		}
	}
}

$dm = new DOMDocument();
$title = $dm->createElement("Response");
$tep = $dm->createElement("Unfollowed");
$ls = $dm->createTextNode($unfollowed);
$tep->appendChild($ls);
$title->appendChild($tep);
$dm->appendChild($title);

echo $dm->saveXML();







?>