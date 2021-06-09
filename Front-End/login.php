<?php
session_start();
include "includes/db_connection.php";
include "includes/functions.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$username    = trim($_POST['username']);
	$password   = trim($_POST['password']);
	$row;
	$db_password;
	$error = [
		'username' => '',
		'password' => ''
	];
	$username = mysqli_real_escape_string($connection, $username);
	$password = mysqli_real_escape_string($connection, $password);

	$query = "SELECT password,role FROM users WHERE nickname = '{$username}'";
	$select_user_query = mysqli_query($connection, $query);

	if (!$select_user_query) {
		die("Query failed " . mysqli_error($connection));
	}

	if (mysqli_num_rows($select_user_query) == 0) {
		$error['username'] = 'Username does not exist.';
	} else {
		$row = mysqli_fetch_array($select_user_query);
		$db_password = $row['password'];
		if (!password_verify($password, $db_password)) {
			$error['password'] = 'Wrong password';
		}
	}

	foreach ($error as $key => $value) {
		if (empty($value)) {
			unset($error[$key]);
		}
	}

	if (empty($error)) {
		login_user($username, $password, $connection);
		determineWinner($connection);
		exit();
	}
}
?>


<!DOCTYPE html>
<html>

<head>
	<title>BetR! Login</title>
	<link rel="stylesheet" type="text/css" href="css/login_style.css">
	<link rel="stylesheet" type="text/css" href="css/landing_style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
	<div class="navbar">
		<ul>
			<a href="signup.php">
				<li>SIGN UP</li>
			</a>
			<a href="login.php">
				<li>LOG IN</li>
			</a>
			<a href="about_page.html">
				<li>CONTACT US</li>
			</a>
			<li style="float:right"><a href="landing_page.html"><img class=" logo" src="images/logo.png"></a></li>
		</ul>
	</div>
	<img class="wave" src="images/wave.png">
	<div class="container">
		<div class="img rats">
			<img src="images/ratslog.png">
		</div>
		<div class="login-content">
			<form action="" method="post" id="login-form" autocomplete="off">
				<h2 class="title">Welcome Back</h2>
				<div class="input-div one">
					<div class="i">
						<i class="fas fa-user"></i>
					</div>
					<div class="div">
						<h5>Username</h5>
						<input type="text" class="input" name="username" id="username" autocomplete="on">
					</div>
				</div>
				<?php if (isset($error['username'])) {
					echo "<div>
							<a class='btn' href='signup.php' style='height:4vh;border-radius:1vh; background-color:red; text-align:center; padding-top:1vh;'>New Here?</a>
						 </div>";
				} ?>
				<div class="input-div pass">
					<div class="i">
						<i class="fas fa-lock"></i>
					</div>
					<div class="div">
						<h5>Password</h5>
						<input class="input" type="password" name="password" id="key" class="form-control">
					</div>
				</div>
				<?php if (isset($error['password'])) {
					echo "<div>
							<p style='height:4vh;border-radius:1vh; background-color:red; text-align:center; padding-top:1vh;'>" . $error['password'] . "</p>
						 </div>";
				}
				?>
				<a href="#">Forgot Password?</a>
				<input type="submit" class="btn" value="Login">
			</form>
		</div>
	</div>
	<script type="text/javascript" src="js/login.js"></script>
</body>

</html>