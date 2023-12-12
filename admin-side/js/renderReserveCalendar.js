const daysTagReserve = document.querySelector(".daysReserve");
const currentDateReserve = document.querySelector(".current-date-reserve");
const prevNextIconReserve = document.querySelectorAll(".icons-reserve span");

let dateReserve = new Date();
let currYearReserve = dateReserve.getFullYear();
let currMonthReserve = dateReserve.getMonth();
let todayReserve = dateReserve.getDate();

const monthsReserve = [
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

const selectedDatesReserve = new Set(); 
const renderCalendarReserve = () => {
  const firstDayofMonthReserve = new Date(currYearReserve, currMonthReserve, 1).getDay();
  const lastDateofMonthReserve = new Date(currYearReserve, currMonthReserve + 1, 0).getDate();
  const liTagReserve = [];

  for (let i = firstDayofMonthReserve; i > 0; i--) {
    const prevMonthDateReserve = lastDateofMonthReserve - i + 1;
    liTagReserve.push(
      `<li class="inactive prev-month" data-date="${prevMonthDateReserve}">${prevMonthDateReserve}</li>`
    );
  }

  for (let i = 1; i <= lastDateofMonthReserve; i++) {
    const isSelectedReserve = selectedDatesReserve.has(`${currYearReserve}-${currMonthReserve+1}-${i}`) ? "selected" : "";
    const isInactiveReserve =
      (currYearReserve === dateReserve.getFullYear() && currMonthReserve === dateReserve.getMonth() && i < todayReserve) ||
      (currYearReserve < dateReserve.getFullYear() || (currYearReserve === dateReserve.getFullYear() && currMonthReserve < dateReserve.getMonth()))
        ? "inactive"
        : "";

    liTagReserve.push(
      `<li class="${isSelectedReserve} ${isInactiveReserve}" data-date="${i}">${i}</li>`
    );
  }
  const remainingDaysReserve = 42 - (firstDayofMonthReserve + lastDateofMonthReserve);

  for (let i = 1; i <= remainingDaysReserve; i++) {
    liTagReserve.push(
      `<li class="inactive next-month" data-date="${i}">${i}</li>`
    );
  }

  currentDateReserve.innerText = `${monthsReserve[currMonthReserve]} ${currYearReserve}`;
  daysTagReserve.innerHTML = liTagReserve.join("");

  const dateElementsReserve = document.querySelectorAll(".calendarReserve .daysReserve li:not(.inactive)");
  dateElementsReserve.forEach(dateElement => {
    dateElement.addEventListener("click", () => {
      const selectedDate = `${currYearReserve}-${currMonthReserve+1}-${dateElement.getAttribute("data-date")}`;

      if (dateElement.classList.contains("inactive")) {
        return;
      }

      if (selectedDatesReserve.has(selectedDate)) {
        selectedDatesReserve.delete(selectedDate);
        dateElement.classList.remove("selected");
      } else {
        selectedDatesReserve.add(selectedDate);
        dateElement.classList.add("selected");
      }
      
      renderCalendarReserve();
    });
  });
};

renderCalendarReserve();

prevNextIconReserve.forEach(icon => {
  icon.addEventListener("click", () => {
    if (icon.id === "prevReserve") {
      currMonthReserve -= 1;
      if (currMonthReserve < 0) {
        currMonthReserve = 11;
        currYearReserve -= 1;
      }
    } else if (icon.id === "nextReserve"){
      currMonthReserve += 1;
      if (currMonthReserve > 11) {
        currMonthReserve = 0;
        currYearReserve += 1;
      }
    }
    renderCalendarReserve();
  });
});

function submitFormReserve() {
    const selectedDatesArrayReserve = Array.from(selectedDatesReserve);
    if (selectedDatesArrayReserve.length === 0) {
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
  
    
    const selectedDatesValueReserve = selectedDatesArrayReserve.join(",");
    document.getElementById("selectedDatesReserve").value = selectedDatesValueReserve;
    document.getElementById("dateFormReserve").submit();
}
