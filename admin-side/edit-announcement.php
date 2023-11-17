<body>
    <section class="edit-post">
        <div class="edit-post-modal">
            <header>
                <span class="edit-title">Edit Post</span>
                <i class="fa-solid fa-xmark close-edit-post"></i>
            </header>
            <form id="myEditForm" class="edit-post-form" method="post">
                <div class="profile-pic">
                    <img src="../images/nun.png" width="50px" height="50px" alt="" srcset="">
                    <span class="poster-name">Admin</span>
                </div>
                <textarea name="post_content" id="editpostContent" cols="30" rows="5" placeholder="Post an update..."></textarea>

                <div class="post-photos">
                    <div class="photo-fetch-all" id="editPhotoFetchAll">
                        <!-- Display existing images -->
                    </div>
                    <div class="replace-photos" id="replacePhotos">
                        <i class="fa-solid fa-image"></i>
                        <span>Add photos</span>
                        <input type="file" name="images[]" id="fileEditInput" accept="image/*" multiple style="display: none">
                        <input type="hidden" name="deletedImages" value="" />
                    </div>
                </div>
                <div class="edit-post-button">
                    <button type="submit" class="btn-view">Save</button>
                </div>
            </form>
        </div>
    </section>
</body>