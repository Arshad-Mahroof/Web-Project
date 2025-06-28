<?php
session_start();
include('dbconnect.php');
error_reporting(0);

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_name']);
$isLoggedId = isset($_SESSION['user_id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lankan Event Organizers</title>
    <link rel="stylesheet" href="admin_home.css" />
    <link rel="icon" href="images/Logo.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <nav class="navbar">
        <div class="logo">Lankan <span>Event Organizers</span></div>
        <ul class="nav-links">
            <li><a href="#Home">Home</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="overlay"></div>
        <div class="hero-content">
            <h1>Make Your Event Memorable</h1>
            <p class="subheading">One-stop solution for all your event needs in Sri Lanka</p>
            <p class="welcome-msg">Welcome Admin,<span class="provider-name"><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'admin'); ?></span>!</p>
        </div>
    </section>

    <section class="register-section">
        <h2>Event Packages</h2>
        <div class="container">
            <button onclick="window.location.href='packages.php';" class="register-btn">Add Packages</button>
        </div>
    </section>

    <section class="section payments-section">
        <h2>Pending Service Providers</h2>
        <div class="container">
            <?php
            $result = $conn->query("SELECT * FROM pending_users");
            while ($row = $result->fetch_assoc()) { ?>
            <div class="card pending-card">
                <img src="<?php echo $row['photo']; ?>" alt="Photo">
                <p><strong><?php echo htmlspecialchars($row['name']); ?></strong></p>
                <p><?php echo htmlspecialchars($row['email']); ?></p>
                <div class="status pending"><i class="fas fa-hourglass-half"></i> Pending </div>
                <div class="btn-group">
                    <form method="POST" action="approve.php">
                        <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="btn approve-btn" value="Approve"><i class="fas fa-check"></i>Approve</button>
                    </form>
                    <form method="POST" action="delete.php" onsubmit="return confirm('Are you sure you want to delete this user?');">
                        <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="btn delete-btn" value="Delete"><i class="fas fa-trash-alt"></i>Delete</button>
                    </form>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>

    <section class="section payments-section">
        <h2>Approved Service Providers</h2>
        <div class="container">
            <?php
            $result = $conn->query("SELECT * FROM users WHERE role='service'");
            while ($row = $result->fetch_assoc()) { ?>
            <div class="card approved-card">
                <img src="<?php echo $row['photo']; ?>" alt="Photo">
                <p><strong><?php echo htmlspecialchars($row['name']); ?></strong></p>
                <p><?php echo htmlspecialchars($row['email']); ?></p>
                <div class="status approved"><i class="fas fa-check-circle"></i> Approved </div>
            </div>
            <?php } ?>
        </div>
    </section>

    <section class="section payments-section" id="services">
        <h2>Pending Services</h2>
        <div class="container">
            <?php
            $result = $conn->query("SELECT * FROM pending_services");
            while ($row = $result->fetch_assoc()) { ?>
            <div class="card pending-card">
                <img src="<?php echo htmlspecialchars($row['photo']); ?>" width="100" alt="Provider Photo">                
                <p><strong>Service Name:</strong> <?php echo htmlspecialchars($row['service_name']); ?></p>
                <p><strong>Provider:</strong> <?php echo htmlspecialchars($row['provider_name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
                <p><strong>Description:</strong><br><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
                <p><strong>Location:</strong> <?php echo htmlspecialchars($row['location']); ?></p>
                <p><strong>Price:</strong> <?php echo htmlspecialchars($row['price']); ?></p>
                <p><strong>Time:</strong> <?php echo htmlspecialchars($row['time_slot']); ?></p>
                <div class="status pending"><i class="fas fa-hourglass-half"></i> Pending </div>
                <div class="btn-group">
                    <form method="POST" action="approve_service.php">
                        <input type="hidden" name="service_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="btn approve-btn" value="Approve"><i class="fas fa-check"></i>Approve</button>
                    </form>
                    <form method="POST" action="delete_service.php" onsubmit="return confirm('Are you sure you want to delete this service?');">
                        <input type="hidden" name="service_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="btn delete-btn" value="Delete"><i class="fas fa-trash-alt"></i>Delete</button>
                    </form>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>

    <section class="section payments-section">
        <h2>Approved Services</h2>
        <div class="container">
            <?php
            $result = $conn->query("SELECT * FROM services");
            while ($row = $result->fetch_assoc()) { ?>
            <div class="card approved-card">
                <img src="<?php echo htmlspecialchars($row['photo']); ?>" width="100" alt="Provider Photo">
                <p><strong>Provider:</strong> <?php echo htmlspecialchars($row['provider_name']); ?></p>
                <p><strong>Service Name:</strong> <?php echo htmlspecialchars($row['service_name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
                <p><strong>Location:</strong> <?php echo htmlspecialchars($row['location']); ?></p>
                <p><strong>Price:</strong> <?php echo htmlspecialchars($row['price']); ?></p>
                <p><strong>Time:</strong> <?php echo htmlspecialchars($row['time_slot']); ?></p>
                <div class="status approved"><i class="fas fa-check-circle"></i> Approved </div>
            </div>
            <?php } ?>
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
