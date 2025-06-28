<?php 
session_start();
include('dbconnect.php');
error_reporting(0);

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['username']);
$isLoggedId = $_SESSION['user_id'] ?? null;
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
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
                <li class="active"><a href="Payment.php">Payment</a></li>
            </ul>
        </div>
    </div>

    <div class="payment-section">
        <h2>Make a Payment</h2>
        <form action="" method="POST" id="payment-form">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter Your Full Name" required><br>

            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" placeholder="Enter Your Email" required><br>

            <label for="contact">Contact Number:</label>
            <input type="tel" id="contact" name="contact" placeholder="Enter Your Contact Number" required pattern="\d{10}"><br>

            <label for="amount">Payment Amount:</label>
            <input type="number" id="amount" name="amount" placeholder="Enter Payment Amount" required min="1"><br>

            <label for="payment-method">Payment Method:</label>
            <select id="payment-method" name="payment-method" required>
                <option value="" disabled selected>Select a Payment Method</option>
                <option value="credit-card">Credit Card</option>
                <option value="debit-card">Debit Card</option>
                <option value="paypal">PayPal</option>
                <option value="net-banking">Net Banking</option>
            </select><br>

            <button type="submit" class="btn" name="pay">Submit Payment</button>

            <div class="link">
            <a href="viewpayments.php">View Payments</a>
            </div>

        </form>
    </div>

    <!-- Show welcome message for logged-in users -->
    <h1 align="center" style="color:black; margin-bottom:20px;">
        Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> !
    </h1>

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

if (isset($_POST['pay'])) {
    if (!$isLoggedIn) {
        echo '<script>alert("Please log in to your account to make a payment.");
              window.location.href = "Portal.php";</script>';
    } else {
        // Get form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $amount = $_POST['amount'];
        $payment_method = $_POST['payment-method'];

        $status = 'pending';  // Initial status
        $isLoggedId = $_SESSION['user_id'] ?? null;

        if ($isLoggedId === null) {
            echo '<script>alert("Error: User ID not found. Please log in again.");</script>';
            exit();
        }

        // Insert into the database
        $sql = "INSERT INTO payments (user_id, name, email, contact, amount, payment_method, status)
                VALUES ('$isLoggedId', '$name', '$email', '$contact', '$amount', '$payment_method', '$status')";

        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Payment Successful!");
                  window.location.href = "Payment.php";</script>';
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
document.getElementById('payment-form').addEventListener('submit', function (event) {
        event.preventDefault();
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const contact = document.getElementById('contact').value.trim();
        const amount = document.getElementById('amount').value.trim();
        const paymentMethod = document.getElementById('payment-method').value;

        let isValid = true;
        let errorMessage = '';

        if (!/^[A-Z a-z]{2,}$/.test(name)) {
            isValid = false;
            errorMessage += 'First Name should only contain letters and be at least 2 characters long.\n';
        }

        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            isValid = false;
            errorMessage += 'Please enter a valid email address.\n';
        }

        if (!/^\d{10}$/.test(contact)) {
            isValid = false;
            errorMessage += 'Phone Number must be exactly 10 digits.\n';
        }

        if (isValid && amount && paymentMethod) {
            alert('Payment Successful! Thank you for your payment.');
            window.location.href = 'Home.php';
        }
        else {
            alert(errorMessage);
        }
    });
    */
</script>