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
$visible;
$stmt;

//handle input errors
if (isset($_SESSION["user"])){
	
	$user = $_SESSION["user"];
	
	if (isset($_POST["visible"]) && isset($_SESSION["visible"])){
		$visible = $_POST["visible"];
	} else {
		echo "Failed to get necessary information from the user.";
		die();
	}
	
	if(!($stmt = $mysqli->prepare(
		"UPDATE users SET visible = ? WHERE username = ?"
	))){
		echo "Failed to prepare update.";
		die();
	}
	
	if (!(
		$stmt->bind_param("ss", $visible, $user) &&
		$stmt->execute()
	)) {
		echo "Failed to execute the requested update.";
		$stmt->close();
		$mysqli->close();
		die();
	} else {
		$_SESSION["visible"] = $visible;
	}
	
	
	$stmt->close();
	$mysqli->close();
	
	
}


?>


