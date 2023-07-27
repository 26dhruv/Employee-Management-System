<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- css link -->
    <link rel="stylesheet" href="./Template.css">
    <link rel="stylesheet" href="./UserProfessionalDetail.css">
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
    $_SESSION['prof_delete'] = 5;

    if (!$_SESSION['Logged_in'] || $_SESSION['u_role_id'] != 1) {

        header("Location: ../LoginPage.php");
        exit;
    }
    if ($_SESSION['prof_delete'] == 1) {
        echo  "<script>alert('Details Deleted');</script>";
        unset($_SESSION['prof_delete']);
    } elseif ($_SESSION['prof_delete'] == 0) {
        echo  "<script>alert('Error in Deletion');</script>";
        unset($_SESSION['prof_delete']);
    }
    ?>
    <div class="main">
        <h1>User Professional Detail</h1>
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

    <form action="./UserProfessionalDetail.php" method="POST" id="Register_Form">
        <!-- employer -->
        <div class="employer">
            <input type="text" name="employer" id="employer" required maxlength="32" pattern="[a-z]{2,32}" title="Must contain only character">
            <span>Last Company Name</span>
            <i></i>
        </div>
        <!-- doj -->
        <div class="Doj">
            <input type="text" name="doj" id="U_DOJ" min="2021-01-01" required onfocus="(this.type='date')" onblur="(this.type='text')">
            <span>Date of Joining</span>
            <i></i>
        </div>
        <!-- dol -->
        <div class="Dol">
            <input type="text" name="dol" id="U_DOl" required onfocus="(this.type='date')" onblur="(this.type='text')">
            <span>Date of Leave</span>
            <i></i>

            <script>
                var datepicker1 = document.getElementById("U_DOJ");
                var datepicker2 = document.getElementById("U_DOl");

                datepicker1.addEventListener("change", function() {
                    var selectedDate = new Date(datepicker1.value);
                    var nextDate = new Date(selectedDate.getTime() + (24 * 60 * 60 * 1000));
                    datepicker2.min = nextDate.toISOString().split('T')[0];
                });
            </script>
        </div>
        <!-- salary -->
        <div class="salary">
            <input type="text" name="salary" id="U_lastsalary" required maxlength="10" pattern='[0-9]{1,10}' title="Must contain only Numbers">
            <span>Salary</span>
            <i></i>
        </div>
        <!-- Designation -->
        <div class="Designation">
            <input type="text" name="designation" id="Designation" required maxlength="32" pattern="[A-Za-z\s]{2,32}" title="Must contain only character">
            <span>Designation</span>
            <i></i>
        </div>
        <div class="Name">
            <select name="u_id" id="u_id" required>
                <option value="" disabled selected></option>
                <?php
                include "Config.php";
                $query1 = "SELECT u_id,u_name FROM `user_master`;";
                $result3 = mysqli_query($conn, $query1);
                while ($row = mysqli_fetch_array($result3)) {
                    echo "<option value=$row[0]>" . "(" . $row[0] . ")" . $row[1] . "</option>";
                }
                ?>
            </select>
            <span>Name</span>
            <i></i>
        </div>
        <button id="Submit-btn" type="submit" name="submit">Submit</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'Config.php';
        $employer = $_POST['employer'];
        $doj = $_POST['doj'];
        $dol = $_POST['dol'];
        $salary = $_POST['salary'];
        $desig = $_POST['designation'];
        $id = $_POST['u_id'];

        $query = "INSERT INTO `user_professional_detail` ( `employer`, `prev_doj`, `prev_dol`, `salary`, `prev_designation`, `u_id`) VALUES ( '$employer', '$doj', '$dol', '$salary','$desig', '$id');";
        $result = mysqli_query($conn, $query);
        if (!$result)
            echo "<script>alert('Error in insertion');</script>";
        else
            echo "<script>alert('Recored inserted successfully');</script>";
    }
    ?>
    <div class="Main_Content">
        <table>
            <thead>

                <tr>
                    <th>ID&Username</th>
                    <th>Company name</th>
                    <th>Date of Joining</th>
                    <th>Date of Leave</th>
                    <th>Salary</th>
                    <th>Designation</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <tbody id="table-body">

                <?php
                include "Config.php";
                $query = "SELECT * FROM `user_professional_detail`;";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    echo "error";
                }
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <?php $user = "SELECT u_id,u_name FROM `user_master` WHERE u_id=$row[6];";
                        $user_result = mysqli_query($conn, $user);
                        while ($row1 = mysqli_fetch_array($user_result)) {
                            echo "<td>(" . $row1[0] . ")" . $row1[1] . "</td>";
                        } ?>
                        <td><?php echo $row[1]; ?></td>
                        <td><?php echo $row[2]; ?></td>
                        <td><?php echo $row[3]; ?></td>
                        <td><?php echo $row[4]; ?></td>
                        <td><?php echo $row[5]; ?></td>
                        <form method="post" action="./Delprofdet.php">
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

            xhr.open("GET", "search.php?u_prof_detail=" + encodeURIComponent(query), true);
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