<?php 

// User updated
if (isset($_GET['subCreate'])){

	$stmt = $database->prepare("INSERT INTO ticket (uid, tstate, ptype, userDesc) VALUES (:user, 1, :problem, :description);");

	$stmt->bindParam(':user', $_GET['uid'], PDO::PARAM_INT);
	$stmt->bindParam(':problem', $_GET['ptype'], PDO::PARAM_INT);
	$stmt->bindParam(':description', $_GET['userDesc'], PDO::PARAM_STR);

	if ($stmt->execute() === TRUE){
	echo("<div class='well'>
			<div class='alert alert-success'><strong>Ticket created!<strong></div>
		</div>");
	} else {
	echo("<div class='well'>
			<div class='alert alert-danger'><strong>Ticket failed to be created, please try again.<strong></div>
		</div>");
	}
}

if (isset($_GET['subUpdate'])){


	$stmt = $database->prepare("UPDATE ticket SET ptype = :problem, userDesc = :description, tstate = :state WHERE tid = :ticket;");

	$stmt->bindParam(':problem', $_GET['ptype'], PDO::PARAM_INT);
	$stmt->bindParam(':description', $_GET['userDesc'], PDO::PARAM_STR);
	$stmt->bindParam(':ticket', $_GET['subUpdate'], PDO::PARAM_INT);
	$stmt->bindParam(':state', $_GET['status'], PDO::PARAM_INT);

	if ($stmt->execute() === TRUE){
	echo("<div class='well'>
			<div class='alert alert-success'><strong>Ticket #{$_GET['subUpdate']} updated!<strong></div>
		</div>");
	} else {
	echo("<div class='well'>
			<div class='alert alert-danger'><strong>Ticket #{$_GET['subUpdate']} failed to update, please try again.<strong></div>
		</div>");
	}
}


?>