
<?php
include "Config.php";
session_start();
$id = $_POST['rowid'];
$del_query = "DELETE FROM `dept_master` WHERE `dept_id` =$id;";
$ex = mysqli_query($conn, $del_query);
if (!$ex) {
    echo "Error in deletion";

    $_SESSION['Dep_delete'] = 0;
} else {
    $_SESSION['Dep_delete'] = 1;
}
header("Location: ./Manage_Department.php");
exit();
