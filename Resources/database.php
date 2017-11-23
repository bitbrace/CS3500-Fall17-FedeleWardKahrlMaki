<?php
	require_once "etc.php";
	
	$dbusername="root";
	$dbpassword="";
	$dbaddr="localhost";
	$dbdbname="cs3500FinalProj";
	$dbconnstr="mysql:host=".$dbaddr.";dbname=".$dbdbname.";";
	$database=null;
	
	function initdb(){
		global $database,$dbconnstr,$dbusername,$dbpassword;
		try{
			$database=new PDO($dbconnstr,$dbusername,$dbpassword);
		}catch(Throwable $e){
			errpage("Couldn't connect to database");
		}
		return $database;
	}
	
	function rolldie($msg){
		global $database;
		try{
			if(!$database->rollback()) throw new Exception("",0);
		}catch(Throwable $e){
		}
		errpage($msg);
		return;
	}
	
