    <div class="modal-section" id="addSchedModal">
        <div class="modal-container">
            <div class="sched-modal-content">
                <div class="close-btn">
                    <i class="fa-solid fa-xmark" id="closeBTN"></i>
                </div>
                <i class="fa-solid fa-calendar-days"></i>
                <span>What schedule would like to create?</span>
                <div class="buttons-section">
                    <a href="#" class="btn-reserve">Reservation</a>
                    <a class="btn-appoint" id="appointAdd">Appointment</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const schedButton = document.getElementById('addButton');
            const modalAddSched = document.getElementById('addSchedModal');
            const closeButton = document.getElementById('closeBTN');

            function openModal() {
                modalAddSched.style.display = 'flex';
                document.body.style.overflow = 'hidden';
                modalAddSched.style.position = 'fixed';
                console.log('Modal opened');
            }

            function closeModal() {
                modalAddSched.style.display = 'none';
                document.body.style.overflow = 'auto';
            }

            schedButton.addEventListener('click', openModal);
            closeButton.addEventListener('click', closeModal);
        });
    </script>