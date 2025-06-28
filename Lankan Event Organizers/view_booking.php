<?php
session_start();
include('dbconnect.php');
error_reporting(0);

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_name']);
$isLoggedId = isset($_SESSION['user_id']);

// Logged-in user's username
$username = $_SESSION['user_name']; 
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

<?php

echo "<h2>📋 Your Service Bookings</h2>";

// Fetch user's individual service bookings
$sql_service = "SELECT * FROM payment WHERE username = ?";
$stmt_service = $conn->prepare($sql_service);
$stmt_service->bind_param("s", $username);
$stmt_service->execute();
$result_service = $stmt_service->get_result();

if ($result_service->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>Service Name</th><th>Provider</th><th>Amount</th><th>Booking Date</th><th>Actions</th></tr>";

    while ($row = $result_service->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['service_name'] . "</td>";
        echo "<td>" . $row['provider_name'] . "</td>";
        echo "<td>Rs. " . $row['amount'] . "</td>";
        echo "<td>" . $row['booking_date'] . "</td>";
        echo "<td>
                <a href='update_booking.php?id=" . $row['id'] . "'>Update</a> |
                <a href='delete_booking.php?id=" . $row['id'] . "' onclick=\"return confirm('Are you sure you want to delete this booking?');\">Delete</a>
              </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No individual service bookings found.</p>";
}

$stmt_service->close();

echo "<br><h2>📦 Your Package Bookings</h2>";

// Fetch user's package bookings
$sql_package = "SELECT * FROM booked_packages WHERE username = ?";
$stmt_package = $conn->prepare($sql_package);
$stmt_package->bind_param("s", $username);
$stmt_package->execute();
$result_package = $stmt_package->get_result();

if ($result_package->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>Package Name</th><th>Amount</th><th>Booking Date</th><th>Actions</th></tr>";

    while ($row = $result_package->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['package_name'] . "</td>";
        echo "<td>Rs. " . $row['amount'] . "</td>";
        echo "<td>" . $row['booking_date'] . "</td>";
        echo "<td>
                <a href='update_booking.php?package_id=" . $row['id'] . "'>Update</a> |
                <a href='delete_booking.php?package_id=" . $row['id'] . "' onclick=\"return confirm('Are you sure you want to delete this package booking?');\">Delete</a>
              </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No package bookings found.</p>";
}

$stmt_package->close();
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