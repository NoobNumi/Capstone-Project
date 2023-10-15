$(document).ready(function () {
    $('.notif-button').click(function (event) {
        event.preventDefault();
        const appointmentId = $(this).attr('data-appointment-id');
        console.log('Notification button clicked with ID:', appointmentId);

        $.ajax({
            url: 'fetch_appointment_details.php',
            type: 'GET',
            data: {
                appoint_id: appointmentId
            },
            success: function (response) {
                const appointment = JSON.parse(response);
                updateModalContent(appointment);

                $('.confirm').attr('data-appointment-id', appointmentId);
                $('.cancel').attr('data-appointment-id', appointmentId);


                showModal();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('AJAX error:', textStatus, errorThrown);
            }
        });
    });

    $('.close-button-details').click(function () {
        hideModal();
    });

    $('.cancel').click(function () {
        const appointmentId = $(this).attr('data-appointment-id');
        console.log('Cancel button clicked with ID:', appointmentId);

        hideModal();

        $('.confirm-modal-section').css('display', 'flex');
        $('.confirm-modal-section').css('position', 'fixed');
        $('body').css('overflow', 'hidden');


        $('.confirm-btn.no').click(function () {
            $('.confirm-modal-section').css('display', 'none');
            showModal();
        });

        $('.close_confirm_modal').click(function () {
            $('.confirm-modal-section').css('display', 'none');
            showModal();
        });

        $('.confirm-btn.yes').click(function () {
            $('.confirm-modal-section').css('display', 'none');
            updateAppointmentStatus(appointmentId, 'cancelled');
        });
    });

    $('.confirm').click(function () {
        const appointmentId = $(this).attr('data-appointment-id');
        console.log('Confirm button clicked with ID:', appointmentId);
        updateAppointmentStatus(appointmentId, 'confirmed');
        window.open('send_email.php?appoint_id=' + appointmentId, '_blank');
    });


    function showModal() {
        $('.appointment-details-view').css('display', 'flex');
        $('.appointment-details-view').css('position', 'fixed');
        $('body').css('overflow', 'hidden');
    }

    function hideModal() {
        $('.appointment-details-view').css('display', 'none');
        $('body').css('overflow-y', 'auto');
    }

    function updateModalContent(appointment) {
        $('#guest-name-details').text(appointment.first_name + ' ' + appointment.last_name);
        $('#guest-date-details').text(appointment.appoint_sched_date);
        $('#guest-time-details').text(appointment.appoint_sched_time);
        $('#guest-agenda-details').text(appointment.appoint_description);

        const iconElement = $('.appointment-stat i');

        let iconClass;
        switch (appointment.appoint_status) {
            case 'pending':
                iconClass = 'fa-clock';
                $('.cancel').removeClass('disabled-cancel');
                $('.confirm').removeClass('disabled-confirm');
                break;
            case 'confirmed':
                iconClass = 'fa-circle-check';
                $('.cancel').removeClass('disabled-cancel');
                $('.confirm').css('display', 'none');
                break;
            case 'cancelled':
                iconClass = 'fa-ban';
                $('.confirm').css('display', 'none');
                $('.cancel').addClass('disabled-cancel');
                break;
            default:
                iconClass = 'fa-question';
        }


        iconElement.attr('class', 'fas ' + iconClass);
    }

    function updateAppointmentStatus(appointmentId, newStatus) {
        $.ajax({
            url: 'update_appointment_status.php',
            type: 'POST',
            data: {
                appoint_id: appointmentId,
                new_status: newStatus
            },
            success: function (response) {
                console.log('Update appointment status response:', response);
                const result = JSON.parse(response);
                if (newStatus === 'confirmed' || newStatus === 'cancelled') {
                    displaySweetAlert(result.success, result, newStatus);
                } else {
                    displaySweetAlert(result.success, result.message);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('AJAX error:', textStatus, errorThrown);
                displaySweetAlert(false, 'An error occurred.');
            }
        });
    }

    function displaySweetAlert(success, message, action) {
        let title, icon, text;

        if (action === 'confirmed') {
            title = 'You have confirmed this appointment!';
            icon = 'success';
            text = `Your appointment with ${message.first_name} has been confirmed and is set on ${message.appoint_sched_date} at ${message.appoint_sched_time}. We have notified ${message.first_name} with your appointment!`;
            hideModal();
        } else if (action === 'cancelled') {
            title = 'Appointment canceled!';
            icon = 'error';
            text = `Your appointment with ${message.first_name} has been cancelled. We have notified ${message.first_name} with the cancellation!`;
            hideModal();
        } else if (success) {
            title = 'Success';
            icon = 'success';
            text = typeof message === 'string' ? message : 'Appointment updated successfully';
        } else {
            title = 'Error';
            icon = 'error';
            text = typeof message === 'string' ? message : 'An error occurred';
        }

        console.log('Displaying SweetAlert with:');
        console.log('Title:', title);
        console.log('Text:', text);
        console.log('Icon:', icon);

        Swal.fire({
            title: title,
            text: text,
            icon: icon
        });
    }
});
