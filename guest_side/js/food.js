const navToggleChoices = document.querySelector(".nav-toggle-choices");
const mealTypes = document.querySelectorAll('.meal-type');
const mealTypeName = document.querySelector('.meal-type-name'); 
const mealList = document.querySelector('.meal-list');

let isDragging = false;
let startX;
let scrollLeft;

navToggleChoices.addEventListener("mousedown", startDragging);
navToggleChoices.addEventListener("touchstart", startDragging);

navToggleChoices.addEventListener("mouseup", stopDragging);
navToggleChoices.addEventListener("mouseleave", stopDragging);
navToggleChoices.addEventListener("touchend", stopDragging);

navToggleChoices.addEventListener("mousemove", moveScroll);
navToggleChoices.addEventListener("touchmove", moveScroll);

function startDragging(e) {
    isDragging = true;
    startX = e.clientX || e.touches[0].clientX;
    scrollLeft = navToggleChoices.scrollLeft;
}

function stopDragging() {
    isDragging = false;
}

function moveScroll(e) {
    if (!isDragging) return;
    e.preventDefault();
    const x = e.clientX || e.touches[0].clientX;
    const walk = (x - startX) * 2;
    navToggleChoices.scrollLeft = scrollLeft - walk;
}


const foodDetails = document.querySelectorAll('.food-details');

foodDetails.forEach((element) => {
    element.addEventListener('click', (event) => {
        foodDetails.forEach((el) => {
            el.classList.remove('selected');
        });

        element.classList.add('selected');
    });
});
