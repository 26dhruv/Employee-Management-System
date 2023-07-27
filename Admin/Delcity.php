
<?php
include "Config.php";
session_start();
$id = $_POST['rowid'];
$del_query = "DELETE FROM `city_master` WHERE `city_id` =$id;";
$ex = mysqli_query($conn, $del_query);
if (!$ex) {
    echo "Error in deletion";

    $_SESSION['city_delete'] = 0;
} else {
    $_SESSION['city_delete'] = 1;
}
header("Location: ./AddCity.php");
exit();
