<!-- sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="appointment-details-view">
    <div class="appointment-details-modal">
        <i class="fa-solid fa-xmark close-button-details"></i>
        <div class="appointment-details-content">
            <div class="appointment-details-content-header">
                <h5 class="appoint-details-title">Appointment details</h5>
                <span class="appointment-stat">
                    <i class="fa-solid fa-clock" id="status-icon"></i>
                </span>
            </div>
            <div class="section-one">
                <img src="/images/guest.png" class="guest-pfp">
                <div class="name-detail">
                    <span class="detail-title">Name:</span>
                    <span id="guest-name-details"></span>
                </div>
            </div>
            <div class="section-two">
                <span class="guest-date-details">
                    <span class="detail-title">Date: <br></span>
                    <span id="guest-date-details"></span>
                </span>
                <span class="guest-time-details">
                    <span class="detail-title">Time: <br></span>
                    <span id="guest-time-details"></span>
                </span>
            </div>
            <div class="section-three">
                <span class="detail-title">Agenda:</span>
                <p id="guest-agenda-details"></p>
            </div>
            <div class="option-note">
                <span class="material-symbols-outlined info-icon">
                    info
                </span>
                <p class="note">Please note to check the appointment details correctly before confirming or cancelling</p>
            </div>
            <div class="option-buttons">
                <a class="cancel btn-custom disabled-cancel" data-appointment-id="">Cancel</a>
                <a class="confirm btn-custom disabled-confirm" data-appointment-id="">Confirm</a>
            </div>
        </div>
    </div>
</div>