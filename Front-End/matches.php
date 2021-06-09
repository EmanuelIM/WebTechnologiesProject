<?php  

    include "includes/db_connection.php";

    $date = date("Y/m/d") ;
    if(isset($_GET['date'])){
        $date = $_GET['date'];
        $query = "SELECT * FROM matches WHERE date = '{$date}'";
        $select_matches_query = mysqli_query($connection, $query);

        echo " <div class='card-body'>
                    <div class='table-responsive'>
                        <table width='100%'>
                            <thead>
                                <tr>
                                    <td>Match</td>
                                    <td style='padding-left: 3%'>Date</td>
                                    <td style='padding-left: 2%;'>Time</td>
                                    <td style=''>Winner</td>
                                </tr>
                            </thead>
                            <tbody>";
                           
    
        while ($row = mysqli_fetch_array($select_matches_query)) {
            echo "<tr>";
            echo "<td><a href='ratProfile.php?name=".$row['first_rat']."'>". $row['first_rat']  ."</a> vs <a href='ratProfile.php?name=".$row['second_rat']."'>". $row['second_rat']  ."</a></td>";
            echo "<td>".$row['date']."</td>";
            echo "<td>".$row['time']."</td>";
            echo "<td>".$row['rat_winner']."</td>";
            echo "</tr>";
        }

        echo " </tbody>
                </table>
                </div>
            </div>";
    }
