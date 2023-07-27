<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Panel</title>
    <!-- css link -->
    <link rel="stylesheet" href="./Template.css">
    <link rel="stylesheet" href="./ReportGeneration.css">
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
    ?>

    <div class="main">
        <h1>Report Generation</h1>
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
        <div class="Main-Box">


            <div class="Salary-Generation">
                <h2>Salary Details</h2>
                <form action="./reportlogic.php" method="POST" id="Register_Form">
                    <div class="Name">
                        <select name="u_id" id="u_id" required>
                            <option value="" disabled selected></option>
                            <?php
                            include "Config.php";
                            $query1 = "SELECT u_id,u_name FROM `user_master` WHERE role_id=1 or role_id=2;";
                            $result3 = mysqli_query($conn, $query1);
                            while ($row = mysqli_fetch_array($result3)) {
                                echo "<option value=$row[0]>" . "(" . $row[0] . ")" . $row[1] . "</option>";
                            }
                            ?>
                        </select>
                        <span>Name</span>
                        <i></i>
                    </div>
                    <button id="Submit-btn" type="submit" name="salary">Generate</button>
                    <p>*Note : It will generate a PDF of the details.</p>
                </form>
            </div>
            <div class="Consolidated-Salary">
                <h2>Consolidated Salary</h2>
                <form action="./consreport.php" method="POST" id="Register_Form">
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
                    <button id="Submit-btn" type="submit" name="cons">Generate</button>
                    <p>*Note : It will generate a PDF of the details.</p>
                </form>
            </div>
            <div class="Employee-Details">
                <h2>Employee Details</h2>
                <form action="./empdetailsrepo.php" method="POST" id="Register_Form">
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
                    <button id="Submit-btn" type="submit" name="emp">Generate</button>
                    <p>*Note : It will generate a PDF of the details.</p>
                </form>
            </div>
            <div class="Leave-Details">
                <h2>Leave Details</h2>
                <form action="./leavereport.php" method="POST" id="Register_Form">
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
                    <button id="Submit-btn" type="submit" name="leave">Generate</button>
                    <p>*Note : It will generate a PDF of the details.</p>
                </form>
            </div>

        </div>
        <script src="script.js"></script>
</body>

</html>