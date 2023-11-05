<?php
session_name("admin_session");
session_start();
if (isset($_SESSION['admin_id'])) {
    require_once("../connection.php");
} else {
    session_destroy();

    session_name("assistant_manager_session");
    session_start();
    if (isset($_SESSION['asst_id'])) {
        require_once("../connection.php");
    } else {
        header("location: ../guest_side/login.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon.ico">
    <link rel="stylesheet" href="./css/admin_style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Post an Update</title>
</head>
<style>
    .posting-update {
        width: 100%;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .post-selection{
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        box-shadow: rgba(0, 0, 0, 0.04) 0px 3px 5px;
    }

    .post-selection li{
        cursor: pointer;
        list-style: none;
        background-color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
    }

    .post-selection li a{
        text-decoration: none;
        display: flex;
        flex-direction: column;
        width: 200px;
        align-items: center;
        color: #235789;
        gap: 30px;
        padding: 20px;
    }
    .post-selection li a i{
        height: 50px;
        font-size: 40px;
    }

</style>

<body>
    <?php include "./admin_sidebar.php"; ?>
    <section class="posting-update">
        <ul class="post-selection">
            <li>
                <a href="#">
                    <i class="fa-solid fa-book"></i>
                    <span>Reservation</span>
                </a>
            </li>
            <li>
                <a href="post-meals.php">
                    <i class="fa-solid fa-utensils"></i>
                    <span>Meals</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span>Discover</span>
                </a>
            </li>
            <li>
                <a href="post-announcements.php">
                    <i class="fa-solid fa-bullhorn"></i>
                    <span>Announcements</span>
                </a>
            </li>
        </ul>
    </section>
    <?php require("logout_modal.php"); ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./js/users.js"></script>
    <script src="./js/sidebar-animation.js"></script>

</body>