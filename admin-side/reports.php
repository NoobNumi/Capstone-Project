<?php
session_name("admin_session");
session_start();
error_reporting(E_ALL);
require_once("../connection.php");
if (isset($_SESSION['admin_id'])) {
   
}else {
    session_destroy();

    //session_name("assistant_manager_session");
    session_start();
    if (isset($_SESSION['asst_id'])) {
        require "fetch_counts_query.php";
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/admin_style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Reports</title>
</head>

<body>
    <?php
        include("./admin_sidebar.php");
    ?>
    <!-- ALL MESSAGES BEGINS HERE -->
    <section class="">
        <section class="reservations-list">
        <div class="reserve-appoint-header">
            <div class="right-section">
                <h4 class="admin-title">Reports</h4>
               
            </div>
            <div class="center-section">
                <div class="search-bar-admin">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="searchInput" placeholder="Search here...">
                </div>
            </div>
        </div>
        <div class="notification-list">
                <div class="notification-card reserve searchable-card">
                <div class="first-section">
                <div class="guest-details-admin">
                <h4>Sales Report</h4>
                </div>
                </div>
                <div class="second-section">
                <div class="section-content">
                </div>
                </div>
                <div class="third-section">
                <div class="notif-button" data-reservation-id="" data-reservation-type="">
                <a href="sales_report_table.php" class="btn-view">View</a>
                </div>
                </div>
                </div>
                 <div class="notification-card reserve searchable-card">
                <div class="first-section">
                <div class="guest-details-admin">
                <h4>Frequency Report</h4>
                </div>
                </div>
                <div class="second-section">
                <div class="section-content">
                </div>
                </div>
                <div class="third-section">
                <div class="notif-button" data-reservation-id="" data-reservation-type="">
                <a href="frequency_report_table.php" class="btn-view">View</a>
                </div>
                </div>
                </div>
                 <div class="notification-card reserve searchable-card">
                <div class="first-section">
                <div class="guest-details-admin">
                <h4>Reservation Report</h4>
                </div>
                </div>
                <div class="second-section">
                <div class="section-content">
                </div>
                </div>
                <div class="third-section">
                <div class="notif-button" data-reservation-id="" data-reservation-type="">
                <a href="reservation_report_table.php" class="btn-view">View</a>
                </div>
                </div>
                </div>
                 <div class="notification-card reserve searchable-card">
                <div class="first-section">
                <div class="guest-details-admin">
                <h4>Appointment Report</h4>
                </div>
                </div>
                <div class="second-section">
                <div class="section-content">
                </div>
                </div>
                <div class="third-section">
                <div class="notif-button" data-reservation-id="" data-reservation-type="">
                <a href="appointment_report_table.php" class="btn-view">View</a>
                </div>
                </div>
                </div>
                 <div class="notification-card reserve searchable-card">
                <div class="first-section">
                <div class="guest-details-admin">
                <h4>Cancellation Report</h4>
                </div>
                </div>
                <div class="second-section">
                <div class="section-content">
                </div>
                </div>
                <div class="third-section">
                <div class="notif-button" data-reservation-id="" data-reservation-type="">
                <a href="cancellation_report_table.php" class="btn-view">View</a>
                </div>
                </div>
                </div>
        </div>
    </section>
        <?php  require("logout_modal.php");?>
    </section>
    <!-- ALL MESSAGE ENDS HERE -->
</body>

<script src="./js/users.js"></script>
<script src="./js/admin-chat.js"></script>
<script src="./js/search.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
<script src="./js/sidebar-animation.js"></script>

</html>