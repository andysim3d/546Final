<?php session_start();

include("DB.php");

$UID = $_SESSION['UID'];
$GRP = GetGroup($UID);
if ($GRP <5) {
	header("Location: http://localhost/546Final/pages/index.php");
	return;
}
if(isset($_GET['QID'])){
	Delete_Question($_GET['QID']);
	header("Location: http://localhost/546Final/pages/index.php");
}
header("Location: http://localhost/546Final/pages/index.php");



?>