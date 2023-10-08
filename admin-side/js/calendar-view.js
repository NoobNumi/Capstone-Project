    console.log("calendar-view.js is executing");

    document.addEventListener("DOMContentLoaded", function () {
        const dayNum = document.querySelector(".days-calendar");
        const curDateNum = document.querySelector(".current-newDate");
        const previousNextIcon = document.querySelectorAll(".icons button");
        const dateFilterSelect = document.querySelectorAll(".date-btn");



        dateFilterSelect.forEach(button => {
            button.addEventListener("click", () => {
              dateFilterSelect.forEach(btn => {
                btn.classList.remove("active");
              });
          
              button.classList.add("active");
            });
          });


        let newDate = new Date();
        let currentYr = newDate.getFullYear();
        let currentMth = newDate.getMonth();

        const monthArray = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];

        function renderCalendar() {
            console.log("Render calendar");
            const firstDayOfMonth = new Date(currentYr, currentMth, 1).getDay();
            const lastDateOfMonth = new Date(currentYr, currentMth + 1, 0).getDate();
            const lastDayOfMonth = new Date(currentYr, currentMth, lastDateOfMonth).getDay();
            const lastDateOfLastMonth = new Date(currentYr, currentMth, 0).getDate();
            let liTag = "";
        
            for (let i = firstDayOfMonth; i > 0; i--) {
                liTag += `<li class="inactive">
                            <div class="day-num">${lastDateOfLastMonth - i + 1}</div>
                            <div class="color-coding">
                                <span class="color-guide reserve">
                                    <i class="fa-solid fa-clipboard-list reserve-con"></i>
                                    Reserves
                                    <div class="total-list-count">12</div>
                                </span>
                                <span class="color-guide appoint">
                                    <i class="fa-solid fa-calendar-check appoint-con"></i>
                                    Appoints
                                </span>
                            </div>
                        </li>`;
            }
        
            for (let i = 1; i <= lastDateOfMonth; i++) {
                const isToday = i === newDate.getDate() && currentMth === new Date().getMonth() && currentYr === new Date().getFullYear() ? "active" : "";
                liTag += `<li class="${isToday}">
                            <div class="day-num">${i}</div>
                            <div class="color-coding">
                                <span class="color-guide reserve">
                                    <i class="fa-solid fa-clipboard-list reserve-con"></i>
                                    Reserves
                                    <div class="total-list-count">12</div>
                                </span>
                                <span class="color-guide appoint">
                                    <i class="fa-solid fa-calendar-check appoint-con"></i>
                                    Appoints
                                </span>
                            </div>
                        </li>`;
            }
        
            for (let i = lastDayOfMonth; i < 6; i++) {
                liTag += `<li class="inactive">
                            <div class="day-num">${i - lastDayOfMonth + 1}</div>
                            <div class="color-coding">
                                <span class="color-guide reserve">
                                    <i class="fa-solid fa-clipboard-list reserve-con"></i>
                                    Reserves
                                    <div class="total-list-count">12</div>
                                </span>
                                <span class="color-guide appoint">
                                    <i class="fa-solid fa-calendar-check appoint-con"></i>
                                    Appoints
                                </span>
                            </div>
                        </li>`;
            }
        
        
            curDateNum.innerText = `${monthArray[currentMth]} ${currentYr}`;
            dayNum.innerHTML = liTag;
        }
        

        renderCalendar();

        previousNextIcon.forEach(icon => {
            icon.addEventListener("click", () => {
                currentMth = icon.id === "prev" ? currentMth - 1 : currentMth + 1;

                if (currentMth < 0 || currentMth > 11) {
                    newDate = new Date(currentYr, currentMth, new Date().getDate());
                    currentYr = newDate.getFullYear();
                    currentMth = newDate.getMonth();
                } else {
                    newDate = new Date();
                }

                renderCalendar();
            });
        });
    });
