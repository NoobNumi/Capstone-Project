$(document).ready(function () {
    const notifBar = $('.notif-bar');
    $(document).on('click', '.notif-details', function () {
        const notifType = $(this).data('type');
        const itemId = $(this).data('id');
        console.log('Notification clicked! Type:', notifType, 'ID:', itemId);
    
        if (notifType === 'appointment') {
            $.ajax({
                url: 'fetch_appointment_details.php',
                type: 'GET',
                data: {
                    appoint_id: itemId
                },
                success: function (response) {
                    const appointment = JSON.parse(response);
                    updateModalContent(appointment);
    
                    $('.confirm').attr('data-appointment-id', itemId);
                    $('.cancel').attr('data-appointment-id', itemId);
    
                    showModal();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log('AJAX error:', textStatus, errorThrown);
                }
            });
        }
    });
    
    $('.notif-button').click(function (event) {
        event.preventDefault();
        const appointmentId = $(this).attr('data-appointment-id');

        $.ajax({
            url: 'fetch_appointment_details.php',
            type: 'GET',
            data: {
                appoint_id: appointmentId
            },
            success: function (response) {
                console.log(response);
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
        updateAppointmentStatus(appointmentId, 'confirmed');
        window.open('send_email_appointment.php?appoint_id=' + appointmentId, '_blank');
    });

    function showModal() {
        $('.appointment-details-view').css('display', 'flex');
        $('.appointment-details-view').css('position', 'fixed');
        $('body').css('overflow', 'hidden');
        notifBar.hide();
    }

    function hideModal() {
        $('.appointment-details-view').css('display', 'none');
        $('body').css('overflow-y', 'auto');
        const cancelButton = $('#cancel-button');
        const confirmButton = $('#confirm-button');
        
        cancelButton.css('display', 'flex');
        confirmButton.css('display', 'flex');
        cancelButton.prop('disabled', false);
    }

    function updateModalContent(appointment) {
        const guestNameElementAppoint = $('#guest-name-details-appoint');
        const dateElement = $('#guest-date-details');
        const timeElement = $('#guest-time-details');
        const agendaElement = $('#guest-agenda-details');
        const profilePictureElement = $('.guest-pfp');
    
        guestNameElementAppoint.text(appointment.first_name + ' ' + appointment.last_name);
        dateElement.text(appointment.appoint_sched_date);
        timeElement.text(appointment.appoint_sched_time);
        agendaElement.text(appointment.appoint_description);
        const profilePictureUrl = "../guest_side/" + appointment.profile_picture;
        profilePictureElement.attr('src', profilePictureUrl);
        
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

        const cancelButton = $('#cancel-button');
        const confirmButton = $('#confirm-button');

        if (appointment.appoint_status === 'pending') {
            cancelButton.css('display', 'flex');
            confirmButton.css('display', 'flex');
        } else if (appointment.appoint_status === 'confirmed') {
            cancelButton.css('display', 'flex');
            confirmButton.css('display', 'none');
        } else if (appointment.appoint_status === 'cancelled') {
            cancelButton.css('display', 'flex');
            confirmButton.css('display', 'none');
            cancelButton.prop('disabled', true);
        } else {
            cancelButton.css('display', 'flex');
            confirmButton.css('display', 'flex');
            cancelButton.prop('disabled', false);
        }
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

        Swal.fire({
            title: title,
            text: text,
            icon: icon
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload();
            }
        });
    }
});
