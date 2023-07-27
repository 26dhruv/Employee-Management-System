<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <link rel="stylesheet" href="./ForgetPassword.css">
    <link rel="stylesheet" href="./Template.css">
</head>

<body>
    <div class="backg_blur"></div>
    <div class="container">
        <h1>Forget Password ?</h1>
        <form action="./ForgetPassword.php" method="post">
            <p>No worries<br> Create your new password here!</p>
            <div class="email">
                <input type="email" name="user_email" id="EMAIL" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Enter email in proper formate">
                <span>Email</span>
                <i></i>
            </div>
            <div class="Confirm_password">
                <input type="password" name="user_pass" id="Confirm_PASSWORD" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                <span>New Password</span>
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
        include "./Config.php";
        if (isset($_POST['submit'])) {
            $email = $_POST['user_email'];
            $pass = $_POST['user_pass'];


            $sql = "SELECT * FROM `user_master` WHERE u_email='$email'";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                echo "<script>alert(\"Email Not Found\");</script>";
            } else {
                $rowcount = mysqli_num_rows($result);
                if ($rowcount <= 0) {
                    echo "<script>alert(\"Email Not Found\");</script>";
                } else {
                    while ($row = mysqli_fetch_array($result)) {
                        $id = $row[0];
                    }
                    $hash_pass = password_hash($pass, PASSWORD_DEFAULT);
                    $update_pass = "UPDATE `user_master` SET `u_pass` = '$hash_pass' WHERE `user_master`.`u_id` = $id;";
                    $result1 = mysqli_query($conn, $update_pass);
                    if (!$result1) {
                        echo "<script>alert(\"Upadation Error\");</script>";
                    } else {
                        echo "<script>alert(\"Password Successfully Updated\");
                    window.location.href = '/project/LoginPage.php';
                    </script>";
                    }
                }
            }
        }

        ?>
    </div>
    <script>
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