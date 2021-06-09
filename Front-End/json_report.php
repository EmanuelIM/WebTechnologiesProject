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

$query_tickets = "SELECT * FROM tickets WHERE user_id = " . $id . "";
$select_tickets_query = mysqli_query($connection, $query_tickets);
header('Content-Type: application/json');
header('Content-Disposition: attachment; filename="bet_report.json"');

$response = array();
$posts = array();
while($row=mysqli_fetch_array($select_tickets_query)) { 
  $json_id = $row['id'];
  $json_money = $row['money_betted'];
  $json_total = $row['total_money'];
  $json_elev = $row['total_elevation'];
  $json_matches = $row['total_matches'];
  $json_withdrawed = $row['withdrawed'];

  $posts[] = array('id'=> $json_id, 'money_betted'=> $json_money, 'potentialProfit'=> $json_total, 'elevation'=> $json_elev, 'matches'=> $json_matches, 'withdrawed'=> $json_withdrawed);
} 

$response['bets'] = $posts;

$fp = fopen('php://output', 'wb');
fwrite($fp, json_encode($response));
fclose($fp);
