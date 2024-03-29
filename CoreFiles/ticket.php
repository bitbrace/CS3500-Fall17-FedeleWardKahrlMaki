<?php

// Connect to the database, referrence object is named '$database'
//include "../Resources/connectToDB.php";
include "../Resources/database.php";
$database = initdb();

// Get user system info mapping functions
include "../Resources/getUserSystemInfo.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ticket Modifier | Graet Help</title>
	<link href="../Resources/bootstrap-3.3.7/dist/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../Resources/auxStyling.css">

	<!--Used to fade update bannder-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="../Resources/validateTicketForms.js"></script>
</head>
<body>

	<?php include "includes/header.inc.php"; ?>

	<div class="container">

	<?php

		isset($_COOKIE['sessionID']) AND
		($uid = recall((int) $_COOKIE['sessionID']));
		
		// Submit tickets to the database and print results if any
		include "../Resources/submitTicketUpdate.php";

	if (isset($uid)){
		
		if (($uid !== false) AND isset($_POST['tid'])){
			// The user wants to modify a ticket(s),
			// print out info for the ticket(s).

			$stmt = $database->prepare("SELECT T.tid, U.username, S.stateName, P.probName, T.userDesc FROM ticket T JOIN user U on T.uid = U.uid JOIN stateMapping S ON T.tstate = S.tstate JOIN problemMapping P ON T.ptype = P.pid WHERE T.tid in (" . implode(', ',$_POST['tid']) . ") AND T.uid = :user");

			$stmt->bindParam(':user', $uid, PDO::PARAM_STR);
			$stmt->execute();

			while($row = $stmt->fetch()){
				echo("<div class='well'>
					<form action='' method='POST'>
					<fieldset>
					<legend>Modify ticket #{$row[0]}</legend>
					<label>User:</label> {$row[1]}<br>
					<label for='status'>Status</label>
					<select name='status' id='status'>
					");

				$states = $database->query("SELECT * FROM stateMapping");
				while($pRows = $states->fetch()){
					// Displays the current problem for the ticket
					if ($pRows[1] == $row[2]){
						echo("<option value='".$pRows[0]."' selected>{$pRows[1]}</option>");
					}else{
						echo("<option value='".$pRows[0]."'>{$pRows[1]}</option>");
					}
				}

				echo("
					</select><br>
					<label for='prob'>Problem</label>
					<select name='ptype' id='prob'>
				");

				$probs = $database->query("SELECT * FROM problemMapping");
				while($pRows = $probs->fetch()){
					// Displays the current problem for the ticket
					if ($pRows[1] == $row[3]){
						echo("<option value='".$pRows[0]."' selected>{$pRows[1]}</option>");
					}else{
						echo("<option value='".$pRows[0]."'>{$pRows[1]}</option>");
					}
				}

				echo("
					</select><br>

					<label>For system:&nbsp</label>". getOS() .", ". getBrowser() .", ". getIPAddr() ."<br>

					<label for='desc'>Further Decription (max 100 characters)</label>
					<span class='error' hidden></span>
					<br>
					<textarea rows='4' cols='50' maxlength='100' name='userDesc' id='desc' class='inline' required>". $row[4] ." </textarea>
					<br>

					<input type='hidden' name='uid' value='". $uid ."'>
					<input type='hidden' name='tid[]' value='". implode(', ',$_POST['tid']) ."'>

					<input type='hidden' name='subUpdate' value='". $row[0] ."'>

					<input type='Submit' value='Update Ticket'>
					</fieldset>
					</form>

					<form action='suggestions.php' method='POST'>
					<input type='hidden' name='uid' value='". $uid ."'>
					<input type='hidden' name='tid' value='".$row[0]."'>
					<input type='Submit' name='subView' value='View Suggestions'>
					</form>

					</div>
				");
			}

		}else if (($uid !== false)) {
			// The user wants to create a new ticket

			echo("<div class='well'>
				<form action='' method='POST'>
				<fieldset>
				<legend>Create a new ticket:</legend>
				<label for='prob'>Problem</label>
				<select name='ptype' id='prob'>
				");

		  	$stmt = $database->query("SELECT * FROM problemMapping");
			while($row = $stmt->fetch()){
				echo("<option value={$row[0]}>{$row[1]}</option>");
			}

			echo("
				</select><br>

				<label>For system:&nbsp</label>". getOS() .", ". getBrowser() .", ". getIPAddr() ."<br>

				<label for='desc'>Further Decription (max 100 characters)</label>
				<span class='error' hidden></span>
				<br>
				<textarea rows='4' cols='50' maxlength='100' name='userDesc' id='desc' required> </textarea>
				<br>
				<input type='hidden' name='uid' value='". $uid ."'>
				<input type='hidden' name='subCreate'>
				<input type='Submit' value='Create Ticket'>
				</fieldset>
				</form>
				</div>
				");
		}
	}else{
		echo("<div class='alert alert-danger'>Failed to get user or ticket info from server.</div>");
	}

		// Back button includes uid for dashboard
		echo("<div class='well'><form action='dashboard.php' method='POST'>
		<input type='Submit' name='sub' value='Return to Dashboard'></form></div>");

		//<input type='hidden' name='uid' value='". $uid ."'>
		
		//trash the db connection
		$database=null;
	?>

	<!--End of the container-->
	</div>

	<?php include "includes/footer.inc.php";?>

</body>
</html>
