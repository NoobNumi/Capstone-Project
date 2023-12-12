$(document).ready(function () {
    const form = document.querySelector(".typing-area");
    const inputField = form.querySelector(".input-field");
    const sendBtn = form.querySelector("button");
    const chatBox = document.querySelector(".chat-box");
    const confirmButton = document.getElementById('btn_confirm');
    var userScrolledUp = false;
    const fileInput = document.getElementById('file-input');
    
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
        var $previewImgDiv = $(".preview-img");

        if (input.files.length > 0) {
            $previewImgDiv.show();
            $previewImgDiv.html("");

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

    fileInput.addEventListener('change', function () {
        updateImagePreview(this);
    });

    form.onsubmit = (e) => {
        e.preventDefault();

        if (fileInput.files.length === 0 && inputField.value.trim() === "") {
            return;
        }

        let formData = new FormData(form);
        formData.append("action", "insert");

        $.ajax({
            url: 'handle_messages.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                inputField.value = "";
                resetImagePreview();
                updateChat();
                updateNotificationCount(); 
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('An error occurred:', errorThrown);
            }
        });
    };

    function resetImagePreview() {
        fileInput.value = "";
        $(".preview-img").hide();
    }


    function updateChat() {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "handle_messages.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    chatBox.innerHTML = data;
                    if (!userScrolledUp) {
                        scrollChatToBottom();
                    }
                    markLatestMessageAsRead();
                } else {
                    console.error("Failed to fetch messages:", xhr.status);
                }
            }
        };

        xhr.onerror = function () {
            console.error('An error occurred with the AJAX request.');
        };

        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("action=get");
    }

        function markLatestMessageAsRead() {
            const latestMessage = document.querySelector(".chat:last-child");
            if (latestMessage) {
                const messageIdElement = latestMessage.querySelector(".message-id");
                if (messageIdElement) {
                    const messageId = messageIdElement.value;
                    if (messageId) {
        
                        $.ajax({
                            url: 'mark_latest_message_as_read.php',
                            type: 'POST',
                            data: { message_id: messageId },
                            success: function (response) {
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                console.error('An error occurred:', errorThrown);
                            }
                        });
                    }
                }
            }
        }
    
    

    chatBox.addEventListener("wheel", function (e) {
        if (e.deltaY < 0) {
            userScrolledUp = true;
        }
    });


    confirmButton.addEventListener('click', () => {
        logoutUser();
    });

    function logoutUser() {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "logout.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    window.location.href = "login.php";
                } else {
                    console.error("Failed to log out:", xhr.status);
                }
            }
        };
        xhr.send();
    }

    updateChat();
    setInterval(updateChat, 500);
    
});
