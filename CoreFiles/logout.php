<?php
	
	require_once "../Resources/etc.php";
	require_once "../Resources/authenticate.php";
	
	startup();
	
	if(isset($_COOKIE["sessionID"])){
		deleteSession($_COOKIE["sessionID"]);
	}
	
	setcookie("sessionID","",1,"/",$domainName,true,true);
	header("Location: login.php",true,303);//303 is the HTTP redirection code
	
