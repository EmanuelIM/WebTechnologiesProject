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
  

?>