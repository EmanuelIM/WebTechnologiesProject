<?php 
	include "includes/db_connection.php";
?>


<!DOCTYPE html>
<html>

<head>
	<title>BetR! Login</title>
	<link rel="stylesheet" type="text/css" href="css/login_style.css">
	<link rel="stylesheet" type="text/css" href="css/landing_style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
		integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
		crossorigin="anonymous" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
	<div class="navbar">
		<ul>
			<a href="signup.html">
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
			<form action="index.php" method="post" id="login-form" autocomplete="off">
				<h2 class="title">Welcome Back</h2>
				<div class="input-div one">
					<div class="i">
						<i class="fas fa-user"></i>
					</div>
					<div class="div">
						<h5>Username</h5>
						<input type="text" class="input" name="username" id="username" autocomplete="on" value="<?php echo isset($username) ? $username : '' ?>">
						<p><?php echo isset($error['username']) ? $error['username'] : '' ?></p>
					</div>
				</div>
				<div class="input-div pass">
					<div class="i">
						<i class="fas fa-lock"></i>
					</div>
					<div class="div">
						<h5>Password</h5>
						<input type="password" class="input">
					</div>
				</div>
				<a href="#">Forgot Password?</a>
				<input type="submit" class="btn" value="Login">
			</form>
		</div>
	</div>
	<script type="text/javascript" src="js/login.js"></script>
</body>

</html>