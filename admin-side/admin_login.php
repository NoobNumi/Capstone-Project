<?php 
    session_name("admin_session");
    session_start(); 
    require_once("../connection.php");
    $invalid = 0;
    $no_user = 0;


    if (isset($_POST['submit'])) {
        $admin_email = $_POST['admin_email'];
        $admin_password = $_POST['admin_password'];
        $query = $conn->prepare("SELECT * FROM `admin` WHERE admin_email = ?");
        $query->bindValue(1, $admin_email);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
    
        if ($query->rowCount() > 0) {
            if ($row && password_verify($admin_password, $row['admin_password'])) {
                $_SESSION['admin_id'] = $row['admin_id'];
                header('location:admin_home.php');
            } else {
                $invalid = 1;
            }
        } else {
            $no_user = 1;
        }
    }
    

    if ($invalid) {
        echo '<div class="alert alert-danger" style="text-align:center; font-size: 1.2rem;">
                <strong><i class="fa-solid fa-triangle-exclamation" style="margin-right: 12px";></i>Incorrect e-mail or password!</strong>
                </div>';
    }

    if ($no_user) {
        echo '<div class="alert alert-danger" style="text-align:center; font-size: 1.2rem;">
                <strong><i class="fa-solid fa-triangle-exclamation" style="margin-right: 12px";></i>No user found!</strong>
                </div>';
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/admin_style.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Login</title>
    <link rel="stylesheet" href="admin_style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <section class="login-container">
        <div class="main-container-login">
            <div class="side-photo">
            </div>
            <form action="" method="POST">
                <div class="admin-photo-login">
                     <img src="../images/logo_trinitas.png" class="logo-main">
                    <img class="admin-photo-title" src="../images/logo-name.png">
                </div>
                <h4 class="admin-login">Welcome!</h4>
                <span class="login-text">Please login to the <span class="admin-theme">admin dashboard</span></span>
                <div class="inputs-login">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" name="admin_email" placeholder="E-mail">
                </div>
                <div class="inputs-login">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="admin_password" placeholder="Password" id="password">
                    <i class="fa-solid fa-eye" id="togglePassword"></i>
                </div>
                <button class="btn-admin-login" name="submit" type="submit">
                    LOGIN
                </button>
            </form>
        </div>
    </section>
    <script>
        const passwordInput = document.getElementById('password');
        const togglePasswordButton = document.getElementById('togglePassword');

        togglePasswordButton.addEventListener('click', () => {
            if (passwordInput.type === 'password') {
                togglePasswordButton.classList.remove("fa-eye");
                togglePasswordButton.classList.add("fa-eye-slash");
                passwordInput.type = 'text';
                passwordInput.style.border = "none";
                passwordInput.style.outline = "none";
                passwordInput.style.background = 'transparent';
                passwordInput.style.width = 'inherit';
                passwordInput.style.fontSize = "15px";
            } else {
                passwordInput.type = 'password';
                togglePasswordButton.classList.remove("fa-eye-slash");
                togglePasswordButton.classList.add("fa-eye");
                passwordInput.style.fontSize = "15px";
            }
        });
    </script>
</body>

</html>