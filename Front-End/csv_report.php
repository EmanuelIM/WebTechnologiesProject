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
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="bet_report.csv"');
$j = 1;
$CSV = null;
$CSV[0] = array('TicketID', 'MoneyBetted', 'PotentialProfit', 'Elevation', 'MatchesOnTicket', 'Withdrawed');
while ($row = mysqli_fetch_array($select_tickets_query)) {
    $CSV[$j] = array($row['id'], $row['money_betted'], $row['total_money'], $row['total_elevation'], $row['total_matches'], $row['withdrawed']);
    $j = $j + 1;
}


$fp = fopen('php://output', 'wb');
foreach ($CSV as $line) {
    fputcsv($fp, $line, ',');
}
fclose($fp);
