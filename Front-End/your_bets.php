  <?php
    include "includes/db_connection.php";
    include "includes/functions.php";
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: landing_page.html");
    }
    $query = "SELECT * FROM users WHERE nickname = '" . $_SESSION['username'] . "'";
    $select_comment_query = mysqli_query($connection, $query);
    $money = 0;
    $id = 0;
    while ($row = mysqli_fetch_array($select_comment_query)) {
        $money = $row['money'];
        $id = $row['id'];
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
        if ($ticket_value > $money) {
            $error['money'] = "You don't have enough money";
        }

        foreach ($error as $key => $value) {
            if (empty($value)) {
                unset($error[$key]);
            }
        }
        if (empty($error)) {
            addticket($connection, getId($connection, $_SESSION['username']), $ticket_value, $total_ammount, $total_elevation, $total_matches);
            addMatchesTickest($connection, $rat_id);
            updateMoney($connection, getId($connection, $_SESSION['username']), $money - $ticket_value);
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
      <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
      <link rel="stylesheet" href="css/user_profile_style.css">
      <link rel="stylesheet" href="css/bet_style.css">
      <link rel="stylesheet" href="css/dashboard.css">
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
                  <li><a href="index.php"><span class="las la-igloo"></span>
                          <span>Dashboard</span></a>
                  </li>
                  <li><a href="user_profile.php"><span class="las la-users"></span>
                          <span>User Profile Settings</span></a>
                  </li>
                  <li><a href="your_bets.php" class="active"><span class="las la-clipboard-list"></span>
                          <span>Your Bets</span></a>
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
              <h2><?php echo $_SESSION['username'] ?>, you can find your bet history below</h2>
              <br>
              (written in bold are the rats you betted on)
              <table id="bets">
                  <caption>All of your tickets</caption>
                  <tr>
                      <th>Matches and dates</th>
                      <th>Number of Matches on Ticket</th>
                      <th>Matches betted on correctly</th>
                      <th>Your sum of money</th>
                      <th>Estimated Winnings</th>
                      <th>Outcome</th>
                  </tr>
                  <?php


                    if ($id != 0) {
                        $query = "SELECT * FROM tickets WHERE user_id = '{$id}'";
                        $select_comment_query = mysqli_query($connection, $query);
                        if (!$select_comment_query) {
                            die('QUERY FAILED' . mysqli_error($connection));
                        }
                    }
                    ?>
                  <tbody>
                      <?php
                        if ($id != 0) {
                            error_reporting(E_ERROR);
                            $isDisplayed = 1;
                            while ($row = mysqli_fetch_array($select_comment_query)) {
                                $number_of_matches = 0;
                                $number_of_correct_matches = 0;
                                $ongoing = 0;
                                $query2 = "SELECT * FROM matches_tickets WHERE ticket_id = '{$row['id']}'";
                                $select_comment_query2 = mysqli_query($connection, $query2);
                                if (!$select_comment_query2) {
                                    die('QUERY FAILED' . mysqli_error($connection));
                                }
                                echo "<tr>";
                                echo "<td>";
                                while ($row2 = mysqli_fetch_array($select_comment_query2)) {

                                    $number_of_matches++;
                                    $query3 = "SELECT * FROM matches WHERE id = '{$row2['match_id']}'";
                                    $select_comment_query3 = mysqli_query($connection, $query3);
                                    if (!$select_comment_query3) {
                                        die('QUERY FAILED' . mysqli_error($connection));
                                    }
                                    $query4 = "SELECT * FROM rat WHERE rat_name = '{$row2['name_rat_betted']}'";
                                    $select_comment_query4 = mysqli_query($connection, $query4);
                                    if (!$select_comment_query4) {
                                        die('QUERY FAILED' . mysqli_error($connection));
                                    }
                                    $row3 = mysqli_fetch_array($select_comment_query4);

                                    $row4 = mysqli_fetch_array($select_comment_query3);
                                    if ($row2['name_rat_winner'] == '') {
                                        $ongoing = 1;
                                    } else if ($row2['name_rat_winner'] == $row4['rat_winner']) {
                                        $number_of_correct_matches++;
                                    }
                                    if ($row4['first_rat'] == $row2['name_rat_betted']) {
                                        echo "<b>" . $row4['first_rat'] . "</b> vs " . $row4['second_rat'] . "";
                                    } else {
                                        echo "" . $row4['first_rat'] . " vs <b>" . $row4['second_rat'] . "</b>";
                                    }
                                    echo "<br>";
                                    echo "(" . $row4['date'] . ";" . $row4['time'] . ")";
                                    echo "<br>";
                                }
                                echo "</td>";
                                echo "<td>" . $number_of_matches . " </td>";
                                echo "<td>" . $number_of_correct_matches . "/" . $number_of_matches . " </td>";
                                echo "<td>" . $row['money_betted'] . "$";
                                echo "<td>" . $row['total_money'] . "$";

                                if ($ongoing == 1) {
                                    echo "<td style=' color:gray;'>ONGOING</td>";
                                } else if ($number_of_matches === $number_of_correct_matches) {
                                    echo "<td style=' color:green;'>WINNER</td>";
                                    $queryf = "SELECT money FROM users WHERE nickname = '" . $_SESSION['username'] . "'";
                                    $select_comment_queryf = mysqli_query($connection, $queryf);
                                    $money = 0;
                                    while ($rowf = mysqli_fetch_array($select_comment_queryf)) {
                                        $money = $rowf['money'];
                                    }
                                    if ($row['withdrawed'] == 0) {
                                        if ($isDisplayed == 1) {
                                            echo "<br> <br> <h2> Congrats! You have winner tickets! Funds have been added to your account. Please check the dashboard for your money amount. </h2>";
                                            $isDisplayed = 0;
                                        }
                                        updateMoney($connection, getId($connection, $_SESSION['username']), $money + $row['total_money']);
                                        $withdraw_query = "UPDATE tickets SET withdrawed = 1 WHERE id = '{$row['id']}'";
                                        $update_status = mysqli_query($connection, $withdraw_query);
                                        if (!$update_status) {
                                            die("Query failed" . mysqli_error($connection));
                                        }
                                    }
                                } else {
                                    echo "<td style=' color:red;'>FAILED</td>";
                                }
                                echo "</tr>";
                            }
                            echo "</table>";
                        }
                        ?>

                      <div style="padding-left:40%; padding-top:3%;">
                          <a href="html_report.php" class="button button1"> HTML Report</a>
                      </div>
                      <div style="padding-left:40.5%; padding-top:1%;">
                          <a href="csv_report.php" class="button button1"> CSV Report</a>
                      </div>
                      <div style="padding-left:40.2%; padding-top:1%;">
                          <a href="json_report.php" class="button button1"> JSON Report</a>
                      </div>
          </main>
      </div>
  </body>