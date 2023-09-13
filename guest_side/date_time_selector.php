<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,500,1,0" />
    <link rel="stylesheet" href="./css/guest-style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

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
                        <ul class="days"></ul>
                    </div>
                </div>

                <!-- This is for the time selector -->
                <div class="time-select-option" id="time-selector-modal">
                    <div class="time-selector-container">
                        <div class="time-header">
                            <i class="fa-solid fa-clock"></i>
                            <span class="title">
                                Available Time
                            </span>
                        </div>
                        <div class="selection">
                            <div class="time-options">
                                <div class="time">09:00 <span class="meridian">AM</span></div>
                            </div>
                            <div class="time-options">
                                <div class="time">10:00 <span class="meridian">AM</span></div>
                            </div>
                            <div class="time-options">
                                <div class="time">01:00 <span class="meridian">PM</span></div>
                            </div>
                            <div class="time-options">
                                <div class="time">03:00 <span class="meridian">PM</span></div>
                            </div>
                            <div class="time-options">
                                <div class="time">04:00 <span class="meridian">PM</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const daysTag = document.querySelector(".days"),
            currentDate = document.querySelector(".current-date"),
            prevNextIcon = document.querySelectorAll(".icons span");

        let date = new Date(),
            currYear = date.getFullYear(),
            currMonth = date.getMonth();

        const months = ["January", "February", "March", "April", "May", "June", "July",
            "August", "September", "October", "November", "December"
        ];

        const renderCalendar = () => {
            let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(),
                lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(),
                lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay()
            lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate();
            let liTag = "";

            for (let i = firstDayofMonth; i > 0; i--) {
                liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
            }

            for (let i = 1; i <= lastDateofMonth; i++) {
                let isToday = i === date.getDate() && currMonth === new Date().getMonth() &&
                    currYear === new Date().getFullYear() ? "active" : "";

                liTag += `<li class="date ${isToday}" data-day="${i}">${i}</li>`;
            }

            for (let i = lastDayofMonth; i < 6; i++) {
                liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`
            }
            currentDate.innerText = `${months[currMonth]} ${currYear}`;
            daysTag.innerHTML = liTag;

            document.querySelectorAll('.date').forEach((dayElement) => {
                dayElement.addEventListener('click', () => {
                    if (!dayElement.classList.contains('inactive')) {
                        const selectedDay = dayElement.dataset.day; // Get the selected day
                        const formattedDay = selectedDay.length === 1 ? `0${selectedDay}` : selectedDay;
                        const formattedMonth = months[currMonth];
                        const selectedYear = currYear;

                        selectedDate = `${formattedMonth} ${formattedDay} ${selectedYear}`;
                        updateAppointSched();
                    }
                });
            });
        }

        const updateAppointSched = () => {
            const appointSchedInput = document.getElementById('schedule-input');
            const appointSchedDateInput = document.getElementById('appoint_sched_date');
            const appointSchedTimeInput = document.getElementById('appoint_sched_time');

            if (selectedDate) {
                appointSchedInput.value = `${selectedDate} ${selectedTime || ''}`;
                appointSchedDateInput.value = selectedDate;
                appointSchedTimeInput.value = selectedTime;
            }
        }

        prevNextIcon.forEach(icon => {
            icon.addEventListener("click", () => {
                currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

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
    </script>
    <script src="./js/insert_date_time.js"></script>
</body>

</html>