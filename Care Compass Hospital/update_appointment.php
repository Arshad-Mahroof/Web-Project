<?php
session_start();
include('dbconnect.php');
error_reporting(0);

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['username']);
$isLoggedId = isset($_SESSION['user_id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Appointment</title>
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
            </ul>
        </div>
    </div>

    <div class="update_details">
    <h1>Update Appointment</h1>
    <form action="" method="POST">
        <label for="appointment_date">Date:</label>
        <input type="date" id="appointment_date" name="appointment_date" value="<?php echo $appointment['appointment_date']; ?>" required><br>

        <label for="appointment_time">Time:</label>
        <input type="time" id="appointment_time" name="appointment_time" value="<?php echo $appointment['appointment_time']; ?>" required><br>

        <label for="reason">Reason for Visit:</label>
        <textarea id="reason" name="reason" required><?php echo $appointment['reason']; ?></textarea><br>

        <button type="submit" name="update" class="btn">Update Appointment</button>
    </form>
    </div>

    <!-- Show welcome message and menu for logged-in users -->
    <h1 align="center" style="color:black; margin-bottom:20px;">Welcome, <?php echo htmlspecialchars($_SESSION['username']);?> !</h1>

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
// Check if the user is trying to update an appointment
if (isset($_GET['update_id'])) {
    $update_id = $_GET['update_id'];

    // Fetch the appointment details
    $sql = "SELECT * FROM appointments WHERE id = '$update_id' AND user_id = '$isLoggedId'";
    $result = $conn->query($sql);
    $appointment = $result->fetch_assoc();

    if ($appointment) {
        // If the appointment exists, display the update form
        if (isset($_POST['update'])) {
            $appointment_date = $_POST['appointment_date'];
            $appointment_time = $_POST['appointment_time'];
            $reason = $_POST['reason'];

            // Update the appointment in the database
           $update_sql = "UPDATE appointments SET appointment_date = '$appointment_date', 
                                                 appointment_time = '$appointment_time', 
                                                 reason = '$reason' 
                                                 WHERE id = '$update_id' AND user_id = '$isLoggedId'";

            if ($conn->query($update_sql) === TRUE) {
                echo "<script>alert('Appointment updated successfully!'); window.location.href = 'viewappointment.php';</script>";
            } else {
                echo "<script>alert('Error updating appointment: " . $conn->error . "');</script>";
            }
        }
    } else {
        echo "<script>alert('Appointment not found or you do not have permission to edit it.'); window.location.href = 'your_file_name.php';</script>";
    }
} else {
    echo "<script>alert('No appointment selected for update.'); window.location.href = 'your_file_name.php';</script>";
}

$conn->close();

?>

</body>
</html>


