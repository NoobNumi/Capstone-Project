// Define your constants and variables
const dayNum = document.querySelector(".days-calendar"),
    curDateNum = document.querySelector(".current-newDate"),
    previousNexIcon = document.querySelectorAll(".icons span");

let newDate = new Date(),
    currentYr = newDate.getFullYear(),
    currentMth = newDate.getMonth();

const monthArray = ["January", "February", "March", "April", "May", "June", "July",
    "August", "September", "October", "November", "December"];

const renderCalndr = () => {
    let firstDayofMonth = new Date(currentYr, currentMth, 1).getDay(), 
        lastDateofMonth = new Date(currentYr, currentMth + 1, 0).getDate(),
        lastDayofMonth = new Date(currentYr, currentMth, lastDateofMonth).getDay(),
        lastDateofLastMonth = new Date(currentYr, currentMth, 0).getDate();
    let liTag = "";

    for (let i = firstDayofMonth; i > 0; i--) {
        liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
    }

    for (let i = 1; i <= lastDateofMonth; i++) {
        let isToday = i === newDate.getDate() && currentMth === new Date().getMonth()
            && currentYr === new Date().getFullYear() ? "active" : "";
        liTag += `<li class="${isToday}">${i}</li>`;
    }

    for (let i = lastDayofMonth; i < 6; i++) {
        liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`
    }
    curDateNum.innerText = `${monthArray[currentMth]} ${currentYr}`;
    dayNum.innerHTML = liTag;
}

document.addEventListener("DOMContentLoaded", function() {
    renderCalndr();

    previousNexIcon.forEach(icon => {
        icon.addEventListener("click", () => { 
            currentMth = icon.id === "prev" ? currentMth - 1 : currentMth + 1;

            if (currentMth < 0 || currentMth > 11) {
                newDate = new Date(currentYr, currentMth, new Date().getDate());
                currentYr = newDate.getFullYear();
                currentMth = newDate.getMonth();
            } else {
                newDate = new Date();
            }
            renderCalndr();
        });
    });
});
