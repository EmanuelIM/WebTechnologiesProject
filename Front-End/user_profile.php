<?php session_start();
include "includes/db_connection.php";
include "includes/functions.php";
$query = "SELECT * FROM users WHERE nickname LIKE ('{$_SESSION['username']}')";
$select_user_query = mysqli_query($connection, $query);
if (!$select_user_query) {
    die('QUERY FAILED' . mysqli_error($connection));
}

$row = mysqli_fetch_assoc($select_user_query);

$username            = $row['nickname'];
$first_name          = $row['first_name'];
$second_name         = $row['second_name'];
$email               = $row['email'];
$password            = $row['password'];
$avatar_link         = $row['avatar_link'];



if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $new_username    = trim($_POST['username']);
    $new_email      = trim($_POST['email']);
    $new_first_name  = trim($_POST['firstname']);
    $new_second_name = trim($_POST['lastname']);
    $new_password = trim($_POST['new_password']);
    $new_password_r = trim($_POST['new_password_r']);
    $new_link       = trim($_POST['avatar_link']);

    $error = [
        'username' => '',
        'email' => '',
        'password' => ''
    ];

    if (strlen($new_username) < 4) {
        $error['username'] = 'Username needs to be longer';
    }
    if ($new_username == '') {
        $error['username'] = 'Username cannot be empty';
    }
    if ($new_username != $username && username_exists($new_username, $connection)) {
        $error['username'] = "Username already exists";
    }

    if ($new_email == '') {
        $error['email'] = "Email cannot be empty";
    }
    if ($email != $new_email && email_exists($new_email, $connection)) {
        $error['email'] = "Email already exists";
    }

    if ($new_password != '' && strlen($new_password) < 4) {
        $error['password'] = 'Password needs to be longer';
    }
    if ($new_password != $new_password_r) {
        $error['password'] = 'Passwords are not the same';
    }


    foreach ($error as $key => $value) {
        if (empty($value)) {
            unset($error[$key]);
        }
    }

    if (empty($error)) {
        if ($email != $new_email) {
            $email = $new_email;
        }
        if ($username != $new_username) {
            $username = $new_username;
        }
        if ($first_name != $new_first_name) {
            $first_name = $new_first_name;
        }
        if ($second_name != $new_second_name) {
            $second_name = $new_second_name;
        }
        if($avatar_link != $new_link){
            $avatar_link = $new_link;
        }
        if (!password_verify($new_password, $password) && $new_password != '') {
            $password = $new_password;
        }

        update_user($connection, $username, $email, $password, $first_name, $second_name, $_SESSION['username'],$avatar_link);
    }
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
                <li><a href="user_profile.php" class="active"><span class="las la-users"></span>
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
                if ($_SESSION['role'] == 'admin') {
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
        <?php
                echo "<img src='" . $_SESSION['avatar_link'] . "' width='100px' height='auto' alt='' style='float:left; align-items: center; border: 5px solid #555';>";
                ?>
            <h2>Hello, <?php echo $_SESSION['username'] ?>! (<?php echo $_SESSION['role'] ?>!)</h2>
            <br><br>
            <h3 style="padding-bottom: 30px;">Change your profile information below</h3>
            <form action="" method="post" id="update-form" autocomplete="off">

                <label for="firstname">First Name</label>
                <input type="text" id="fname" name="firstname" value="<?php echo $first_name ?>">
                <label for="lastname">Second Name</label>
                <input type="text" id="lname" name="lastname" value="<?php echo $second_name ?>">
                <label for="username">Username</label>
                <input type="link" id="username" name="username" value="<?php echo $username ?>">
                <label for="avatar_link">Avatar Link</label>
                <input type="link" id="avatar_link" name="avatar_link" value="<?php echo $avatar_link ?>">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo $email ?>">
                <label for="photo">Photo Link</label>
                <input type="link" id="photo" name="photo" placeholder="New avatar link..">
                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="new_password" placeholder="New password..">
                <label for="new_password_r">Repeat New Password</label>
                <input type="password" id="new_password_r" name="new_password_r" placeholder="Repeat Password">
                <input type="submit" value="Submit">
            </form>
        </main>
    </div>
</body>