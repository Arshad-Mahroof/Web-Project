<?php 
session_start();
include('dbconnect.php');
error_reporting(0);

// Check if the database connection is working
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link rel="icon" href="images/Logo.jpeg" />
    <link rel="stylesheet" href="sheet.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="head">
        <div class="image">
            <img src="images/Logo.jpeg" />
            <h1>Care Compass Hospital</h1>
        </div>
        <div class="sub">
            <ul>
                <li><a href="Home.php">Home</a></li>
                <li><a href="Appointment.php">Book Appointment</a></li>
                <li><a href="Portal.php">Patient Portal</a></li>
                <li><a href="Payment.php">Payment</a></li>
                <li class="active"><a href="Services.php">Services</a></li>
            </ul>
        </div>
    </div>

    <div class="content1">
    <h2>Search Hospital Services & Lab Facilities</h2>
    
    <div style="display: flex; justify-content: center; align-items: center;">
    <form method="POST">
        <input type="text" name="query" placeholder="Enter service or lab facility..." required>
        <button type="submit" name="search">Search</button>
    </form>
    </div>
    <div class="search">
    <?php
    if (isset($_POST['search'])) {

        $query = trim($_POST['query']);

        // Debug: Check if input is received
        echo "Search Term: " . htmlspecialchars($query) . "<br>";

        $sql = $sql = "SELECT * FROM services WHERE name LIKE ?";

        
        // Debug: Check if SQL statement is prepared successfully
        if (!$stmt = $conn->prepare($sql)) {
            die("Query preparation failed: " . $conn->error);
        }

        $searchTerm = "%$query%";
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();

        
        echo "<h3>Search Results: </h3>";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p><strong>". $row['name'] . " (" . ucfirst($row['type']) . ")</strong><br><br>" . $row['description'] . "</p>";
            }
        } else {
            echo "<p>No results found.</p>";
        }
        

        $stmt->close();
        $conn->close();
    }
    ?>
    </div>
    </div>

    <div class="content1">
        <h2 class="A1">Our Services</h2>
        <p>At Care Compass Hospital, we provide a wide range of healthcare services to cater to your needs. Below is a list of some of our key services:</p>

        <div class="service">
            <div class="con1">
                <h3>General Medicine</h3>
                <p>Our experienced physicians provide comprehensive medical care for all age groups, focusing on preventive care and overall well-being.</p>
            </div>
            <div class="img1">
                <img src="images/GM.jpg" />
            </div>
        </div>

        <div class="service1">
            <div class="img2">
                <img src="images/Pediatrics.jpg" />
            </div>
            <div class="con2">
                <h3>Pediatrics</h3>
                <p>We offer specialized care for infants, children, and adolescents, ensuring their health and development are closely monitored.</p>
            </div>
        </div>

        <div class="service">
            <div class="con1">
                <h3>Emergency Services</h3>
                <p>Our 24/7 emergency department is equipped to handle critical medical situations promptly and efficiently.</p>
            </div>
            <div class="img1">
                <img src="images/Emergency.jpg" />
            </div>
        </div>

        <div class="service1">
            <div class="img2">
                <img src="images/Lab.jpg" />
            </div>
            <div class="con2">
                <h3>Diagnostic and Laboratory Services</h3>
                <p>State-of-the-art diagnostic facilities for accurate tests and timely reports, aiding in effective treatment plans.</p>
            </div>
        </div>

        <div class="service">
            <div class="con1">
                <h3>Surgical Services</h3>
                <p>Our skilled surgeons perform a wide range of procedures, from minor operations to complex surgeries, with advanced technology.</p>
            </div>
            <div class="img1">
                <img src="images/Surgery1.png" />
            </div>
        </div>

        <div class="service1">
            <div class="img2">
                <img src="images/Telemedicine.jpg" />
            </div>
            <div class="con2">
                <h3>Telemedicine Services</h3>
                <p>Our Telemedicine Services offer secure online consultations with expert doctors for convenient medical advice and follow-up care at home.</p>
            </div>
        </div>

        <div class="service">
            <div class="con1">
                <h3>Mental Health & Counseling</h3>
                <p>We provide confidential psychological assessments, therapy, and support to help manage stress, anxiety, and emotional challenges.</p>
            </div>
            <div class="img1">
                <img src="images/MHC.jpg" />
            </div>
        </div>

        <div class="service1">
            <div class="img2">
                <img src="images/HealthScreening.jpg" />
            </div>
            <div class="con2">
                <h3>Health Screening Packages</h3>
                <p>Our Health Screening Packages offer complete check-ups, including blood tests, cancer screenings, and wellness assessments for early detection and proactive health care.</p>
            </div> 
        </div>

        <div class="services-section">
            <div class="service-card emergency">
                <div class="icon">🩹</div>
                <h2>Emergency Care</h2>
                <p>Immediate medical attention when you need it most. Our Emergency Care Hub is here for your emergencies, ensuring swift and comprehensive treatment.</p>
                <div class="contact">
                    <span>📞</span>
                    <a href="tel:0812222404">0812 222 404</a>
                </div>
            </div>
            <div class="service-card consultations">
                <div class="icon">🔍</div>
                <h2>Specialist Consultations</h2>
                <p>Our channelled consultations offer personalized appointments with skilled specialists for your health needs, ensuring tailored guidance and expert care.</p>
                <div class="contact">
                    <span>📞</span>
                    <a href="tel:0812223223">0812 223 223</a>
                </div>
            </div>
            <div class="service-card ambulance">
                <div class="icon">🚑</div>
                <h2>Ambulance Service</h2>
                <p>Swift and reliable ambulance service at your service. Count on us for quick and professional medical transportation to ensure your well-being.</p>
                <div class="contact">
                    <span>📞</span>
                    <a href="tel:0812236404">0812 236 404</a>
                </div>
            </div>
        </div>

        <p class="A1">For more details about any of our services, feel free to <a href="Contact.php">contact us</a>...</p>
    </div>

    <div class="footers">
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