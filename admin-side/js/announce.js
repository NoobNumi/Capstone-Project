$(document).ready(function () {
    document.querySelectorAll('.sort').forEach(item => {
        item.addEventListener('click', (event) => {
            if (event.target.classList.contains('sort')) {
                const selectedOrder = item.getAttribute('href').split('=')[1];
                window.location.href = window.location.pathname + '?order=' + selectedOrder;
            }
        });
    });

    const postContainer = $('.post-container');
    const createPost = $('.create-post');
    const closePostContainer = $('.close-create-post')

    postContainer.click(function () {
        createPost.css('display', 'flex');
        $('body').css('overflow', 'hidden');

    });


    const editPostButton = $('.edit');
    const editPost = $('.edit-post');
    const closeEditContainer = $('.close-edit-post')

    editPostButton.click(function () {
        editPost.css('display', 'flex');
        $('body').css('overflow', 'hidden');
        editPost.css('position', 'fixed');

    });


    closePostContainer.click(function () {
        createPost.css('display', 'none');
        $('body').css('overflow-y', 'auto');
    });

    closeEditContainer.click(function () {
        editPost.css('display', 'none');
        $('body').css('overflow-y', 'auto');
    });

    const replaceButton = document.getElementById("replacePhotos");
    const fileEditInput = document.querySelector('input[name="images[]"]');
    const photoFetchAll = document.querySelector(".photo-fetch-all");
    let selectedReplaceImages = [];
    let announcementId = null;
    let existingImages = [];

    replaceButton.addEventListener("click", () => {
        fileEditInput.click();
    });

    fileEditInput.addEventListener("change", () => {
        const filesEdit = fileEditInput.files;
        for (let i = 0; i < filesEdit.length; i++) {
            const fileEdit = filesEdit[i];
            if (fileEdit.type.startsWith("image/")) {
                selectedReplaceImages.push(fileEdit);
                displayImage(fileEdit);
            }
        }
    });

    function displayImage(file) {
        const imgEditElement = $('<img>').attr('src', URL.createObjectURL(file)).addClass('photo-img');
    
        const delPhotoIcon = $('<i>').addClass('fa-solid fa-xmark closeEditButton');
        const photoFetchContainer = $('<div>').addClass('photo-fetch-container').append(delPhotoIcon, imgEditElement);
    
        delPhotoIcon.click(function() {
            const fileIdentifier = file.name + file.size;
            selectedReplaceImages = selectedReplaceImages.filter(image => image.name + image.size !== fileIdentifier);
            photoFetchContainer.remove();
    
            const imgId = getImgIdByFileIdentifier(existingImages, fileIdentifier);
            if (imgId) {
                formData.delete(`existingImages[]_${imgId}`);
            }
        });
    
        $('#editPhotoFetchAll').css('display', 'block').append(photoFetchContainer);
    }
    

    $('.edit').click(function () {
        event.stopPropagation();
        announcementId = $(this).data('announcement-id');

        $.ajax({
            type: 'POST',
            url: 'fetch-announcement.php',
            data: { announcement_id: announcementId },
            dataType: 'json',
            success: function (data) {
                // Clear existing images
                $('#editPhotoFetchAll').empty();

                // Display existing images
                data.images.forEach(image => {
                    const delPhotoIcon = $('<i>').addClass('fa-solid fa-xmark closeEditButton');
                    const imgElement = $('<img>').attr('src', image.img_url_path).attr('alt', 'Image');
                    const photoContainer = $('<div>').addClass('photo-fetch-container').append(delPhotoIcon, imgElement);

                    delPhotoIcon.click(function () {
                        event.stopPropagation();
                        photoContainer.remove();

                        // Remove the image from the existingImages array
                        existingImages = existingImages.filter(img => img.img_url_path !== image.img_url_path);

                        // Add the deleted image URL to the deletedImages input field
                        const deletedImagesInput = $('input[name="deletedImages"]');
                        const deletedImageUrls = deletedImagesInput.val() ? JSON.parse(deletedImagesInput.val()) : [];

                        deletedImageUrls.push(image.img_url_path);

                        deletedImagesInput.val(JSON.stringify(deletedImageUrls));
                    });

                    $('#editPhotoFetchAll').append(photoContainer);
                });

                $('#editpostContent').val(data.post_content);

                $('.edit-post-modal').css('display', 'block');
                $('#editPhotoFetchAll').css('display', 'block');

                // Update the existingImages variable
                existingImages = data.images;
            },
            error: function (xhr, status, error) {
                console.log('Error fetching data:', error);
            }
        });
    });


    document.getElementById("myEditForm").addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        formData.append('announcement_id', announcementId);

        const postContent = document.getElementById('editpostContent').value;
        formData.append('post_content', postContent);

        formData.delete('images[]');

        existingImages.forEach((image, index) => {
            formData.append(`existingImages[${index}]`, image.img_url_path);
        });


        for (const file of selectedReplaceImages) {
            formData.append('images[]', file, file.name);
        }

        $.ajax({
            type: 'POST',
            url: 'update-announcement.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                Swal.fire("Success", "Announcement updated successfully", "success").then(function () {
                    window.location = "post-announcements.php";
                });
            },
            error: function (xhr, status, error) {
                console.error('Update failed:', error);
                Swal.fire("Error", "Update failed", "error");
            }
        });

        fileEditInput.value = '';
    });


    $('.post-card').on('click', '.delete', function () {
        event.stopPropagation();
        const announcementId = $(this).data('announcement-id');

        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this post!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: 'delete_announcement.php',
                    data: { announcement_id: announcementId },
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            Swal.fire('Deleted!', 'Your post has been deleted.', 'success').then(() => {
                                window.location = 'post-announcements.php';
                            });
                        } else {
                            Swal.fire('Error', 'An error occurred: ' + (response.error || 'Unknown error'), 'error');
                        }
                    },
                    error: function (_jqXHR, textStatus, errorThrown) {
                        console.log('AJAX Error:', textStatus, errorThrown);
                        Swal.fire('Error', 'An error occurred while deleting the post.', 'error');
                    }
                });

            }
        });
    });

    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true
    });

    $('.overlay').on('click', function () {
        $(this).parent().find('a')[0].click();
    });
});
