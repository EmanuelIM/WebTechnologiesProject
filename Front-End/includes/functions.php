<?php
function register_user($connection, $username, $email, $password, $first_name, $second_name, $age, $country, $avatar_link)
{
  $username   = mysqli_real_escape_string($connection, $username);
  $email      = mysqli_real_escape_string($connection, $email);
  $password   = mysqli_real_escape_string($connection, $password);
  $first_name  = mysqli_real_escape_string($connection, $first_name);
  $second_name = mysqli_real_escape_string($connection, $second_name);
  $age  = mysqli_real_escape_string($connection, $age);
  $avatar_link = mysqli_real_escape_string($connection, $avatar_link);
  $country = mysqli_real_escape_string($connection, $country);
  $tmp_pass = $password;
  $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

  $query = "INSERT INTO users (first_name, second_name, country, email, password, age, nickname,role,avatar_link)";
  $query .= "VALUES('{$first_name}', '{$second_name}', '{$country}', '{$email}', '{$password}', '{$age}', '{$username}','user','{$avatar_link}')";
  $register_user_query = mysqli_query($connection, $query);

  if (!$register_user_query) {
    die("Query failed" . mysqli_error($connection));
  } else {
    login_user($username, $tmp_pass, $connection);
    exit();
  }
}

function email_exists($email, $connection)
{
  $query = "SELECT email FROM users WHERE email = '$email'";
  $result = mysqli_query($connection, $query);

  if (mysqli_num_rows($result) > 0) {
    return true;
  } else {
    return false;
  }
}

function username_exists($username, $connection)
{
  $query = "SELECT nickname FROM users WHERE nickname = '$username'";
  $result = mysqli_query($connection, $query);

  if (mysqli_num_rows($result) > 0) {
    return true;
  } else {
    return false;
  }
}

function rat_exists($rat_name, $connection)
{
  $query = "SELECT rat_name FROM rat WHERE rat_name = '$rat_name'";
  $result = mysqli_query($connection, $query);

  if (mysqli_num_rows($result) > 0) {
    return true;
  } else {
    return false;
  }
}

function addrat($connection, $rat_name, $birthday, $description, $birthPlace, $gender, $club, $photoLink)
{
  $rat_name   = mysqli_real_escape_string($connection, $rat_name);
  $birthday   = mysqli_real_escape_string($connection, $birthday);
  $description = mysqli_real_escape_string($connection, $description);
  $birthPlace = mysqli_real_escape_string($connection, $birthPlace);
  $gender     = mysqli_real_escape_string($connection, $gender);
  $club       = mysqli_real_escape_string($connection, $club);
  $photoLink       = mysqli_real_escape_string($connection, $photoLink);

  $query = "INSERT INTO rat (rat_name, birthday, description, birth_place, gender, club,photo_link)";
  $query .= "VALUES('{$rat_name}', '{$birthday}', '{$description}', '{$birthPlace}', '{$gender}', '{$club}', '{$photoLink}')";
  $register_user_query = mysqli_query($connection, $query);
  if (!$register_user_query) {
    die("Query failed" . mysqli_error($connection));
  } else {
    header('Location: index.php');
    exit();
  }
}

function determineWinner($connection)
{
  $query  = "SELECT * FROM matches WHERE flag = 0";
  $select_matches_query = mysqli_query($connection, $query);
  while ($row = mysqli_fetch_array($select_matches_query)) {
    if ($row['date'] < date('Y-m-d') || ($row['time'] < date("H:i:s") && $row['date'] == date('Y-m-d'))) {
      $number = rand(1, 2);
      $query_update = "UPDATE matches SET flag = 1, ";
      if ($number == 1) {
        $rat_name = $row['first_rat'];
        $loser_name = $row['second_rat'];
      } else {
        $rat_name = $row['second_rat'];
        $loser_name = $row['first_rat'];
      }
      $query_update .= "rat_winner = '{$rat_name}' ";
      $query_update .= "WHERE id = '{$row['id']}'";
      $update_match = mysqli_query($connection, $query_update);
      if (!$update_match) {
        die("Query failed" . mysqli_error($connection));
      }

      $query_update_match = "UPDATE matches_tickets SET ended = 1, ";
      $query_update_match .= "name_rat_winner = '{$rat_name}' ";
      $query_update_match .= "WHERE match_id = '{$row['id']}'";
      $update_match_tickets = mysqli_query($connection, $query_update_match);
      if (!$update_match_tickets) {
        die("Query failed" . mysqli_error($connection));
      }
      modifyLastMatches($connection, $rat_name, $loser_name);
    }
  }
}

function modifyLastMatches($connection, $rat_name, $loser_name)
{
  $last_matches_winner = "SELECT * FROM rat WHERE rat_name = '{$rat_name}'";
  $last_matches_loser = "SELECT * FROM rat WHERE rat_name = '{$loser_name}'";
  $query_get_matches_1 = mysqli_query($connection, $last_matches_winner);
  $query_get_matches_2 = mysqli_query($connection, $last_matches_loser);
  while ($row = mysqli_fetch_array($query_get_matches_1)) {
    $last_five_matches = $row['last_five_matches'];
    $len = strlen($last_five_matches);
    if ($len < 5) {
      if ($len == 0) {
        $last_five_matches = "W";
      } else {
        $last_five_matches .= "W";
      }
    } else {
      for ($i = 1; $i < $len; ++$i) {
        $last_five_matches[$i - 1] = $last_five_matches[$i];
      }
      $last_five_matches[4] = 'W';
    }
    $query_update_first_rat = "UPDATE rat SET last_five_matches = '{$last_five_matches}' where rat_name ='{$rat_name}' ";
    $update_first_rat = mysqli_query($connection, $query_update_first_rat);
    if (!$update_first_rat) {
      die("Query failed" . mysqli_error($connection));
    }
  }
  while ($row1 = mysqli_fetch_array($query_get_matches_2)) {
    $last_five_matches1 = $row1['last_five_matches'];
    $len1 = strlen($last_five_matches1);
    if ($len1 < 5) {
      if ($len == 0) {
        $last_five_matches1 = "L";
      } else {
        $last_five_matches1 .= "L";
      }
    } else {
      for ($i = 1; $i < $len1; ++$i) {
        $last_five_matches1[$i - 1] = $last_five_matches1[$i];
      }
      $last_five_matches1[4] = 'L';
    }
    $query_update_second_rat = "UPDATE rat SET last_five_matches = '{$last_five_matches1}' where rat_name ='{$loser_name}' ";
    $update_second_rat = mysqli_query($connection, $query_update_second_rat);
    if (!$update_second_rat) {
      die("Query failed" . mysqli_error($connection));
    }
  }
}

function  addbet($connection, $firstrat, $secondrat, $firstodds, $secondodds, $date, $time)
{
  $firstrat   = mysqli_real_escape_string($connection, $firstrat);
  $secondrat   = mysqli_real_escape_string($connection, $secondrat);
  $firstodds = mysqli_real_escape_string($connection, $firstodds);
  $secondodds = mysqli_real_escape_string($connection, $secondodds);
  $date = mysqli_real_escape_string($connection, $date);
  $time = mysqli_real_escape_string($connection, $time);

  $query = "INSERT INTO matches (first_rat, second_rat, first_odds,	second_odds, date, time)";
  $query .= "VALUES('{$firstrat}', '{$secondrat}', '{$firstodds}', '{$secondodds}', '{$date}', '{$time}')";
  $register_user_query = mysqli_query($connection, $query);
  if (!$register_user_query) {
    die("Query failed" . mysqli_error($connection));
  } else {
    header('Location: index.php');
    exit();
  }
}

function  addmoney($connection, $nickname, $money)
{
  $nickname = mysqli_real_escape_string($connection, $nickname);
  $money = mysqli_real_escape_string($connection, $money);

  $query = "UPDATE users SET money = money + '{$money}' WHERE nickname = '{$nickname}'";
  $register_user_query = mysqli_query($connection, $query);
  if (!$register_user_query) {
    die("Query failed" . mysqli_error($connection));
  } else {
    header('Location: index.php');
    exit();
  }
}

function login_user($username, $password, $connection)
{

  $username = trim($username);
  $password = trim($password);


  $username = mysqli_real_escape_string($connection, $username);
  $password = mysqli_real_escape_string($connection, $password);

  $query = "SELECT * FROM users WHERE nickname = '{$username}'";
  $select_user_query = mysqli_query($connection, $query);
  if (!$select_user_query) {
    die("Query failed " . mysqli_error($connection));
  }

  while ($row = mysqli_fetch_array($select_user_query)) {
    $db_user_firstname = $row['first_name'];
    $db_user_lastname = $row['second_name'];
    $db_user_role = $row['role'];
    $db_username = $row['nickname'];
    $db_user_password = $row['password'];
    $avatar_link = $row['avatar_link'];
    $money = $row['money'];
    $user_id = $row['id'];
  }

  if (password_verify($password, $db_user_password)) {
    $_SESSION['username'] = $db_username;
    $_SESSION['firstname'] = $db_user_firstname;
    $_SESSION['lastname'] = $db_user_lastname;
    $_SESSION['role'] = $db_user_role;
    $_SESSION['avatar_link'] = $avatar_link;
    $_SESSION['user_id'] = $user_id;
    $_SESSION['money'] = $money;
    header("Location: index.php");
  } else {
    header("Location: landing_page.html");
  }
}

function getId($connection, $username)
{
  $query = "SELECT * FROM users WHERE nickname LIKE('{$username}')";
  $select_user_query = mysqli_query($connection, $query);
  $id_user = 0;
  while ($row = mysqli_fetch_array($select_user_query)) {
    $id_user = $row['id'];
  }
  return $id_user;
}

function update_user($connection, $username, $email, $password, $first_name, $second_name, $username_update, $avatar_link)
{
  $username   = mysqli_real_escape_string($connection, $username);
  $email      = mysqli_real_escape_string($connection, $email);
  $password   = mysqli_real_escape_string($connection, $password);
  $first_name  = mysqli_real_escape_string($connection, $first_name);
  $second_name = mysqli_real_escape_string($connection, $second_name);
  $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
  $username_update = mysqli_real_escape_string($connection, $username_update);
  $avatar_link = mysqli_real_escape_string($connection, $avatar_link);

  $query = "UPDATE users SET ";
  $query .= "first_name = '{$first_name}', ";
  $query .= "second_name = '{$second_name}', ";
  $query .= "email = '{$email}', ";
  $query .= "password = '{$password}', ";
  $query .= "nickname = '{$username}', ";
  $query .= "avatar_link = '{$avatar_link}' ";
  $query .= "WHERE nickname LIKE('{$username_update}')";

  $update_user = mysqli_query($connection, $query);
  if (!$update_user) {
    die("Query failed" . mysqli_error($connection));
  } else {
    $_SESSION['username'] = $username;
    $_SESSION['firstname'] = $first_name;
    $_SESSION['lastname'] = $second_name;
    $_SESSION['avatar_link'] = $avatar_link;
    header('Location: index.php');
    exit();
  }
}

function  addticket($connection, $user_id, $money_betted, $total_money, $total_elevation, $total_matches)
{
  $user_id   = mysqli_real_escape_string($connection, $user_id);
  $money_betted   = mysqli_real_escape_string($connection, $money_betted);
  $total_money   = mysqli_real_escape_string($connection, $total_money);
  $total_elevation   = mysqli_real_escape_string($connection, $total_elevation);
  $total_matches   = mysqli_real_escape_string($connection, $total_matches);
  $query = "INSERT INTO tickets (user_id, money_betted,total_money, total_elevation, total_matches)";
  $query .= "VALUES('{$user_id}', '{$money_betted}', '{$total_money}', '{$total_elevation}', '{$total_matches}')";
  $add_ticket_query = mysqli_query($connection, $query);
  if (!$add_ticket_query) {
    die("Query failed" . mysqli_error($connection));
  }
}

function  addMatchTicket($connection, $id_ticket, $match_id, $name_rat_betted)
{
  $id_ticket   = mysqli_real_escape_string($connection, $id_ticket);
  $match_id   = mysqli_real_escape_string($connection, $match_id);
  $name_rat_betted   = mysqli_real_escape_string($connection, $name_rat_betted);
  $query = "INSERT INTO matches_tickets (ticket_id, match_id,name_rat_betted)";
  $query .= "VALUES('{$id_ticket}', '{$match_id}', '{$name_rat_betted}')";
  $add_match_query = mysqli_query($connection, $query);
  if (!$add_match_query) {
    die("Query failed" . mysqli_error($connection));
  }
}

function getTicketId($connection, $user_id)
{
  $query = "SELECT * FROM tickets WHERE user_id = '{$user_id}'";
  $get_matches_query = mysqli_query($connection, $query);
  $id_ticket = 0;
  while ($row = mysqli_fetch_array($get_matches_query)) {
    $id_ticket = $row['id'];
  }
  return $id_ticket;
}

function addMatchesTickest($connection, $rat_id)
{
  $id_ticket = getTicketId($connection, getId($connection, $_SESSION['username']));
  date_default_timezone_set('Europe/Bucharest');
  $date = date('Y-m-d');
  $current_time = date("H:i:s");
  for ($i = 0; $i < count($rat_id[0]); $i++) {
    $query = "SELECT * FROM matches WHERE flag =0 ORDER BY date,time ASC";
    $select_matches_query = mysqli_query($connection, $query);
    $tmp_count = 1;
    while ($tmp_count <= $rat_id[0][$i] && $row = mysqli_fetch_array($select_matches_query)) {
      $time = $row['time'];
      $match_time = date("H:i:s", strtotime($time));
      $match_end_time = date("H:i:s", strtotime($match_time . " - 10 minutes"));
      if ($current_time < $match_end_time || ($current_time > $match_end_time &&  $date < $row['date'])) {
        if ($tmp_count == $rat_id[0][$i]) {
          addMatchTicket($connection, $id_ticket, $row['id'], $row['first_rat']);
        }
        $tmp_count++;
        if ($tmp_count == $rat_id[0][$i]) {
          addMatchTicket($connection, $id_ticket, $row['id'], $row['second_rat']);
        }
        $tmp_count++;
      }
    }
  }
}

function updateMoney($connection, $id_user, $money)
{
  $query = "UPDATE users SET ";
  $query .= "money = '{$money}' ";
  $query .= "WHERE id = '{$id_user}'";
  $update_user = mysqli_query($connection, $query);
  if (!$update_user) {
    die("Query failed" . mysqli_error($connection));
  }
}
