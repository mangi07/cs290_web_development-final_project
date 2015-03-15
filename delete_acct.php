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
$stmt;
$curr_user;

if (isset($_SESSION["user"])){

	$curr_user = $_SESSION["user"];
	if(!($stmt = $mysqli->prepare(
		"DELETE FROM users WHERE username = ?"
	))){
		echo "<p class='box'>Failed to prepare for executing delete operation.<p>";
		echo "<a href='main.php' class='button'>Back To Main Page</a>";
	}
	if (!(
		$stmt->bind_param("s", $curr_user) &&
		$stmt->execute()
	)) {
		echo "<p class='box'>Failed to execute the delete operation.<p>";
		echo "<a href='main.php' class='button'>Back To Main Page</a>";
		
		$stmt->close();
		$mysqli->close();
		die();
	}
	$stmt->close();
	$mysqli->close();
	
	include ("logout.php");
}


?>
