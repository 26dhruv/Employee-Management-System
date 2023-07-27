
<?php
include "Config.php";
session_start();
$id = $_POST['rowid'];
$del_query = "DELETE FROM `degree_master` WHERE `degree_id` =$id;";
$ex = mysqli_query($conn, $del_query);
if (!$ex) {
    echo "Error in deletion";

    $_SESSION['deg_delete'] = 0;
} else {
    $_SESSION['deg_delete'] = 1;
}
header("Location: ./AddDegree.php");
exit();
