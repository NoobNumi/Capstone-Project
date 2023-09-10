const usersList = document.querySelector(".chat-people");

function fetchAllUsers() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "fetch_users.php", true);

    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const data = JSON.parse(xhr.responseText);
                let html = "";
                data.forEach((user) => {
                    html += `
                        <li>
                            <a href="admin-chat.php?user_id=${user.user_id}">
                                <img src="../images/guest.png">
                                <div class="msg-allText">
                                    <span class="guest-name">
                                        ${user.first_name} ${user.last_name}
                                    </span>
                                    <p class="msg">${user.latest_message}</p>
                                </div>
                            </a>
                        </li>
                    `;
                });
                usersList.innerHTML = html;
            } else {
                console.error("Error status:", xhr.status);
            }
        }
    };

    xhr.send();
}

fetchAllUsers();
