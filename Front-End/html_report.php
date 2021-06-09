<?php  session_start();?>
<?php 
    include "includes/db_connection.php";
    $total_money_betted = 0;
    $username = $_SESSION['username'];
?>  


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/landing_style.css">
    <link rel="stylesheet" href="css/report.css"> 
    <title>Document</title>
</head>
<body>
        <ul>
            <a href="index.php">
                <li>Dashboard</li>
            </a>
            <a href="user_profile.php">
                <li>Profile</li>
            </a>
            <a href="scholarly_report.html">
                <li>PROJECT REPORT</li>
            </a>
            <li style="float:right"><a href="landing_page.html"><img class="resize" src="images/logo.png"></a></li>
        </ul>
        <h1>This is your report, <?php  echo $username ?></h1>
        <div class="table_padding">
            <table>
                <tr>
                    <th>Ticket Id</th>
                    <th>Money betted</th>
                    <th>Total Money to Win</th>
                    <th>Total elevation</th>
                    <th>Number of matches you betted on</th>
                    <th>Withdrawed</th>
                </tr>
                <?php   
                    $query = "SELECT * FROM users WHERE nickname = '" . $_SESSION['username'] . "'";
                    $select_user_query = mysqli_query($connection, $query);
                    $id = 0;
                    
                    while ($row = mysqli_fetch_array($select_user_query)) {
                        $id = $row['id'];
                    }


                    $query_tickets = "SELECT * FROM tickets WHERE user_id = " . $id . "";
                    $select_tickets_query = mysqli_query($connection, $query_tickets);
                    while ($row = mysqli_fetch_array($select_tickets_query)) {
                        echo "<tr>";
                        echo "<th> " . $row['id'] ."</th>";
                        echo "<th> " . $row['money_betted'] ."</th>";
                        echo "<th> " . $row['total_money'] ."</th>";
                        echo "<th> " . $row['total_elevation'] ."</th>";
                        echo "<th> " . $row['total_matches'] ."</th>";
                        if($row['withdrawed'] == 0){
                            echo "<th>True</th>";
                        }else{
                            echo "<th>False</th>";
                        }
                        echo "</tr>";
                        $total_money_betted += $row['money_betted'];
                    }
                ?>
            
            </table>
        </div>
        <h1>Congratulation, you betted <?php echo $total_money_betted?> $</h1>
</body>
</html>