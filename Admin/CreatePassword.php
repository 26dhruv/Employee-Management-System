<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Password</title>
    <link rel="stylesheet" href="./CreatePassword.css">
    <link rel="stylesheet" href="./Template.css">
</head>

<body>
    <?php
    session_start();
    echo $_SESSION["Logged_in"];
    if (!$_SESSION['Logged_in'] || $_SESSION['u_role_id'] != 1) {

        header("Location: ../LoginPage.php");
        exit;
    }
    ?>
    <div class="backg_blur"></div>
    <div class="container">
        <h1>Create Password</h1>
        <form action="./CreatePassword.php" method="POST">
            <div class="email">
                <input type="email" name="user_email" id="EMAIL" readonly required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Enter email in proper formate" value="<?php if (isset($_REQUEST['u_mail'])) {
                                                                                                                                                                                        echo $_REQUEST['u_mail'];
                                                                                                                                                                                    } ?>">
                <span>Email</span>
                <i></i>
            </div>
            <div class="password">
                <input type="password" name="user_pass" id="PASSWORD" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                <span>New Password</span>
                <i></i>
            </div>
            <div class="showicon">
                <i id="unlock"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-unlock-fill" viewBox="0 0 16 16">
                        <path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2z" />
                    </svg></i>
                <i id="lock"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-lock-fill" viewBox="0 0 16 16">
                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
                    </svg></i>
            </div>
            <div class="Confirm_password">
                <input type="password" name="Confirm_user_pass" id="Confirm_PASSWORD" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                <span>Confirm New Password</span>
                <i></i>
            </div>
            <div class="Confirm_password_showicon">
                <i id="Confirm_password_unlock"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-unlock-fill" viewBox="0 0 16 16">
                        <path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2z" />
                    </svg></i>
                <i id="Confirm_password_lock"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-lock-fill" viewBox="0 0 16 16">
                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
                    </svg></i>
            </div>

            <button id="Submit-btn" type="submit" name="submit">Submit</button>

        </form>
        <?php
        include './Config.php';

        if (isset($_POST['submit'])) {
            $email = $_POST['user_email'];
            $pass = $_POST['user_pass'];
            $c_pass = $_POST['Confirm_user_pass'];
            if ($c_pass == $pass) {
                $sql = "SELECT * FROM `user_master`WHERE u_email='$email'";
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    // echo "<script>alert(\"Email Not Found\");</script>";
                } else {
                    while ($row = mysqli_fetch_array($result)) {
                        $id = $row[0];
                        $old_pass = $row[3];
                    }
                    if ($pass == $old_pass) {
                        echo "<script>alert(\"Same password as old one \");</script>";
                    } else {
                        $hash_pass = password_hash($pass, PASSWORD_DEFAULT);
                        $update_pass = "UPDATE `user_master` SET `u_pass` = '$hash_pass', `is_active` = '0' WHERE `user_master`.`u_id` = $id;";
                        $result1 = mysqli_query($conn, $update_pass);
                        if (!$result1) {
                            echo "<script>alert(\Upadation Error\");</script>";
                        } else {
                            echo "<script>alert(\"Password Successfully Set\");
                        window.location.href = \"./Dashboard.php\";
                        </script>";
                            // header("Location: ./Dashboard.php");
                            // exit();
                        }
                    }
                }
            } else {
                echo "<script>alert(\"Confrim password and new Password must match\");</script>";
            }
        }
        ?>
    </div>
    <script>
        let lock = document.querySelector('#lock');
        let unlock = document.querySelector('#unlock');
        let pass = document.querySelector('#PASSWORD');
        lock.style.opacity = 100;
        lock.addEventListener('click', () => {
            if (pass.type === "password") {
                pass.setAttribute("type", "text");
                lock.style.opacity = 0;
                unlock.style.opacity = 100;
            } else {
                pass.setAttribute("type", "password");
                lock.style.opacity = 100;
                unlock.style.opacity = 0;
            }
        });


        let Confirm_password_lock = document.querySelector('#Confirm_password_lock');
        let Confirm_password_unlock = document.querySelector('#Confirm_password_unlock');
        let Confirm_pass = document.querySelector('#Confirm_PASSWORD');
        Confirm_password_lock.style.opacity = 100;
        Confirm_password_lock.addEventListener('click', () => {
            if (Confirm_pass.type === "password") {
                Confirm_pass.setAttribute("type", "text");
                Confirm_password_lock.style.opacity = 0;
                Confirm_password_unlock.style.opacity = 100;
            } else {
                Confirm_pass.setAttribute("type", "password");
                Confirm_password_lock.style.opacity = 100;
                Confirm_password_unlock.style.opacity = 0;
            }
        });
    </script>
</body>

</html>