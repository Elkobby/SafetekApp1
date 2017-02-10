<?php 
session_start();
include "../layout/head.php";

$index = "";
$reference = "";
if (isset($_SESSION['index'])) {
	$index = $_SESSION['index'];
}
if (isset($_SESSION['reference'])) {
	$reference = $_SESSION['reference'];
}

?>

	<div class="homecontainer">
		<div class="homeHeader">
			<div class="logo">
				<img src="../img/logo.png" alt="safetek-Logo">
				<p>BECAUSE IT'S GREAT TO GET HOME SAFE</p>
			</div>
		</div>

		<div class="homeBody">
			<form name="login" id="loginForm" method="post" action="processing.php">
    			<ul >
	    			<li><input type="number" name="reference" placeholder="Reference Number" required="true" autofocus="true" value="<?php echo $reference; ?>"></li>
    				<li><input type="number" name="index" placeholder="Index Number" required="true" value="<?php echo $index; ?>"></li>
    				<li><input type="password" name="password" placeholder="Password" required="true"></li><br>
    				<input type="hidden" name="login" value="submit">
    				<li><input type="submit" value="LOGIN" id="submit-button"></li>
    			</ul>
    		</form>
    		<p style="text-align: center;"><small id="feedback"></small></p>
    		<div id="sign-up">
    		<p>Don't have an account? <b><a href="signup.php">Sign Up here!</a></b></p>
    		</div>
		</div>
	</div>
<?php include "../layout/foot.php"; ?>