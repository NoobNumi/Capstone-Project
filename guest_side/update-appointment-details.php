<body>
    <section class="update-appointment">
        <form action="" method="post" class="update-section-appointment">
            <header>
                <h6>Update Appointment</h6>
                <i class="fa-solid fa-xmark" id="closeAppointmentUpdate"></i>
            </header>
            <div class="text-inputs">
                <div class="input-capsule" style="width: 100%">
                    <span class="input-title-name">First Name</span>
                    <div class="inputs-flex">
                        <input type="text" name="first_name" id="userNameAppointment">
                    </div>
                </div>
                <div class="input-capsule" style="width: 100%">
                    <span class="input-title-name">Last Name</span>
                    <div class="inputs-flex">
                        <input type="text" name="last_name" id="userLastNameAppointment">
                    </div>
                </div>
            </div>
            <div class="input-capsule">
                    <span class="input-title-name">Contact Number</span>
                    <div class="inputs-flex">
                        <input type="text" name="contact_no" id="userContactAppointment">
                    </div>
                </div>
            
            <span class="input-title-name">Appointment Date</span>
            <div class="appoint-flex">
                <label class="select-date">
                    <input required="" placeholder="Schedule" id="schedule-input" type="text" class="input" readonly style="cursor: auto;">
                    <input required="" type="hidden" id="appoint_sched_date" name="appoint_sched_date">
                    <input required=a"" type="hidden" id="appoint_sched_time" name="appoint_sched_time">
                    <div class="sched-buttons" id="calendar-icon">
                        <span class="material-symbols-rounded calendar-icon" title="toggle" data-toggle>
                            calendar_month
                        </span>
                    </div>
                </label>
            </div>
            
            <span class="input-title-name">Agenda</span>
            <div class="appoint-info">
                <label>
                    <textarea name="appoint_description" placeholder="Input purpose of appointment here..." cols="30" rows="5" class="app-description" oninput="limitTextarea(this, 300)"></textarea>
                </label>
            </div>
            <p id="char-count">Characters: 0 / 300</p>

            <a href="#" class="btn btn-update w-100 h-100" id="updateAppointment" type="submit">Save</a>
        </form>
    </section>
    <script>
        function limitTextarea(textarea, maxChars) {
            const text = textarea.value;
            const currentCharCount = text.length;

            if (currentCharCount > maxChars) {
                textarea.value = text.slice(0, maxChars);
            }

            document.getElementById('char-count').textContent = `Characters: ${Math.min(currentCharCount, maxChars)} / ${maxChars}`;
        }
    </script>
</body>

</html>