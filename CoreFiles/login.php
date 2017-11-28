<?php
	
	require_once "../Resources/etc.php";
	require_once "../Resources/authenticate.php";
	
	startup();
	
	$notice="";
	
	if(isset($_SERVER["HTTPS"])){
		$sid=true;
		if(isset($_COOKIE["sessionID"])){
			list($sid,$exp)=updateSession($_COOKIE["sessionID"]);
		}
		
		if(($sid===true||$sid===false)
		&&isset($_POST["username"])
		&&isset($_POST["password"])){
			list($sid,$exp)=createSession(authenticate($_POST["username"],$_POST["password"]),600);
		}
		
		if($sid===false){
			$notice.="<p>Error: couldn't validate credentials.</p>";
		}else if($sid!==true){
			setcookie("sessionID",$sid,$exp,"/",$domainName,true,true);
			//Information on redirection taken from: https://stackoverflow.com/a/768472
			header("Location: dashboard.php",true,303);//303 is the HTTP redirection code
//			header("Location: dumpvars.php",true,303);//303 is the HTTP redirection code
//			$notice.="<p><a href='dumpvars.php'>dumpvars.php</a></p>";
			exit(0);
		}
	}else{
		$notice="<p>You cannot login with an insecure connection.</p>";
	}
	
?>

<!DOCTYPE html>
<html>
	<head>
	<!--IMPORTANT PAGE STUFF GOES HERE-->
	</head>
	<body>
		<?php include "header.php";//INCLUDE HEADER ?>
		<form class='center middle' action='login.php' method='POST'>
			<fieldset>
				<img class='middle' src='FIXME'/>
				<p>Username:</p>
				<input type='text' name='username' value=''>
				<p>Password:</p>
				<input type='text' name='password' value=''>
				<input type='submit' value='Log In'>
				<?php echo $notice;?>
			<fieldset>
		</form>
		<?php include "footer.php";//INCLUDE FOOTER ?>
	</body>
</html>

<?php
