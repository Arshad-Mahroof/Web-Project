<?php 
session_start();
include('dbconnect.php');
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="icon" href="images/Logo.jpeg" />
    <link rel="stylesheet" href="sheet.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
</head>
<body>

    <div class="head">
        <div class="image">
            <img src="images/Logo.jpeg" alt="Care Compass Logo" />
            <h1>Care Compass Hospital</h1>
        </div>
    </div>

    <div class="view_users">
        <h2>All Users</h2>

        <?php
        // Fetch all users
        $stmt = $conn->prepare("SELECT user_id, username, email, phone, address FROM users");
        $stmt->execute();
        $result = $stmt->get_result();
        ?>

        <table border="1">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['user_id']); ?></td>
                            <td><?= htmlspecialchars($row['username']); ?></td>
                            <td><?= htmlspecialchars($row['email']); ?></td>
                            <td><?= htmlspecialchars($row['phone']); ?></td>
                            <td><?= htmlspecialchars($row['address']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="5">No users found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php $stmt->close(); ?>
    </div>

    <div class="payments_details">
        <h2>Payment History</h2>

        <table border="1">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Amount</th>
                    <th>Payment Method</th>
                    <th>Paid Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM payments ORDER BY payment_id DESC";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['user_id']); ?></td>
                            <td><?= htmlspecialchars($row['name']); ?></td>
                            <td><?= htmlspecialchars($row['email']); ?></td>
                            <td><?= htmlspecialchars($row['contact']); ?></td>
                            <td><?= number_format($row['amount'], 2); ?> LKR</td>
                            <td><?= htmlspecialchars($row['payment_method']); ?></td>
                            <td><?= htmlspecialchars($row['paid_time']); ?></td>
                        </tr>
                    <?php endwhile;
                } else { ?>
                    <tr><td colspan="9">No payments found.</td></tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="view_appointment">
        <h2>All Appointments</h2>

        <?php
        // Fetch all appointments
        $stmt = $conn->prepare("SELECT a.id, u.username AS patient_name, d.full_name AS doctor_name, a.appointment_date, a.appointment_time, a.status FROM appointments a JOIN users u ON a.user_id = u.user_id JOIN doctors d ON a.doctor_id = d.doctor_id");
        $stmt->execute();
        $result = $stmt->get_result();
        ?>

        <table border="1">
            <thead>
                <tr>
                    <th>Appointment ID</th>
                    <th>Patient Name</th>
                    <th>Doctor Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']); ?></td>
                            <td><?= htmlspecialchars($row['patient_name']); ?></td>
                            <td><?= htmlspecialchars($row['doctor_name']); ?></td>
                            <td><?= htmlspecialchars($row['appointment_date']); ?></td>
                            <td><?= htmlspecialchars($row['appointment_time']); ?></td>
                            <td><?= htmlspecialchars($row['status']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="6">No appointments found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php $stmt->close(); ?>
    </div>

    <?php $conn->close(); ?>

    <div class="footers">
         <p>&copy;Care Compass Hospitals. All Rights Reserved. |<a href="Logout.php"> Logout </a></p>
    </div>

</body>
</html>
