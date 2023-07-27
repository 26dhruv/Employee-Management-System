<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- css link -->
    <link rel="stylesheet" href="./Template.css">
    <link rel="stylesheet" href="./Update_Emp.css">
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
    if (isset($_SESSION['emp_updated'])) {
        if ($_SESSION['emp_updated'] == 0) {
    ?>
            <script>
                alert("Error cannot upadte employee");
            </script>
        <?php
            unset($_SESSION['emp_updated']);
        } else if ($_SESSION['emp_updated'] == 1) {
        ?>
            <script>
                alert("Employee updated successfully");
            </script>
    <?php
            unset($_SESSION['emp_updated']);
        }
    }
    ?>
    <div class="main">
        <h1>Update Employee</h1>
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

            <form action="./update_emp1.php" method="POST" id="Register_Form">
                <?php
                include "Config.php";
                if (isset($_GET["rowid"]))
                    $ID = $_GET["rowid"];
                else
                    $ID = $_REQUEST['rowid'];
                //echo $ID;
                $query = "SELECT * FROM `user_master` WHERE u_id='$ID';";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    echo "error";
                } else {
                    while ($row = mysqli_fetch_array($result)) {
                        $id = $row[0];
                        $name = $row[1];
                        $mail = $row[2];
                        $pass = $row[3];
                        $contact = $row[4];
                        $doj = $row[6];
                        $dob = $row[7];
                        $state_id = $row[8];
                        $city_id = $row[9];
                        $area_id = $row[10];
                        $role_id = $row[11];
                        $desg_id = $row[12];
                        $dept_id = $row[13];
                        $gender = $row[14];
                    }
                }
                $query1 = "SELECT * FROM `user_education` WHERE u_id='$ID';";
                $result1 = mysqli_query($conn, $query1);
                if (!$result1) {
                    echo "error";
                } else {
                    while ($row = mysqli_fetch_array($result1)) {
                        $doc = $row[1];
                        $degree = $row[3];
                        $uni = $row[4];
                        $clg = $row[5];
                    }
                }
                ?>
                <input type="hidden" name="u_id" value=<?php echo $id; ?>>
                <div class="Name">
                    <input type="text" value="<?php echo $name; ?>" name="user_name" id="NAME" required maxlength="32" pattern="[A-Za-z]{2,32}" title="Must contain only character">
                    <span>Username</span>
                    <i></i>
                </div>
                <div class="email">
                    <input type="email" name="user_email" id="EMAIL" value="<?php echo $mail; ?>" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Enter email in proper formate">
                    <span>Email</span>
                    <i></i>
                </div>
                <div class="password">
                    <input type="password" name="user_pass" id="PASSWORD" value="<?php echo $pass; ?>" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
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
                <div class="contact">
                    <input type="number" name="user_contact" id="U_CONTACT" value="<?php echo $contact; ?>" required pattern="[0-9]{10}" title="Must contain 10 Numbers">
                    <span>10 digit Contact No.</span>
                    <i></i>
                </div>
                <div class="Dob">
                    <input type="text" name="user_dob" id="U_DOB" max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>" value="<?php echo $dob; ?>" required onfocus="(this.type='date')" onblur="(this.type='text')">
                    <span>Date of birth</span>
                    <i></i>
                </div>
                <div class="Doj">
                    <input type="text" name="user_doj" id="U_DOJ" min="<?php echo date('Y-m-d'); ?>" value="<?php echo $doj; ?>" required onfocus="(this.type='date')" onblur="(this.type='text')">
                    <span>Date of Joining</span>
                    <i></i>
                </div>
                <div class="Gender">
                    <select name="user_gender" id="Gender" required title="Please select gender">
                        <? if ($gender == 0) {
                            echo " <option value=1 >Male</option>";
                            echo "<option value=0 selected>Female</option>";
                        } else {
                            echo " <option value=1 selected>Male</option>";
                            echo "<option value=0 >Female</option>";
                        }
                        ?>
                    </select>
                    <span>Gender</span>
                    <i></i>
                </div>
                <div class="State">
                    <select name="user_state" id="U_STATE" onchange="getCities()" required>
                        <?php

                        $query_state = "SELECT * FROM `state_master`;";
                        $result3 = mysqli_query($conn, $query_state);
                        while ($row_state = mysqli_fetch_array($result3)) {
                            if ($row_state[0] == $state_id) {
                                echo "<option value=$row_state[0] selected>" . $row_state[1] . "</option>";
                            } else
                                echo "<option value=$row_state[0]>" . $row_state[1] . "</option>";
                        }
                        ?>

                    </select>
                    <span>State</span>
                    <i></i>
                </div>
                <div class="City">
                    <select name="user_city" id="U_CITY" onchange="getArea()" required>
                        <?php

                        $query_city = "SELECT * FROM `city_master` WHERE state_id='$state_id';";
                        $result3 = mysqli_query($conn, $query_city);
                        while ($row_city = mysqli_fetch_array($result3)) {
                            if ($row_city[0] == $city_id) {
                                echo "<option value=$row_city[0] selected>" . $row_city[1] . "</option>";
                            } else {
                                echo "<option value=$row_city[0]>" . $row_city[1] . "</option>";
                            }
                        }
                        ?>

                    </select>
                    <span>City</span>
                    <i></i>
                </div>
                <div class="Area">
                    <select name="user_area" id="U_AREA" required>

                        <?php
                        $query_area = "SELECT * FROM `area_master` WHERE city_id='$city_id';";
                        $result2 = mysqli_query($conn, $query_area);
                        while ($row_area = mysqli_fetch_array($result2)) {
                            if ($row_area[0] == $area_id) {
                                echo "<option value=$row_area[0] selected>" . $row_area[1] . "</option>";
                            } else
                                echo "<option value=$row_area[0]>" . $row_area[1] . "</option>";
                        }
                        ?>
                    </select>
                    <span>Area</span>
                    <i></i>
                </div>
                <div class="Role">
                    <select name="user_role" id="U_ROLE" required>
                        <?php
                        $query_role = "SELECT * FROM `role_master`;";
                        $result10 = mysqli_query($conn, $query_role);
                        while ($row_role = mysqli_fetch_array($result10)) {
                            if ($row_role[0] == $role_id) {
                                echo "<option value=$row_role[0] selected>" . $row_role[1] . "</option>";
                            } else
                                echo "<option value=$row_role[0]>" . $row_role[1] . "</option>";
                        }
                        ?>
                    </select>
                    <span>Role</span>
                    <i></i>
                </div>
                <div class="Dept">
                    <select name="user_dept" id="U_DEPT" onchange="getdesi()" required>
                        <?php
                        $query_dept = "SELECT * FROM `dept_master`;";
                        $result15 = mysqli_query($conn, $query_dept);
                        while ($row_dept = mysqli_fetch_array($result15)) {
                            if ($row_dept[0] == $dept_id) {
                                echo "<option value=$row_dept[0] selected>" . $row_dept[1] . "</option>";
                            } else
                                echo "<option value=$row_dept[0]>" . $row_dept[1] . "</option>";
                        }
                        ?>
                    </select>
                    <span>Deptartment</span>
                    <i></i>
                </div>
                <div class="Desig">
                    <select name="user_desig" id="U_DESIG" required>
                        <?php
                        $query_desg = "SELECT * FROM `designation_master` WHERE dept_id='$dept_id';";
                        $result14 = mysqli_query($conn, $query_desg);
                        while ($row_desg = mysqli_fetch_array($result14)) {
                            if ($row_desg[0] == $desg_id) {

                                echo "<option value=$row_desg[0] selected>" . $row_desg[1] . "</option>";
                            } else
                                echo "<option value=$row_desg[0]>" . $row_desg[1] . "</option>";
                        }
                        ?>

                    </select>
                    <span>Designation</span>
                    <i></i>
                </div>
                <div class="University">
                    <select name="U_University" id="University" onchange="getCllg()" required>
                        <?php

                        $query_state = "SELECT * FROM `uni_master`;";
                        $result3 = mysqli_query($conn, $query_state);
                        while ($row_state = mysqli_fetch_array($result3)) {
                            if ($row_state[0] == $uni) {
                                echo "<option value=$row_state[0] selected>" . $row_state[1] . "</option>";
                            } else
                                echo "<option value=$row_state[0]>" . $row_state[1] . "</option>";
                        }
                        ?>



                    </select>
                    <span>University</span>
                    <i></i>
                </div>
                <div class="College">
                    <select name="U_College" id="U_College" required>
                        <?php
                        $query_desg = "SELECT * FROM `college_master` WHERE uni_id='$uni';";
                        $result14 = mysqli_query($conn, $query_desg);
                        while ($row_desg = mysqli_fetch_array($result14)) {
                            if ($row_desg[0] == $clg) {

                                echo "<option value=$row_desg[0] selected>" . $row_desg[1] . "</option>";
                            } else
                                echo "<option value=$row_desg[0]>" . $row_desg[1] . "</option>";
                        }
                        ?>


                    </select>
                    <span>College</span>
                    <i></i>
                </div>
                <div class="Degree">
                    <select name="U_Degree" id="U_Degree" required>
                        <?php
                        $query_desg = "SELECT * FROM `degree_master`;";
                        $result14 = mysqli_query($conn, $query_desg);
                        while ($row_desg = mysqli_fetch_array($result14)) {
                            if ($row_desg[0] == $degree) {

                                echo "<option value=$row_desg[0] selected>" . $row_desg[1] . "</option>";
                            } else
                                echo "<option value=$row_desg[0]>" . $row_desg[1] . "</option>";
                        }
                        ?>

                    </select>
                    <span>Degree</span>
                    <i></i>
                </div>
                <div class="File">
                    <label for="File-upload">Add Degree Certificate :</label>
                    <input accept=".pdf" class="inpdddut" name="File-upload" id="File-upload" type="file" value="<? echo $doc; ?>">
                </div>
                <div class="Salary">
                    <input type="number" name="Salary" id="Salary" required min="10000" max="200000" value="<?php
                                                                                                            $query_sal = "SELECT * FROM `user_salary` where u_id='$id';";
                                                                                                            $result3 = mysqli_query($conn, $query_sal);
                                                                                                            while ($row_sal = mysqli_fetch_array($result3)) {
                                                                                                                echo $row_sal[1]; //displaying monthly salary
                                                                                                            }
                                                                                                            ?>">
                    <span>Salary</span>
                    <i></i>
                </div>
                <button id="Submit-btn" type="submit" name="submit">Update</button>
            </form>

        </div>
    </div>
    <!-- script link -->
    <script src="./script.js"></script>
    <script>
        // Disable and Enable Submit Button
        // function en() {
        //     const submitButton = document.querySelector('button');
        //     const formElements = document.querySelectorAll('input, select, textarea');

        //     // Store initial values in an object
        //     const initialValues = {};
        //     formElements.forEach(element => {
        //         initialValues[element.name] = element.value;
        //     });

        //     // Add event listeners to update object when form elements change
        //     formElements.forEach(element => {
        //         element.addEventListener('change', event => {
        //             initialValues[event.target.name] = event.target.value;
        //         });
        //     });

        //     // Periodically check if any values have changed
        //     setInterval(() => {
        //         let valuesChanged = false;
        //         formElements.forEach(element => {
        //             if (initialValues[element.name] !== element.value) {
        //                 valuesChanged = true;
        //             }
        //         });
        //         if (valuesChanged) {
        //             submitButton.disabled = false;
        //         }
        //     }, 1000);

        // }

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
</body>

</html>