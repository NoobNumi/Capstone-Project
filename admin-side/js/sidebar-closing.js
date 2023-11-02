function isMobileView() {
    return window.innerWidth <= 768;
}

function setDefaultSidebarState() {
    let guestSidebar = document.querySelector(".admin-sidebar");

    if (isMobileView()) {
        guestSidebar.classList.add("closed");
    } else {
        guestSidebar.classList.remove("closed");
    }
}

window.addEventListener('load', setDefaultSidebarState);
window.addEventListener('resize', setDefaultSidebarState);

setDefaultSidebarState();

