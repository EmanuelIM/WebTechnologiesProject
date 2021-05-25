<?php 

function register_user($connection,$username,$email,$password,$first_name,$second_name,$age,$country){
    $username   = mysqli_real_escape_string($connection, $username);
    $email      = mysqli_real_escape_string($connection, $email);
    $password   = mysqli_real_escape_string($connection, $password);
    $first_name  = mysqli_real_escape_string($connection, $first_name);
    $second_name = mysqli_real_escape_string($connection, $second_name);
    $age  = mysqli_real_escape_string($connection, $age);
    $country = mysqli_real_escape_string($connection, $country);
    $tmp_pass = $password;
    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

    $query = "INSERT INTO users (first_name, second_name, country, email, password, age, nickname,role)";
    $query .= "VALUES('{$first_name}', '{$second_name}', '{$country}', '{$email}', '{$password}', '{$age}', '{$username}','user')";
    $register_user_query = mysqli_query($connection, $query);

    if(!$register_user_query ){
        die("Query failed" . mysqli_error($connection));
    }else{
        login_user($username,$tmp_pass,$connection);
        exit();
    }
}

function email_exists($email,$connection){
    $query = "SELECT email FROM users WHERE email = '$email'";
    $result = mysqli_query($connection, $query);
  
    if(mysqli_num_rows($result) > 0){
      return true;
    }else{
      return false;
    }
  }

  function username_exists($username,$connection){
    $query = "SELECT nickname FROM users WHERE nickname = '$username'";
    $result = mysqli_query($connection, $query);
  
    if(mysqli_num_rows($result) > 0){
      return true;
    }else{
      return false;
    }
  }
  
  function rat_exists($rat_name,$connection){
    $query = "SELECT name FROM rat WHERE name = '$rat_name'";
    $result = mysqli_query($connection, $query);
  
    if(mysqli_num_rows($result) > 0){
      return true;
    }else{
      return false;
    }
  }

  function addrat($connection,$rat_name,$birthday,$description,$birthPlace,$gender,$club){
    $rat_name   = mysqli_real_escape_string($connection, $rat_name);
    $birthday   = mysqli_real_escape_string($connection, $birthday);
    $description= mysqli_real_escape_string($connection, $description);
    $birthPlace = mysqli_real_escape_string($connection, $birthPlace);
    $gender     = mysqli_real_escape_string($connection, $gender);
    $club       = mysqli_real_escape_string($connection, $club);

    $query = "INSERT INTO rat (rat_name, birthday, description, birth_place, gender, club)";
    $query .= "VALUES('{$rat_name}', '{$birthday}', '{$description}', '{$birthPlace}', '{$gender}', '{$club}')";
    $register_user_query = mysqli_query($connection, $query);
    if(!$register_user_query ){
        die("Query failed" . mysqli_error($connection));
    }else{
        header('Location: index.php');
        exit();
    }
  }

  function  addbet($connection,$firstrat,$secondrat,$firstodds,$secondodds){
    $firstrat   = mysqli_real_escape_string($connection, $firstrat);
    $secondrat   = mysqli_real_escape_string($connection, $secondrat);
    $firstodds= mysqli_real_escape_string($connection, $firstodds);
    $secondodds = mysqli_real_escape_string($connection, $secondodds);

    $query = "INSERT INTO matches (first_rat, second_rat, first_odds,	second_odds)";
    $query .= "VALUES('{$firstrat}', '{$secondrat}', '{$firstodds}', '{$secondodds}')";
    $register_user_query = mysqli_query($connection, $query);
    if(!$register_user_query ){
        die("Query failed" . mysqli_error($connection));
    }else{
        header('Location: index.php');
        exit();
    }
  }

  function login_user($username, $password,$connection){
     
      $username = trim($username);
      $password = trim($password);
         
         
      $username = mysqli_real_escape_string($connection, $username);
      $password = mysqli_real_escape_string($connection, $password);
         
         $query = "SELECT * FROM users WHERE nickname = '{$username}'";
         $select_user_query = mysqli_query($connection, $query);
         if(!$select_user_query){
             die ("Query failed " . mysqli_error($connection));
         }

      while($row = mysqli_fetch_array($select_user_query)){
          $db_user_firstname= $row['first_name'];
          $db_user_lastname = $row['second_name'];
          $db_user_role = $row['role'];
          $db_username = $row['nickname'];
          $db_user_password = $row['password'];
      }

      if(password_verify($password, $db_user_password)){
          $_SESSION['username'] = $db_username;
          $_SESSION['firstname'] = $db_user_firstname;
          $_SESSION['lastname'] = $db_user_lastname;
          $_SESSION['role'] = $db_user_role;
          header("Location: index.php");
        }else{
          header("Location: landing_page.html");
        }
}

?>