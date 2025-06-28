<?php
session_start();
include('dbconnect.php');
error_reporting(0);

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_name']);
$isLoggedId = isset($_SESSION['user_id']);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user exists in approved users table
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];

            // Role-based redirect
            switch ($user['role']) {
                case 'admin':
                    header("Location: admin_home.php");
                    break;
                case 'service':
                    header("Location: provider_home.php");
                    break;
                case 'user':
                    header("Location: user_home.php");
                    break;
                default:
                    echo "Unknown role!";
                    exit();
            }
            exit();
        } else {
            echo "
<script>alert('Incorrect password. Please try again.'); window.location.href = 'login.php';</script>";
        }
    } else {
        // Check if the user is still pending
        $pending_sql = "SELECT * FROM pending_users WHERE email = ?";
        $pending_stmt = $conn->prepare($pending_sql);
        $pending_stmt->bind_param("s", $email);
        $pending_stmt->execute();
        $pending_result = $pending_stmt->get_result();

        if ($pending_result->num_rows > 0) {
            echo "
<script>alert('Your registration is pending. Please wait for admin approval.'); window.location.href = 'login.php';</script>";
        } else {
            echo "
<script>alert('Invalid email. Please try again.'); window.location.href = 'login.php';</script>";
        }
    }

    $conn->close();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css" />
    <link rel="icon" href="images/Logo.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>
    <div class="navbar">
        <div class="logo">Lankan <span>Event Organizers</span></div>
        <nav class="nav-menu">
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="index.php #services">Services</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="index.php #about">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </div>

    <main class="login-container">
        <div class="login-box">
            <div class="welcome-section">
                <h1>Lankan Event Organizers</h1>
                <h2>Welcome!</h2>
                <h3>To Our Website.</h3>
                <p>Login to your Account to Make Your Event Memorable</p>
            </div>
            <div class="signin-section">
                <h2>Sign In</h2>
                <form method="POST" action="">
                    <label>Email</label>
                    <div class="input-box">
                        <input type="email" name="email" required />
                        <i class="fas fa-envelope"></i>
                    </div>

                    <label>Password</label>
                    <div class="input-box">
                        <input type="password" name="password" required />
                        <i class="fas fa-lock"></i>
                    </div>

                    <div class="options">
                        <label><input type="checkbox" /> Remember me</label>
                        <a href="forgot_password.php">Forgot Password?</a>
                    </div>

                    <button type="submit" class="signin-btn">Sign In</button>
                    <p class="signup-link">Don't you have an account? <a href="#" onclick="openModal()">Sign up</a></p>

                    <div id="roleModal" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeModal()">&times;</span>
                            <div class="btn-group">
                                <button class="btn-provider" onclick="redirectTo('provider_register.php')">Service Provider</button>
                                <button class="btn-user" onclick="redirectTo('user_register.php')">User</button>
                            </div>
                            <div id="errorMsg" class="error" style="display: none;">Please select a role to continue.</div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </main>

    <section class="troubleshooting">
        <div class="troubleshooting-header">
            <img src="images/help.png" alt="Help" class="troubleshooting-logo" />
            <h2>Need Help Signing In?</h2>
            <p>Here are some common issues and how to fix them:</p>
        </div>

        <div class="troubleshooting-content">
            <div class="troubleshooting-card">
                <i class="fas fa-envelope-open-text card-icon"></i>
                <h3>Invalid Email?</h3>
                <p>Double-check your email address format (e.g., <em>you@example.com</em>).</p>
            </div>

            <div class="troubleshooting-card">
                <i class="fas fa-lock card-icon"></i>
                <h3>Incorrect Password?</h3>
                <p>Click <a href="forgot_password.php">"Forgot Password?"</a> to reset your password via email.</p>
            </div>

            <div class="troubleshooting-card">
                <i class="fas fa-user-slash card-icon"></i>
                <h3>Account Not Found?</h3>
                <p>Make sure you're registered. <a href="#" onclick="openModal()">Sign up here</a> if you're new.</p>
            </div>

            <div class="troubleshooting-card">
                <i class="fas fa-network-wired card-icon"></i>
                <h3>Connection Issue?</h3>
                <p>Please check your internet connection or try again in a few minutes.</p>
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

    <script>
        let modal = document.getElementById("roleModal");
        let errorMsg = document.getElementById("errorMsg");

        function openModal() {
            modal.style.display = "block";
            errorMsg.style.display = "none"; // reset error
        }

        function closeModal() {
            modal.style.display = "none";
            errorMsg.style.display = "none"; // hide error when closing
        }

        function redirectTo(page) {
            window.location.href = page;
        }

        // Prevent clicking outside from closing the modal
        window.onclick = function (event) {
            if (event.target == modal) {
                errorMsg.style.display = "block"; // instead of closing, show warning
            }
        }

        window.addEventListener("keydown", function (e) {
            if (e.key === "Escape" && modal.style.display === "block") {
                e.preventDefault();
                errorMsg.style.display = "block";
            }
        });
    </script>

</body>
</html>
