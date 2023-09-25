const usersList = document.querySelector(".chat-people");

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

                        } else if (latestMessageText === 'No messages') {

                        } else {
                            if (user.is_admin === 1) {
                                latestMessageText = `You: ${latestMessageText}`;
                            } else {
                                latestMessageText = `${latestMessageText}`;
                            }
                        }

                        html += `
                        <li>
                            <a href="admin-chat.php?user_id=${user.user_id}">
                                <img src="../images/guest.png">
                                <div class="msg-allText">
                                    <span class="guest-name">
                                        ${user.first_name} ${user.last_name}
                                    </span>
                                    <p class="msg">${latestMessageText}</p>
                                </div>
                            </a>
                        </li>
                    `;
                    });

                    usersList.innerHTML = html;
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

fetchAllUsers();
