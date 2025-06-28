<?php
session_start();
include('dbconnect.php');
error_reporting(0);

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_name']);
$isLoggedId = isset($_SESSION['user_id']);

$provider_name = $_SESSION['user_name']; // Logged-in provider name
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>View Booking</title>
    <link rel="stylesheet" href="booking.css" />
    <link rel="icon" href="images/Logo.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <div class="logo">Lankan <span>Event Organizers</span></div>
    <ul class="nav-links">
        
        <?php if ($isLoggedIn): ?>
            <li><a href="provider_home.php #index">Home</a></li>
        <?php else: ?>
            <li><a href="index.php #index">Home</a></li>
        <?php endif; ?>

        <?php if ($isLoggedIn): ?>
            <li><a href="provider_home.php #services">Services</a></li>
        <?php else: ?>
            <li><a href="index.php #services">Services</a></li>
        <?php endif; ?>

        <?php if ($isLoggedIn): ?>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
        <?php endif; ?>

        <?php if ($isLoggedIn): ?>
            <li><a href="provider_home.php #about">About</a></li>
        <?php else: ?>
            <li><a href="index.php #about">About</a></li>
        <?php endif; ?>

    </ul>
</nav>

<?php
echo "<h2>📋 Individual Service Bookings</h2>";
$sql_service = "SELECT * FROM payment WHERE provider_name = ?";
$stmt_service = $conn->prepare($sql_service);
$stmt_service->bind_param("s", $provider_name);
$stmt_service->execute();
$result_service = $stmt_service->get_result();

if ($result_service->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>Service Name</th><th>Booked By</th><th>Amount</th><th>Booking Date</th></tr>";

    while ($row = $result_service->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['service_name'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>Rs. " . $row['amount'] . "</td>";
        echo "<td>" . $row['booking_date'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No individual service bookings found.</p>";
}

$stmt_service->close();

// --------- Packages Section ---------
echo "<h2>📦 Package Bookings</h2>";

$sql_package = "SELECT * FROM booked_packages";
$result_package = $conn->query($sql_package);

if ($result_package->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>Package Name</th><th>Booked By</th><th>Amount</th><th>Booking Date</th></tr>";

    while ($row = $result_package->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['package_name'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>Rs. " . $row['amount'] . "</td>";
        echo "<td>" . $row['booking_date'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No package bookings found.</p>";
}

$conn->close();
?>

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