<?php
session_start();
include('dbconnect.php');
error_reporting(0);

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_name']);
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

    <!-- Navbar -->
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
            <p>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']);?> !</p>
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
        <h2>About Us</h2>
        <p>
            Customers find event planning to be a difficult and time-consuming activity since it often requires coordinating with many service providers, handling bookings, and organizing logistics.
            <strong>Lankan Event Organizers</strong> seeks to improve this process by acting as a complete one-stop shop for planning events of all types, including parties, weddings, get-togethers, and more.
        </p>
        <p>
            Chefs, DJs, decorators, photographers, bridal makeup artists, waiters, cleaning services, wedding venues, transportation services, and restaurants are just a few of the many service providers that the system brings together.
            After admin approval, customers can book them.
        </p>
        <p>
            Customers can browse, pick, and reserve service providers based on event needs and location. They can also choose from pre-made packages (e.g., wedding, party, iftar), which combine multiple services into one.
        </p>
        <p>
            The platform also helps service providers gain more visibility and reach a broader audience online.
        </p>
    </section>

    <section class="cta">
        <h2>Ready to plan your event?</h2>
        <a href="booking.php" class="btn">Book Now</a>
        <?php if ($isLoggedIn): ?>
            <a href="view_booking.php" class="btn">View Your Bookings</a>
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
    </footer>

</body>
</html>


