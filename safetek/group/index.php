<?php  
	session_start();	

	require("../core/db.php");
	require("../core/functions.php");
	$func = new myFunc;

	$hostels_meetpoints_id = $_SERVER['QUERY_STRING'];

	if (!isset($_SESSION['hostels_meetpoints_id'])) {
		$_SESSION['hostels_meetpoints_id'] = $hostels_meetpoints_id;
	}else{
		$hostels_meetpoints_id = $_SESSION['hostels_meetpoints_id'];
	}

	$row = $func->myFetch("SELECT * FROM groups WHERE hostels_meetpoints_id = ? AND active = 1","i",array($hostels_meetpoints_id));
	$name = $row['name'];

	if (empty($name)){
		echo "hello";
		header("Location: ../group/new/");
	}else{
		echo "hi";
		header("Location: ../group/join/");
	}
?>