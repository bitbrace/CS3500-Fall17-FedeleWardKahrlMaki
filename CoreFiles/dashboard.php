<?php

// Connect to the database, referrence object is named '$database'
require_once "../Resources/database.php";
require_once "../Resources/authenticate.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>User Dashboard | Graet Help</title>
	<link rel="stylesheet" type="text/css" href="../Resources/auxStyling.css">
	<link href="../Resources/bootstrap-3.3.7/dist/css/bootstrap.css" rel="stylesheet">

	<!--Used to fade update bannder-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="../Resources/validateTicketForms.js"></script>
</head>
<body>

	<?php include "includes/header.inc.php"; ?>

	<div class="container">
		<div class="panel">
			<div class="panel-heading"><h4>My Tickets</h4></div>

				<!-- database pull -->
				<?php
					// Connect to the database, referrence object is named '$database'
					initdb();

					if (isset($_COOKIE['sessionID'])
					&&($uid = recall((int) $_COOKIE['sessionID']))
					&&($uid !== false)) {
						// The user wants to see their list of tickets

						$userExists = $database->query("SELECT * FROM user WHERE uid = " . $uid);
						$tix = $database->query("SELECT * FROM ticket WHERE uid = " . $uid . " ORDER BY tstate");

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

							/*
							 * first form starts new tickets
							 * second form opens existing tickets for editing
							 */
							echo("
							<form action='ticket.php' method='POST'>
							<input type='hidden' name='uid' value='". $uid ."'>
							<input type='Submit' name='sub' value='Start a New Ticket'></form>

							<form action='ticket.php' method='POST'>

							<table class='table'>
								<thead>
								<tr>
									<th>Status</th>
									<th>Description</th>
									<th>Type</th>
									<th><input type='image' name='sub' value='Edit Ticket' alt='Edit Ticket' src='../Resources/images/ic_open_in_browser_black_24dp_1x.png'></th>
								</tr>
								</thead>
								<tfoot>
								<tr>
									<td colspan='3'>&nbsp;</td>
									<td><input type='image' name='sub' value='Edit Ticket' alt='Edit Ticket' src='../Resources/images/ic_open_in_browser_black_24dp_1x.png'></td>
								</tr>
								</tfoot>
								<tbody>
							");

							while($row = $tix->fetch()) {
								echo("
									<tr>
										<td style='vertical-align:middle;'>" . $states[$row['tstate']] . "</td>
										<td style='vertical-align:middle;'>" . $row['userDesc'] . "</td>
										<td style='vertical-align:middle;'><em>" . $problems[$row['ptype']] . "</em></td>
										<td style='vertical-align:middle;'>
											<input type='checkbox' name='tid[]' value='".$row['tid']."'>
										</td>
										</form>
									</tr>
								");
//										<td><a href='ticket.php?uid=" . $uid . "&tid[]=" . $row['tid'] . "'></a></td>
							}


						} else {
							echo("<tr><td colspan=\"4\" class='alert alert-danger'>Couldn't find that user.</td></tr>");
						}
					} else {
						echo("<tr><td colspan=\"4\" class='alert alert-danger'>You have been logged out.</td></tr>");
					}

					echo("
						</tbody>
						</table>
						</form>
					");

					//trash the db connection
					$database=null;
				?>
			</div>
		</div>
	<!--End of the container-->
	</div>

	<?php include "includes/footer.inc.php";?>

</body>
</html>
