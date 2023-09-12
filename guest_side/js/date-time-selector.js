document.addEventListener("DOMContentLoaded", function () {
    const calendarIcon = document.querySelector(".calendar-icon");
    const dateTimeModal = document.querySelector(".dateTime-modal-trigger");
    const closeButton = document.getElementById("closeBtn");

    calendarIcon.addEventListener("click", function () {
        dateTimeModal.style.display = "block";
        document.body.style.overflow = "hidden";
        dateTimeModal.style.position = "fixed";
    });

    closeButton.addEventListener("click", function () {
        dateTimeModal.style.display = "none";
        document.body.style.overflow = "auto";
    });
});
