document.addEventListener("DOMContentLoaded", function () {
    const calendarIcons = document.querySelectorAll(".calendar-icon");
    const dateTimeModal = document.querySelector(".dateTime-modal-trigger");
    const closeButton = document.getElementById("closeBtn");

    calendarIcons.forEach(function (calendarIcon) {
        calendarIcon.addEventListener("click", function () {
            dateTimeModal.style.display = "block";
            document.body.style.overflow = "hidden";
            dateTimeModal.style.position = "fixed";
        });
    });

    closeButton.addEventListener("click", function () {
        dateTimeModal.style.display = "none";
        document.body.style.overflow = "auto";
    });
});
