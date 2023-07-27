<?php
include 'Config.php';
session_start();
$u_id = $_SESSION['u_id'];

//header("Content-Type: text/html");
// echo "<p>This is the HTML response to the JavaScript call</p>";
if (isset($_GET['q'])) {
    $id = $_GET['q'];
    $sql = "SELECT * FROM `training_master` WHERE t_id LIKE '$id%'";
    $result = mysqli_query($conn, $sql);
    if ($id == "") {
        echo "";
    } else {
        echo " ";
        while ($row = mysqli_fetch_array($result)) {
            $id = $row[0];
            $meet_id = $row[1];
            $pass = $row[2];
            $dt = $row[5];
            $desc = $row[4];
            $dur = $row[3];
            echo "
       
        <tr>
        <td>" . $id . "</td>
        <td>" . $meet_id . "</td>
        <td>" . $pass . "</td>
        <td>" . $dt . "</td>
        <td>" . $desc . "</td>
        <td>" . $dur . "</td>
       
                            <td><form method='post' action='./DelMeet.php'>
                            <input type='hidden' name='rowid' value='$row[0]''>
                            <input type='submit' value='delete' name='Deletebtn' id='Delbtn' onClick='javascript: return confirm(\"Please confirm deletion\");'></td>
                        </form> 
    </tr>";
        }
    }
} else if (isset($_GET['leave_id'])) {
    $id = $_GET['leave_id'];



    if ($id == "") {

        $sql = "SELECT * FROM `user_leave` WHERE u_id='$u_id'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
            if ($row[7] == 3)
                $status = "Pending";
            elseif ($row[7] == 2)
                $status = "Accepted";
            elseif ($row[7] == 1)
                $status = "Rejected";
            $query1 = "SELECT u_name FROM `user_master` WHERE u_id=$row[2];";
            $result2 = mysqli_query($conn, $query1);
            while ($row1 = mysqli_fetch_array($result2)) {
                $name = $row1[0];
            }
            $query2 = "SELECT leave_type FROM `leave_type_master` WHERE leave_type_id=$row[1];";
            $r = mysqli_query($conn, $query2);
            while ($row3 = mysqli_fetch_array($r)) {
                $type = $row3[0];
            }
            $id = $row[0];
            $meet_id = $row[1];
            $pass = $row[2];
            $dt = $row[5];
            $desc = $row[4];
            $dur = $row[3];
            echo "
       
        <tr>
        <td>" . $id . "</td>
        <td>" . $name . "</td>
        <td>" . $row[3] . "</td>
        <td>" . $row[4] . "</td>
        <td>" . $row[6] . "</td>
        <td>" . $type . "</td>
        <td>" . $row[8] . "</td>
        <td>" . $status . "</td>


    </tr>";
        }
    } else {
        $sql = "SELECT * FROM `user_leave` WHERE leave_id LIKE '$id%' AND u_id=$u_id";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
            if ($row[7] == 3)
                $status = "Pending";
            elseif ($row[7] == 2)
                $status = "Accepted";
            elseif ($row[7] == 1)
                $status = "Rejected";
            $query1 = "SELECT u_name FROM `user_master` WHERE u_id=$row[2];";
            $result2 = mysqli_query($conn, $query1);
            while ($row1 = mysqli_fetch_array($result2)) {
                $name = $row1[0];
            }
            $query2 = "SELECT leave_type FROM `leave_type_master` WHERE leave_type_id=$row[1];";
            $r = mysqli_query($conn, $query2);
            while ($row3 = mysqli_fetch_array($r)) {
                $type = $row3[0];
            }
            $id = $row[0];
            $meet_id = $row[1];
            $pass = $row[2];
            $dt = $row[5];
            $desc = $row[4];
            $dur = $row[3];
            echo "
       
        <tr>
        <td>" . $id . "</td>
        <td>" . $name . "</td>
        <td>" . $row[3] . "</td>
        <td>" . $row[4] . "</td>
        <td>" . $row[6] . "</td>
        <td>" . $type . "</td>
        <td>" . $row[8] . "</td>
        <td>" . $status . "</td>


    </tr>";
        }
    }
} else if (isset($_GET['app_leave_id'])) {
    $id1 = $_GET['app_leave_id'];
    include "Config.php";
    $query1 = "SELECT u_id,u_name FROM `user_master` WHERE role_id='2';";
    $result2 = mysqli_query($conn, $query1);
    while ($row1 = mysqli_fetch_array($result2)) {
        $id = $row1[0]; //fetching u_id
        $name = $row1[1];
        $query = "SELECT * FROM `user_leave` WHERE leave_id LIKE '$id1%' AND  u_id=$id;";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_array($result)) {

            $query2 = "SELECT leave_type FROM `leave_type_master` WHERE leave_type_id=$row[1];";
            $r = mysqli_query($conn, $query2);
            while ($row3 = mysqli_fetch_array($r)) {
                $leave_type = $row3[0];
            }

            if ($row[7] == 3)
                $status = "Pending";
            elseif ($row[7] == 2)
                $status = "Accepted";
            elseif ($row[7] == 1)
                $status = "Rejected";


            if ($row[7] == 3) {
                $a_r = "<a class='leave_A_R' href='#' id='$row[0]'>Approve/Reject<a>";
            } elseif ($row[7] == 2)
                $a_r = "Accepted";
            elseif ($row[7] == 1)
                $a_r = "Rejected";
            echo "
            <tr>
                        <td>$row[0]</td>
                        <td>$name</td>
                        <td>$row[3]</td>
                        <td>$row[4]</td>
                        <td>$row[6]</td>
                        <td>$leave_type</td>
                        <td>$row[8]</td>
                        <td>$status</td>
                        <td>$a_r</td>
                    </tr>
                    <script src='./script.js'></script>

                    ";
        }
    }
} else if (isset($_GET['emp_id'])) {
    $id1 = $_GET['emp_id'];
    $query = "SELECT * FROM `user_master` WHERE u_id LIKE '$id1%' AND u_id!=$u_id;";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "";
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

        echo "
                    <tr>
                        <td>$row[0]</td>
                        <td>$row[1]</td>
                        <td>$row[2]</td>
                        <td>$desg</td>
                        <td>$dept</td>
                        <td>
                            <form method='get' action='DelEmp.php'>
                                <input type='hidden' name='rowid' value='$row[0]'>
                                <input class='btn-default' type='submit' name='login' value='Delete' id='Delbtn' onClick=\"javascript: return confirm('Please confirm deletion\");'>
                            </form>
                            <form method='post' action='Update_Emp.php'>
                                <input type='hidden' name='rowid' value='$row[0]'>
                                <input type='submit' value='update' name='Updatebtn' id='Updbtn' onclick='location.href = './Update_Emp.php';'>
                            </form>
                        </td>
                    </tr>";
    }
} else if (isset($_GET['u_prof_detail'])) {
    $id1 = $_GET['u_prof_detail'];
    $query = "SELECT * FROM `user_professional_detail` WHERE u_id LIKE '$id1%';";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "error";
    } else {
        while ($row = mysqli_fetch_array($result)) {
            $user = "SELECT u_id,u_name FROM `user_master` WHERE u_id=$row[6];";
            $user_result = mysqli_query($conn, $user);
            while ($row1 = mysqli_fetch_array($user_result)) {
                echo "
                            <tr>
                            <td>(" . $row1[0] . ")" . $row1[1] . "</td>";
            }
            echo "
                        <td>$row[1]</td>
                        <td>$row[2]</td>
                        <td>$row[3]</td>
                        <td>$row[4]</td>
                        <td>$row[5]</td>
                        <td>
                            <form method='post' action='./Delprofdet.php'>
                            <input type='hidden' name='rowid' value='$row[0]'>
                            <input type='submit' value='delete' name='Deletebtn' id='Delbtn' onClick='javascript: return confirm(\"Please confirm deletion\");'>
                            </form>
                        </td>
                    </tr>";
        }
    }
} else if (isset($_GET['uni_id'])) {
    $id1 = $_GET['uni_id'];
    $query = "SELECT * FROM `uni_master` WHERE uni_id LIKE '$id1%';";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "error";
    }
    while ($row = mysqli_fetch_array($result)) {
        echo
        "
        <tr>
            <td>$row[0]</td>
            <td>$row[1]</td>
                <td>
                <form method='post' action='./DelUni.php'>
                <input type='hidden' name='rowid' value='$row[0]'>
                <input type='submit' value='delete' name='Deletebtn' id='Delbtn' onClick='javascript: return confirm(\"Please confirm deletion\");'>
                </form>
                </td>  
         </tr>";
    }
} elseif (isset($_GET['cllg_id'])) {
    $id1 = $_GET['cllg_id'];
    $query = "SELECT * FROM `college_master` WHERE clg_id LIKE '$id1%';";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "error";
    }
    while ($row = mysqli_fetch_array($result)) {
        echo
        "
        <tr>
            <td>$row[0]</td>
            <td>$row[1]</td>
                <td>
                <form method='post' action='./DelCllg.php'>
                <input type='hidden' name='rowid' value='$row[0]'>
                <input type='submit' value='delete' name='Deletebtn' id='Delbtn' onClick='javascript: return confirm(\"Please confirm deletion\");'>
                </form>
                </td>  
         </tr>";
    }
} else if (isset($_GET['deg_id'])) {
    $id1 = $_GET['deg_id'];
    $query = "SELECT * FROM `degree_master` WHERE degree_id LIKE '$id1%';";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "error";
    }
    while ($row = mysqli_fetch_array($result)) {
        echo
        "
        <tr>
            <td>$row[0]</td>
            <td>$row[1]</td>
                <td>
                <form method='post' action='./Deldegree.php'>
                <input type='hidden' name='rowid' value='$row[0]'>
                <input type='submit' value='delete' name='Deletebtn' id='Delbtn' onClick='javascript: return confirm(\"Please confirm deletion\");'>
                </form>
                </td>  
         </tr>";
    }
} else if (isset($_GET['state_id'])) {
    $id1 = $_GET['state_id'];
    $query = "SELECT * FROM `state_master` WHERE state_id LIKE '$id1%';";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "error";
    }
    while ($row = mysqli_fetch_array($result)) {
        echo
        "
        <tr>
            <td>$row[0]</td>
            <td>$row[1]</td>
                <td>
                <form method='post' action='./Delstate.php'>
                <input type='hidden' name='rowid' value='$row[0]'>
                <input type='submit' value='delete' name='Deletebtn' id='Delbtn' onClick='javascript: return confirm(\"Please confirm deletion\");'>
                </form>
                </td>  
         </tr>";
    }
} else if (isset($_GET['city_id'])) {
    $id1 = $_GET['city_id'];
    $query = "SELECT * FROM `city_master` WHERE city_id LIKE '$id1%';";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "error";
    }
    while ($row = mysqli_fetch_array($result)) {
        $query1 = "SELECT state FROM `state_master` WHERE state_id=$row[2];";
        $result1 = mysqli_query($conn, $query1);
        if (!$result1) {
            echo "error";
        }
        while ($row1 = mysqli_fetch_array($result1)) {
            $state = $row1[0];
        }
        echo
        "
        <tr>
            <td>$row[0]</td>
            <td>$row[1]</td>
            <td>$state</td>
                <td>
                <form method='post' action='./Delcity.php'>
                <input type='hidden' name='rowid' value='$row[0]'>
                <input type='submit' value='delete' name='Deletebtn' id='Delbtn' onClick='javascript: return confirm(\"Please confirm deletion\");'>
                </form>
                </td>  
         </tr>";
    }
} else if (isset($_GET['area_id'])) {
    $id1 = $_GET['area_id'];
    $query = "SELECT * FROM `area_master` WHERE area_id LIKE '$id1%';";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "error";
    }
    while ($row = mysqli_fetch_array($result)) {
        $query2 = "SELECT state FROM `state_master` WHERE state_id=$row[3];";
        $result2 = mysqli_query($conn, $query2);
        if (!$result2) {
            echo "error";
        }
        while ($row2 = mysqli_fetch_array($result2)) {
            $state = $row2[0];
        }
        $query1 = "SELECT city FROM `city_master` WHERE city_id=$row[2];";
        $result1 = mysqli_query($conn, $query1);
        if (!$result1) {
            echo "error";
        }
        while ($row1 = mysqli_fetch_array($result1)) {
            $city = $row1[0];
        }
        echo
        "
        <tr>
            <td>$row[0]</td>
            <td>$row[1]</td>
            <td>$city</td>
            <td>$state</td>
                <td>
                <form method='post' action='./Delarea.php'>
                <input type='hidden' name='rowid' value='$row[0]'>
                <input type='submit' value='delete' name='Deletebtn' id='Delbtn' onClick='javascript: return confirm(\"Please confirm deletion\");'>
                </form>
                </td>  
         </tr>";
    }
} elseif (isset($_GET['dept_id'])) {
    $id1 = $_GET['dept_id'];
    $query = "SELECT * FROM `dept_master` WHERE dept_id LIKE '$id1%';";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "error";
    }
    while ($row = mysqli_fetch_array($result)) {
        echo
        "
        <tr>
            <td>$row[0]</td>
            <td>$row[1]</td>
                <td>
                <form method='post' action='./DelDep.php'>
                <input type='hidden' name='rowid' value='$row[0]'>
                <input type='submit' value='delete' name='Deletebtn' id='Delbtn' onClick='javascript: return confirm(\"Please confirm deletion\");'>
                </form>
                </td>  
         </tr>";
    }
} elseif (isset($_GET['desg_id'])) {
    $id1 = $_GET['desg_id'];
    $query = "SELECT * FROM `designation_master` WHERE desi_id LIKE '$id1%';";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "error";
    }
    while ($row = mysqli_fetch_array($result)) {
        $query1 = "SELECT dept_name FROM `dept_master` WHERE dept_id=$row[2];";
        $result1 = mysqli_query($conn, $query1);
        if (!$result) {
            echo "error";
        }
        while ($row1 = mysqli_fetch_array($result1)) {
            $dep = "$row1[0]";
        }
        echo
        "
        <tr>
            <td>$row[0]</td>
            <td>$row[1]</td>
            <td>$dep</td>
                <td>
                <form method='post' action='./DelDesig.php'>
                <input type='hidden' name='rowid' value='$row[0]'>
                <input type='submit' value='delete' name='Deletebtn' id='Delbtn' onClick='javascript: return confirm(\"Please confirm deletion\");'>
                </form>
                </td>  
         </tr>";
    }
} else if (isset($_GET['assign_leave_id'])) {
    $id1 = $_GET['assign_leave_id'];
    $query = "SELECT * FROM `leave_balance` WHERE u_id LIKE '$id1%';";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "error";
    }
    while ($row = mysqli_fetch_array($result)) {



        $user = "SELECT u_id,u_name FROM `user_master` WHERE u_id=$row[3];";
        $user_result = mysqli_query($conn, $user);
        while ($row1 = mysqli_fetch_array($user_result)) {
            echo "<td>(" . $row1[0] . ")" . $row1[1] . "</td>";
        }

        $user1 = "SELECT * FROM `leave_type_master` WHERE leave_type_id=$row[4];";
        $user_result1 = mysqli_query($conn, $user1);
        while ($row2 = mysqli_fetch_array($user_result1)) {
            echo  "<td>" . $row2[1] . "</td>";
        }
        echo "
            <td>$row[1]</td>

                <td>            <form method='post' action='./Delleave_bal.php'>
                <input type='hidden' name='rowid' value='$row[0]'><input type='submit' value='delete' name='Deletebtn' id='Delbtn' onClick='javascript: return confirm(\"Please confirm deletion\");'>            </form>
                </td>
        </tr>";
    }
}
