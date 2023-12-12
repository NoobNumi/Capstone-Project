<?php

include("insert_unavailable_dates_query.php");

?>

<body>
    <form action="insert_unavailable_dates_query.php" method="POST" id="dateFormReserve">
        <section class="reservation-sched-selector addUnavailableReserve" id="reservation_sched">
            <div class="date-select-container">
                <div class="reservation-date-sched-header">
                    <a href="./calendar.php"><span class="material-symbols-outlined back">
                            arrow_back_ios
                        </span></a>
                    <div class="separate-div">
                        <span id="header-title">Select unavailable dates</span>
                    </div>
                </div>
                <div class="wrapper-reserve">
                    <header>
                        <p class="current-date-reserve"></p>
                        <div class="icons-reserve">
                            <span id="prevReserve" class="material-symbols-rounded">chevron_left</span>
                            <span id="nextReserve" class="material-symbols-rounded">chevron_right</span>
                        </div>
                    </header>
                    <div class="calendarReserve">
                        <ul class="weeksReserve">
                            <li>Sun</li>
                            <li>Mon</li>
                            <li>Tue</li>
                            <li>Wed</li>
                            <li>Thu</li>
                            <li>Fri</li>
                            <li>Sat</li>
                        </ul>
                        <ul class="daysReserve"></ul>
                    </div>
                </div>
                <input type="hidden" name="selected_dates_reservation" id="selectedDatesReserve">
                <div class="option-buttons">
                    <a id="cancelBtnReserve" class="cancel btn-custom">Cancel</a>
                    <a href="#" class="confirm btn-custom" onclick="submitFormReserve()">Confirm</a>
                </div>
            </div>
        </section>
    </form>
    <script src="./js/add_sched_modal.js"></script>
</body>
</html>