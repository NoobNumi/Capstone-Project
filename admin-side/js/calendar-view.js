document.addEventListener("DOMContentLoaded", function () {
    const dayNum = document.querySelector(".days-calendar");
    const curDateNum = document.querySelector(".current-newDate");
    const previousNextIcon = document.querySelectorAll(".icons button");
    const dateFilterSelect = document.getElementById("filter-select");

    let currentYr = new Date().getFullYear();
    let currentMth = new Date().getMonth() + 1;
    let currentDate = new Date().getDate();
    let data;

    const monthArray = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    function renderCalendar() {
        const firstDayOfMonth = new Date(currentYr, currentMth - 1, 1).getDay();
        const lastDateOfMonth = new Date(currentYr, currentMth, 0).getDate();
        const weekdayNames = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
        const liTag = [];
        const offset = firstDayOfMonth;
    
        for (let i = 1; i <= lastDateOfMonth + offset; i++) {
            const dayNum = i - offset;
    
            if (dayNum > 0) {
                const isToday = dayNum === currentDate && currentMth === new Date().getMonth() + 1 && currentYr === new Date().getFullYear();
                const dayOfWeek = (offset + i - 1) % 7;
                liTag.push(generateDayItem(currentYr, currentMth, dayNum, isToday, weekdayNames[dayOfWeek]));
            } else {
                liTag.push('<li class="inactive"></li>');
            }
        }
    
        const remainingDays = 7 - (liTag.length % 7);
        for (let i = 0; i < remainingDays; i++) {
            liTag.push('<li class="inactive"></li>');
        }
    
        curDateNum.innerText = `${monthArray[currentMth - 1]} ${currentYr}`;
        dayNum.innerHTML = liTag.join('');
    
        dayNum.addEventListener("click", function (event) {
            const day = event.target.closest("li");
            if (day) {
                const selectedDate = getSelectedDate(day);
                fetchUserDetails(selectedDate);
            }
        });
    }

    
    function generateDayItem(year, month, day, isToday = false) {
        const dateKey = `${year}-${month < 10 ? '0' + month : month}-${day < 10 ? '0' + day : day}`;
        const appointCount = data[dateKey] ? data[dateKey]['appoint_count'] : 0;
        const reserveCount = data[dateKey] ? data[dateKey]['reserve_count'] : 0;
    
        return `<li class="${isToday ? 'current-date-highlight' : ''}">
            <div class="day-num">${day}</div>
            <div class="color-coding">
                ${reserveCount > 0 ? `
                    <span class="color-guide reserve">
                        <i class="fa-solid fa-clipboard-list reserve-con"></i>
                        <span class="service-name"> Reserves </span>
                        <div class="total-list-count">${reserveCount}</div>
                    </span>
                ` : ''}
                ${appointCount > 0 ? `
                    <span class="color-guide appoint">
                        <i class="fa-solid fa-calendar-check appoint-con"></i>
                        <span class="service-name"> Appoints </span>
                    </span>
                ` : ''}
            </div>
        </li>`;
    }
    

    function getSelectedDate(day) {
        const dayNum = day.querySelector('.day-num');
        if (dayNum) {
            const dayNumber = dayNum.textContent.trim();
            const selectedDate = `${currentYr}-${currentMth}-${dayNumber.padStart(2, '0')}`;
            return selectedDate;
        }
        return null;
    }
    

    function fetchUserDetails(selectedDate) {
    
        const xhr = new XMLHttpRequest();
        const url = './schedule-view.php';
        const params = `selectedDate=${selectedDate}`;
    
        xhr.open('GET', `${url}?${params}`, true);
    
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    const userDetails = JSON.parse(xhr.responseText);
    
                    displayUserDetails(userDetails);
                } else {
                    console.error('Error fetching user details. Status:', xhr.status);
                }
            }
        };
    
        xhr.send();
    }

    function fetchData(filter) {
        fetch(`./month-sched-view-query.php?filter=${filter}`)
            .then(response => response.json())
            .then(calendarData => {
                data = calendarData;
                renderCalendar();
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    fetchData('all');

    dateFilterSelect.addEventListener("change", () => {
        const selectedFilter = dateFilterSelect.value;
        fetchData(selectedFilter);
    });

    previousNextIcon.forEach(icon => {
        icon.addEventListener("click", () => {
            if (icon.id === "prev-btn") {
                currentMth--;
                if (currentMth < 1) {
                    currentYr--;
                    currentMth = 12;
                }
            } else {
                currentMth++;
                if (currentMth > 12) {
                    currentYr++;
                    currentMth = 1;
                }
                const filter = dateFilterSelect.value;
                fetchData(filter);
            }
            renderCalendar();
        });
    });
    
    function displayUserDetails(data) {
        const serviceViewerContent = document.querySelector('.service-viewer-content');
        serviceViewerContent.innerHTML = '';
    
        if (!Array.isArray(data.userDetails) || data.userDetails.length === 0) {
            serviceViewerContent.style.display = 'block';
    
            const noDataMessage = document.createElement('div');
            noDataMessage.classList.add('no-data-message');
            noDataMessage.textContent = 'No appointments or reservations for this date';
            noDataMessage.style.display = 'flex';
            noDataMessage.style.justifyContent = 'center';
            noDataMessage.style.alignItems = 'center';
            noDataMessage.style.height = '100%';
    
            serviceViewerContent.appendChild(noDataMessage);
        } else {
            serviceViewerContent.style.display = 'block'; 

            data.userDetails.forEach((reservation) => {
                const serviceViewer = document.createElement('div');
                serviceViewer.classList.add('service-viewer');
                const serviceDate = document.createElement('div');
                serviceDate.classList.add('service-date');
    
                const reservationDate = new Date(reservation.date);
                const dayOfWeek = reservationDate.toLocaleDateString('en-US', { weekday: 'short' });
                const dayOfMonth = reservationDate.getDate();
    
                const serviceWeekday = document.createElement('span');
                serviceWeekday.classList.add('service-weekday');
                serviceWeekday.textContent = dayOfWeek;
    
                const serviceWeeknum = document.createElement('span');
                serviceWeeknum.classList.add('service-weeknum');
                serviceWeeknum.textContent = dayOfMonth;
    
                serviceDate.appendChild(serviceWeekday);
                serviceDate.appendChild(serviceWeeknum);
    
                const serviceInformation = document.createElement('div');
                serviceInformation.classList.add('service-information');
    
                const serviceInfoName = document.createElement('span');
                serviceInfoName.classList.add('service-info-name');
    
                if (reservation.type === 'appointment') {
                    serviceInformation.classList.add('appoint');
                    serviceInfoName.textContent = 'Appointment';
                } else {
                    serviceInformation.classList.add('reserve');
                    serviceInfoName.textContent = `${reservation.type.charAt(0).toUpperCase() + reservation.type.slice(1)} Reservation`;
                    serviceInfoName.style.color = '#ffff';
                }
    
                const serviceCustomerName = document.createElement('span');
                serviceCustomerName.classList.add('service-customer-name');
                serviceCustomerName.textContent = `${reservation.first_name} ${reservation.last_name}`;
    
                serviceInformation.appendChild(serviceInfoName);
                serviceInformation.appendChild(serviceCustomerName);
    
                serviceViewer.appendChild(serviceDate);
                serviceViewer.appendChild(serviceInformation);
    
                serviceViewerContent.appendChild(serviceViewer);
            });
        }
    }

});
