
<?php
include "Config.php";
session_start();
$id = $_POST['rowid'];
$del_query = "DELETE FROM `leave_type_master` WHERE `leave_type_id` =$id;";
$ex = mysqli_query($conn, $del_query);
if (!$ex) {
    echo "Error in deletion";
}
header("Location: ./Leavetype.php");
exit();
