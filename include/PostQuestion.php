<?php session_start();



	if (isset($_SESSION['login']) && ($_SESSION['login'] == true) 
		&& ($_SESSION['GRP'] >= 0) ) {
		
		;
	}
	else{
		return -1;
	}



// 	$_SESSION['login'] = true;
// 	$_SESSION['UID'] = $userinfo['UID'];
// 	$_SESSION['Name'] = $userinfo['Name'];
// 	$_SESSION['GRP'] = $userinfo['group'];
// 	$_SESSION['CRD'] = $userinfo['credits'];

?>