<?php
include "./Config.php";
session_start();
$notification = $_POST['notification'];
$u_id = $_SESSION['u_id'];
$to_u_id = $_POST['u_id'];
$query_insert = "INSERT INTO `notification` (`notifications`, `to_u_id`,`u_id`) VALUES ('$notification','$to_u_id', '$u_id')";
if (mysqli_query($conn, $query_insert)) {
    echo  "<script>alert('Notification Sent');
    window.location.href = './Dashboard.php';
    </script>";
} else {
    echo  "<script>alert('Error in sending notification');
    window.location.href = './Dashboard.php';
    </script>";
}
