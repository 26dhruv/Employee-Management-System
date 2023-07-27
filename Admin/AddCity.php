<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- css link -->
    <link rel="stylesheet" href="./Template.css">
    <link rel="stylesheet" href="./AddCity.css">
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
        <h1>Add City</h1>
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
    <form action="#" method="POST" id="Form">
        <div class="City">
            <input type="text" name="U_City" id="CITY" required maxlength="32" pattern="[A-Za-z\s]{2,32}" title="Must contain only character">
            <span>City</span>
            <i></i>
        </div>
        <div class="State">
            <select name="user_state" id="U_STATE" required>
                <option value="" disabled selected></option>
                <?php
                include "Config.php";
                $query_state = "SELECT * FROM `state_master`;";
                $result3 = mysqli_query($conn, $query_state);
                while ($row = mysqli_fetch_array($result3)) {
                    echo "<option value=$row[0]>" . $row[1] . "</option>";
                }
                ?>
            </select>
            <span>State</span>
            <i></i>
        </div>
        <button id="Submit-btn" type="submit" name="submit">Submit</button>
    </form>
    <?php

    include "Config.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $state = $_POST['user_state'];
        $city = $_POST['U_City'];



        $get_dep = "SELECT * FROM `city_master` WHERE `city`='$city' ";
        $resultdep = mysqli_query($conn, $get_dep);

        if (mysqli_num_rows($resultdep) > 0) {
            echo "<script>alert('City already exists')</script>";
    ?><a href="./AddCity.php"></a><?php
                                } else {
                                    $query = "INSERT INTO `city_master` ( `city`,`state_id`) VALUES ('$city','$state');";
                                    mysqli_query($conn, $query);
                                    echo "<script>alert('City added successfully')</script>";
                                    ?><a href="./AddCity.php"></a><?php
                                                                }
                                                            }
                                                                    ?>
    <div class="Main_Content">
        <table>
            <thead>
                <tr>
                    <th width=20%>ID</th>
                    <th width=30%>City</th>
                    <th width=30%>State</th>
                    <th width=20%>Operation</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <?php
                include "Config.php";
                $query = "SELECT * FROM `city_master`;";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    echo "error";
                }
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?php echo $row[0]; ?></td>
                        <td><?php echo $row[1]; ?></td>
                        <td><?php
                            $query1 = "SELECT state FROM `state_master` WHERE state_id=$row[2];";
                            $result1 = mysqli_query($conn, $query1);
                            if (!$result1) {
                                echo "error";
                            }
                            while ($row1 = mysqli_fetch_array($result1)) {
                                echo $row1[0];
                            }
                            ?></td>
                        <form method="post" action="Delcity.php">
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

            xhr.open("GET", "search.php?city_id=" + encodeURIComponent(query), true);
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