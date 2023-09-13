 document.querySelectorAll('.days li').forEach((dayElement) => {
    dayElement.addEventListener('click', () => {
        if (!dayElement.classList.contains('inactive')) {
            const selectedDay = dayElement.textContent.trim();
            const formattedDay = selectedDay.length === 1 ? `0${selectedDay}` : selectedDay;
            const currentDateText = document.querySelector('.current-date').textContent.trim();
            const [selectedMonth, selectedYear] = currentDateText.split(' ');
            const formattedMonth = selectedMonth.charAt(0).toUpperCase() + selectedMonth.slice(1);

            selectedDate = `${formattedMonth} ${formattedDay} ${selectedYear}`;
            updateAppointSched();
        }
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
