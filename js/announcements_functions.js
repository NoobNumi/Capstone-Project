

// LIKE BUTTON TOGGLE

const likeReactButtons = document.querySelectorAll('#like_react');

likeReactButtons.forEach(button => {
    button.addEventListener('click', () => {
        button.classList.toggle('clicked');
    });
});

// POST COMMENTS


var postComments = document.querySelectorAll('.post-comment');
postComments.forEach(function (comment, index) {
    comment.addEventListener("click", function () {
        var commentLines = document.querySelectorAll('.comment-line');
        var commentDetails = document.querySelectorAll('.comment-details');

        commentLines[index].style.display = "block";
        commentDetails[index].style.display = "flex";
    });
});


// SHARE POST LINK
var modal = document.getElementById("share_post_options");

var btns = document.querySelectorAll('#share_btn');

var span = document.getElementsByClassName("close")[0];

for (var i = 0; i < btns.length; i++) {
    btns[i].onclick = function () {
        modal.style.display = "block";
        document.body.style.overflow = 'hidden';
    }
}

span.onclick = function () {
    modal.style.display = "none";
    document.body.style.overflow = 'auto';

}

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
