<?php
include("./databaseClassMySQLi.php");



function LogIN($email, $password){

	$db = new database();
	$db->connect();
	$pass = htmlentities($password);
	$email = htmlentities($password);
	$query = "SELECT * 
		FROM User 
		where email = $email
		and password = sha1($pass)";
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

?>