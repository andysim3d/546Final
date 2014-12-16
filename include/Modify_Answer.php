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
if(isset($_POST['AID'])){
	$WriterUID = Get_UID_By_AID($_POST['AID']);
	if($WriterUID != $UID){
		header($header);
	}
	$GRP = GetGroup($UID);
	$header = "Location: http://localhost/546Final/pages/index.php";
	//Permission Denied
	if ($GRP < 1) {
		header($header);
		return ;
	}
	if(isset($_POST['AID'])&& isset($_POST['Content'])){
		Modify_Answer($_POST['AID'], $_POST['Content']);	
		header($header);
	}
}
header($header);
?>