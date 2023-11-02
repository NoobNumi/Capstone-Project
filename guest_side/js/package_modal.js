let scrollPosition = 0;

// document.addEventListener("DOMContentLoaded", function () {
//     const packageInfo = [
//         {
//             name: "Catering Package",
//             modalId: "cateringPackageModal",
//             openButtonId: "openCateringButton",
//             closeButtonId: "cateringCloseBtn",
//             carouselIdentifier: "catering-carousel",
//         },
//         {
//             name: "Venue-Only Package",
//             modalId: "venuePackageModal",
//             openButtonId: "openVenueButton",
//             closeButtonId: "venueCloseBtn",
//             carouselIdentifier: "venue-carousel",
//         },
//         {
//             name: "Seminar Package",
//             modalId: "seminarPackageModal",
//             openButtonId: "openSeminarButton",
//             closeButtonId: "seminarCloseBtn",
//             carouselIdentifier: "seminar-carousel",
//         },
//         {
//             name: "Casa Maria Retreat Package",
//             modalId: "casaPackageModal",
//             openButtonId: "openCasaButton",
//             closeButtonId: "casaCloseBtn",
//             carouselIdentifier: "casa-carousel",
//         },


//     ];

//         packageInfo.forEach(function (package) {
//             const modal = document.querySelector(`#${package.modalId}`);
//             const openButton = document.getElementById(package.openButtonId);
//             const closeButton = document.getElementById(package.closeButtonId);
    
//             openButton.addEventListener("click", function () {
//                 scrollPosition = window.scrollY;
//                 modal.style.display = "flex";
//                 modal.style.position = "fixed";
    
//                 packageInfo.forEach(function (otherPackage) {
//                     if (otherPackage.modalId !== package.modalId) {
//                         const otherModal = document.querySelector(`#${otherPackage.modalId}`);
//                         otherModal.style.display = "none";
//                     }
//                 });
    
//                 initializeCarousel(package.carouselIdentifier);
    
//                 document.body.style.overflow = "hidden";
//                 document.body.style.top = `-${scrollPosition}px`;
//             });
    
//             closeButton.addEventListener("click", function () {
//                 modal.style.display = "none";
//                 document.body.style.overflow = "auto";
//                 window.scrollTo(0, scrollPosition);
//             });
//         });


// RETREAT PACKAGE MODALS 
document.addEventListener("DOMContentLoaded", function () {
    const casaModal = document.querySelector("#casaPackageModal");
    const lunduyanModal = document.querySelector("#lunduyanPackageModal");
    const closeCasaButton = document.getElementById("casaCloseBtn");
    const closeLunduyanButton = document.getElementById("lunduyanCloseBtn");
    const triggerCasaModal = document.getElementById("openCasaButton");
    const triggerLunduyanModal = document.getElementById("openLunduyanButton");

    triggerCasaModal.addEventListener("click", function () {
        scrollPosition = window.scrollY;
        casaModal.style.display = "flex";
        casaModal.style.position = "fixed";
        lunduyanModal.style.display = "none";

        initializeCarousel("casa-carousel");

        document.body.style.overflow = "hidden";
        document.body.style.top = `-${scrollPosition}px`;
    });

    triggerLunduyanModal.addEventListener("click", function () {
        scrollPosition = window.scrollY; 
        lunduyanModal.style.display = "flex";
        document.body.style.overflow = "hidden";
        lunduyanModal.style.position = "fixed";
        casaModal.style.display = "none";

        initializeCarousel("lunduyan-carousel");
        
        document.body.style.overflow = "hidden";
        document.body.style.top = `-${scrollPosition}px`;
    });

    closeCasaButton.addEventListener("click", function () {
        casaModal.style.display = "none";
        document.body.style.overflow = "auto";
        window.scrollTo(0, scrollPosition);
    });

    closeLunduyanButton.addEventListener("click", function () {
        lunduyanModal.style.display = "none";
        document.body.style.overflow = "auto";
        window.scrollTo(0, scrollPosition); 
    });
});

//RECOLLECTION PACKAGE MODAL
document.addEventListener("DOMContentLoaded", function () {
    const recollectionModal = document.querySelector("#recollectionPackageModal");
    const closeRecollectionButton = document.getElementById("recollectionCloseBtn");
    const triggerSeminarModal = document.getElementById("openRecollectionButton");

    triggerSeminarModal.addEventListener("click", function () {
        scrollPosition = window.scrollY;
        recollectionModal.style.display = "flex";
        recollectionModal.style.position = "fixed";

        initializeCarousel("seminar-carousel");

        document.body.style.overflow = "hidden";
        document.body.style.top = `-${scrollPosition}px`;
    });

    closeRecollectionButton.addEventListener("click", function () {
        recollectionModal.style.display = "none";
        document.body.style.overflow = "auto";
        window.scrollTo(0, scrollPosition);
    });
});


// RECEPTION PACKAGE MODALs
document.addEventListener("DOMContentLoaded", function () {
    const cateringModal = document.querySelector("#cateringPackageModal");
    const venueModal = document.querySelector("#venuePackageModal");
    const closeVenueButton = document.getElementById("venueCloseBtn");
    const closeCateringButton = document.getElementById("cateringCloseBtn");
    const triggerVenueModal = document.getElementById("openVenueButton");
    const triggerCateringModal = document.getElementById("openCateringButton");

    triggerVenueModal.addEventListener("click", function () {
        scrollPosition = window.scrollY;
        venueModal.style.display = "flex";
        venueModal.style.position = "fixed";
        cateringModal.style.display = "none";

        initializeCarousel("venue-carousel");

        document.body.style.overflow = "hidden";
        document.body.style.top = `-${scrollPosition}px`;
    });

    triggerCateringModal.addEventListener("click", function () {
        scrollPosition = window.scrollY; 
        cateringModal.style.display = "flex";
        document.body.style.overflow = "hidden";
        cateringModal.style.position = "fixed";
        venueModal.style.display = "none";

        initializeCarousel("catering-carousel");
        
        document.body.style.overflow = "hidden";
        document.body.style.top = `-${scrollPosition}px`;
    });

    closeVenueButton.addEventListener("click", function () {
        venueModal.style.display = "none";
        document.body.style.overflow = "auto";
        window.scrollTo(0, scrollPosition);
    });

    closeCateringButton.addEventListener("click", function () {
        cateringModal.style.display = "none";
        document.body.style.overflow = "auto";
        window.scrollTo(0, scrollPosition); 
    });
});

// SEMINAR PACKAGE MODAL
document.addEventListener("DOMContentLoaded", function () {
    const seminarModal = document.querySelector("#seminarPackageModal");
    const closeSeminarButton = document.getElementById("seminarCloseBtn");
    const triggerSeminarModal = document.getElementById("openSeminarButton");

    triggerSeminarModal.addEventListener("click", function () {
        scrollPosition = window.scrollY;
        seminarModal.style.display = "flex";
        seminarModal.style.position = "fixed";

        initializeCarousel("seminar-carousel");

        document.body.style.overflow = "hidden";
        document.body.style.top = `-${scrollPosition}px`;
    });

    closeSeminarButton.addEventListener("click", function () {
        seminarModal.style.display = "none";
        document.body.style.overflow = "auto";
        window.scrollTo(0, scrollPosition);
    });
});

//TRAINING PACKAGE MODAL
document.addEventListener("DOMContentLoaded", function () {
    const trainingModal = document.querySelector("#trainingPackageModal");
    const closeTrainingButton = document.getElementById("trainingCloseBtn");
    const triggerTrainingModal = document.getElementById("openTrainingButton");

    triggerTrainingModal.addEventListener("click", function () {
        scrollPosition = window.scrollY;
        trainingModal.style.display = "flex";
        trainingModal.style.position = "fixed";

        initializeCarousel("training-carousel");

        document.body.style.overflow = "hidden";
        document.body.style.top = `-${scrollPosition}px`;
    });

    closeTrainingButton.addEventListener("click", function () {
        trainingModal.style.display = "none";
        document.body.style.overflow = "auto";
        window.scrollTo(0, scrollPosition);
    });
});


function initializeCarousel(carouselIdentifier) {
    const packageSlideContainer = document.querySelector(`.${carouselIdentifier} .package-carousel-slides`);
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

    const nextBtn = document.querySelector(`.${carouselIdentifier} .next-btn`);
    const prevBtn = document.querySelector(`.${carouselIdentifier} .prev-btn`);

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
}


// document.addEventListener("DOMContentLoaded", function () {
//     const packageSection = document.querySelector(".view-package-section");
//     const viewButtons = document.querySelectorAll(".button-view-details");
//     const closePackageBtn = document.querySelector("#packageCloseBtn");
//     let scrollPosition = 0;

//     viewButtons.forEach(button => {
//         button.addEventListener("click", function (e) {
//             e.preventDefault();
//             scrollPosition = window.scrollY;
//             packageSection.style.display = "flex";

//             initializeCarousel();

//             document.body.style.overflowY = "hidden";
//             document.body.style.top = `-${scrollPosition}px`;
//         });
//     });

//     closePackageBtn.addEventListener("click", function () {
//         packageSection.style.display = "none";
//         document.body.style.overflowY = "auto";
//         window.scrollTo(0, scrollPosition);
//     });
// });
