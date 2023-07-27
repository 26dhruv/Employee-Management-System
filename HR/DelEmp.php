<?php
include "Config.php";
session_start();
if (isset($_GET['rowid'])) {
    $id = $_GET['rowid'];
    $del_query = "DELETE FROM `user_master` WHERE `user_master`.`u_id` =$id;";
    // $del_query1 = "DELETE FROM `user_education` WHERE `user_education`.`u_edu_id` = $id;";
    $ex = mysqli_query($conn, $del_query);
    // $ex1 = mysqli_query($conn, $del_query1);
    if (!$ex ) {
        echo "Error in deletion";
        $_SESSION['emp_deleted'] = 0;
        header("Location: ./View_Employee.php");
        exit();
    } else
        $_SESSION['emp_deleted'] = 1;
    header("Location: ./View_Employee.php");
    exit();
}
