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
    <title>Packages</title>
    <link rel="stylesheet" href="packages.css" />
    <link rel="icon" href="images/Logo.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo">Lankan <span>Event Organizers</span></div>
        <ul class="nav-links">

            <?php if ($isLoggedIn): ?>
                <li><a href="admin_home.php #index">Home</a></li>
            <?php else: ?>
                <li><a href="index.php #index">Home</a></li>
            <?php endif; ?>

            <?php if ($isLoggedIn): ?>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>

        </ul>
    </nav>

    <h2>Select a Package Type</h2>
    <div class="package-buttons">
        <button onclick="showForm('ifthar')">Ifthar</button>
        <button onclick="showForm('wedding')">Wedding</button>
        <button onclick="showForm('parties')">Parties</button>
        <button onclick="showForm('get_together')">Get Together</button>
        <button onclick="showForm('event')">Event</button>
        <button onclick="showForm('dj_parties')">DJ Parties</button>
    </div>

    <!-- IFTAR FORM -->
    <div class="form-section" id="ifthar">
        <h3>Ifthar Package Service Selection</h3>
        <form method="POST" action="submit_package.php">
            <?php
            $ifthar_services = ['Chef', 'Decorators', 'Photographers', 'Waiters', 'Cleaning Services', 'Restaurants'];

            foreach ($ifthar_services as $service) {
            echo "<div class='form-group'>
                ";
                echo "<label>$service</label>";

                // Using service_name instead of service_type
                $query = "SELECT id, provider_name FROM services WHERE service_name='$service'";
                $result = mysqli_query($conn, $query);

                if (in_array($service, ['Waiters', 'Cleaning Services'])) {
                echo "<select name='service_" . strtolower(str_replace(' ', ' _', $service)) . "[]' multiple>" ;
                              } else {
                              echo "<select name='service_" . strtolower(str_replace(' ', ' _', $service)) . "'>" ;
                              echo "<option value=''>-- Select $service --</option>" ;
                              }
                              while ($row=mysqli_fetch_assoc($result)) {
                              echo "<option value='{$row['id']}'>{$row['provider_name']}</option>" ;
                              }
                              echo "</select></div>" ;
                              }
                              ?>
                    <input type="hidden" name="package_type" value="Ifthar">
                    <label>Package Price (LKR)</label>
                    <input type="number" name="price" step="0.01" required></br></br>
                    <button type="submit" name="submit">Submit Ifthar Package</button>
        </form>
    </div>



    <!-- WEDDING FORM -->
    <div class="form-section" id="wedding">
        <h3>Wedding Package Service Selection</h3>
        <form method="POST" action="submit_package.php">
            <?php
            $wedding_services = ['Chef', 'DJs', 'Decorators', 'Photographers','Makeup Artists', 'Waiters', 'Cleaning Services','Mehandi Artists', 'Restaurants', 'Transport'];

            foreach ($wedding_services as $service) {
            echo "<div class='form-group'>
                ";
                echo "<label>$service</label>";

                // Query using service_name
                $query = "SELECT id, provider_name FROM services WHERE service_name='$service'";
                $result = mysqli_query($conn, $query);

                // Multi-select for Waiters & Cleaning Services
                if (in_array($service, ['Waiters', 'Cleaning Services'])) {
                echo "<select name='service_" . strtolower(str_replace(' ', ' _', $service)) . "[]' multiple>" ;
                              } else {
                              echo "<select name='service_" . strtolower(str_replace(' ', ' _', $service)) . "'>" ;
                              echo "<option value=''>-- Select $service --</option>" ;
                              }
                              while ($row=mysqli_fetch_assoc($result)) {
                              echo "<option value='{$row['id']}'>{$row['provider_name']}</option>" ;
                              }
                              echo "</select></div>" ;
                              }
                              ?>
                    <input type="hidden" name="package_type" value="Wedding">
                    <label>Package Price (LKR)</label>
                    <input type="number" name="price" step="0.01" required></br></br>
                    <button type="submit" name="submit">Submit Wedding Package</button>
        </form>
    </div>

    <!-- PARTIES FORM -->
    <div class="form-section" id="parties">
        <h3>Parties Package Service Selection</h3>
        <form method="POST" action="submit_package.php">
            <?php
            $parties_services = ['Chef', 'Decorators', 'Photographers','Waiters', 'Cleaning Services', 'Restaurants'];

            foreach ($parties_services as $service) {
            echo "<div class='form-group'>
                ";
                echo "<label>$service</label>";

                // Query using service_name
                $query = "SELECT id, provider_name FROM services WHERE service_name='$service'";
                $result = mysqli_query($conn, $query);

                // Multi-select for Waiters & Cleaning Services
                if (in_array($service, ['Waiters', 'Cleaning Services'])) {
                echo "<select name='service_" . strtolower(str_replace(' ', ' _', $service)) . "[]' multiple>" ;
                              } else {
                              echo "<select name='service_" . strtolower(str_replace(' ', ' _', $service)) . "'>" ;
                              echo "<option value=''>-- Select $service --</option>" ;
                              }
                              while ($row=mysqli_fetch_assoc($result)) {
                              echo "<option value='{$row['id']}'>{$row['provider_name']}</option>" ;
                              }
                              echo "</select></div>" ;
                              }
                              ?>
                    <input type="hidden" name="package_type" value="Parties">
                    <label>Package Price (LKR)</label>
                    <input type="number" name="price" step="0.01" required></br></br>
                    <button type="submit" name="submit">Submit Parties Package</button>
        </form>
    </div>

    <!-- GET TOGETHER FORM -->
    <div class="form-section" id="get_together">
        <h3>Get Together Package Service Selection</h3>
        <form method="POST" action="submit_package.php">
            <?php
            $get_together_services = ['Chef', 'DJs', 'Decorators', 'Photographers','Waiters', 'Cleaning Services', 'Restaurants'];

            foreach ($get_together_services as $service) {
            echo "<div class='form-group'>
                ";
                echo "<label>$service</label>";

                // Query from services table using service_name
                $query = "SELECT id, provider_name FROM services WHERE service_name='$service'";
                $result = mysqli_query($conn, $query);

                // Allow multi-select for Waiters & Cleaning Services
                if (in_array($service, ['Waiters', 'Cleaning Services'])) {
                echo "<select name='service_" . strtolower(str_replace(' ', ' _', $service)) . "[]' multiple>" ;
                              } else {
                              echo "<select name='service_" . strtolower(str_replace(' ', ' _', $service)) . "'>" ;
                              echo "<option value=''>-- Select $service --</option>" ;
                              }
                              while ($row=mysqli_fetch_assoc($result)) {
                              echo "<option value='{$row['id']}'>{$row['provider_name']}</option>" ;
                              }
                              echo "</select></div>" ;
                              }
                              ?>
                    <input type="hidden" name="package_type" value="Get Together">
                    <label>Package Price (LKR)</label>
                    <input type="number" name="price" step="0.01" required></br></br>
                    <button type="submit" name="submit">Submit Get Together Package</button>
        </form>
    </div>

    <!-- EVENT FORM -->
    <div class="form-section" id="event">
        <h3>Event Package Service Selection</h3>
        <form method="POST" action="submit_package.php">
            <?php
            $event_services = ['Chef', 'Decorators', 'Photographers','Waiters', 'Cleaning Services', 'Restaurants'];

            foreach ($event_services as $service) {
            echo "<div class='form-group'>
                ";
                echo "<label>$service</label>";

                // Query from services table using service_name
                $query = "SELECT id, provider_name FROM services WHERE service_name='$service'";
                $result = mysqli_query($conn, $query);

                // Allow multi-select for Waiters & Cleaning Services
                if (in_array($service, ['Waiters', 'Cleaning Services'])) {
                echo "<select name='service_" . strtolower(str_replace(' ', ' _', $service)) . "[]' multiple>" ;
                              } else {
                              echo "<select name='service_" . strtolower(str_replace(' ', ' _', $service)) . "'>" ;
                              echo "<option value=''>-- Select $service --</option>" ;
                              }
                              while ($row=mysqli_fetch_assoc($result)) {
                              echo "<option value='{$row['id']}'>{$row['provider_name']}</option>" ;
                              }
                              echo "</select></div>" ;
                              }
                              ?>
                    <input type="hidden" name="package_type" value="Event">
                    <label>Package Price (LKR)</label>
                    <input type="number" name="price" step="0.01" required></br></br>
                    <button type="submit" name="submit">Submit Event Package</button>
        </form>
    </div>

    <!-- DJ PARTIES FORM -->
    <div class="form-section" id="dj_parties">
        <h3>DJ Parties Package Service Selection</h3>
        <form method="POST" action="submit_package.php">
            <?php
            $dj_parties_services = ['Chef', 'Decorators', 'Photographers','Waiters', 'Cleaning Services', 'Restaurants'];

            foreach ($dj_parties_services as $service) {
            echo "<div class='form-group'>
                ";
                echo "<label>$service</label>";

                // Query from services table using service_name
                $query = "SELECT id, provider_name FROM services WHERE service_name='$service'";
                $result = mysqli_query($conn, $query);

                // Allow multi-select for Waiters & Cleaning Services
                if (in_array($service, ['Waiters', 'Cleaning Services'])) {
                echo "<select name='service_" . strtolower(str_replace(' ', ' _', $service)) . "[]' multiple>" ;
                              } else {
                              echo "<select name='service_" . strtolower(str_replace(' ', ' _', $service)) . "'>" ;
                              echo "<option value=''>-- Select $service --</option>" ;
                              }
                              while ($row=mysqli_fetch_assoc($result)) {
                              echo "<option value='{$row['id']}'>{$row['provider_name']}</option>" ;
                              }
                              echo "</select></div>" ;
                              }
                              ?>
                    <input type="hidden" name="package_type" value="DJ Parties">
                    <label>Package Price (LKR)</label>
                    <input type="number" name="price" step="0.01" required></br></br>
                    <button type="submit" name="submit">Submit Event Package</button>
        </form>
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

    <script>
        function showForm(formId) {
            const sections = document.querySelectorAll(".form-section");
            sections.forEach(section => section.style.display = "none");
            document.getElementById(formId).style.display = "block";
        }
    </script>

</body>
</html>
