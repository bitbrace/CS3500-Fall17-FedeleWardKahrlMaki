<?php

// Connect to the database, referrence object is named '$database'
include "../Resources/database.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>User Dashboard</title>
	<link href="../Resources/bootstrap-3.3.7/dist/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../Resources/auxStyling.css">

	<!--Used to fade update bannder-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="../Resources/validateTicketForms.js"></script>
</head>
<body>

	<?php include "header.php"; ?>

	<div class="container">
		<div class="panel panel-danger spaceabove">
			<div class="panel-heading"><h4>My Tickets</h4></div>
			<table class="table">
				<tr>
					<th>Status</th>
					<th>Description</th>
					<th>Type</th>
					<th>Edit</th>
				</tr>
				<!-- database pull -->
				<?php

					// Connect to the database, referrence object is named '$database'
					initdb();

					if (isset($_GET['uid'])) {
						// The user wants to see their list of tickets

						$userExists = $database->query("SELECT * FROM user WHERE uid = " . $_GET['uid']);
						$tix = $database->query("SELECT * FROM ticket WHERE uid = " . $_GET['uid'] . " ORDER BY tstate");

						// build an array for status mapping so we don't need a db query for each row of the table
						$statMap = $database->query("SELECT * FROM stateMapping");
						while ($row = $statMap->fetch()) {
							$states[$row['tstate']] = $row['stateName'];
						}

						// do the same for problems
						$probMap = $database->query("SELECT * FROM problemMapping");
						while ($row = $probMap->fetch()) {
							$problems[$row['pid']] = $row['probName'];
						}

						if ($userExists->fetch()) {
							while($row = $tix->fetch()) {
								echo("
									<tr>
										<td>" . $states[$row['tstate']] . "</td>
										<td>" . $row['userDesc'] . "</td>
										<td><em>" . $problems[$row['ptype']] . "</em></td>
										<td><a href='TicketModifier.php?uid=" . $_GET['uid'] . "&tid[]=" . $row['tid'] . "'><img src='../Resources/images/ic_mode_edit_black_24dp_1x.png' alt='edit' /></a></td>
									</tr>
								");
							}
						} else {
							echo("<tr><td colspan=\"4\" class='alert alert-danger'>Couldn't find that user.</td></tr>");
						}
					} else {
						echo("<tr><td colspan=\"4\" class='alert alert-danger'>Failed to get user info from server.</td></tr>");
					}

					// Back button includes uid for dashboard
					echo("<div class='well'><form action='TicketModifier.php' method='GET'>
					<input type='hidden' name='uid' value='". $_GET['uid'] ."'>
					<input type='Submit' name='sub' value='Start a New Ticket'></form></div>");

					//trash the db connection
					$database=null;
				?>
			</table>
		</div>
	</div>



	<!--End of the container-->
	</div>

	<?php include "footer.php";?>

</body>
</html>
