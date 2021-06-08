<?php 
	include "includes/db_connection.php";
	include "includes/functions.php";
    
    session_start();

    if(isset($_SESSION['role']) && $_SESSION['role'] != 'admin'){
        header("Location: index.php");
    }else if(!isset($_SESSION['role']) && $_SESSION['role'] != 'admin'){
        header("Location: landing_page.html");
    }

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$ratname     = trim($_POST['ratname']);
		$birthDate   = trim($_POST['birthDate']);
		$description = trim($_POST['description']);
        $birthPlace  = trim($_POST['birthPlace']);
        $gender      = trim($_POST['gender']);
        $club        = trim($_POST['club']);

		$error = [
			'ratname' => ''
		 ];
		
		if(strlen($ratname) < 4){
			$error['ratname'] = 'Name needs to be longer';
		 }
		 if($ratname == ''){
			$error['ratname'] = 'Name cannot be empty';
		 }
		 if(rat_exists($ratname,$connection)){
			$error['ratname'] = "Name already exists";
		 }

		 foreach ($error as $key => $value) {
			if(empty($value)){
				unset($error[$key]);
			}
		 }

		 if(empty($error)){
			addrat($connection,$ratname,$birthDate,$description,$birthPlace,$gender,$club);
		}
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="css/user_profile_style.css">
    <link rel="stylesheet" href="css/credit_style.css">
    <title>Add Rat</title>
</head>

<body>
    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span><img src="https://img.icons8.com/emoji/48/000000/rat-emoji.png" /></span><span>Bet on Rats!</span>
            </h2>
        </div>

        <div class="sidebar-menu">
            <ul>
            <li><a href="index.php" ><span class="las la-igloo"></span>
                        <span>Dashboard</span></a>
                </li>
                <li><a href="user_profile.php"><span class="las la-users"></span>
                        <span>User Profile Settings</span></a>
                </li>
                <li><a href="your_bets.php"><span class="las la-clipboard-list"></span>
                        <span>Your Bets</span></a>
                </li>
                <li><a href="credit_card.php"><span class="las la-wallet"></span>
                        <span>Add Money</span></a>
                </li>
                <?php 
                    if($_SESSION['role'] == 'admin'){
                        echo " <li><a href='add_rat.php' class='active'><span class='las la-id-badge'></span>
                        <span>Add Rat</span></a>
                        </li>
                        <li><a href='create_bet.php'><span class='las la-caret-right'></span>
                                <span>Add a match (SA Only)</span></a>
                        </li>";
                    }
                
                ?>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <header>
            <h2>
                <label for="nav-toggle">
                    <span class="las la-bars"></span>
                </label>
                Add rat
            </h2>
            <div class="user-wrapper">
                <?php
                    echo "<img src='" . $_SESSION['avatar_link'] . "' width='30px' height='30px' alt='no'>";
                ?>
                <div>
                    <h4><?php echo $_SESSION['username'] ?></h4>
                    <small><?php echo $_SESSION['role'] ?></small>
                    <div class="sign-out-button">
                        <a href="includes/logout.php"> Sign Out <span class="las la-arrow-right"></span></a>
                    </div>
                </div>
            </div>
        </header>
        <div class="col">
            <div class="container">
                <form action="" method="post" id="login-form" autocomplete="off">
                    <label for="ratname">Name </label>
                    <input type="text" id="ratname" name="ratname" placeholder="John D. Doe">
                    <?php  if(isset($error['ratname'])){
					echo "<div>
							<p class='btn' style=' padding: 10px 0px'>". $error['ratname']. "</p>
						 </div>";
                    }
                    ?>
                    <label for="birthDate">Birth Date </label>
                    <input type="date" id="birthDate" name="birthDate" placeholder="">
                    <label for="birthPlace">Birth Place </label>
                    <input type="text" id="birthPlace" name="birthPlace" placeholder="Paris">
                    <label for="description">Short Description</label>
                    <input type="text" id="description" name="description">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender" autocomplete="on" >
                        <option value="">-</option>
                        <option value="M">M</option>
                        <option value="F">F</option>
                    </select>
                    <label for="club">Club name</label>
                    <input type="text" id="club" name="club"  placeholder="Club name">
                    <input type="submit" value="Add Rat" class="btn">
                </form>
            </div>
        </div>

</body>