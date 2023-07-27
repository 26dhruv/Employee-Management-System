
<?php
include "Config.php";
session_start();
$id = $_POST['rowid'];
$del_query = "DELETE FROM `state_master` WHERE `state_id` =$id;";
$ex = mysqli_query($conn, $del_query);
if (!$ex) {
    echo "Error in deletion";

    $_SESSION['state_delete'] = 0;
    echo "<script>alert('error in deletion');
    window.location='./AddState.php';
    </script>";
} else {
    $_SESSION['state_delete'] = 1;
    header("Location: ./AddState.php");
    exit();
}
