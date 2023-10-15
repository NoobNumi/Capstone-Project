document.addEventListener("DOMContentLoaded", function () {
    const images = document.querySelectorAll(".images img");
    const imageModal = document.getElementById("imageModal");
    const modalImage = document.getElementById("modalImage");
    const closeModal = document.getElementById("closeModal");
    const toggleGridButton = document.getElementById("toggleGrid");
    const photoArray = document.getElementById("photoArray");

    let currentImageIndex = 0;

    function openModal(index) {
        modalImage.src = images[index].src;
        imageModal.style.display = "flex";
        document.body.style.overflow = "hidden";
        currentImageIndex = index;
    }

    function closeModalHandler() {
        imageModal.style.display = "none";
        document.body.style.overflow = "auto";
    }

    images.forEach((image, index) => {
        image.addEventListener("click", () => {
            openModal(index);
        });
    });

    closeModal.addEventListener("click", closeModalHandler);

    toggleGridButton.addEventListener("click", () => {
        photoArray.classList.toggle("grid-view");
    });

    let startX = null;
    let endX = null;

    photoArray.addEventListener("touchstart", (e) => {
        startX = e.touches[0].clientX;
    });

    photoArray.addEventListener("touchmove", (e) => {
        endX = e.touches[0].clientX;
    });

    photoArray.addEventListener("touchend", () => {
        const threshold = 50;
        if (startX && endX && startX - endX > threshold) {
            currentImageIndex = (currentImageIndex + 1) % images.length;
            openModal(currentImageIndex);
        } else if (startX && endX && endX - startX > threshold) {
            currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
            openModal(currentImageIndex);
        }

        startX = null;
        endX = null;
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const prevButton = document.querySelector(".prev-button");
    const nextButton = document.querySelector(".next-button");
    const slidesContainer = document.querySelector(".carousel-slides");
    const slideWidth = document.querySelector(".carousel-image").clientWidth;

    const firstSlideClone = slidesContainer.firstElementChild.cloneNode(true);
    slidesContainer.appendChild(firstSlideClone);

    let currentSlide = 0;
    let isTransitioning = false;

    function showSlide() {
        if (!isTransitioning) {
            slidesContainer.style.transition = "transform 0.5s ease-in-out";
            slidesContainer.style.transform = `translateX(-${currentSlide * slideWidth}px)`;
            isTransitioning = true;
        }
    }

    nextButton.addEventListener("click", function() {
        if (!isTransitioning) {
            currentSlide++;
            showSlide();
        }
    });

    prevButton.addEventListener("click", function() {
        if (!isTransitioning) {
            currentSlide--;
            showSlide();
        }
    });

    slidesContainer.addEventListener("transitionend", function() {
        isTransitioning = false;
        if (currentSlide === slidesContainer.children.length - 1) {
            currentSlide = 0;
            slidesContainer.style.transition = "none";
            slidesContainer.style.transform = `translateX(0)`;
        }
        else if (currentSlide === -1) {
            currentSlide = slidesContainer.children.length - 2;
            slidesContainer.style.transition = "none";
            slidesContainer.style.transform = `translateX(-${currentSlide * slideWidth}px)`;
        }
    });

    function autoScroll() {
        if (!isTransitioning) {
            currentSlide++;
            showSlide();
        }
        setTimeout(autoScroll, 3000);
    }

    setTimeout(autoScroll, 3000);
});
