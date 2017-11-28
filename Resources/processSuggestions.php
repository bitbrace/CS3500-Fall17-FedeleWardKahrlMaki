<?php 
	
	//get the getUserSustemInfo and database files if not already available
	require_once('getUserSystemInfo.php');
	require_once('database.php');

	// If the suggestion worked, update its state to closed
   
	if (isset($_GET['subWorked'])){
		$database = initdb();
		$stmt = $database->prepare("UPDATE ticket SET tstate = 2 WHERE tid = :tid");
		$stmt->bindParam(':tid', $_GET['tid'], PDO::PARAM_INT);
        $stmt->execute();
		$database = null;
	}
    
	function getSuggText($tid, $strictLevel){

		// initialize our connection to the database
		$database = initdb();
		$tempState = $database->query("SELECT * FROM ticket WHERE tid = " . $tid);
		$ticketInfo = $tempState->fetch();
		$brow = getBrowser();
		$os = getOS();
        $probID=$ticketInfo['ptype'];
		// used to hold the text to return from the query
		$retRecord;
		switch ($strictLevel) {
			# most strict query
              
			case 0:
				$retRecord = $database->prepare("
					SELECT Sugg.suggText 
					FROM solutionFilter Sol JOIN browserMapping Brow ON Sol.browser = Brow.browserid JOIN OSMapping OS ON Sol.OS = OS.osid JOIN problemMapping Prob ON Sol.problem = Prob.pid JOIN tagMapping Tag ON Sol.tag = Tag.tagid JOIN suggMapping Sugg ON Sol.suggid = Sugg.suggid
					WHERE Brow.browName = :browser AND OS.osName = :os AND Prob.pid = :problem AND :tag like CONCAT('%',Tag.tag,'%');");

                
				$retRecord->bindParam(':browser', $brow, PDO::PARAM_STR);
				$retRecord->bindParam(':os', $os, PDO::PARAM_STR);
				$retRecord->bindParam(':problem', $ticketInfo['ptype'], PDO::PARAM_STR);
				$retRecord->bindParam(':tag', $ticketInfo['userDesc'], PDO::PARAM_STR);

				$retRecord->execute();
				break;

			# Remove tag restriction
			case 1:
				$retRecord = $database->prepare("
					SELECT Sugg.suggText 
					FROM solutionFilter Sol JOIN browserMapping Brow ON Sol.browser = Brow.browserid JOIN OSMapping OS ON Sol.os = OS.osid JOIN problemMapping Prob ON Sol.problem = Prob.pid JOIN suggMapping Sugg ON Sol.suggid = Sugg.suggid
					WHERE Brow.browName = :browser AND OS.osName = :os AND Prob.pid = :problem");

				$retRecord->bindParam(':browser', $brow, PDO::PARAM_STR);
				$retRecord->bindParam(':os', $os, PDO::PARAM_STR);
				$retRecord->bindParam(':problem', $probID, PDO::PARAM_STR);

				$retRecord->execute();
				break;

			# Remove browser restriction
			case 2:
				$retRecord = $database->prepare("
					SELECT Sugg.suggText 
					FROM solutionfilter Sol JOIN osmapping OS ON Sol.os = OS.osid JOIN problemmapping Prob ON Sol.problem = Prob.pid JOIN suggmapping Sugg ON Sol.suggid = Sugg.suggid
					WHERE Os.osName = :os AND Prob.pid = :problem");

				$retRecord->bindParam(':os', $os, PDO::PARAM_STR);
				$retRecord->bindParam(':problem', $probID, PDO::PARAM_STR);

				$retRecord->execute();
				break;

			# catch final level (Remove os restriction)
			default:
				$retRecord = $database->prepare("
					SELECT Sugg.suggText 
					FROM solutionFilter Sol JOIN problemMapping Prob ON Sol.problem = Prob.pid JOIN suggMapping Sugg ON Sol.suggid = Sugg.suggid
					WHERE Prob.pid = :problem");

				$retRecord->bindParam(':problem', $probID, PDO::PARAM_STR);

				$retRecord->execute();
				break;
		}
        //This passes all of the results
        $resultarray = array();
        while ($row = $retRecord->fetch()){
            array_push($resultarray, $row['suggText']);
        }
		return $resultarray;
	}

?>