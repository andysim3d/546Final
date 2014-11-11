<?php

	include ("./DB.php");
	
	

	if(isset($_POST["email"]) && isset($_POST["Name"]) && isset($_POST["password"])){
		$Email = $_POST["email"];
		$Name = $_POST["Name"];
		$Password = $_POST["password"];
		$res = regist($Email, $Name, $Password);
		if( $res == -1) {

			echo "Register fail!<br/>\n";
		}
		else{

			echo "Register Success! Your ID is $res<br/>\n";
		}
	}
	else{
		echo "Register fail!<br/>\n";
	}
	
	
?>