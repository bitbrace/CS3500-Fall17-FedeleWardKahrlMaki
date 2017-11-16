<?php

// Create a connection to the database
$user='root';
$pass='';
$db='cs3500finalproj';
$host='localhost';

$dbConn= "mysql:host=$host;dbname=$db;";

try {
	$pdo = new PDO($dbConn, $user, $pass);	
} 
catch (PDOException $e){
	$errorMgs = $e->getMessage();
	echo("Failed to connect to database, " . $errorMgs);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ticket Modifier</title>
</head>
<body>

	<div class="container-fluid">

	<header><h1>This is a temp header</h1></header>
	<!--Include header here-->

	<?php
		if (isset($_GET['uid']) AND isset($_GET['tid'])){
			// The user wants to modify a ticket(s),
			// print out info for the ticket(s).

			$stmt = $pdo->prepare("SELECT T.tid, U.username, S.stateName, P.probName, T.userDesc FROM ticket T JOIN user U on T.uid = U.uid JOIN statemapping S ON T.tstate = S.tstate JOIN problemmapping P ON T.ptype = P.pid WHERE T.tid in (" . implode(', ',$_GET['tid']) . ") AND T.uid = :user");

			//$str = implode(', ',$_GET['tid']);

			//$stmt->bindParam(':ticket', $str, PDO::PARAM_INT);
			$stmt->bindParam(':user', $_GET['uid'], PDO::PARAM_STR);

			$stmt->execute();

			while($row = $stmt->fetch()){
				echo("
					<form action='Dashboard.php' method='GET'>
					<fieldset>
					<legend>Modify ticket #{$row[0]}</legend>
					User: {$row[1]}<br>
					Status: {$row[2]}<br>
					<label for='prob'>Problem</label>
					<select name='ptype' id='prob'>
				");

				$probs = $pdo->query("SELECT * FROM problemmapping");
				while($pRows = $probs->fetch()){
					echo("<option value={$pRows[0]}>{$pRows[1]}</option>");
				}

				echo("
					</select><br>
					<label for='desc'>Further Decription</label>
					<input type='text' name='userDesc' id='desc' value='". $row[4] ."'><br>
					<input type='Submit' name='sub' value='Update Ticket'>
					</fieldset>
				");
			}

		}else{
			// The user wants to create a new ticket
			
			echo("
				<form action='Suggestions.php' method='GET'>
				<fieldset>
				<legend>Create a new ticket:</legend>
				<label for='prob'>Problem</label>
				<select name='ptype' id='prob'>
				");

		  	$stmt = $pdo->query("SELECT * FROM problemmapping");
			while($row = $stmt->fetch()){
				echo("<option value={$row[0]}>{$row[1]}</option>");
			}

			echo('
				</select><br>
				<label for="desc">Further Decription</label>
				<input type="text" name="userDesc" id="desc"><br>
				<input type="Submit" name="sub" value="Create Ticket">
				</fieldset>
				</form>
				');
		}

		//trash the db connection
		$pdo=null;
	?>

	<button onclick="Dashboard.php">Back to Dashboard</button>

	<header><h1>This is a temp footer</h1></header>
	<!--Include footer here-->

	<!--End of the container-->
	</div>

</body>
</html>
