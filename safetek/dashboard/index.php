<?php 
session_start();
include "../layout/head.php"; ?>
	<div class="dashContainer">
		<div class="dashHeader">
			<div class="profile">
				<img src="../img/<?php echo $_SESSION['img']; ?>" alt="">
			</div>
			<div class="name">
				<p>Welcome, <?php echo $_SESSION['name']; ?>!</p>
			</div>
		</div>

		<div class="dashBody">
			<div class="search">
				<input type="text" placeholder="Get Going" autofocus="true" id="searchInput" destination="http://localhost/safetek/dashboard/search.php" output="#results">
			</div>

			<div class="searchResults">
				<small>Results: </small>
				<ul id="results">
				</ul>
			</div>
		</div>
	</div>
<?php 
	include "../layout/foot.php";
?>