<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- css link -->
    <link rel="stylesheet" href="./Template.css">
    <link rel="stylesheet" href="./AssignLeave.css">
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
    echo $_SESSION["Logged_in"];
    if (!$_SESSION['Logged_in'] || $_SESSION['u_role_id'] != 1) {

        header("Location: ../LoginPage.php");
        exit;
    }
    ?>

    <div class="main">
        <h1>Assign Leave</h1>
        <div class="navbar">
            <h2>Admin</h2>
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
    <div class="Main_Content">
        <form action="./AssignLeave.php" method="POST" id="Register_Form">
            <div class="Name">
                <select name="u_id" id="u_id" required>
                    <option value="" disabled selected></option>
                    <?php
                    include "Config.php";
                    $query1 = "SELECT u_id,u_name FROM `user_master` where role_id = '0' OR role_id = '2';";
                    $result3 = mysqli_query($conn, $query1);
                    while ($row = mysqli_fetch_array($result3)) {
                        echo "<option value=$row[0]>" . "(" . $row[0] . ")" . $row[1] . "</option>";
                    }
                    ?>
                </select>
                <span>Name</span>
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
            <div class="Num_of_Leave">
                <input type="number" name="balance" id="Num_of_Leave" min="0" max="10" required pattern="[0-9]{2}" title="Must contain Numbers">
                <span>Number of Leaves</span>
                <i></i>
            </div>
            <button id="Submit-btn" type="submit" name="submit">Submit</button>
        </form>
        <?php
        if (isset($_POST['submit'])) {

            $u_id = $_POST['u_id'];
            $l_type = $_POST['leave_type'];
            $bal = $_POST['balance'];
            $select = "SELECT * FROM leave_balance WHERE u_id=$u_id AND leave_type_id=$l_type";
            $ex1 = mysqli_query($conn, $select);
            $rowcount = mysqli_num_rows($ex1);
            if ($rowcount > 0) {
                echo "<script>alert('Leave Type already assigned');</script>";
            } else {

                $insert = "INSERT INTO `leave_balance` (`bal_id`, `lv_balance`,`leave_left`, `u_id`, `leave_type_id`) VALUES (NULL, '$bal','$bal','$u_id', '$l_type');";
                if (mysqli_query($conn, $insert))
                    echo "<script>alert('No of Leave Assigned');</script>";
                else
                    echo "<script>alert('No of Leave Assigned');</script>";
            }
        }
        ?>
    </div>
    <div class="table_view">
        <table>
            <thead>

                <tr>
                    <th width=30%>ID&Name</th>
                    <th width=40%>Type of Leave</th>
                    <th width=30%>Number of Leaves</th>
                    <th width=30%>Operation</th>

                </tr>
            </thead>
            <tbody id="table-body">

                <?php
                include "Config.php";
                $query = "SELECT * FROM `leave_balance`;";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    echo "error";
                }
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?php
                            $user = "SELECT u_id,u_name FROM `user_master` WHERE u_id=$row[3];";
                            $user_result = mysqli_query($conn, $user);
                            while ($row1 = mysqli_fetch_array($user_result)) {
                                echo "(" . $row1[0] . ")" . $row1[1];
                            }
                            ?></td>
                        <?php
                        $user1 = "SELECT * FROM `leave_type_master` WHERE leave_type_id=$row[4];";
                        $user_result1 = mysqli_query($conn, $user1);
                        while ($row2 = mysqli_fetch_array($user_result1)) {
                            echo "<td>" . $row2[1] . "</td>";
                        } ?>
                        <td><?php echo $row[1]; ?></td>
                        <form method="post" action="./Delleave_bal.php">
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
    <script src="/Project/HR/script.js"></script>
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

            xhr.open("GET", "search.php?assign_leave_id=" + encodeURIComponent(query), true);
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

</html>