<?php
	
	require_once "database.php";
	require_once "authenticate.php";
	
	$cleanchance=1;//The chance that the server will clean up expired cookies in the database
	$domainName=(isset($_SERVER["HTTP_HOST"])?$_SERVER["HTTP_HOST"]:$_SERVER["SERVER_NAME"]);
	
	function errpage($err="Unknown error"){
		echo "<!DOCTYPE html><html lang='en'><body><p>Error: ".$err."</p></body></html>";
		exit(1);
		return;
	}
	
/*	//TODO:TESTME
	function establishCache(){
		static $cache=array();
		
		function cache($blob){
			$retval=count($cache);
			$cache[]=$blob;
			return $retval;
		}
		
		function fetch($index){
			return $cache[$index];
		}
		return;
	}*/
	
	function startup(){
		global $cleanchance;
		initdb();
		if(!random_Int(0,$cleanchance-1)){	//If we get a 0 by chance
			cleanSessions();		//Do some cleaning
		}					//
//		establishCache();
		return;
	}
	
