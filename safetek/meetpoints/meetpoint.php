<?php  
	session_start();	

	require("../core/db.php");
	require("../core/functions.php");
	$func = new myFunc;

	$hostel_id = $_SERVER['QUERY_STRING'];

	if (!isset($_SESSION['hostels_id'])) {
		$_SESSION['hostels_id'] = $hostel_id;
	}else{
		$hostel_id = $_SESSION['hostels_id'];
	}

	$result = $func->myResult("SELECT * FROM meetpoints WHERE id IN (SELECT meetpoint_id FROM hostels_meetpoints WHERE hostel_id = ?)","i",array($hostel_id));

	while ($row = $result->fetch_assoc()) {
		$meetpoint_id = $row['id'];
		$name = $row['name'];

		$hostels_meetpoints = $func->myFetch("SELECT id FROM hostels_meetpoints WHERE hostel_id = ? AND meetpoint_id = ?", "ii", array($hostel_id,$meetpoint_id));

		$hostels_meetpoints_id = $hostels_meetpoints['id'];
?>
<div class="col-xs-6">	
	<a href="../group/?<?php echo $hostels_meetpoints_id; ?>" class="meetups"><?php echo $name ?></a>
</div>
<?php
	}
?>