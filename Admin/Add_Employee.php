<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
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
    <link rel="icon" href="/Pictures/favicon.ico" type="image/x-icon">
</head>

<body>
    <?php
    session_start();

    if (!$_SESSION['Logged_in'] || $_SESSION['u_role_id'] != 1) {

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
            <h2>Admin</h2>
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

            <form action="./AddEmployeeLogic.php" method="POST" id="Register_Form" enctype="multipart/form-data">
                <div class="Name">
                    <input type="text" name="user_name" id="NAME" required maxlength="32" pattern="[A-Za-z]{2,32}" title="Must contain only character">
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
                <div class="showicon">

                    <i id="unlock"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#23242a" class="bi bi-unlock-fill" viewBox="0 0 16 16">
                            <path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2z" />
                        </svg></i>
                    <i id="lock"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#23242a" class="bi bi-lock-fill" viewBox="0 0 16 16">
                            <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
                        </svg></i>
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
                        $query_role = "SELECT * FROM `role_master`;";
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
                    <script>
                        const fileInput = document.getElementById('File-upload');
                        const maxFileSize = 10 * 1024 * 1024;

                        fileInput.addEventListener('change', function() {
                            const files = fileInput.files;
                            if (files.length > 0) {
                                const fileSize = files[0].size;
                                if (fileSize > maxFileSize) {
                                    alert('Please upload file smaller than 10MB.');
                                    fileInput.value = ''; // Clear the file input
                                }
                            }
                        });
                    </script>
                </div>

                <div class="Salary">
                    <input type="number" name="Salary" id="Salary" required min="10000" max="200000" title="Enter Employee Salary in Rs">
                    <span>Salary</span>
                    <i></i>
                </div>
                <button id="Submit-btn" type="submit" name="submit">Submit</button>
            </form>
            <script>
                let lock = document.querySelector('#lock');
                let unlock = document.querySelector('#unlock');
                let pass = document.querySelector('#PASSWORD');
                lock.style.opacity = 100;
                lock.addEventListener('click', () => {
                    if (pass.type === "password") {
                        pass.setAttribute("type", "text");
                        lock.style.opacity = 0;
                        unlock.style.opacity = 100;
                    } else {
                        pass.setAttribute("type", "password");
                        lock.style.opacity = 100;
                        unlock.style.opacity = 0;
                    }
                });
            </script>
        </div>
    </div>
    <!-- script link -->
    <script src="./script.js"></script>
</body>

</html>