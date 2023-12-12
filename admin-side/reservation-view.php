<?php
session_name("admin_session");
session_start();
require_once("../connection.php");
if (isset($_SESSION['admin_id'])) {
    require "fetch_counts_query.php";
} else {
    session_destroy();

    session_name("assistant_manager_session");
    session_start();
    if (isset($_SESSION['asst_id'])) {
        require "fetch_counts_query.php";
    } else {
        header("location: ../guest_side/login.php");
        exit;
    }
}

$reservationType = '';

try {
    $sql = "SELECT 
                r.reception_id AS res_id, 
                r.user_id, 
                r.first_name, 
                r.last_name, 
                u.profile_picture, 
                r.check_in, 
                r.status, 
                r.total, 
                'reception' AS type 
            FROM reception_reservation_record r
            JOIN users u ON r.user_id = u.user_id

            UNION ALL

            SELECT 
                r.recollection_id AS res_id, 
                r.user_id, 
                r.first_name, 
                r.last_name, 
                u.profile_picture, 
                r.check_in, 
                r.status, 
                r.total, 
                'recollection' 
            FROM recollection_reservation_record r
            JOIN users u ON r.user_id = u.user_id

            UNION ALL

            SELECT 
                r.retreat_id AS res_id, 
                r.user_id, 
                r.first_name, 
                r.last_name, 
                u.profile_picture, 
                r.check_in, 
                r.status, 
                r.total, 
                'retreat' 
            FROM retreat_reservation_record r
            JOIN users u ON r.user_id = u.user_id

            UNION ALL

            SELECT 
                r.seminar_id AS res_id, 
                r.user_id, 
                r.first_name, 
                r.last_name, 
                u.profile_picture, 
                r.check_in, 
                r.status, 
                r.total, 
                'seminar' 
            FROM seminar_reservation_record r
            JOIN users u ON r.user_id = u.user_id

            UNION ALL

            SELECT 
                r.training_id AS res_id, 
                r.user_id, 
                r.first_name, 
                r.last_name, 
                u.profile_picture, 
                r.check_in, 
                r.status, 
                r.total, 
                'training' 
            FROM training_reservation_record r
            JOIN users u ON r.user_id = u.user_id

            ORDER BY STR_TO_DATE(check_in, '%M %d %Y') DESC";

    $result = $conn->query($sql);
} catch (PDOException $e) {
    die("Error fetching data: " . $e->getMessage());
}

try {
    $sqlCount = "SELECT COUNT(*) AS total_reservations FROM (
                SELECT reception_id AS res_id FROM reception_reservation_record
                UNION ALL
                SELECT recollection_id FROM recollection_reservation_record
                UNION ALL
                SELECT retreat_id FROM retreat_reservation_record
                UNION ALL
                SELECT seminar_id FROM seminar_reservation_record
                UNION ALL
                SELECT training_id FROM training_reservation_record
            ) AS all_reservations";
    $resultCount = $conn->query($sqlCount);
    $row = $resultCount->fetch(PDO::FETCH_ASSOC);
    $totalReservations = $row['total_reservations'];
} catch (PDOException $e) {
    die("Error fetching data: " . $e->getMessage());
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Reservations</title>
</head>

<body style="overflow-x: hidden;">
    <?php
    include("./admin_sidebar.php");
    include("./reservation_details_view.php"); //included
    include("./confirm_delete_modal.php");
    require("logout_modal.php");
    ?>
    <section class="reservations-list">
        <div class="reserve-appoint-header">
            <div class="right-section">
                <h4 class="admin-title">Reservations</h4>
                <p class="total-indicator">You have <span class="total-num"><?php echo $totalReservations; ?></span> total reservation(s)</p>
            </div>
            <div class="center-section">
                <div class="search-bar-admin">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="searchInput" placeholder="Search here...">
                </div>
            </div>
            <div class="left-section">
                <select name="selectedStatus" class="sorting-list">
                    <option value="">All</option>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
        </div>
        <div class="notification-list">
            <?php
            $reservationsExist = false;

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $reservationType = $row['type'];
                $userName = $row["first_name"] . " " . $row["last_name"];
                $status = $row["status"];
                $dateTime = $row["check_in"];
                $total = $row["total"];
                $profilePicture = $row["profile_picture"];

                $reservationsExist = true;
                echo '<div class="notification-card reserve searchable-card">';
                echo '<div class="first-section">';
                echo '<img src="../guest_side/' . $profilePicture . '" alt="Profile Picture">';
                echo '<div class="guest-details-admin">';
                echo '<span class="guest">' . $userName . '</span>';
                echo '<span class="status ' . $status . '" data-status="' . $status . '">';
                echo ucfirst($status);
                if ($status === 'confirmed') {
                    echo '<i class="fa-solid fa-check"></i>';
                } elseif ($status === 'pending') {
                    echo '<i class="fa-solid fa-hourglass-start"></i>';
                } elseif ($status === 'cancelled') {
                    echo '<i class="fa-solid fa-ban"></i>';
                }
                echo '</span>';
                echo '</div>';
                echo '</div>';
                echo '<div class="second-section">';
                echo '<div class="section-content">';
                echo '<div class="service-type">';
                echo '<div class="detail-title"><i class="fa-solid fa-briefcase"></i>SERVICE TYPE</div>';
                echo '<div class="service">' . ucfirst($reservationType) . '</div>';
                echo '</div>';
                echo '<div class="reservation-details">';
                echo '<div class="detail-title"><i class="fa-solid fa-calendar-days"></i>DATE</div>';
                echo '<div class="date">' . $dateTime . '</div>';
                echo '</div>';
                echo '<div class="appoint-details">';
                echo '<div class="detail-title"><i class="fa-solid fa-money-bill-wave"></i>TOTAL</div>';
                echo '<div class="total">₱' . number_format((float)$total, 2) . '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '<div class="third-section">';
                echo '<div class="notif-button" data-reservation-id="' . $row['res_id'] . '" data-reservation-type="' . $row['type'] . '">';
                echo '<a href="#" class="btn-view">View</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }

            if (!$reservationsExist) {
                echo '<p class="no-reservations-message">There are no reservations.</p>';
            } else {
                if (isset($_POST['selectedStatus'])) {
                    $selectedStatus = $_POST['selectedStatus'];
                    if (!empty($selectedStatus)) {
                        echo '<p class="no-reservations-message">No reservations for ' . $selectedStatus . ' status</p>';
                    } else {
                        echo '<p class="no-reservations-message">There are no reservations.</p>';
                    }
                } else {
                    echo '<p class="no-reservations-message">There are no reservations.</p>';
                }
            }
            ?>
        </div>
    </section>
    <script src="./js/sidebar-closing.js"></script>
    <script src="./js/sidebar-animation.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./js/search_and_filter_reserve.js"></script>
    <script src="./js/users.js"></script>
    <script src="./js/reservation_details.js"> </script>
</body>

</html>