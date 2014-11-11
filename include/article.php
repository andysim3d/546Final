<?php
include ("DB.php");
$res = GetQuestion();

foreach ($res as $key => $var){
	echo "$var :";
	foreach ($var as $subKey => $subVar){
		echo "$subKey => $subVar<br/>\n";
	}
	echo "<hr/>";
}
?>