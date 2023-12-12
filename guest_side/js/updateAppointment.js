$(document).ready(function () {

    $('.btnUpdateAppointment').on('click', function (e) {
        e.preventDefault();

        console.log('Button clicked')
        const appointmentId = $(this).data('appointment-id');
        fetchAppointmentDetails(appointmentId);
    });

    function fetchAppointmentDetails(appointmentId) {
        return $.ajax({
            type: 'GET',
            url: 'fetch_update_appointment.php',
            data: {
                appointment_id: appointmentId
            },
            dataType: 'json',
            success: function (appointment) {
                console.log(appointment);
                updateModalContentAppointment(appointment);
            }
        });
    }

    function updateModalContentAppointment(appointment) {
        const guestAppointName = $('#userNameAppointment');
        const guestAppointLastName = $('#userLastNameAppointment');
        const guestAppointContact = $('#userContactAppointment');
        const appointDate = $('#schedule-input');
        const appointDescription = $('.app-description');
        const appointFormTitle = $('.update-section-appointment header h6');
        const calendarIconAppoint = $('#calendar-icon');
        const charCount = $('#char-count');
        const updateAppointmentBtn = $('#updateAppointment');

        guestAppointName.val(appointment.first_name);
        guestAppointLastName.val(appointment.last_name);
        guestAppointContact.val(appointment.contact_no);
        appointDate.val(appointment.appoint_sched_date)
        appointDescription.val(appointment.appoint_description);

        const modal = $('.update-appointment');
        modal.css('display', 'flex');
        modal.css('position', 'fixed');
        $('body').css('overflow-x', 'hidden');



        if (appointment.appoint_status === 'confirmed' || appointment.appoint_status === 'cancelled') {
            appointFormTitle.text('View Appointment');
            guestAppointName.prop('readonly', true);
            guestAppointContact.prop('readonly', true);
            appointDescription.prop('readonly', true);
            calendarIconAppoint.hide();
            charCount.hide();
            updateAppointmentBtn.hide();
        } else {
            appointFormTitle.text('Update Appointment')
            guestAppointName.prop('readonly', false);
            guestAppointContact.prop('readonly', false);
            appointDescription.prop('readonly', false);
            calendarIconAppoint.show();
            calendarIconAppoint.show();
            charCount.show();
            updateAppointmentBtn.show();
        }


        updateAppointmentBtn.off('click').on('click', function (e) {
            e.preventDefault();
        });

        $('.update-appointment form').submit(function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to update the details of this appointment?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, update it!',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('.update-appointment').css('display', 'none');
                    const updatedAppointment = {
                        first_name: guestAppointName.val(),
                        last_name: guestAppointLastName.val(),
                        contact_no: guestAppointContact.val(),
                        appoint_sched_date: appointDate.val(),
                        appoint_description: appointDescription.val()
                    };

                    const appointmentId = appointment.appoint_id;

                    $.ajax({
                        type: 'POST',
                        url: 'change-appointment-details.php',
                        data: {
                            updatedAppointment: updatedAppointment,
                            appointmentId: appointmentId
                        },
                        dataType: 'json',
                        success: function (response) {
                            if (response.success) {
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Appointment updated successfully!',
                                    icon: 'success',
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Error!', 'Failed to update appointment. Please try again.', 'error');
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('AJAX error:', status, error);
                            Swal.fire('Error!', 'An error occurred during the update. Please try again.', 'error');
                        }
                    });
                }
            });
        });

        updateAppointmentBtn.click(function () {
            $('.update-appointment form').submit();
        });

    }

    $('.btnCancelAppointment').on('click', function (e) {
        e.preventDefault();

        const appointmentId = $(this).data('appointment-id');

        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to cancel this appointment?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, cancel it!',
            cancelButtonText: 'No, keep it'
        }).then((result) => {
            if (result.isConfirmed) {
                cancelAppointment(appointmentId);
            }
        });
    });

    function cancelAppointment(appointmentId) {
        $.ajax({
            type: 'POST',
            url: 'cancel_appointment.php',
            data: {
                appointmentId: appointmentId
            },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    Swal.fire('Cancelled!', 'The appointment has been cancelled.', 'success').then(() => {
                        location.reload();
                    });
                } else {
                    console.log('Response:', response);
                    Swal.fire('Error!', response.error || 'Failed to cancel the appointment. Please try again.', 'error');
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX error:', status, error);
                var errorMessage = 'An error occurred during the cancellation. Please try again.';
                if (xhr.status === 500) {
                    errorMessage = 'Internal Server Error. Check server logs for details.';
                }
    
                Swal.fire('Error!', errorMessage, 'error');
            }
        });
    }
    

    $('#closeAppointmentUpdate').on('click', function () {
        $('.update-appointment').css('display', 'none');
        $('body').css('position', '');
        $('body').css('overflow-x', 'hidden');
    });

});
