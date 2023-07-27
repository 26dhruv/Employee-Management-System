<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
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
    include "./Config.php";
    session_start();

    if (!$_SESSION['Logged_in'] || $_SESSION['u_role_id'] != 1) {

        header("Location: ../LoginPage.php");
        exit;
    }
    ?>

    <div class="main">
        <h1>Dashboard</h1>
        <div class="navbar">
            <h2>Admin</h2>
            <a href="logout.php"> <button name="Logout" id="Logout" value="Logout" onclick="<?php $_SESSION = false; ?>">Logout</button></a>
            <div class="notif">
                <button id="bell-btn" onclick="togglePopup()">
                    <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M20 17h2v2H2v-2h2v-7a8 8 0 1 1 16 0v7zm-2 0v-7a6 6 0 1 0-12 0v7h12zm-9 4h6v2H9v-2z" fill="currentColor"></path>
                    </svg>
                </button>

                <div id="popup-menu">
                    <div class="For-Title">
                        <p>Notification</p>
                        <button onclick="togglePopup_notif()">
                            <i><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black" class="bi bi-send-plus-fill" viewBox="0 0 16 16">
                                    <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 1.59 2.498C8 14 8 13 8 12.5a4.5 4.5 0 0 1 5.026-4.47L15.964.686Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                                    <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-3.5-2a.5.5 0 0 0-.5.5v1h-1a.5.5 0 0 0 0 1h1v1a.5.5 0 0 0 1 0v-1h1a.5.5 0 0 0 0-1h-1v-1a.5.5 0 0 0-.5-.5Z" />
                                </svg></i>
                        </button>
                    </div>

                    <div id="For-add-notification">
                        <form action="./addnoti.php" method="post">
                            <textarea name="notification" id="notification" placeholder="Notification" cols="20" rows="5"></textarea>
                            <div class="Name">
                                <Label for="u_id">Name</Label>
                                <select name="u_id" id="u_id" required>
                                    <option value="0" selected>All(HR and Employee)</option>
                                    <?php
                                    include "Config.php";
                                    $query1 = "SELECT u_id,u_name FROM `user_master` where role_id = '0' OR role_id = '2';";
                                    $result3 = mysqli_query($conn, $query1);
                                    while ($row = mysqli_fetch_array($result3)) {
                                        echo "<option value=$row[0]>" . "(" . $row[0] . ")" . $row[1] . "</option>";
                                    }
                                    ?>

                                </select>
                            </div>
                            <input type="submit" value="Send" id="send-btn">
                        </form>

                        <script>
                            function togglePopup_notif() {
                                const popupMenu = document.getElementById('For-add-notification');

                                if (popupMenu.style.display === 'block') {
                                    // If the popup menu is already open, close it
                                    popupMenu.style.display = 'none';

                                } else {
                                    // If the popup menu is closed, open it
                                    popupMenu.style.display = 'block';
                                }
                            }

                            function togglePopup() {
                                const popupMenu = document.getElementById('popup-menu');

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
                    <div class="single-notification">
                        <table class="styled-table">
                            <?php
                            $select1 = "SELECT u_id FROM user_master WHERE role_id=1";
                            $result2 = mysqli_query($conn, $select1);
                            while ($rs1 = mysqli_fetch_array($result2)) {

                                $select = "SELECT * from `notification` WHERE u_id=$rs1[0]";
                                $result1 = mysqli_query($conn, $select);
                                while ($rs = mysqli_fetch_array($result1)) {
                                    echo "<tr>
                                <td style='padding:20px 15px 10px 15px'><img src='../Pictures/Profile-Pic.svg' width='50px' height='50px'></td>
                                <td>" . $rs[1] . "</td>";
                                }
                            }
                            ?>
                        </table>
                    </div>

                </div>
            </div>
            <div class="sidebar">
                <div class="profile"></div>
                <aside>
                    <ul>
                        <li><a href="./Dashboard.php">Dashboard</a></li>
                        <li>
                            <a href="#" class="emp-btn">Manage Employee <span class="fas fa-caret-down first"></span></a>
                            <ul class="emp-show">
                                <li><a href="./Add_Employee.php">Add Employee</a></li>
                                <li><a href="./View_Employee.php">View Employee</a></li>
                                <li><a href="./UserProfessionalDetail.php">User Professional <br> Detail</a></li>
                            </ul>
                        </li>
                        <li><a href="#" class="emp-edu">Manage Education <span class="fas fa-caret-down "></span></a>
                            <ul class="emp-edu-show">
                                <li><a href="./AddUniversity.php">Add University</a></li>
                                <li><a href="./AddCollege.php">Add College</a></li>
                                <li><a href="./AddDegree.php">Add Degree</a></li>
                            </ul>
                        </li>
                        <li><a href="#" class="emp-branch">Manage Branch <span class="fas fa-caret-down "></span></a>
                            <ul class="emp-branch-show">
                                <li><a href="./AddState.php">Add State</a></li>
                                <li><a href="./AddCity.php">Add City</a></li>
                                <li><a href="./AddArea.php">Add Area</a></li>
                            </ul>
                        </li>
                        <li><a href="./Manage_Department.php">Manage Department</a></li>
                        <li><a href="./Designation.php">Manage Designation</a></li>
                        <li><a href="./ApproveLeave.php">Approve Leave</a></li>
                        <li><a href="./AssignLeave.php">Assign Leave</a></li>
                    </ul>
                </aside>
            </div>
        </div>
        <div class="container-emp">
            <div class="box">
                <span class="title">Total Employee</span>
                <div>
                    <p> <?php

                        $query = "SELECT * FROM `user_master`;";
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
        <div class="container-dept">
            <div class="box">
                <span class="title">Total Department</span>
                <div>
                    <p><?php

                        $query = "SELECT * FROM `dept_master`;";
                        if ($result = mysqli_query($conn, $query)) {
                            // Return the number of rows in result set
                            $rowcount = mysqli_num_rows($result);
                            printf($rowcount);
                            // Free result set
                            mysqli_free_result($result);
                        } else {
                            echo "Error";
                        }
                        ?></p>
                </div>
            </div>
        </div>
        <div class="container-desig">
            <div class="box">
                <span class="title">Total Designation</span>
                <div>
                    <p><?php

                        $query = "SELECT * FROM `designation_master`;";
                        if ($result = mysqli_query($conn, $query)) {
                            // Return the number of rows in result set
                            $rowcount = mysqli_num_rows($result);
                            printf($rowcount);
                            // Free result set
                            mysqli_free_result($result);
                        } else {
                            echo "Error";
                        }
                        ?></p>
                </div>
            </div>
        </div>
        <div class="container-role">
            <div class="box">
                <span class="title">Total Role</span>
                <div>
                    <p> <?php

                        $query = "SELECT * FROM `role_master`;";
                        if ($result = mysqli_query($conn, $query)) {
                            // Return the number of rows in result set
                            $rowcount = mysqli_num_rows($result);
                            printf($rowcount);
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