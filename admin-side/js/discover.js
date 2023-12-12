$(document).ready(function() {
    const imageInput = $('#imageInput');
    const discoverImage = $('#discoverImage');
    const hiddenImageInput = $('input[name="discover_image"]');
    const serviceForm = $('.edit-service-details');
    const souvenirForm = $('.edit-souvenir-details');

    imageInput.change(function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                discoverImage.attr('src', e.target.result);
                hiddenImageInput.val(e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });

    $(document).on("click", ".del-btn", function() {
        var form = $(this).closest('form');
        var itemId = form.find("input[name$='_id']").val();
        var itemType = form.find("input[name='item_type']").val();
        deleteDiscover(itemType, itemId);
        return false;
    });

    function deleteDiscover(itemType, itemId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: 'delete_discover.php',
                    data: {
                        item_type: itemType,
                        item_id: itemId
                    },
                    dataType: 'json',
                    success: function(data) {

                        if (data.success) {
                            $("#discoverModal").hide();
                            $(document.body).css("overflow-y", "auto");
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: data.message,
                                onClose: function() {
                                    location.reload();
                                    window.location = "post-discover.php";
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'An error occurred while deleting. Please try again.'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'An error occurred while deleting. Please try again.'
                        });
                    },
                    complete: function(xhr, status) {
                        //complete sending
                    }
                });
            }
        });
    }


    $(".save-btn").click(function(e) {
        e.preventDefault();

        var form = $(this).closest('form');
        var formData = new FormData(form[0]);

        formData.append('imageInput', imageInput[0].files[0]);

        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.success) {
                    $("#discoverModal").hide();
                     $(document.body).css("overflow-y", "auto");
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data.message,
                        onClose: function() {
                            location.reload();
                            window.location = "post-discover.php";s
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred while updating details. Please try again.'
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'An error occurred while fetching item details. Please try again.'
                });
            }
        });
    });

    $("#closeDiscoverBtn").click(function() {
        $("#discoverModal").hide();
        $(document.body).css("overflow-y", "auto");
    });

    $(".view-btn").click(function() {
        const itemId = $(this).data("id");
        const itemType = $(this).data("type");

        $.ajax({
            type: 'POST',
            url: 'get_details.php',
            data: {
                fetch_details: true,
                item_id: itemId,
                item_type: itemType
            },
            dataType: 'json',
            success: function(data) {
                $("#discoverModal").css({
                    "display": "flex",
                    "position": "fixed",
                });
                $(document.body).css("overflow", "hidden");

                if (itemType === "souvenir") {
                    serviceForm.hide();
                    souvenirForm.show();

                    if (data.hasOwnProperty('error')) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'An error occurred while fetching souvenir details. Please try again.'
                        });
                    } else {
                        $("#discoverModal .edit-details").text("Edit Souvenir Details");
                        $("#discoverModal input[name='item_id']").val(data['item_id']);
                        $("#discoverImage").attr("src", data['souvenir_img_path']);
                        $("#discoverModal input[name='item_name']").val(data['item_name']);
                        $("#discoverModal textarea[name='souvenir_description']").val(data['souvenir_description']);
                    }
                } else if (itemType === "service") {
                    serviceForm.show();
                    souvenirForm.hide();

                    if (data.hasOwnProperty('error')) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'An error occurred while fetching service details. Please try again.'
                        });
                    } else {
                        $("#discoverModal .edit-details").text("Edit Service Details");
                        $("#discoverModal input[name='service_id']").val(data['service_id']);
                        $("#discoverImage").attr("src", data['img_path']);
                        $("#discoverModal input[name='service_name']").val(data['service_name']);
                        $("#discoverModal textarea[name='service_description']").val(data['service_description']);
                    }
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'An error occurred while fetching item details. Please try again.'
                });
            }
        });
    });
});