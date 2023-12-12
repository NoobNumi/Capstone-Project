document.addEventListener("DOMContentLoaded", function () {
    const isIndexPage = window.location.pathname === "index.php";
    
    function updateNotificationCount() {
        $.ajax({
            url: 'get_unread_count.php',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.unreadCount > 0) {
                    if (isIndexPage) {
                        updateNavbarSideDisplay("block");
                    } else {
                        updateCountColorDisplay("block");
                    }
                } else {
                    hideMessageCount();
                }
            },
            error: function (error) {
                console.error('Error fetching unread count: ' + error.responseText);
            }
        });
    }
    
    function updateNavbarSideDisplay(displayStyle) {
        const navbarSide = document.querySelector(".navbar-side");
        navbarSide.style.display = displayStyle;
    }
    
    function updateCountColorDisplay(displayStyle) {
        const countColorElement = document.querySelector(".count-color");
        countColorElement.style.display = displayStyle;
    }
    
    function hideMessageCount() {
        if (isIndexPage) {
            updateNavbarSideDisplay("none");
        } else {
            updateCountColorDisplay("none");
        }
    }
    

    function hideMessageCount() {
        const countColorElement = document.querySelector(".count-color");
        countColorElement.style.display = "none";
    }



    function markAllMessagesAsRead(receiverId) {
        $.ajax({
            type: 'POST',
            url: 'mark_all_messages_as_read.php',
            data: { receiver_id: receiverId },
            success: function (response) {
            },
            error: function (xhr, status, error) {
                console.log("Error marking messages as read:", error);
            }
        });
    }

    function updateNotification() {
        return new Promise(function (resolve) {
            updateNotificationCount();
            resolve();
        });
    }

    updateNotification().then(function () {
        setInterval(updateNotificationCount, 500);
    });


    $('.chat').on('click', function () {
        const receiverId = $(this).data('receiver-id');
        markAllMessagesAsRead(receiverId);
    });

    setInterval(updateNotificationCount, 500);
});
