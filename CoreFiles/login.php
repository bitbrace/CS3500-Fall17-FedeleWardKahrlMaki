<?php
	require_once "etc.php";
	require_once "database.php";
	
	$failed="";
	
	if(isset($_POST["username"])
	&&isset($_POST["password"])){
		
		try{
			$database=initdb();
			$statement=$database->prepare("
			SELECT DISTINCT(uid)
			FROM user
			WHERE username = :u AND password = :p");
			$statement->bindParam(":u",$_POST["username"],PDO::PARAM_STR);
			$statement->bindParam(":p",$_POST["password"],PDO::PARAM_STR);
			$statement->execute();
			$uid=$statement->fetch();
		}catch(Exception $e){
			errdie();
		}
		
		if($uid){
			//Information on redirection taken from: https://stackoverflow.com/a/768472
			$redir="dashboard.php?uid=".$uid;//Can't use __DIR__ since it gives the full pathname (which shouldn't be revealed and doesn't work with the server's hierarchy)
			header("Location: ".$redir,true,303);
			exit(0);
		}else{
			$failed.="<p>Error: couldn't validate credentials.</p>";
		}
	}
	
	echo	"<!DOCTYPE html>
		<html>
			<head>";
	//IMPORTANT PAGE STUFF GOES HERE
	echo		"</head>
			<body>";
	echo			"<header><h1>INCLUDE HEADER HERE</h1></header>";
	echo			"<form class='center middle' action='login.php' method='POST'>
					<fieldset>
						<img class='middle' src='FIXME'/>
						<p>Username:</p>
						<input type='text' name='username' value=''>
						<p>Password:</p>
						<input type='text' name='password' value=''>
						<input type='submit' value='Log In'>
						$failed
					<fieldset>
				</form>";
	echo			"<footer><h1>INCLUDE FOOTER HERE</h1></footer>";
	echo		"</body>
		</html>";
	
