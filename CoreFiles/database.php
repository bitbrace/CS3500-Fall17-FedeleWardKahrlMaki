<?php
	require_once "etc.php";
	
	$dbusername="root";
	$dbpassword="";
	$dbaddr="localhost";
	$dbdbname="cs3500FinalProj";
	$dbconnstr="mysql:host=".$dbaddr.";dbname=".$dbdbname.";";
	
	function initdb(){
		global $dbconnstr,$dbusername,$dbpassword;
		try{
			$database=new PDO($dbconnstr,$dbusername,$dbpassword);
		}catch(Exception $e){
			errpage("Couldn't connect to database");
		}
		return $database;
	}
	
