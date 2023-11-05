const postContainer = $('.post-container');
const createPost = $('.create-post');
const closePostContainer = $('.close-post')

postContainer.click(function () {
    createPost.css('display', 'flex');
    $('body').css('overflow', 'hidden');

});

closePostContainer.click(function () {
    createPost.css('display', 'none');
    $('body').css('overflow-y', 'auto');
});
