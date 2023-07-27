
<?php
include "Config.php";
session_start();
$mail = $_POST['Email_Field'];
$pass = $_POST['Password_Field'];
$role_id = 5;
echo $mail . "," . $pass;

$query = "SELECT * FROM `user_master` WHERE u_email='$mail';";
$result = mysqli_query($conn, $query);
if (!$result) {
    echo "<script>alert(\"Incorrect Email\");
                        window.location.href = \"./LoginPage.php\";
                        </script>";
} else {
    $check = mysqli_num_rows($result);
    if ($check > 0) {

        while ($row = mysqli_fetch_array($result)) {
            $role_id = $row[11];
            $pas = $row[3];
            $_SESSION['u_id'] = $row[0];
            $_SESSION['prof_delete'] = 3;
            $_SESSION['u_role_id'] = $row[11];
            $create_pass = $row[5];
        }


        if (password_verify($pass, $pas)) {

            $_SESSION["Logged_in"] = true;

            if ($role_id == 0 && $create_pass == 0) {
                header("Location: ./HR/Dashboard.php");
                exit();
            } else if ($role_id == 1 && $create_pass == 0) {
                header("Location: ./Admin/Dashboard.php");
                exit();
            } else if ($role_id == 2 && $create_pass == 0) {
                header("Location: ./Employee/Dashboard.php");
                exit();
            } else if ($role_id == 0 && $create_pass == 1) {
                header("Location: ./HR/CreatePassword.php?u_mail=" . $mail);
            } else if ($role_id == 1 && $create_pass == 1) {
                header("Location: ./Admin/CreatePassword.php?u_mail=" . $mail);
            } else if ($role_id == 2 && $create_pass == 1) {
                header("Location: ./Employee/CreatePassword.php?u_mail=" . $mail);
            } else {
                echo "Error";
            }
        } else {
            echo "<script>alert(\"Incorrect Password\");
                        window.location.href = \"./LoginPage.php\";
                        </script>";
        }
    } else {
        echo "<script>alert(\"Incorrect Email\");
        window.location.href = \"./LoginPage.php\";
        </script>";
    }
}
