<?php include "../layout/head.php" ?>
	<div class="homecontainer">
	<div class="homeHeader">
		<div class="logo">
			<img src="../img/logo.png" alt="safetek-Logo">
			<p>BECAUSE IT'S GREAT TO GET HOME SAFE</p>
		</div>
	</div>

	<div class="homeBody">
		<form name="login" id="signupForm" method="post" action="processing.php">
			<ul >
    			<li><input type="number" name="reference" placeholder="Reference Number" required autofocus="true"></li>
				<li><input type="number" name="index" placeholder="Index Number" required></li>
					<li><input type="email" name="email" placeholder="email" required></li>
				<li><input type="password" name="password" placeholder="Password" required</li></li><br>
				<li><input type="password" name="retypePassword" placeholder="Retype Password" required</li></li><br>
				<input type="hidden" name="signup" value="submit">
				<li><input type="submit" value="SIGN UP" id="submit-button"></li>
			</ul>
		</form>
		<p style="text-align: center;"><small id="feedback"></small></p>
		<div id="sign-up">
			<p>Have an accout already? <b><a href="index.php">Log In!</a></b></p>
		</div>
	</div>
	</div>
<?php include "../layout/foot.php"; ?>
