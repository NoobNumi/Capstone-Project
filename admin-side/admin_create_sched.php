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
    <section class="appointment-sched-selector" id="appointment_sched">
        <div class="date-select-container">
            <div class="appointment-date-sched-header">
                <a href="./admin_home.php"><span class="material-symbols-outlined back">
                        arrow_back_ios
                    </span></a>
                <div class="separate-div">
                    <span id="header-title">Select available dates</span>
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

            <div class="option-buttons">
                <a id="cancelBtn" class="cancel btn-custom">Cancel</a>
                <a href="#" class="confirm btn-custom">Confirm</a>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const schedButton = document.getElementById('addButton');
            const modalAddSched = document.getElementById('addSchedModal');
            const closeButton = document.getElementById('closeBTN');

            const addButton = document.getElementById('appointAdd');
            const modalAppointAdd = document.getElementById('appointment_sched');
            const closeAppModal = document.getElementById('cancelBtn');

            function openAddSchedModal() {
                modalAddSched.style.display = 'flex';
                document.body.style.overflow = 'hidden';
                modalAddSched.style.position = 'fixed';
                console.log('AddSchedModal opened');
            }

            function closeAddSchedModal() {
                modalAddSched.style.display = 'none';
                document.body.style.overflow = 'auto';
            }

            function openAppointAddModal() {
                // Close the addschedmodal if it's open
                if (modalAddSched.style.display === 'flex') {
                    closeAddSchedModal();
                }
                modalAppointAdd.style.display = 'flex';
                document.body.style.overflow = 'hidden';
                modalAppointAdd.style.position = 'fixed';
                console.log('Appointment Add Modal opened');
            }

            function closeAppointAddModal() {
                modalAppointAdd.style.display = 'none';
                document.body.style.overflow = 'auto';
            }

            schedButton.addEventListener('click', openAddSchedModal);
            closeButton.addEventListener('click', closeAddSchedModal);

            addButton.addEventListener('click', openAppointAddModal);
            closeAppModal.addEventListener('click', closeAppointAddModal);
        });
    </script>
</body>

</html>