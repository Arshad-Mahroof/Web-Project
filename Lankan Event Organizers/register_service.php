<?php
session_start();
include('dbconnect.php');

if (!isset($_SESSION['user_name']) || $_SESSION['user_role'] !== 'service') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $provider_name = $_SESSION['user_name'];

    $stmt = $conn->prepare("SELECT email, photo FROM users WHERE name = ?");
    $stmt->bind_param("s", $provider_name);
    $stmt->execute();
    $result = $stmt->get_result();
    $provider = $result->fetch_assoc();

    $email = $provider['email'];
    $photo = $provider['photo'];

    $service_name = $_POST['service_name'];
    $description = $_POST['description'];
    $location = $_POST['service_location'];
    $price = $_POST['price'];
    $time_slot = $_POST['time_slot'];

    // Check if provider already submitted this service category in pending_services
$checkPendingStmt = $conn->prepare("SELECT * FROM pending_services WHERE provider_name = ? AND service_name = ?");
$checkPendingStmt->bind_param("ss", $provider_name, $service_name);
$checkPendingStmt->execute();
$pendingResult = $checkPendingStmt->get_result();

// Check if provider already has this service category in approved services
$checkApprovedStmt = $conn->prepare("SELECT * FROM services WHERE provider_name = ? AND service_name = ?");
$checkApprovedStmt->bind_param("ss", $provider_name, $service_name);
$checkApprovedStmt->execute();
$approvedResult = $checkApprovedStmt->get_result();

if ($pendingResult->num_rows > 0 || $approvedResult->num_rows > 0) {
    echo "
<script>alert('You have already submitted or registered this service category.'); window.location.href = 'provider_home.php';</script>";
} else {
    // Insert new service into pending_services
    $stmt = $conn->prepare("INSERT INTO pending_services (provider_name, service_name, description, email, photo, location, price, time_slot) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssds", $provider_name, $service_name, $description, $email, $photo, $location, $price, $time_slot);

    if ($stmt->execute()) {
        echo "
<script>alert('Service submitted for admin approval.'); window.location.href = 'provider_home.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$checkPendingStmt->close();
$checkApprovedStmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lankan Event Organizers</title>
    <link rel="stylesheet" href="register_service.css" />
    <link rel="icon" href="images/Logo.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">Lankan <span>Event Organizers</span></div>
        <ul class="nav-links">
            <li><a href="provider_home.php">Home</a></li>
            <li><a href="register_service.php">Register</a></li>
            <li><a href="provider_home.php #about">About</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>

    <!-- Service Registration Interface -->
    <div class="login-container">
        <div class="login-box">
            <!-- Left Panel -->
            <div class="welcome-section">
                <h2>Lankan Event Organizers</h2>
                <h1>Hello Provider!</h1>
                <h3>Submit Your Service</h3>
                <p>Make your service visible to our event planners across Sri Lanka</p>
            </div>

            <!-- Right Panel / Form -->
            <div class="signin-section">
                <h2>Service Registration</h2>
                <form method="POST">
                    <div class="input-box">
                        <select name="service_name" required>
                            <option value="">-- Select Service --</option>
                            <option value="Chef">Chefs</option>
                            <option value="DJs">DJs</option>
                            <option value="Decorators">Decorators</option>
                            <option value="Photographers">Photographers</option>
                            <option value="Makeup Artists">Makeup Artists</option>
                            <option value="Waiters">Waiters</option>
                            <option value="Cleaning Services">Cleaning Work</option>
                            <option value="Transport">Transport</option>
                            <option value="Restaurants">Restaurants</option>
                            <option value="Mehandi Artists">Mehandi Artists</option>
                        </select>
                    </div>

                    <div class="input-box">
                        <select name="service_location" required>
                            <option value="">-- Select Location --</option>
                            <option value="Kandy">Kandy</option>
                            <option value="Matale">Matale</option>
                            <option value="Nuwara Eliya">Nuwara Eliya</option>
                            <option value="Ampara">Ampara</option>
                            <option value="Batticaloa">Batticaloa</option>
                            <option value="Trincomalee">Trincomalee</option>
                            <option value="Jaffna">Jaffna</option>
                            <option value="Kilinochchi">Kilinochchi</option>
                            <option value="Mannar">Mannar</option>
                            <option value="Mullaitivu">Mullaitivu</option>
                            <option value="Vavuniya">Vavuniya</option>
                            <option value="Anuradhapura">Anuradhapura</option>
                            <option value="Polonnaruwa">Polonnaruwa</option>
                            <option value="Kurunegala">Kurunegala</option>
                            <option value="Puttalam">Puttalam</option>
                            <option value="Kegalle">Kegalle</option>
                            <option value="Ratnapura">Ratnapura</option>
                            <option value="Galle">Galle</option>
                            <option value="Hambantota">Hambantota</option>
                            <option value="Matara">Matara</option>
                            <option value="Badulla">Badulla</option>
                            <option value="Monaragala">Monaragala</option>
                            <option value="Colombo">Colombo</option>
                            <option value="Gampaha">Gampaha</option>
                            <option value="Kalutara">Kalutara</option>
                        </select>
                    </div>

                    <div class="input-box">
                        <input type="number" name="price" step="0.01" placeholder="Price (LKR)" pattern="^\d+(\.\d{1,2})?$" title="Enter a valid price (e.g., 100 or 99.99)" required />
                    </div>

                    <div class="input-box">
                        <textarea name="description" placeholder="Describe your service with details like hall name, timing, packages..." minlength="30" maxlength="1000" title="Description should be between 30 and 1000 characters."required></textarea>
                    </div>

                    <div class="input-box">
                        <select name="time_slot" required>
                            <option value="">-- Select Time --</option>
                            <option value="Day">Day</option>
                            <option value="Night">Night</option>
                            <option value="Full Time">Full Time</option>
                        </select>
                    </div>

                    <button type="submit" class="signin-btn">Submit Service</button>
                </form>
            </div>
        </div>
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

</body>
</html>