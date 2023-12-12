const daysTagAvailableReserve = document.querySelector(".daysAvailableReserve");
const currentAvailableDateReserve = document.querySelector(".current-date-avaiable-reserve");
const prevNextIconAvailableReserve = document.querySelectorAll(".icons-available-reserve span");

let dateAvailableReserve = new Date();
let currYearAvailableReserve = dateAvailableReserve.getFullYear();
let currMonthAvailableReserve = dateAvailableReserve.getMonth();
let todayAvailableReserve = dateAvailableReserve.getDate();

const monthsAvailableReserve = [
  "January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];

const selectedAvailableDatesReserve = new Set();

const renderCalendarAvailableReserve = () => {

  const firstDayofMonthAvailableReserve = new Date(currYearAvailableReserve, currMonthAvailableReserve, 1).getDay();
  const lastDateofMonthAvailableReserve = new Date(currYearAvailableReserve, currMonthAvailableReserve + 1, 0).getDate();
  const liTagAvailableReserve = [];

  for (let i = firstDayofMonthAvailableReserve; i > 0; i--) {
    const prevMonthDateAvailableReserve = lastDateofMonthAvailableReserve - i + 1;
    liTagAvailableReserve.push(
      `<li class="inactive prev-month" data-date="${prevMonthDateAvailableReserve}">${prevMonthDateAvailableReserve}</li>`
    );
  }

  for (let i = 1; i <= lastDateofMonthAvailableReserve; i++) {
    const isSelectedAvailableReserve = selectedAvailableDatesReserve.has(`${currYearAvailableReserve}-${currMonthAvailableReserve + 1}-${i}`) ? "selected" : "";
    const isInactiveAvailableReserve =
      (currYearAvailableReserve === dateAvailableReserve.getFullYear() && currMonthAvailableReserve === dateAvailableReserve.getMonth() && i < todayAvailableReserve) ||
        (currYearAvailableReserve < dateAvailableReserve.getFullYear() || (currYearAvailableReserve === dateAvailableReserve.getFullYear() && currMonthAvailableReserve < dateAvailableReserve.getMonth()))
        ? "inactive"
        : "";

    liTagAvailableReserve.push(
      `<li class="${isSelectedAvailableReserve} ${isInactiveAvailableReserve}" data-date="${i}">${i}</li>`
    );
  }

  const remainingDaysAvailableReserve = 42 - (firstDayofMonthAvailableReserve + lastDateofMonthAvailableReserve);

  for (let i = 1; i <= remainingDaysAvailableReserve; i++) {
    liTagAvailableReserve.push(
      `<li class="inactive next-month" data-date="${i}">${i}</li>`
    );
  }

  currentAvailableDateReserve.innerText = `${monthsAvailableReserve[currMonthAvailableReserve]} ${currYearAvailableReserve}`;
  daysTagAvailableReserve.innerHTML = liTagAvailableReserve.join("");


  const dateElementsAvailableReserve = document.querySelectorAll(".calendarAvailableReserve .daysAvailableReserve li:not(.inactive)");
  dateElementsAvailableReserve.forEach(dateElement => {
    dateElement.addEventListener("click", () => {
      const selectedDateAvailableReserve = `${currYearAvailableReserve}-${currMonthAvailableReserve + 1}-${dateElement.getAttribute("data-date")}`;

      if (dateElement.classList.contains("inactive")) {
        return;
      }

      if (selectedAvailableDatesReserve.has(selectedDateAvailableReserve)) {
        selectedAvailableDatesReserve.delete(selectedDateAvailableReserve);
        dateElement.classList.remove("selected");
      } else {
        selectedAvailableDatesReserve.add(selectedDateAvailableReserve);
        dateElement.classList.add("selected");
      }

      renderCalendarAvailableReserve();
    });
  });

};


renderCalendarAvailableReserve();

prevNextIconAvailableReserve.forEach(icon => {
  icon.addEventListener("click", () => {

    if (icon.id === "prevAvailableReserve") {
      currMonthAvailableReserve -= 1;
      if (currMonthAvailableReserve < 0) {
        currMonthAvailableReserve = 11;
        currYearAvailableReserve -= 1;
      }
    } else if (icon.id === "nextAvailableReserve") {
      currMonthAvailableReserve += 1;
      if (currMonthAvailableReserve > 11) {
        currMonthAvailableReserve = 0;
        currYearAvailableReserve += 1;
      }
    }

    renderCalendarAvailableReserve();
  });
});

function submitFormAvailableReserve() {
  const selectedAvailableDatesArrayReserve = Array.from(selectedAvailableDatesReserve);
  if (selectedAvailableDatesArrayReserve.length === 0) {
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
  const selectedAvailableDatesValueReserve = selectedAvailableDatesArrayReserve.join(",");
  document.getElementById("selectedAvailableDatesReserve").value = selectedAvailableDatesValueReserve;
  document.getElementById("dateFormAvailableReserve").submit();
}
