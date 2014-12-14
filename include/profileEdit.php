<?php session_start();

include("./DB.php");
//$_POST is used for test
if (!isset($_SESSION['UID'])){
	echo"balh<br/>";
	return -1;
}
$userID = $_SESSION['UID'];
//echo $userID
$after = array();
$profile = GetProfile($userID);
//print_r($profile);
if($profile['getProfile'] == -1){
	// echo "No profiles found.<br/>";
	//return -1;
	
	//generate newly as profile entity.
	if(isset($_POST['Location'])){

		$after['Location'] = $_POST['Location'];
	}
	else{
		$after['Location'] ="-";
	}
	
	if(isset($_POST['Habit'])){
		$after['Habit'] = $_POST['Habit'];
	}
	else{
		$after['Habit'] ="-";
	}
	
	if(isset($_POST['BOD'])){
		$after['BOD'] = $_POST['BOD'];
	}
	else{
		$after['BOD'] ="1970-01-01";
	}
	$after['UID'] = $userID;
	//insert
	//print_r($after);
	//echo "so insert???<br/>";
	InsertProfile($after);
}

/*
echo "Before:Location: ".$profile['Location']."<br/>";
echo "Before:Habit: ".$profile['Habit']."<br/>";
echo "Before:BOD: ".$profile['BOD']."<br/>";
*/
else{
	if(isset($_POST['Location'])){
		$after['Location'] = $_POST['Location'];
	}
	else{
		$after['Location'] =$profile['Location'];
	}

	if(isset($_POST['Habit'])){
		$after['Habit'] = $_POST['Habit'];
	}
	else{
		$after['Habit'] =$profile['Habit'];
	}

	if(isset($_POST['BOD'])){
		$after['BOD'] = $_POST['BOD'];
	}
	else{
		$after['BOD'] =$profile['BOD'];
	}
	$after['PID'] = $profile['PID'];
	//echo " set!!!";
	UpdateProfile($after);
}
// $profile = GetProfile($userID);
//jump back to profile.php
header("Location: http://localhost/546Final/pages/profile.php")

// print_r($profile);
/*
echo "After: Location: ".$profile['Location']."<br/>";
echo "After: Habit: ".$profile['Habit']."<br/>";
echo "After: BOD: ".$profile['BOD']."<br/>";
*/
?>