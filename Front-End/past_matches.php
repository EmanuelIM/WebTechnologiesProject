<?php 
    include "includes/db_connection.php";
    session_start();

    if(!isset($_SESSION['username'])){
        header("Location: landing_page.html");
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
                Dashboard
            </h2>
            <div class="search-wrapper">
                <span class="las la-search">
                    <input type="search" placeholder="Search a match here" name="" id="">
                </span>
            </div>
            <div class="user-wrapper">
                <img src="images/RatMan.png" width="30px" height="30px" alt="">
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
                        <h1>6</h1>
                        <span>Matches Today</span>
                    </div>
                    <div>
                        <span class="las la-bullhorn"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1>2</h1>
                        <span>Ongoing matches</span>
                    </div>
                    <div>
                        <span class="las la-broadcast-tower"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1>1</h1>
                        <span>Match(es) you have betted on (today)</span>
                    </div>
                    <div>
                        <span class="las la-donate"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1>$17.01</h1>
                        <span>Your current balance</span>
                    </div>
                    <div>
                        <span class="las la-money-bill"></span>
                    </div>
                </div>
            </div>
            <div class="recent-grid">
                <div class="projects">
                <a href="index.php" class="button button3"> Today's Matches</a>
                <a href="future_matches.php" class="button button2"> Future Matches</a>
                    <div class="card">
                        <div class="card-header">
                            <h3>All Past Matches</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <td>Match</td>
                                            <td style="padding-left: 3%">Date</td>
                                            <td style="padding-left: 2%;">Time</td>
                                            <td style="">Winner</td>
                                        </tr>
                                    </thead>

                                    <?php  
                                        $query = "SELECT * FROM matches";
                                        $select_comment_query = mysqli_query($connection, $query);
                                        if(!$select_comment_query){
                                            die('QUERY FAILED' . mysqli_error($connection));
                                        }
                                    ?>
                                    <tbody>

                                        <?php 
                                        date_default_timezone_set('Europe/Bucharest');
                                        $date = date('Y-m-d');
                                            while($row = mysqli_fetch_array($select_comment_query)){
                                                if($row['date'] < $date){
                                                echo "<tr>";
                                                echo "<td><a href='ratProfile.php?name=".$row['first_rat']."'>". $row['first_rat']  ."</a> vs <a href='ratProfile.php?name=".$row['second_rat']."'>". $row['second_rat']  ."</a></td>";
                                               
                                            echo "<td>".$row['date']."</td>";
                                            echo "<td>".$row['time']."</td>";
                                            echo "<td>Ionut</td>";
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
                
                </div>
            </div>
        </main>
    </div>
    <script src="js/makeMaches.js"></script>
</body>

</html>