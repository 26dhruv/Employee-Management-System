<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- css link -->
    <link rel="stylesheet" href="./Template.css">
    <link rel="stylesheet" href="./View_Employee.css">
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
    // echo $u_id;
    if (!$_SESSION['Logged_in'] || $_SESSION['u_role_id'] != 1) {

        header("Location: ../LoginPage.php");
        exit;
    }
    if (isset($_SESSION['emp_deleted'])) {
        if ($_SESSION['emp_deleted'] == 0) {
    ?>
            <script>
                alert('Record not deleted due to open leave request or education details');
            </script>
    <?php
            unset($_SESSION['emp_deleted']);
        }
    }
    ?>
    <div class="main">
        <h1>View Employee</h1>
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
        <div class="Main_Content">
            <table>
                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>designation</th>
                        <th>department</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                <tbody id="table-body">

                    <?php
                    include "Config.php";
                    $query = "SELECT * FROM `user_master` WHERE u_id!=$u_id;";
                    $result = mysqli_query($conn, $query);
                    if (!$result) {
                        echo "error";
                    }
                    while ($row = mysqli_fetch_array($result)) {
                        $query5 = "SELECT * FROM `designation_master` WHERE desi_id=$row[12];";
                        $result_desg = mysqli_query($conn, $query5);
                        if (mysqli_num_rows($result_desg) > 0) {
                            // output data of each row
                            while ($row2 = mysqli_fetch_array($result_desg)) {
                                $desg = $row2[1];
                            }
                        } else {
                            echo "0 results";
                        }
                        $query6 = "SELECT * FROM `dept_master` WHERE dept_id=$row[13];";
                        $result_dept = mysqli_query($conn, $query6);
                        if (mysqli_num_rows($result_dept) > 0) {
                            // output data of each row
                            while ($row2 = mysqli_fetch_array($result_dept)) {
                                $dept = $row2[1];
                            }
                        } else {
                            echo "0 results";
                        }

                    ?>
                        <tr>
                            <td><?php echo $row[0]; ?></td>
                            <td><?php echo $row[1]; ?></td>
                            <td><?php echo $row[2]; ?></td>
                            <td><?php echo $desg; ?></td>
                            <td><?php echo $dept; ?></td>
                            <td>
                                <form method="get" action="./DelEmp.php">
                                    <input type="hidden" name="rowid" value="<?php echo $row[0]; ?>">
                                    <input class="btn-default" type="submit" name="login" value="Delete" id="Delbtn" onClick="javascript: return confirm('Please confirm deletion');">
                                </form>
                                <form method="get" action="./Update_Emp.php">
                                    <input type="hidden" name="rowid" value="<?php echo $row[0]; ?>">
                                    <input type="submit" value="Update" name="Updatebtn" id="Updbtn" onclick="location.href = './Update_Emp.php';">
                                </form>
                            </td>

                        </tr>
                    <?php
                    }  ?>

                </tbody>
            </table>
            <?php

            ?>
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

                xhr.open("GET", "search.php?emp_id=" + encodeURIComponent(query), true);
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