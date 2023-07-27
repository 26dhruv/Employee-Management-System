
<?php
include "Config.php";
session_start();
$id = $_POST['rowid'];
$del_query = "DELETE FROM `issue` WHERE `issue_id` =$id;";
$ex = mysqli_query($conn, $del_query);
if (!$ex) {
    echo "Error in deletion";

    $_SESSION['issue_delete'] = 0;
} else {
    $_SESSION['issue_delete'] = 1;
}
header("Location: ./EscolateIssue.php");
exit();
