<?php
session_name("admin_session");
session_start();
require_once("../connection.php");
if (!isset($_SESSION['admin_id'])) {
    header("location: admin_login.php");
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
    <title>Calendar</title>
</head>

<body>
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
            <div class="today-sched">
                <span class="sched-text">Today's Schedule</span>
                <div class="date-today">September 20, <span class="weekday">Wednesday</span></div>
                <ul class="people-sched">
                    <li class="person">
                        <img src="/images/guest.png">
                        <div class="important-details">
                            <span class="date-sched">4:00 - 4:30 PM</span>
                            <span class="person-name">John Doe</span>
                        </div>
                    </li>
                </ul>
            </div>
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
                        <button id="prev" class="material-symbols-rounded calendar-btn">chevron_left</button>
                        <p class="current-newDate"></p>
                        <button id="next" class="material-symbols-rounded calendar-btn">chevron_right</button>
                    </div>
                    <div class="filtering-sub-header">
                        <div class="service-appoint">
                            <select class="service-btn">
                                <option>Reservations</option>
                                <option>Appointments</option>   
                            </select>
                        </div>
                    </div>
                </header>
                <div class="calendar">
                    <ul class="weekdays">
                        <li>Sun</li>
                        <li>Mon</li>
                        <li>Tue</li>
                        <li>Wed</li>
                        <li>Thu</li>
                        <li>Fri</li>
                        <li>Sat</li>
                    </ul>
                    <ul class="days-calendar">
                        <li>
                            <div class="day-num"></div>
                            <div class="color-coding">
                                <span class="color-guide reserve">
                                    <i class="fa-solid fa-clipboard-list reserve-con"></i>
                                    Reserves
                                    <div class="total-list-count">12</div>
                                </span>
                                <span class="color-guide appoint">
                                    <i class="fa-solid fa-calendar-check appoint-con"></i>
                                    Appoints
                                </span>
                            </div>
                        </li>
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