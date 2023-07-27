<?php
include 'Config.php';
session_start();
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
    </tr>";
        }
    }
} else if (isset($_GET['leave_id'])) {
    $id = $_GET['leave_id'];

    $u_id = $_SESSION['u_id'];


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
        $sql = "SELECT * FROM `user_leave` WHERE leave_id LIKE '$id%' AND u_id='$u_id'";
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
} elseif (isset($_GET['escolate_id'])) {
    $id = $_GET['escolate_id'];
    $u_id = $_SESSION['u_id'];
    $sql = "SELECT * FROM `issue` WHERE issue_id LIKE '$id%' AND u_id='$u_id'";
    $result = mysqli_query($conn, $sql);
    if ($id == "") {
        echo "";
    } else {
        echo " ";

        while ($row = mysqli_fetch_array($result)) {
            if ($row[4] == 3)
                $status = "Pending";
            elseif ($row[4] == 2)
                $status = "Solved";
            elseif ($row[4] == 1)
                $status = "Rejected";
            echo "
       
        <tr>
        <td>" . $row[0] . "</td>
        <td>" . $row[2] . "</td>
        <td>" . $row[1] . "</td>
        <td>" . $row[3] . "</td>
        <td>" . $status . "</td>
       

    </tr>";
        }
    }
}
