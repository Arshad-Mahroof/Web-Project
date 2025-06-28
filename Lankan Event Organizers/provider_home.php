<?php
session_start();
include('dbconnect.php');
error_reporting(0);

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_name']);
$isLoggedId = isset($_SESSION['user_id']);
$providerName = $_SESSION['user_name']; // used to fetch pending payments
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lankan Event Organizers</title>
    <link rel="stylesheet" href="provider_home.css" />
    <link rel="icon" href="images/Logo.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">Lankan <span>Event Organizers</span></div>
        <ul class="nav-links">
            <li><a href="#home">Home</a></li>
            <?php if ($isLoggedIn): ?>
            <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
            <li><a href="login.php">Login</a></li>
            <?php endif; ?>
            <li><a href="#about">About</a></li>
        </ul>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="overlay"></div>
        <div class="hero-content">
            <h1>Make Your Event Memorable</h1>
            <p class="subheading">One-stop solution for all your event needs in Sri Lanka</p>
            <p class="welcome-msg">Welcome Service Provider,<span class="provider-name"> <?php echo htmlspecialchars($_SESSION['user_name']);?></span>!</p>
        </div>
    </section>

    <div class="register-section">
        <h3>Want to Offer a New Service?</h3>
        <p>Register your services to be reviewed by the admin and listed for users after approval.</p>
        <button class="register-btn" onclick="window.location.href='register_service.php'">Register Your Service</button>
    </div>

    <section class="section payments-section">
    <h2>Pending Payments from Customers</h2>
    <div class="container">
        <?php
        $result = $conn->query("SELECT * FROM pending_payments WHERE provider_name = '$providerName'");
        while ($row = $result->fetch_assoc()) { ?>
            <div class="card pending-card">
                <p><strong><?php echo htmlspecialchars($row['username']); ?></strong></p>
                <p>Service: <?php echo htmlspecialchars($row['service_name']); ?></p>
                <p>Amount: LKR <?php echo htmlspecialchars($row['amount']); ?></p>
                <p>Card: <?php echo htmlspecialchars($row['card_name']); ?> (<?php echo htmlspecialchars($row['card_number']); ?>)</p>
                <div class="status pending"><i class="fas fa-hourglass-half"></i> Pending </div>
                <div class="btn-group">
                    <form method="POST" action="approve_payment.php">
                        <input type="hidden" name="payment_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="btn approve-btn" value="Approve"><i class="fas fa-check"></i>Approve</button>
                    </form>
                    <form method="POST" action="delete_payment.php" onsubmit="return confirm('Are you sure you want to delete this payment?');">
                        <input type="hidden" name="payment_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="btn delete-btn" value="Delete"><i class="fas fa-trash-alt"></i>Delete</button>
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<section class="section payments-section">
    <h2>Approved Payments from Customers</h2>
    <div class="container">
        <?php
        $result = $conn->query("SELECT * FROM payment WHERE provider_name = '$providerName'");
        while ($row = $result->fetch_assoc()) { ?>
            <div class="card approved-card">
                <p><strong><?php echo htmlspecialchars($row['username']); ?></strong></p>
                <p>Service: <?php echo htmlspecialchars($row['service_name']); ?></p>
                <p>Amount: LKR <?php echo htmlspecialchars($row['amount']); ?></p>
                <p>Card: <?php echo htmlspecialchars($row['card_name']); ?> (<?php echo htmlspecialchars($row['card_number']); ?>)</p>
                <div class="status approved"><i class="fas fa-check-circle"></i> Approved </div>
            </div>
        <?php } ?>
    </div>
</section>

<div class="register-section">
        <p>View User Booked your Bookings</p>
        <button class="register-btn" onclick="window.location.href='view_bookings.php'">View Bookings</button>
    </div>

    <!-- About Section -->
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
