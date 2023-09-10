document.addEventListener("DOMContentLoaded", function () {
    const images = document.querySelectorAll(".images img");
    const imageModal = document.getElementById("imageModal");
    const modalImage = document.getElementById("modalImage");
    const closeModal = document.getElementById("closeModal");
    const toggleGridButton = document.getElementById("toggleGrid");
    const photoArray = document.getElementById("photoArray");

    let currentImageIndex = 0;

    // Function to open the modal and display the clicked image
    function openModal(index) {
        modalImage.src = images[index].src;
        imageModal.style.display = "block";
        document.body.style.overflow = "hidden";
        currentImageIndex = index;
    }

    // Function to close the modal
    function closeModalHandler() {
        imageModal.style.display = "none";
        document.body.style.overflow = "auto";
    }

    // Add click event listeners to each image for zooming
    images.forEach((image, index) => {
        image.addEventListener("click", () => {
            openModal(index);
        });
    });

    // Add click event listener to close the modal
    closeModal.addEventListener("click", closeModalHandler);

    // Add click event listener to toggle image grid on mobile
    toggleGridButton.addEventListener("click", () => {
        photoArray.classList.toggle("grid-view");
    });

    // Swipe gesture handling for mobile
    let startX = null;
    let endX = null;

    photoArray.addEventListener("touchstart", (e) => {
        startX = e.touches[0].clientX;
    });

    photoArray.addEventListener("touchmove", (e) => {
        endX = e.touches[0].clientX;
    });

    photoArray.addEventListener("touchend", () => {
        const threshold = 50; // Adjust as needed
        if (startX && endX && startX - endX > threshold) {
            // Swipe left (next image)
            currentImageIndex = (currentImageIndex + 1) % images.length;
            openModal(currentImageIndex);
        } else if (startX && endX && endX - startX > threshold) {
            // Swipe right (previous image)
            currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
            openModal(currentImageIndex);
        }

        startX = null;
        endX = null;
    });
});
