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
                    <div class="user-details">
                        <img src="" class="guest-pfp">
                        <div class="name-detail">
                            <span class="detail-title">Name:</span>
                            <span id="guest-name-details"></span>
                        </div>
                    </div>
                    <div class="reserve-inf">
                        <span class="detail-title">Transaction #:<span class="transact-num"></span></span>
                        <span class="detail-title">Reservation Type: <span class="reserve-type-text"></span></span>
                    </div>
                </div>
                <div class="section-two">
                    <span class="guest-date-details">
                        <span class="detail-title">Contact info: <br></span>
                        <span id="guest-contact-details"></span>
                    </span>
                    <span class="guest-date-details">
                        <span class="detail-title">Package type: <br></span>
                        <span id="guest-package-type"></span>
                    </span>
                    <span class="guest-date-details">
                        <span class="detail-title">Guest number: <br></span>
                        <span id="guest-number"></span>
                    </span>
                    <span class="guest-date-details">
                        <span class="detail-title">Check in: <br></span>
                        <span id="guest-check-in"></span>
                    </span>
                    <span class="guest-date-details">
                        <span class="detail-title">Check Out: <br></span>
                        <span id="guest-check-out"></span>
                    </span>
                    <span class="guest-date-details">
                        <span class="detail-title">Total: <br></span>
                        <span id="guest-price"></span>
                    </span>
                    <span class="guest-date-details">
                        <span class="detail-title">Payment Method: <br></span>
                        <span id="guest-payment-method"></span>
                    </span>
                    <span class="guest-date-details">
                        <span class="detail-title" id="proofPaymentTitle">Proof of Payment: <br></span>
                        <span id="guest-proof-of-payment">
                            <i class="fa-regular fa-image"></i>
                            <a href="" class="payment-proof">View proof of payment</a>
                        </span>
                    </span>
                </div>
                <div class="meal-view-customer">
                <span class="detail-title">Meals <span class="in-order">(In this order: Breakfast, Lunch, Dinner, Drinks, Dessert)</span><br></span>
                    <div class="chips-integration">
                        <div class="chip-card" id="meal1"></div>
                        <div class="chip-card" id="meal2"></div>
                        <div class="chip-card" id="meal3"></div>
                        <div class="chip-card" id="dessert"></div>
                        <div class="chip-card" id="drinks"></div>
                    </div>
                </div>
                <div class="option-note" id="noteModal">
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