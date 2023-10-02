document.addEventListener("DOMContentLoaded", function () {
    const usersList = document.querySelector(".chat-people");

    function markMessageAsRead(messageId) {
        $.ajax({
            type: 'POST',
            url: 'mark_message_as_read.php',
            data: { message_id: messageId },
            success: function (response) {
                console.log("Success");
            },
            error: function (xhr, status, error) {
                console.log("Error");
            }
        });
    }

    function markAllMessagesAsRead(receiverId) {
        $.ajax({
            type: 'POST',
            url: 'mark_message_as_read.php',
            data: { receiver_id: receiverId },
            success: function (response) {
                console.log("All messages marked as read");
            },
            error: function (xhr, status, error) {
                console.log("Error marking messages as read:", error);
            }
        });
    }


    function fetchAllUsers() {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "fetch_users.php", true);

        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    console.log("Received data:", response);

                    if (Array.isArray(response.users)) {
                        response.users.sort((a, b) => {
                            const timestampA = new Date(a.timestamp).getTime();
                            const timestampB = new Date(b.timestamp).getTime();
                            return timestampB - timestampA;
                        });

                        let html = "";
                        response.users.forEach((user) => {
                            let latestMessageText = user.latest_message || 'No messages';

                            if (user.image_url) {
                                if (user.is_admin === 1) {
                                    latestMessageText = 'You sent a photo';
                                } else {
                                    latestMessageText = `${user.first_name} sent a photo`;
                                }
                            } else if (latestMessageText.startsWith('You: ')) {
                                // Handle 'You: ' prefix
                            } else if (latestMessageText === 'No messages') {
                                // Handle 'No messages'
                            } else {
                                if (user.is_admin === 1) {
                                    latestMessageText = `You: ${latestMessageText}`;
                                } else {
                                    latestMessageText = `${latestMessageText}`;
                                }
                            }

                            html += `
                        <li id="user-${user.user_id}" class="${user.li_class}">
                            <a href="admin-chat.php?user_id=${user.user_id}">
                                <img src="../images/guest.png">
                                <div class="msg-allText">
                                    <span class="guest-name">
                                        ${user.first_name} ${user.last_name}
                                    </span>
                                    <p class="msg ${user.font_weight}">${latestMessageText}</p>
                                    ${user.notification}
                                </div>
                            </a>
                        </li>
                    `;
                        });

                        usersList.innerHTML = html;

                        response.users.forEach((user) => {
                            document.getElementById(`user-${user.user_id}`).addEventListener('click', (event) => {
                                event.preventDefault();
                                markMessageAsRead(user.message_id);
                                window.location.href = `admin-chat.php?user_id=${user.user_id}`;
                            });
                        });

                        updateMessageCount(response.unread_count);
                    } else {
                        console.error("Data.users is not an array.");
                    }
                } else {
                    console.error("Error status:", xhr.status);
                }
            }
        };

        xhr.send();
    }

    function updateUsers() {
        fetchAllUsers();

        $.ajax({
            type: 'GET',
            url: 'fetch_users.php',
            dataType: 'json',
            success: function (response) {
                if (response.unread_count !== undefined) {
                    updateMessageCount(response.unread_count);

                    const messageCountElement = document.querySelector(".notif-count");
                    const countColorElement = document.querySelector(".count-color");
                    const adminSidebar = document.querySelector(".admin-sidebar");
                    
                    function updateMessageCount(unreadMessageCount) {
                        setTimeout(() => {
                            if (unreadMessageCount > 0) {
                                messageCountElement.textContent = unreadMessageCount;
                                messageCountElement.classList.remove("hidden");
                                
                                if (adminSidebar.classList.contains("open")) {
                                    countColorElement.style.display = "none";
                                } else {
                                    countColorElement.style.display = "block";
                                }
                            } else {
                                messageCountElement.textContent = "";
                                messageCountElement.classList.add("hidden");
                                countColorElement.style.display = "none";
                            }
                        }, 0);
                    }
                    
                }
            },
            error: function (xhr, status, error) {
                console.log("Error fetching unread message count");
            }
        });

        setTimeout(updateUsers, 500);
    }

    if (usersList) {
        usersList.addEventListener('click', function (event) {
            const userId = event.target.closest('li').id.replace('user-', '');
            console.log('Clicked user ID:', userId);
            markAllMessagesAsRead(userId);
            window.location.href = `admin-chat.php?user_id=${userId}`;
        });
    }

    updateUsers();
});