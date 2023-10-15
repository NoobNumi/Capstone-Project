function initializeCarousel() {
    const packageSlideContainer = document.querySelector(".package-carousel-slides");
    const packageSlideImages = packageSlideContainer.querySelectorAll(".carousel-image-pkg");
    const packageSlideWidth = packageSlideImages.length > 0 ? packageSlideImages[0].clientWidth : 0;
    const firstSlideClone = packageSlideContainer.firstElementChild.cloneNode(true);
    packageSlideContainer.appendChild(firstSlideClone);

    let currentSlide = 0;
    let isTransitioning = false;

    function showSlide() {
        if (!isTransitioning) {
            packageSlideContainer.style.transition = "transform 0.5s ease-in-out";
            packageSlideContainer.style.transform = `translateX(-${currentSlide * packageSlideWidth}px)`;
            isTransitioning = true;
        }
    }

    const nextBtn = document.querySelector(".next-btn");
    const prevBtn = document.querySelector(".prev-btn");

    nextBtn.addEventListener("click", function () {
        console.log("nextBtn is clicked");
        if (!isTransitioning) {
            currentSlide++;
            showSlide();
        }
    });

    prevBtn.addEventListener("click", function () {
        console.log("prevBtn is clicked");
        if (!isTransitioning) {
            currentSlide--;
            showSlide();
        }
    });

    packageSlideContainer.addEventListener("transitionend", function () {
        isTransitioning = false;
        if (currentSlide === packageSlideContainer.children.length - 1) {
            currentSlide = 0;
            packageSlideContainer.style.transition = "none";
            packageSlideContainer.style.transform = `translateX(0)`;
        } else if (currentSlide === -1) {
            currentSlide = packageSlideContainer.children.length - 2;
            packageSlideContainer.style.transition = "none";
            packageSlideContainer.style.transform = `translateX(-${currentSlide * packageSlideWidth}px)`;
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
    
    document.addEventListener("click", function (event) {
        if (event.target === packageSection) {
            packageSection.style.display = "none";
            document.body.style.overflowY = "auto";
            window.scrollTo(0, scrollPosition);
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    const packageSection = document.querySelector(".meal-package-section");
    const viewButtons = document.querySelectorAll(".button-view-details");
    const closePackageBtn = document.querySelector("#packageCloseBtn");
    let scrollPosition = 0;

    viewButtons.forEach(button => {
        button.addEventListener("click", function (e) {
            e.preventDefault();
            scrollPosition = window.scrollY;
            packageSection.style.display = "flex";

            initializeCarousel();

            document.body.style.overflowY = "hidden";
            document.body.style.top = `-${scrollPosition}px`;
        });
    });

    closePackageBtn.addEventListener("click", function () {
        packageSection.style.display = "none";
        document.body.style.overflowY = "auto";
        window.scrollTo(0, scrollPosition);
    });
});
