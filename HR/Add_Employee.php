<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Panel</title>
    <!-- css link -->
    <link rel="stylesheet" href="./Template.css">
    <link rel="stylesheet" href="./Add_Employee.css">
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

    if (!$_SESSION['Logged_in'] || $_SESSION['u_role_id'] != 0) {

        header("Location: ../LoginPage.php");
        exit;
    }
    if (isset($_SESSION['emp_added'])) {
        if ($_SESSION['emp_added'] == 1) {
    ?>
            <script>
                alert("Employee not Added Successfully");
            </script>
        <?php
            unset($_SESSION['emp_added']);
        } else if ($_SESSION['emp_added'] == 0) {
        ?>
            <script>
                alert("Employee Added Successfully");
            </script>
    <?php
            unset($_SESSION['emp_added']);
        }
    }
    ?>
    <div class="main">
        <h1>Add Employee</h1>
        <div class="navbar">
            <h2>HR</h2>
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
        <div class="Main_Content">

            <form action="./AddEmployeeLogic.php" method="POST" id="Register_Form">
                <div class="Name">
                    <input type="text" name="user_name" id="NAME" required maxlength="32" pattern="[A-Za-z]{3,32}" title="Must contain only character">
                    <span>Username</span>
                    <i></i>
                </div>
                <div class="email">
                    <input type="email" name="user_email" id="EMAIL" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Enter email in proper formate">
                    <span>Email</span>
                    <i></i>
                </div>
                <div class="password">
                    <input type="password" name="user_pass" id="PASSWORD" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                    <span>Password</span>
                    <i></i>
                </div>
               <div class="contact">
                    <input type="number" name="user_contact" id="U_CONTACT" required pattern="[0-9]{10}" title="Must contain 10 Numbers">
                    <span>10 digit Contact No.</span>
                    <i></i>
                </div>
                <div class="Dob">
                    <input type="text" name="user_dob" id="U_DOB" max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>" required onfocus="(this.type='date')" onblur="(this.type='text')">
                    <span>Date of birth</span>
                    <i></i>
                </div>
                <div class="Doj">
                    <input type="text" name="user_doj" id="U_DOJ" min="<?php echo date('Y-m-d'); ?>" required onfocus="(this.type='date')" onblur="(this.type='text')">
                    <span>Date of Joining</span>
                    <i></i>
                </div>
                <div class="Gender">
                    <select name="user_gender" id="Gender" required title="Please select gender">
                        <option value="" disabled selected></option>
                        <option value="1">Male</option>
                        <option value="0">Female</option>
                    </select>
                    <span>Gender</span>
                    <i></i>
                </div>
                <div class="State">
                    <select name="user_state" id="U_STATE" onchange="getCities()" required>
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
                <script>
                    function getCities() {
                        var state = document.getElementById("U_STATE").value;
                        const cityDropdown = document.getElementById('U_CITY');
                        if (state == "") {
                            document.getElementById("U_CITY").innerHTML = "<option value=''></option>";
                            return;
                        }

                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function() {

                            document.getElementById("U_CITY").innerHTML = xhr.responseText;
                            console.log(xhr.responseText);
                        }
                        xhr.open("GET", "get_cities.php?state=" + state, true);
                        xhr.onload = function() {
                            // Parse response JSON and update city dropdown options
                            const cities = JSON.parse(xhr.responseText);
                            let cityOptions = '<option value=""></option>';
                            cities.forEach(function(city) {
                                cityOptions += `<option value="${city.city_id}">${city.city}</option>`;
                            });
                            cityDropdown.innerHTML = cityOptions;
                        };
                        xhr.send();
                        console.log(xhr.responseText);
                    }

                    function getArea() {
                        var city = document.getElementById("U_CITY").value;
                        const areaDropdown = document.getElementById('U_AREA');
                        if (city == "") {
                            document.getElementById("U_AREA").innerHTML = "<option value=''></option>";
                            return;
                        }

                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function() {

                            document.getElementById("U_AREA").innerHTML = xhr.responseText;
                            console.log(xhr.responseText);
                        }
                        xhr.open("GET", "get_cities.php?city=" + city, true);
                        xhr.onload = function() {
                            // Parse response JSON and update city dropdown options
                            const areas = JSON.parse(xhr.responseText);
                            let areaOptions = '<option value=""></option>';
                            areas.forEach(function(area) {
                                areaOptions += `<option value="${area.area_id}">${area.area}</option>`;
                            });
                            areaDropdown.innerHTML = areaOptions;
                        };
                        xhr.send();
                        console.log(xhr.responseText);
                    }

                    function getCllg() {
                        var uni = document.getElementById("University").value;
                        const cllgdropdown = document.getElementById('U_College');
                        if (uni == "") {
                            document.getElementById("U_College").innerHTML = "<option value=''></option>";
                            return;
                        }

                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function() {

                            document.getElementById("U_College").innerHTML = xhr.responseText;
                            console.log(xhr.responseText);
                        }
                        xhr.open("GET", "get_cities.php?uni=" + uni, true);
                        xhr.onload = function() {
                            // Parse response JSON and update city dropdown options
                            const cllgs = JSON.parse(xhr.responseText);
                            let cllgoption = '<option value=""></option>';
                            cllgs.forEach(function(clg) {
                                cllgoption += `<option value="${clg.clg_id}">${clg.clg_name}</option>`;
                            });
                            cllgdropdown.innerHTML = cllgoption;
                        };
                        xhr.send();
                        console.log(xhr.responseText);
                    }

                    function getdesi() {
                        var dep = document.getElementById("U_DEPT").value;
                        const desidropdown = document.getElementById('U_DESIG');
                        if (dep == "") {
                            document.getElementById("U_DESIG").innerHTML = "<option value=''></option>";
                            return;
                        }

                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function() {

                            document.getElementById("U_DESIG").innerHTML = xhr.responseText;
                            console.log(xhr.responseText);
                        }
                        xhr.open("GET", "get_cities.php?dep=" + dep, true);
                        xhr.onload = function() {
                            // Parse response JSON and update city dropdown options
                            const desis = JSON.parse(xhr.responseText);
                            let desioption = '<option value=""></option>';
                            desis.forEach(function(desi) {
                                desioption += `<option value="${desi.desi_id}">${desi.desi_name}</option>`;
                            });
                            desidropdown.innerHTML = desioption;
                        };
                        xhr.send();
                        console.log(xhr.responseText);
                    }
                </script>
                <div class="City">
                    <select name="user_city" id="U_CITY" onchange="getArea()" required>
                        <option value="" disabled selected></option>

                    </select>
                    <span>City</span>
                    <i></i>
                </div>
                <div class="Area">
                    <select name="user_area" id="U_AREA" required>
                        <option value="" disabled selected></option>

                    </select>
                    <span>Area</span>
                    <i></i>
                </div>
                <div class="Role">
                    <select name="user_role" id="U_ROLE" required>
                        <option value="" disabled selected></option>
                        <?php
                        include "Config.php";
                        $query_role = "SELECT * FROM `role_master` WHERE role_id=2;";
                        $result3 = mysqli_query($conn, $query_role);
                        while ($row = mysqli_fetch_array($result3)) {
                            echo "<option value=$row[0]>" . $row[1] . "</option>";
                        }
                        ?>
                    </select>
                    <span>Role</span>
                    <i></i>
                </div>
                <div class="Dept">
                    <select name="user_dept" id="U_DEPT" required onchange="getdesi()">
                        <option value="" disabled selected></option>
                        <?php
                        include "Config.php";
                        $query_dept = "SELECT * FROM `dept_master`;";
                        $result5 = mysqli_query($conn, $query_dept);
                        while ($row = mysqli_fetch_array($result5)) {
                            echo "<option value=$row[0]>" . $row[1] . "</option>";
                        }
                        ?>
                    </select>
                    <span>Deptartment</span>
                    <i></i>
                </div>
                <div class="Desig">
                    <select name="user_desig" id="U_DESIG" required>
                        <option value="" disabled selected></option>
                    </select>
                    <span>Designation</span>
                    <i></i>
                </div>
                <div class="University">
                    <select name="U_University" id="University" onchange="getCllg()" required>
                        <option value="" disabled selected></option>
                        <?php
                        include "Config.php";
                        $query_desg = "SELECT * FROM `uni_master`;";
                        $result4 = mysqli_query($conn, $query_desg);
                        while ($row = mysqli_fetch_array($result4)) {
                            echo "<option value=$row[0]>" . $row[1] . "</option>";
                        }
                        ?>
                    </select>
                    <span>University</span>
                    <i></i>
                </div>
                <div class="College">
                    <select name="U_College" id="U_College" required>
                        <option value="" disabled selected></option>

                    </select>
                    <span>College</span>
                    <i></i>
                </div>
                <div class="Degree">
                    <select name="U_Degree" id="U_Degree" required>
                        <option value="" disabled selected></option>
                        <?php
                        include "Config.php";
                        $query_desg = "SELECT * FROM `degree_master`;";
                        $result4 = mysqli_query($conn, $query_desg);
                        while ($row = mysqli_fetch_array($result4)) {
                            echo "<option value=$row[0]>" . $row[1] . "</option>";
                        }
                        ?>
                    </select>
                    <span>Degree</span>
                    <i></i>
                </div>
                <div class="File">
                    <label for="File-upload">Add Degree Certificate :</label>
                    <input accept=".pdf" class="inpdddut" name="File-upload" id="File-upload" type="file" required>
                </div>
                <div class="Salary">
                    <input type="number" name="Salary" id="Salary" required min="10000" max="200000" title="Enter Employee Salary in Rs">
                    <span>Salary</span>
                    <i></i>
                </div>
                <button id="Submit-btn" type="submit" name="submit">Submit</button>
            </form>

        </div>
    </div>
    <!-- script link -->
    <script src="./script.js"></script>
</body>

</html>