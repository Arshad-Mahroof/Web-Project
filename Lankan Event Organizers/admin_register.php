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
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="register.css" />
    <link rel="icon" href="images/Logo.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>
    <div class="background"></div>

    <nav class="navbar">
        <div class="logo">Lankan <span>Event Organizers</span></div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php #services">Services</a></li>
            <li><a href="admin_register.php">Register</a></li>
            <li><a href="index.php #about">About</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>

    <!-- Inside <body> -->
    <div class="login-container">
        <div class="login-box">
            <!-- Left Panel -->
            <div class="welcome-section">
                <h2>Lankan Event Organizers</h2>
                <h1>Welcome!</h1>
                <h3>To Our Website</h3>
                <p>Register Your Account to Manage Events Seamlessly</p>
            </div>

            <!-- Right Panel / Form -->
            <div class="signin-section">
                <h2>Register as: Admin</h2>
                <form action="upload.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="role" value="admin" />

                    <div class="row">
                        <div class="input-box">
                            <input type="text" placeholder="Firstname" name="fname" pattern="^[A-Za-z ]+$" titile="Give in Letters" required />
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="input-box">
                            <input type="text" placeholder="Lastname" name="lname" pattern="^[A-Za-z ]+$" titile="Give in Letters" required />
                            <i class="fas fa-user"></i>
                        </div>
                    </div>

                    <div class="input-box">
                        <input type="email" placeholder="Email" name="email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[A-Za-z]{2,}$" title="Enter a valid email address" required />
                        <i class="fas fa-envelope"></i>
                    </div>

                    <div class="input-box">
                        <input type="file" name="photo" accept=".jpg, .jpeg, .png" title="Upload a photo (JPG, JPEG, or PNG)" required />
                        <i class="fas fa-image"></i>
                    </div>

                    <div class="input-box">
                        <input type="password" placeholder="Password" name="password" <input type="password" name="password" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" title="Minimum 8 characters, at least one letter and one number" required />
                        <i class="fas fa-lock"></i>
                    </div>

                    <div class="input-box">
                        <input type="password" placeholder="Confirm Password" name="confirm_password" <input type="password" name="password" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" title="Re-enter the password" required />
                        <i class="fas fa-lock"></i>
                    </div>

                    <button type="submit" class="signin-btn">Register</button>

                    <p class="signup-link">Already have an account? <a href="login.php">Login</a></p>
                </form>
            </div>
        </div>
    </div>

    <section class="troubleshooting">
        <div class="trouble-header">
            <i class="fas fa-life-ring pulse-icon"></i>
            <h2>Trouble Registering?</h2>
            <p>Let us help you sort things out quickly.</p>
        </div>
        <div class="trouble-grid">
            <div class="trouble-item">
                <i class="fas fa-user-slash"></i>
                <p><strong>Missing Fields:</strong> Make sure every required input is completed before submitting.</p>
            </div>
            <div class="trouble-item">
                <i class="fas fa-envelope-open-text"></i>
                <p><strong>Invalid Email:</strong> Use a valid email like <em>name@example.com</em>.</p>
            </div>
            <div class="trouble-item">
                <i class="fas fa-lock"></i>
                <p><strong>Password Issues:</strong> Use at least 6 characters, including uppercase, lowercase, and numbers.</p>
            </div>
            <div class="trouble-item">
                <i class="fas fa-image"></i>
                <p><strong>Photo Upload:</strong> Use supported formats only (JPG, PNG).</p>
            </div>
            <div class="trouble-item">
                <i class="fas fa-exchange-alt"></i>
                <p><strong>Mismatch:</strong> Password and confirm password must be the same.</p>
            </div>
            <div class="trouble-item">
                <i class="fas fa-user-check"></i>
                <p><strong>Already Registered?</strong> <a href="login.php">Login here</a>.</p>
            </div>
            <div class="trouble-item contact-help">
                <i class="fas fa-headset"></i>
                <p><strong>Still Need Help?</strong> <a href="contact.php">Contact Support</a>.</p>
            </div>
            <div class="trouble-item contact-help">
                <i class="fas fa-headset"></i>
                <p><strong>Still Need Help?</strong> <a href="contact.php">Contact Support</a>.</p>
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