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
        $firstrat     = trim($_POST['firstrat']);
        $secondrat    = trim($_POST['secondrat']);
        $firstodds    = trim($_POST['firstodds']);
        $secondodds   = trim($_POST['secondratodds']);
        $date         = trim($_POST['matchDate']);
        $time         = trim($_POST['matchTime']);
        $password     = trim($_POST['password']);

        $error = [
			'ratname' => '',
            'firstrat' =>'',
            'secondrat' =>'',
            'password' => ''
		 ];


        $query = "SELECT password,role FROM users WHERE nickname = '{$_SESSION['username']}'";
        $select_user_query = mysqli_query($connection, $query);
        $row = mysqli_fetch_array($select_user_query);
        $db_password = $row['password'];
        if(!password_verify($password, $db_password)){
            $error['password'] = 'Wrong password';
        }

         if($firstrat == $secondrat){
             $error['ratname'] = 'Rats must be should be different';
         }
         if($firstrat == '-'){
             $error['firstrat'] = 'You should choose one rat';
         }
         if($secondrat == '-'){
             $error['secondrat'] = 'You should choose one rat';
         }
         foreach ($error as $key => $value) {
			if(empty($value)){
				unset($error[$key]);
			}
		 }

         if(empty($error)){
            addbet($connection,$firstrat,$secondrat,$firstodds,$secondodds,$date,$time);
         }
    }
?>



<!DOCTYPE html>
<html lang="en">

<script type="text/javascript"> 
  function getselected(){ 
    var select_container = document.getElementById('firstrat'); 
	alert('type: '+select_container); 
	alert('type: '+ select_container.options[select_container.selectedIndex].value); 
    alert('checking'); 
  }
</script>
<script type="text/javascript"> 
  function getselected1(){ 
    var select_container1 = document.getElementById('secondrat'); 
	alert('type: '+select_container1); 
	alert('type: '+ select_container1.options[select_container1.selectedIndex].value); 
    alert('checking'); 
  }
</script>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="css/user_profile_style.css">
    <title>Create a Match</title>
</head>

<body>
    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span><img src="https://img.icons8.com/emoji/48/000000/rat-emoji.png" alt = "Rat pic" /></span><span>Bet on Rats!</span>
            </h2>
        </div>

        <div class="sidebar-menu">
            <ul>
            <li><a href="index.php"><span class="las la-igloo"></span>
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
                        echo " <li><a href='add_rat.php'><span class='las la-id-badge'></span>
                        <span>Add Rat</span></a>
                        </li>
                        <li><a href='create_bet.php' class='active'><span class='las la-caret-right'></span>
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
                Your Profile
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
        <main>
            
            <h2>Super Admin control panel for adding matches</h2>
            <br>
            <?php  
                if(isset($error['ratname'])){
					echo "<div>
							<p style=' padding: 10px 0px; border-radius:1vh; background-color:red; text-align:center'>". $error['ratname']. "</p>
						 </div>";
                }
            ?><br>
            <h3 style="padding-bottom: 30px;">Add the information for a match below:</h3>
            <form action="" method="post" id="login-form" autocomplete="off">

                <?php  
                    $query = "SELECT * FROM rat";
                    $select_comment_query = mysqli_query($connection, $query);
                    $first_row = mysqli_query($connection, $query);
                    if(!$select_comment_query){
                        die('QUERY FAILED' . mysqli_error($connection));
                    }
                ?>
                
                <?php  
                    if(isset($error['firstrat'])){
                        echo "<br><div>
                                <p style=' padding: 10px 0px; border-radius:1vh; background-color:red; text-align:center'>". $error['firstrat']. "</p>
                            </div><br>";
                    }
                ?>
                <label for="firstrat"> First Rat's Name </label>
                <select name="firstrat" id="firstrat" autocomplete="on">
                    <option value="-">-</option>
                    <?php 
                        while($fir_row = mysqli_fetch_array($select_comment_query)){
                            echo " <option value='". $fir_row['rat_name'] . "'>". $fir_row['rat_name']. "</option>";
                        }
                    ?>
                </select>

                <label for="firstodds"> First Rat's Odds </label>
                <input type="number" step="0.01" id="firstodds" name="firstodds" placeholder="Odds..">
                <?php  
                    if(isset($error['secondrat'])){
                        echo "<br><div>
                                <p style=' padding: 10px 0px; border-radius:1vh; background-color:red; text-align:center'>". $error['secondrat']. "</p>
                            </div><br>";
                    }
                ?>      
                <label for="secondrat"> Second Rat's Name </label>
                <select name="secondrat" id="secondrat" autocomplete="on">
                <option value="-">-</option>
                <?php 
                    while($sec_row = mysqli_fetch_array($first_row)){
                        echo " <option value='". $sec_row['rat_name'] . "'>". $sec_row['rat_name']. "</option>";
                    }
                ?>
                </select>

                <label for="secondratodds"> Second Rat's Odds </label>
                <input type="number" step="0.01" id="secondratodds" name="secondratodds"
                    placeholder="Odds..">

                <label for="matchDate">Match Date </label>
                <input type="date" id="matchDate" name="matchDate" placeholder="">

                <label for="matchTime">Match Hour </label>
                <input type="time" id="matchTime" name="matchTime" placeholder="">

                <?php  
                if(isset($error['password'])){
					echo "<div>
							<p style=' padding: 10px 0px; border-radius:1vh; background-color:red; text-align:center'>". $error['password']. "</p>
						 </div>";
                }
                 ?><br>
                <input type="password" id="pass" name="password"
                    placeholder="Super admin password to confirm your match..">

                <input type="submit" value="Add a new match">
            </form>
        </main>
    </div>
</body>