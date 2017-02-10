<?php 
	session_start();	

	require("../core/db.php");
	require("../core/functions.php");
	$func = new myFunc;
	
	if(isset($_POST['login'])){
		$index = $_POST['index'];
		$reference = $_POST['reference'];
		$password = $_POST['password'];

		$query = "SELECT * FROM students WHERE index_number = ? AND reference_number = ?";

		$result = $func->myResult($query, "ii", array($index,$reference));
		$row = $result->fetch_assoc();

		$name = $row['name'];

		if(empty($name)){
			echo "no such email exists";
			return false;
		}else{
			$dbPass = $row['password'];
			if(hash_equals($dbPass, crypt($password, $dbPass))){
				$_SESSION['student_id'] = $row['id'];
				$_SESSION['name'] = $name;
				$_SESSION['number'] = $row['number'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['reference_number'] = $row['reference_number'];
				$_SESSION['index_number'] = $row['index_number'];
				$_SESSION['img'] = $row['img'];

	    		echo '<script>window.location="http://localhost/safetek/dashboard/"</script>';
			}else{
				echo "incorrect password";
				return false;
			}
		}
	}

	if (isset($_POST['signup'])) {
		$email = $_POST['email'];
		$index = $_POST['index'];
		$reference = $_POST['reference'];
		$password = $_POST['password'];

	    $password = $_POST['password'];
	    $rpassword = $_POST['retypePassword'];
	    $dateCreated = date("Y-m-d H:i:s");

		$row = $func->myFetch("SELECT * from students where index_number = ? OR reference_number = ?", "ii", array($index,$reference));

	    if($password !== $rpassword){
	    	echo "passwords not match";
	    }else if(!empty($row['email'])){
	    	echo "oops, that email already exists";
		}else{
			// hash password
			$password = $func->cryptPass($password);

			$stmt = $conn->prepare("INSERT INTO students (`email`,`password`,`reference_number`,`index_number`,`dateCreated`) values (?,?,?,?,?)");
			$stmt->bind_param("ssiis",$email,$password,$reference,$index,$dateCreated);

			if($stmt->execute() === false){
				echo "Something wicked happened";
				exit();
			}else{
				$_SESSION['index'] = $index;
				$_SESSION['reference'] = $reference;

				echo '<script>window.location = "http://localhost/safetek/logs/"</script>';
			}
			$stmt->close();
			$conn->close();

		}
	}
?>