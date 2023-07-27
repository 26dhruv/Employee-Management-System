<?php
include "Config.php";
if (isset($_POST['rowid'])) {
    $id = $_POST['rowid'];
    $del_query = "DELETE FROM `leave_balance` WHERE `bal_id` =$id";
    $ex = mysqli_query($conn, $del_query);
    if (!$ex) {
        echo "Error in deletion";
        $_SESSION['leave_assign_deleted'] = 1;
    } else {

        $_SESSION['leave_assign_deleted'] = 0;
    }
    header("Location: ./AssignLeave.php");
    exit();
}
