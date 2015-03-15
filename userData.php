<?php
session_start();

/*
AUTHOR:	Benjamin R. Olson
DATE:	March 8, 2015
COURSE: CS 290 - Web Development, Oregon State University
*/



//connect to the database
include ("db.php");

$user;
$json = "test";
$stmt;

//handle input errors
if (isset($_SESSION["user"])){
	
	$user = $_SESSION["user"];
	
	if(!($stmt = $mysqli->prepare(
		"SELECT locations FROM users WHERE username = ?"
	))){
		echo "fail";
	}
	
	if (!(
		$stmt->bind_param("s", $user) &&
		$stmt->execute() &&
		$stmt->bind_result($json) &&
		$stmt->fetch()
	)) {
		echo "fail";
		$stmt->close();
		$mysqli->close();
		die();
	}
	
	
	$stmt->close();
	$mysqli->close();
	
	
	echo $json;
	
}


?>


