<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forg_pass_mail</title>
    <link rel="stylesheet" href="./Forg_pass_mail.css">
    <link rel="stylesheet" href="./Template.css">
</head>

<body>
    <div class="backg_blur"></div>
    <div class="container">
        <h1>Reset Password</h1>
        <p>Enter your password we will send you a <br>Email with a link</p>
        <form action="./Forg_pass_mail.php" method="POST">
            <div class="email">
                <input type="email" name="user_email" id="EMAIL" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Enter email in proper formate">
                <span>Email</span>
                <i></i>
            </div>
            <button id="Submit-btn" type="submit" name="submit">Submit</button>
        </form>
        <?php
        $Link = 'http://localhost/Project/ForgetPassword.php';
        if (isset($_POST['user_email'])) {

            $toEmail = $_POST['user_email'];
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $to = $toEmail;
                //
                // *** Subject Email ***
                $subject = 'Reset Pasword Link';
                //
                // *** Content Email ***
                $template = file_get_contents('./tempForForgPass.php');

                $template = str_replace('{Link}', $Link, $template);
                //*** Head Email ***
                $headers = 'From: mailserveraddress7089@gmail.com' . "\r\n" .
                    'Reply-To: mailserveraddress7089@gmail.com' . "\r\n" .
                    'Content-type: text/html; charset=UTF-8' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                //
                //*** Show the result... ***
                if (mail($to, $subject, $template, $headers)) {
        ?>
                    <script>
                        alert("Mail is sent check you inbox")
                    </script>
        <?php
                } else {
                    echo "ERROR";
                }
            }
        }
        ?>
</body>

</html>