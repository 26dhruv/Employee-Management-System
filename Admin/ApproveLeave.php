<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- css link -->
    <link rel="stylesheet" href="./Template.css">
    <link rel="stylesheet" href="./ApproveLeave.css">
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
    if (!$_SESSION['Logged_in'] || $_SESSION['u_role_id'] != 1) {

        header("Location: ../LoginPage.php");
        exit;
    }
    ?>

    <div class="main">
        <h1>Approve Leave</h1>
        <div class="navbar">
            <h2>Admin</h2>
            <!-- <div class="card">
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="card-inner"></div> -->
            <!-- <input type="search" name="Emp-search" id="Emp-search" placeholder="Search"> -->
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
        <table>
            <tr>
                <th width="10%">Name</th>
                <th width="10%">Date From</th>
                <th width="10%">Date To</th>
                <th width="30%">Description</th>
                <th width="10%">type</th>
                <th width="10%">Reply</th>
                <th width="10%">Status</th>
                <th width="10%">Approve/Reject</th>
            </tr>
            <?php
            include "Config.php";
            $query1 = "SELECT u_id,u_name FROM `user_master` WHERE role_id='2' OR role_id='0';";
            $result2 = mysqli_query($conn, $query1);
            while ($row1 = mysqli_fetch_array($result2)) {
                $id = $row1[0];
                $name = $row1[1];
                $query = "SELECT * FROM `user_leave` WHERE u_id=$id;";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    echo "error";
                }
                while ($row = mysqli_fetch_array($result)) {
            ?>
                    <tr>

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

                        <td><?php

                            if ($row[7] == 3) {
                                echo "<a class='leave_A_R' href='#' id='$row[0]'>Approve/Reject<a>";
                            } elseif ($row[7] == 2)
                                echo "Accepted";
                            elseif ($row[7] == 1)
                                echo "Rejected"

                            ?>

                        </td>


                    </tr>
            <?php
                }
            } ?>

        </table>
    </div>
    <div class="overlay"></div>
    <div class="PopupMenu">
        <form action="./ApproveLeave.php" method="POST" id="LeaveApproval" onsubmit="setTimeout(function(){window.location.reload();},10);">

            <p>Approve Leave</p>
            <div class="Status">
                <select name="status" id="status">
                    <option value="" disabled selected></option>
                    <option value="2">Accepted</option>
                    <option value="1">Rejected</option>
                </select>
                <span>Status</span>
                <i></i>
            </div>
            <div class="RejectReason">
                <textarea name="reject_reason" id="reject_reason" cols="20" rows="10"></textarea>
                <span>Status</span>
                <i></i>
            </div>
            <input type="hidden" name="leave_id" value="">
            <button type="submit" id="done">Submit</button>
            <a href="" id="cancel">Cancel</a>
        </form>

        <?php
        if (isset($_POST['status'])) {

            $status = $_POST['status'];
            $reason = $_POST['reject_reason'];
            $id = $_POST['leave_id'];
            if ($status = 2) {
                $q = "SELECT no_leave,leave_type_id,u_id FROM user_leave WHERE leave_id=$id";
                $ex = mysqli_query($conn, $q);
                while ($rs = mysqli_fetch_array($ex)) {
                    $leave_no = $rs[0];
                    $leave_type_id = $rs[1];
                    $u_id = $rs[2];
                }
                $query3 = "UPDATE leave_balance SET leave_left=lv_balance-$leave_no WHERE u_id=$u_id AND leave_type_id=$leave_type_id";
                $result4 = mysqli_query($conn, $query3);
            }
            $query = "UPDATE `user_leave` SET `status` = '$status', `rej_reason` = '$reason' WHERE `user_leave`.`leave_id` = $id";
            $result3 = mysqli_query($conn, $query);

            //  echo "<script>window.location.reload();</script>";
        }

        ?>

    </div>


    </div>
    </div>
    <!-- script link -->
    <script src="./script.js"></script>
    <script>
        let links = document.querySelectorAll('.leave_A_R');
        links.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // prevent the link from navigating
                let linkId = this.getAttribute('id');
                // console.log(linkId);
                sendLinkId(linkId);
            });
        });

        function sendLinkId(id) {
            // send an AJAX request to a PHP script with the link ID
            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'App.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                document.querySelector('input[name=leave_id]').value = xhr.responseText;
                console.log(document.querySelector('input[name=leave_id]').value) // handle the response from the PHP script
            };
            xhr.send('link_id=' + id);
            // window.location.href = "./App.php";
        }
    </script>
</body>

</html>