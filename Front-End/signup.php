<?php
include "includes/db_connection.php";
include "includes/functions.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$username    = trim($_POST['username']);
	$email      = trim($_POST['email']);
	$password   = trim($_POST['password']);
	$age   = trim($_POST['age']);
	$country   = trim($_POST['country']);
	$first_name  = trim($_POST['first_name']);
	$second_name = trim($_POST['second_name']);
	$avatar_link = trim($_POST['avatar_link']);

	$error = [
		'username' => '',
		'email' => '',
		'password' => ''
	];

	if (strlen($username) < 4) {
		$error['username'] = 'Username needs to be longer';
	}
	if ($username == '') {
		$error['username'] = 'Username cannot be empty';
	}
	if (username_exists($username, $connection)) {
		$error['username'] = "Username already exists";
	}

	if ($email == '') {
		$error['email'] = "Email cannot be empty";
	}
	if (email_exists($email, $connection)) {
		$error['email'] = "Email already exists";
	}

	if (strlen($password) < 4) {
		$error['password'] = 'Password needs to be longer';
	}
	if ($password == '') {
		$error['password'] = 'Password cannot be empty';
	}


	foreach ($error as $key => $value) {
		if (empty($value)) {
			unset($error[$key]);
		}
	}

	if (empty($error)) {
		if ($avatar_link == '') $avatar_link = 'https://png.pngtree.com/png-clipart/20200224/original/pngtree-cute-rat-avatar-with-a-yellow-background-png-image_5205694.jpg';
		register_user($connection, $username, $email, $password, $first_name, $second_name, $age, $country, $avatar_link);
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>BetR! Sign-Up</title>
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
			<img src="images/rats.png">
		</div>
		<div class="login-content">
			<form style="height:700px; overflow-y:auto;" action="" method="post" id="login-form" autocomplete="off">
				<h2 class="title">NEW HERE?</h2>
				<div class="input-div one">
					<div class="i">
						<i class="fas fa-user"></i>
					</div>
					<div class="div">
						<h5>First Name</h5>
						<input type="text" class="input" name="first_name" id="first_name" autocomplete="on">
					</div>
				</div>
				<div class="input-div one">
					<div class="i">
						<i class="fas fa-user"></i>
					</div>
					<div class="div">
						<h5>Second Name</h5>
						<input type="text" class="input" name="second_name" id="second_name" autocomplete="on">
					</div>
				</div>
				<div class="input-div one">
					<div class="i">
						<i class="fas fa-user"></i>
					</div>
					<div class="div">
						<h5>Avatar Link</h5>
						<input type="text" class="input" name="avatar_link" id="avatar_link" autocomplete="on">
					</div>
				</div>
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
					echo "<div >
							<p  style='height:4vh;border-radius:1vh; background-color:red; text-align:center; padding-top:1vh;'>" . $error['username'] . "</p>
						 </div>";
				} ?>
				<div class="input-div one">
					<div class="i">
						<i class="fas fa-user"></i>
					</div>
					<div class="div">
						<h5>age</h5>
						<input type="text" class="input" name="age" id="age" autocomplete="on">
					</div>
				</div>
				<div style="padding-bottom: 1.3vh;">
					<h5 class="text_al" style=" position: left;
												padding-right:70%;
												padding-bottom: 2vh;
												color: #999;
												font-size: 18px;">Country</h5>
					<select name="country" id="country" autocomplete="on" style="padding-top: 1vh; width:100%; font-size: 1.2rem; color: #555; font-family: 'poppins', sans-serif;">
						<option value="">-</option>
						<option value="Afghanistan">Afghanistan</option>
						<option value="Albania">Albania</option>
						<option value="Algeria">Algeria</option>
						<option value="American Samoa">American Samoa</option>
						<option value="Andorra">Andorra</option>
						<option value="Angola">Angola</option>
						<option value="Anguilla">Anguilla</option>
						<option value="Antartica">Antarctica</option>
						<option value="Antigua and Barbuda">Antigua and Barbuda</option>
						<option value="Argentina">Argentina</option>
						<option value="Armenia">Armenia</option>
						<option value="Aruba">Aruba</option>
						<option value="Australia">Australia</option>
						<option value="Austria">Austria</option>
						<option value="Azerbaijan">Azerbaijan</option>
						<option value="Bahamas">Bahamas</option>
						<option value="Bahrain">Bahrain</option>
						<option value="Bangladesh">Bangladesh</option>
						<option value="Barbados">Barbados</option>
						<option value="Belarus">Belarus</option>
						<option value="Belgium">Belgium</option>
						<option value="Belize">Belize</option>
						<option value="Benin">Benin</option>
						<option value="Bermuda">Bermuda</option>
						<option value="Bhutan">Bhutan</option>
						<option value="Bolivia">Bolivia</option>
						<option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
						<option value="Botswana">Botswana</option>
						<option value="Bouvet Island">Bouvet Island</option>
						<option value="Brazil">Brazil</option>
						<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
						<option value="Brunei Darussalam">Brunei Darussalam</option>
						<option value="Bulgaria">Bulgaria</option>
						<option value="Burkina Faso">Burkina Faso</option>
						<option value="Burundi">Burundi</option>
						<option value="Cambodia">Cambodia</option>
						<option value="Cameroon">Cameroon</option>
						<option value="Canada">Canada</option>
						<option value="Cape Verde">Cape Verde</option>
						<option value="Cayman Islands">Cayman Islands</option>
						<option value="Central African Republic">Central African Republic</option>
						<option value="Chad">Chad</option>
						<option value="Chile">Chile</option>
						<option value="China">China</option>
						<option value="Christmas Island">Christmas Island</option>
						<option value="Cocos Islands">Cocos (Keeling) Islands</option>
						<option value="Colombia">Colombia</option>
						<option value="Comoros">Comoros</option>
						<option value="Congo">Congo</option>
						<option value="Congo">Congo, the Democratic Republic of the</option>
						<option value="Cook Islands">Cook Islands</option>
						<option value="Costa Rica">Costa Rica</option>
						<option value="Cota D'Ivoire">Cote d'Ivoire</option>
						<option value="Croatia">Croatia (Hrvatska)</option>
						<option value="Cuba">Cuba</option>
						<option value="Cyprus">Cyprus</option>
						<option value="Czech Republic">Czech Republic</option>
						<option value="Denmark">Denmark</option>
						<option value="Djibouti">Djibouti</option>
						<option value="Dominica">Dominica</option>
						<option value="Dominican Republic">Dominican Republic</option>
						<option value="East Timor">East Timor</option>
						<option value="Ecuador">Ecuador</option>
						<option value="Egypt">Egypt</option>
						<option value="El Salvador">El Salvador</option>
						<option value="Equatorial Guinea">Equatorial Guinea</option>
						<option value="Eritrea">Eritrea</option>
						<option value="Estonia">Estonia</option>
						<option value="Ethiopia">Ethiopia</option>
						<option value="Falkland Islands">Falkland Islands (Malvinas)</option>
						<option value="Faroe Islands">Faroe Islands</option>
						<option value="Fiji">Fiji</option>
						<option value="Finland">Finland</option>
						<option value="France">France</option>
						<option value="France Metropolitan">France, Metropolitan</option>
						<option value="French Guiana">French Guiana</option>
						<option value="French Polynesia">French Polynesia</option>
						<option value="French Southern Territories">French Southern Territories</option>
						<option value="Gabon">Gabon</option>
						<option value="Gambia">Gambia</option>
						<option value="Georgia">Georgia</option>
						<option value="Germany">Germany</option>
						<option value="Ghana">Ghana</option>
						<option value="Gibraltar">Gibraltar</option>
						<option value="Greece">Greece</option>
						<option value="Greenland">Greenland</option>
						<option value="Grenada">Grenada</option>
						<option value="Guadeloupe">Guadeloupe</option>
						<option value="Guam">Guam</option>
						<option value="Guatemala">Guatemala</option>
						<option value="Guinea">Guinea</option>
						<option value="Guinea-Bissau">Guinea-Bissau</option>
						<option value="Guyana">Guyana</option>
						<option value="Haiti">Haiti</option>
						<option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
						<option value="Holy See">Holy See (Vatican City State)</option>
						<option value="Honduras">Honduras</option>
						<option value="Hong Kong">Hong Kong</option>
						<option value="Hungary">Hungary</option>
						<option value="Iceland">Iceland</option>
						<option value="India">India</option>
						<option value="Indonesia">Indonesia</option>
						<option value="Iran">Iran (Islamic Republic of)</option>
						<option value="Iraq">Iraq</option>
						<option value="Ireland">Ireland</option>
						<option value="Israel">Israel</option>
						<option value="Italy">Italy</option>
						<option value="Jamaica">Jamaica</option>
						<option value="Japan">Japan</option>
						<option value="Jordan">Jordan</option>
						<option value="Kazakhstan">Kazakhstan</option>
						<option value="Kenya">Kenya</option>
						<option value="Kiribati">Kiribati</option>
						<option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
						<option value="Korea">Korea, Republic of</option>
						<option value="Kuwait">Kuwait</option>
						<option value="Kyrgyzstan">Kyrgyzstan</option>
						<option value="Lao">Lao People's Democratic Republic</option>
						<option value="Latvia">Latvia</option>
						<option value="Lebanon">Lebanon</option>
						<option value="Lesotho">Lesotho</option>
						<option value="Liberia">Liberia</option>
						<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
						<option value="Liechtenstein">Liechtenstein</option>
						<option value="Lithuania">Lithuania</option>
						<option value="Luxembourg">Luxembourg</option>
						<option value="Macau">Macau</option>
						<option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
						<option value="Madagascar">Madagascar</option>
						<option value="Malawi">Malawi</option>
						<option value="Malaysia">Malaysia</option>
						<option value="Maldives">Maldives</option>
						<option value="Mali">Mali</option>
						<option value="Malta">Malta</option>
						<option value="Marshall Islands">Marshall Islands</option>
						<option value="Martinique">Martinique</option>
						<option value="Mauritania">Mauritania</option>
						<option value="Mauritius">Mauritius</option>
						<option value="Mayotte">Mayotte</option>
						<option value="Mexico">Mexico</option>
						<option value="Micronesia">Micronesia, Federated States of</option>
						<option value="Moldova">Moldova, Republic of</option>
						<option value="Monaco">Monaco</option>
						<option value="Mongolia">Mongolia</option>
						<option value="Montserrat">Montserrat</option>
						<option value="Morocco">Morocco</option>
						<option value="Mozambique">Mozambique</option>
						<option value="Myanmar">Myanmar</option>
						<option value="Namibia">Namibia</option>
						<option value="Nauru">Nauru</option>
						<option value="Nepal">Nepal</option>
						<option value="Netherlands">Netherlands</option>
						<option value="Netherlands Antilles">Netherlands Antilles</option>
						<option value="New Caledonia">New Caledonia</option>
						<option value="New Zealand">New Zealand</option>
						<option value="Nicaragua">Nicaragua</option>
						<option value="Niger">Niger</option>
						<option value="Nigeria">Nigeria</option>
						<option value="Niue">Niue</option>
						<option value="Norfolk Island">Norfolk Island</option>
						<option value="Northern Mariana Islands">Northern Mariana Islands</option>
						<option value="Norway">Norway</option>
						<option value="Oman">Oman</option>
						<option value="Pakistan">Pakistan</option>
						<option value="Palau">Palau</option>
						<option value="Panama">Panama</option>
						<option value="Papua New Guinea">Papua New Guinea</option>
						<option value="Paraguay">Paraguay</option>
						<option value="Peru">Peru</option>
						<option value="Philippines">Philippines</option>
						<option value="Pitcairn">Pitcairn</option>
						<option value="Poland">Poland</option>
						<option value="Portugal">Portugal</option>
						<option value="Puerto Rico">Puerto Rico</option>
						<option value="Qatar">Qatar</option>
						<option value="Reunion">Reunion</option>
						<option value="Romania">Romania</option>
						<option value="Russia">Russian Federation</option>
						<option value="Rwanda">Rwanda</option>
						<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
						<option value="Saint LUCIA">Saint LUCIA</option>
						<option value="Saint Vincent">Saint Vincent and the Grenadines</option>
						<option value="Samoa">Samoa</option>
						<option value="San Marino">San Marino</option>
						<option value="Sao Tome and Principe">Sao Tome and Principe</option>
						<option value="Saudi Arabia">Saudi Arabia</option>
						<option value="Senegal">Senegal</option>
						<option value="Seychelles">Seychelles</option>
						<option value="Sierra">Sierra Leone</option>
						<option value="Singapore">Singapore</option>
						<option value="Slovakia">Slovakia (Slovak Republic)</option>
						<option value="Slovenia">Slovenia</option>
						<option value="Solomon Islands">Solomon Islands</option>
						<option value="Somalia">Somalia</option>
						<option value="South Africa">South Africa</option>
						<option value="South Georgia">South Georgia and the South Sandwich Islands</option>
						<option value="Span">Spain</option>
						<option value="SriLanka">Sri Lanka</option>
						<option value="St. Helena">St. Helena</option>
						<option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
						<option value="Sudan">Sudan</option>
						<option value="Suriname">Suriname</option>
						<option value="Svalbard">Svalbard and Jan Mayen Islands</option>
						<option value="Swaziland">Swaziland</option>
						<option value="Sweden">Sweden</option>
						<option value="Switzerland">Switzerland</option>
						<option value="Syria">Syrian Arab Republic</option>
						<option value="Taiwan">Taiwan, Province of China</option>
						<option value="Tajikistan">Tajikistan</option>
						<option value="Tanzania">Tanzania, United Republic of</option>
						<option value="Thailand">Thailand</option>
						<option value="Togo">Togo</option>
						<option value="Tokelau">Tokelau</option>
						<option value="Tonga">Tonga</option>
						<option value="Trinidad and Tobago">Trinidad and Tobago</option>
						<option value="Tunisia">Tunisia</option>
						<option value="Turkey">Turkey</option>
						<option value="Turkmenistan">Turkmenistan</option>
						<option value="Turks and Caicos">Turks and Caicos Islands</option>
						<option value="Tuvalu">Tuvalu</option>
						<option value="Uganda">Uganda</option>
						<option value="Ukraine">Ukraine</option>
						<option value="United Arab Emirates">United Arab Emirates</option>
						<option value="United Kingdom">United Kingdom</option>
						<option value="United States">United States</option>
						<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
						<option value="Uruguay">Uruguay</option>
						<option value="Uzbekistan">Uzbekistan</option>
						<option value="Vanuatu">Vanuatu</option>
						<option value="Venezuela">Venezuela</option>
						<option value="Vietnam">Viet Nam</option>
						<option value="Virgin Islands (British)">Virgin Islands (British)</option>
						<option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
						<option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
						<option value="Western Sahara">Western Sahara</option>
						<option value="Yemen">Yemen</option>
						<option value="Serbia">Serbia</option>
						<option value="Zambia">Zambia</option>
						<option value="Zimbabwe">Zimbabwe</option>
					</select>
				</div>
				<div class="input-div one">
					<div class="i">
						<i class="fas fa-envelope"></i>
					</div>
					<div class="div">
						<h5>Email</h5>
						<input class="input" type="email" name="email" id="email" class="form-control" autocomplete="on">
					</div>
				</div>
				<?php if (isset($error['email'])) {
					echo "<div>
							<p style='height:4vh;border-radius:1vh; background-color:red; text-align:center; padding-top:1vh;'>" . $error['email'] . "</p>
						 </div>";
				}
				?>
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
					echo "<br><div>
							<p style='height:4vh;border-radius:1vh; background-color:red; text-align:center; padding-top:1vh;'>" . $error['password'] . "</p>
						 </div>";
				}
				?>
				<a href="#">Forgot Password?</a>
				<input type="submit" name="signup" class="btn" value="Enter the world of BetR!">
			</form>
		</div>
	</div>
	<script type="text/javascript" src="js/login.js"></script>
</body>

</html>