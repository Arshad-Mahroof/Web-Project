<?php
// Start the session
session_start();

// Check if the user is logged in
$isLoggedIn=isset($_SESSION['username']);
 // Assume 'username' is stored during login
 ?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="icon" href="images/Logo.jpeg" />
    <link rel="stylesheet" href="sheet.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
</head>
<body>

    <div class="head">
        <div class="image">
            <img src="images/Logo.jpeg" />
            <h1>Care Compass Hospital</h1>
        </div>
        <div class="sub">
            <ul>
                <li class="active"><a href="Home.php">Home</a></li>
                <li><a href="Appointment.php">Book Appointment</a></li>
                <li><a href="Portal.php">Patient Portal</a></li>
                <li><a href="AdminDoctor.php">Admin & Doctor Portal</a></li>
                <li><a href="Payment.php">Payment</a></li>
            </ul>
        </div>
    </div>

<?php if ($isLoggedIn): ?>

    <div class="hero">
        <div class="hero1">
            <h1>Care Composs Hospitals</h1>
            <h3>Welcome, <?php echo htmlspecialchars($_SESSION['username']);?> !</h3>
        </div>
        <div class="hero2">
            <img src="images/HomePage1.jpg" />
        </div>
    </div>

    <div class="villan">
        <div class="villan1">
            <h1>Hospital Services</h1>
            <p>Explore the wide range of medical services we offer to cater to your health needs.</p>
            <a href="Services.php" class="btn">Services</a>
        </div>
        <div class="villan2">
            <img src="images/Hospital.jpg" />
        </div>
    </div>

    <?php else: ?>

    <div class="hero">
        <div class="hero1">
            <h1>Welcome to Our Hospitals</h1>
            <p>Your health is our priority. Access services, appointments, and more.</p>
            <a href="Register.php" class="btn">Register Now</a>
        </div>
        <div class="hero2">
            <img src="images/HomePage1.jpg" />
        </div>
    </div>

    <div class="villan">
        <div class="villan1">
            <h1>Hospital Services</h1>
            <p>Explore the wide range of medical services we offer to cater to your health needs.</p>
            <a href="Services.php" class="btn">Services</a>
        </div>
        <div class="villan2">
            <img src="images/Hospital.jpg" />
        </div>
    </div>

    <?php endif; ?>

    <div class="footer">
        <p>&copy;Care Compass Hospitals. All Rights Reserved. |<a href="Contact.php">  Contact us  </a>|<?php if ($isLoggedIn): ?><a href="Logout.php"> Logout </a><?php endif; ?></p>
        <div class="social-media">
            <a href="https://www.facebook.com" target="_blank" class="social-icon"><i class="fab fa-facebook"></i></a>
            <a href="https://www.twitter.com" target="_blank" class="social-icon"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
            <a href="https://wa.me/yourphonenumber" target="_blank" class="social-icon"><i class="fab fa-whatsapp"></i></a>
        </div>
    </div>

</body>
</html>