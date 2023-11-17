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
$appointmentId = '';

try {
    $sql = "SELECT 
                a.*, 
                u.profile_picture
            FROM appointment_record a
            JOIN users u ON a.user_id = u.user_id
            ORDER BY STR_TO_DATE(a.appoint_sched_date, '%M %d %Y') DESC";

    $result = $conn->query($sql);
} catch (PDOException $e) {
    die("Error fetching data: " . $e->getMessage());
}


try {
    $sqlCount = "SELECT COUNT(*) AS total_appointments FROM appointment_record";
    $resultCount = $conn->query($sqlCount);
    $row = $resultCount->fetch(PDO::FETCH_ASSOC);
    $totalAppointments = $row['total_appointments'];
} catch (PDOException $e) {
    die("Error fetching data: " . $e->getMessage());
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/admin_style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Appointments</title>
</head>

<body style="overflow-x: hidden;">
    <?php
    include("./admin_sidebar.php");
    include("./appointment_details_view.php");
    include("./confirm_delete_modal.php");
    require("logout_modal.php");
    ?>
    <section class="appointments-list admin-sidebar-open">
        <div class="admin-appoint-header">
            <div class="right-section">
                <h4 class="admin-title">Appointments</h4>
                <p class="total-indicator">You have <span class="total-num"><?php echo $totalAppointments; ?></span> total appointment(s)</p>
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
            $appointmentsExist = false;

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $userName = $row["first_name"] . " " . $row["last_name"];
                $status = $row["appoint_status"];
                $date = $row["appoint_sched_date"];
                $time = $row["appoint_sched_time"];
                $profile_picture = $row["profile_picture"];

                if ($status === 'confirmed' || $status === 'pending' || $status === 'cancelled') {
                    $appointmentsExist = true;
                    echo '<div class="notification-card appoint searchable-card">';
                    echo '<div class="first-section">';
                    echo '<img src="../guest_side/'.$profile_picture.'">';
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
                    echo '<div class="appoint-details">';
                    echo '<div class="detail-title"><i class="fa-solid fa-calendar-days"></i>DATE</div>';
                    echo '<div class="date">' . $date . '</div>';
                    echo '</div>';
                    echo '<div class="appoint-details">';
                    echo '<div class="detail-title"><i class="fa-solid fa-calendar-days"></i>TIME</div>';
                    echo '<div class="date">' . $time . '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="third-section">';
                    echo '<div class="notif-button" data-appointment-id="' . $row['appoint_id'] . '">';
                    echo '<a href="#" class="btn-view">View</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            }

            if (!$appointmentsExist) {
                echo '<p class="no-appointments-message">There are no appointments.</p>';
            } else {
                if (isset($_POST['selectedStatus'])) {
                    $selectedStatus = $_POST['selectedStatus'];
                    if (!empty($selectedStatus)) {
                        echo '<p class="no-appointments-message">No appointments for ' . $selectedStatus . ' appointments</p>';
                    } else {
                        echo '<p class="no-appointments-message">There are no appointments.</p>';
                    }
                } else {
                    echo '<p class="no-appointments-message">There are no appointments.</p>';
                }
            }
            ?>
        </div>
    </section>
    <script>
        const appointmentList = document.querySelector('.appointments-list');
        appointmentList.scrollTop = 0;

        function scrollToBottom() {
            appointmentList.scrollTop = appointmentList.scrollHeight;
        }
        window.addEventListener('load', scrollToBottom);
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./js/search_and_filter_appoint.js"></script>
    <script src="./js/users.js"></script>
    <script src="./js/sidebar-closing.js"></script>
    <script src="./js/sidebar-animation.js"></script>
    <!-- the appointment_details.js is where the javascript is -->
    <script src="./js/appointment_details.js"> </script>
</body>

</html>