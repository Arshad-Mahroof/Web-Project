<?php 
session_start();
include('dbconnect.php');
error_reporting(0);

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['username']);
$isLoggedId = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
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
                <li class="active"><a href="Contact.php">Contact Us</a></li>
            </ul>
        </div>
    </div>

    <div class="content">
        <h2>Contact Us</h2>
        <p>If you have any questions, feedback, or concerns, feel free to get in touch with us.</p>

        <div class="contact-info">
            <h3>Our Main Branches</h3>

            <div class="branch">
                <h4>Colombo Branch</h4>
                <p><strong>Address:</strong> 123 Main Street, Colombo, Sri Lanka.</p>
                <p>
                    <strong>Phone:</strong><br>
                    General Inquiries: +94 11 123 4567<br>
                    Appointments: +94 11 987 6543<br>
                    Emergency: +94 77 000 1122
                </p>
                <p>
                    <strong>Email:</strong><br>
                    General: colombo@carecompass.lk<br>
                    Appointments: colombo.appointments@carecompass.lk
                </p>
            </div>

            <div class="branch">
                <h4>Kandy Branch</h4>
                <p><strong>Address:</strong> 45 Lake Road, Kandy, Sri Lanka.</p>
                <p>
                    <strong>Phone:</strong><br>
                    General Inquiries: +94 81 223 4567<br>
                    Appointments: +94 81 987 6543<br>
                    Emergency: +94 77 001 1122
                </p>
                <p>
                    <strong>Email:</strong><br>
                    General: kandy@carecompass.lk<br>
                    Appointments: kandy.appointments@carecompass.lk
                </p>
            </div>

            <div class="branch">
                <h4>Kurunegala Branch</h4>
                <p><strong>Address:</strong> 78 Kurunegala Road, Kurunegala, Sri Lanka.</p>
                <p>
                    <strong>Phone:</strong><br>
                    General Inquiries: +94 37 223 4567<br>
                    Appointments: +94 37 987 6543<br>
                    Emergency: +94 77 002 1122
                </p>
                <p>
                    <strong>Email:</strong><br>
                    General: kurunegala@carecompass.lk<br>
                    Appointments: kurunegala.appointments@carecompass.lk
                </p>
            </div>
        </div>


        <div class="contact-form">
            <h3>Send Us a Message</h3>
        <form action="" method="POST" id="contact-form">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter Your Name" required><br>

            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter Your Email" required><br>

            <label for="branch">Select Branch:</label>
            <select id="branch" name="branch" required>
                <option value="">-- Choose Branch --</option>
                <option value="Kandy">Kandy</option>
                <option value="Colombo">Colombo</option>
                <option value="Kurunegala">Kurunegala</option>
            </select><br>

            <label for="message">Message:</label>
            <textarea id="message" name="message" placeholder="Your Message" rows="5" required></textarea><br>

            <button type="submit" class="btn" name="submit_contact">Send Message</button>
        </form>
        </div>

        <div class="map">
            <h3>Find Us</h3>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31622.123456789!2d79.8473!3d6.9271!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2591234567890%3A0x123456789abcdef!2sColombo%2C%20Sri%20Lanka!5e0!3m2!1sen!2slk!4v1234567890123"
                    width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31622.123456789!2d80.6346!3d7.2906!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2591234567890%3A0x123456789abcdef!2sKandy%2C%20Sri%20Lanka!5e0!3m2!1sen!2slk!4v1234567890123"
                    width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31622.123456789!2d80.3679!3d7.4841!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2591234567890%3A0x123456789abcdef!2sKurunegala%2C%20Sri%20Lanka!5e0!3m2!1sen!2slk!4v1234567890123"
                    width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
        </div>
    </div>

    <!-- Show welcome message and menu for logged-in users -->
    <?php if ($isLoggedIn): ?>
        <h1 align="center" style="color:black; margin-bottom:20px;">Welcome, <?php echo htmlspecialchars($_SESSION['username']);?>!</h1>
    <?php endif; ?>

    <div class="footers">
        <p>&copy;Care Compass Hospitals. All Rights Reserved. |<a href="Contact.php">  Contact us  </a>|<?php if ($isLoggedIn): ?><a href="Logout.php"> Logout </a><?php endif; ?></p>
        <div class="social-media">
            <a href="https://www.facebook.com" target="_blank" class="social-icon"><i class="fab fa-facebook"></i></a>
            <a href="https://www.twitter.com" target="_blank" class="social-icon"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
            <a href="https://wa.me/yourphonenumber" target="_blank" class="social-icon"><i class="fab fa-whatsapp"></i></a>
        </div>
    </div>

<?php

if (isset($_POST['submit_contact'])) {
    if (!$isLoggedIn){
        echo '<script> alert("Please log in to your account to send a message.");
        window.location.href = "Portal.php";</script>';
    }
    else{
        $name = $_POST['name'];
        $email = $_POST['email'];
        $branch = $_POST['branch'];
        $message = $_POST['message'];

        // Sanitize user inputs
        $name = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $branch = mysqli_real_escape_string($conn, $branch);
        $message = mysqli_real_escape_string($conn, $message);

        // Insert into the database
        $sql = "INSERT INTO feedbacks (user_id, name, email, branch, message)
                VALUES ('$isLoggedId', '$name', '$email', '$branch', '$message')";

        if ($conn->query($sql) === TRUE) {
            echo '<script> alert("Message sent successfully!"); window.location.href="Home.php";</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}

?>

</body>
</html>

<script>
/*
document.getElementById('contact-form').addEventListener('submit', function (event) {
    event.preventDefault();
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const message = document.getElementById('message').value.trim();

    let isValid = true;
    let errorMessage = '';

    if (!/^[A-Za-z ]{2,}$/.test(name)) {
        isValid = false;
        errorMessage += 'Name should only contain letters and be at least 2 characters long.\n';
    }

    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        isValid = false;
        errorMessage += 'Please enter a valid email address.\n';
    }

    if (message.length < 5) {
        isValid = false;
        errorMessage += 'Message must be at least 5 characters long.\n';
    }

    if (isValid) {
        document.getElementById('contact-form').submit(); // Submit the form
    } else {
        alert(errorMessage);
    }
});
*/
</script>
