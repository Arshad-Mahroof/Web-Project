<?php
session_start();
include('dbconnect.php');
error_reporting(0);

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_name']);
$isLoggedId = isset($_SESSION['user_id']);

// Get service details from ID
if (isset($_GET['service_id'])) {
    $service_id = $_GET['service_id'];
    $stmt = $conn->prepare("SELECT * FROM services WHERE id = ?");
    $stmt->bind_param("i", $service_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $service = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lankan Event Organizers</title>
    <link rel="stylesheet" href="payment.css" />
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

    <h2 style="text-align: center;">Complete Your Payment</h2>

    <form action="process_payment.php" method="POST">
        <div class="payment-container">
            <!-- Left: Payment Form -->
            <div class="payment-form">
                <h3 style="color: #007bff;">Billing Information</h3>
                
                <div class="input-box">
                    <input type="text" name="card_name" id="card_name" placeholder="Cardholder Name" pattern="^[A-Za-z ]+$" titile="Give in Letters" required>
                    <label for="card_name">Cardholder Name</label> 
                </div>

                <div class="input-box">
                    <input type="text" name="card_number" placeholder="Card Number" maxlength="19" pattern="\d{16}" title="Enter a 16-digit card number" required>
                    <label for="card_number">Card Number</label>
                </div>

                <div class="input-row">
                    <div class="input-box half">
                        <input type="text" name="expiry_month" placeholder="MM" maxlength="2" pattern="(0[1-9]|1[0-2])" title="Enter month as MM (01-12)" required>
                        <label for="expiry_month">Expiry Month</label>                        
                    </div>
                    <div class="input-box half">
                        <input type="text" name="expiry_year" placeholder="YY" maxlength="2" pattern="\d{2}" title="Enter year as YY" required>
                        <label for="expiry_year">Expiry Year</label>
                    </div>
                </div>

                <div class="input-box">
                    <input type="text" name="cvv" placeholder="XXX" maxlength="4" pattern="\d{3,4}" title="Enter 3 or 4-digit CVV" required>
                    <label for="cvv">Security Code (CVV)</label>
                </div>

                <div class="input-box">
                    <input type="text" name="amount" value="<?php echo $service['price']; ?>" readonly>
                    <label for="amount">Amount (LKR)</label>
                </div>

                <div class="input-box">
                    <input type="date" name="booking_date" required>
                    <label for="booking_date">Booking Date</label>
                </div>

                <input type="hidden" name="service_id" value="<?php echo $service['id']; ?>">

            </div>

            <div class="service-info">
                <h3>You're Buying</h3>
                <div class="service-info-header">
                    <?php if ($service['photo']) { ?>
                    <img src="<?php echo $service['photo']; ?>" alt="Service Photo">
                    <?php } ?>
                    <div>
                        <strong><?php echo $service['service_name']; ?></strong><br>
                        <span><?php echo $service['provider_name']; ?></span>
                    </div>
                </div>
                <table class="service-details-table">
                    <tr>
                        <td>Location:</td>
                        <td><?php echo $service['location']; ?></td>
                    </tr>
                    <tr>
                        <td>Price:</td>
                        <td>LKR <?php echo number_format($service['price'], 2); ?></td>
                    </tr>
                </table>
                <button type="submit" class="submit-btn">Submit Order</button>
            </div>
        </div>
    </form>

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
