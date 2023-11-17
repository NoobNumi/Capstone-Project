$(document).ready(function () {
    const notifNames = $('.notif-name');
    const notifSlider = $('.notif-name-slider');
    const notifBar = $('.notif-bar');
    const notifBtn = $('.notif-bar-btn');
    const notifDetails = $('.notif-details');

    function updateNotifications(selectedType) {
        notifDetails.each(function () {
            const notifType = $(this).data('type');
            const timestamp = $(this).find('.timestamp').text();
            const isToday = timestamp.includes('Today');
            const isYesterday = timestamp.includes('Yesterday');
            const hasDate = $(this).find('.time-period').length > 0;

            if (selectedType === 'all' || selectedType === notifType) {
                if (isToday || isYesterday || !hasDate) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            } else {
                $(this).hide();
            }
        });
    }

    notifNames.click(function () {
        notifNames.removeClass('active');
        $(this).addClass('active');
        const selectedType = $(this).data('type');
        console.log('Selected Type:', selectedType);

        updateNotifications(selectedType);
    });

    function setupInitialState() {
        const initialWidth = notifNames.filter('.active').width();
        const initialTranslateX = calculateTranslateX(notifNames.filter('.active'));

        notifSlider.width(`${initialWidth}px`);
        notifSlider.css('transform', `translateX(${initialTranslateX}px) scaleX(1)`);
    }

    notifBtn.click(function () {
        if (notifBar.css('display') === 'none') {
            notifBar.css('display', 'block');
            $('body').css('overflow', 'hidden');
            setupInitialState();
        } else {
            notifBar.css('display', 'none');
            $('body').css('overflow-y', 'auto');
        }
    });

    notifNames.each(function (index) {
        $(this).click(function () {
            notifNames.removeClass('active');
            $(this).addClass('active');
            const newWidth = $(this).width();
            const newTranslateX = calculateTranslateX($(this));

            notifSlider.width(`${newWidth}px`);
            notifSlider.css('transform', `translateX(${newTranslateX}px) scaleX(1)`);

            const selectedType = $(this).data('type');
            console.log('Selected Type:', selectedType);

            updateNotifications(selectedType);
        });
    })

    function calculateTranslateX(tab) {
        const containerWidth = tab.parent().width();
        const totalTabWidth = notifNames.toArray().reduce((total, t) => total + $(t).width(), 0);
        const totalSpaceWidth = containerWidth - totalTabWidth;
        const spaceWidth = totalSpaceWidth / (notifNames.length - 1);

        let translateX = 0;
        for (let i = 0; i < tab.index(); i++) {
            translateX += notifNames.eq(i).width() + spaceWidth;
        }
        const paddingLeft = (tab.width() - tab.width()) / 2;
        return translateX + paddingLeft;
    }

    setupInitialState();
});
