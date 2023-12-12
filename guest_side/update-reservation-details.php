<body>
    <section class="update-reservation">
        <form action="change-reservation-details.php" method="post" class="update-section">
            <header>
                <h6>Update Reservations</h6>
                <i class="fa-solid fa-xmark" id="closeReservationUpdate"></i>
            </header>
            <div class="text-inputs">
                <div class="input-capsule" style="width: 100%">
                    <span class="input-title-name">Name</span>
                    <div class="inputs-flex">
                        <input type="text" name="first_name" id="userNameReservation">
                    </div>
                </div>
                <div class="input-capsule">
                    <span class="input-title-name">Contact Number</span>
                    <div class="inputs-flex">
                        <input type="text" name="contact_no" id="userContactReservation">
                    </div>
                </div>
            </div>
            <!-- displaying meals FOR UPDATING-->
            
            <span class="input-title-name" id="updateMealsTitle">Update Meals</span>
            <div class="selection">
                <div class="chip-selection">
                    <div class="chip-category">
                    </div>
                </div>
            </div>

            <!-- displaying meals for VIEWING -->
            <div class="view-meals">
                <div class="meal-info" id="breakfast">
                   
                </div>
                <hr>
                <div class="meal-info" id="lunch">
                    
                </div>
                <hr>
                <div class="meal-info" id="dinner">
                    
                </div>
                <hr>
                <div class="meal-info" id="drinks">
                    
                </div>
                <hr>
                <div class="meal-info" id="dessert">
                    
                </div>
                <hr>
            </div>
            <input type="hidden" name="reservation_id" id="reservationIdInput" value="">
            <a href="#" class="btn btn-update w-100" id="updateService" type="submit">Save</a>
        </form>
    </section>
</body>

</html>