<?php
include ("./databaseClassMySQLi.php");

// for paging query
$LIMITION = 10;
function LogIN($email, $password) {
	if ($email == "" || $password == "") {
		return - 1;
	}
	$db = new database ();
	$db->connect ();
	$pass = htmlspecialchars ( $password );
	$email = htmlspecialchars ( $email );
	
	$query = "SELECT * 
	FROM `User` 
	where `email` = ?
	and `passwd` = ?";
	
	if ($stmt = $db->prepare ( $query )) {
		$stmt->bind_param ( "ss", $email, sha1 ( $password ) );
		// echo $query;
		if ($stmt->execute ()) {
			
			// $stmt->store_result();
			$results = $stmt->get_result ();
			$reuslt = array ();
			if (count ( $results ) == 1) {
				
				foreach ( $results as $key => $value ) {
					$userinfo ['login'] = 1;
					foreach ( $value as $key_ => $value_ ) {
						// $result[$key_] = $value_[$key_];
						$userinfo [$key_] = $value_;
						// echo $key_;
					}
				} //
				
				$db->disconnect ();
				return $userinfo;
			}
		}
	}
	$userinfo ['login'] = - 1;
	
	$db->disconnect ();
	return $userinfo;
}
// htmlentities//

// return 1 if not exsit and validate
// return -1 if exist or invalidate
function checkEmailExist($email) {
	$db = new database ();
	$db->connect ();
	
	if (emailValidate ( $email ) != false) {
		$mail = htmlspecialchars ( $email );
		$query = "SELECT
		* FROM `User`
		where `email` = ? ";
		// echo $query;
		if ($stmt = $db->prepare ( $query )) {
			$stmt->bind_param ( "s", $mail );
			if ($stmt->execute ()) {
				
				$stmt->store_result ();
				$affectrows = $stmt->affected_rows;
				
				if ($affectrows == 0) {
					$db->disconnect ();
					return 1;
				}
			}
		}
	}
	$db->disconnect ();
	return - 1;
}

// Regist
function regist($email, $username, $password) {
	$db = new database ();
	$db->connect ();
	
	if (checkEmailExist ( $email ) == - 1) {
		return - 1;
	}
	$mail = htmlspecialchars ( $email );
	$name = htmlspecialchars ( $username );
	$pass = htmlspecialchars ( $password );
	$query = "Insert into `User`(`email`, `Name`, `passwd`, `group`, `credits`)
	Values ( ? , ? , ? , 1 , 0 )";
	
	if ($stmt = $db->prepare ( $query )) {
		$stmt->bind_param ( "sss", $mail, $name, sha1 ( $pass ) );
		// here
		if ($stmt->execute ()) {
			
			$stmt->store_result ();
			$affectrows = $stmt->affected_rows;
			
			if ($affectrows == 1) {
				$id = $stmt->insert_id;
				$db->disconnect ();
				return $id;
			}
		}
	}
	
	$db->disconnect ();
	return - 1;
}
function AddCreadits($UID) {
	$db = new database ();
	$db->connect ();
	$query = "UPDATE `User` SET `credits` = `credits` + 1
	where `UID` = ?";
	
	if ($stmt = $db->prepare ( $query )) {
		$stmt->bind_param ( "i", $UID );
		if ($stmt->execute ()) {
			
			$stmt->store_result ();
			$affectrows = $stmt->affected_rows;
			if ($affectrows != 0) {
				$db->disconnect ();
				$currentCredit = GetCredit ( $UID );
				CheckUpdate ( $UID, $currentCredit );
				return 1;
			}
		}
	}
	return - 1;
}

/**
 * user could upgrade when they have enough credits
 * @param int $userID
 * @param int $GRP
 * @return sucess on 1, else on -1
 */
function Upgrade($userID, $GRP){

	$db = new database();
	$db->connect();
	$level = GetGroup($userID);
	//if level higher than GRP, just return;
	//Never downgrade
	if($level >= $GRP){
		return 1;
	}
	
	$query = "Update `User` Set `group` = ?
	where `UID` = ?";

	if ($stmt = $db->prepare($query)) {
		$stmt->bind_param("ii", $GRP, $userID);
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
}

function CheckUpdate($UID, $credits) {
	if ($credits < 10) {
		Upgrade ( $UID, 1 );
	} elseif ($credits < 20) {
		Upgrade ( $UID, 2 );
	} elseif ($credits < 30) {
		Upgrade ( $UID, 3 );
	} else {
		Upgrade ( $UID, 5 );
	}
}

// validate email;

function emailValidate($email) {
	$res = filter_var ( $email, FILTER_VALIDATE_EMAIL );
	return $res;
}
/**
 * add question in DB
 * @param int $userID
 * @param string $title
 * @param string $content
 * @return 1 on success, else -1
 */
function postquestion($userID, $title, $content) {
	if (IDValidate ( $userID ) == - 1) {
		return - 1;
	}
	$ProcceedContent = nl2br ( htmlentities ( $content ) );
	$ProcceedTitle = htmlspecialchars ( $title );
	$db = new database ();
	$db->connect ();
	date_default_timezone_set ( 'UTC' );
	
	$query = "INSERT INTO `Questions`(`UID`, `Title`, `Content`, `Time`) 
	VALUES ( ? , ? , ? , ? )";
	
	if ($stmt = $db->prepare ( $query )) {
		$stmt->bind_param ( "isss", $userID, $ProcceedTitle, $ProcceedContent, date ( "Y-m-d H:i:s" ) );
		if ($stmt->execute ()) {
			
			$affectrows = $stmt->affected_rows;
			
			if ($affectrows != 0) {
				return $stmt->insert_id;
			}
		}
	}
	return - 1;
}
/**
 * check if UID is validate
 * @param int $userID
 * @return success return 1, else -1;
 */

function IDValidate($userID) {
	$reg = "/[0-9]+/";
	if (! preg_match ( $reg, $userID )) {
		echo "Not match<br/>";
		return - 1;
	}
	$db = new database ();
	$db->connect ();
	$query = "Select * from `User` where `UID` = ? ";
	
	if ($stmt = $db->prepare ( $query )) {
		$stmt->bind_param ( "i", $userID );
		if ($stmt->execute ()) {
			$stmt->store_result ();
			$affectrows = $stmt->affected_rows;
			
			if ($affectrows != 0) {
				return 1;
			}
		}
	}
	return - 1;
}
/**
 * Get user's Profile
 * @param int $userID
 * @return success return profile, else return -1
 */
function GetProfile($userID) {
	if (IDValidate ( $userID ) == - 1) {
		echo "User Invalidate<br/>";
		return - 1;
	}
	$db = new database ();
	$db->connect ();
	$query = "Select `Location`, `Name`,`Habit`, `BOD`, `Email`, `group`, `credits`, `PID`
	from `Profiles`, `User` 
	where `User`.`UID` = ? 
	and `Profiles`.`UID` = `User`.`UID`";
	
	if ($stmt = $db->prepare ( $query )) {
		$stmt->bind_param ( "i", $userID );
		
		if ($stmt->execute ()) {
			
			$result = $stmt->get_result ();
			
			$results = array ();
			
			foreach ( $result as $keys => $values ) {
				$element;
				foreach ( $values as $key => $value ) {
					$element [$key] = $value;
				}
				$element ['getProfile'] = 1;
				array_push ( $results, $element );
			}
			// print_r($reuslts);
			if (count ( $results ) == 0) {
				
				$resultsss ['getProfile'] = - 1;
				return $resultsss;
			}
			return $results [0];
		}
	}
	$resultss ['getProfile'] = - 1;
	return $resultss;
}

// get current group
/**
 * Get user's GRP num
 * @param int $UID
 * @return GRP num
 */
function GetGroup($UID) {
	$db = new database ();
	$db->connect ();
	
	$query = "SELECT `group` FROM `User` 
	where `UID` = ?";
	if ($stmt = $db->prepare ( $query )) {
		$stmt->bind_param ( "i", $UID );
		
		if ($stmt->execute ()) {
			$results = array ();
			$result = $stmt->get_result ();
			
			foreach ( $result as $keys => $values ) {
				$element;
				foreach ( $values as $key => $value ) {
					$element [$key] = $value;
				}
				array_push ( $results, $element );
			}
			if (count ( $results ) == 0) {
				return - 1;
			}
			return $results [0] ['group'];
		}
	}
	return - 1;
}


function Modify_Question($QID, $Title, $Content){

	$db = new database ();
	$db->connect ();

	$query = "UPDATE `Questions` 
				SET `Title`= ? ,`Content`= ?
				WHERE `QID` = ? ";
	$title_Processed = nl2br(htmlspecialchars($Title));
	$content_Processed = nl2br(htmlspecialchars($Content));
	if ($stmt = $db->prepare ( $query )) {
		$stmt->bind_param ( "ssi", $title_Processed, $content_Processed, $QID );
		
		if ($stmt->execute ()) {
			$stmt->store_result ();
			$result = $stmt->affected_rows;
			
			return $result;
		}
	}
	return - 1;
}

// get current credit
/**
 * Get user's credit
 * @param int $UID
 * @return int user's credit
 */
function GetCredit($UID) {
	$db = new database ();
	$db->connect ();
	
	$query = "SELECT `credits` FROM `User` 
	where `UID` = ?";
	if ($stmt = $db->prepare ( $query )) {
		$stmt->bind_param ( "i", $UID );
		
		if ($stmt->execute ()) {
			$results = array ();
			$result = $stmt->get_result ();
			
			foreach ( $result as $keys => $values ) {
				$element;
				foreach ( $values as $key => $value ) {
					$element [$key] = $value;
				}
				array_push ( $results, $element );
			}
			if (count ( $results ) == 0) {
				return - 1;
			}
			return $results [0] ['credits'];
		}
	}
	return - 1;
}
/**
 * Add Answer in Database
 * @param int $UID
 * @param int $QID
 * @param string $Content
 * @return success, return 1, else -1
 */
function AddAnswer($UID, $QID, $Content) {
	$db = new database ();
	$db->connect ();
	
	$query = "INSERT INTO `Answers`( `QID`, `UID`, `Anonymity`, `Content`, `Time`, `Up_Vote`, `Down_Vote`, `comment`) 
	VALUES ( ? , ? , 0 , ? , ? ,0,0, \"\")";
	$Content_proceed = nl2br ( htmlentities ( $Content ) );
	
	date_default_timezone_set ( 'UTC' );
	
	$time = date ( "Y-m-d H:i:s" );
	
	// echo "$time";
	if ($stmt = $db->prepare ( $query )) {
		$stmt->bind_param ( "iiss", $QID, $UID, $Content_proceed, $time );
		
		if ($stmt->execute ()) {
			$stmt->store_result ();
			$result = $stmt->affected_rows;
			
			AddCreadits ( $UID );
			
			return $result;
		}
	}
	return - 1;
}

/**
 * Convert GRP from number to string
 * @param GRP number
 * @return GRP name in string
 */
function GetGRPName($GRP){
	if ($GRP < 1) {
		return "Guest";
	}
	if ($GRP == 1) {
		return "Registed";
	}
	if ($GRP == 2) {
		return "Trusted";
	}
	if ($GRP == 3) {
		return "Writer";
	}
	if ($GRP == 4) {
		return "VIP";
	}
	if ($GRP >= 5) {
		return "Admin";
	}
}

function Delete_Answer($AID){

	$db = new database ();
	$db->connect ();
	
	$query = "DELETE FROM `Answers` WHERE `AID` =  ? ";
	
	
	if ($stmt = $db->prepare ( $query )) {
		$stmt->bind_param ( "i", $AID);
		
		if ($stmt->execute ()) {
			$stmt->store_result ();
			$result = $stmt->affected_rows;
			
			return $result;
		}
	}
	
	return - 1;
}

function Delete_Answers_By_QID($QID){

	$db = new database ();
	$db->connect ();
	
	$query = "DELETE FROM `Answers` WHERE `QID` =  ? ";
	
	
	if ($stmt = $db->prepare ( $query )) {
		$stmt->bind_param ( "i", $QID);
		
		if ($stmt->execute ()) {
			$stmt->store_result ();
			$result = $stmt->affected_rows;
			
			return $result;
		}
	}
	
	return - 1;
}
function Delete_UP($AID){
	
	$db = new database ();
	$db->connect ();
	
	$query = "DELETE FROM `UP_Table` WHERE `AID` =  ? ";
	
	
	if ($stmt = $db->prepare ( $query )) {
		$stmt->bind_param ( "i", $AID);
		
		if ($stmt->execute ()) {
			$stmt->store_result ();
			$result = $stmt->affected_rows;
			
			return $result;
		}
	}
	
	return - 1;
}
function Delete_Down($AID){
	
	$db = new database ();
	$db->connect ();
	
	$query = "DELETE FROM `DOWN_Table` WHERE `AID` =  ? ";
	
	
	if ($stmt = $db->prepare ( $query )) {
		$stmt->bind_param ( "i", $AID);
		
		if ($stmt->execute ()) {
			$stmt->store_result ();
			$result = $stmt->affected_rows;
			
			return $result;
		}
	}
	
	return - 1;
}

function Delete_Article($ArtID){

	$db = new database ();
	$db->connect ();
	
	$query = "DELETE FROM `Article` WHERE `ArtID` =  ? ";
	
	
	if ($stmt = $db->prepare ( $query )) {
		$stmt->bind_param ( "i", $ArtID);
		
		if ($stmt->execute ()) {
			$stmt->store_result ();
			$result = $stmt->affected_rows;
			
			return $result;
		}
	}
	
	return - 1;
}

function Delete_Question($QID){


	$db = new database ();
	$db->connect ();
	
	$query = "DELETE FROM `Questions` WHERE `QID` =  ? ";
	
	
	if ($stmt = $db->prepare ( $query )) {
		$stmt->bind_param ( "i", $QID);
		
		if ($stmt->execute ()) {
			$stmt->store_result ();
			$result = $stmt->affected_rows;
			
			return $result;
		}
	}
	
	return - 1;
}

function GetQuestion_Answer($Qid) {
	$db = new database ();
	$db->connect ();
	
	$query = "SELECT `Answers`.`Content`, `Time`, `Name` , `Answers`.`AID`
	FROM `Answers`, `User` 
	where `User`.`UID` = `Answers`.`UID`
	and `QID` = ?";
	
	if ($stmt = $db->prepare ( $query )) {
		$stmt->bind_param ( "i", $Qid );
		if ($stmt->execute ()) {
			$results = array ();
			$result = $stmt->get_result ();
			
			foreach ( $result as $keys => $values ) {
				$element;
				foreach ( $values as $key => $value ) {
					$element [$key] = $value;
				}
				array_push ( $results, $element );
			}
			return $results;
		}
	}
	return - 1;
}
function GetQuestion_ByID($QID) {
	$db = new database ();
	$db->connect ();
	$query = "SELECT `Questions`.`Content`, `Title`, `Name`, `Time`
	FROM `Questions`, `User` 
	where `User`.`UID` = `Questions`.`UID`
	and `QID` = ?";
	
	if ($stmt = $db->prepare ( $query )) {
		$stmt->bind_param ( "i", $QID );
		
		if ($stmt->execute ()) {
			
			$result = $stmt->get_result ();
			
			$results = array ();
			foreach ( $result as $keys => $values ) {
				$element;
				foreach ( $values as $key => $value ) {
					$element [$key] = $value;
				}
				array_push ( $results, $element );
			}
			return $results;
		}
	}
	return - 1;
}

/*
 * return 1 when success, otherwise failed
 */
function UpdateProfile($newly) {
	$db = new database ();
	$db->connect ();

	$query = "UPDATE `Profiles` 
	SET
	`Habit`= ? ,
	`Location`= ? ,
	`BOD`= ?  
	WHERE `PID` =?";
	
	if ($stmt = $db->prepare ( $query )) {
		$stmt->bind_param ( "sssi", htmlspecialchars ( $newly ['Habit'] ), htmlspecialchars ( $newly ['Location'] ), htmlspecialchars ( $newly ['BOD'] ), $newly ['PID'] );
		
		if ($stmt->execute ()) {
			$stmt->store_result ();
			$result = $stmt->affected_rows;
			
			return $result;
		}
	}
	
	return - 1;
}
function CheckProfileExist($UID) {
	$db = new database ();
	$db->connect ();
	
	$query = "SELECT * from `Profiles` where `UID` = ?";
	
	if ($stmt = $db->prepare ( $query )) {
		$stmt->bind_param ( "i", $UID );
		
		if ($stmt->execute ()) {
			
			// $stmt->store_result();
			$result = $stmt->affected_rows;
			echo "ha<br/>";
			echo $result;
			return $results;
		}
	}
	return false;
}
function InsertProfile($newly) {
	$db = new database ();
	$db->connect ();
	$query = "INSERT INTO `Profiles`(`UID`, `Habit`, `Location`, `BOD`)
	VALUES (? , ? , ? , ? )";

	if ($stmt = $db->prepare ( $query )) {
		$stmt->bind_param ( "isss", $newly ['UID'], htmlspecialchars ( $newly ['Habit'] ), htmlspecialchars ( $newly ['Location'] ), htmlspecialchars ( $newly ['BOD'] ) );
		
		if ($stmt->execute ()) {
			
			$result = $stmt->insert_id;
			return $results;
		}
	}
}
function GetArticlesByUID($UID) {
	$db = new database ();
	$db->connect ();
	$query = "SELECT `Title`, `Content`, `Time`, `Up_Vote`, `Down_Vote`,`Name` ,`ArtID`
	FROM `Article`, `User` WHERE `User`.`UID` = `Article`.`UID` and `User`.`UID` = ? ";
	
	if ($stmt = $db->prepare ( $query )) {
		$stmt->bind_param ( "i", $UID );
		
		if ($stmt->execute ()) {
			
			$result = $stmt->get_result ();
			
			$results = array ();
			foreach ( $result as $keys => $values ) {
				$element;
				foreach ( $values as $key => $value ) {
					$element [$key] = $value;
				}
				array_push ( $results, $element );
			}
			return $results;
		}
	}
	return - 1;
}
function GetArticle($Artid) {
	$db = new database ();
	$db->connect ();
	$query = "SELECT `Title`, `Content`, `Time`, `Up_Vote`, `Down_Vote`,`Name`,`User`.`UID`
	FROM `Article`, `User` WHERE `User`.`UID` = `Article`.`UID` and `ArtID` = ? ";
	
	if ($stmt = $db->prepare ( $query )) {
		$stmt->bind_param ( "i", $Artid );
		
		if ($stmt->execute ()) {
			
			$result = $stmt->get_result ();
			
			$results = array ();
			foreach ( $result as $keys => $values ) {
				$element;
				foreach ( $values as $key => $value ) {
					$element [$key] = $value;
				}
				array_push ( $results, $element );
			}
			return $results;
		}
	}
	return - 1;
}
function GetUpCount($AID) {
	$db = new database ();
	$db->connect ();
	$query = "SELECT count(*) as Count from `UP_Table` 
	where `AID` = ?";
	
	if ($stmt = $db->prepare ( $query )) {
		$stmt->bind_param ( "i", $AID );
		
		if ($stmt->execute ()) {
			$result = $stmt->get_result ();
			// return $result;
			
			$results = array ();
			foreach ( $result as $keys => $values ) {
				$element;
				foreach ( $values as $key => $value ) {
					$element [$key] = $value;
				}
				array_push ( $results, $element );
			}
			return $results[0]['Count'];
		}
	}
	return - 1;
}
function VoteUp($AID, $UID) {
	
	$db = new database ();
	$db->connect ();
	$query = "INSERT INTO `UP_Table`(`AID`, `UID`) 
	VALUES ( ? , ? )";
	
	if ($stmt = $db->prepare ( $query )) {
		$stmt->bind_param ( "ii", $AID, $UID );
		
		if ($stmt->execute ()) {
			$result = $stmt->store_result ();
			return $result;
		}
	}
	return - 1;
}
function WithdrawVoteUp($AID, $UID) {
	$db = new database ();
	$db->connect ();
	$query = "DELETE FROM `UP_Table` 
	WHERE `AID`= ? and `UID`= ?";
	
	if ($stmt = $db->prepare ( $query )) {
		$stmt->bind_param ( "ii", $AID, $UID );
		
		if ($stmt->execute ()) {
			
			$result = $stmt->store_result ();
			return $result;
		}
	}
	return - 1;
}
function VoteDown($AID, $UID) {
	
	$db = new database ();
	$db->connect ();
	$query = "INSERT INTO `DOWN_Table`(`AID`, `UID`) 
	VALUES ( ? , ? )";
	
	if ($stmt = $db->prepare ( $query )) {
		$stmt->bind_param ( "ii", $AID, $UID );
		
		if ($stmt->execute ()) {
			
			$result = $stmt->store_result ();
			return $result;
		}
	}
	return - 1;
}
function GetDownCount($AID) {
	$db = new database ();
	$db->connect ();
	$query = "SELECT count(*) as Count from `DOWN_Table` 
	where `AID` = ?";
	
	if ($stmt = $db->prepare ( $query )) {
		$stmt->bind_param ( "i", $AID );
		
		if ($stmt->execute ()) {
			$result = $stmt->get_result ();
			$results = array ();
			foreach ( $result as $keys => $values ) {
				$element;
				foreach ( $values as $key => $value ) {
					$element [$key] = $value;
				}
				array_push ( $results, $element );
			}
			return $results[0]['Count'];
		}
	}
	return - 1;
}
function WithdrawVoteDown($AID, $UID) {
	$db = new database ();
	$db->connect ();
	$query = "DELETE FROM `DOWN_Table` 
	WHERE `AID`= ? and `UID`= ?";
	
	if ($stmt = $db->prepare ( $query )) {
		$stmt->bind_param ( "ii", $AID, $UID );
		
		if ($stmt->execute ()) {
			
			$result = $stmt->store_result ();
			return $result;
		}
	}
	return - 1;
}

// get questions by user ID
function GetQuestionsByUID($UID, $LIMITION) {
	$LIMITION = 10;
	$db = new database ();
	$db->connect ();
	$query = "SELECT `Questions`.`Content`, `Title`, `Name`, `Time`, `QID`
	FROM `Questions`, `User` 
	where `User`.`UID` = `Questions`.`UID`
	and `User`.`UID` = ?
	limit $LIMITION";
	
	if ($stmt = $db->prepare ( $query )) {
		$stmt->bind_param ( "i", $UID );
		
		if ($stmt->execute ()) {
			
			$result = $stmt->get_result ();
			
			$results = array ();
			foreach ( $result as $keys => $values ) {
				$element;
				foreach ( $values as $key => $value ) {
					$element [$key] = $value;
				}
				array_push ( $results, $element );
			}
			return $results;
		}
	}
	return - 1;
}
function GetQuestion() {
	$LIMITION = 10;
	$db = new database ();
	$db->connect ();
	// static SQL, no need to bind
	$query = "select * from Questions
	order by TIME
	limit $LIMITION
	";
	if (! $res = $db->send_sql ( $query )) {
		$db->disconnect ();
		echo "Get Questions failed!<br/>\n";
		return - 1;
	}
	
	$num = mysqli_num_rows ( $res );
	
	for($cur; $cur < $num; $cur ++) {
		$temres = $db->next_row ();
		foreach ( $temres as $key => $var ) {
			$res [$cur] [$key] = $var;
		}
	}
	
	return $res;
}
?>