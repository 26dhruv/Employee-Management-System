
<?php
include "Config.php";
session_start();
$id = $_POST['rowid'];
$del_query = "DELETE FROM `college_master` WHERE `clg_id` =$id;";
$ex = mysqli_query($conn, $del_query);
if (!$ex) {
    echo "Error in deletion";

    $_SESSION['uni_delete'] = 0;
} else {
    $_SESSION['uni_delete'] = 1;
}
header("Location: ./AddCollege.php");
exit();
