<?php 

function register_user($connection,$username,$email,$password,$first_name,$second_name,$age,$country){
    $username   = mysqli_real_escape_string($connection, $username);
    $email      = mysqli_real_escape_string($connection, $email);
    $password   = mysqli_real_escape_string($connection, $password);
    $first_name  = mysqli_real_escape_string($connection, $first_name);
    $second_name = mysqli_real_escape_string($connection, $second_name);
    $age  = mysqli_real_escape_string($connection, $age);
    $country = mysqli_real_escape_string($connection, $country);

    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

    $query = "INSERT INTO users (first_name, second_name, country, email, password, age, nickname)";
    $query .= "VALUES('{$first_name}', '{$second_name}', '{$country}', '{$email}', '{$password}', '{$age}', '{$username}')";
    $register_user_query = mysqli_query($connection, $query);

    if(!$register_user_query ){
        die("Query failed" . mysqli_error($connection));
    }else{
        header('Location: index.php');
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

?>