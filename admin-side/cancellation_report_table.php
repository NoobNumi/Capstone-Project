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

$sql = "SELECT *
        FROM reservation_report";

$stmt = $conn->prepare($sql);
$stmt->execute();



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
    <title>Cancellation Report</title>
</head>

<body style="overflow-x: hidden;">
    <?php
    include "./admin_sidebar.php";
    include "./meal-view.php";
    include "./add-meal.php";
    ?>

    <section class="post-meals">
        <div class="admin-meal-header">
            <div class="right-section">
                <h4 class="admin-title">Cancellation Report</h4>
            </div>
        </div>
        <div>
            <form method="get" action="cancellation_report.php">
                <div class="notification-card reserve searchable-card">
                    <div class="second-section">
                        <div class="service-type">
                            <label>Date From:</label>
                            <input class="form-control report-generate" type="date" name="datefrom" required><br>
                            <div class="service"></div>
                        </div>
                    </div>

                    <div class="third-section">
                        <div class="service-type">
                            <label>Date To:</label>
                            <input class="form-control report-generate" type="date" name="dateto" required><br>
                            <div class="service"></div>
                        </div>

                    </div>
                    <div class="third-section">
                        <button type="submit" class="notif-button" style="color: #ffff; font-weight: 600">Generate</button>
                    </div>
                </div>
            </form>
    </section>

    <?php require("logout_modal.php"); ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./js/users.js"></script>
    <script src="./js/sidebar-animation.js"></script>
    <script src="./js/sidebar-closing.js"></script>
    <script src="./js/filtering-meals.js"></script>
    <script src="./js/meal.js"></script>
</body>