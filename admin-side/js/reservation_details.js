$(document).ready(function () {
    const notifButtons = $('.notif-button');
    const closeModalButton = $('.close-button-details');
    const cancelButtons = $('#cancel-button');
    const confirmButtons = $('#confirm-button');

    function fetchReservationDetails(reservationId, reservationType) {
        console.log('Fetching reservation details...');
        return $.ajax({
            type: 'GET',
            url: 'fetch_reservation_details.php',
            data: {
                reservation_id: reservationId,
                reservation_type: reservationType
            },
            dataType: 'json'
        });
    }

    notifButtons.each(function (index, notifButton) {
        $(notifButton).on('click', function (event) {
            event.preventDefault();
            const reservationId = $(notifButton).data('reservation-id');
            const reservationType = $(notifButton).data('reservation-type');
            console.log('Notification button clicked with ID:', reservationId);
            console.log('Reservation Type:', reservationType);

            fetchReservationDetails(reservationId, reservationType)
                .done(function (reservation) {
                    updateModalContent(reservation);
                    confirmButtons.each(function (index, confirmButton) {
                        $(confirmButton).data('reservation-id', reservationId);
                        $(confirmButton).data('reservation-type', reservationType);
                    });
                    cancelButtons.each(function (index, cancelButton) {
                        $(cancelButton).data('reservation-id', reservationId);
                        $(cancelButton).data('reservation-type', reservationType);
                    });
                    console.log('show modal');
                    showReservationModal();
                })
                .fail(function (jqXHR, textStatus, errorThrown) {
                    console.error('Error fetching reservation details:', errorThrown);
                });
        });
    });

    closeModalButton.on('click', hideReservationModal);

    cancelButtons.each(function (index, cancelButton) {
        $(cancelButton).on('click', function () {
            const reservationId = $(this).data('reservation-id');
            const reservationType = $(this).data('reservation-type');
            console.log('Cancel button clicked with ID:', reservationId);

            hideReservationModal();
            const confirmModalSection = $('.confirm-modal-section');
            confirmModalSection.css('display', 'flex');
            confirmModalSection.css('position', 'fixed');
            $('body').css('overflow', 'hidden');

            const confirmButtonNo = $('.confirm-btn.no');
            const closeConfirmModalButton = $('.close_confirm_modal');

            confirmButtonNo.on('click', function () {
                confirmModalSection.css('display', 'none');
                showReservationModal();
            });

            closeConfirmModalButton.on('click', function () {
                confirmModalSection.css('display', 'none');
                showReservationModal();
            });

            const confirmButtonYes = $('.confirm-btn.yes');
            confirmButtonYes.on('click', function () {
                confirmModalSection.css('display', 'none');
                updateReservationStatus(reservationId, 'cancelled', reservationType);
            });
        });
    });

    confirmButtons.each(function (index, confirmButton) {
        $(confirmButton).on('click', function () {
            const reservationId = $(this).data('reservation-id');
            const reservationType = $(this).data('reservation-type');
            console.log('Confirm button clicked with ID:', reservationId);
            console.log('Reservation Type (Confirm Button):', reservationType);
            updateReservationStatus(reservationId, 'confirmed', reservationType);
            window.open('send_email_reservation.php?reservation_id=' + reservationId + '&reservation_type=' + reservationType, '_blank');
        });
    });

    function showReservationModal() {
        console.log('showReservationModal function is called.');
        const reservationDetailsView = $('.reservation-details-view');
        reservationDetailsView.css('display', 'flex');
        $('body').css('overflow', 'hidden');
    }

    function hideReservationModal() {
        const reservationDetailsView = $('.reservation-details-view');
        reservationDetailsView.css('display', 'none');
        $('body').css('overflowY', 'auto');
        const cancelButton = $('#cancel-button');
        const confirmButton = $('#confirm-button');
        
        cancelButton.css('display', 'flex');
        confirmButton.css('display', 'flex');
        cancelButton.prop('disabled', false);
    }

    function updateModalContent(reservation) {
        const guestNameElement = $('#guest-name-details');
        const contactInfoElement = $('#guest-contact-details');
        const checkInElement = $('#guest-check-in');
        const checkOutElement = $('#guest-check-out');
        const priceElement = $('#guest-price');
        const paymentMethodElement = $('#guest-payment-method');
        const proofOfPaymentElement = $('#guest-proof-of-payment');
    
        guestNameElement.text(reservation.first_name + ' ' + reservation.last_name);
        contactInfoElement.text(reservation.contact_no);
        checkInElement.text(reservation.check_in);
        checkOutElement.text(reservation.check_out);
        priceElement.text(reservation.price);
        paymentMethodElement.text(reservation.payment_method);
    
        const statusIconElement = $('#status-icon');
    
        let iconClass = 'fa-question';
    
        if (reservation.status === 'pending') {
            iconClass = 'fa-clock';
        } else if (reservation.status === 'confirmed') {
            iconClass = 'fa-circle-check';
        } else if (reservation.status === 'cancelled') {
            iconClass = 'fa-ban';
        }
    
        statusIconElement.attr('class', 'fa-solid ' + iconClass);
    
        const cancelButton = $('#cancel-button');
        const confirmButton = $('#confirm-button');

        if (reservation.status === 'pending') {
            cancelButton.css('display', 'flex');
            confirmButton.css('display', 'flex');
        } else if (reservation.status === 'confirmed') {
            cancelButton.css('display', 'flex');
            confirmButton.css('display', 'none');
        } else if (reservation.status === 'cancelled') {
            cancelButton.css('display', 'flex');
            confirmButton.css('display', 'none');
            cancelButton.prop('disabled', true);
        } else {
            cancelButton.css('display', 'flex');
            confirmButton.css('display', 'flex');
            cancelButton.prop('disabled', false);
        }
    }


    function updateReservationStatus(reservationId, newStatus, reservationType) {
        $.ajax({
            url: 'update_reservation_status.php',
            type: 'POST',
            data: {
                reservation_id: reservationId,
                new_status: newStatus,
                reservation_type: reservationType
            },
            success: function (response) {
                console.log('Update reservation status response:', response);
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
            title = 'Reservation confirmed!';
            icon = 'success';
            text = `${message.first_name}'s reservation has been confirmed and is set on ${message.check_in}. We have notified ${message.first_name} with the reservation!`;
            hideReservationModal();
        } else if (action === 'cancelled') {
            title = 'Reservation canceled!';
            icon = 'error';
            text = `The reservation for ${message.first_name} has been cancelled. We have notified ${message.first_name} with the cancellation!`;
            hideReservationModal();
        } else if (success) {
            title = 'Success';
            icon = 'success';
            text = typeof message === 'string' ? message : 'Reservation updated successfully';
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