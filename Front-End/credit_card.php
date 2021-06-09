<?php

include "includes/db_connection.php";
include "includes/functions.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nickname      = $_SESSION['username'];
    $money         = trim($_POST['money_added']);


    addmoney($connection, $nickname, $money);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="css/user_profile_style.css">
    <link rel="stylesheet" href="css/credit_style.css">
    <title>Your Profile</title>
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
                <li><a href="credit_card.php" class="active"><span class="las la-wallet"></span>
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
                Add funds to your account
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
                <form method="post">
                    <label for="nameoncard">Name on Card</label>
                    <input type="text" id="nameoncard" name="nameoncard" placeholder="John D. Doe" required="required">
                    <label for="cardnumber">Credit card number</label>
                    <!-- Visa, MasterCard, American Express, Diners Club, Discover, and JCB cards: -->
                    <!-- Sample card: 4988438843884305 -->
                    <input type="text" id="cardnumber" name="cardnumber" placeholder="XXXX-XXXX-XXXX-XXXX" required="required" pattern="^(?:4[0-9]{12}(?:[0-9]{3})?|[25][1-7][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$">
                    <label for="expdate">Expiration Date</label>
                    <input type="month" id="expdate" name="expdate" required="required">
                    <label for="cvv">CVV</label>
                    <input type="text" id="cvv" name="cvv" placeholder="XXX" required="required" pattern="^[0-9]{3, 4}$">
                    <label for="money_added">Amount you want to add</label>
                    <input type="number" step="0.01" id="money_added" name="money_added" placeholder="$$$" required="required">
                    <input type="submit" value="Show me the money" class="btn">
                </form>
            </div>
        </div>

</body>