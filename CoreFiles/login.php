<?php
	
	require_once "etc.php";
	require_once "database.php";
	require_once "authenticate.php";
	
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
