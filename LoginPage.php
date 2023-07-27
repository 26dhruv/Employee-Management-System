<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- CSS LINK  -->
    <link rel="stylesheet" href="/Project/LoginPage.css">
    <!-- FONT LINK -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,500;0,600;1,100;1,400;1,500&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&display=swap" rel="stylesheet">
    <!-- BOOTSTRAP LINK -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>

    </script>
</head>

<body>
    <div class="bgimg"></div>
    <div class="container">
        <h1>Sign in<h1>
                <h6>If you don't have an account register.<br> You should contact you Admin</a>
                </h6>
                <img src="/Project/Pictures/LOGO.png" width="70px" height="70px" alt=""><br>
                <form action="LoginPageLogic.php" method="post">
                    <label>Email</label>
                    <span id="email_img">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="greyd" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                            <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z" />
                        </svg>
                    </span>
                    <input type="email" id="email" name="Email_Field" placeholder="Enter your username"><br>
                    <label>Password</label>
                    <span id="pass_img">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="grey" class="bi bi-key-fill" viewBox="0 0 16 16">
                            <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                        </svg>
                    </span>
                    <input type="password" id="pass" name="Password_Field" placeholder="Enter your Password">
                    <span id="unlock"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="grey" class="bi bi-unlock-fill" viewBox="0 0 16 16">
                            <path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2z" />
                        </svg></span>
                    <span id="lock"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="grey" class="bi bi-lock-fill" viewBox="0 0 16 16">
                            <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
                        </svg></span>
                    <input type="checkbox" name="Remeber_Chkbox" id="remeberme">
                    <label id="Rememebr_me">Rememebr me</label>
                    <a href="./Forg_pass_mail.php" id="forg_pass_link">Forgot Password ?</a>
                    <input type="submit" value="Sign In" id="Signin_btn">
                </form>
    </div>
    <script src="/Project/LoginPage.js"></script>
</body>

</html>