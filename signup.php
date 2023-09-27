<!-- sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php
    session_name("user_session");
    session_start();
    require_once("../connection.php");
    $invalid = 0;
    $user_exist = 0;

    if (isset($_POST['submit'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = ($_POST['password']);
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $cpassword = ($_POST['cpassword']);

        if ($password === $cpassword) {

            $query = $conn->prepare("SELECT * FROM `users` WHERE first_name = ? AND last_name = ?");
            $query->bindValue(1, $first_name);
            $query->bindValue(2, $last_name);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_ASSOC);

            if ($query->rowCount() > 0) {
                $user_exist = 1;
            } else {
                $query = "INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)";
                $run_query = $conn->prepare($query);

                $data = [
                    ':first_name' => $first_name,
                    ':last_name' => $last_name,
                    ':email' => $email,
                    ':password' => $passwordHash

                ];

                $query_execute = $run_query->execute($data);
                if ($query_execute) {
                    echo
                    '<script>
                    $(document).ready(function () {
                            Swal.fire({
                                title: "Success!",
                                text: "You have successfully signed up!",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 2500
                            }).then(() => {
                                window.location.href = "login.php";
                            });
                        });
                    </script>';
                }
            }
        } else {
            $invalid = 1;
        }
    }

    if ($invalid) {
        echo '<div class="alert alert-danger" style="text-align:center; font-size: 1.2rem;">
                <strong><i class="fa-solid fa-triangle-exclamation" style="margin-right: 12px"></i>Passwords dont match!</strong>
                </div>';
    }
    if ($user_exist) {
        echo '<div class="alert alert-danger" style="text-align:center; font-size: 1.2rem;">
                <strong><i class="fa-solid fa-triangle-exclamation" style="margin-right: 12px";></i>User already exists!</strong>
                </div>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./css/guest-style.css">
    <title>Signup</title>
</head>
<body>
    <section class="signup-page">

        <div class="first-navbar">
            <div class="logo">
                <img src="../images/logo_trinitas.png">
                <h1>Trinitas</h1>
            </div>
        </div>
        <div class="signup-form">
            <form class="signup" action="" method="POST">
                <p class="title">Sign up</p>
                <p class="message">All Fields are required </p>
                <div class="flex">
                    <label>
                        <input required="" placeholder="" type="text" class="input" name="first_name">
                        <span>Firstname</span>
                    </label>

                    <label>
                        <input required="" placeholder="" type="text" class="input" name="last_name">
                        <span>Lastname</span>
                    </label>
                </div>

                <label>
                    <input required="" placeholder="" type="email" class="input" name="email">
                    <span>Email</span>
                </label>
                <div class="flex">
                    <label>
                        <input required="" placeholder="" type="password" class="input" name="password">
                        <span>Password</span>
                    </label>
                    <label>
                        <input required="" placeholder="" type="password" class="input" name="cpassword">
                        <span>Confirm password</span>
                    </label>
                </div>
                <div class="flex">
                    <input type="checkbox" required>
                    <label for="checkbox">
                        <p class="terms-and-conditions">I have read and agreed to the terms and conditions</p>
                    </label>
                </div>
                <button class="btn-login-signup" type="submit" name="submit">SIGN UP</button>
                <p class="signin">Already have an acount ? <a href="login.php" style="text-decoration: none;">Login</a> </p>
                <p class="copyright">Copyright &copy <script>
                        document.write(new Date().getFullYear())
                    </script> Trinitas </br> All Rights Reserved </p>
            </form>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>