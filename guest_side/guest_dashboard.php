<?php
require("../connection.php");
session_name("user_session");
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM appointment_record WHERE user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$allAppointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "
    SELECT 
        'reception' AS reservation_type,
        reception_id AS reservation_id,
        check_in,
        check_out,
        package,
        transaction_num,
        total,
        status, 
        timestamp 
    FROM reception_reservation_record
    WHERE user_id = :user_id

    UNION ALL

    SELECT
        'recollection' AS reservation_type,
        recollection_id AS reservation_id,
        check_in,
        check_out,
        package,
        transaction_num,
        total,
        status, 
        timestamp 
    FROM recollection_reservation_record
    WHERE user_id = :user_id

    UNION ALL

    SELECT 
        'retreat' AS reservation_type,
        retreat_id AS reservation_id,
        check_in,
        check_out,
        package,
        transaction_num,
        total,
        status, 
        timestamp 
    FROM retreat_reservation_record
    WHERE user_id = :user_id

    UNION ALL

    SELECT 
        'seminar' AS reservation_type,
        seminar_id AS reservation_id,
        check_in,
        check_out,
        package,
        transaction_num,
        total,
        status, 
        timestamp 
    FROM seminar_reservation_record
    WHERE user_id = :user_id

    UNION ALL

    SELECT
        'training' AS reservation_type,
        training_id AS reservation_id,
        check_in,
        check_out,
        package,
        transaction_num,
        total,
        status, 
        timestamp
    FROM training_reservation_record
    WHERE user_id = :user_id

    ORDER BY STR_TO_DATE(timestamp, '%M %d %Y') DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./css/guest-style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,500,1,0" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
    // Include sidebar and logout modal
    include("update-reservation-details.php");
    include("update-appointment-details.php");
    include("date_time_selector.php");
    include("sidebar.php");
    require("logout_modal.php");
    ?>

    <!-- GUEST DASHBOARD STARTS HERE -->
    <section class="reservation-section">
        <div class="dash-content">
            <!-- Your dashboard content goes here -->
            <div class="profile-header">
                <?php
                if (isset($_SESSION['user_id'])) {
                    $profile_picture = isset($_SESSION['user_profile_picture']) ? $_SESSION['user_profile_picture'] : 'default_profile_picture.jpg';
                    echo '<img src="../guest_side/' . $profile_picture . '" class="user-profile-photo">';
                }
                ?>
                <div class="guest-name-email">
                    <span class="g-name">
                        <?php echo $userName; ?>
                    </span>
                    <span class="g-email">
                        <?php echo $userEmail; ?>
                    </span>
                </div>
            </div>

            <div class="semi-navigation col">
                <ul>
                    <li class="navigation-btn">
                        <a href="select_package.php">
                            <i class="fa-solid fa-book">
                                <span class="tooltip-text">
                                    RESERVE
                                </span>
                            </i>
                        </a>
                    </li>
                    <li class="navigation-btn">
                        <a href="appointment.php">
                            <i class="fa-solid fa-calendar-check">
                                <span class="tooltip-text">
                                    APPOINT
                                </span>
                            </i>
                        </a>
                    </li>
                    <li class="navigation-btn">
                        <a href="../index.php">
                            <i class="fa-solid fa-house">
                                <span class="tooltip-text">
                                    HOME
                                </span>
                            </i>
                        </a>
                    </li>
                    <li class="navigation-btn">
                        <a href="discover.php">
                            <i class="fa-solid fa-compass">
                                <span class="tooltip-text">
                                    DISCOVER
                                </span>
                            </i>
                        </a>
                    </li>
                    <li class="navigation-btn">
                        <a href="announcements.php">
                            <i class="fa-solid fa-bullhorn">
                                <span class="tooltip-text">
                                    ANNOUNCEMENTS
                                </span>
                            </i>
                        </a>
                    </li>
                    <li class="navigation-btn">
                        <a href="aboutPage.php">
                            <i class="fa-solid fa-circle-info">
                                <span class="tooltip-text">
                                    ABOUT US
                                </span>
                            </i>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
        <div class="reserve-appoint">
            <?php if (isset($_GET['success'])) { ?>
                <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
                    Submitted Successfully!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $_GET['error']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>
            <style>
                .header-nav {
                    width: 100%;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }
                .search-bar-input{
                    padding: 10px 14px;
                    border-radius: 10px;
                    border: solid 1px #cecece;
                    background-color: #fff;
                }

                .search-bar-input input{
                    border: none;
                    outline: none;
                    background-color: transparent;
                }
            </style>
            <div class="header-nav">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="reserve-tab" data-bs-toggle="tab" data-bs-target="#reserve-tab-pane" type="button" role="tab" aria-controls="reserve-tab-pane" aria-selected="true">Reservations</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="appoint-tab" data-bs-toggle="tab" data-bs-target="#appoint-tab-pane" type="button" role="tab" aria-controls="appoint-tab-pane" aria-selected="false">Appointments</button>
                    </li>
                </ul>
                <div class="search-bar-input">
                    <input type="text" placeholder="Search here..">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
            </div>

            <div class="tab-content" id="myTabContent">
                <!-- Reservations tab content -->
                <div class="tab-pane fade show active" id="reserve-tab-pane" role="tabpanel" aria-labelledby="reserve-tab" tabindex="0">
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        <?php
                       while ($row = array_shift($result)) {
                        ?>
                            <div class="col">
                                <div class="card h-100 min-width-card">
                                    <div class="card-body">
                                        <!-- Reservation details -->
                                        <div class="header">
                                            <div class="left-side">
                                                <p class="service-name"><?php echo $row['package']; ?></p>
                                            </div>
                                            <div class="right-side">

                                                <?php

                                                if ($row['status'] == 'pending') {
                                                    echo ' <span class="status-logo pending">
                                                        <i class="fa-solid fa-clock"></i>' . ucfirst($row['status']) . '</span>';
                                                }
                                                if ($row['status'] == 'cancelled') {
                                                    echo ' <span class="status-logo cancelled">
                                                        <i class="fa-solid fa-ban"></i>' . ucfirst($row['status']) . '</span>';
                                                }
                                                if ($row['status'] == 'confirmed') {
                                                    echo '  <span class="status-logo completed">
                                                        <i class="fa-solid fa-circle-check"></i>' . ucfirst($row['status']) . '</span>';
                                                } ?>
                                                </span>
                                            </div>
                                        </div>
                                        <ul>
                                            <li>Transaction # <p> <?php echo $row['transaction_num']; ?></p>
                                            </li>
                                            <li>Check-in-date <p><?php echo $row['check_in']; ?></p>
                                            </li>
                                            <li>Check-out-date <p><?php echo $row['check_out']; ?></p>
                                            </li>
                                            <li>Total Amount <p>
                                                    <?php
                                                    $totalAmount = $row['total'];
                                                    if (is_numeric($totalAmount)) {
                                                        echo '₱' . number_format($totalAmount, 2, '.', ',');
                                                    } else {
                                                        echo 'Invalid Amount';
                                                    }
                                                    ?>
                                                </p>
                                            </li>
                                        </ul>
                                        <div class="d-grid gap-2 d-md-flex justify-content-center">
                                            <?php if ($row['status'] === 'confirmed' || $row['status'] === 'cancelled') { ?>
                                                <a href="#" class="btn btn-update w-100 btnUpdateReservation" data-reservation-id="<?php echo $row['reservation_id']; ?>" data-reservation-type="<?php echo $row['reservation_type']; ?>">View</a>
                                            <?php } else if ($row['status'] === 'pending') { ?>
                                                <a href="#" class="btn btn-update w-100 btnUpdateReservation" data-reservation-id="<?php echo $row['reservation_id']; ?>" data-reservation-type="<?php echo $row['reservation_type']; ?>">Update</a>
                                                <a href="#" class="btn btn-cancel w-100 btnCancelReservation" data-reservation-id="<?php echo $row['reservation_id']; ?>" data-reservation-type="<?php echo $row['reservation_type']; ?>">Cancel</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- Appointments tab content -->
            <div class="tab-pane fade" id="appoint-tab-pane" role="tabpanel" aria-labelledby="appoint-tab" tabindex="0">
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <?php foreach ($allAppointments as $appointment) : ?>
                        <div class="col">
                            <div class="card h-100 min-width-card">
                                <div class="card-body guest-card">
                                    <div class="header">
                                        <div class="left-side">
                                            <p class="service-name">Appointment</p>
                                        </div>
                                        <div class="right-side">
                                            <?php if ($appointment['appoint_status'] === 'pending') : ?>
                                                <span class="status-logo pending">
                                                    <i class="fa-solid fa-clock"></i>
                                                    Pending
                                                </span>
                                            <?php elseif ($appointment['appoint_status'] === 'cancelled') : ?>
                                                <span class="status-logo cancelled">
                                                    <i class="fa-solid fa-ban"></i>
                                                    Cancelled
                                                </span>
                                            <?php elseif ($appointment['appoint_status'] === 'confirmed') : ?>
                                                <span class="status-logo completed">
                                                    <i class="fa-solid fa-circle-check"></i>
                                                    Confirmed
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <ul>
                                        <li>Appointment Date <p><?= $appointment['appoint_sched_date'] ?></p>
                                        </li>
                                        <li>Agenda <p><?= $appointment['appoint_description'] ?></p>
                                        </li>
                                    </ul>
                                    <?php if ($appointment['appoint_status'] === 'pending') : ?>
                                        <div class="row row-cols-2 justify-content-end">
                                            <div class="col-6">
                                                <a href="#" class="btn btn-update w-100 btnUpdateAppointment" data-appointment-id="<?php echo $appointment['appoint_id']; ?>">Update</a>
                                            </div>
                                            <div class="col-6">
                                                <a href="#" class="btn btn-cancel w-100 btnCancelAppointment" data-appointment-id="<?php echo $appointment['appoint_id']; ?>">Cancel</a>
                                            </div>
                                        </div>
                                    <?php elseif ($appointment['appoint_status'] === 'confirmed') : ?>
                                        <div class="row align-items-end">
                                            <a href="#" class="btn btn-update w-100 btnUpdateAppointment" data-appointment-id="<?php echo $appointment['appoint_id']; ?>">View</a>
                                        </div>
                                    <?php elseif ($appointment['appoint_status'] === 'cancelled') : ?>
                                        <div class="row align-items-end">
                                            <a href="#" class="btn btn-update w-100 btnUpdateAppointment" data-appointment-id="<?php echo $appointment['appoint_id']; ?>">View</a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./js/updateReservation.js"></script>
    <script src="./js/updateAppointment.js"></script>
    <script src="./js/date-time-selector-modal.js"></script>
    <script src="./js/insert_date_time.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <script src="./js/dashboard-functions.js"> </script>
</body>

</html>