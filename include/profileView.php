<?php

include("./DB.php");
//for test
if (!isset($_GET['UID'])){
	echo"balh<br/>";
	return -1;
}

$profile = GetProfile($userID);

if($profile['getProfile'] == -1){
	echo "No profiles found.<br/>";
	return -1;
}
echo "Location: ".$profile['Location']."<br/>";
echo "Habit: ".$profile['Habit']."<br/>";
echo "BOD: ".$profile['BOD']."<br/>";

?>