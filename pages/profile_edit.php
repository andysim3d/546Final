<?php session_start();

include("./DB.php");
//$_POST is used for test

// print_r($_POST);
// print_r($_FILES);
if (!isset($_SESSION['UID'])){
	echo"balh<br/>";
	return -1;
}

$userID = $_SESSION['UID'];
//echo $userID
$after = array();
$profile = GetProfile($userID);
//print_r($profile);
//upload file
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

//update image;
if (isset($_FILES['pic'])) {
	//error happens
	if ($_FILES['pic']['error']!= 0) {
		//header("Location: http://localhost/546Final/pages/profile.php");
	}

	$allowed =  array('gif','png' ,'jpg', 'bmp');
	$filename = $_FILES['pic']['name'];
	$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
	// echo $ext;
	if(!in_array($ext,$allowed) ) {
		//echo "extension name error";
		header("Location: http://localhost/546Final/pages/profile.php");
	}

	$upload_file_name = $userID.".".$ext;
	$upload_full_file_name = "upload/".$upload_file_name;
	//echo getcwd().$upload_full_file_name;
	$pwd = getcwd();
	chdir("../upload");
	if (move_uploaded_file($_FILES['pic']['tmp_name'], $upload_file_name)) {
		UploadImage($userID,$upload_file_name);	
	}
	chdir($pwd);
	

}
header("Location: http://localhost/546Final/pages/profile.php");

// $profile = GetProfile($userID);
//jump back to profile.php
//header("Location: http://localhost/546Final/pages/profile.php")

// print_r($profile);
/*
echo "After: Location: ".$profile['Location']."<br/>";
echo "After: Habit: ".$profile['Habit']."<br/>";
echo "After: BOD: ".$profile['BOD']."<br/>";
*/
?>