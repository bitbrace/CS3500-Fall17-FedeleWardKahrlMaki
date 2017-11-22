<?php
	require_once "etc.php";
	require_once "database.php";
	
	$failed="";
	
	function authenticate($username,$password){
		try{
			$database=initdb();
			$statement=$database->prepare("
			SELECT DISTINCT(uid)
			FROM user
			WHERE username = :u AND password = :p");
			/*
			SELECT DISTINCT(uid)
			FROM user
			WHERE username = :u AND password = UNHEX(SHA2(MD5(CONCAT(:p, salt)),512));
			*/
			$statement->bindParam(":u",$username,PDO::PARAM_STR);
			$statement->bindParam(":p",$password,PDO::PARAM_STR);
			$statement->execute();
			$uid=$statement->fetch();
		}catch(Exception $e){
			errpage();
		}
		
		if($uid){
			//Information on redirection taken from: https://stackoverflow.com/a/768472
			$redir="dashboard.php?uid=".$uid;//Can't use __DIR__ since it gives the full pathname (which shouldn't be revealed and doesn't work with the server's hierarchy)
			header("Location: ".$redir,true,303);
			exit(0);
		}else{
			$failed.="<p>Error: couldn't validate credentials.</p>";
		}
	return;
	}
	
