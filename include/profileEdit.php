<?php

include("./DB.php");
//for test
if (!isset($_GET['UID'])){
	echo"balh<br/>";
	return -1;
}
$userID = $_GET['UID'];

$profile = GetProfile($userID);

if($profile['getProfile'] == -1){
	echo "No profiles found.<br/>";
	//return -1;
	
	
	if(isset($_GET['Location'])){
		$after['Location'] = $_GET['Location'];
	}
	else{
		$after['Location'] ="Where?";
	}
	
	if(isset($_GET['Habit'])){
		$after['Habit'] = $_GET['Habit'];
	}
	else{
		$after['Habit'] ="Nothing";
	}
	
	if(isset($_GET['BOD'])){
		$after['BOD'] = $_GET['BOD'];
	}
	else{
		$after['BOD'] ="1970-01-01";
	}
	$after['UID'] = $userID;
	InsertProfile($after);
}

/*
echo "Before:Location: ".$profile['Location']."<br/>";
echo "Before:Habit: ".$profile['Habit']."<br/>";
echo "Before:BOD: ".$profile['BOD']."<br/>";
*/
if(isset($_GET['Location'])){
	$after['Location'] = $_GET['Location'];
}
else{
	$after['Location'] =$profile['Location'];
}

if(isset($_GET['Habit'])){
	$after['Habit'] = $_GET['Habit'];
}
else{
	$after['Habit'] =$profile['Habit'];
}

if(isset($_GET['BOD'])){
	$after['BOD'] = $_GET['BOD'];
}
else{
	$after['BOD'] =$profile['BOD'];
}
$after['PID'] = $profile['PID'];

UpdateProfile($after);

$profile = GetProfile($userID);
/*
echo "After: Location: ".$profile['Location']."<br/>";
echo "After: Habit: ".$profile['Habit']."<br/>";
echo "After: BOD: ".$profile['BOD']."<br/>";
*/
?>