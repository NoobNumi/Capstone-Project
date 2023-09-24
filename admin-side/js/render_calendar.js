const daysTag = document.querySelector(".days");
const currentDate = document.querySelector(".current-date");
const prevNextIcon = document.querySelectorAll(".icons span");

let date = new Date();
let currYear = date.getFullYear();
let currMonth = date.getMonth();
let today = date.getDate();

const months = [
  "January",
  "February",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December"
];

const selectedDates = {};

const renderCalendar = () => {
  const firstDayofMonth = new Date(currYear, currMonth, 1).getDay();
  const lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate();
  const liTag = [];

  for (let i = firstDayofMonth; i > 0; i--) {
    const prevMonthDate = lastDateofMonth - i + 1;
    liTag.push(
      `<li class="inactive ${selectedDates[`${currYear}-${currMonth}-${prevMonthDate}`] ? "selected" : ""}" data-date="${prevMonthDate}">${prevMonthDate}</li>`
    );
  }

  for (let i = 1; i <= lastDateofMonth; i++) {
    const isSelected = selectedDates[`${currYear}-${currMonth}-${i}`] ? "selected" : "";
    const isInactive =
      (currYear === date.getFullYear() && currMonth === date.getMonth() && i < today) ||
      (currYear < date.getFullYear() || (currYear === date.getFullYear() && currMonth < date.getMonth()))
        ? "inactive"
        : "";

    liTag.push(
      `<li class="${isSelected} ${isInactive}" data-date="${i}">${i}</li>`
    );
  }

  currentDate.innerText = `${months[currMonth]} ${currYear}`;
  daysTag.innerHTML = liTag.join("");
  
  const dateElements = document.querySelectorAll(".calendar .days li:not(.inactive)");
  dateElements.forEach(dateElement => {
    dateElement.addEventListener("click", () => {
      const selectedDate = parseInt(dateElement.getAttribute("data-date"));
      const key = `${currYear}-${currMonth}-${selectedDate}`;
      if (selectedDates[key]) {
        delete selectedDates[key];
      } else {
        selectedDates[key] = true;
      }
      renderCalendar();
    });
  });
};

renderCalendar();

prevNextIcon.forEach(icon => {
  icon.addEventListener("click", () => {
    if (icon.id === "prev") {
      currMonth -= 1;
      if (currMonth < 0) {
        currMonth = 11;
        currYear -= 1;
      }
    } else {
      currMonth += 1;
      if (currMonth > 11) {
        currMonth = 0;
        currYear += 1;
      }
    }
    renderCalendar();
  });
});
