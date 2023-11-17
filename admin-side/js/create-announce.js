const addPhotosButton = document.getElementById("addPhotos");
const fileInput = document.querySelector('input[name="images[]"]');
const photoDisplayAll = document.querySelector(".photo-display-all");

addPhotosButton.addEventListener("click", () => {
    fileInput.click();
});

let selectedImages = [];


fileInput.addEventListener("change", () => {
    const files = fileInput.files;

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        if (file.type.startsWith("image/")) {
            const uniqueIdentifier = file.name + file.size;
            if (!selectedImages.some(image => image.name + image.size === uniqueIdentifier)) {
                selectedImages.push(file);

                const imgElement = document.createElement("img");
                imgElement.src = URL.createObjectURL(file);

                const photoContainer = document.createElement("div");
                photoContainer.className = "photo-container";

                const delPhotoIcon = document.createElement("i");
                delPhotoIcon.className = "fa-solid fa-xmark closePostButton";
                photoContainer.appendChild(delPhotoIcon);

                imgElement.className = "photo-img";
                photoContainer.appendChild(imgElement);

                photoDisplayAll.style.display = "block";
                photoDisplayAll.appendChild(photoContainer);

                delPhotoIcon.addEventListener("click", () => {
                    selectedImages = selectedImages.filter(image => image.name !== file.name);
                    photoDisplayAll.removeChild(photoContainer);
                });
            }
        }
    }
});

document.getElementById("myForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    formData.delete('images[]');

    for (const file of selectedImages) {
        formData.append('images[]', file);
    }

    $.ajax({
        type: 'POST',
        url: 'create-announcement.php',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            console.log(response);
            Swal.fire("Success", "Announcement added successfully", "success").then(function () {
                window.location = "post-announcements.php";
            });
        },
        error: function (xhr, status, error) {
            console.error(error);
            Swal.fire("Error", "Upload failed", "error");
        }
    });

    fileInput.value = '';
});
