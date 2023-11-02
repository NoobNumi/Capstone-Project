<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon.ico">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./css/guest-style.css">
</head>
<style>
</style>
<body>

    <!--SERVICES CARD CONTAINERS BEGIN HERE-->

    <section class="reservation-modals" id="reserveModal">
        <div class="services-container">
            <span class="material-symbols-rounded reserve-close" id="closeReserveModal" onclick="closeReModal()">
                close
            </span>
            <a href="#" class="reserve-link-2-form">
                <div class="reservation recollection">
                    <img src="../images/recollection_img.jpg" class="card-image">
                    <h3 class="service-card-title">Recollection</h3>
                    <ul class="service-des-main">
                        <li class="service-des-container">
                            <span class="material-symbols-rounded logo-type">
                                person
                            </span>
                            <p class="logo-type-name">Per Head</p>
                        </li>
                        <li class="service-des-container">
                            <span class="material-symbols-rounded logo-type">
                                dining
                            </span>
                            <p class="logo-type-name">With Catering <span class="amenity">(Optional)</span></p>
                        </li>
                        <li class="service-des-container">
                            <i class="fa-solid fa-peso-sign"></i>
                            <p class="logo-type-name">900<span class="amenity">Per Head</span></p>
                        </li>
                        <li class="service-des-container ratings">
                            <span class="material-symbols-rounded star-filled">star</span>
                            <span class="material-symbols-rounded star-filled">star</span>
                            <span class="material-symbols-rounded star-filled">star</span>
                            <span class="material-symbols-rounded star-filled">star</span>
                            <span class="material-symbols-rounded">star_half</span>
                            <p class="logo-type-name">4.9</p>
                        </li>
                    </ul>
                </div>
            </a>
            <a href="../guest_side/reception_page.php" class="reserve-link-2-form">
                <div class="reservation reception">
                    <img src="../images/img17.jpg"
                        class="card-image">
                    <h3 class="service-card-title">Reception</h3>
                    <ul class="service-des-main">
                        <li class="service-des-container">
                            <span class="material-symbols-rounded logo-type">
                                group
                            </span>
                            <p class="logo-type-name">Per Group</p>
                        </li>
                        <li class="service-des-container">
                            <span class="material-symbols-rounded logo-type">
                                dining
                            </span>
                            <p class="logo-type-name">With Catering <span class="amenity">(Optional)</span></p>
                        </li>
                        <li class="service-des-container">
                            <i class="fa-solid fa-peso-sign"></i>
                            <p class="logo-type-name">8,000<span class="amenity">Base Price</span></p>
                        </li>
                        <li class="service-des-container ratings">
                            <span class="material-symbols-rounded star-filled">star</span>
                            <span class="material-symbols-rounded star-filled">star</span>
                            <span class="material-symbols-rounded star-filled">star</span>
                            <span class="material-symbols-rounded star-filled">star</span>
                            <span class="material-symbols-rounded">star_half</span>
                            <p class="logo-type-name">4.9</p>
                        </li>
                    </ul>
                </div>
            </a>

            <a href="#" class="reserve-link-2-form" data-card-name="Training">
                <div class="reservation training">
                    <img src="/images/trainings_img.jpg"
                        class="card-image">
                    <h3 class="service-card-title">Training</h3>
                    <ul class="service-des-main">
                        <li class="service-des-container">
                            <span class="material-symbols-rounded logo-type">
                                group
                            </span>
                            <p class="logo-type-name">Per Group</p>
                        </li>
                        <li class="service-des-container">
                            <span class="material-symbols-rounded logo-type">
                                cabin
                            </span>
                            <p class="logo-type-name">Venue Only</p>
                        </li>
                        <li class="service-des-container">
                            <span class="material-symbols-rounded logo-type">
                                dining
                            </span>
                            <p class="logo-type-name">With Catering <span class="amenity">(Included)</span></p>
                        </li>
                        <li class="service-des-container">
                            <i class="fa-solid fa-peso-sign"></i>
                            <p class="logo-type-name">400<span class="amenity">Base Price per head</span></p>
                        </li>
                        <li class="service-des-container ratings">
                            <span class="material-symbols-rounded star-filled">star</span>
                            <span class="material-symbols-rounded star-filled">star</span>
                            <span class="material-symbols-rounded star-filled">star</span>
                            <span class="material-symbols-rounded star-filled">star</span>
                            <span class="material-symbols-rounded">star_half</span>
                            <p class="logo-type-name">4.9</p>
                        </li>
                    </ul>
                </div>
            </a>

            <a href="seminar_page.php" class="reserve-link-2-form">
                <div class="reservation seminar">
                    <img src="/images/trinitasPic3.jpg"
                        class="card-image">
                    <h3 class="service-card-title">Seminar</h3>
                    <ul class="service-des-main">
                        <li class="service-des-container">
                            <span class="material-symbols-rounded logo-type">
                                person
                            </span>
                            <p class="logo-type-name">Per Head</p>
                        </li>
                        <li class="service-des-container">
                            <span class="material-symbols-rounded logo-type">
                                dining
                            </span>
                            <p class="logo-type-name">With Catering <span class="amenity">(Optional)</span></p>
                        </li>
                        <li class="service-des-container">
                            <i class="fa-solid fa-peso-sign"></i>
                            <p class="logo-type-name">400<span class="amenity">Base Price per head</span></p>
                        </li>
                        <li class="service-des-container ratings">
                            <span class="material-symbols-rounded star-filled">star</span>
                            <span class="material-symbols-rounded star-filled">star</span>
                            <span class="material-symbols-rounded star-filled">star</span>
                            <span class="material-symbols-rounded star-filled">star</span>
                            <span class="material-symbols-rounded">star_half</span>
                            <p class="logo-type-name">4.9</p>
                        </li>
                    </ul>
                </div>
            </a>
            
            <a href="#" class="reserve-link-2-form">
                <div class="reservation retreat">
                    <img src="../images/trinitasPic2.jpg"
                        class="card-image">
                    <h3 class="service-card-title">Retreat</h3>
                    <ul class="service-des-main">
                        <li class="service-des-container">
                            <span class="material-symbols-rounded logo-type">
                                person
                            </span>
                            <p class="logo-type-name">Per Head</p>
                        </li>
                        <li class="service-des-container">
                            <span class="material-symbols-rounded logo-type">
                                cottage
                            </span>
                            <p class="logo-type-name">Per Dorm</p>
                        </li>
                        <li class="service-des-container">
                            <span class="material-symbols-rounded logo-type">
                                dining
                            </span>
                            <p class="logo-type-name">With Catering <span class="amenity">(Optional)</span></p>
                        </li>
                        <li class="service-des-container">
                            <i class="fa-solid fa-peso-sign"></i>
                            <p class="logo-type-name">900<span class="amenity">Base Price per head</span></p>
                        </li>
                        <li class="service-des-container ratings">
                            <span class="material-symbols-rounded star-filled">star</span>
                            <span class="material-symbols-rounded star-filled">star</span>
                            <span class="material-symbols-rounded star-filled">star</span>
                            <span class="material-symbols-rounded star-filled">star</span>
                            <span class="material-symbols-rounded">star_half</span>
                            <p class="logo-type-name">4.9</p>
                        </li>
                    </ul>
                </div>
            </a>
            
        </div>
    </section>
    <!--SERVICES CARD CONTAINER ENDS HERE-->

    <script>
        function closeReModal() {
            var reservemodal = document.getElementById('reserveModal');
            reservemodal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        function show_reserve_modal() {
            var reservemodal = document.getElementById('reserveModal');
            reservemodal.style.display = 'block';
            if (window.innerWidth < 650) {
                document.body.style.overflow = 'hidden';
                document.querySelector('.services-container').style.overflow = 'none';
            } else {
                document.body.style.overflow = 'hidden';
            }
        }
    </script>


</body>

</html>