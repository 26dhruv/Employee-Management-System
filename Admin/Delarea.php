
<?php
include "Config.php";
session_start();
$id = $_POST['rowid'];
$del_query = "DELETE FROM `area_master` WHERE `area_id` =$id;";
$ex = mysqli_query($conn, $del_query);
if (!$ex) {
    echo "Error in deletion";

    $_SESSION['area_delete'] = 0;
} else {
    $_SESSION['arae_delete'] = 1;
}
header("Location: ./AddArea.php");
exit();
