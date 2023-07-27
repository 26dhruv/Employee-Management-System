
<?php

include "Config.php";
session_start();
$id = $_POST['rowid'];
$del_query = "DELETE FROM `user_professional_detail` WHERE `prof_id` =$id;";
$ex = mysqli_query($conn, $del_query);
if (!$ex) {
    echo "Error in deletion";

    $_SESSION['prof_delete'] = 0;
} else {
    $_SESSION['prof_delete'] = 1;
}
header("Location: ./UserProfessionalDetail.php");
exit();
