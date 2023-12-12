document.addEventListener('DOMContentLoaded', function() {

    const checkInInput = document.getElementById('check_in_date');
    const checkOutInput = document.getElementById('check_out_date');

    fetch('get_reservation_dates.php')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(reservationData => {
            const reservationDates = extractReservationDates(reservationData);
            initializeFlatpickr(reservationDates);
        })
        .catch(error => console.error('Error fetching reservation dates:', error));

        function extractReservationDates(reservationData) {
            let disabledDates = [];
        
            const currentDate = new Date();
            const currentDateString = currentDate.toISOString().split('T')[0];
            disabledDates.push(currentDateString);
        
            for (const reservationType in reservationData) {
                if (reservationData.hasOwnProperty(reservationType)) {
                    const reservations = reservationData[reservationType];
                    if (reservations.length > 0) {
                        if (reservationType !== 'unavailability') {
                            // Add singular dates to the disabledDates array
                            disabledDates = disabledDates.concat(reservations);
                        }
                    }
                }
            }
            return disabledDates;
        }
        
        

    function initializeFlatpickr(disabledDates) {
        const currentDate = new Date();

        const flatpickrOptions = {
            mode: 'range',
            dateFormat: 'Y-m-d', // Use the ISO format
            minDate: currentDate, // Disable dates earlier than the current date
            disable: disabledDates,
            onChange: function(selectedDates, dateStr, instance) {
                if (selectedDates.length === 2) {
                    const startDateStr = instance.formatDate(selectedDates[0], 'F j Y');
                    const endDateStr = instance.formatDate(selectedDates[1], 'F j Y');

                    checkInInput.value = startDateStr;
                    checkOutInput.value = endDateStr;
                }
            },
        };

        flatpickr('#check_in_date', flatpickrOptions);
        flatpickr('#check_out_date', flatpickrOptions);
    }
});
