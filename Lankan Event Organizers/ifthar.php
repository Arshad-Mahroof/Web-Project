<?php
session_start();
include('dbconnect.php');
error_reporting(0);

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_name']);
$isLoggedId = isset($_SESSION['user_id']);

// Function to get provider names from IDs
function getProviderNames($conn, $ids) {
    if (empty($ids)) return [];

    if (!is_array($ids)) $ids = [$ids];
    $ids = array_map('intval', $ids);
    $idList = implode(',', $ids);
    $nameQuery = "SELECT id, provider_name FROM services WHERE id IN ($idList)";
    $nameResult = mysqli_query($conn, $nameQuery);

    $nameMap = [];
    while ($row = mysqli_fetch_assoc($nameResult)) {
        $nameMap[$row['id']] = $row['provider_name'];
    }

    $providerInfo = [];
    foreach ($ids as $id) {
        $providerInfo[] = isset($nameMap[$id]) ? $nameMap[$id] : "Unknown";
    }

    return $providerInfo;
}

// Fetch Ifthar packages
$maxPrice = isset($_GET['max_price']) ? intval($_GET['max_price']) : null;

if ($maxPrice) {
    $query = "SELECT * FROM package WHERE package_type='Ifthar' AND price <= $maxPrice";
} else {
    $query = "SELECT * FROM package WHERE package_type='Ifthar'";
}
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>View Ifthar Packages</title>
    <link rel="stylesheet" href="ourPackages.css" />  
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

<?php if ($isLoggedIn): ?>
<section class="hero">
    <div class="hero-content">
        <h1>Make Your Event Memorable</h1>
        <p>One-stop solution for all your event needs in Sri Lanka</p>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</p>
    </div>
</section>
<?php else: ?>
<section class="hero">
    <div class="hero-content">
        <h1>Make Your Event Memorable</h1>
        <p>One-stop solution for all your event needs in Sri Lanka</p>
        <button onclick="openModal()" class="btn">Register Now</button>
    </div>

    <div id="roleModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3>HELLO</h3>
            <p>
                Please select your role to proceed with registration.
            </p>
            <div class="btn-group">
                <button class="btn-provider" onclick="redirectTo('provider_register.php')">Service Provider</button>
                <button class="btn-user" onclick="redirectTo('user_register.php')">User</button>
            </div>
            <div id="errorMsg" class="error" style="display: none;">Please select a role to continue.</div>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="filter-section">
    <form method="GET">
        <label for="price_filter">Filter by Max Price (Rs.): </label>
        <input type="number" name="price_filter" id="price_filter" min="0" value="<?php echo isset($_GET['price_filter']) ? htmlspecialchars($_GET['price_filter']) : ''; ?>">
        <input type="submit" class="btn" value="Filter">
    </form>
</section>

<h1>Ifthar Packages</h1>

<div class="packages-container"> <!-- 🔁 FLEX CONTAINER START -->

<?php while ($row = mysqli_fetch_assoc($result)) {
    $services = json_decode($row['services'], true);
    echo "<div class='package-box'>";
    echo "<h2>Price: Rs. {$row['price']}</h2>";

    foreach ($services as $service_type => $ids) {
        $providerNames = getProviderNames($conn, $ids);
        echo "<strong>" . ucfirst(str_replace('_', ' ', $service_type)) . ":</strong> " . implode(', ', $providerNames) . "<br>";
    }

    if (isset($_SESSION['user_name'])) {
        echo "<form method='POST' action='payment_packages.php'>";
        echo "<input type='hidden' name='package_id' value='{$row['id']}'>";
        echo "<input type='submit' name='book_now' value='Book'>";
        echo "</form>";
    } else {
        echo "<p class='modular-login'><em><a href='login.php'>Login</a> to book</em></p>";
    }

    echo "</div>"; // Close package-box
} ?>

</div> <!-- 🔁 FLEX CONTAINER END -->

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
    let modal = document.getElementById("roleModal");
    let errorMsg = document.getElementById("errorMsg");

    function openModal() {
        modal.style.display = "block";
        errorMsg.style.display = "none";
    }

    function closeModal() {
        modal.style.display = "none";
        errorMsg.style.display = "none";
    }

    function redirectTo(page) {
        window.location.href = page;
    }

    window.onclick = function (event) {
        if (event.target == modal) {
            errorMsg.style.display = "block";
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
