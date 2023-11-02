<?php
session_name("admin_session");
session_start();
if (isset($_SESSION['admin_id'])) {
    require_once("../connection.php");
    require "fetch_counts_query.php";
} else {
    session_destroy();

    session_name("assistant_manager_session");
    session_start();
    if (isset($_SESSION['asst_id'])) {
        require_once("../connection.php");
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/admin_style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Admin Home</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body style="overflow-x: hidden;">
    <?php
    include("add-sched-modal.php");
    include("admin_sidebar.php");
    ?>
    <section class="admin-dashboard">
        <div class="charts">
            <div class="graph-card">
                <div class="col radar" id="radar"></div>
            </div>
            <div class="graph-card">
                <div class="col column" id="column"></div>
            </div>
        </div>
        <div class="row row-cols-2">
            <div class="col first-col">
                <a href="#">
                    <div class="container-header">
                        <span class="container-name">
                            Users
                        </span>
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <p class="total-number">
                        <?php echo $userCount; ?>
                    </p>
                </a>
            </div>
            <?php
            if (isset($_SESSION['admin_id'])) {      
            ?>
            <div class="col first-col">
                <a href="reservation-view.php">
                    <div class="container-header">
                        <span class="container-name">
                            Reservations
                        </span>
                        <i class="fa-solid fa-clipboard-list"></i>
                    </div>
                    <p class="total-number">
                        <?php echo $totalReservations; ?>
                    </p>
                    <?php if ($totalPendingReservations > 0) { ?>
                        <div class="pending-services">
                            <span class="sub-text">Pending:</span>
                            <span class="sub-number">
                                <?php echo $totalPendingReservations; ?>
                            </span>
                        </div>
                    <?php } ?>
                </a>
                </div>
            <?php } elseif (isset($_SESSION['asst_id'])) {
                //SHOULD DISPLAY NONE
            }
            ?>
            <div class="col middle-col">
                <a href="appointment_view.php">
                    <div class="container-header">
                        <span class="container-name">
                            Appointments
                        </span>
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <p class="total-number">
                        <?php echo $appointmentCount; ?>
                    </p>
                    <?php if ($pendingAppointmentsCount > 0) { ?>
                        <div class="pending-services">
                            <span class="sub-text">Pending:</span>
                            <span class="sub-number">
                                <?php echo $pendingAppointmentsCount; ?>
                            </span>
                        </div>

                    <?php } ?>
                </a>
            </div>

            <div class="col middle-col">
                <a href="#">
                    <div class="container-header">
                        <span class="container-name">
                            Cancellations
                        </span>
                        <span class="cancel-icon">
                            <img src="../images/cancelbookingicon.svg">
                        </span>
                    </div>
                    <p class="total-number">
                        18
                    </p>
                </a>
            </div>
            <div class="col last-col">
                <a href="#">
                    <div class="container-header">
                        <span class="container-name">
                            Reports
                        </span>
                        <i class="fa-solid fa-flag"></i>
                    </div>
                    <p class="total-number">
                        18
                    </p>
                </a>
            </div>
        </div>
    </section>
    <?php
    require("logout_modal.php");
    ?>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="./js/users.js"></script>
<script src="./js/admin-chat.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="./js/charts.js"></script>
<script src="./js/sidebar-animation.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>


</html>