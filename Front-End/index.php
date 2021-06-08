<?php 
    include "includes/db_connection.php";
    include "includes/functions.php";
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: landing_page.html");
    }
    $query = "SELECT money FROM users WHERE nickname = '".$_SESSION['username']."'";
    $select_comment_query = mysqli_query($connection, $query);
    $money = 0;
    while($row = mysqli_fetch_array($select_comment_query)){
        $money = $row['money'];
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $total_ammount = trim($_POST['totalMoney']);
        $ticket_value = trim($_POST['ticketValue']);
        $total_elevation = trim($_POST['totalElevation']);
        $total_matches = trim($_POST['totalMatches']);
        $buttons = trim($_POST['buttons']);
        preg_match_all('!\d+!', $buttons, $rat_id);

        $error = [
			'money' => ''
		 ];
        if($ticket_value > $money){
            $error['money'] = "You don't have enough money";
        }

        foreach ($error as $key => $value) {
			if(empty($value)){
				unset($error[$key]);
			}
		 }
		if(empty($error)){
            addticket($connection,getId($connection,$_SESSION['username']),$ticket_value,$total_ammount,$total_elevation,$total_matches);
            addMatchesTickest($connection,$rat_id);
            updateMoney($connection,getId($connection,$_SESSION['username']),$money-$ticket_value);
            header('Location: index.php');
            exit();
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
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/maketicket.css">
    <title>BetR! Dashboard</title>
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
                <li><a href="index.php" class="active"><span class="las la-igloo"></span>
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
                Dashboard
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
        <?php  
            if(isset($error['money'])){
					echo "<div>
                            <p style='height:4vh;border-radius:1vh; background-color:red; text-align:center; padding-top:1vh;'>". $error['money']. "</p>
						 </div>";
		    }
        ?>
            <div class="cards">
                <div class="card-single">
                    <div>
                        <h1>
                        <?php
                        date_default_timezone_set('Europe/Bucharest');
                        $date = date('Y-m-d');
                        $query = "SELECT * FROM matches WHERE date = '$date'";
                        $select_comment_query = mysqli_query($connection, $query);
                        
                        echo mysqli_num_rows($select_comment_query);
                        ?>
                    </h1>
                        <span>Matches Today</span>
                    </div>
                    <div>
                        <span class="las la-bullhorn"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1>
                        
                        <?php
                        date_default_timezone_set('Europe/Bucharest');
                        $date = date('Y-m-d');
                        $current_time = date("H:i:s");
                        
                        $query = "SELECT time FROM matches";
                        $select_comment_query = mysqli_query($connection, $query);
                        $matches_ongoing = 0;
                        while($row = mysqli_fetch_array($select_comment_query)){
                            $time = $row['time'];
                            $match_time = date("H:i:s",strtotime($time));
                            $match_end_time = date("H:i:s",strtotime($match_time . " + 15 minutes"));
                            if($current_time >= $match_time && $current_time <= $match_end_time){
                                $matches_ongoing += 1;
                            }
                        }

                        echo $matches_ongoing;
                    ?>
                    </h1>
                        <span>Ongoing matches</span>
                    </div>
                    <div>
                        <span class="las la-broadcast-tower"></span>
                    </div>
                </div>
                
                <div class="card-single">
                    <div>
                    
                        <h1>
                        <?php echo $money;?>$
                        </h1>
                        <span>Your current balance</span>
                    </div>
                    <div>
                        <span class="las la-money-bill"></span>
                    </div>
                </div>
            </div>
            <form action="" method="post" id="update-form" autocomplete="off">
                <div class="recent-grid">
                    <div class="projects">
                    <a href="past_matches.php" class="button button1"> Past Matches</a>
                        <div class="card">
                            <div class="card-header">
                                <h3>Today's and Future Matches</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table width="100%">
                                        <thead>
                                            <tr>
                                                <td>Match</td>
                                                <td style="padding-left:4%;">1</td>
                                                <td style="padding-left: 4%;">2</td>
                                                <td style="padding-left: 4%;">Date</td>
                                                <td style="padding-left: 12%;">Time</td>
                                            </tr>
                                        </thead>
                                        <?php  
                                            $query = "SELECT * FROM matches ORDER BY date,time ASC";
                                            $select_comment_query = mysqli_query($connection, $query);
                                            if(!$select_comment_query){
                                                die('QUERY FAILED' . mysqli_error($connection));
                                            }
                                        ?>
                                        <tbody>
                                        <?php 
                                        $button_number = 0;
                                            while($row = mysqli_fetch_array($select_comment_query)){
                                                if($row['date'] >= $date){
                                                echo "<tr>";
                                                echo "<td><a href='ratProfile.php?name=".$row['first_rat']."'>". $row['first_rat']  ."</a> vs <a href='ratProfile.php?name=".$row['second_rat']."'>". $row['second_rat']  ."</a></td>";
                                                $current_time = date("H:i:s");
                                                $time = $row['time'];
                                                $match_time = date("H:i:s",strtotime($time));
                                                $match_end_time = date("H:i:s",strtotime($match_time . " - 10 minutes"));
                                                $can_bet = 1;
                                                if($current_time >= $match_end_time && $date === $row['date']){
                                                        $can_bet = 0;
                                                 }
                                                if($can_bet == 0)
                                                {
                                                    echo  "<td><input class='largeBTN' type='button' style = 'background-color:#DB6060;' id='button".$button_number."' value=". $row['first_odds']  . " disabled='disable'></td>";
                                                    echo  "<td><input class='largeBTN' type='button' style = 'background-color:#DB6060;' id='button".$button_number."' value=". $row['first_odds']  . " disabled='disable'></td>";
                                                }
                                                else
                                                {
                                                    $button_number += 1;
                                                    echo  "<td><input class='largeBTN' type='button' id='button".$button_number."' value=". $row['first_odds']  . " onclick='resetButton2(".$button_number.")'></td>";
                                                    $button_number += 1;
                                                    echo  "<td><input class='largeBTN' type='button' id='button".$button_number."' value=". $row['second_odds']  . " onclick='resetButton1(".$button_number.")'></td>";
                                                }
                                                echo "<td>".$row['date']."</td>";
                                                echo "<td>".$row['time']."</td>";
                                                
                                                echo "</tr>";
                                                }
                                            }
                                            ?>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="customers">
                        <div class="card">
                            <div class="card-header">
                                <h3>Your ticket</h3>
                            </div>
                            <div class="card-body">
                                <div class="customer">
                                    <div class="info">
                                        <h2>Total elevation</h2>
                                    </div>
                                    <div class="contact">
                                        <h2>Total matches</h2>
                                    </div>
                                </div>
                                <div class="customer">
                                    <div class="info">
                                        <input class="borderOnClick" name="totalElevation" type="text" id="elev" value="0"
                                            style="text-align: center;"></input>
                                    </div>
                                    <div class="contact">
                                        <input class="borderOnClick" name="totalMatches" type="text" id="inc" value="0"
                                            style="text-align: center;"></input>
                                    </div>
                                </div>
                                <div>
                                    <h2 class="ammount">What are you willing to pay?</h2>
                                    <div>
                                        <input class="borderOnClick alignBtn" name="ticketValue" type="number" id="ticketValue"
                                            placeholder="Enter how much money do you want to bet...">
                                    </div>
                                </div>
                                <div style="padding-top: 10px;">
                                    <input class="placeBet" type="button" onclick="calculateMoney()"
                                        value="Calculate how much you will make">
                                </div>
                                <div>
                                    <h2 class="ammount">If everything goes your way, you will make..</h2>
                                    <div>
                                        <input class="borderOnClick alignBtn" name="totalMoney" id="totalMoney" value="0">
                                        <input name="buttons" id="buttons" value="" type="hidden">
                                    </div>
                                </div>
                                <div>
                                    <h2 class="ammount">Place your bet if you are happy with your rats!!</h2>
                                    <input type="submit" class="placeBet" id="submit" value="Place your bet!">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </main>
    </div>
    <script src="js/makeMaches.js"></script>
</body>

</html>