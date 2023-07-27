<?php
include "Config.php";
session_start();
$id = $_POST['u_id'];
$name = $_POST["user_name"];
$mail = $_POST["user_email"];
$pass = $_POST["user_pass"];
$gen = $_POST["user_gender"];
$state = $_POST["user_state"];
$city = $_POST["user_city"];
$area = $_POST["user_area"];
$dept = $_POST["user_dept"];
$desg = $_POST["user_desig"];
$number = $_POST["user_contact"];
$dob = $_POST["user_dob"];
$doj = $_POST["user_doj"];
$role = $_POST["user_role"];
$uni = $_POST['U_University'];
$cllg = $_POST['U_College'];
$degree = $_POST['U_Degree'];
$sal = $_POST['Salary'];
$y_sal = $sal * 12;
$query_update = "UPDATE `user_master` SET `u_name` = '$name',`u_email` = '$mail', `u_pass` = '$pass', `u_contact` = '$number', `is_active` = '0', `u_doj` = '$doj', `u_dob` = '$dob', `state_id` = '$state', `city_id` = '$city', `area_id` = '$area', `role_id` = '$role', `desg_id` = '$desg', `dept_id` = '$dept', `gender` = '$gen' WHERE `user_master`.`u_id` = '$id';";
$query_update1 = "UPDATE `user_education` SET `degree_id` = '$degree', `uni_id` = '$uni', `clg_id` = '$cllg' WHERE `user_education`.`u_id` ='$id';";
$query_update2 = "UPDATE `user_salary` SET `m_salary` = '$sal', `y_salary` = '$y_sal' WHERE `user_salary`.`u_id` = '$id';";
$ex = mysqli_query($conn, $query_update);
$ex1 = mysqli_query($conn, $query_update1);
$ex2 = mysqli_query($conn, $query_update2);
if ($ex && $ex1 && $ex2) {
    $_SESSION['emp_updated'] = 1;
    header("Location: ./Update_Emp.php?rowid=" . $id);
    exit();
} else {
    $_SESSION['emp_updated'] = 0;
    header("Location: ./Update_Emp.php");
    exit();
}
