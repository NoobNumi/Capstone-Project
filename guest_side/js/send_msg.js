$(document).ready(function () {
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
        modalImg .style.display = "block";
        modalImage.src = imageUrl;

        var closeBtn = document.getElementsByClassName("button-close")[0];
        closeBtn.onclick = function () {
            modalImg .style.display = "none";
        };

        window.onclick = function (event) {
            if (event.target == modalImg) {
                modalImg .style.display = "none";
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
    });

    const form = document.querySelector(".typing-area");
    const inputField = form.querySelector(".input-field");
    const sendBtn = form.querySelector("button");
    const chatBox = document.querySelector(".chat-box");
    const confirmButton = document.getElementById('btn_confirm');

    document.getElementById('file-add').addEventListener('change', function () {
        updateImagePreview(this);
    });

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

    function resetImagePreview() {
        let imagePreview = document.getElementById('image-preview');
        if (imagePreview) {
            imagePreview.src = '';
            imagePreview.style.display = 'none';
        }
    }

    $('.typing-area').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        formData.append("action", "insert");

        console.log(formData);
        $.ajax({
            url: 'handle_messages.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log('message posted');
                inputField.value = "";
                updateChat();
                resetImagePreview();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('An error occurred:', errorThrown);
            }
        });
    });

    function scrollToBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    function updateChat() {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "handle_messages.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    chatBox.innerHTML = data;
                    scrollToBottom();
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

    window.onload = function () {
        scrollToBottom();
        updateChat();
    };
});