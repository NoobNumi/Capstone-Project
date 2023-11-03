$(document).ready(function () {
    $('.view-btn').click(function () {
        const mealId = $(this).data('meal-id');
        console.log('View button clicked with ID:', mealId);
        $.ajax({
            url: 'fetch_meal_details.php',
            type: 'GET',
            data: {
                meal_id: mealId
            },
            success: function (response) {
                const meal = JSON.parse(response);
                updateModalContent(meal);
                fetchCategoriesAndPopulateSelect();
                $('.del-btn').attr('data-meal-id', mealId);
                $('.save-btn').attr('data-meal-id', mealId);
                $('input[name="meal_id"]').val(mealId);

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
    $('.save-btn').click(function () {
        const mealId = $(this).data('meal-id');
        console.log('Save button clicked with ID:', mealId);
        hideModal();
        Swal.fire('Success', 'Meal successfully updated', 'success');
    });

    $('.del-btn').click(function () {
        const form = $(this).closest('form');
        form.removeClass('update-meal-form');
        form.addClass('delete-meal-form');
        const mealId = $(this).data('meal-id');

        deleteMeal(mealId);
    });


    function showModal() {
        $('.meal-view-modal').css('display', 'flex');
        $('.meal-view-modal').css('position', 'fixed');
        $('body').css('overflow', 'hidden');
    }
    function hideModal() {
        $('.meal-view-modal').css('display', 'none');
        $('body').css('overflow-y', 'auto');
    }
    function updateModalContent(meal) {
        console.log('Meal name:', meal.meal_name);
        console.log('Meal image path:', meal.meal_img_path);
        console.log('Meal category:', meal.mealCat_name);
        $('input[name="meal_name"]').val(meal.meal_name);
        const categorySelect = $('select[name="category"]');
        categorySelect.val(meal.mealCat_name);
        $('#mealImage').attr('src', meal.meal_img_path);
    }
    function fetchCategoriesAndPopulateSelect() {
        const categorySelect = $('select[name="category_id"]');
        categorySelect.empty();
        $.ajax({
            url: 'fetch_categories.php',
            type: 'GET',
            success: function (response) {
                const categories = JSON.parse(response);
                categories.forEach((category) => {
                    categorySelect.append(`<option value="${category.mealCat_id}">${category.mealCat_name}</option>`);
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('AJAX error:', textStatus, errorThrown);
            }
        });
    }

    $('.edit-meal-details').submit(function (event) {
        console.log('Form submitted');
        event.preventDefault();
        const form = $(this);
        const formData = new FormData(form[0]);
        console.log('Form Data:', formData);
        const imageInput = document.getElementById('imageInput');

        if (form.hasClass('update-meal-form')) {
            if (imageInput.files.length > 0) {
                formData.append('meal_image', imageInput.files[0]);
            }

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log('Update success:');
                    console.log(response);
                    Swal.fire({
                        title: 'Success',
                        text: 'Meal successfully updated',
                        icon: 'success',
                        timer: 2500
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log('AJAX error:', textStatus, errorThrown);
                }
            });
        } else if (form.hasClass('delete-meal-form')) {
            const mealId = form.find('input[name="meal_id"]').val();
            deleteMeal(mealId);
        }
    });


    function deleteMeal(mealId) {
        Swal.fire({
            title: 'Confirm Deletion',
            text: 'Are you sure you want to delete this meal?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'delete_meal.php',
                    type: 'POST',
                    data: { meal_id: mealId, delete_meal: true },
                    success: function (response) {
                        const result = JSON.parse(response);
                        if (result.deleted) {
                            Swal.fire({
                                title: 'Meal Deleted',
                                text: 'The meal has been deleted.',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 2500
                            }).then(() => {
                                location.reload();
                                hideModal();
                            });
                        } else {
                            Swal.fire('Error', 'Failed to delete the meal.', 'error');
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log('AJAX error:', textStatus, errorThrown);
                        Swal.fire('Error', 'Failed to delete the meal.', 'error');
                    },
                });
            }
        });
    }


    $('.add-btn').click(function () {
        $('input[name="meal_name"]').val('');
        $('.add-meal-section').css('display', 'flex');
        $('.add-meal-section').css('position', 'fixed');
        $('body').css('overflow', 'hidden');

        populateCategorySelect();

    });

    $('#close_addButton').click(function () {
        $('.add-meal-section').css('display', 'none');
        $('body').css('overflow-y', 'auto');

        populateCategorySelect();

    });

    function populateCategorySelect() {
        const categorySelect = document.querySelector('select[name="category_add_id"]');
        categorySelect.innerHTML = '';

        fetch('fetch_categories.php')
            .then(response => response.json())
            .then(categories => {
                categories.forEach(category => {
                    const option = document.createElement('option');
                    option.value = category.mealCat_id;
                    option.text = category.mealCat_name;
                    categorySelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching categories:', error));
    }
});