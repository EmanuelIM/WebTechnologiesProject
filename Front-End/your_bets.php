<?php  session_start();?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="css/user_profile_style.css">
    <link rel="stylesheet" href="css/bet_style.css">
    <title>Your Bets</title>
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
                <li><a href="your_bets.php" class="active"><span class="las la-clipboard-list"></span>
                        <span>Your Bets</span></a>
                </li>
                <li><a href="ratProfile.php"><span class="las la-id-badge"></span>
                        <span>Rat Profile (For demo purposes)</span></a>
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
            <h2>John Doe, you can find your bet history below</h2>
            <br>
            (written in bold are the rats you betted on)
            <table id="bets">
                <caption>Ongoing tickets</caption>
                <tr>
                    <th>Matches</th>
                    <th>Number of Matches on Ticket</th>
                    <th>Your sum of money</th>
                    <th>Estimated Winnings</th>
                    <th>Date and time of the match(es)</th>
                </tr>
                <tr>
                    <td>Jeppy vs <b>Sydney</b>
                        <br>
                        Carmine vs <b>Mac Daddy</b>
                    <td>2</td>
                    <td>43.00$</td>
                    <td>221.45$</td>
                    <td>14/04/2021 ; 14:45 <br>
                        16/04/2021 ; 18:05</td>
                </tr>
                <tr>
                    <td><b>Bubba</b> vs Cheeky Chops
                    </td>
                    <td>1</td>
                    <td>15.00$</td>
                    <td>18.00$</td>
                    <td>17/04/2021 ; 16:45</td>
                </tr>
            </table>
            <br>
            <table id="bets">
                <caption>Finished tickets </caption>
                <tr>
                    <th>Matches</th>
                    <th>Number of Matches on Ticket</th>
                    <th>Matches betted on correctly</th>
                    <th>Your sum of money</th>
                    <th>Estimated Winnings</th>
                    <th>Date and time of the match(es)</th>
                    <th>Outcome</th>
                </tr>
                <tr>
                    <td>Einstein vs <b>Rex</b>
                        <br>
                        <b>Tuxedo </b> vs Kronk
                        <br>
                        <b>Dame </b> vs Ned
                    </td>
                    <td>3</td>
                    <td>2/3</td>
                    <td>14.00$</td>
                    <td>141.91$</td>
                    <td>11/04/2021 ; 12:45 <br>
                        12/04/2021 ; 18:05
                        <br>
                        12/04/2021 ; 19:45
                    </td>
                    <td style=" color:red;">FAILED</td>
                </tr>
                <tr>
                    <td><b>Hammie</b> vs Sydney
                    </td>
                    <td>1</td>
                    <td>0/1</td>
                    <td>3.00$</td>
                    <td>6.00$</td>
                    <td>04/04/2021 ; 12:45</td>
                    <td style=" color:red">FAILED</td>
                </tr>
                <tr>
                    <td>Einstein vs <b>Tony</b>
                    </td>
                    <td>1</td>
                    <td>1/1</td>
                    <td>50.00$</td>
                    <td>225.00$</td>
                    <td>15/03/2021 ; 13:00</td>
                    <td style=" color:lightgreen">WINNER</td>
                </tr>
            </table>
        </main>
    </div>
</body>