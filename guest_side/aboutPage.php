<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./css/guest-style.css">
    <title>About</title>
</head>

<body>
    <?php include "guest_navbar.php";?>
    <div class="about-content my-5">
        <div class="about-trinitas container">
            <h1 class="text-center" id="content-title">About Us<i class="fa-solid fa-user-group about-icon" id="about-icon"></i></h1>
            <p class="text-center about-sub-title" id="description">Learn more about the Trinitas Home for Contemplation Management</p>
        </div>
    </div>
    <div class="trinitas-about justify-content-center">
        <div class="card mb-3 m-0">
            <div class="row g-0">
                <div class="col">
                    <img src="../images/main.jpg" class="img-fluid img-trinitas">
                </div>
                <div class="col">
                    <div class="card-body">
                        <h5 class="card-title">About Trinitas</h5>
                        <p class="card-text">Trinitas Home for Contemplation is a special ministry owned and managed by the Society of Our Lady of the Most Holy Trinity (SOLT) organization. The upholstery was built in 2015, located at Bonga, Bacacay, Albay.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Admin Profile -->
    <div class="profile-cards-container">
        <div class="profile-card">
            <div class="profile-picture">
                <img src="../images/user.png" alt="Profile Picture">
            </div>
            <div class="profile-details">
                <h1 id="profile-name">Sr. Mary Pauline Azures</h1>
                <h6>Manager of Retreat Services</h6>
                <span>
                    <i class="fa-solid fa-envelope"></i>
                    <a href="mailto: numinum1128@gmail.com">
                        <p>manager@gmail.com</p>
                    </a>
                </span>
                <span>
                    <i class="fa-solid fa-mobile-screen"></i>
                    <a href="tel:+639123456789">
                        <p>+639123456789</p>
                    </a>
                </span>
                <span>
                    <a href="https://www.facebook.com/pinky.azures">
                        <i class="fa-brands fa-facebook "></i>
                        <p>Pauline Azures</p>
                    </a>
                </span>
            </div>
        </div>
        <div class="profile-card">
            <div class="profile-picture">
                <img src="../images/user.png" alt="Profile Picture">
            </div>
            <div class="profile-details">
                <h1 id="profile-name">Sr. Ma. Faustina Resari</h1>
                <h6>Assistant Manager</h6>
                <span>
                    <i class="fa-solid fa-envelope"></i>
                    <a href="mailto: asstmanager@gmail.com">
                        <p>asstmanager@gmail.com</p>
                    </a>
                </span>
                <span>
                    <i class="fa-solid fa-mobile-screen"></i>
                    <a href="tel:+639123456789">
                        <p>+639123456789</p>
                    </a>
                </span>
                <span>
                    <a href="https://www.facebook.com/manianita.carolyn">
                        <i class="fa-brands fa-facebook "></i>
                        <p>Faustina Resari</p>
                    </a>
                </span>
            </div>
        </div>
    </div>

    <!-- Vision -->
    <div class="vision my-5">
        <h1 class="text-center" id="content-title">Our Vision</h1>
        <p id="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla in sem ac ligula tempus fringilla. Duis fringilla elit eu urna fringilla, a tempor nunc molestie. Donec dapibus sapien id elementum tempus.</p>
    </div>
    </div>
    <!-- Mission -->
    <div class="mission my-5">
        <h1 class="text-center" id="content-title">Our Mission</h1>
        <p id="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla in sem ac ligula tempus fringilla. Duis fringilla elit eu urna fringilla, a tempor nunc molestie. Donec dapibus sapien id elementum tempus.</p>
    </div>
    </div>
    <!-- Contact Us -->
    <div class="contact-us my-5">
        <h1 class="text-center" id="content-title">Contact Us </h1>
        <p id="description">If you want to reach out or have any inquiries, feel free to message us here. We are happy to help you.</p>

        <div class="message-container">
            <div class="contact_us_content">
                <div class="message-box">
                    <div class="topic-text">Send us a message</div>
                    <form action="#" method="POST">
                        <div class="input-box">
                            <input type="text" placeholder="Enter your name">
                        </div>
                        <div class="input-box">
                            <input type="text" placeholder="Enter your email">
                        </div>
                        <div class="input-box message">
                            <textarea id="message" name="message" placeholder="Enter your message here..."></textarea>

                        </div>
                        <div class="button">
                            <input type="button" value="Send Now">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer-section">
            <div class="quick-links">
                <ul>
                    <h6>Quick Links</h6>
                    <hr>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="discover.html">Discover</a></li>
                    <li><a href="announcements.html">Announcements</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="login.html">Login</a></li>
                    <li><a href="signup.html">Signup</a></li>
                </ul>
            </div>
            <div class="contact-info">
                <ul>
                    <h6>Contact Info</h6>
                    <hr>
                    <li><a href="#">Message us</a></li>
                    <li>
                        <p>0912434335</p>
                    </li>
                    <li>
                        <p>trinitas@gmail.com</p>
                    </li>
                </ul>
            </div>
            <div class="follow-us">
                <ul>
                    <h6>Follow Us</h6>
                    <hr>
                    <li><a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                            </svg></a></li>
                </ul>
            </div>
            <div class="address">
                <ul>
                    <h6>Address</h6>
                    <hr>
                    <li>
                        <p>Bonga, Bacacay, Albay, Philippines</p>
                    </li>
                </ul>
            </div>
        </div>
        <p class="copyright">Copyright &copy
            <script>
                document.write(new Date().getFullYear())
            </script> Trinitas </br> All Rights Reserved
        </p>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>

    <script>
        // Select the necessary elements
        const navCheck = document.getElementById("nav-check");
        const profileSelect = document.querySelector(".profile-select");

        // Function to handle the visibility of the user dropdown on mobile view
        function handleProfileSelectVisibility() {
            if (window.innerWidth <= 1064) {
                if (navCheck.checked) {
                    profileSelect.style.visibility = "visible";
                } else {
                    profileSelect.style.visibility = "hidden";
                }
            } else {
                // Reset the visibility for desktop view
                profileSelect.style.visibility = "visible";
            }
        }

        // Add event listener to the checkbox
        navCheck.addEventListener("change", handleProfileSelectVisibility);

        // Add event listener for window resize
        window.addEventListener("resize", handleProfileSelectVisibility);

        // Initial visibility check
        handleProfileSelectVisibility();

        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
    </script>
</body>