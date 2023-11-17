<div class="logout-modal" id="logout-modal">
        <div class="logout-modal-main">
            <div class="logout-container">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span class="logout-q">
                    Are you sure you want to logout?
                </span>
                <div class="logout-buttons">
                    <a href="logout.php"><button class="btn-logout" id="btn_confirm">
                        Confirm
                    </button></a>
                    <button class="btn-logout" id="btn_cancel" onclick="closeModal()">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
</div>
<script>
    
    const logoutSpan = document.getElementById('logout_click');
    const modal = document.getElementById('logout-modal');
    const body = document.body;
    const cancelButton = document.getElementById('btn_cancel');

    function openModal() {
        modal.style.display = 'block';
        body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.style.display = 'none';
        body.style.overflow = 'auto';
    }

    logoutSpan.addEventListener('click', openModal);
    confirmButton.addEventListener('click', () => {
        closeModal();
    });
    cancelButton.addEventListener('click', closeModal);
</script>

