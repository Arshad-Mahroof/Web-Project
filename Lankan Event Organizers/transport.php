<?php
session_start();
include('dbconnect.php');
error_reporting(0);

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_name']);
$isLoggedId = isset($_SESSION['user_id']);

// Fetch only services where service_name is 'Transport'
$stmt = $conn->prepare("SELECT * FROM services WHERE service_name = ?");
$service_name = "Transport";
$stmt->bind_param("s", $service_name);
$stmt->execute();
$servicesResult = $stmt->get_result();

$query = $conn->prepare("
    SELECT s.provider_name, p.booking_date 
    FROM payment p
    JOIN services s ON p.service_id = s.id
    WHERE s.service_name = ? AND p.booking_date IS NOT NULL
    ORDER BY s.provider_name, p.booking_date DESC
");
$service_name = "Transport";
$query->bind_param("s", $service_name);
$query->execute();
$bookedResult = $query->get_result();

// Prepare the filter conditions
$conditions = "service_name = ?";
$params = ["Transport"];
$types = "s"; // s = string for 'Transport'

if (!empty($_GET['location'])) {
    $conditions .= " AND location LIKE ?";
    $params[] = "%" . $_GET['location'] . "%";
    $types .= "s"; // string
}

if (!empty($_GET['price'])) {
    $conditions .= " AND price <= ?";
    $params[] = $_GET['price'];
    $types .= "d"; // d = double/number
}

// Now prepare the statement
$sql = "SELECT * FROM services WHERE $conditions";
$stmt = $conn->prepare($sql);

// Bind parameters dynamically
$stmt->bind_param($types, ...$params);

$stmt->execute();
$servicesResult = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Transport Services</title>
    <link rel="stylesheet" href="ourServices.css" />
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
    <form method="GET" action="">
        <label for="location">Location:</label>
        <select name="location" id="location">
            <option value="">-- Select District --</option>
            <option value="Colombo" <?php if (isset($_GET['location']) && $_GET['location'] == "Colombo") echo 'selected'; ?>>Colombo</option>
            <option value="Gampaha" <?php if (isset($_GET['location']) && $_GET['location'] == "Gampaha") echo 'selected'; ?>>Gampaha</option>
            <option value="Kalutara" <?php if (isset($_GET['location']) && $_GET['location'] == "Kalutara") echo 'selected'; ?>>Kalutara</option>
            <option value="Kandy" <?php if (isset($_GET['location']) && $_GET['location'] == "Kandy") echo 'selected'; ?>>Kandy</option>
            <option value="Matale" <?php if (isset($_GET['location']) && $_GET['location'] == "Matale") echo 'selected'; ?>>Matale</option>
            <option value="Nuwara Eliya" <?php if (isset($_GET['location']) && $_GET['location'] == "Nuwara Eliya") echo 'selected'; ?>>Nuwara Eliya</option>
            <option value="Galle" <?php if (isset($_GET['location']) && $_GET['location'] == "Galle") echo 'selected'; ?>>Galle</option>
            <option value="Matara" <?php if (isset($_GET['location']) && $_GET['location'] == "Matara") echo 'selected'; ?>>Matara</option>
            <option value="Hambantota" <?php if (isset($_GET['location']) && $_GET['location'] == "Hambantota") echo 'selected'; ?>>Hambantota</option>
            <option value="Jaffna" <?php if (isset($_GET['location']) && $_GET['location'] == "Jaffna") echo 'selected'; ?>>Jaffna</option>
            <option value="Kilinochchi" <?php if (isset($_GET['location']) && $_GET['location'] == "Kilinochchi") echo 'selected'; ?>>Kilinochchi</option>
            <option value="Mannar" <?php if (isset($_GET['location']) && $_GET['location'] == "Mannar") echo 'selected'; ?>>Mannar</option>
            <option value="Vavuniya" <?php if (isset($_GET['location']) && $_GET['location'] == "Vavuniya") echo 'selected'; ?>>Vavuniya</option>
            <option value="Mullaitivu" <?php if (isset($_GET['location']) && $_GET['location'] == "Mullaitivu") echo 'selected'; ?>>Mullaitivu</option>
            <option value="Batticaloa" <?php if (isset($_GET['location']) && $_GET['location'] == "Batticaloa") echo 'selected'; ?>>Batticaloa</option>
            <option value="Ampara" <?php if (isset($_GET['location']) && $_GET['location'] == "Ampara") echo 'selected'; ?>>Ampara</option>
            <option value="Trincomalee" <?php if (isset($_GET['location']) && $_GET['location'] == "Trincomalee") echo 'selected'; ?>>Trincomalee</option>
            <option value="Kurunegala" <?php if (isset($_GET['location']) && $_GET['location'] == "Kurunegala") echo 'selected'; ?>>Kurunegala</option>
            <option value="Puttalam" <?php if (isset($_GET['location']) && $_GET['location'] == "Puttalam") echo 'selected'; ?>>Puttalam</option>
            <option value="Anuradhapura" <?php if (isset($_GET['location']) && $_GET['location'] == "Anuradhapura") echo 'selected'; ?>>Anuradhapura</option>
            <option value="Polonnaruwa" <?php if (isset($_GET['location']) && $_GET['location'] == "Polonnaruwa") echo 'selected'; ?>>Polonnaruwa</option>
            <option value="Badulla" <?php if (isset($_GET['location']) && $_GET['location'] == "Badulla") echo 'selected'; ?>>Badulla</option>
            <option value="Monaragala" <?php if (isset($_GET['location']) && $_GET['location'] == "Monaragala") echo 'selected'; ?>>Monaragala</option>
            <option value="Ratnapura" <?php if (isset($_GET['location']) && $_GET['location'] == "Ratnapura") echo 'selected'; ?>>Ratnapura</option>
            <option value="Kegalle" <?php if (isset($_GET['location']) && $_GET['location'] == "Kegalle") echo 'selected'; ?>>Kegalle</option>
        </select>

        <label for="price">Max Price (LKR):</label>
        <input type="number" name="price" id="price" placeholder="Enter max price" value="<?php echo htmlspecialchars($_GET['price'] ?? ''); ?>">

        <button type="submit" class="btn">Filter</button>
    </form>
</section>

<h2 class="title">Transport Services</h2>

<section class="bookings">
    <h3 class="booking-title">All Transport Provider Booking Dates:</h3>
    <?php
    if ($bookedResult->num_rows > 0):
        $currentProvider = "";
        while ($row = $bookedResult->fetch_assoc()):
            if ($row['provider_name'] !== $currentProvider):
                if ($currentProvider !== "") echo "</ul>";
                $currentProvider = $row['provider_name'];
                echo "<h4 class='provider-name'>" . htmlspecialchars($currentProvider) . "</h4><ul class='booking-list'>"; 
            endif;
            echo "<li class='booking-date'>" . date("F j, Y", strtotime($row['booking_date'])) . "</li>";
        endwhile;
        echo "</ul>";
    else:
        echo "<p class='no-bookings'>No bookings yet.</p>";
    endif;
    ?>
</section>


<div class="modular-grid">
    <?php while ($row = $servicesResult->fetch_assoc()) { ?>
    <div class="modular-card">
        <div class="modular-info">
        <?php if (!empty($row['photo'])) { ?>
            <img src="<?php echo $row['photo']; ?>" alt="Service Photo" class="modular-img">
        <?php } ?>
            <p><strong>Service Name:</strong> <?php echo htmlspecialchars($row['service_name']); ?></p>
            <p><strong>Provider:</strong> <?php echo htmlspecialchars($row['provider_name']); ?></p>
            <p><strong>Description:</strong><br><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
            <p><strong>Location:</strong> <?php echo htmlspecialchars($row['location']); ?></p>
            <p><strong>Price:</strong> LKR <?php echo number_format($row['price'], 2); ?></p>
            <p><strong>Time Slot:</strong> <?php echo htmlspecialchars($row['time_slot']); ?></p>
            <?php if ($isLoggedIn): ?>
                <a href="payment.php?service_id=<?php echo $row['id']; ?>" class="modular-book">Book</a>
            <?php else: ?>
                <p class="modular-login"><em><a href="login.php">Login</a> to book</em></p>
            <?php endif; ?>
        </div>
    </div>
    <?php } ?>
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
