document.addEventListener('DOMContentLoaded', function() {
    const schedButton = document.getElementById('addButton');
    const modalAddSched = document.getElementById('addSchedModal');
    const closeButton = document.getElementById('closeBTN');

    const addButton = document.getElementById('appointAdd');
    const modalAppointAdd = document.getElementById('appointment_sched');
    const closeAppModal = document.getElementById('cancelBtn');

    function openAddSchedModal() {
        modalAddSched.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        modalAddSched.style.position = 'fixed';
        console.log('AddSchedModal opened');
    }

    function closeAddSchedModal() {
        modalAddSched.style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    function openAppointAddModal() {
        if (modalAddSched.style.display === 'flex') {
            closeAddSchedModal();
        }
        modalAppointAdd.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        modalAppointAdd.style.position = 'fixed';
        console.log('Appointment Add Modal opened');
    }

    function closeAppointAddModal() {
        modalAppointAdd.style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    schedButton.addEventListener('click', openAddSchedModal);
    closeButton.addEventListener('click', closeAddSchedModal);

    addButton.addEventListener('click', openAppointAddModal);
    closeAppModal.addEventListener('click', closeAppointAddModal);
});