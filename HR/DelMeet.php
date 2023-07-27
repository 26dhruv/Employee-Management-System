
<?php
include "Config.php";
session_start();
$id = $_POST['rowid'];
$del_query = "DELETE FROM `training_master` WHERE `t_id` =$id;";
$ex = mysqli_query($conn, $del_query);
if (!$ex) {
    echo "Error in deletion";

    $_SESSION['meet_delete'] = 0;
} else {
    $_SESSION['meet_delete'] = 1;
}
header("Location: ./ScheduleTraining.php");
exit();
