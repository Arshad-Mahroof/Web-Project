<?php
session_start();
include('dbconnect.php');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    echo '<script>alert("Please log in to view payments.");
          window.location.href = "Portal.php";</script>';
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Payments</title>
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
                <li class="active"><a href="viewpayments.php">View Payments</a></li>
            </ul>
        </div>
    </div>

    <div class="payments_details">
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <h2>Your Payment History</h2>
        <table border="1">
            <tr>
                <th>Payment ID</th>
                <th>User ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Amount</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Paid Time</th>
            </tr>
            <?php
            $user_id = $_SESSION['user_id'];
            $sql = "SELECT * FROM payments WHERE user_id = '$user_id' ORDER BY payment_id DESC";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['payment_id'] . "</td>
                            <td>" . htmlspecialchars($row['user_id']) . "</td>
                            <td>" . htmlspecialchars($row['name']) . "</td>
                            <td>" . htmlspecialchars($row['email']) . "</td>
                            <td>" . htmlspecialchars($row['contact']) . "</td>
                            <td>" . number_format($row['amount'],2) . "LKR</td>
                            <td>" . htmlspecialchars($row['payment_method']) . "</td>
                            <td>" . htmlspecialchars($row['status']) . "</td>
                            <td>" . htmlspecialchars($row['paid_time']) . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No payments found.</td></tr>";
            }
            $conn->close();
            ?>
        </table>
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
