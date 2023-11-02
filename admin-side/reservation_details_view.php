<!-- sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<body>
    <div class="reservation-details-view">
        <div class="reservation-details-modal">
            <i class="fa-solid fa-xmark close-button-details"></i>
            <div class="reservation-details-content">
                <div class="reservation-details-content-header">
                    <h5 class="reservation-details-title">Reservation details</h5>
                    <span class="reservation-stat">
                        <i class="fa-solid fa-clock pending-icon" id="status-icon"></i>
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
                        <span class="detail-title">Contact info: <br></span>
                        <span id="guest-contact-details"></span>
                    </span>
                    <span class="guest-date-details">
                        <span class="detail-title">Check in: <br></span>
                        <span id="guest-check-in"></span>
                    </span>
                    <span class="guest-date-details">
                        <span class="detail-title">Check Out: <br></span>
                        <span id="guest-check-out"></span>
                    </span>
                </div>
                <div class="section-two">
                    <span class="guest-date-details">
                        <span class="detail-title">Price: <br>₱ </span>
                        <span id="guest-price"></span>
                    </span>
                    <span class="guest-date-details">
                        <span class="detail-title">Payment Method: <br></span>
                        <span id="guest-payment-method"></span>
                    </span>
                    <span class="guest-date-details">
                        <span class="detail-title">Proof of Payment: <br></span>
                        <span id="guest-proof-of-payment">
                            <i class="fa-regular fa-image"></i>
                            <a href="" class="payment-proof">View proof of payment</a>
                        </span>
                    </span>
                </div>

                <div class="option-note">
                    <span class="material-symbols-outlined info-icon">
                        info
                    </span>
                    <p class="note">Please note to check the reservation details correctly before confirming or cancelling</p>
                </div>
                <div class="option-buttons">
                    <button type="button" class="btn-custom disabled" id="cancel-button" data-reservation-id="" data-reservation-type="">Cancel</button>
                    <button type="button" class="btn-custom disabled" id="confirm-button" data-reservation-id="" data-reservation-type="">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</body>