<?php  
	session_start();	

	require("../core/db.php");
	require("../core/functions.php");
	$func = new myFunc;

	$search = $_POST['srch'];

	if (empty($search)) {
		exit();
	}

	$result = $func->myResult("SELECT * FROM hostels WHERE name LIKE CONCAT('%',?,'%')","s",array($search));

	while ($row = $result->fetch_assoc()) {
	$id = $row['id'];
	$name = $row['name'];
?>	
	<li><a href="../meetpoints/?<?php echo $id; ?>"><?php echo $name; ?></a></li>
	
<?php 	
	}
?>