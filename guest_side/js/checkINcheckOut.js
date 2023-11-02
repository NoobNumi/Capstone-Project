function setupDateSelection() {
    document.addEventListener('DOMContentLoaded', function () {
        const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        const date = new Date();
        let currYear = date.getFullYear();
        let currMonth = date.getMonth();
        let displayMonth = 0;

        const monthElements = document.querySelectorAll('.month-name');
        let checkInDate = null;
        let checkOutDate = null;
        let isSelecting = false;
        let selectedDateElements = [];

        const renderCalendar = () => {
            for (let month = 0; month < 2; month++) {
                const firstDayofMonth = new Date(currYear, currMonth + displayMonth + month, 1).getDay();
                const lastDateofMonth = new Date(currYear, currMonth + displayMonth + month + 1, 0).getDate();
                let liTag = "";

                monthElements[month].textContent = `${months[currMonth + displayMonth + month]} ${currYear}`;

                for (let i = 0; i < firstDayofMonth; i++) {
                    liTag += `<li class="inactive"></li>`;
                }

                for (let i = 1; i <= lastDateofMonth; i++) {
                    liTag += `<li class="day" data-month="${currMonth + displayMonth + month + 1}" data-day="${i}">${i}</li>`;
                }

                document.querySelectorAll('.days')[month].innerHTML = liTag;
            }

            const dayElements = document.querySelectorAll('.day');
            dayElements.forEach(function (dayElement, index) {
                dayElement.addEventListener('click', function () {
                    if (!isSelecting) {
                        resetSelectedDates();
                        checkInDate = dayElement;
                        checkInDate.classList.add('selected', 'check-in');
                        isSelecting = true;
                        markInactiveDates();
                        console.log('Selected Check-In Date:', checkInDate);
                        updateInputFields();
                    } else if (!checkOutDate) {
                        checkOutDate = dayElement;
                        checkOutDate.classList.add('selected', 'check-out');
                        markInRangeDates();
                        isSelecting = false;
                        console.log('Selected Check-Out Date:', checkOutDate);
                        updateInputFields();
                        closeDateTimeModal();
                    }

                    selectedDateElements.push(dayElement);
                });
            });

            function getFormattedDate(dateElement) {
                if (dateElement) {
                    const selectedDay = dateElement.getAttribute('data-day');
                    const selectedMonth = dateElement.getAttribute('data-month');
                    const formattedDay = selectedDay.length === 1 ? `0${selectedDay}` : selectedDay;
                    const formattedMonth = months[parseInt(selectedMonth) - 1];
            
                    return `${formattedMonth} ${formattedDay} ${currYear}`;
                }
            
                return '';
            }
            
            

            function updateInputFields() {
                const checkInInput = document.getElementById('check_in_date');
                const checkOutInput = document.getElementById('check_out_date');
            
                if (checkInInput && checkOutInput) {
                    if (checkInDate) {
                        checkInInput.value = getFormattedDate(checkInDate);
                        console.log('Updated Check In input:', checkInInput.value);
                    }
                    if (checkOutDate) {
                        checkOutInput.value = getFormattedDate(checkOutDate);
                        console.log('Updated Check Out input:', checkOutInput.value);
                    }
                } else {
                    console.error('Check In or Check Out input not found.');
                }
            }
            
        }

        const prevNextIcons = document.querySelectorAll('.icons');

        prevNextIcons.forEach(function (icon) {
            icon.addEventListener('click', function () {
                displayMonth = icon.id === "prev" ? -1 : 1;
                renderCalendar();
            });
        });

        const resetSelectedDates = () => {
            selectedDateElements.forEach(function (element) {
                element.classList.remove('selected', 'check-in', 'check-out', 'in-range', 'inactive');
            });
            selectedDateElements = [];
            checkInDate = null;
            checkOutDate = null;
            console.log('Reset Selected Dates');
        };

        const markInRangeDates = () => {
            const dayElements = document.querySelectorAll('.day');
            const startMonth = parseInt(checkInDate.getAttribute('data-month'));
            const endMonth = parseInt(checkOutDate.getAttribute('data-month'));
            const startDay = parseInt(checkInDate.getAttribute('data-day'));
            const endDay = parseInt(checkOutDate.getAttribute('data-day'));

            dayElements.forEach(function (dateInRange) {
                const month = parseInt(dateInRange.getAttribute('data-month'));
                const day = parseInt(dateInRange.getAttribute('data-day'));

                if (month === startMonth && month === endMonth) {
                    if (day >= startDay && day <= endDay) {
                        dateInRange.classList.add('in-range');
                    }
                } else if (month === startMonth && day >= startDay) {
                    dateInRange.classList.add('in-range');
                } else if (month === endMonth && day <= endDay) {
                    dateInRange.classList.add('in-range');
                } else if (month > startMonth && month < endMonth) {
                    dateInRange.classList.add('in-range');
                }
            });
            console.log('Marked In-Range Dates');
        };

        const markInactiveDates = () => {
            const dayElements = document.querySelectorAll('.day');
            const isCheckInSelected = checkInDate !== null;

            dayElements.forEach(function (dateInRange) {
                if (isCheckInSelected) {
                    const selectedMonth = parseInt(checkInDate.getAttribute('data-month'));
                    const selectedDay = parseInt(checkInDate.getAttribute('data-day'));
                    const currentMonth = parseInt(dateInRange.getAttribute('data-month'));
                    const currentDay = parseInt(dateInRange.getAttribute('data-day'));

                    if (currentMonth < selectedMonth || (currentMonth === selectedMonth && currentDay < selectedDay)) {
                        dateInRange.classList.add('inactive');
                    } else {
                        dateInRange.classList.remove('inactive');
                    }
                } else {
                    const currentMonth = parseInt(dateInRange.getAttribute('data-month'));
                    if (currentMonth < currMonth) {
                        dateInRange.classList.add('inactive');
                    } else {
                        dateInRange.classList.remove('inactive');
                    }
                }
            });
            console.log('Marked Inactive Dates');
        };

        document.querySelectorAll('.days li').forEach((dayElement) => {
            dayElement.addEventListener('click', () => {
                if (!dayElement.classList.contains('inactive')) {
                    const selectedDay = dayElement.textContent.trim();
                    const formattedDay = selectedDay.length === 1 ? `0${selectedDay}` : selectedDay;
                    const currentDateText = document.querySelector('.current-date').textContent.trim();
                    const [selectedMonth, selectedYear] = currentDateText.split(' ');
                    const formattedMonth = selectedMonth.charAt(0).toUpperCase() + selectedMonth.slice(1);

                    selectedDate = `${formattedMonth} ${formattedDay} ${selectedYear}`;
                    updateInputFields(selectedDate);
                    closeDateTimeModal();
                }
            });
        });


        function closeDateTimeModal() {
            const dateTimeModal = document.querySelector('.dateTime-modal-trigger');
            dateTimeModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
        renderCalendar();
    });
}
setupDateSelection();