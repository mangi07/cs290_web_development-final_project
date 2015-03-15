<?php
session_start();

/*
AUTHOR:	Benjamin R. Olson
DATE:	March 8, 2015
COURSE: CS 290 - Web Development, Oregon State University
*/

//connect to the database
include ("db.php");

$user_name;
$location;
$visible;
$json = array();
$array_counter = 0;
$stmt;
$curr_user;

if (isset($_SESSION["user"])){

	$curr_user = $_SESSION["user"];
	if(!($stmt = $mysqli->prepare(
		"SELECT username, locations, visible FROM users WHERE username != ? ORDER BY username LIMIT 50"
	))){
		echo "Failed to select users.";
	}
	if (!(
		$stmt->bind_param("s", $curr_user) &&
		$stmt->execute() &&
		$stmt->bind_result($user_name, $location, $visible)
	)) {
		echo "Failed to load users.";
		$stmt->close();
		$mysqli->close();
		die();
	}
	while ($stmt->fetch()) {
		//get all visible data into json string
		$location = json_decode($location);
		$json[$array_counter] = [$user_name, $location, $visible];
		$array_counter++;
	}
	$json = json_encode($json, JSON_FORCE_OBJECT);
	
	$stmt->close();
	$mysqli->close();
	
	
	echo $json;
	
}


?>


