<?php session_start();
// Not login
include ("DB.php");
if((isset($_SESSION['login']))&&($_SESSION['login']==true))
{
}
else{
	header("Location: http://localhost/546Final/pages/index.php");
	return ;
}

$UID = $_SESSION['UID'];
$GRP = GetGroup($UID);
//echo $UID;
//print_r($_POST);
$header = "Location: http://localhost/546final/pages/edit_answer.php?var=". $_POST['QID'];

//Permission Denied
if ($GRP <= 1) {
	header($header);
	return ;
}
if(isset($_POST['ArtID']) && isset($_POST['Title']) && isset($_POST['Content'])){
	Modify_Article($_POST['ArtID'], $_POST['Title'], $_POST['Content']);	
	header($header);	
}
header($header);
?>