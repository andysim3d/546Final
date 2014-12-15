<?php session_start();
	include("DB.php");
	if(!((isset($_SESSION['login']))&&($_SESSION['login']==true)))
	{
		header("Location: http://localhost/546Final/pages/index.php");
	}
	$UID = $_SESSION['UID'];
	$GRP = GetGroup($UID);
	if ($GRP <3) {
		header("Location: http://localhost/546Final/pages/index.php");
	}
	if (isset($_POST['Title']) && isset($_POST['Content'])) {

		//$Title_processed = htmlspecialchars($_POST['Title']);
		//$Content_processed = nl2br(htmlspecialchars($_POST['Content']));
		Post_Article($UID, $_POST['Title'], $_POST['Content']);
		;
	}
	header("Location: http://localhost/546Final/pages/index.php");
	

?>