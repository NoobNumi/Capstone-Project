<?php

try {
    include "../connection.php";
    $sql = "SELECT date, time_slot, availability_status FROM appointment_availability";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $appointmentDates = [];

    foreach ($appointments as $appointment) {
        $appointmentDates[] = $appointment['date'];
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

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
                            <?php foreach ($appointments as $appointment) : ?>
                                <?php
                                $dateClass = '';
                                if ($appointment['availability_status'] === 'booked') {
                                    $dateClass = 'inactive';
                                } else if ($appointment['availability_status'] === 'available') {
                                    $dateClass = 'days';
                                }
                                ?>
                                <li class="<?php echo $dateClass; ?>" data-status="<?php echo $appointment['availability_status']; ?>"><?php echo $appointment['date']; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <!-- This is for the time selector -->
                <div class="time-select-option" id="time-selector-modal">
                    <div class="time-selector-container">
                        <div class="time-header">
                            <i class="fa-solid fa-clock"></i>
                            <span class="title">
                                
                            </span>
                        </div>
                        <div class="selection">
                            <div class="time-options">
                                <div class="time">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const appointments = <?php echo json_encode($appointments); ?>;
        const daysTag = document.querySelector(".days");
        const currentDate = document.querySelector(".current-date");
        const prevNextIcon = document.querySelectorAll(".icons span");

        let date = new Date();
        let currYear = date.getFullYear();
        let currMonth = date.getMonth();

        const months = ["January", "February", "March", "April", "May", "June", "July",
            "August", "September", "October", "November", "December"
        ];

        const renderCalendar = () => {
            let firstDayofMonth = new Date(currYear, currMonth, 1).getDay();
            let lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate();
            let lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay();
            let lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate();
            let liTag = "";

            for (let i = firstDayofMonth; i > 0; i--) {
                liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
            }

            for (let i = 1; i <= lastDateofMonth; i++) {
                let isToday = i === date.getDate() && currMonth === date.getMonth() && currYear === date.getFullYear() ? "active" : "";
                let currentDate = new Date(currYear, currMonth, i);
                let dateString = `${months[currMonth]} ${i}, ${currYear}`;
                let isBooked = false;

                for (const appointment of appointments) {
                    if (appointment.date === dateString && appointment.availability_status === 'booked') {
                        isBooked = true;
                        break;
                    }
                }

                if (isBooked) {
                    liTag += `<li class="date inactive" data-day="${i}">${i}</li>`;
                } else {
                    liTag += `<li class="date ${isToday}" data-day="${i}">${i}</li>`;
                }
            }

            currentDate.innerText = `${months[currMonth]} ${currYear}`;
            daysTag.innerHTML = liTag;

            document.querySelectorAll('.date').forEach((dayElement) => {
                if (!dayElement.classList.contains('inactive')) {
                    dayElement.addEventListener('click', () => {
                        const selectedDay = dayElement.dataset.day;
                        const formattedDay = selectedDay.length === 1 ? `0${selectedDay}` : selectedDay;
                        const formattedMonth = months[currMonth];
                        const selectedYear = currYear;

                        selectedDate = `${formattedMonth} ${formattedDay}, ${selectedYear}`;
                        updateAppointSched();
                    });
                }
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