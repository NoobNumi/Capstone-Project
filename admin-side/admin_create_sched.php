<?php

include("insert_dates.php");

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
    <title>Add Schedule</title>
</head>

<body>
    <form action="insert_dates.php" method="POST" id="dateForm">
        <section class="appointment-sched-selector" id="appointment_sched">
            <div class="date-select-container">
                <div class="appointment-date-sched-header">
                    <a href="./calendar.php"><span class="material-symbols-outlined back">
                            arrow_back_ios
                        </span></a>
                    <div class="separate-div">
                        <span id="header-title">Select unavailable dates</span>
                    </div>
                </div>
                <div class="wrapper">
                    <header>
                        <p class="current-date"></p>
                        <div class="icons">
                            <span id="prev" class="material-symbols-rounded">chevron_left</span>
                            <span id="next" class="material-symbols-rounded">chevron_right</span>
                        </div>
                    </header>
                    <div class="calendar">
                        <ul class="weeks">
                            <li>Sun</li>
                            <li>Mon</li>
                            <li>Tue</li>
                            <li>Wed</li>
                            <li>Thu</li>
                            <li>Fri</li>
                            <li>Sat</li>
                        </ul>
                        <ul class="days"></ul>
                    </div>
                </div>
                <input type="hidden" name="selected_dates" id="selectedDates">
                <div class="option-buttons">
                    <a id="cancelBtn" class="cancel btn-custom">Cancel</a>
                    <a href="#" class="confirm btn-custom" onclick="submitForm()">Confirm</a>
                </div>
            </div>
        </section>
    </form>
    <script src="./js/add_sched_modal.js"></script>
</body>

</html>