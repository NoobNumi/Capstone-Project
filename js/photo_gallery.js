 // PHOTO GALLERY VIEW

 document.querySelector('.popup-img span').addEventListener('click', () => {
    const popupImg = document.querySelector('.popup-img');
    const popupImgImg = document.querySelector('.popup-img img');
    popupImg.style.display = 'none';
    popupImgImg.classList.remove('zoom');
});

document.querySelectorAll('.gallery img').forEach(image => {
    image.onclick = () => {
        document.querySelector('.popup-img').style.display = 'block';
        document.querySelector('.popup-img img').src = image.getAttribute('src');
        image.addEventListener('dblclick', () => {
            const popupImg = document.querySelector('.popup-img');
            const popupImgImg = document.querySelector('.popup-img img');
            popupImgImg.src = image.src;
            popupImg.style.display = 'block';
            popupImgImg.classList.add('zoom');
        });

    }
})
