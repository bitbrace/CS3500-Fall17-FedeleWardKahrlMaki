<?php
	
	function errpage($err="Unknown error"){
		echo "<!DOCTYPE html><html lang='en'><body><p>Error: ".$err."</p></body></html>";
		exit(1);
		return;
	}
	
	function startup(){
		initdb();
		if(!random_Int(0,$cleanchance-1)){	//If we get a 0 by chance
			cleanSessions();		//Do some cleaning
		}					//
		return;
	}
	
