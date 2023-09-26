$(document).ready(function () {
    const form = document.querySelector(".typing-area");
    const inputField = form.querySelector(".input-field");
    const sendBtn = form.querySelector("button");
    const confirmButton = document.getElementById('btn_confirm');
    const urlParams = new URLSearchParams(window.location.search);
    const user_id = urlParams.get('user_id');
    var chatBox = document.querySelector(".chat-box");
    var userScrolledUp = false;
    var isFirstLoad = true;

    function scrollChatToBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }
    
    chatBox.addEventListener("wheel", function (e) {
        if (e.deltaY < 0) {
            userScrolledUp = true;
        } else {
            userScrolledUp = false;
        }
    });


    function updateImagePreview(input) {
        console.log("updateImagePreview called");
        var $previewImgDiv = $(".preview-img");

        if (input.files.length > 0) {
            $previewImgDiv.show();

            for (var i = 0; i < input.files.length; i++) {
                var imageUrl = URL.createObjectURL(input.files[i]);
                var $imagePreview = $('<div class="image-set"></div>');
                $imagePreview.append('<img src="' + imageUrl + '" alt="Selected Image Preview" style="max-width: 100%;">');
                $imagePreview.append('<i class="fa-solid fa-xmark"></i>');
                $previewImgDiv.append($imagePreview);

                $imagePreview.find(".fa-xmark").on("click", function () {
                    var $imageSet = $(this).closest(".image-set");
                    $imageSet.remove();

                    if ($previewImgDiv.find(".image-set").length === 0) {
                        $previewImgDiv.hide();
                    }
                });
            }
        }
    }

    function openImageModal(imageUrl) {
        var modalImg = document.getElementById("imageModal");
        var modalImage = document.getElementById("modalImage");
        document.getElementById('downloadButton').setAttribute('href', imageUrl);
        modalImg.style.display = "block";
        modalImage.src = imageUrl;

        var closeBtn = document.getElementsByClassName("button-close")[0];
        closeBtn.onclick = function () {
            modalImg.style.display = "none";
        };

        window.onclick = function (event) {
            if (event.target == modalImg) {
                modalImg.style.display = "none";
            }
        };
    }


    function handleImageSelection() {
        $(".chat-box").on("click", ".image-msg", function () {
            var imageUrl = $(this).attr("src");

            openImageModal(imageUrl);
        });
    }

    handleImageSelection();


    $(".preview-img").hide();

    $("#file-input").on("change", function () {
        updateImagePreview(this);
    });

    $("#file-add").on("change", function () {
        updateImagePreview(this);
    });

    $(".typing-area").on("submit", function (e) {
        $(".preview-img").hide();
        $("#file-input").val("");
    });

    if (!user_id) {
        console.error("user_id not found in URL.");
        return;
    }

    form.onsubmit = (e) => {
        e.preventDefault();
    };

    inputField.focus();
    inputField.onkeyup = () => {
        if (inputField.value !== "") {
            sendBtn.classList.add("active");
        } else {
            sendBtn.classList.remove("active");
        }
    };

    sendBtn.onclick = () => {
        console.log('Send button clicked');
        sendMessage();
    };

    function sendMessage() {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "admin_handle_messages.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    inputField.value = "";
                    updateChat();
                } else {
                    console.error("Failed to send message:", xhr.status);
                }
            }
        };
        let formData = new FormData(form);
        formData.append("action", "insert");
        formData.append("user_id", user_id);
        xhr.send(formData);
    }

    function updateChat() {
        console.log('Updating chat...');
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "admin_handle_messages.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.responseText;
                    chatBox.innerHTML = data;
                    if (!userScrolledUp) {
                        scrollChatToBottom();
                    }

                } else {
                    console.error("Failed to fetch messages:", xhr.status);
                }
            }
        };

        xhr.onerror = function () {
            console.error('An error occurred with the AJAX request.');
        };

        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("action=get&user_id=" + user_id);
    }

    chatBox.addEventListener("wheel", function (e) {
        if (e.deltaY < 0) {
            userScrolledUp = true;
        }
    });


    function loadMessages(user_id) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "load_messages.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const messages = JSON.parse(xhr.responseText);
                    let chatMessages = document.querySelector(".chat-messages");

                    chatMessages.innerHTML = "";

                    messages.forEach((message) => {
                        const messageText = message.message;
                        chatMessages.innerHTML += '<p class="msg">' + messageText + '</p>';
                    });

                    if (isFirstLoad) {
                        scrollChatToBottom();
                        isFirstLoad = false;
                    }
                } else {
                    console.error("Error status:", xhr.status);
                }
            }
        };

        xhr.send("user_id=" + user_id);
    }

    confirmButton.addEventListener('click', () => {
        logoutUser();
    });

    function logoutUser() {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "logout.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    window.location.href = "admin_login.php";
                } else {
                    console.error("Failed to log out:", xhr.status);
                }
            }
        };
        xhr.send();
    }

    loadMessages(user_id);
    updateChat();
    setInterval(updateChat, 500);
});

