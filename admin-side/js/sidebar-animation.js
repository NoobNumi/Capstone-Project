var currentPageURL = window.location.href;
var menuItems = document.querySelectorAll('.admin-navbar li');
menuItems.forEach(function(item) {
  var linkElement = item.querySelector('a');
  if (linkElement && linkElement.getAttribute('href')) {
    var linkURL = linkElement.getAttribute('href');
    if (currentPageURL === linkURL) {
      item.classList.add('active');
    }
  }
});

let guestSidebar = document.querySelector(".admin-sidebar");
let closeBtn = document.querySelector("#guestMenu");
let scheduleView = document.querySelector(".schedule-view");

closeBtn.addEventListener("click", () => {
    guestSidebar.classList.toggle("open");
    scheduleView.classList.toggle("admin-sidebar-open");
});
