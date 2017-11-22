<?php

// Create a connection to the database
$user='root';
$pass='';
$db='cs3500finalproj';
$host='localhost';

$dbConn= "mysql:host=$host;dbname=$db;";

// Output any errors
try {
	$database = new PDO($dbConn, $user, $pass);	
} 
catch (PDOException $e){
	$errorMgs = $e->getMessage();
	echo("Failed to connect to database, " . $errorMgs);
}

?>