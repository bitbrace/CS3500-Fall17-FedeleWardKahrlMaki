<?php
	
	function errpage($err="Unknown error"){
		echo "<!DOCTYPE html><html lang='en'><body><p>Error: ".$err."</p></body></html>";
		exit(1);
		return;
	}
	
