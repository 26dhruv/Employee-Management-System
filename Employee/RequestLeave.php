<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Panel</title>
    <!-- css link -->
    <link rel="stylesheet" href="./Template.css">
    <link rel="stylesheet" href="./RequestLeave.css">
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
    $u_id = $_SESSION['u_id'];
    if (!$_SESSION['Logged_in'] || $_SESSION['u_role_id'] != 2) {

        header("Location: ../LoginPage.php");
        exit;
    }

    ?>

    <div class="main">
        <h1>Request Leave</h1>
        <div class="navbar">
            <h2>Employee</h2>
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
                    <li><a href="./RequestLeave.php">Request Leave</a></li>
                    <li><a href="./TrainingSessions.php">Training Sessions</a></li>
                    <li><a href="./EscolateIssue.php">Escolate Issue</a></li>
                    <li><a href="./ReportGeneration.php">Report Generation</a></li>
                    <li><a href="./DocUpload.php">Document Upload</a></li>
                </ul>
            </aside>
        </div>
    </div>
    <div class="Main_Content">
        <form action="./RequestLeave.php" method="POST" id="Register_Form">
            <div class="ls_date">
                <input type="text" name="ls_date" id="ls_date" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+30 day')) ?>" required onfocus="(this.type='date')" onblur="(this.type='text')" onchange="updateEndDate()">
                <span>Start Date</span>
                <i></i>
            </div>
            <div class="EndDate">
                <input type="text" name="le_date" id="le_date" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" max="<?php echo date('Y-m-d', strtotime('+20 day')) ?>" required onfocus="(this.type='date')" onblur="(this.type='text')">
                <span>End Date</span>
                <i></i>
            </div>
            <div class="LType">
                <select name="leave_type" id="leave_type" required>
                    <option value="" disabled selected></option>
                    <?php
                    include "Config.php";
                    $query_area = "SELECT * FROM `leave_type_master`;";
                    $result2 = mysqli_query($conn, $query_area);
                    while ($row = mysqli_fetch_array($result2)) {
                        echo "<option value=$row[0]>" . $row[1] . "</option>";
                    }
                    ?>
                </select>
                <span>Leave Type</span>
                <i></i>
            </div>
            <div class="LeaveReason">
                <textarea name="leave_reason" id="leave_reason" required cols="20" rows="10"></textarea>
                <span>Leave Reason</span>
                <i></i>
            </div>
            <button id="Submit-btn" type="submit" name="submit">Submit</button>
        </form>
        <?php
        include "Config.php";
        if (isset($_POST['submit'])) {
            $leave_type_id = $_POST['leave_type'];
            $date1 = $_POST['ls_date'];

            // End date
            $date2 = $_POST['le_date'];

            // Function call to find date difference
            $dateDiff = dateDiffInDays($date1, $date2);
            $query = "SELECT *  FROM leave_balance WHERE u_id=$u_id AND leave_type_id=$leave_type_id AND lv_balance >=$dateDiff AND leave_left>=$dateDiff";
            $ex1 = mysqli_query($conn, $query);
            $rowcount = mysqli_num_rows($ex1);
            if ($rowcount > 0) {
                echo $dateDiff;
                $leave_reason = $_POST['leave_reason'];

                $query = "INSERT INTO `user_leave` (`leave_type_id`,`u_id`,`ls_date`,`le_date`,`no_leave`,`leave_reason`,`status`,`rej_reason`) VALUES ('$leave_type_id','$u_id','$date1','$date2','$dateDiff','$leave_reason','3','Pending');";
                if (mysqli_query($conn, $query)) {
                    echo "<script>alert(\"Leave Requested\");</script>";
                } else {
                    echo "<script>alert(\"Leave Request Error\");</script>";
                }
            } else
                echo "<script>alert(\"Insufficient Balance\");</script>";
        }
        function dateDiffInDays($date1, $date2)
        {
            // Calculating the difference in timestamps
            $diff = strtotime($date2) - strtotime($date1);

            // 1 day = 24 hours
            // 24 * 60 * 60 = 86400 seconds
            return abs(round($diff / 86400));
        }
        ?>
    </div>
    <div class="table_view">
        <table id="main_table">
            <thead>
                <tr>
                    <th width="10%">ID</th>
                    <th width="10%">Name</th>
                    <th width="10%">Date From</th>
                    <th width="10%">Date To</th>
                    <th width="30%">Description</th>
                    <th width="10%">type</th>
                    <th width="10%">Reply</th>
                    <th width="10%">Status</th>
                </tr>
            </thead>
            <tbody id="table-body">

                <?php
                include "Config.php";
                $query = "SELECT * FROM `user_leave` WHERE u_id=$u_id;";
                $query1 = "SELECT u_name FROM `user_master` WHERE u_id=$u_id;";
                $result2 = mysqli_query($conn, $query1);
                while ($row = mysqli_fetch_array($result2)) {
                    $name = $row[0];
                }

                $result = mysqli_query($conn, $query);
                if (!$result) {
                    echo "error";
                }
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?php echo $row[0]; ?></td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $row[3]; ?></td>
                        <td><?php echo $row[4]; ?></td>
                        <td><?php echo $row[6]; ?></td>

                        <td><?php $query2 = "SELECT leave_type FROM `leave_type_master` WHERE leave_type_id=$row[1];";
                            $r = mysqli_query($conn, $query2);
                            while ($row3 = mysqli_fetch_array($r)) {
                                echo $row3[0];
                            } ?></td>
                        <td><?php echo $row[8]; ?></td>
                        <td><?php if ($row[7] == 3)
                                echo "Pending";
                            elseif ($row[7] == 2)
                                echo "Accepted";
                            elseif ($row[7] == 1)
                                echo "Rejected"; ?></td>
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

            xhr.open("GET", "search.php?leave_id=" + encodeURIComponent(query), true);
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

        function updateEndDate() {
            var startDate = new Date(document.getElementById("ls_date").value);
            var endDateField = document.getElementById("le_date");

            // Increment the start date by one day to get the minimum end date
            startDate.setDate(startDate.getDate() + 1);

            // Format the minimum end date as "YYYY-MM-DD" for setting the input's min attribute
            var minEndDate = startDate.toISOString().split("T")[0];

            // Set the minimum end date
            endDateField.min = minEndDate;

            // Reset the end date value if it's less than the minimum end date
            if (endDateField.value < minEndDate) {
                endDateField.value = minEndDate;
            }
        }
    </script>
</body>

</html>