<body>
    <form action="insert_available_reservation_dates_query.php" method="POST" id="dateFormAvailableReserve">
        <section class="available-reservation-sched-selector" id="available_reservation_sched">
            <div class="date-select-container">
                <div class="available-reservation-date-sched-header">
                    <a href="./calendar.php"><span class="material-symbols-outlined back">
                            arrow_back_ios
                        </span></a>
                    <div class="separate-div">
                        <span id="header-title">Select Available Reserve dates</span>
                    </div>
                </div>
                <div class="wrapper-available-reserve">
                    <header>
                        <p class="current-date-avaiable-reserve"></p>
                        <div class="icons-available-reserve">
                            <span id="prevAvailableReserve" class="material-symbols-rounded">chevron_left</span>
                            <span id="nextAvailableReserve" class="material-symbols-rounded">chevron_right</span>
                        </div>
                    </header>
                    <div class="calendarAvailableReserve">
                        <ul class="weeksAvailableReserve">
                            <li>Sun</li>
                            <li>Mon</li>
                            <li>Tue</li>
                            <li>Wed</li>
                            <li>Thu</li>
                            <li>Fri</li>
                            <li>Sat</li>
                        </ul>
                        <ul class="daysAvailableReserve"></ul>
                    </div>
                </div>
                <input type="hidden" name="selected_available_dates_reservation" id="selectedAvailableDatesReserve">
                <div class="option-buttons">
                    <a id="cancelBtnAvailableReserve" class="cancel btn-custom">Cancel</a>
                    <a href="#" class="confirm btn-custom" onclick="submitFormAvailableReserve()">Confirm</a>
                </div>
            </div>
        </section>
    </form>
</body>
</html>