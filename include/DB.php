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
			where `email` = ?
			and `passwd` = ?";


	if ($stmt = $db->prepare($query)) {
		$stmt->bind_param("ss", $email, sha1($password));
		echo $query;
		if($stmt->execute()){

			//$stmt->store_result();
			$results = $stmt->get_result();
			$reuslt = array();
			if(count($results) == 1){

				foreach ($results as $key => $value) {
					 $userinfo['login'] = 1;
					 foreach ($value as $key_ => $value_) {
					 	// $result[$key_] = $value_[$key_];
					 	$userinfo[$key_] = $value_;
					 	//echo $key_;
					 }
				}//

				$db->disconnect();
				return $userinfo;
			}
		}
	}
	$userinfo['login'] = -1;
	
	$db->disconnect();
	return $userinfo;
}
//htmlentities//

//return 1 if not exsit and validate
//return -1 if exist or invalidate
function checkEmailExist($email){
	$db = new database();
	$db->connect();
	if(emailValidate($email) != false)
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
	$db->disconnect();
	return -1;

}
function regist($email, $username, $password){
	
	$db = new database();
	$db->connect();
	
	if(checkEmailExist($email) == -1){
		return -1;
	}
/*
	$query = "Insert into `User`(`email`, `Name`, `passwd`, `group`, `credits`)
				Values (\"$email\", \"$username\",\"". SHA1($password) ."\",1,0)";
	*/

	$query = "Insert into `User`(`email`, `Name`, `passwd`, `group`, `credits`)
	Values (? , ? , ? ,1,0)";
	
	if ($stmt = $db->prepare($query)) {
		$stmt->bind_param("sss", $email, $username, sha1($password));
		//here
		if($stmt->execute()){
	
			$stmt->store_result();
			$affectrows = $stmt->affected_rows;
				
			if($affectrows == 1){
				$id = $stmt -> insert_id;
				$db->disconnect();
				return $id;
			}
		}
	}
	
	$db->disconnect();
	return -1;
}

//user could upgrade when they have enough credits
function Upgrade($userID){

	$db = new database();
	$db->connect();
	$query = "Update `group` = `group` +1
				from `User` 
				where `UID` = ?";
	

	if ($stmt = $db->prepare($query)) {
		$stmt->bind_param("i", $userID);
		if($stmt->execute()){
	
			$stmt->store_result();
			$affectrows = $stmt->affected_rows;
				
			if($affectrows != 0){
				$db->disconnect();
				return 1;
			}
		}
	}
	return  -1;
	//$db->connect();
	
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
			VALUES ( ? , ? , ? , ? )";
	
	if ($stmt = $db->prepare($query)) {
		$stmt->bind_param("isss", $userID, $ProcceedTitle, $ProcceedContent, date("Y-m-d H:i:s"));
		if($stmt->execute()){
	
			$affectrows = $stmt->affected_rows;
	
			if($affectrows != 0){
				//$db->disconnect();
				return $stmt->insert_id;
			}
		}
	}
	return -1;
}

function IDValidate($userID){
	$reg = "/[0-9]+/";
	if(!preg_match($reg, $userID)){
		echo "Not match";
		return -1;
	}
	$db = new database();
	$db->connect();
	$query = "Select * from `User` where `UID` = ? ";

	if ($stmt = $db->prepare($query)) {
		$stmt->bind_param("i", $userID);
		if($stmt->execute()){
			$stmt->store_result();
			$affectrows = $stmt->affected_rows;
			
			if($affectrows != 0){
				return 1;
			}
		}
	}
	return -1;
}

function GetProfile($userID){
	
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
function GetQuestion_Answer($Qid){
	$db = new database();
	$db->connect();

	$query = "SELECT `Answers`.`Content`, `Time`, `Name` 
			FROM `Answers`, `User` 
			where `User`.`UID` = `Answers`.`UID`
			and `QID` = ?";

	if ($stmt = $db->prepare($query)) {
		$stmt->bind_param("i", $Qid);
		if($stmt->execute()){
		$results = array();
		$result = $stmt->get_result();
		return $result;
		}
	}
	return -1;
}
function GetQuestion_ByID($QID){

	$db = new database();
	$db->connect();
	$query = "SELECT `Questions`.`Content`, `Title`, `Name`, `Time`
			FROM `Questions`, `User` 
			where `User`.`UID` = `Questions`.`UID`
			and `QID` = ?";

	if ($stmt = $db->prepare($query)) {
		$stmt->bind_param("i", $QID);

		if($stmt->execute()){

			$result = $stmt->get_result();

			$results = array();
			foreach ($result as $keys => $values) {
				$element;
				foreach ($values as $key => $value) {
					$element[$key] = $value;
				}
				array_push($results, $element);
			}
			return $results;
		}
	}
	return -1;
}
function UpdateProfile($newly){
	$db = new database();
	$db->connect();
	$query = "UPDATE `Profiles` 
			SET
			`Habit`= ? ,
			`Location`= ? ,
			`BOD`= ?  
			WHERE `PID` =?" ;
	
	/*$query = "UPDATE `Profiles` 
			SET
			`Habit`=\"".$newly['Habit']."\",
			`Location`=\"".$newly['Location']."\",
			`BOD`=\"".$newly['BOD']."\" 
			WHERE `PID` =".$newly['PID'];
			*/
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
			VALUES (? , ? , ? , ? )";
	
	
	/*$query = "INSERT INTO `Profiles`(`UID`, `Habit`, `Location`, `BOD`) 
			VALUES (". $newly['UID']."
			,\"". $newly['Habit'] ."\"
			,\"". $newly['Location'] ."\"
			,\"". $newly['BOD'] ."\")";
	*/
	if(!$res = $db->send_sql($query)){
			$db->disconnect();
			echo "Insert failed!<br/>\n";
			return -1;
	}
	echo "Insert Succeed!<br/>\n";
	
	$db->disconnect();
}


function GetArticlesByUID($UID){
	
	$db = new database();
	$db->connect();
	$query = "SELECT `Title`, `Time`,`Name` 
			FROM `Article`, `User` WHERE `User`.`UID` = `Article`.`UID` and `User`.`UID` = ? ";

	if ($stmt = $db->prepare($query)) {
		$stmt->bind_param("i", $UID);
	
		if($stmt->execute()){
	
			$result = $stmt->get_result();
	
			$results = array();
			foreach ($result as $keys => $values) {
				$element;
				foreach ($values as $key => $value) {
					$element[$key] = $value;
				}
				array_push($results, $element);
			}
			return $results;
		}
	}
	return -1;
}

function GetArticle($Artid){
	

	$db = new database();
	$db->connect();
	$query = "SELECT `Title`, `Content`, `Time`, `Up_Vote`, `Down_Vote`,`Name` 
			FROM `Article`, `User` WHERE `User`.`UID` = `Article`.`UID` and `ArtID` = ? ";
	
	
	if ($stmt = $db->prepare($query)) {
		$stmt->bind_param("i", $Artid);
	
		if($stmt->execute()){
	
			$result = $stmt->get_result();
	
			$results = array();
			foreach ($result as $keys => $values) {
				$element;
				foreach ($values as $key => $value) {
					$element[$key] = $value;
				}
				array_push($results, $element);
			}
			return $results;
		}
	}
	return -1;
	
	
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