<?php
include("./databaseClassMySQLi.php");



function LogIN($email, $password){
	$db = new database();
	$db->connect();
	$pass = htmlentities($password);
	$email = htmlentities($password);
	$query = "SELECT * 
		FROM `User` 
		where `email` = $email
		and `password` = sha1($pass)";
	$res = $db->send_sql($query);
	//if count = 1, means log in success
	$count = 0;

	if($row = $db->next_row()){
		$count = 1;
		$userinfo['login'] = 1;
		$userinfo['UID'] = $row['UID'];
		$userinfo['email'] = $row['email'];
		$userinfo['Name'] = $row['Name'];
		$userinfo['group'] = $row['group'];
		$userinfo['credits'] = $row['credits'];
	}
	else{
		$userinfo['login'] = -1;
	}
	$db->disconnect();
	return $userinfo;
}
//htmlentities//

function regist($username, $email, $password){
	

	$db = new database();
	$db->connect();
	
	$query = "SELECT 
				* FROM `User`
				 where `email` = \"" . $email."\"";
	if(!$res = $db->send_sql($query)){
		return -1;
	}
	
	$num = mysqli_num_rows($res);
	
	//if num != 0, means this email has been registed
	if ($num != 0) {
		return -1;
	}

	$query = "Insert into `User`(`email`, `Name`, `passwd`, `group`, `credits`)
				Values (\"$email\", \"$username\",\"". SHA1($password) ."\",1,0)";
	
	if(!$res = $db->send_sql($query)){
		return -1;
	}
	
	$id = $db->insert_id();

	return $id;
	
	//Do something.
}

//user could upgrade when they have enough credits
function Upgrade($userID){

	$db = new database();
	$query = "
			Update group = group +1
			from User 
			where UID = $userID
			";
	$db->send_sql($query);
	
	$db->connect();
	
}

function emailValidate($email){
	$res = filter_var($email, FILTER_VALIDATE_EMAIL);
	//$reg = "/[^a-z0-9]([a-z0-9_]+[.]*)+[@]/";

	return $res;


}
?>