$(document).ready(function() {
    let urlParams = new URLSearchParams(window.location.search);
    let tab = urlParams.get('tab');
    if (tab === 'appointment') {
        $('#appoint-tab').addClass('active');
        $('#reserve-tab').removeClass('active');
        $('#appoint-tab-pane').addClass('show active');
        $('#reserve-tab-pane').removeClass('show active');
    } else if (tab === 'reservation') {
        $('#reserve-tab').addClass('active');
        $('#appoint-tab').removeClass('active');
        $('#reserve-tab-pane').addClass('show active');
        $('#appoint-tab-pane').removeClass('show active');
    }

    let guestSidebar = document.querySelector(".guest-sidebar");
        let closeBtn = document.querySelector("#guestMenu");

        closeBtn.addEventListener("click", () => {
            guestSidebar.classList.toggle("open");
            menuBtnchange();
        })

        let countColorElement = document.querySelector(".count-color");
        let countColorStyle = window.getComputedStyle(countColorElement);
});