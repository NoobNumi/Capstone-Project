lightbox.option({
    'resizeDuration': 200,
    'wrapAround': true
});

$('.overlay').on('click', function () {
    $(this).parent().find('a')[0].click();
});