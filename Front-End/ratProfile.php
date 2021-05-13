<?php 
    include "includes/db_connection.php";

    
    $query = "SELECT * FROM rat WHERE id = 5";
    $select_all_posts_query = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($select_all_posts_query);

    $ratname             = $row['name'];
    $birthDate           = $row['birthday'];
    $description         = $row['description'];
    $last_five_matches	 = $row['last_five_matches'];
    $birthPlace          = $row['birth_place'];
    $gender              = $row['gender'];
    $club                = $row['club'];
?>  

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="css/ratstyle.css">
    <link rel="stylesheet" href="css/user_profile_style.css">
    <title>Jean-Claude Van Damme's Statistics</title>
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
                <li><a href="index.html"><span class="las la-igloo"></span>
                        <span>Dashboard</span></a>
                </li>
                <li><a href="user_profile.html"><span class="las la-users"></span>
                        <span>User Profile Settings</span></a>
                </li>
                <li><a href="your_bets.html"><span class="las la-clipboard-list"></span>
                        <span>Your Bets</span></a>
                </li>
                <li><a href="create_bet.html"><span class="las la-caret-right"></span>
                        <span>Add a match (SA Only)</span></a>
                </li>
                <li><a href="ratProfile.html" class="active"><span class="las la-id-badge"></span>
                        <span>Rat Profile</span></a>
                </li>
                <li><a href="credit_card.html"><span class="las la-wallet"></span>
                        <span>Add Money</span></a>
                </li>
                <li><a href="add_rat.php"><span class="las la-id-badge"></span>
                    <span>Add Rat</span></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <header>
            <h2>
                <label for="nav-toggle">
                    <span class="las la-bars"></span>
                </label>
                Rat Profile
            </h2>
            <div class="user-wrapper">
                <img src="images/RatMan.png" width="30px" height="30px" alt="">
                <div>
                    <h4>John Doe</h4>
                    <small>Super Admin</small>
                </div>
            </div>
        </header>
        <main>
            <h1 style="text-align: center;"><?php echo $ratname ?></h1>
            <div class="ratAlign">
                <img src="images/RatMan.png" class="ratPicture" alt="">
            </div>


            <table id="bets">
                <caption>Last Five Matches</caption>
                <tr>
                    <td class="lose">L</td>
                    <td class="lose">L</td>
                    <td class="victory">W</td>
                    <td class="victory">W</td>
                    <td class="lose">L</td>
                </tr>
            </table>
            <div class="birth">
                <h2>Birth Place: <?php echo $birthPlace ?></h2>
                <h2>Birth Date : <?php echo $birthDate  ?></h2>
                <h2>Gender     : <?php echo $gender ?></h2>
                <h2>Club       : <?php echo $club ?></h2>
            </div>
            <div class="details">
                <h1>Short description:</h1>
                <p><?php echo $description ?></p>
            </div>
        </main>
    </div>
</body>