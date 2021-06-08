<?php  session_start();?>
<?php 
    include "includes/db_connection.php";
    
    $ratname;
    $birthDate;
    $description;
    $last_five_matches;
    $birthPlace;
    $gender;
    $club;

    if(isset($_GET['name'])){ 

        $name = $_GET['name'];
        $query = "SELECT * FROM rat WHERE rat_name LIKE('$name')";
        $select_all_posts_query = mysqli_query($connection, $query);
        if(!$select_all_posts_query){
            die("QUERY FAILED " . mysqli_error($connection));
        }
        $row = mysqli_fetch_assoc($select_all_posts_query);

        $ratname             = $row['rat_name'];
        $birthDate           = $row['birthday'];
        $description         = $row['description'];
        $last_five_matches	 = $row['last_five_matches'];
        $birthPlace          = $row['birth_place'];
        $gender              = $row['gender'];
        $club                = $row['club'];

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
                Rat Profile
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