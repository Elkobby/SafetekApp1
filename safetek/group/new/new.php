<?php  
    if (isset($_POST['create'])) {
        session_start();
        require_once("../../core/db.php");

        $name = $_POST['name'];
        $hostels_meetpoints_id = $_SESSION['hostels_meetpoints_id'];
        $date = date("Y-m-d H:i:s");

        $stmt = $conn->prepare("INSERT INTO groups (name, dateCreated, hostels_meetpoints_id) VALUES (?,?,?)");
        $stmt->bind_param("ssi", $name, $date, $hostels_meetpoints_id);

        if ($stmt->execute() === false) {
            echo "Something unexpected happened";
        }else{
            $result = $conn->query("SELECT * FROM groups ORDER BY id DESC LIMIT 1");
            $row = $result->fetch_assoc();

            $group_id = $row['id'];
            $_SESSION['group'] = $group_id;

            $stmt = $conn->prepare("INSERT INTO groups_students (student_id, group_id) VALUES (?,?)");
            $stmt->bind_param("ii", $_SESSION['student_id'], $group_id);
            $stmt->execute();
        }
        echo '<script>window.location = "http://localhost/safetek/group/dashboard/"</script>';
        exit();

    }
?>
<div class="homeBody">
	<form id="createForm" method="post" action="">
		<ul >
			<li><input type="text" name="name" placeholder="Enter Group Name" required="true" autofocus="true"></li>
			<input type="hidden" name="create" value="submit">
			<li><input type="submit" value="CREATE" id="submit-button"></li>
		</ul>
	</form>
    <p><small id="feedback"></small></p>
	<p style="text-align: center;"><small id="feedback"></small></p>
</div>