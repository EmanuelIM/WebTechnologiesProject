<?php
include "includes/db_connection.php";
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: landing_page.html");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
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
                if ($_SESSION['role'] == 'admin') {
                    echo " <li><a href='add_rat.php'><span class='las la-id-badge'></span>
                        <span>Add Rat (admin only)</span></a>
                        </li>
                        <li><a href='create_bet.php'><span class='las la-caret-right'></span>
                                <span>Add a match (admin only)</span></a>
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
                            while ($row = mysqli_fetch_array($select_comment_query)) {
                                $time = $row['time'];
                                $match_time = date("H:i:s", strtotime($time));
                                $match_end_time = date("H:i:s", strtotime($match_time . " + 15 minutes"));
                                if ($current_time >= $match_time && $current_time <= $match_end_time) {
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
                            <?php
                            $query = "SELECT money FROM users WHERE nickname = '" . $_SESSION['username'] . "'";
                            $select_comment_query = mysqli_query($connection, $query);
                            $money = 0;
                            while ($row = mysqli_fetch_array($select_comment_query)) {
                                $money = $row['money'];
                            }

                            echo $money;
                            ?>$</h1>
                        <span>Your current balance</span>
                    </div>
                    <div>
                        <span class="las la-money-bill"></span>
                    </div>
                </div>
            </div>
            <div class="recent-grid">
                <div class="projects">
                    <div style="padding-left:40%; padding-bottom:3%;">
                        <a href="index.php" class="button button3"> Today's Matches</a>
                    </div>
                    <div style="padding-bottom: 3vh; padding-left:30%">
                        <h1 style="padding-bottom: 3vh; padding-left:10%">Select a date</h1>
                        <?php
                        echo "<input type='date' id='date' style ='height: 7vh;' max ='" . $date . "'>" ?>

                        <input type="submit" class="button button3" onclick="imu()" value="Display matches">
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3>Past Matches from the chosen date..</h3>
                        </div>
                        <div id="result"></div>
                    </div>
                </div>

            </div>
    </div>
    </main>
    </div>
    <script type="text/javascript">
        let content = document.getElementById('result');

        function imu() {
            let date = document.getElementById('date').value;
            var XML = new XMLHttpRequest();
            XML.onreadystatechange = function() {
                if (XML.readyState == 4 && XML.status == 200) {
                    content.innerHTML = XML.responseText;
                }
            };
            XML.open('GET', 'matches.php?date=' + date, true);
            XML.send();

        }
    </script>
    <script src="js/makeMaches.js"></script>
</body>

</html>