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

const selectedDates = new Set(); // Use a Set to store selected dates

const renderCalendar = () => {
  const firstDayofMonth = new Date(currYear, currMonth, 1).getDay();
  const lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate();
  const liTag = [];

  for (let i = firstDayofMonth; i > 0; i--) {
    const prevMonthDate = lastDateofMonth - i + 1;
    liTag.push(
      `<li class="inactive prev-month" data-date="${prevMonthDate}">${prevMonthDate}</li>`
    );
  }

  for (let i = 1; i <= lastDateofMonth; i++) {
    const isSelected = selectedDates.has(`${currYear}-${currMonth+1}-${i}`) ? "selected" : "";
    const isInactive =
      (currYear === date.getFullYear() && currMonth === date.getMonth() && i < today) ||
      (currYear < date.getFullYear() || (currYear === date.getFullYear() && currMonth < date.getMonth()))
        ? "inactive"
        : "";

    liTag.push(
      `<li class="${isSelected} ${isInactive}" data-date="${i}">${i}</li>`
    );
  }
  const remainingDays = 42 - (firstDayofMonth + lastDateofMonth);

  for (let i = 1; i <= remainingDays; i++) {
    liTag.push(
      `<li class="inactive next-month" data-date="${i}">${i}</li>`
    );
  }

  currentDate.innerText = `${months[currMonth]} ${currYear}`;
  daysTag.innerHTML = liTag.join("");

  const dateElements = document.querySelectorAll(".calendar .days li:not(.inactive)");
  dateElements.forEach(dateElement => {
    dateElement.addEventListener("click", () => {
      const selectedDate = `${currYear}-${currMonth+1}-${dateElement.getAttribute("data-date")}`;

      if (dateElement.classList.contains("inactive")) {
        return;
      }

      if (selectedDates.has(selectedDate)) {
        selectedDates.delete(selectedDate);
        dateElement.classList.remove("selected");
      } else {
        selectedDates.add(selectedDate);
        dateElement.classList.add("selected");
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

function submitForm() {
    const selectedDatesArray = Array.from(selectedDates);
    if (selectedDatesArray.length === 0) {
      Swal.fire({
        title: "Warning!",
        text: "Please select some dates.",
        icon: "warning",
        showConfirmButton: false,
        timer: 2500,
        customClass: {
          popup: "custom-sweetalert"
        }
      });
      return;
    }
    const selectedDatesValue = selectedDatesArray.join(","); 
    document.getElementById("selectedDates").value = selectedDatesValue;
    document.getElementById("dateForm").submit();
}
