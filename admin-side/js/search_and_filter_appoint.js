$(document).ready(function() {
    const appointmentList = document.querySelector('.appointments-list');
    appointmentList.scrollTop = 0;

    function scrollToBottom() {
        appointmentList.scrollTop = appointmentList.scrollHeight;
    }

    window.addEventListener('load', scrollToBottom);

    const statusFilter = document.querySelector('.sorting-list');
    const notificationList = document.querySelector('.notification-list');
    const noAppointmentsMessage = document.querySelector('.no-appointments-message');

    var cards = $(".searchable-card");

    function filterCards() {
        var searchText = $("#searchInput").val().toLowerCase();
        var selectedStatus = $(".sorting-list").val().toLowerCase();

        var visibleCards = 0;

        cards.each(function() {
            var cardText = $(this).text().toLowerCase();
            var cardStatus = $(this).find('.status').text().trim().toLowerCase();

            var isTextMatch = cardText.includes(searchText);
            var isStatusMatch = selectedStatus === '' || cardStatus === selectedStatus;

            if (isTextMatch && isStatusMatch) {
                $(this).show();
                visibleCards++;
            } else {
                $(this).hide();
            }
        });

        updateNoAppointmentsMessage();
    }

    function updateNoAppointmentsMessage() {
        const selectedStatus = $(".sorting-list").val().toLowerCase();
        const visibleAppointments = $(".searchable-card:visible").length;

        if (visibleAppointments === 0) {
            if (selectedStatus !== '') {
                $(".no-appointments-message").text("No " + selectedStatus + " appointments found");
            } else {
                $(".no-appointments-message").text("There are no appointments.");
            }
            $(".no-appointments-message").show();
        } else {
            $(".no-appointments-message").text("");
            $(".no-appointments-message").hide();
        }
    }

    $("#searchInput, .sorting-list").on("input change", function() {
        filterCards();
        updateNoAppointmentsMessage();
    });

    updateNoAppointmentsMessage();
});