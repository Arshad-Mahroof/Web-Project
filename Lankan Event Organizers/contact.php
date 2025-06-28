<?php
session_start();
include('dbconnect.php');
error_reporting(0);

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_name']);
$isLoggedId = isset($_SESSION['user_id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $conn->real_escape_string($_POST['fname']);
    $lname = $conn->real_escape_string($_POST['lname']);
    $fullName = $fname . ' ' . $lname;

    $email = $conn->real_escape_string($_POST["email"]);
    $phone = $conn->real_escape_string($_POST["phone"]);
    $message = $conn->real_escape_string($_POST["message"]);

    $sql = "INSERT INTO feedback (full_name, email, phone, message)
            VALUES ('$fullName', '$email', '$phone', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "
<script>alert('Thank you for your feedback!'); window.location.href = 'contact.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us - Lankan Event Organizers</title>
    <link rel="stylesheet" href="contact.css" />
    <link rel="icon" href="images/Logo.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
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
        </div>
    </nav>

    <div class="hero hero-contact">
        <div class="hero-content">
            <h1>Connect with Lankan Event Organizers</h1>
            <p>Whether you're planning a grand wedding, corporate event, or an intimate celebration, our expert team is ready to turn your vision into reality. Reach out now and let’s create unforgettable memories together.</p>
        </div>
    </div>

    <main class="main-content">
        <section class="contact-form">
            <div class="form-section">
                <h2>Reach out to us!</h2>
                <p>Got a question about Lankan Event Organizers? Interested in partnering with us? Have suggestions or just want to say hi? Contact us:</p>
                <form method="POST" action="">
                    <input type="text" name="fname" placeholder="First name" pattern="^[A-Za-z ]+$" titile="Give in Letters" required>
                    <input type="text" name="lname" placeholder="Last name" pattern="^[A-Za-z ]+$" titile="Give in Letters" required>
                    <input type="email" name="email" placeholder="Your Email Address" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[A-Za-z]{2,}$" title="Enter a valid email address" required>
                    <input type="tel" name="phone" placeholder="Phone Number" pattern="^\d{10}$" title="Enter a 10-digit phone number" required>
                    <textarea name="message" placeholder="Message" rows="4" minlength="10" maxlength="500" title="Message should be between 10 and 500 characters" required></textarea>
                    <button type="submit" class="btn-primary">SUBMIT</button>
                </form>
            </div>

            <div class="care-section">
                <h2>Customer Care</h2>
                <p>Not sure where to start? Need help with your event plan? Just visit our <a href="#">help center</a> or get in touch with us:</p>

                <div class="contact-person">
                    <img src="images/Arshad.jpg" alt="Arshad Mahroof">
                    <div>
                        <strong>Arshad Mahroof</strong><br>
                        Customer Care<br>
                        Tel: 077 204 8768
                    </div>
                </div>

                <div class="contact-person">
                    <img src="images/Inamullah.jpg" alt="Inamullah">
                    <div>
                        <strong>Inamullah</strong><br>
                        Customer Care<br>
                        Tel: 074 073 3212
                    </div>
                </div>

                <div class="social-connect">
                    <h3>Other ways to connect</h3>
                    <p><strong>📘</strong> Like us on Facebook to stay updated.</p>
                    <p><strong>🐦</strong> Follow us on Twitter for marketing tips.</p>
                    <p><strong>📷</strong> Follow us on Instagram to stay updated.</p>
                    <p><strong>💼</strong> Connect on LinkedIn for professional updates.</p>
                </div>
            </div>
        </section>
    </main>

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
</body>
</html>
