$(document).ready(function () {

    $('.btnUpdateReservation').on('click', function () {
        var reservationId = $(this).data('reservation-id');
        var reservationType = $(this).data('reservation-type');


        $('#updateService').data('reservation-id', reservationId);
        $('#updateService').data('reservation-type', reservationType);

        fetchReservationDetails(reservationId, reservationType)
            .done(function (reservationDetails) {
                updateModalContent(reservationDetails, reservationType);
            })
            .fail(function (xhr, status, error) {
                console.error('Ajax request failed! Status:', status, 'Error:', error);
            });
    });


    function fetchReservationDetails(reservationId, reservationType) {
        return $.ajax({
            type: 'GET',
            url: 'fetch_update_reservation.php',
            data: {
                reservation_id: reservationId,
                reservation_type: reservationType
            },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    updateModalContent(response.reservation, reservationType);
                } else {
                    console.error('Error fetching/updating reservation:', response.error);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    }






    function updateModalContent(reservation, reservationType, reservationId) {
        const guestNameElement = $('#userNameReservation');
        const contactNoElement = $('#userContactReservation');
        const mealSelection = $('.selection');
        const updateService = $('#updateService');
        const updateReservationsHeader = $('.update-section header h6');

        guestNameElement.val(reservation.first_name);
        contactNoElement.val(reservation.contact_no);

        const viewMeals = $('.view-meals');
        const updateMealsTitle = $('#updateMealsTitle');
        updateReservationsHeader.text('Update Reservations');
        viewMeals.hide();
        mealSelection.show();
        updateService.show();

        const modal = $('.update-reservation');
        modal.css('display', 'flex');
        modal.css('position', 'fixed');
        $('body').css('overflow-x', 'hidden');
        $('.chip-card').removeClass('selected');


        updateService.data('reservation-id', reservation.id);
        updateService.data('reservation-type', reservationType);
        updateReservationsHeader.text(`Update Reservations - ${reservationType}`);

        const selectedMeals = ['breakfast', 'lunch', 'dinner', 'drinks', 'dessert'];
        selectedMeals.forEach(function (mealType) {
            const selectedMeal = reservation[mealType];
            if (selectedMeal) {
                const chipListSelector = `#${mealType.charAt(0).toUpperCase() + mealType.slice(1)}`;

                $(`${chipListSelector} .chip-card`).off('click').on('click', function () {
                    $(`${chipListSelector} .chip-card`).removeClass('selected');
                    $(this).addClass('selected');
                });

                $(`${chipListSelector} .chip-card:contains("${selectedMeal}")`).click();
            }
        });

        $.ajax({
            type: 'GET',
            url: 'fetch_meals.php',
            dataType: 'json',
            success: function (mealsData) {

                if ($('.chip-category').children().length > 0) {
                    return;
                }

                let cateringPackageMeals = [];
                if (reservation.package === 'Catering Package') {
                    cateringPackageMeals = mealsData['ld'];
                }

                $.each(mealsData, function (type, meals) {
                    const lowercaseType = type.toLowerCase();

                    if (lowercaseType === 'ld') {
                        const lunchContainer = $('<div>', { class: 'chips-container' });
                        const lunchIcon = $('<i>', { class: 'fa-solid fa-pizza-slice' });
                        const lunchTitle = $('<span>').append(lunchIcon, ' ', reservation.package === 'Catering Package' ? 'Meal Two' : 'Lunch');
                        const lunchList = $('<div>', { class: 'chip-list', id: 'Lunch' });

                        const dinnerContainer = $('<div>', { class: 'chips-container' });
                        const dinnerIcon = $('<i>', { class: 'fa-solid fa-shrimp' });
                        const dinnerTitle = $('<span>').append(dinnerIcon, ' ', reservation.package === 'Catering Package' ? 'Meal Three' : 'Dinner');
                        const dinnerList = $('<div>', { class: 'chip-list', id: 'Dinner' });

                        const mealsToUse = reservation.package === "Catering Package" ? cateringPackageMeals : meals;

                        $.each(mealsToUse, function (index, meal) {
                            const chipCard = $('<div>', { class: 'chip-card', text: meal });
                            lunchList.append(chipCard.clone());
                            dinnerList.append(chipCard.clone());
                        });

                        lunchContainer.append(lunchTitle, lunchList);
                        dinnerContainer.append(dinnerTitle, dinnerList);

                        $('.chip-category').append(lunchContainer, dinnerContainer);
                    } else {
                        const mealContainer = $('<div>', { class: 'chips-container' });
                        const mealIcon = $('<i>', { class: `fa-solid fa-${lowercaseType === 'breakfast' ? 'bowl-food' : lowercaseType === 'dessert' ? 'ice-cream' : lowercaseType === 'drinks' ? 'mug-saucer' : ''}` });
                        const mealTitle = $('<span>').append(mealIcon, ' ', reservation.package === 'Catering Package' && ['breakfast', 'lunch', 'dinner'].includes(lowercaseType) ?
                            (lowercaseType === 'breakfast' ? 'Meal One' : lowercaseType === 'lunch' ? 'Meal Two' : 'Meal Three') :
                            lowercaseType.charAt(0).toUpperCase() + lowercaseType.slice(1));
                        const mealList = $('<div>', { class: 'chip-list', id: lowercaseType.charAt(0).toUpperCase() + lowercaseType.slice(1) });

                        const mealsToUse = (reservation.package === "Catering Package" && ['breakfast', 'lunch', 'dinner'].includes(lowercaseType)) ? cateringPackageMeals : meals;

                        $.each(mealsToUse, function (index, meal) {
                            const chipCard = $('<div>', { class: 'chip-card', text: meal });
                            mealList.append(chipCard);
                        });

                        mealContainer.append(mealTitle, mealList);
                        if (mealList.children().length > 0) {
                            $('.chip-category').append(mealContainer);
                        }
                    }
                });

                $('.chip-card').removeClass('selected');
                const selectedMeals = ['breakfast', 'lunch', 'dinner', 'drinks', 'dessert'];
                selectedMeals.forEach(function (mealType) {
                    const selectedMeal = reservation[mealType];
                    if (selectedMeal) {
                        const chipListSelector = `#${mealType.charAt(0).toUpperCase() + mealType.slice(1)}`;

                        $(`${chipListSelector} .chip-card`).off('click').on('click', function () {
                            $(`${chipListSelector} .chip-card`).removeClass('selected');
                            $(this).addClass('selected');
                        });

                        $(`${chipListSelector} .chip-card:contains("${selectedMeal}")`).click();
                    }
                });
            }
        });


        if (reservation.status === 'confirmed' || reservation.status === 'cancelled') {
            const guestNameElement = $('#userNameReservation');
            const contactNoElement = $('#userContactReservation');
            mealSelection.hide();
            viewMeals.show();
            guestNameElement.prop('readonly', true);
            contactNoElement.prop('readonly', true);
            updateReservationsHeader.text('View Reservations');
            updateMealsTitle.text('Meals');
            updateMealsTitle.show();
            updateService.hide();

            $.ajax({
                type: 'GET',
                url: 'fetch_meals_data.php',
                dataType: 'json',
                success: function (mealsData) {
                    selectedMeals.forEach(function (mealType) {
                        const selectedMeal = reservation[mealType];
                        const viewMealContainer = viewMeals.find(`#${mealType}`);
                        viewMealContainer.empty();

                        if (mealType === 'dessert' || mealType === 'drinks') {
                            if (selectedMeal && mealsData[mealType] && mealsData[mealType][selectedMeal]) {
                                const mealImgPath = mealsData[mealType][selectedMeal];

                                const mealImage = $('<img>', { src: mealImgPath, alt: selectedMeal, srcset: '', class: 'meal-image' });
                                const categoryAndNameContainer = $('<div>', { class: 'category-n-name' });
                                const categorySpan = $('<span>', { class: 'category-n' }).text(mealType.toUpperCase());
                                const mealNameSpan = $('<span>', { class: 'meal-n' }).text(selectedMeal);

                                categoryAndNameContainer.append(categorySpan, mealNameSpan);
                                viewMealContainer.append(mealImage, categoryAndNameContainer);
                            }
                        } else if (mealType === 'breakfast') {
                            if (reservation.package === 'Catering Package' && selectedMeal && mealsData['ld'] && mealsData['ld'][selectedMeal]) {
                                const mealImgPath = mealsData['ld'][selectedMeal];

                                const mealImage = $('<img>', { src: mealImgPath, alt: selectedMeal, srcset: '', class: 'meal-image' });
                                const categoryAndNameContainer = $('<div>', { class: 'category-n-name' });
                                const categorySpan = $('<span>', { class: 'category-n' }).text('MEAL ONE');
                                const mealNameSpan = $('<span>', { class: 'meal-n' }).text(selectedMeal);

                                categoryAndNameContainer.append(categorySpan, mealNameSpan);
                                viewMealContainer.append(mealImage, categoryAndNameContainer);
                            } else if (selectedMeal && mealsData[mealType] && mealsData[mealType][selectedMeal]) {
                                const mealImgPath = mealsData[mealType][selectedMeal];

                                const mealImage = $('<img>', { src: mealImgPath, alt: selectedMeal, srcset: '', class: 'meal-image' });
                                const categoryAndNameContainer = $('<div>', { class: 'category-n-name' });
                                const categorySpan = $('<span>', { class: 'category-n' }).text(mealType.toUpperCase());
                                const mealNameSpan = $('<span>', { class: 'meal-n' }).text(selectedMeal);

                                categoryAndNameContainer.append(categorySpan, mealNameSpan);
                                viewMealContainer.append(mealImage, categoryAndNameContainer);
                            }
                        } else if (mealType === 'lunch' || mealType === 'dinner') {
                            if (selectedMeal && mealsData['ld'] && mealsData['ld'][selectedMeal]) {
                                const mealImgPath = mealsData['ld'][selectedMeal];
                                const mealImage = $('<img>', { src: mealImgPath, alt: selectedMeal, srcset: '', class: 'meal-image' });
                                const categoryAndNameContainer = $('<div>', { class: 'category-n-name' });

                                if (reservation.package === 'Catering Package') {
                                    const categorySpan = $('<span>', { class: 'category-n' }).text(mealType === 'lunch' ? 'MEAL TWO' : 'MEAL THREE');
                                    const mealNameSpan = $('<span>', { class: 'meal-n' }).text(selectedMeal);

                                    categoryAndNameContainer.append(categorySpan, mealNameSpan);
                                } else {
                                    const categorySpan = $('<span>', { class: 'category-n' }).text(mealType.toUpperCase());
                                    const mealNameSpan = $('<span>', { class: 'meal-n' }).text(selectedMeal);

                                    categoryAndNameContainer.append(categorySpan, mealNameSpan);
                                }

                                viewMealContainer.append(mealImage, categoryAndNameContainer);
                            }
                        }
                    });
                }
            });


        } else {
            const guestNameElement = $('#userNameReservation');
            const contactNoElement = $('#userContactReservation');
            guestNameElement.prop('readonly', false);
            contactNoElement.prop('readonly', false);
        }

        if (reservation.package === 'Venue-Only Package') {
            const mealSelection = $('.selection');
            updateMealsTitle.hide();
            mealSelection.hide();
        }
    }


    function closeAndUpdateModal() {
        $('.update-reservation').hide();
        $('body').css('position', '');
        $('.chip-category').empty();

        updateModalContent({}, '', null);

        $('.update-reservation').hide();
        $('body').css('position', '');
        $('.chip-category').empty();
    }

    $('#closeReservationUpdate').on('click', closeAndUpdateModal);


    let isDragging = false;
    let startX;
    let scrollLeft;

    $('.chip-category').on({
        "mousedown touchstart": startDragging,
        "mouseup mouseleave touchend": stopDragging,
        "mousemove touchmove": moveScroll,
        "wheel": handleWheel,
        "click": function (e) {
            if ($(e.target).is('.chip-card')) {
                $(e.target).siblings('.chip-card').removeClass('selected');
                $(e.target).addClass('selected');
            }
        }
    }, '.chip-list');


    function startDragging(e) {
        isDragging = true;
        startX = e.clientX || e.originalEvent.touches[0].clientX;
        scrollLeft = $(this).scrollLeft();
    }

    function stopDragging() {
        isDragging = false;
    }

    function moveScroll(e) {
        if (!isDragging) return;
        e.preventDefault();
        const x = e.clientX || e.originalEvent.touches[0].clientX;
        const walk = (x - startX) * 2;
        $(this).scrollLeft(scrollLeft - walk);
    }

    function handleWheel(e) {
        e.preventDefault();
        const delta = e.originalEvent.deltaY;
        const scrollAmount = 100;

        if (delta > 0) {
            $(this).scrollLeft($(this).scrollLeft() + scrollAmount);
        } else {
            $(this).scrollLeft($(this).scrollLeft() - scrollAmount);
        }
    }

    $('.chip-list').on('click', '.chip-card', function () {
        $(this).siblings('.chip-card').removeClass('selected');
        $(this).addClass('selected');
    });

    $('#updateService').on('click', function (event) {
        event.preventDefault();
        const reservationId = $(this).data('reservation-id');
        const reservationType = $(this).data('reservation-type');


        const updatedReservation = getUpdatedReservationData();

        updateReservationContent(updatedReservation, reservationType, reservationId);
    });


    function getUpdatedReservationData() {
        const updatedFirstName = $('#userNameReservation').val();
        const updatedContactNo = $('#userContactReservation').val();

        const selectedMeals = ['breakfast', 'lunch', 'dinner', 'drinks', 'dessert'];
        const selectedMealData = selectedMeals.map(mealType => {
            const selectedMeal = $(`#${mealType.charAt(0).toUpperCase() + mealType.slice(1)} .chip-card.selected`).text();
            return { type: mealType, meal: selectedMeal };
        });

        return {
            first_name: updatedFirstName,
            contact_no: updatedContactNo,
            selected_meals: selectedMealData,
        };
    }



    function updateReservationContent(updatedReservation, reservationType, reservationId) {
        $.ajax({
            url: 'change-reservation-details.php',
            method: 'POST',
            data: {
                reservationType: reservationType,
                updatedReservation: updatedReservation,
                reservationId: reservationId,
            },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Do you want to update this reservation's details?",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'No'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Your reservation\'s details are successfully updated!',
                                timer: 3000,
                                showConfirmButton: false
                            });

                            setTimeout(function () {
                                location.reload();
                            }, 3000);
                        }
                    });

                    $('#closeReservationUpdate').click();
                } else {
                    console.log('Error updating reservation:', response.error);
                }
            },
            error: function (xhr, status, error) {
                console.log('AJAX Error:', status, error);
                console.log('Response Text:', xhr.responseText);
            },
        });
    }

    
    $('.btnCancelReservation').on('click', function (e) {
        e.preventDefault();

        const reservationId = $(this).data('reservation-id');
        const reservationType = $(this).data('reservation-type');

        fetchReservationDetails(reservationId, reservationType)
            .then(response => {
                console.log(response);
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to undo this.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, cancel it!',
                    cancelButtonText: 'No, don\'t cancel it.'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'cancel_reservation.php',
                            method: 'POST',
                            data: {
                                reservationId: reservationId,
                                reservationType: reservationType,
                            },
                            dataType: 'json',
                            success: function (cancelResponse) {
                                console.log('Cancel Response:', cancelResponse);
                                handleCancellationResponse(cancelResponse, reservationType);
                            },
                            
                            error: function (xhr, status, error) {
                                console.log('AJAX Error:', status, error);
                            },
                        });
                    }
                });

            })
            .catch(error => {
                console.error('Error fetching reservation details:', error);
            });

            function handleCancellationResponse(response, reservationType) {
                if (response.success) {
                    let message = 'Your cancellation for this reservation is successful.';
                    if (response.payment_method === 'GCash') {
                        message += ' Please message us for the refund, if any.';
                    }
                    Swal.fire({
                        title: 'Cancellation Successful!',
                        text: message,
                        icon: 'success',
                        showCancelButton: (response.payment_method === 'GCash'),
                        confirmButtonText: (response.payment_method === 'GCash') ? 'Message for a Refund' : 'OK',
                    }).then((result) => {
                        if (result.isConfirmed && response.payment_method === 'GCash') {
                            window.location.href = 'messages.php';
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to cancel the reservation. Please try again.',
                        icon: 'error'
                    });
                }
            }
    });

    

});
