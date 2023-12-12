$(document).ready(function () {
    const notifNames = $('.notif-name');
    const notifSlider = $('.notif-name-slider');
    const notifBar = $('.notification-open');
    const notifBtn = $('.notif-nav');
    let selectedType = 'all';
    let notifications = [];

    function update() {
        $.ajax({
            url: 'get_notifications.php',
            method: 'GET',
            dataType: 'json',
            data: { 'data-type': selectedType },
            success: function (newNotifications) {
                notifications = newNotifications;
                renderNotifications(notifications);
                updateNotificationCount(notifications);
            },
            error: function (xhr, status, error) {
                console.error('Error fetching notifications:', status, error);
            }
        });
    }

    update();
    updateNotificationCount(notifications);

    const updateInterval = setInterval(function () {
        update();
        updateNotificationCount(notifications);
    }, 2000);


    function updateNotificationCount(notifications) {
        try {
            if (notifications && notifications.length > 0) {
                const unreadCount = notifications.reduce((count, notification) => {
                    return count + (notification.is_read_user === 0 ? 1 : 0);
                }, 0);

                const notifCountElement = $('.notif-count-color.navbar-side');
                notifCountElement.text(unreadCount);

                if (unreadCount > 0) {
                    notifCountElement.show();
                } else {
                    notifCountElement.hide();
                }
            } else {
                const notifCountElement = $('.notif-count-color.navbar-side');
                notifCountElement.hide();
            }
        } catch (err) {
            console.error('Error updating notification count:', err);
        }
    }


    function updateNotifications(type) {
        $.ajax({
            url: 'get_notifications.php',
            method: 'GET',
            dataType: 'json',
            data: { 'data-type': type },
            success: function (newNotifications) {
                notifications = newNotifications;
                renderNotifications(notifications);
            },
            error: function (xhr, status, error) {
                console.error('Error fetching notifications:', status, error);
            }
        });
    }

    function getNotificationImageType(imageType, isUpcoming, isPastCheckout, isTomorrow) {
        if (imageType === 'confirmed') {
            return 'confirmed';
        } else if ((imageType === 'reminder' && isTomorrow) || (isUpcoming && !isPastCheckout)) {
            return 'reminder';
        } else if (imageType === 'rate' && isPastCheckout) {
            return 'rate';
        } else if (imageType === 'cancelled') {
            return 'cancelled';
        }
    }
    

    function renderNotifications(notifications) {
        window.redirectToDashboard = function (tab, notificationId, isRead, notificationType, serviceType) {
            $(document).ready(function () {
                const markAsRead = function () {
                    $.ajax({
                        url: 'update_is_read_user.php',
                        method: 'POST',
                        data: {
                            id: notificationId,
                            type: notificationType,
                            reservation_type: serviceType
                        },
                        success: function (response) {
                            $(`#notification-${notificationId}`).data('is-read', 1);
                            $(`#notification-${notificationId} .unread-dot`).hide();
                            window.location.href = 'guest_dashboard.php?' + $.param({ tab: tab });
                        },
                        error: function (error) {
                            console.error('Error updating is_read_user:', error);
                        }
                    });
                };
                if (isRead === 0 || isRead === 1) {
                    markAsRead();
                }
            });
        }
        let lastTimePeriod = null;
        let hasNotifications = false;

        const notificationList = $('#notificationList');

        notificationList.empty();

        notifications.forEach(notification => {
            const notificationType = notification.type + 's';
            const formattedTimestamp = moment(notification.timestamp).format('h:mm A');
            const checkInDate = moment(notification.book_date, 'MMMM D YYYY').format('YYYY-MM-DD');
            const checkOutDate = notification.check_out_date ? moment(notification.check_out_date, 'MMMM D YYYY') : null;
            const timeDifference = moment().diff(moment(notification.timestamp), 'days');
            const isTodayOrYesterday = timeDifference === 0 && (moment().isSame(checkInDate, 'day') || moment().subtract(1, 'days').isSame(checkInDate, 'day'));
            let imageType;


            if (selectedType !== 'all' && selectedType !== notificationType || (isTodayOrYesterday && notification.status === 'cancelled' && moment().isAfter(checkInDate))) {
                return;
            }

            let timePeriod;
            if (timeDifference === 0) {
                timePeriod = 'Today';
            } else if (timeDifference === 1) {
                timePeriod = 'Yesterday';
            } else if (timeDifference === 2) {
                timePeriod = 'Two days ago';
            } else if (timeDifference === 3) {
                timePeriod = 'Three days ago';
            } else {
                timePeriod = moment(notification.timestamp).format('MMMM D, YYYY');
            }

            if (timePeriod !== lastTimePeriod) {
                lastTimePeriod = timePeriod;
                const timePeriodHTML = `<span class="time-period">${timePeriod}</span>`;
                notificationList.append(timePeriodHTML);
            }
            if (notification.status === 'confirmed') {
                if (notification.type === 'appointment') {
                    if (isUpcoming(notification) || isTomorrow(notification)) {
                        imageType = 'reminder';
                    } else {
                        imageType = 'confirmed';
                    }
                } else {
                    if (isUpcoming(notification) || isTomorrow(notification)) {
                        imageType = 'reminder';
                    } else if (isPastCheckout(notification)) {
                        imageType = 'rate';
                    } else {
                        imageType = 'confirmed';
                    }
                }
            } else if (notification.status === 'cancelled' && !moment().isAfter(checkInDate)) {
                imageType = 'cancelled';
            }


            const serviceType = (notification.type === 'appointment') ? '' : notification.reservation_type;

            let notificationHTML = `
                <li class="notif-details" data-notification-type="${notificationType}" data-is-read="${notification.is_read_user}" id="notification-${notification.id}" onclick="redirectToDashboard('${notification.type}', ${notification.id}, ${notification.is_read_user}, '${notificationType}', '${serviceType}')"">
                    <div class="notif-left-side">
                        <img src="../images/ICON-${getNotificationImageType(imageType, isUpcoming(notification), isPastCheckout(notification), isTomorrow(notification))}.png">
                        <p class="notif-about">
                            <span class="notifier-topic">${getNotifierTopic(notification)}</span>
                            ${getNotificationMessage(notification, imageType, serviceType)}
                        </p>
                    </div>
                    <div class="notif-center">
                        <span class="timestamp">${formattedTimestamp}</span>
                    </div>
                    <span class="unread-dot" style="display: ${notification.is_read_user === 0 ? 'inline-block' : 'none'}"></span>
                </li>
            `;
            notificationList.append(notificationHTML);
            hasNotifications = true;
        });

        if (!hasNotifications) {
            $('.no-notifications-message').show();
        } else {
            $('.no-notifications-message').hide();
        }
    }

    function getNotifierTopic(notification) {
        if (notification.type === 'appointment') {
            return `Appointment ${ucfirst(notification.status)}`;
        } else {
            if (isUpcoming(notification) || isTomorrow(notification)) {
                return ucfirst(notification.type) + ' Reminder';
            } else if (isPastCheckout(notification)) {
                return 'How was your stay?';
            } else {
                return ucfirst(notification.type) + ' ' + ucfirst(notification.status);
            }
        }
    }

    function getNotificationMessage(notification, imageType, serviceType) {
        const checkInDate = moment(notification.book_date, 'MMMM D YYYY').format('YYYY-MM-DD');
        const notificationType = notification.type
        const checkOutDate = notification.check_out_date ? moment(notification.check_out_date, 'MMMM D YYYY') : null;

        const isUpcoming = moment(checkInDate).isAfter(moment()) && moment(checkInDate).isSameOrBefore(moment().add(2, 'days'));
        const isTomorrow = moment(checkInDate).isAfter(moment()) && moment(checkInDate).isSameOrBefore(moment().add(1, 'day'));
        const isPastCheckout = checkOutDate !== null && moment().isAfter(checkOutDate);

        if (isPastCheckout) {
            return 'Tell us what you think of our service!';
        } else if (isTomorrow) {
            return `Your booked ${ucfirst(serviceType)} ${ucfirst(notificationType)} is tomorrow`;
        } else if (isUpcoming) {
            if (notification.type === 'appointment') {
                return `Appointment ${ucfirst(imageType)}`;
            } else {
                return `Your booked ${ucfirst(serviceType)} ${ucfirst(notificationType)} will be in 2 days`;
            }
        } else {
            if (notification.type === 'reservation') {
                return `Your reserved ${ucfirst(serviceType)} has been ${imageType}`;
            } else {
                return `Your booked ${ucfirst(notificationType)} has been ${imageType}`;
            }

        }
    }




    function ucfirst(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }

    function isUpcoming(notification) {
        const checkInDate = moment(notification.book_date, 'MMMM D YYYY').format('YYYY-MM-DD');
        const twoDaysBeforeCheckInDate = moment().add(2, 'days');
        return checkInDate > moment() && checkInDate <= twoDaysBeforeCheckInDate;
    }


    function isTomorrow(notification) {
        const checkInDate = moment(notification.book_date, 'MMMM D YYYY').format('YYYY-MM-DD');
        const oneDayBeforeCheckInDate = moment().add(1, 'day');
        return checkInDate > moment() && checkInDate <= oneDayBeforeCheckInDate;
    }

    function isPastCheckout(notification) {
        const checkOutDate = notification.check_out_date ? moment(notification.check_out_date, 'MMMM D YYYY') : null;
        return checkOutDate !== null && moment().isAfter(checkOutDate) && notification.type !== 'appointment';
    }


    function isPast(notification) {
        const checkInDate = moment(notification.book_date, 'MMMM D YYYY').format('YYYY-MM-DD');
        const threeDaysBeforeCheckInDate = moment().add(3, 'days').format('YYYY-MM-DD');
        return moment(checkInDate) <= moment(threeDaysBeforeCheckInDate);
    }




    notifBtn.click(function () {
        if (notifBar.css('display') === 'none') {
            notifBar.css('display', 'flex');
            setupInitialState();
            updateNotifications(selectedType);
        } else {
            notifBar.css('display', 'none');
        }
    });

    notifNames.click(function () {
        notifNames.removeClass('active');
        $(this).addClass('active');
        selectedType = $(this).attr('data-type');

        updateNotifications(selectedType);
        updateNotificationCount(notifications);
    });

    notifNames.filter('.active').click();

    if ($('.notification-list').children().length === 0) {
        $('.no-notifications-message').show();
    }

    function setupInitialState() {
        const activeElement = notifNames.filter('.active');
        const initialWidth = activeElement.width();
        const initialTranslateX = calculateTranslateX(activeElement);

        notifSlider.width(`${initialWidth}px`);
        notifSlider.css('transform', `translateX(${initialTranslateX}px) scaleX(1)`);

        notifNames.filter('[data-type="all"]').click();
    }

    notifNames.each(function (index) {
        $(this).click(function () {
            notifNames.removeClass('active');
            $(this).addClass('active');
            const newWidth = $(this).width();
            const newTranslateX = calculateTranslateX($(this));

            notifSlider.width(`${newWidth}px`);
            notifSlider.css('transform', `translateX(${newTranslateX}px) scaleX(1)`);

            updateNotifications(selectedType);
            updateNotificationCount(notifications); // Update count when a tab is clicked
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
});
