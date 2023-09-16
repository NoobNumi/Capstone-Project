 // ------------------------- Admin sidebar -------------------------------- //

 let guestSidebar = document.querySelector(".admin-sidebar");
 let closeBtn = document.querySelector("#guestMenu");

 closeBtn.addEventListener("click", () => {
     guestSidebar.classList.toggle("open");
     menuBtnchange();
 })