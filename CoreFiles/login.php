<?php
	
	require_once "../Resources/etc.php";
	require_once "../Resources/authenticate.php";
	
	$failed="";
	
	$session=$_COOKIE["sessionID"];
	$username=$_POST["username"];
	$password=$_POST["password"];
	
	$sid=true;
	if(isset($_COOKIE["sessionID"])){
		list($sid,$exp)=updateSession($session);
	}else if(isset($username)
	&&isset($password)){
		list($sid,$exp)=createSession(authenticate($username,$password),600);
	}
	
	if($sid===false){
		$failed.="<p>Error: couldn't validate credentials.</p>";
	}else if($sid!==true){
		setcookie("sessionID",$sid,$exp,"/",$domainName,true,true);
		//Information on redirection taken from: https://stackoverflow.com/a/768472
//		header("Location: dashboard.php",true,303);//303 is the HTTP redirection code
		header("Location: dumpvars.php",true,303);//303 is the HTTP redirection code
		exit(0);
	}
	
?>

<!DOCTYPE html>
<html>
	<head>
	<!--IMPORTANT PAGE STUFF GOES HERE-->
	</head>
	<body>
		<?php include "header.php";//INCLUDE HEADER ?>
		<form class='center middle' action='authenticate.php' method='POST'>
			<fieldset>
				<img class='middle' src='FIXME'/>
				<p>Username:</p>
				<input type='text' name='username' value=''>
				<p>Password:</p>
				<input type='text' name='password' value=''>
				<input type='submit' value='Log In'>
				<?php echo $failed;?>
			<fieldset>
		</form>
		<?php include "footer.php";//INCLUDE FOOTER ?>
	</body>
</html>

<?php
