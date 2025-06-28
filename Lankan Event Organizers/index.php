<?php
// Start the session
session_start();

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_name']); // Assume 'username' is stored during login
$isLoggedId = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lankan Event Organizers</title>
    <link rel="stylesheet" href="index.css" />
    <link rel="icon" href="images/Logo.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>

    <nav class="navbar">
        <div class="logo">Lankan <span>Event Organizers</span></div>
        <ul class="nav-links">
            <li><a href="#index">Home</a></li>
            <li><a href="#services">Services</a></li>
            <?php if ($isLoggedIn): ?>
            <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
            <li><a href="login.php">Login</a></li>
            <?php endif; ?>
            <li><a href="#about">About</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>

    <section class="hero">
        <div class="hero-content">
            <h1>Make Your Event Memorable</h1>
            <p>One-stop solution for all your event needs in Sri Lanka</p>
            <button onclick="openModal()" class="btn">Register Now</button>
        </div>

        <div id="roleModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h3>HELLO</h3>
                <p>
                    We are pleased to present you our registration options.<br>
                    Please select your role to proceed with registration.
                </p>
                <div class="btn-group">
                    <button class="btn-provider" onclick="redirectTo('provider_register.php')">Service Provider</button>
                    <button class="btn-user" onclick="redirectTo('user_register.php')">User</button>
                </div>
                <div id="errorMsg" class="error" style="display: none;">Please select a role to continue.</div>
            </div>
        </div>
    </section>

    <section class="intro-services" style="background-color: #e6f2ff; padding: 3rem 1.5rem; text-align: center; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        <h2 style="color: #3399ff; font-size: 2rem; margin-bottom: 1rem;">What We Offer</h2>
        <p style="color: #003d66; font-size: 1.1rem; max-width: 800px; margin: 0 auto; line-height: 1.6;">
            At <strong>Lankan Event Organizers</strong>, we bring your dream events to life! Whether it's a wedding, party, corporate event, or celebration,
            we offer a wide range of trusted service providers and ready-made packages to suit every need and budget. From stunning venues and catering to DJs and makeup artists-we handle it all, so you don't have to.
        </p>
    </section>

    <section class="services" id="services">
        <h2>Our Services</h2>
        <div class="section-wrapper">
            <div class="service-list">
                <div class="service-card"><a href="chef.php">👨‍🍳 Chefs</a></div>
                <div class="service-card"><a href="dj.php">🎧 DJs</a></div>
                <div class="service-card"><a href="decoration.php">🎉 Decorators</a></div>
                <div class="service-card"><a href="photographers.php">📷 Photographers</a></div>
                <div class="service-card"><a href="Makeup_artists.php">💄 Makeup Artists</a></div>
                <div class="service-card"><a href="waiters.php">🧑‍🍽️ Waiters</a></div>
                <div class="service-card"><a href="cleaning_services.php">🧹 Cleaning Services</a></div>
                <div class="service-card"><a href="Transport.php">🚗 Transport</a></div>
                <div class="service-card"><a href="restaurants.php">🏨 Restaurants</a></div>
                <div class="service-card"><a href="mehendi.php">🌿 Mehandi Artists</a></div>
            </div>

            <div class="service-description">
                <h3>What We Offer</h3>
                <p>We provide a full range of wedding and event services: expert chefs, skilled DJs, elegant decorators, professional photographers, makeup artists, waiters, and cleaning crews. We also arrange transport, restaurants, and traditional mehendi artists.</p>

                <div class="more-about-services">
                    <h4>Why Choose Our Services?</h4>
                    <ul>
                        <li><strong>Customizable Options:</strong> Tailor every service to your unique vision, preferences, and traditions.</li>
                        <li><strong>Verified Professionals:</strong> Work with trusted chefs, decorators, artists, and staff with proven experience.</li>
                        <li><strong>One-Stop Solution:</strong> Avoid the hassle—book everything from food to transport in one place.</li>
                        <li><strong>Budget-Friendly Packages:</strong> Choose affordable bundles with premium-quality delivery.</li>
                        <li><strong>24/7 Support:</strong> We assist you at every step to ensure a smooth and successful event.</li>
                    </ul>
                </div>

                <div class="cta-wrapper">
                    <a href="login.php" class="cta-animated-button">
                        <span>Services</span>
                        <svg viewBox="0 0 46 16" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 8h42M38 4l5 4-5 4" stroke="currentColor" stroke-width="2" fill="none" fill-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <br />

        <h2>Packages</h2>
        <div class="section-wrapper">
            <div class="service-list package-links">
                <div class="service-card"><a href="ifthar.php">🌙 Ifthar Pack</a></div>
                <div class="service-card"><a href="wedding.php">💍 Wedding Pack</a></div>
                <div class="service-card"><a href="parties.php">🎈 Parties Pack</a></div>
                <div class="service-card"><a href="gtg.php">🤝 Get Together Pack</a></div>
                <div class="service-card"><a href="event.php">📝 Event Pack</a></div>
                <div class="service-card"><a href="djparties.php">🎶 DJ Parties Pack</a></div>
            </div>
            <div class="service-description">
                <h3>Tailored Packages</h3>
                <p>Choose from specialized event packages: Ifthar gatherings, wedding combos, lively DJ parties, and more. Each pack is curated to meet your theme, size, and budget. Click a package for more info and to start planning!</p>

                <div class="more-about-services">
                    <h4>Why Choose Our Packages?</h4>
                    <ul>
                        <li><strong>Budget-Friendly Packages:</strong> Choose affordable bundles with premium-quality delivery.</li>
                    </ul>
                </div>

                <div class="cta-wrapper">
                    <a href="login.php" class="cta-animated-button">
                        <span>Login or Register</span>
                        <svg viewBox="0 0 46 16" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 8h42M38 4l5 4-5 4" stroke="currentColor" stroke-width="2" fill="none" fill-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="about" id="about">
        <div class="about-container">
            <div class="about-text">
                <h2>About Us</h2>
                <p>
                    <strong>Lankan Event Organizers</strong> makes event planning effortless. We are your one-stop platform for organizing all kinds of events—parties, weddings, get-togethers, and more.
                </p>
                <p>
                    Coordinating with multiple vendors is time-consuming. We simplify that by connecting you to verified <strong>chefs</strong>, <strong>DJs</strong>, <strong>decorators</strong>, <strong>photographers</strong>, <strong>makeup artists</strong>, <strong>venues</strong>, and more!
                </p>
                <p>
                    Customers can browse by service, location, or package type (e.g., <strong>wedding</strong>, <strong>party</strong>, <strong>iftar</strong>), and book instantly after admin approval.
                </p>
                <p>
                    Service providers benefit from increased visibility and access to a growing digital marketplace tailored for Sri Lankan events.
                </p>
            </div>
            <div class="about-image">
                <img src="images/about.png" alt="About Icon" />
            </div>
        </div>
    </section>

    <section class="cta">
        <h2>Ready to plan your event?</h2>

        <?php if ($isLoggedIn): ?>
        <a href="booking.php" class="btn">Book Now</a>
        <?php else: ?>
        <a href="#" class="btn" onclick="alert('Please Login First'); window.location.href='login.php'; return false;">Book Now</a>
        <?php endif; ?>
    </section>

    <footer id="contact">
        <div class="footer-container">

            <div class="contact-info">
                <h3>Contact Us</h3>
                <p>
                    <strong>Address:</strong> 123 Event Street, Colombo, Sri Lanka<br />
                    <strong>Phone:</strong> +94 71 234 5678<br />
                    <strong>Email:</strong>
                    <a href="mailto:info@lankanevent.com">info@lankanevent.com</a>
                </p>
            </div>

            <div class="newsletter-signup">
                <h3>Lankan Event Organizers</h3>
                <p>Crafting unforgettable memories with elegance and creativity. Let us bring your dream event to life.</p>
            </div>
        </div>

        <div class="social-icons-vertical">
            <a href="https://facebook.com/lankanevent" target="_blank" class="social-icon" aria-label="Facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://twitter.com/lankanevent" target="_blank" class="social-icon" aria-label="Twitter">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="https://instagram.com/lankanevent" target="_blank" class="social-icon" aria-label="Instagram">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="https://youtube.com/lankanevent" target="_blank" class="social-icon" aria-label="YouTube">
                <i class="fab fa-youtube"></i>
            </a>
        </div>

        <div class="footer-copy">
            &copy; 2025 Lankan Event Organizers | All Rights Reserved.
        </div>
    </footer>

    <script>
        let modal = document.getElementById("roleModal");
        let errorMsg = document.getElementById("errorMsg");

        function openModal() {
            modal.style.display = "block";
            errorMsg.style.display = "none";
        }

        function closeModal() {
            modal.style.display = "none";
            errorMsg.style.display = "none";
        }


        function redirectTo(page) {
            window.location.href = page;
        }

        window.onclick = function (event) {
            if (event.target == modal) {
                errorMsg.style.display = "block";
            }
        }

        window.addEventListener("keydown", function (e) {
            if (e.key === "Escape" && modal.style.display === "block") {
                e.preventDefault();
                errorMsg.style.display = "block";
            }
        });
    </script>
</body>
</html>
