<?php
include "Config.php";
session_start();
$_SESSION['emp_added'] = 3;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $u_name = $_POST['user_name'];
    $mail = $_POST['user_email'];
    $pass = $_POST['user_pass'];
    $contact = $_POST['user_contact'];
    $dob = $_POST['user_dob'];
    $doj = $_POST['user_doj'];
    $gen = $_POST['user_gender'];
    $state = $_POST['user_state'];
    $city = $_POST['user_city'];
    $area = $_POST['user_area'];
    $role = $_POST['user_role'];
    $dept = $_POST['user_dept'];
    $desig = $_POST['user_desig'];
    $uni = $_POST['U_University'];
    $cllg = $_POST['U_College'];
    $degree = $_POST['U_Degree'];
    $sal = $_POST['Salary'];
    $y_sal = $sal * 12;
    $hash_pass = password_hash($pass, PASSWORD_DEFAULT);
    echo $hash_pass;
    $folder = "../pdf/";
    $file_name = $_FILES['File-upload']['name'];
    $file_tmp = $_FILES['File-upload']['tmp_name'];

    move_uploaded_file($file_tmp, $folder . $file_name);


    $get_dep = "SELECT * FROM `user_master` WHERE u_email='$mail'";
    $resultdep = mysqli_query($conn, $get_dep);



    $get_dep1 = "SELECT * FROM `user_master` WHERE u_contact='$contact'";
    $resultdep1 = mysqli_query($conn, $get_dep1);





    if (mysqli_num_rows($resultdep) > 0) {
        echo "<script>alert('email already exists'); window.location.href = './Add_Employee.php';</script>";
    } else if (mysqli_num_rows($resultdep1) > 0) {
        echo "<script>alert('contact already exists'); window.location.href = './Add_Employee.php';</script>";
    } else {

        $query1 = "INSERT INTO `user_master` (`u_name`, `u_email`,`u_pass`,`u_contact`,`is_active`,`u_doj`,`u_dob`,`state_id`,`city_id`,`area_id`,`role_id`,`desg_id`,`dept_id`,`gender`) VALUES ( '$u_name','$mail','$hash_pass','$contact','1','$doj','$dob','$state','$city','$area','$role','$desig','$dept','$gen');";
        if (mysqli_query($conn, $query1)) {
            $query5 = "SELECT u_id from `user_master` where u_contact=$contact";
            $result5 = mysqli_query($conn, $query5);
            if (!$result5) {
                echo "<script>alert('error'); window.location.href = './Add_Employee.php';</script>";
            }
            while ($row5 = mysqli_fetch_array($result5)) {
                $u_id = $row5[0];
            }
            $query = "INSERT INTO `user_education`(`degree_certi_doc`,`u_id`,`degree_id`,`uni_id`,`clg_id`) VALUES ('$file_name','$u_id','$degree','$uni','$cllg');";
        } else {
            echo "<script>alert('error'); window.location.href = './Add_Employee.php';</script>";
        }
        //  echo "<script>alert('Record inserted'); window.location.href = './Add_Employee.php';</script>";

        //link for mail
        $Link = 'http://localhost/Project/LoginPage.php';
        if (mysqli_query($conn, $query)) {
            $to = 'dhruveshpatel2004@gmail.com';
            //
            // *** Subject Email ***
            $subject = 'Welcome to our company!';
            //
            // *** Content Email ***
            $template = file_get_contents('./EmailTemplate.php');
            $template = str_replace('{User}', $u_name, $template);
            $template = str_replace('{Link}', $Link, $template);
            $template = str_replace('{Email}', $mail, $template);
            $template = str_replace('{Password}', $pass, $template);
            //*** Head Email ***
            $headers = 'From: mailserveraddress7089@gmail.com' . "\r\n" .
                'Reply-To: mailserveraddress7089@gmail.com' . "\r\n" .
                'Content-type: text/html; charset=UTF-8' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
            //
            //*** Show the result... ***
            if (mail($to, $subject, $template, $headers)) {
                echo "Mail sent Successfully";
            } else {
                echo "ERROR";
            }
            $query4 = "SELECT * FROM `user_master` WHERE u_email='$mail'";
            $res1 = mysqli_query($conn, $query4);
            while ($row = mysqli_fetch_array($res1)) {
                $id = $row[0];
            }
            $lwp = 1;
            $pf = 1;
            $tds = 1;
            $pt = 1;
            $t = $lwp + $pf + $tds + $pt;
            //echo $t;
            $subsal = ($t / 100) * $y_sal;
            //echo  $subsal;
            $finalsal = $y_sal - $subsal;
            $query3 = "INSERT INTO `user_salary` (`m_salary`, `y_salary`, `work_days`, `lv_days`, `lwp`, `tds`, `pf`, `pt`, `net_payable_salary`, `u_id`) VALUES ( '$sal', '$y_sal', '1', '1', '$lwp', '$tds', '$pf', '$pt', '$finalsal', '$id')";
            $sal_res = mysqli_query($conn, $query3);
            if ($sal_res) {
                $_SESSION['emp_added'] = 0;
                header("Location: ./Add_Employee.php");
            } else {
                $_SESSION['emp_added'] = 1;
                header("Location: ./Add_Employee.php");
            }
        } else {
            $_SESSION['emp_added'] = 1;
            header("Location: ./Add_Employee.php");
        }
    }
}
