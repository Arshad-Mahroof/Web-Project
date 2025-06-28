<?php
session_start();
include('dbconnect.php');
error_reporting(0);

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['username']);
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Appointment</title>
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
                <li class="active"><a href="viewappointment.php">View Appointment</a></li>
            </ul>
        </div>
    </div>

<?php
// Handle the delete action
if ($isLoggedIn && isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);

    $stmt = $conn->prepare("DELETE FROM appointments WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $delete_id, $userId);

    if ($stmt->execute()) {
        echo "<script>alert('Appointment deleted successfully!'); window.location.href = 'viewappointment.php';</script>";
    } else {
        echo "<script>alert('Error deleting appointment: " . $conn->error . "');</script>";
    }

    $stmt->close();
}

if ($isLoggedIn): ?>
    <div class="view_appointment">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <h2>Your Appointments</h2>

        <?php
        // Fetch appointments for the logged-in user
        $stmt = $conn->prepare("SELECT a.id, a.user_id, d.full_name AS doctor_name, a.appointment_date, a.appointment_time, a.status FROM appointments a JOIN doctors d ON a.doctor_id = d.doctor_id WHERE a.user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        ?>

        <table border="1">
            <thead>
                <tr>
                    <th>Appointment ID</th>
                    <th>User ID</th>
                    <th>Doctor</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['doctor_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['appointment_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['appointment_time']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                            <td>
                                <a href="?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this appointment?');">Delete</a> |
                                <a href="update_appointment.php?update_id=<?php echo $row['id']; ?>">Update</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan='7'>No appointments found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php
        $stmt->close();
        ?>

    </div>
<?php else: ?>
    <h2>Please log in to view your appointments.</h2>
<?php endif; ?>

<?php $conn->close(); ?>

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
