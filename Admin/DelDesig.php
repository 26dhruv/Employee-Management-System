
<?php
include "Config.php";
session_start();
$id = $_POST['rowid'];
$del_query = "DELETE FROM `designation_master` WHERE `desi_id` =$id;";
$ex = mysqli_query($conn, $del_query);
if (!$ex) {
    echo "Error in deletion";

    $_SESSION['Desg_delete'] = 0;
} else {
    $_SESSION['Desg_delete'] = 1;
}
header("Location: Designation.php");
exit();
