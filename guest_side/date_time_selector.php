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
                        <ul class="days">
                            <!-- The names of the days are <li class="date"></li>  -->
                        </ul>
                    </div>
                </div>

                <!-- This is for the time selector -->
                <div class="time-select-option" id="time-selector-modal">
                    <div class="time-selector-container">
                        <div class="time-header">
                            <i class="fa-solid fa-clock"></i>
                            <span class="title">
                                Time Notice
                            </span>
                        </div>
                        <div class="selection">
                            <div class="time-options">
                                <div class="time">
                                    Please note that the only time available for appointment is only 4:00 PM
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            const daysTag = $(".days");
            const currentDate = $(".current-date");
            const prevNextIcon = $(".icons span");

            let date = new Date();
            let currYear = date.getFullYear();
            let currMonth = date.getMonth();
            let currDay = date.getDate(); // Added to get the current day
            let selectedDate = ""; // Added to store selected date

            const months = [
                "January", "February", "March", "April", "May", "June", "July",
                "August", "September", "October", "November", "December"
            ];

            const renderCalendar = () => {
                $.ajax({
                    url: 'unavailable-dates-appointment.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        let firstDayofMonth = new Date(currYear, currMonth, 1).getDay();
                        let lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate();
                        let lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate();
                        let liTag = "";

                        for (let i = firstDayofMonth; i > 0; i--) {
                            liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
                        }

                        for (let i = 1; i <= lastDateofMonth; i++) {
                            let isToday = i === currDay && currMonth === date.getMonth() && currYear === date.getFullYear() ? "active" : "";
                            let currentDate = new Date(currYear, currMonth, i);
                            let dateString = `${months[currMonth]} ${i}, ${currYear}`;
                            let isInactive = data.includes(dateString) || currentDate < date ? "inactive" : ""; // Check if the date is in the past

                            if (isInactive) {
                                liTag += `<li class="date inactive ${isToday}" data-day="${i}">${i}</li>`;
                            } else {
                                liTag += `<li class="date ${isToday}" data-day="${i}">${i}</li>`;
                            }
                        }

                        currentDate.text(`${months[currMonth]} ${currYear}`);
                        daysTag.html(liTag);

                        $('.date').each(function() {
                            if (!$(this).hasClass('inactive')) {
                                $(this).on('click', function() {
                                    const selectedDay = $(this).data('day');
                                    const formattedDay = selectedDay.toString().padStart(2, '0');
                                    const formattedMonth = months[currMonth];
                                    const selectedYear = currYear;

                                    selectedDate = `${formattedMonth} ${formattedDay}, ${selectedYear}`;
                                    updateAppointSched();
                                });
                            }
                        });
                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });
            };

            const updateAppointSched = () => {
                const appointSchedInput = $('#schedule-input');
                const appointSchedDateInput = $('#appoint_sched_date');
                const appointSchedTimeInput = $('#appoint_sched_time');

                if (selectedDate) {
                    appointSchedInput.val(selectedDate); 
                    appointSchedDateInput.val(selectedDate);
                    appointSchedTimeInput.val(""); 
                    $('.dateTime-modal-trigger').hide();
                }
            };

            prevNextIcon.each(function() {
                $(this).on('click', function() {
                    currMonth = $(this).attr("id") === "prev" ? currMonth - 1 : currMonth + 1;

                    if (currMonth < 0) {
                        currYear--;
                        currMonth = 11;
                    } else if (currMonth > 11) {
                        currYear++;
                        currMonth = 0;
                    }

                    renderCalendar();
                });
            });

            renderCalendar();
        });
    </script>
    <script src="./js/insert_date_time.js"></script>
</body>

</html>