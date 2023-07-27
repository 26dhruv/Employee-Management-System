<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Panel</title>
    <!-- css link -->
    <link rel="stylesheet" href="./Template.css">
    <link rel="stylesheet" href="./Dashboard.css">
    <!-- font link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500&display=swap" rel="stylesheet">
    <!-- icon link -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="icon" href="../Pictures/favicon.ico" type="image/x-icon">
</head>

<body>
    <?php
    session_start();
    include "./Config.php";
    $u_id = $_SESSION['u_id'];
    if (!$_SESSION['Logged_in'] || $_SESSION['u_role_id'] != 2) {

        header("Location: ../LoginPage.php");
        exit;
    }

    ?>

    <div class="main">
        <h1>Dashboard</h1>
        <div class="navbar">
            <h2>Employee</h2>
            <a href="logout.php"> <button name="Logout" id="Logout" value="Logout" onclick="<?php $_SESSION = false; ?>">Logout</button></a>
            <div class="notif">
                <button onclick="togglePopup()">
                    <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M20 17h2v2H2v-2h2v-7a8 8 0 1 1 16 0v7zm-2 0v-7a6 6 0 1 0-12 0v7h12zm-9 4h6v2H9v-2z" fill="currentColor"></path>
                    </svg>
                </button>

                <div id="popup-menu">
                    <div class="single-notification">
                        <table class="styled-table">
                            <th colspan="2" style='font-size:30px'>Notifications</th>
                            <?php
                            $select = "SELECT * from `notification` WHERE to_u_id=$u_id OR to_u_id=0";
                            $result1 = mysqli_query($conn, $select);
                            while ($rs = mysqli_fetch_array($result1)) {
                                echo "<tr>
                                 <td style='padding:20px 15px 10px 15px'><img src='../Pictures/Profile-Pic.svg' width='50px' height='50px'></td>
                                 <td>" . $rs[1] . "</td>";
                            }

                            ?>
                        </table>
                    </div>
                </div>
                <script>
                    function togglePopup() {
                        const popupMenu = document.getElementById('popup-menu');

                        var overlay = document.querySelector('.overlay');
                        if (popupMenu.style.display === 'block') {
                            // If the popup menu is already open, close it
                            popupMenu.style.display = 'none';

                        } else {
                            // If the popup menu is closed, open it
                            popupMenu.style.display = 'block';
                        }
                    }
                </script>
            </div>
        </div>
        <div class="sidebar">
            <div class="profile"></div>
            <aside>
                <ul>
                    <li><a href="./Dashboard.php">Dashboard</a></li>
                    <li><a href="./RequestLeave.php">Request Leave</a></li>
                    <li><a href="./TrainingSessions.php">Training Sessions</a></li>
                    <li><a href="./EscolateIssue.php">Escolate Issue</a></li>
                    <li><a href="./ReportGeneration.php">Report Generation</a></li>
                    <li><a href="./DocUpload.php">Document Upload</a></li>
                </ul>
            </aside>
        </div>
    </div>
    <div class="container-remainleave">
        <div class="box">
            <span class="title">Remaining Leaves</span>
            <div>
                <p> <?php

                    $query = "SELECT SUM(leave_left) FROM `leave_balance` WHERE u_id=$u_id;";
                    if ($result = mysqli_query($conn, $query)) {
                        // Return the number of rows in result set
                        while ($row = mysqli_fetch_array($result)) {
                            echo $row[0];
                        }
                        // Free result set
                        mysqli_free_result($result);
                    } else {
                        echo "Error";
                    } ?></p>
            </div>
        </div>
    </div>
    <div class="container-meeting">
        <div class="box">
            <span class="title">Total Meetings</span>
            <div>
                <p> <?php

                    $query = "SELECT * FROM `training_master`;";
                    if ($result = mysqli_query($conn, $query)) {
                        // Return the number of rows in result set
                        $rowcount = mysqli_num_rows($result);
                        echo ($rowcount);
                        // Free result set
                        mysqli_free_result($result);
                    } else {
                        echo "Error";
                    }
                    ?></p>
            </div>
        </div>
    </div>
    <div class="container-issues">
        <div class="box">
            <span class="title">Total Issues</span>
            <div>
                <p> <?php

                    $query = "SELECT * FROM `issue`;";
                    if ($result = mysqli_query($conn, $query)) {
                        // Return the number of rows in result set
                        $rowcount = mysqli_num_rows($result);
                        echo ($rowcount);
                        // Free result set
                        mysqli_free_result($result);
                    } else {
                        echo "Error";
                    }
                    ?></p>
            </div>
        </div>
    </div>
    <!-- script link -->
    <script src="./script.js"></script>
</body>

</html>