<?php

// Connect to the database, referrence object is named '$database'
//include "../Resources/connectToDB.php";
include "../Resources/database.php";
$database = initdb();

// Get user system info mapping functions
include "../Resources/getUserSystemInfo.php";

// Provides method for getting suggestion text and updating tickets
include "../Resources/processSuggestions.php";

                    function display($i, $results){
                        if (!isset($results[$i])){
                            echo("<strong>Sorry, you ran out of suggetions!</strong>");
                        }
                        else{
                            echo("<strong>{$results[$i]}</strong><br><br>");
                                
                                echo("<input type='hidden' name='uid' value=$uid>
                                <input type='hidden' name='tid' value={$_POST['tid']}>
                                <input type='hidden' name='counter' value=$i>
                                <input type='Submit' name='subWorked' value='This Worked! Close this ticket'></br></br>
                            
                                <input type='Submit' name='notGood' value='Not working, give me a new suggestion'>
                            
                            ");
                        }
                           
                    }

if (isset($_COOKIE['sessionID'])
&&($uid = recall((int) $_COOKIE['sessionID']))
&&($uid !== false)) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ticket Modifier</title>
	<link href="../Resources/bootstrap-3.3.7/dist/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../Resources/auxStyling.css">
</head>
<body>

	<?php include "header.php"; ?>

	<div class="container">
		<div class="well aler alert-danger">
			<strong>Showing Results for system: <?php echo(getOS() .", ". getBrowser() .", ". getIPAddr()); ?></strong>
		</div>

		<div class="well">
			<form action='suggestions.php' method='POST'>
				<fieldset>
					<legend>Suggestions for ticket #<?php echo($_POST['tid']); ?></legend>
				<?php 
					# iterate over the four levels of strictness until we find something
					for ($i=0; $i < 4; $i++) { 
						$results = getSuggText($_POST['tid'], $i);

						# we've found something, break from our loop
						if (isset($results[0])){
							break;
						}
					}
                    
					# if we failed to find something, set a message
					if (!isset($results[0])){
						echo('<strong>Sorry bub, there were no recorded suggestions for your set of issues.</strong>');
					# otherwise, output some info and allow the user to close the ticket
					}else{
                        # Allow the user to decide if the suggestion works for them
                        # Lets them choose if the option works for them and get a new suggestion if it doesn't
                        
                        if (!isset($_POST['counter'])){
                            $i=0;
                        }
                        else{
                            $i=$_POST['counter'] + 1;
                        }
                        
                        display($i, $results);
                        
                        
                    }
                    
                    
				?>
				</fieldset>
			</form>
		</div>

	<!-- Back button includes uid for dashboard -->
	<div class='well'>
		<form action='dashboard.php' method='POST'>
			<input type='hidden' name='uid' value='<?php echo($uid); ?>'>
			<input type='Submit' name='sub' value='Return to Dashboard'>
		</form>
	</div>
	
	<!--End of the container-->
	</div>

	<?php 
		//trash the db connection
		$database=null;
		include "footer.php";
	?>

</body>
</html>

<?php
}else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ticket Modifier</title>
	<link href="../Resources/bootstrap-3.3.7/dist/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../Resources/auxStyling.css">
</head>
<body>
	<div class="container">
		<div class="well aler alert-danger">
			<strong>Showing Results for system: <?php echo(getOS() .", ". getBrowser() .", ". getIPAddr()); ?></strong>
		</div>
	</div>
</body>

<?php
}
