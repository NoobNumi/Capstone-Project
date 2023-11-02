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

date_default_timezone_set('Asia/Manila');
$todayDate = date('Y-m-d');
$todayDateFormatted = date('F j , l', strtotime($todayDate));

include("./today_sched_query.php");

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
    <title>Calendar</title>
</head>

<body style="overflow-x: hidden;">
    <?php
    include("add-sched-modal.php");
    include("admin_create_sched.php");
    ?>
    <section class="schedule-view">
        <?php include "./admin_sidebar.php"; ?>
        <div class="sched-view-header">
            <span class="docu-name">Calendar</span>
            <div class="dashboard-header">
                <a class="add-button" id="addButton"><i class="fa-solid fa-plus"></i>Add Schedule</a>
            </div>
        </div>
        <div class="main-content-sched">
            <?php
            if ($stmt->rowCount() > 0) {
                echo '<div class="today-sched">
                        <span class="sched-text">Today\'s Schedule</span>
                        <div class="date-today">' . $todayDateFormatted . '</div>
                        <ul class="people-sched">';

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<li class="person">
                                <img src="/images/guest.png">
                                <div class="important-details">
                                    <span class="record-type">' . ucfirst($row['type']) . '</span>
                                    <span class="date-sched">' . ($row['type'] === 'appointment' ? $row['time'] : '') . '</span>
                                    <span class="person-name">' . $row['first_name'] . ' ' . $row['last_name'] . '</span>
                                </div>
                            </li>';
                }

                echo '</ul>
                    </div>';
            } else {
                echo '<div class="today-sched">
                    <span class="sched-text">Today\'s Schedule</span>
                        <div class="date-today">' . $todayDateFormatted . '</div>
                        <ul class="people-sched">
                            <li class="no-service-text">
                                <p>There are no scheduled appointment or reservations today</p>
                            </li>
                        </ul>
                        </div>
                    ';
            }
            ?>
            <div class="sched-calendar-view">
                <header>
                    <div class="filtering">
                        <span class="date-btn active">
                            Month
                        </span>
                        <span class="date-btn">
                            Week
                        </span>
                        <span class="date-btn">
                            Day
                        </span>
                    </div>
                    <div class="icons">
                        <button id="prev-btn" class="material-symbols-rounded calendar-btn">chevron_left</button>
                        <p class="current-newDate"></p>
                        <button id="next-btn" class="material-symbols-rounded calendar-btn">chevron_right</button>
                    </div>

                    <select name="options" id="filter-select">
                        <option value="all">All</option>
                        <optgroup label="Reservations">
                            <option value="all_reservations">All Reservations</option>
                            <option value="seminar">Seminar</option>
                            <option value="trainings">Trainings</option>
                            <option value="reception">Reception</option>
                            <option value="recollection">Recollection</option>
                            <option value="retreat">Retreat</option>
                        </optgroup>
                        <option value="appointment">Appointment</option>
                    </select>

                </header>
                <div class="calendar">
                    <ul class="days-calendar">
                        <?php
                        include("./month-sched-view-query.php");

                        $start_date = new DateTime(date('Y-m-01'));
                        $end_date = new DateTime(date('Y-m-t'));

                        $interval = new DateInterval('P1D');
                        $date_range = new DatePeriod($start_date, $interval, $end_date);

                        $filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

                        foreach ($date_range as $date_obj) {
                            $date = $date_obj->format('Y-m-d');
                            $dayNum = date('j', strtotime($date));

                            if (isset($calendarData[$date])) {
                                $data = $calendarData[$date];
                                $appointCount = isset($data['appoint_count']) ? $data['appoint_count'] : 0;
                                $reserveCount = isset($data['reserve_count']) ? $data['reserve_count'] : 0;
                            } else {
                                $appointCount = 0;
                                $reserveCount = 0;
                            }

                            if (($filter === 'all') || ($filter === 'appointments' && $appointCount > 0) || ($filter === 'reservations' && $reserveCount > 0)) {
                                echo '<li>
                                <div class="day-num">' . $dayNum . '</div>
                                <div class="color-coding">';

                                if ($appointCount > 0) {
                                    echo '<span class="color-guide appoint">
                                            <i class="fa-solid fa-calendar-check appoint-con"></i>
                                                Appoints
                                            </span>';
                                }

                                if ($reserveCount > 0) {
                                    if ($appointCount > 0) {
                                        echo '<span class="color-guide reserve">
                                        <i class="fa-solid fa-clipboard-list reserve-con"></i>
                                            Reserves
                                            <div class="total-list-count">' . ($appointCount + $reserveCount) . '</div>
                                        </span>';
                                    } else {
                                        echo '<span class="color-guide reserve">
                                        <i class="fa-solid fa-clipboard-list reserve-con"></i>
                                            Reserves
                                        <div class="total-list-count">' . $reserveCount . '</div>
                                        </span>';
                                    }
                                }

                                echo '</div>
                                </li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php require("logout_modal.php"); ?>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./js/users.js"></script>
    <script src="./js/render_calendar.js"></script>
    <script src="./js/sidebar-animation.js"></script>
    <script src="./js/calendar-view.js"></script>
</body>

</html>