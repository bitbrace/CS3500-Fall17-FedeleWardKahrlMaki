<?php
	require_once "etc.php";
	require_once "database.php";
	
	//Returns the user ID corresponding to the given session ID
	function recall($sid){
		$uid=false;
		if($sid===false){
			return $uid;
		}
		try{
			$statement=$database->prepare("
			SELECT DISTINCT(uid) AS uid
			FROM sessionMapping
			WHERE sid = :sid AND NOT expires < UNIX_TIMESTAMP();");
			$statement->bindParam(":sid",$sid,PDO::PARAM_INT);
			$statement->execute();
			
			$uid=$statement->fetch(PDO::FETCH_ASSOC)
			if($uid!==false){
				$uid=$uid["uid"];
			}
		}catch(Throwable $e){
			errpage();
		}
		return $uid;
	}
	
	//Returns a new session ID and the expiry time given a user ID which should expire after 'duration' seconds
	//(The expiry time is needed for synchronization)
	function createSession($uid,$duration=600,$atom=true){
		$sid=false;
		if($uid===false){
			return [$sid,$duration];
		}
		$duration+=time();
		try{
			if($atom
			&&!$database->beingTransaction()) throw new Exception("An unexpected error occured.",0);
			
			$sid=true;
			while($sid!==false){
				$sid=recall(rand_int(0,2147483647));//Gets a random number that'll fit in a MariaDB BIGINT
			}
			
			$statement=$database->prepare("
			INSERT INTO sessionMapping(sid, uid, expires)
			VALUES (:sid, :uid, :exp);");
			$statement->bindParam(":sid",$uid,PDO::PARAM_INT);
			$statement->bindParam(":uid",$uid,PDO::PARAM_INT);
			$statement->bindParam(":exp",$duration,PDO::PARAM_INT);
			$sid=$databse->lastInsertId();
			
			if($atom
			&&!$database->commit()) throw new Exception("An unexpected error occured.",0);
		}catch(Throwable $e){
			if(!$database->rollback())/*BIG ERROR*/;
			errpage();
		}
		return [$sid,$duration];
	}
	
	function authenticate($username,$password){
		try{
			$database=initdb();
			$statement=$database->prepare("
			SELECT DISTINCT(uid)
			FROM user
			WHERE username = :uname AND password = SHA2(MD5(CONCAT(:passwd, salt)), 512);");
			$statement->bindParam(":uname",$username,PDO::PARAM_STR);
			$statement->bindParam(":passwd",$password,PDO::PARAM_STR);
			$statement->execute();
			
			$uid=$statement->fetch(PDO::FETCH_ASSOC)["uid"];
		}catch(Throwable $e){
			errpage();
		}
		return $uid;
	}
	
	//Takes a session ID and renew the expiration date to 'duration' seconds
	//Only does something if 'oldsid' is a real session
	function updateSession($oldsid,$duration=600){
		$newsid=[false,$duration];
		if($oldsid===false){
			return $newsid;
		}
		try{
			if($atom
			&&!$database->beingTransaction()) throw new Exception("An unexpected error occured.",0);
			
			$tempsid=[false,$duration];
			if(false!==($uid=recall($oldsid))){
				$tempsid=createSession($uid,time()+$duration,false);
				deleteSession($oldsid,false);
			}
			
			if($atom
			&&!$database->commit()) throw new Exception("An unexpected error occured.",0);
			
			$newsid=$tempsid;
		}catch(Throwable $e){
			if(!$database->rollback())/*BIG ERROR*/;
			errpage();
		}
	return;
	}
	
