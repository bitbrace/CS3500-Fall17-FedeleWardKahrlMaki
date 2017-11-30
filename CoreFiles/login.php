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
		$notice="<p>You cannot log in with an insecure connection.</p>";
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Login | Graet Help</title>
		<link href="../Resources/bootstrap-3.3.7/dist/css/bootstrap.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../Resources/auxStyling.css">
	</head>
	<body>
		<?php include "includes/header.inc.php";//INCLUDE HEADER ?>
		<div class="container">
			<div class="panel">
				<form action='login.php' method='POST'> <!-- class='center middle'  -->
					<fieldset>
						<!-- <img class='middle' src='FIXME'/> -->
						<p>Username:</p>
						<input type='text' name='username' value=''>
						<p>Password:</p>
						<input type='password' name='password' value=''>
						<input type='submit' value='Log In'>
						<?php echo $notice;?>
					<fieldset>
				</form>
			</div>
		</div>

		<?php include "includes/footer.inc.php";//INCLUDE FOOTER ?>
	</body>
</html>

<?php
