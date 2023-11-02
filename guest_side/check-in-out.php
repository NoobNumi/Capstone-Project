<body>
    <div class="dateTime-modal-trigger">
        <div class="close-button-header">
            <i class="fa-solid fa-x" id="closeBtn"></i>
        </div>
        <div class="date-time-section">
            <div class="date-and-time-container">
                <!-- This is for the calendar -->
                <div class="wrapper">
                    <header>
                        <span id="prev" class="material-symbols-rounded icons">chevron_left</span>
                        <p class="month-name"></p>
                        <p class="month-name"></p>
                        <span id="next" class="material-symbols-rounded icons">chevron_right</span>
                    </header>
                    <div class="calendar" id="calendarOne">
                        <!-- Two months are being rendered here -->
                        <div class="months">
                            <!-- For the first month -->
                            <div class="month" id="prevMonth">
                                <ul class="weeks">
                                    <li>Sun</li>
                                    <li>Mon</li>
                                    <li>Tue</li>
                                    <li>Wed</li>
                                    <li>Thu</li>
                                    <li>Fri</li>
                                    <li>Sat</li>
                                </ul>
                                <ul class="days">
                                    <!-- You can add your dates here dynamically using JavaScript for the first month -->
                                    <li data-month="1">1</li>
                                    <li data-month="1">2</li>
                                    <!-- ... -->
                                    <li data-month="1">31</li>
                                </ul>
                            </div>

                            <!-- For the second month -->
                            <div class="month" id="nextMonth">
                                <ul class="weeks">
                                    <li>Sun</li>
                                    <li>Mon</li>
                                    <li>Tue</li>
                                    <li>Wed</li>
                                    <li>Thu</li>
                                    <li>Fri</li>
                                    <li>Sat</li>
                                </ul>
                                <ul class="days">
                                    <!-- You can add your dates here dynamically using JavaScript for the second month -->
                                    <li data-month="2">1</li>
                                    <li data-month="2">2</li>
                                    <!-- ... -->
                                    <li data-month="2">28</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/checkINcheckOut.js"></script>
</body>