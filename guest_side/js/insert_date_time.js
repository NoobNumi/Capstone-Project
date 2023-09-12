let selectedDate = null;
let selectedTime = null;

function updateAppointSched() {
    const appointSchedInput = document.getElementById('schedule-input');
    const appointSchedDateInput = document.getElementById('appoint_sched_date');
    const appointSchedTimeInput = document.getElementById('appoint_sched_time');

    if (selectedDate) {
        appointSchedInput.value = `${selectedDate} ${selectedTime || ''}`;
        appointSchedDateInput.value = selectedDate;
        appointSchedTimeInput.value = selectedTime;
    }
}

document.querySelectorAll('.days li').forEach((dayElement) => {
    dayElement.addEventListener('click', () => {
        const selectedDay = dayElement.textContent.trim();
        const currentDateText = document.querySelector('.current-date').textContent.trim();
        const [selectedMonth, selectedYear] = currentDateText.split(' ');

        const formattedMonth = selectedMonth.charAt(0).toUpperCase() + selectedMonth.slice(1);

        selectedDate = `${formattedMonth} ${selectedDay} ${selectedYear}`;
        updateAppointSched();
    });
});

document.querySelectorAll('.time-options').forEach((timeOption) => {
    timeOption.addEventListener('click', () => {
        selectedTime = timeOption.textContent.trim();
        updateAppointSched();
        closeDateTimeModal();
    });
});

function closeDateTimeModal() {
    const dateTimeModal = document.querySelector('.dateTime-modal-trigger');
    dateTimeModal.style.display = 'none';
    document.body.style.overflow = 'auto';
}
