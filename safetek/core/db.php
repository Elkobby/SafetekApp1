<?php  
	$dbhost = 'localhost';
	$dbuser = 'eldad';
	$dbpass = 'hihihi';
	$dbname = 'safetek';

	$conn = new mysqli ($dbhost, $dbuser, $dbpass, $dbname);

	if($conn->connect_error){
		die("connection failure: something wicked happened");
	}
?>