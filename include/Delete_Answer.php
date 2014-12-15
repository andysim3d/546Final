<?php session_start();

$UID = $_SESSION['UID'];
$GRP = GetGroup($UID);

include("DB.php");

if ($GRP <5) {
	header("Location: http://localhost/546Final/pages/index.php");
	return;
}
if(isset($_GET['AID'])){
	Delete_Answer($_GET['AID']);
	header("Location: http://localhost/546Final/pages/index.php");
}
header("Location: http://localhost/546Final/pages/index.php");



?>