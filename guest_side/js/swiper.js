var swiper = new Swiper(".slide-content", {
    slidesPerView: 'auto',
    spaceBetween: 25,
    loop: true,
    centeredSlides: true, 
    fadeEffect: true,
    grabCursor: true,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false, 
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
      dynamicBullets: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },

    breakpoints:{
        0: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 2,
        },
        950: {
            slidesPerView: 3,
        },
    },
});
