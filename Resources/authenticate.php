<?php
	
	require_once "etc.php";
	require_once "database.php";
	
	//Returns the user ID corresponding to the given session ID
	function recall($sid){
		$uid=false;
		if($sid===false){
			return $uid;
		}
		global $database;
		try{
			$statement=$database->prepare("
			SELECT DISTINCT(uid) AS uid
			FROM sessionMapping
			WHERE sid = :sid AND NOT expires < UNIX_TIMESTAMP();");
			$statement->bindParam(":sid",$sid,PDO::PARAM_INT);
			$statement->execute();
			
			$uid=$statement->fetch(PDO::FETCH_ASSOC);
			if($uid!==false){
				$uid=$uid["uid"];
			}
		}catch(Throwable $e){
			rolldie();
		}
		return $uid;
	}
	
	//Returns a new session ID and the expiry time given a user ID which should expire after 'duration' seconds
	//(The expiry time is needed for synchronization)
	function createSession($uid,$duration=600,$atom=true){
		$duration+=time();
		if($uid===false){
			return [false,$duration];
		}
		global $database;
		try{
			$temp=true;
			for($sid=random_int(0,2147483647);	//Gets a random number that'll fit in a MariaDB BIGINT
			false!==($temp=recall($sid));		//
			$sid=random_int(0,2147483647));		//
			
			if($atom
			&&!$database->beginTransaction()) throw new Exception("An unexpected error occured.",0);
			
			$statement=$database->prepare("
			INSERT INTO sessionMapping(sid, uid, expires)
			VALUES (:sid, :uid, :exp);");
			$statement->bindParam(":sid",$sid,	PDO::PARAM_INT);
			$statement->bindParam(":uid",$uid,	PDO::PARAM_INT);
			$statement->bindParam(":exp",$duration,	PDO::PARAM_INT);
			$statement->execute();
			
			if($atom
			&&!$database->commit()) throw new Exception("An unexpected error occured.",0);
		}catch(Throwable $e){
			rolldie();
		}
		return [$sid,$duration];
	}
	
	//Deletes a session with the given ID
	function deleteSession($sid,$atom=true){
		$success=false;
		if($sid===false){
			return $success;
		}
		global $database;
		try{
			if($atom
			&&!$database->beginTransaction()) throw new Exception("An unexpected error occured.",0);
			
			$statement=$database->prepare("
			DELETE FROM sessionMapping
			WHERE sid = :sid;
			");
			$statement->bindParam(":sid",$sid,PDO::PARAM_INT);
			$statement->execute();
			
			if($atom
			&&!$database->commit()) throw new Exception("An unexpected error occured.",0);
			
			$success=true;
		}catch(Throwable $e){
			rolldie();
		}
		return $success;
	}
	
	//Removes all session ID's from the database that have expired
	function cleanSessions($atom=true){
		global $database;
		$retval=false;
		try{
			if($atom
			&&!$database->beginTransaction()) throw new Exception("An unexpected error occured.",0);
			
			$statement=$database->exec("
			DELETE FROM sessionMapping
			WHERE expires < UNIX_TIMESTAMP();
			");
			
			if($atom
			&&!$database->commit()) throw new Exception("An unexpected error occured.",0);
			
			$retval=true;
		}catch(Throwable $e){
			rolldie();
		}
		return $retval;
	}
	
	//Returns the user ID with the given credentials
	function authenticate($username,$password){
		global $database;
		$uid=false;
		try{
			$database=initdb();
			$statement=$database->prepare("
			SELECT DISTINCT(uid)
			FROM user
			WHERE username = :uname AND password = SHA2(MD5(CONCAT(:passwd, salt)), 512);");
			$statement->bindParam(":uname",	$username,PDO::PARAM_STR);
			$statement->bindParam(":passwd",$password,PDO::PARAM_STR);
			$statement->execute();
			
			$uid=$statement->fetch(PDO::FETCH_ASSOC);
			if($uid!==false){
				$uid=$uid["uid"];
			}
		}catch(Throwable $e){
			rolldie();
		}
		return $uid;
	}
	
	//Takes a session ID and renew the expiration time to 'duration' seconds from now (assuming it hasn't expired already)
	function updateSession($sid,$duration=600,$atom=true){
		$duration+=time();
		if($sid===false){
			return [false,$duration];
		}
		global $database;
		try{
			if($atom
			&&!$database->beginTransaction()) throw new Exception("An unexpected error occured.",0);
			
			$statement=$database->prepare("
			UPDATE sessionMapping
			SET expires = :exp
			WHERE sid = :sid AND NOT expires < UNIX_TIMESTAMP();");
			$statement->bindParam(":exp",$duration,	PDO::PARAM_INT);
			$statement->bindParam(":sid",$sid,	PDO::PARAM_INT);
			$statement->execute();
			
			if($atom
			&&!$database->commit()) throw new Exception("An unexpected error occured.",0);
		}catch(Throwable $e){
			rolldie();
		}
		return [$sid,$duration];
	}
	
