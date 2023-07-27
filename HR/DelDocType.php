<?php
include "Config.php";
if (isset($_POST['rowid'])) {
    $id = $_POST['rowid'];
    $del_query = "DELETE FROM `doc_type_master` WHERE `doc_type_id` =$id";
    $ex = mysqli_query($conn, $del_query);
    if (!$ex) {
        echo "Error in deletion";
        $_SESSION['doc_type_deleted'] = 1;
    } else {

        $_SESSION['doc_type_deleted'] = 0;
    }
    header("Location: ./DocType.php");
    exit();
}
