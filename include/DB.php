<?php
include("./databaseClassMySQLi.php");

//for paging query
$LIMITION = 10;

function LogIN($email, $password){
	if($email == "" || $password == ""){
		return -1;
	}
	$db = new database();
	$db->connect();
	$pass = htmlentities($password);
	$email = htmlentities($email);

	$query = "SELECT * 
			FROM `User` 
			where `email` = \"".$email."\"
			and `passwd` = \"".sha1($pass)."\"";
	if(!$res = $db->send_sql($query)){
			$db->disconnect();
			echo "Login failed!<br/>\n";
			return -1;
	}
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

//return 1 if not exsit and validate
//return -1 if exist or invalidate
function checkEmailExist($email){
	$db = new database();
	$db->connect();
	
	/*$query = "SELECT
				* FROM `User`
				 where `email` = \"" . $email."\"";
				 */
	$query = "SELECT
				* FROM `User`
				 where `email` = ? ";
	//echo $query;
	if ($stmt = $db->prepare($query)) {
		$stmt->bind_param("s", $email);
		if($stmt->execute()){

			$stmt->store_result();
			$affectrows = $stmt->affected_rows;
			
			if($affectrows == 0){
				$db->disconnect();
				return 1;
			}
		}
	}
	//if(!$res = $db->send_sql($query)){
	//	return -1;
	//}
	
//	$num = mysqli_num_rows($res);
	//if num != 0, means this email has been registed
	//if ($num != 0) {
		//$db->disconnect();
		//return -1;
	//}
	$db->disconnect();
	return -1;

}
function regist($email, $username, $password){
	
	$db = new database();
	$db->connect();
	
	/* $query = "SELECT 
				* FROM `User`
				 where `email` = \"" . $email."\"";
	if(!$res = $db->send_sql($query)){
		return -1;
	}
	
	$num = mysqli_num_rows($res);
	//if num != 0, means this email has been registed
	if ($num != 0) {
		return -1;
	} */
	if(checkEmailExist($email) == -1){
		return -1;
	}

	$query = "Insert into `User`(`email`, `Name`, `passwd`, `group`, `credits`)
				Values (\"$email\", \"$username\",\"". SHA1($password) ."\",1,0)";
	
	if(!$res = $db->send_sql($query)){
		$db->disconnect();
		return -1;
	}
	
	$id = $db->insert_id();

	$db->disconnect();
	return $id;
	
	//Do something.
}

//user could upgrade when they have enough credits
function Upgrade($userID){

	$db = new database();
	$query = "
			Update `group` = `group` +1
			from `User` 
			where `UID` = $userID
			";
	$db->send_sql($query);
	
	$db->connect();
	
}
//validate email;
function emailValidate($email){
	$res = filter_var($email, FILTER_VALIDATE_EMAIL);
	return $res;
}

function postquestion($userID, $title, $content){
	if(IDValidate($userID) == -1){
		return -1;
	}
	$ProcceedContent = htmlentities($content);
	$ProcceedTitle = htmlentities($title);
	$db = new database();
	$db->connect();
	//date_timezone_set();
	//$date = new DateTime(strtotime(), new DateTimeZone('UTC'));
	//date_timezone_set('UTC');
	//$date_ = date('Y-d-m');
	date_default_timezone_set('UTC');
	$query = "INSERT INTO `Questions`(`UID`, `Title`, `Content`, `Time`) 
			VALUES ($userID,\"$ProcceedTitle\",\"$ProcceedContent\",\"". date("Y-m-d H:i:s") ."\")";
	if(!($res = $db->send_sql($query))){
		//echo "fail";
		$db->disconnect();
		return -1;
	}
	
	$res = $db->insert_id();
	$db->disconnect();
	return $res;
}

function IDValidate($userID){
	$reg = "/[0-9]+/";
	if(!preg_match($reg, $userID)){
		echo "Not match";
		return -1;
	}
	$db = new database();
	$db->connect();
	$query = "Select * from `User` where `UID` = $userID";
	if(!$res = $db->send_sql($query)){
		$db->disconnect();
		return -1;
	}
	
	$num = mysqli_num_rows($res);
	//if num != 0, means this email has been registed
	if ($num == 0) {
	$db->disconnect();
		return -1;
	}
	$db->disconnect();
}

function GetProfile($userID){

	//echo "GetProfile $userID<br/>";
	if(IDValidate($userID) == -1){
		echo "User Invalidate<br/>";
		return -1;
		}
	
		$db = new database();
		$db->connect();
		$query = "Select * from `Profiles` where `UID` = $userID";
	
	
		if(!$row = $db->send_sql($query)){
			$db->disconnect();
			return -1;
		}
	
		$num = mysqli_num_rows($row);
		//echo $num;
	
		//if $num == 0, means this user has not edit profile
		if($num != 0){
			$row = $db->next_row();
	
			$res['getProfile'] = 1;
			$res['UID'] = $row['UID'];
			$res['PID'] = $row['PID'];
			$res['Location'] = $row['Location'];
			$res['Habit'] = $row['Habit'];
			$res['BOD'] = $row['BOD'];
		}
		else {
			$res['getProfile'] = -1;
		}
	
		$db->disconnect();
		return $res;
}

function UpdateProfile($newly){
	$db = new database();
	$db->connect();
/*	
	foreach ($newly as $key => $value) {
		echo "$key => $value<br/>\n";
	}
*/
	$query = "UPDATE `Profiles` 
			SET
			`Habit`=\"".$newly['Habit']."\",
			`Location`=\"".$newly['Location']."\",
			`BOD`=\"".$newly['BOD']."\" 
			WHERE `PID` =".$newly['PID'];
	//echo "$query<br/>\n";
	
	if(!$res = $db->send_sql($query)){
			$db->disconnect();
			return -1;
		}
	
	echo"Update success!<br/>\n";

	$db->disconnect();
}

function InsertProfile($newly){

	$db = new database();
	$db->connect();
	
	$query = "INSERT INTO `Profiles`(`UID`, `Habit`, `Location`, `BOD`) 
			VALUES (". $newly['UID']."
			,\"". $newly['Habit'] ."\"
			,\"". $newly['Location'] ."\"
			,\"". $newly['BOD'] ."\")";
	
	if(!$res = $db->send_sql($query)){
			$db->disconnect();
			echo "Insert failed!<br/>\n";
			return -1;
	}
	echo "Insert Succeed!<br/>\n";
	
	$db->disconnect();
}

function GetQuestion(){
	$LIMITION = 10;
	$db = new database();
	$db->connect();
	//static SQL, no need to bind
	$query = "select * from Questions
			order by TIME
			limit $LIMITION
			";
	echo "$query<br/>";
	if(!$res = $db->send_sql($query)){
		$db->disconnect();
		echo "Get Questions failed!<br/>\n";
		return -1;
	}

	$num = mysqli_num_rows($res);
	
	for($cur; $cur < $num; $cur++){
		$temres = $db->next_row();
		foreach ($temres as $key => $var){
			$res[$cur][$key] = $var;
		}
	}
	
	return $res;
}
?>