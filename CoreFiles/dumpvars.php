<!DOCTYPE>
<html lang="en">
	<body>
		<h1>GET VARS:</h1>
		<?php
			foreach($_GET as $key=>$value){
		echo "<p>$key => $value</p>";
			}
		?>
		<h1>POST VARS:</h1>
		<?php
			foreach($_POST as $key=>$value){
		echo "<p>$key => $value</p>";
			}
		?>
		<h1>COOKIES:</h1>
		<?php
			foreach($_COOKIE as $key=>$value){
		echo "<p>$key => $value</p>";
			}
		?>
	<body>
</html>
