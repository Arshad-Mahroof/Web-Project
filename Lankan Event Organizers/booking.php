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

            <?php if ($isLoggedIn): ?>
                <li><a href="user_home.php #index">Home</a></li>
            <?php else: ?>
                <li><a href="index.php #index">Home</a></li>
            <?php endif; ?>

            <?php if ($isLoggedIn): ?>
                <li><a href="user_home.php #services">Services</a></li>
            <?php else: ?>
                <li><a href="index.php #services">Services</a></li>
            <?php endif; ?>

            <?php if ($isLoggedIn): ?>
            <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
            <li><a href="login.php">Login</a></li>
            <?php endif; ?>
            
            <?php if ($isLoggedIn): ?>
                <li><a href="user_home.php #about">About</a></li>
            <?php else: ?>
                <li><a href="index.php #about">About</a></li>
            <?php endif; ?>

            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>

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

    <!-- Services Section -->
    <section class="services" id="services">
        <h1> Booking For Your Event </h1>
        <h2>Our Services</h2>
        <div class="service-grid">
            <div class="service-card"><img src="images/chef.jpg"></br><a href="chef.php">Chefs</a></div>
            <div class="service-card"><img src="images/dj.jpg"></br><a href="dj.php">DJs</a></div>
            <div class="service-card"><img src="images/decoration.jpg"></br><a href="decoration.php">Decorators</a></div>
            <div class="service-card"><img src="images/photographers.jpg"></br><a href="photographers.php">Photographers</a></div>
            <div class="service-card"><img src="images/makeup_artists.webp"></br><a href="makeup_artists.php">Makeup Artists</a></div>
            <div class="service-card"><img src="images/waiters.jpg"></br><a href="waiters.php">Waiters</a></div>
            <div class="service-card"><img src="images/cleaning_services.jpg"></br><a href="cleaning_services.php">Cleaning Work</a></div>
            <div class="service-card"><img src="images/transport.jpg"></br><a href="transport.php">Transport</a></div>
            <div class="service-card"><img src="images/restaurants.avif"></br><a href="restaurants.php">Restaurants</a></div>
            <div class="service-card"><img src="images/mehendi_artists.webp"></br><a href="mehendi.php">Mehandi Artists</a></div>
        </div>
        <br />

        <h2>Packages</h2>
        <div class="package-grid">
            <div class="package-card"><img src="images/ifthar.jpg"></br><a href="ifthar.php">Ifthar Pack</a></div>
            <div class="package-card"><img src="images/wedding.avif"></br><a href="wedding.php">Wedding Pack</a></div>
            <div class="package-card"><img src="images/parties.jpg"></br><a href="parties.php">Parties Pack</a></div>
            <div class="package-card"><img src="images/gtg.jpg"></br><a href="gtg.php">Get to Gether Pack</a></div>
            <div class="package-card"><img src="images/event.jpg"></br><a href="event.php">Event Pack</a></div>
            <div class="package-card"><img src="images/djparties.jpg"></br><a href="djparties.php">DJ Parties Pack</a></div>
        </div>
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