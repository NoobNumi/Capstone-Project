<?php
require_once("../connection.php");
$invalid = 0;

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    session_name("admin_session"); 
    session_start();

    $query = $conn->prepare("SELECT * FROM `admin` WHERE admin_email = ?");
    $query->bindValue(1, $email);
    $query->execute();
    $adminRow = $query->fetch(PDO::FETCH_ASSOC);

    if ($adminRow && password_verify($password, $adminRow['admin_password'])) {
        echo '<script>console.log("Logged in as Admin");</script>';
        $_SESSION['admin_id'] = $adminRow['admin_id'];
        header('location: ../admin-side/admin_home.php');
        exit();
    } else {
        session_destroy();

        session_name("assistant_manager_session");
        session_start();

        $query = $conn->prepare("SELECT * FROM `assistant_manager` WHERE assist_email = ?");
        $query->bindValue(1, $email);
        $query->execute();
        $assistantRow = $query->fetch(PDO::FETCH_ASSOC);

        if ($assistantRow && password_verify($password, $assistantRow['assist_password'])) {
            echo '<script>console.log("Logged in as Assistant Manager");</script>';
            $_SESSION['asst_id'] = $assistantRow['asst_id'];
            header('location: ../admin-side/admin_home.php');
            exit();
        } else {
            session_destroy();

            session_name("user_session");
            session_start();

            $query = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
            $query->bindValue(1, $email);
            $query->execute();
            $userRow = $query->fetch(PDO::FETCH_ASSOC);
            
            if ($userRow && password_verify($password, $userRow['password'])) {
                echo '<script>console.log("Logged in as Regular User");</script>';
                $_SESSION['user_id'] = $userRow['user_id'];

                $_SESSION['user_profile_picture'] = $userRow['profile_picture'];
                if (isset($_POST['login'])) {
                }
                header('location: ../index.php');
                exit();
                
            } else {
                session_destroy();

                session_name("no_user_session");
                session_start();

                $invalid = 1;
            }
        }
    }
}

if ($invalid) {
    echo '<div class="alert alert-danger warning" style="text-align:center; font-size: 1.2rem;">
                <strong><i class="fa-solid fa-triangle-exclamation" style="margin-right: 12px";></i>Incorrect e-mail or password!</strong>
            </div>';
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />
    <link rel="stylesheet" href="./css/guest-style.css">
    <title>Login</title>
</head>
<body>
    <section class="login-page">
        <div class="first-navbar">
            <div class="logo">
                <img src="../images/logo_trinitas.png">
                <h1>Trinitas</h1>
            </div>
        </div>
        <div class="login-form">
            <form class="login" action="" method="POST">
                <div class="logo">
                    <img class="logo-mary" src="../images/logo_trinitas.png" width="135px">
                    <img class="logo-title" src="../images/logo-name.png" width="150px">
                </div>
                <p class="title">Login</p>
                <p class="message">Login to avail our services</p>

                <div class="email-div">
                    <span class="material-symbols-rounded" id="email" id="span-icon">
                        mail
                    </span>
                    <label>
                        <input required="" placeholder="Email" type="email" name="email" class="input">
                    </label>
                </div>
                <div class="password-div">
                    <span class="material-symbols-rounded" id="span-icon">
                        lock
                    </span>
                    <label>
                        <input required="" placeholder="Password" type="password" name="password" class="input" id="password">
                    </label>
                    <span class="material-symbols-rounded eye" id="togglePassword">
                        visibility
                    </span>
                </div>
                <button class="btn-login-signup" type="submit" name="submit">LOGIN</button>
                <div class="separator">
                    <hr class="line">
                    </hr>
                    <p>OR</p>
                    <hr class="line">
                    </hr>
                </div>
                <div class="continue-browsing">
                    <a class="btn-login-signup" href="index.php">Continue browsing</a>
                </div>
                <p class="signin">Don't have an account yet? <a href="signup.php" style="text-decoration: none;">Signup</a> </p>
                <p class="copyright">Copyright &copy <script>
                        document.write(new Date().getFullYear())
                    </script> Trinitas </br> All Rights Reserved </p>
            </form>
        </div>
    </section>
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            var spanElement = document.getElementById('togglePassword');
            spanElement.addEventListener('contextmenu', function (e) {
                e.preventDefault();
            });
        }); 
        const passwordInput = document.getElementById('password');
        const togglePasswordButton = document.getElementById('togglePassword');

        togglePasswordButton.addEventListener('click', () => {
            if (passwordInput.type === 'password') {
                togglePasswordButton.innerHTML = '<span class="material-symbols-rounded">visibility_off</span>';
                passwordInput.type = 'text';
                passwordInput.style.border = "none";
                passwordInput.style.outline = "none";
                passwordInput.style.background = 'transparent';
                passwordInput.style.width = '100%';
                passwordInput.style.padding = '10px 0 10px 10px';
            } else {
                togglePasswordButton.innerHTML = '<span class="material-symbols-rounded">visibility</span>';
                passwordInput.type = 'password';
            }
        });
    </script>
</body>

</html>