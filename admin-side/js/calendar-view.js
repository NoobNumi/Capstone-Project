document.addEventListener("DOMContentLoaded", function () {
    const dayNum = document.querySelector(".days-calendar");
    const curDateNum = document.querySelector(".current-newDate");
    const previousNextIcon = document.querySelectorAll(".icons button");
    const dateFilterSelect = document.getElementById("filter-select");

    let currentYr = new Date().getFullYear();
    let currentMth = new Date().getMonth() + 1;
    let data;

    const monthArray = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];


    function renderCalendar() {
        console.log('Rendering calendar with data:', data);
        const firstDayOfMonth = new Date(currentYr, currentMth - 1, 1).getDay();
        const lastDateOfMonth = new Date(currentYr, currentMth, 0).getDate();
        const lastDayOfMonth = new Date(currentYr, currentMth - 1, lastDateOfMonth).getDay();
        const lastDateOfLastMonth = new Date(currentYr, currentMth - 1, 0).getDate();
        let liTag = "";

        for (let i = firstDayOfMonth; i > 0; i--) {
            const dayNum = lastDateOfLastMonth - i + 1;
            const dateKey = `${currentYr}-${currentMth - 1}-${dayNum < 10 ? '0' + dayNum : dayNum}`;
            const appointCount = data[dateKey] ? data[dateKey]['appoint_count'] : 0;
            const reserveCount = data[dateKey] ? data[dateKey]['reserve_count'] : 0;
            liTag += `<li class="inactive">
                <div class="day-num">${dayNum}</div>
                <div class="color-coding">
                    ${reserveCount > 0 ? `
                        <span class="color-guide reserve">
                            <i class="fa-solid fa-clipboard-list reserve-con"></i>
                            Reserves
                            <div class="total-list-count">${reserveCount}</div>
                        </span>
                    ` : ''}
                    ${appointCount > 0 ? `
                        <span class="color-guide appoint">
                            <i class="fa-solid fa-calendar-check appoint-con"></i>
                            Appoints
                        </span>
                    ` : ''}
                </div>
            </li>`;
        }

        for (let i = 1; i <= lastDateOfMonth; i++) {
            const isToday = i === new Date().getDate() && currentMth === new Date().getMonth() + 1 && currentYr === new Date().getFullYear() ? "active" : "";
            const dateKey = `${currentYr}-${currentMth}-${i < 10 ? '0' + i : i}`;
            const appointCount = data[dateKey] ? data[dateKey]['appoint_count'] : 0;
            const reserveCount = data[dateKey] ? data[dateKey]['reserve_count'] : 0;
            liTag += `<li class="${isToday}">
                <div class="day-num">${i}</div>
                <div class="color-coding">
                    ${reserveCount > 0 ? `
                        <span class="color-guide reserve">
                            <i class="fa-solid fa-clipboard-list reserve-con"></i>
                            Reserves
                            <div class="total-list-count">${reserveCount}</div>
                        </span>
                    ` : ''}
                    ${appointCount > 0 ? `
                        <span class="color-guide appoint">
                            <i class="fa-solid fa-calendar-check appoint-con"></i>
                            Appoints
                        </span>
                    ` : ''}
                </div>
            </li>`;
        }

        for (let i = lastDayOfMonth; i < 6; i++) {
            const dayNum = i - lastDayOfMonth + 1;
            const dateKey = `${currentYr}-${currentMth + 1}-${dayNum < 10 ? '0' + dayNum : dayNum}`;
            const appointCount = data[dateKey] ? data[dateKey]['appoint_count'] : 0;
            const reserveCount = data[dateKey] ? data[dateKey]['reserve_count'] : 0;
            liTag += `<li class="inactive">
                <div class="day-num">${dayNum}</div>
                <div class="color-coding">
                    ${reserveCount > 0 ? `
                        <span class "color-guide reserve">
                            <i class="fa-solid fa-clipboard-list reserve-con"></i>
                            Reserves
                            <div class="total-list-count">${reserveCount}</div>
                        </span>
                    ` : ''}
                    ${appointCount > 0 ? `
                        <span class="color-guide appoint">
                            <i class="fa-solid fa-calendar-check appoint-con"></i>
                            Appoints
                        </span>
                    ` : ''}
                </div>
            </li>`;
        }

        curDateNum.innerText = `${monthArray[currentMth - 1]} ${currentYr}`;
        dayNum.innerHTML = liTag;
    }

    function fetchData(filter) {
        fetch(`./month-sched-view-query.php?filter=${filter}`)
            .then(response => response.json())
            .then(calendarData => {
                console.log('Fetched data:', calendarData);
                data = calendarData;
                renderCalendar();
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    fetchData('all');

    dateFilterSelect.addEventListener("change", () => {
        console.log('Filter changed');
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
});