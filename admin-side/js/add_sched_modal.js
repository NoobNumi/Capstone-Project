$(document).ready(function() {
    const availableCalendar = $('.available-reservation-sched-selector');
    const addAvailableReserveBtn = $('#addAvailableReserveBtn');
    const cancelAddAvailableReservDates = $('#cancelBtnAvailableReserve')

    function openAddReserveSchedCalendar(){
        availableCalendar.css('display', 'flex');
        $('body').css('overflow', 'hidden');
    }  
    
    addAvailableReserveBtn.on('click', openAddReserveSchedCalendar);

    const schedButton = $('#addButton');
    const modalAddSched = $('#addSchedModal');
    const closeButton = $('#closeBTN');

    const addButton = $('#appointAdd');
    const modalAppointAdd = $('#appointment_sched');
    const closeAppModal = $('#cancelBtn');
    
    const reserveButton = $('#reserveAdd');
    const modalReserveAdd = $('#reservation_sched');
    const closeReserveModal = $('#cancelBtnReserve');

    function openAddSchedModal() {
        modalAddSched.css('display', 'flex');
        $('body').css('overflow', 'hidden');
        modalAddSched.css('position', 'fixed');
    }

    function closeAddSchedModal() {
        modalAddSched.css('display', 'none');
        $('body').css('overflow', 'auto');
    }

    function openAppointAddModal() {
        if (modalAddSched.css('display') === 'flex') {
            closeAddSchedModal();
        }
        modalAppointAdd.css('display', 'flex');
        $('body').css('overflow', 'hidden');
        modalAppointAdd.css('position', 'fixed');
    }
    function openReserveAddModal() {
        if (modalReserveAdd.css('display') === 'flex') {
            closeAddSchedModal();
        }
        modalReserveAdd.css('display', 'flex');
        $('body').css('overflow', 'hidden');
        modalReserveAdd.css('position', 'fixed');
    }

    function closeAppointAddModal() {
        modalAppointAdd.css('display', 'none');
        $('body').css('overflow-y', 'auto');
    }
    function closeReserveAddModal() {
        modalReserveAdd.css('display', 'none');
        $('body').css('overflow-y', 'auto');
    }

    function closeAddAvailableReserveModal(){
        availableCalendar.css('display', 'none');
        $('body').css('overflow-y', 'auto');
    }

    schedButton.on('click', openAddSchedModal);
    closeButton.on('click', closeAddSchedModal);

    addButton.on('click', openAppointAddModal);
    closeAppModal.on('click', closeAppointAddModal);

    reserveButton.on('click', openReserveAddModal);
    closeReserveModal.on('click', closeReserveAddModal);

    cancelAddAvailableReservDates.on('click', closeAddAvailableReserveModal)

});
