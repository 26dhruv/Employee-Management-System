<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Panel</title>
    <!-- css link -->
    <link rel="stylesheet" href="./Template.css">
    <link rel="stylesheet" href="./ScheduleTraining.css">
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
    $_SESSION['meet_delete'] = 5;
    if (!$_SESSION['Logged_in'] || $_SESSION['u_role_id'] != 0) {

        header("Location: ../LoginPage.php");
        exit;
    }
    if ($_SESSION['meet_delete'] == 1) {
        echo  "<script>alert('Details Deleted');</script>";
        unset($_SESSION['meet_delete']);
    } elseif ($_SESSION['meet_delete'] == 0) {
        echo  "<script>alert('Error in Deletion');</script>";
        unset($_SESSION['meet_delete']);
    }
    ?>
    ?>

    <div class="main">
        <h1>Schedule Training</h1>
        <div class="navbar">
            <h2>HR</h2>
            <div class="card">
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="card-inner"></div>
                <input type="search" name="Emp-search" id="Emp-search" placeholder="Search"><i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg></i>
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
                    <li><a href="./Leavetype.php">Manage Leave Type</a></li>
                    <li><a href="./RequestLeave.php">Request Leave</a></li>
                    <li><a href="./ApproveLeave.php">Approve Leave</a></li>
                    <li><a href="./ScheduleTraining.php">Schedule Training</a></li>
                    <li><a href="./AssignLeave.php">Assign Leave</a></li>
                    <li><a href="./IssueResolution.php">Issue Resolution</a></li>
                    <li><a href="./ReportGeneration.php">Report Generation</a></li>
                    <li><a href="./DocType.php">Document Type</a></li>
                </ul>
            </aside>
        </div>
    </div>

    <form action="./ScheduleTraining.php" method="POST" id="Register_Form">
        <div class="TDate">
            <input type="text" name="tdate" id="TDate" min="<?php echo  date('Y-m-d\TH:i:s'); ?>" required onfocus="(this.type='datetime-local')" onblur="(this.type='text')">
            <span>Training Date</span>
            <i></i>
        </div>
        <div class="TDuration">
            <input type="text" name="tduration" id="TDuration" required maxlength="7" pattern="[0-9]{2,7}" title="Enter minutes">
            <span>Training Duration</span>
            <i></i>
        </div>
        <div class="TPassword">
            <input type="text" name="tpassword" id="tpassword" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
            <span>Training Password</span>
            <i></i>
        </div>
        <button id="Submit-btn" type="submit" name="submit">Submit</button>
    </form>


    <!-- php code for scheduling meeting -->
    <?php

    require_once './JWT.php';

    use \Firebase\JWT\JWT;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'Config.php';
        // Set timezone to India
        date_default_timezone_set('Asia/Kolkata');

        // Zoom API credentials
        $api_key = "Ft9il4w1TGOYNOxMCGLSEQ";
        $api_secret = "uyIX7V4vM0OoZu9Oios3gI21tkEoeMEtPJrq";

        // Generate a JWT token for authentication
        $payload = array(
            "iss" => $api_key,
            "exp" => time() + 3600 // Token expires in 1 hour
        );
        $jwt_token = JWT::encode($payload, $api_secret, 'HS256');

        // Zoom API endpoint for creating a meeting
        $api_url = "https://api.zoom.us/v2/users/me/meetings";

        // Set request headers
        $headers = array(
            "Authorization: Bearer " . $jwt_token,
            "Content-Type: application/json"
        );
        $d = date_create($_POST['tdate']);
        $date = date_format($d, 'c');
        $pass = $_POST['tpassword'];
        $dur = $_POST['tduration'];
        // Set meeting details
        $meeting_data = array(
            "topic" => "Training Session",
            "type" => 2, // Scheduled meeting
            "start_time" => "$date", // Meeting start time in ISO 8601 format
            "duration" => $dur, // Meeting duration in minutes
            "password" => $pass,
            "timezone" => "Asia/Kolkata", // Set timezone to India
        );

        // Send POST request to create the meeting
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($meeting_data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        // Decode the response JSON and print the join URL
        $meeting_info = json_decode($response, true);
        // echo "Join URL: " . $meeting_info["join_url"];
        // echo '<br>';
        // echo $meeting_info["id"];
        // echo json_encode($meeting_info);
        $m_id = $meeting_info['id'];
        $u_id = $_SESSION['u_id'];
        $date1 = $_POST['tdate'];
        $date_time_mysql = date('Y-m-d H:i:s', strtotime($date1));
        $query = "INSERT INTO `training_master` (`t_meet_id`,`t_pass`,`t_duration`, `t_desc`, `t_datetime`, `u_id`) VALUES ( '$m_id','$pass','$dur', 'Training Session', '$date_time_mysql','$u_id');";

        if (mysqli_query($conn, $query)) {
            echo  "<script>alert('Meet Scheduled');
                            
            </script>";
        } else {
            echo  "<script>alert('Error in meet scheduling');</script>";
        }
    }
    ?>
    </div>
    <div class="Main_Content">
        <table>
            <thead>

                <tr>
                    <th width="10%">ID</th>
                    <th width="20%">Meeting ID</th>
                    <th width="20%">Password</th>
                    <th width="15%">Date and Time</th>
                    <th width="15%">Meet Title</th>
                    <th width="10%">Duration</th>
                    <th width="10%">Operations</th>
                </tr>
            </thead>
            <tbody id="table-body">

                <?php
                include "Config.php";
                $query = "SELECT * FROM `training_master`;";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    echo "error";
                }
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?php echo $row[0]; ?></td>
                        <td><?php echo $row[1]; ?></td>
                        <td><?php echo $row[2]; ?></td>
                        <td><?php echo $row[5]; ?></td>
                        <td><?php echo $row[4]; ?></td>
                        <td><?php echo $row[3]; ?></td>
                        <form method="post" action="./DelMeet.php">
                            <input type="hidden" name="rowid" value="<?php echo $row[0]; ?>">
                            <td><input type="submit" value="delete" name="Deletebtn" id="Delbtn" onClick="javascript: return confirm('Please confirm deletion');"></td>
                        </form>
                    </tr>
                <?php
                } ?>

            </tbody>
        </table>
    </div>
    <!-- script link -->
    <script src="./script.js"></script>
    <script>
        var searchInput = document.getElementById("Emp-search");
        var table = document.getElementById('table-body');
        var defaultt = table.innerHTML;
        // Add an event listener to the search input
        searchInput.addEventListener("input", function() {
            // Get the search query from the input value
            var query = searchInput.value.trim();

            // Make an AJAX call to the PHP search script
            var xhr = new XMLHttpRequest();

            xhr.open("GET", "search.php?q=" + encodeURIComponent(query), true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Update the search results with the response data
                    // var results = xhr.responses;
                    console.log(xhr.responseText);
                    if (xhr.responseText == "") {
                        table.innerHTML = defaultt
                    } else
                        table.innerHTML = xhr.responseText;
                    // ...
                }
            };
            xhr.send();
        });
    </script>
</body>