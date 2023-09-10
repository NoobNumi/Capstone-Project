flatpickr(".flatpickr", {
    enableTime: true,
    maxDate: "2023-08-17",
    disableMobile: true,
    dateFormat: "F j, Y h:i K",

    onClose: function (selectedDates, dateStr, instance) {
        var calendarIcon = document.getElementById('calendar-icon');
        calendarIcon.classList.add('selected');
    },

});