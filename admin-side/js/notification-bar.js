$(document).ready(function () {
    const notifNames = $('.notif-name');
    const notifSlider = $('.notif-name-slider');
    const notifBar = $('.notif-bar');
    const notifBtn = $('.notif-bar-btn');
    const notifDetails = $('.notif-details');
    const notificationList = $('.notification-list');
    let selectedType = 'all';

    let lastUnreadCount = null;
    let fetchInterval = '';

    function fetchNotifications() {
        if (fetchInterval) {
            clearInterval(fetchInterval);
        }

        function pollNotifications() {
            $.ajax({
                url: 'get_notifications.php',
                method: 'GET',
                dataType: 'json',
                success: function (notifications) {
                    const newUnreadCount = calculateUnreadCount(notifications);
                    updateUnreadCount(notifications);
                    lastUnreadCount = newUnreadCount;

                    if (newUnreadCount !== lastUnreadCount) {
                        updateUnreadCount(notifications);
                        lastUnreadCount = newUnreadCount;
                    }

                    updateNotifications(notifications);
                    if (newUnreadCount === 0) {
                        clearInterval(fetchInterval);
                    }
                },

                error: function (error) {
                    console.error('Error fetching notifications:', error);
                }
            });
        }

        pollNotifications();

        fetchInterval = setInterval(pollNotifications, 3000);
    }

    function calculateUnreadCount(notifications) {
        return notifications.reduce((count, notification) => {
            return count + (notification.is_read === 0 ? 1 : 0);
        }, 0);
    }

    function updateUnreadCount(notifications) {
        try {
            const unreadCount = calculateUnreadCount(notifications);

            const notifNumber = $('.notif-number');
            notifNumber.text(unreadCount);

            if (unreadCount > 0) {
                notifNumber.show();
            } else {
                notifNumber.hide();
            }
        } catch (err) {
            console.error('Error updating unread count:', err);
        }
    }

    function getTimePeriod(timestamp, today, yesterday) {
        const momentTimestamp = moment(timestamp);
        if (momentTimestamp.isSameOrAfter(today, 'day')) {
            return 'Today';
        } else if (momentTimestamp.isSameOrAfter(yesterday, 'day')) {
            return 'Yesterday';
        } else {
            return momentTimestamp.format('MMM D');
        }
    }

    let lastTimePeriod = null;

    function hasNotifications(notifications, selectedType) {
        return notifications.some(notification => {
            const notifType = notification.type;
            return selectedType === 'all' || selectedType === notifType;
        });
    }

    function updateNotifications(notifications) {
        notificationList.empty();

        if (notifications.length === 0) {
            notificationList.append('<div class="no-notifications-message"><p>You have no notifications.</p></div>');
            return;
        }

        let lastTimePeriod = null;

        notifications.forEach(notification => {
            const timestamp = new Date(notification.timestamp);
            const formattedTimestamp = moment(timestamp).format('h:mm A');
            const timePeriod = getTimePeriod(timestamp, moment().startOf('day'), moment().subtract(1, 'days'));

            if (selectedType === 'all' || notification.type + 's' === selectedType) {
                if (timePeriod !== lastTimePeriod) {
                    const timePeriodLabel = timePeriod === 'Today' || timePeriod === 'Yesterday'
                        ? `<span class="time-period">${timePeriod}</span>`
                        : `<span class="time-period">${moment(timestamp).format('MMM D')}</span>`;
                    notificationList.append(timePeriodLabel);
                    lastTimePeriod = timePeriod;
                }

                const dataId = notification.id;
                const reservationId = notification.reservation_id || dataId;
                const reservationType = notification.reservation_type;
                const isRead = notification.is_read || 0;

                const notificationItem = $(`
                    <li class="notif-details" data-type="${notification.type}" data-id="${dataId}" data-reservation-id="${reservationId}" data-reservation-type="${reservationType}">
                        <div class="notif-left-side">
                            <img src="../guest_side/${notification.profile_picture}">
                            <p class="notif-about">
                                <span class="notifier-name">
                                    ${notification.first_name} ${notification.last_name}
                                </span>
                                ${notification.type === 'appointment' ? 'booked an Appointment' : 'booked a Reservation'}
                            </p>
                        </div>
                        <div class="notif-center">
                            <span class="timestamp">${formattedTimestamp}</span>
                        </div>
                        ${isRead === 0 ? '<span class="unread-dot"></span>' : ''}
                    </li>
                `);

                notificationList.append(notificationItem);
            }
        });
    }

    notificationList.on('click', '.notif-details', function () {
        const selectedNotification = $(this);
        const notifType = selectedNotification.data('type');
        const itemId = selectedNotification.data('id');
        const reservationType = selectedNotification.data('reservation-type') || '';

        $.ajax({
            url: 'mark_notification_as_read.php',
            type: 'POST',
            data: {
                item_id: itemId,
                notif_type: notifType,
                reservation_type: reservationType
            },
            success: function (response) {
                selectedNotification.find('.unread-dot').remove();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error marking notification as read:', errorThrown);
            }
        });

        if (notifType === 'reservations') {
            handleReservationClick(itemId, reservationType);
        }
    });

    $('.notif-names').click(function () {
        $('.notif-names').removeClass('active');
        $(this).addClass('active');
        selectedType = $(this).attr('data-type');
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

            selectedType = $(this).data('type');
        });
    });

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
    fetchNotifications();
});
