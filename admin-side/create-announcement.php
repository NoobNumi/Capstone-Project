<body>
    <section class="create-post">
        <div class="create-post-modal">
            <header>
                <span class="create-title">Create Post</span>
                <i class="fa-solid fa-xmark close-post"></i>
            </header>
            <form action="" class="create-post-form">
                <div class="profile-pic">
                    <img src="../images/nun.png" width="50px" height="50px" alt="" srcset="">
                    <span class="poster-name">Admin</span>
                </div>
                <textarea name="" id="" cols="30" rows="5" placeholder="Post an update..."></textarea>
                <div class="post-photos">
                    <div class="photo-display-all">
                        <!-- images are displayed here -->
                    </div>
                    <div class="add-photos" id="addPhotos">
                        <i class="fa-solid fa-image"></i>
                        <span>Add photos</span>
                        <input type="file" id="fileInput" accept="image/*" multiple style="display: none;">
                    </div>
                </div>
                <div class="create-post-button">
                    <button class="btn-view">Post</button>
                </div>
            </form>
        </div>
    </section>
    <script>
        const addPhotosButton = document.getElementById("addPhotos");
        const fileInput = document.getElementById("fileInput");
        const photoDisplayAll = document.querySelector(".photo-display-all");

        addPhotosButton.addEventListener("click", () => {
            fileInput.click();
        });

        fileInput.addEventListener("change", () => {
            const files = fileInput.files;

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                if (file.type.startsWith("image/")) {
                    const imgElement = document.createElement("img");
                    imgElement.src = URL.createObjectURL(file);

                    const photoContainer = document.createElement("div");
                    photoContainer.className = "photo-container";

                    const delPhotoIcon = document.createElement("i");
                    delPhotoIcon.className = "fa-solid fa-xmark closePostButton";
                    photoContainer.appendChild(delPhotoIcon);

                    imgElement.className = "photo-img";
                    photoContainer.appendChild(imgElement);

                    photoDisplayAll.style.display = "block";
                    photoDisplayAll.appendChild(photoContainer);

                    delPhotoIcon.addEventListener("click", () => {
                        photoDisplayAll.removeChild(photoContainer);
                        photoDisplayAll.style.display = ("none");
                    });
                }
            }
        });
    </script>

</body>

</html>